<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Mail</title>
</head>
<body>
    <h1>Task Reminder</h1>
    <p>Dear User,</p>
    <p>This is a reminder to update the status of the following task:</p>
    <ul>
        <li><strong>Task ID:</strong> {{ $task->id }}</li>
        <li><strong>Title:</strong> {{ $task->name }}</li>
        <li><strong>Description:</strong> {{ $task->description }}</li>
        <li><strong>Status:</strong> {{ $task->status }}</li>
    </ul>
</body>
</html>
