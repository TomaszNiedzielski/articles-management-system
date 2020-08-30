@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-center">
        <div class="col-md-6">
            <h1 class="text-muted">The best authors of this week:</h1>
            @if(count($authors) > 0)
                <?php $index = 1 ?>
                @foreach($authors as $author)
                    <div class="m-3 p-2">
                        <h3>{{$index++}}. <a class="text-decoration-none" href="/users/{{$author->user_id}}">{{ $author->user_name }}</a> - {{ $author->articles_number }} articles</h3>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
@endsection