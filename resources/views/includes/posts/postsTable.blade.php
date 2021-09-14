@foreach($posts as $post)
<tr>
    <td>
        {{$post->tittle}}
    </td>
    <td>
        {{$post->author_name}}
    </td>
    <td>
        {{$post->visibility}}
    </td>
    <td>
        {{date('Y-m-d', strtotime($post->updated_at))}}
    </td>
    <td class="td-actions text-right">
        <a rel="tooltip" class="btn btn-success" href="{{route('edit.post', ['id' => $post->id])}}" data-original-title="" title="">
            <i class="material-icons">edit</i>
        </a>
        <form action="{{route('delete.post')}}" post="{{$post->id}}" method="post" id="form-delete" class="d-none">
            @csrf
            <input type="hidden" name="record_id" value="{{$post->id}}" class="d-none">
            <input type="hidden" name="page" value="{{$_REQUEST['page']}}" class="d-none">
        </form>
        <button class="btn btn-danger" id="delRecord" value="{{$post->id}}"><i class="material-icons">delete</i></button>
    </td>
</tr>

@endforeach