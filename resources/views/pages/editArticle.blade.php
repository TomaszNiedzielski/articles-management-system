@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-center">
        <div class="col-md-6">
            <form action="update" method="POST">
                @csrf
                <h1 class="text-muted">Title</h1>
                @error('title')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <input type="text" name="title" class="form-control mb-3" placeholder="Write title..." value="{{ $article[0]->title }}">

                <h1 class="text-muted">Body</h1>
                @error('body')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <textarea name="body" class="form-control mb-3" placeholder="Write article..." rows="10">{{ $article[0]->body }}</textarea>
                
                <div class="d-flex flex-row-reverse">
                    <button class="btn btn-primary">Edit</button>
                </div>
            </form>
        </div>
    </div>
@endsection