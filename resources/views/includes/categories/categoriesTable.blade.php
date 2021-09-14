@foreach($categories as $category)
<tr>
    <td>
        {{$category->slug}}
    </td>
    <td>
        {{$category->name}}
    </td>
    <td>
        {{date('Y-m-d', strtotime($category->created_at))}}
    </td>
    <td class="td-actions text-right">
        <a rel="tooltip" class="btn btn-success" href="{{route('edit.category', ['id' => $category->id])}}" data-original-title="" title="">
            <i class="material-icons">edit</i>
        </a>
        <form action="{{route('delete.category')}}" category="{{$category->id}}" method="post" id="form-delete" class="d-none">
            @csrf
            <input type="hidden" name="record_id" value="{{$category->id}}" class="d-none">
        </form>
        <button class="btn btn-danger" id="delRecord" value="{{$category->id}}"><i class="material-icons">delete</i></button>
    </td>
</tr>

@endforeach