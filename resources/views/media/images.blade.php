@extends('layouts.app', ['activePage' => 'media-images', 'titlePage' => __('Images')])

@section('content')
<div class="content">
    <div class="container-file-manager">
        <iframe src="{{$url}}/laravel-filemanager?field_name=src&type=Images" frameborder="0" style="width:100%;height:100%"></iframe>
    </div>
</div>
@endsection