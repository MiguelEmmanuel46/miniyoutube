@extends('layouts.app')

@section('content')
<div class="container bg-whiteO5">
    <h1>Crear un nuevo video</h1>
    <hr>
    @if($errors->any())
    <div class="aler alert-danger">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{$error}}</li>
            @endforeach
        </ul>
    </div>
    <hr>
    @endif
    <div class="row">
        <div class="col-xs-12 col-md-12">
            <form action="{{route('saveVideo')}}" enctype="multipart/form-data" method="POST" >
                {!! csrf_field() !!}
                <div class="form-group">
                    <label for="title">Titulo</label>
                    <input type="text" class="form-control" id="title" name="title" value="{{old('title')}}">
                </div>
                <div class="form-group">
                    <label for="description">Descripción</label>
                    <textarea class="form-control" id="description" name="description" >{{old('description')}}</textarea> 
                </div>

                <div class="form-group">
                    <label for="image">Miniatura</label>
                    <input type="file" class="form-control-file" id="image" name="image"/>
                </div>

                <div class="form-group">
                    <label for="video">Video</label>
                    <input type="file" class="form-control-file" id="video" name="video"/>
                </div>
                <input type="submit" class="btn btn-success" value="Crear Video">
            </form>
        </div>
    </div>
</div>
@endsection
