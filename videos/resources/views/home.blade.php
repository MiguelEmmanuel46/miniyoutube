@extends('layouts.app')

@section('content')
<div class="container">
    @if (session('message'))
        <div class="alert alert-success">
            <h1>{{ session('message') }}</h1>
        </div>
    @endif
        <div class="row">
            @foreach($videos as $video)
                <div class="video-item col-md-10 pull-left panel panel-default">
                    <div class="panel-body row" style="border: 1px solid #000000; padding-top: 10px; padding-bottom: 10px;">
                        @if(Storage::disk('img')->has($video->image))
                            <div class="video-image-thumb col-md-3 pull-left">
                                <div class="video-image-mask">
                                    <img src="{{url('/miniatura/'.$video->image)}}" class="video-image" alt=""/>        
                                </div>
                            </div>                            
                        @endif                    
                        <div class="data col-md-8">
                            <h4 class="video-title"><a href="">{{$video->title}}</a></h4>
                            <p>{{$video->user->name.' '.$video->user->surname}}</p>
                            <a href="" class="btn btn-primary">Ver</a>
                            <!-- Botoes de acción-->
                            @if(Auth::check() && Auth::user()->id == $video->user->id)
                            
                            <a href="" class="btn btn-warning">Editar</a>
                            <a href="" class="btn btn-danger">Eliminar</a>
                            @endif
                        </div>
                        

                    </div><br>
                </div>
            @endforeach
        </div>
        {{$videos->links()}}
    
</div>
@endsection
