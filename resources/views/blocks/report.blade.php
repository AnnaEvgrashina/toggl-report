<div class="m-4">
    {{ $dates }}
    <ol>
    @foreach($tasks as $task)
        <li>
            @if($task->getLink() != '')
                <a href="{{ $task->getLink() }}">{{ $task->getDescription() }}</a> - {{ \App\Services\Helper::getTime($task->getDuration()) }}
            @else
                {{ $task->getDescription() }} - {{ \App\Services\Helper::getTime($task->getDuration()) }}
            @endif
        </li>
    @endforeach
    </ol>
    <span style="text-decoration: underline">Итого рабочее время:</span> {{ \App\Services\Helper::getTime($total) }}
</div>
