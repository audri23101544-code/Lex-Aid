<h2>All Cases</h2>

<table border="1">
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