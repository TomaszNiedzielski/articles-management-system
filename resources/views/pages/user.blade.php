@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-center">
        <div class="col-md-6">
            @include('inc.articles', ['articles' => $articles])
        </div>
    </div>
@endsection
