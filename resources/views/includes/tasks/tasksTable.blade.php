@foreach($tasks as $task)
<tr>
    <td>
        {{$task->name}}
    </td>
    <td>
        {{$task->description}}
    </td>
    <td>
        {{date('Y-m-d', strtotime($task->created_at))}}
    </td>
    <td>
        {{$task->status_id}}
    </td>
    <td class="td-actions text-right">

        <a rel="tooltip" class="btn btn-success" href="{{route('edit.task', ['id' => $task->id])}}" data-original-title="" title="">
            <i class="material-icons">edit</i>
        </a>
        <form action="{{route('delete.task')}}" task="{{$task->id}}" method="post" id="form-delete" class="d-none">
            @csrf
            <input type="hidden" name="record_id" value="{{$task->id}}" class="d-none">
        </form>
        <button class="btn btn-danger" id="delRecord" value="{{$task->id}}"><i class="material-icons">delete</i></button>
    </td>
</tr>

@endforeach