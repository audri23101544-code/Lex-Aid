<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>LexAid Lawyer Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-[#f5f7fb] text-[#0b1b34]">

<div class="min-h-screen flex">

    <!-- Sidebar -->
    <aside class="w-72 bg-[#002147] text-white p-7 flex flex-col">
        <div class="mb-10">
            <h1 class="text-4xl font-serif font-bold text-white">⚖ LexAid</h1>
            <p class="text-yellow-300 text-sm tracking-widest mt-1">LAWYER DASHBOARD</p>
        </div>

        <nav class="space-y-3">
            <a href="/lawyer" class="flex items-center justify-between bg-yellow-400/20 text-yellow-300 px-5 py-4 rounded-xl font-bold">
                <span>Dashboard</span>
            </a>

            <a href="#cases" class="block px-5 py-4 rounded-xl hover:bg-white/10">
                My Cases
            </a>

            <a href="#sos" class="flex justify-between items-center px-5 py-4 rounded-xl hover:bg-white/10">
                <span>SOS Alerts</span>
                <span class="bg-red-500 text-white rounded-full px-3 py-1 text-sm"><?php echo e($totalSos ?? 0); ?></span>
            </a>

            <a href="#" class="block px-5 py-4 rounded-xl hover:bg-white/10">
                Calendar
            </a>

            <a href="#" class="block px-5 py-4 rounded-xl hover:bg-white/10">
                Documents
            </a>

            <a href="#" class="block px-5 py-4 rounded-xl hover:bg-white/10">
                Messages
            </a>
        </nav>

        <div class="mt-auto border-t border-white/20 pt-6">
            <a href="/logout" class="block bg-red-600 text-center py-3 rounded-xl font-bold">
                Logout
            </a>
        </div>
    </aside>

    <!-- Main -->
    <main class="flex-1 p-8 overflow-y-auto">

        <!-- Top -->
        <div class="flex justify-between items-center mb-8">
            <div>
                <h2 class="text-3xl font-bold">Good Morning, Advocate 👋</h2>
                <p class="text-gray-500">Here’s what’s happening with your legal work today.</p>
            </div>

            <div class="flex items-center gap-4">
                <div class="text-right">
                    <p class="text-sm text-gray-500">Welcome back,</p>
                    <p class="font-bold"><?php echo e($user->name ?? 'Lawyer'); ?></p>
                </div>
                <div class="w-12 h-12 rounded-full bg-[#002147] text-white flex items-center justify-center font-bold">
                    <?php echo e(strtoupper(substr($user->name ?? 'L', 0, 1))); ?>

                </div>
            </div>
        </div>

        <!-- Cards -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <div class="bg-white p-6 rounded-2xl shadow">
                <p class="text-gray-500">My Active Cases</p>
                <h3 class="text-4xl font-bold mt-3"><?php echo e($totalCases ?? 0); ?></h3>
                <p class="text-blue-600 text-sm mt-4">Assigned cases</p>
            </div>

            <div class="bg-white p-6 rounded-2xl shadow">
                <p class="text-gray-500">Open Cases</p>
                <h3 class="text-4xl font-bold mt-3"><?php echo e($openCases ?? 0); ?></h3>
                <p class="text-blue-600 text-sm mt-4">Need action</p>
            </div>

            <div class="bg-white p-6 rounded-2xl shadow">
                <p class="text-gray-500">SOS Alerts</p>
                <h3 class="text-4xl font-bold mt-3 text-red-600"><?php echo e($totalSos ?? 0); ?></h3>
                <p class="text-red-600 text-sm mt-4">Require attention</p>
            </div>
            

            <div class="bg-white p-6 rounded-2xl shadow">
                <p class="text-gray-500">Completed Cases</p>
                <h3 class="text-4xl font-bold mt-3 text-green-600"><?php echo e($closedCases ?? 0); ?></h3>
                <p class="text-green-600 text-sm mt-4">Resolved</p>
            </div>
        </div>
        <!-- Admin Notifications -->
<section class="bg-white rounded-2xl shadow p-6 mb-8">
    <div class="flex justify-between items-center mb-5">
        <div>
            <h3 class="text-2xl font-bold">🔔 Admin Notifications</h3>
            <p class="text-gray-500">Messages sent by admin</p>
        </div>
    </div>

    <?php if(isset($notifications) && $notifications->count() > 0): ?>
        <div class="space-y-4">
            <?php $__currentLoopData = $notifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notification): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="border rounded-xl p-4 bg-blue-50">
                    <h4 class="font-bold text-[#002147]"><?php echo e($notification->subject); ?></h4>
                    <p class="text-sm text-gray-600 mt-1"><?php echo e($notification->message); ?></p>
                    <p class="text-xs text-gray-400 mt-2"><?php echo e($notification->created_at); ?></p>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    <?php else: ?>
        <div class="bg-gray-100 p-4 rounded text-gray-600">
            No notifications from admin yet.
        </div>
    <?php endif; ?>
