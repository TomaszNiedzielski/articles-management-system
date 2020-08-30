@if(count($articles) > 0)
    @foreach($articles as $article)
        <div class="row justify-content-center">
            <div class="col-md-12 card mb-3 p-3">
                <h1 class="text-muted card-header"><a href="/article/{{$article->id}}">{{ $article->title }}</a></h1>
                <p class="card-body">
                    {{ $article->body }}
                </p>
                <div class="d-flex justify-content-between align-items-center">
                    @auth
                        @if(auth()->user()->id == $article->user_id)
                            <a href="article/{{$article->id}}/edit" class="btn btn-default">edit</a>
                        @else
                            <span></span>
                        @endif
                        <small>created at {{ $article->created_at }} by <a href={{ auth()->user()->id != $article->user_id ? '/users/'.$article->user_id : '/home' }}>{{ $article->user_name }}</a></small>
                    @else
                        <span></span>
                        <small>created at {{ $article->created_at }} by <a href={{'/users/'.$article->user_id }}>{{ $article->user_name }}</a></small>                
                    @endauth
                </div>
            </div>
        </div>
    @endforeach

    @if(isset($articles->current_page))
        {{ $articles->links() }}
    @endif

    @else
        <h1>No articles found.</h1>
@endif