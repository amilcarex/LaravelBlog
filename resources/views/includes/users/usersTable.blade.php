@foreach($users as $user)
<tr>
    <td>
        {{$user->name}}
    </td>
    <td>
        {{$user->email}}
    </td>
    <td>
        {{$user->role->name}}
    </td>
    <td>
        {{date('Y-m-d', strtotime($user->created_at))}}
    </td>
    <td class="td-actions text-right">
        <a rel="tooltip" class="btn btn-success" href="{{route('edit.user', ['id' => $user->id])}}" data-original-title="" title="">
            <i class="material-icons">edit</i>
        </a>
        <form action="{{route('delete.user')}}" user="{{$user->id}}" method="post" id="form-delete" class="d-none">
            @csrf
            <input type="hidden" name="record_id" value="{{$user->id}}" class="d-none">
        </form>
        <button class="btn btn-danger" id="delRecord" data="user" value="{{$user->id}}"><i class="material-icons">delete</i></button>
    </td>
</tr>

@endforeach