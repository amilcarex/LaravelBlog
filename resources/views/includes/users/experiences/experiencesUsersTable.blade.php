@foreach($experiences as $experience)
<tr>
    <td>
        <img src="{{$experience->logo}}" alt="{{$experience->company}}" class="image-logo-experience">

    </td>
    <td>
        {{$experience->company}}
    </td>
    <td>
        {{$experience->occupation}}
    </td>
    <td>
        {{date('Y-m-d', strtotime($experience->from))}}
    </td>
    <td>
        @if($experience->to == null)
        Now
        @else
        {{date('Y-m-d', strtotime($experience->to))}}
        @endif

    </td>
    <td class="td-actions text-right">


        <a rel="tooltip" class="btn btn-success" href="{{route('edit.user.experience', ['user' => auth()->user()->id, 'id' => $experience->id])}}" data-original-title="" title="">
            <i class="material-icons">edit</i>
        </a>
        <form action="{{route('delete.user.experience')}}" experience="{{$experience->id}}" method="post" id="form-delete" class="d-none">
            @csrf
            <input type="hidden" name="record_id" value="{{$experience->id}}" class="d-none"> 
            @if(isset($_REQUEST['page']))
            <input type="hidden" name="page" value="{{$_REQUEST['page']}}" class="d-none">
            @endif
        </form>
        <button class="btn btn-danger" id="delRecord"><i class="material-icons">delete</i></button>


    </td>
</tr>

@endforeach