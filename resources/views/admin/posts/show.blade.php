@extends('layouts.app')


@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                 <h1>{{ $post->title }}</h1>
            </div>
        </div>
        <div class="row">
            <div class="col">
              <div><h2>{{ $post->title }}</h2></div>
              <div>{{  $post->content }}</div>
              <a class="btn btn-primary" href="{{ url()->previous() }}">Back</a>
            </div>
        </div>
    </div>
   
@endsection