</section>
        <!-- Middle Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">

            <!-- SOS -->
            <section id="sos" class="bg-white rounded-2xl shadow p-6">
                <div class="flex justify-between items-center mb-5">
                    <div>
                        <h3 class="text-2xl font-bold">🚨 SOS Alerts</h3>
                        <p class="text-gray-500">Urgent client requests</p>
                    </div>
                </div>

                <?php if(isset($sosRequests) && $sosRequests->count() > 0): ?>
                    <div class="space-y-4">
                        <?php $__currentLoopData = $sosRequests; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sos): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="flex items-center justify-between border rounded-xl p-4 hover:bg-red-50">
                                <div class="flex gap-4">
                                    <div class="bg-red-100 text-red-600 font-bold px-4 py-3 rounded-xl">
                                        SOS
                                    </div>
                                    <div>
                                        <h4 class="font-bold"><?php echo e($sos->emergency_type); ?></h4>
                                        <p class="text-sm text-gray-500"><?php echo e($sos->location); ?></p>
                                        <p class="text-sm text-gray-500"><?php echo e($sos->phone); ?></p>
                                    </div>
                                </div>

                                <div class="text-right">
                                    <form action="/sos/update/<?php echo e($sos->id); ?>" method="POST">
                                        <?php echo csrf_field(); ?>
                                        <select name="status"
                                            onchange="this.form.submit()"
                                            class="border px-2 py-1 rounded text-sm">

                                            <option value="pending" <?php echo e($sos->status == 'pending' ? 'selected' : ''); ?>>
                                                Pending
                                            </option>

                                            <option value="reviewing" <?php echo e($sos->status == 'reviewing' ? 'selected' : ''); ?>>
                                                Reviewing
                                            </option>

                                            <option value="resolved" <?php echo e($sos->status == 'resolved' ? 'selected' : ''); ?>>
                                                Resolved
                                            </option>
                                        </select>
                                    </form>
                                    <p class="text-xs text-gray-400">Client: <?php echo e($sos->client_name); ?></p>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                <?php else: ?>
                    <div class="bg-gray-100 p-4 rounded text-gray-600">
                        No active SOS alerts.
                    </div>
                <?php endif; ?>
            </section>

            <!-- Upcoming Hearings Static -->
            <section class="bg-white rounded-2xl shadow p-6">
                <div class="flex justify-between items-center mb-5">
                    <div>
                        <h3 class="text-2xl font-bold">📅 Upcoming Hearings</h3>
                        <p class="text-gray-500">Today’s legal schedule</p>
                    </div>
                </div>

                <div class="space-y-4">
                    <div class="border rounded-xl p-4 flex justify-between">
                        <div>
                            <h4 class="font-bold">Client Consultation</h4>
                            <p class="text-sm text-gray-500">District Court / Online</p>
                        </div>
                        <span class="text-yellow-700 font-bold">11:00 AM</span>
                    </div>

                    <div class="border rounded-xl p-4 flex justify-between">
                        <div>
                            <h4 class="font-bold">Case Review Meeting</h4>
                            <p class="text-sm text-gray-500">Family Court</p>
                        </div>
                        <span class="text-yellow-700 font-bold">02:30 PM</span>
                    </div>

                    <div class="border rounded-xl p-4 flex justify-between">
                        <div>
                            <h4 class="font-bold">Evidence Review</h4>
                            <p class="text-sm text-gray-500">Document verification</p>
                        </div>
                        <span class="text-yellow-700 font-bold">Tomorrow</span>
                    </div>
                </div>
            </section>

        </div>

        <!-- Cases -->
        <section id="cases" class="bg-white rounded-2xl shadow p-6">
            <div class="flex justify-between items-center mb-5">
                <div>
                    <h3 class="text-2xl font-bold">Recent Case Updates</h3>
                    <p class="text-gray-500">Assigned cases and current status</p>
                </div>
            </div>

            <?php if(isset($allCases) && $allCases->count() > 0): ?>
                <div class="space-y-4">
                    <?php $__currentLoopData = $allCases; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $case): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="border rounded-xl p-4 flex justify-between items-center hover:bg-gray-50">
                            <div>
                                <h4 class="font-bold"><?php echo e($case->title ?? 'Untitled Case'); ?></h4>
                                <p class="text-sm text-gray-500">
                                    Case #LX-<?php echo e($case->id); ?> · <?php echo e($case->case_type ?? 'N/A'); ?>

                                </p>
                            </div>

                            <div class="text-right">
                                <p class="font-bold text-[#002147]"><?php echo e(ucfirst($case->status ?? 'open')); ?></p>
                                <p class="text-sm text-gray-500">Deadline: <?php echo e($case->deadline ?? 'N/A'); ?></p>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            <?php else: ?>
                <div class="bg-gray-100 p-4 rounded text-gray-600">
                    No assigned cases yet.
                </div>
            <?php endif; ?>
        </section>

    </main>
</div>

</body>
</html><?php /**PATH C:\Users\user\Desktop\lexaid\resources\views/lawyer_dashboard.blade.php ENDPATH**/ ?>