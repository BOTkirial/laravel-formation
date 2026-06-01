@props(['tasks'])
<ul>
    @foreach ($tasks as $task)
        <li>{{ $task->title }}</li>
    @endforeach
</ul>