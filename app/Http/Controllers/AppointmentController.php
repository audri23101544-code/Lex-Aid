<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class AppointmentController extends Controller
{
    // Client appointment request page
    public function clientCreate()
    {
        if (!Session::has('user')) {
            return redirect('/login');
        }

        $user = Session::get('user');

        if ($user->role != 'client') {
            return redirect('/login');
        }

        $lawyers = DB::table('users')
            ->where('role', 'lawyer')
            ->get();

        $cases = DB::table('cases')
            ->where('client_id', $user->id)
            ->latest('id')
            ->get();

        $appointments = DB::table('appointments')
            ->join('users', 'appointments.lawyer_id', '=', 'users.id')
            ->select('appointments.*', 'users.name as lawyer_name')
            ->where('appointments.client_id', $user->id)
            ->latest('appointments.id')
            ->get();

        return view('client_appointments', compact('user', 'lawyers', 'cases', 'appointments'));
    }

    // Client submits appointment request
    public function clientStore(Request $request)
    {
        if (!Session::has('user')) {
            return redirect('/login');
        }

        $user = Session::get('user');

        if ($user->role != 'client') {
            return redirect('/login');
        }

        $request->validate([
            'lawyer_id' => 'required',
            'appointment_date' => 'required|date',
            'appointment_time' => 'required',
            'reason' => 'required'
        ]);

        DB::table('appointments')->insert([
            'client_id' => $user->id,
            'lawyer_id' => $request->lawyer_id,
            'case_id' => $request->case_id,
            'appointment_date' => $request->appointment_date,
            'appointment_time' => $request->appointment_time,
            'reason' => $request->reason,
            'status' => 'pending'
        ]);

        return redirect('/client/appointments')->with('success', 'Appointment request submitted successfully.');
    }

    // Lawyer views appointment requests and calendar
    public function lawyerIndex()
    {
        if (!Session::has('user')) {
            return redirect('/login');
        }

        $user = Session::get('user');

        if ($user->role != 'lawyer') {
            return redirect('/login');
        }

        $appointments = DB::table('appointments')
            ->join('users', 'appointments.client_id', '=', 'users.id')
            ->leftJoin('cases', 'appointments.case_id', '=', 'cases.id')
            ->select(
                'appointments.*',
                'users.name as client_name',
                'users.email as client_email',
                'cases.title as case_title'
            )
            ->where('appointments.lawyer_id', $user->id)
            ->latest('appointments.id')
            ->get();

        $approvedAppointments = DB::table('appointments')
            ->join('users', 'appointments.client_id', '=', 'users.id')
            ->select('appointments.*', 'users.name as client_name')
            ->where('appointments.lawyer_id', $user->id)
            ->where('appointments.status', 'approved')
            ->orderBy('appointments.appointment_date')
            ->orderBy('appointments.appointment_time')
            ->get();

        return view('lawyer_appointments', compact('user', 'appointments', 'approvedAppointments'));
    }

    // Lawyer approves/rejects appointment with conflict check
    public function updateStatus(Request $request, $id)
    {
        if (!Session::has('user')) {
            return redirect('/login');
        }

        $user = Session::get('user');

        if ($user->role != 'lawyer') {
            return redirect('/login');
        }

        $request->validate([
            'status' => 'required|in:approved,rejected',
            'lawyer_note' => 'nullable'
        ]);

        $appointment = DB::table('appointments')->where('id', $id)->first();

        if (!$appointment || $appointment->lawyer_id != $user->id) {
            return redirect('/lawyer/appointments')->with('error', 'Appointment not found.');
        }

        if ($request->status == 'approved') {
            $conflict = DB::table('appointments')
                ->where('lawyer_id', $user->id)
                ->where('appointment_date', $appointment->appointment_date)
                ->where('appointment_time', $appointment->appointment_time)
                ->where('status', 'approved')
                ->where('id', '!=', $id)
                ->exists();

            if ($conflict) {
                return redirect('/lawyer/appointments')
                    ->with('error', 'Conflict detected! You already have an approved appointment at this date and time.');
            }
        }

        DB::table('appointments')
            ->where('id', $id)
            ->update([
                'status' => $request->status,
                'lawyer_note' => $request->lawyer_note
            ]);

        return redirect('/lawyer/appointments')->with('success', 'Appointment status updated.');
    }
}