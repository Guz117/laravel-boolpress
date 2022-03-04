@extends('layouts.admin')


@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                 <h1>{{ $post->title }}</h1>
            </div>
        </div>
        <div class="row">
            <div class="col">
              <div>
                    <h2>{{ $post->title }}</h2>
                    <h3>Category: {{ $post->category()->first()->name }}</h3>
                    <h3>Author: {{ $post->user()->first()->name }} </h3>
                    @foreach ($post->tags()->get() as $tag)
                        <h3>{{ $tag->name }}</h3>
                    @endforeach
                </div>
              <div>{{  $post->content }}</div>
              <a class="btn btn-primary" href="{{ url()->previous() }}">Back</a>
            </div>
        </div>
    </div>
   
@endsection