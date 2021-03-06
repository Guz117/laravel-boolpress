@extends('layouts.admin')

@section('content')

<div class="container">
        <div class="row">
            <div class="col">
                <form action="{{ route('admin.posts.update', $post->slug) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')

                    <div class="mb-3">
                        <select class="form-select" name="category_id">
                           
                            <option value="">Select a category</option>
                            @foreach ($categories as $category)
                                <option @if (old('category_id', $post->category_id) == $category->id) selected @endif value="{{ $category->id }}">
                                    {{ $category->name }}</option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <div class="alert alert-danger mt-3">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    @error('tags.*')
                        <div class="alert alert-danger mt-3">
                            {{ $message }}
                        </div>
                    @enderror
                    <fieldset class="mb-3">
                        <legend>Tags</legend>
                    
                        @if ($errors->any())
                            @foreach ($tags as $tag)
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="{{ $tag->id }}" name="tags[]"
                                        {{ in_array($tag->id, old('tags', [])) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="flexCheckDefault">
                                        {{ $tag->name }}
                                    </label>
                                </div>
                            @endforeach
                        @else
                        
                            @foreach ($tags as $tag)
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="{{ $tag->id }}" name="tags[]"
                                        {{ $post->tags()->get()->contains($tag->id)? 'checked': '' }}>
                                    <label class="form-check-label" for="flexCheckDefault">
                                        {{ $tag->name }}
                                    </label>
                                </div>
                            @endforeach
                        @endif
                    </fieldset>

                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $post->title) }}">
                        @error('title')
                            <div class="alert alert-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="content" class="form-label">Content</label>
                        <textarea class="form-control" id="content" rows="3"
                            name="content">{{ $post->content }}</textarea>
                        @error('content')
                            <div class="alert alert-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    @if (!empty($post->image))
                        <div class="mb-3">
                            <img class="img-fluid" src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}">
                        </div>
                    @endif    
                    <div class="mb-3">
                        <label for="image" class="form-label">Small file input example</label>
                        <input class="form-control form-control-sm" id="image" name="image" type="file">
                    </div>
                    @error('image')
                        <div class="allert allert_danger mt-3">
                            {{ $message }}
                        </div>
                    @enderror    


                    <input type="submit" class="btn btn-primary" value="Salva">
                    <a class="btn btn-primary" href="{{ url()->previous() }}">Back</a>
                </form>
            </div>
        </div>
    </div>

@endsection