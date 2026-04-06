<h2>Create Case</h2>

<form method="POST" action="/case/store">
    @csrf

    <input type="text" name="title" placeholder="Case Title"><br><br>

    <textarea name="description" placeholder="Description"></textarea><br><br>

    <input type="text" name="case_type" placeholder="Case Type"><br><br>

    <input type="text" name="location" placeholder="Location"><br><br>

    <input type="date" name="deadline"><br><br>

    <button type="submit">Submit Case</button>
</form>
<h2>All Cases</h2>

<table border="1" cellpadding="10">
    <tr>
        <th>ID</th>
        <th>Title</th>
        <th>Status</th>
        <th>Priority</th>
    </tr>

    @foreach($cases as $case)
    <tr>
        <td>{{ $case->id }}</td>
        <td>{{ $case->title }}</td>
        <td>{{ $case->status }}</td>
        <td>{{ $case->priority }}</td>
    </tr>
    @endforeach
</table>