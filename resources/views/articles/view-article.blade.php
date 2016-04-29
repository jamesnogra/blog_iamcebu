@extends('layouts.main')


@section('content')
    <div>

        <div class="card-shadow">
            <div class="each-article-container-title">{{$article->title}}</div>
            <div class="each-article-container-content">
                <small>Date Posted: {!! $article->created_at !!}</small>
                <div class="view-article-content">{!! $article->content !!}</div>
                @if (!empty($article->tags))
                    <small>Tags:</small>
                    <?php
                        $tempTags = $article->tags;
                        $tempArrayTags = explode(",", $tempTags);
                        foreach ($tempArrayTags as $tag) {
                            if (strlen($tag) > 1) {
                                echo '<a class="btn btn-default btn-xs tags-button" href="'.url('/articles/tag').'/'.trim($tag).'">'.trim($tag).'</a>';
                            }
                        }
                    ?>
                @endif
            </div>
        </div>

        <br />

        <div class="card-shadow">
            <div class="each-article-container-title">Comments</div>
            <div class="each-article-container-content">
                <form id="add-comment-form" action="{{action('CommentController@postComment')}}" method="POST" enctype="multipart/form-data">
                    <div id="error-message"></div>
                    <div class="form-group">
                        <input type="hidden" class="form-control" id="id" name="id" value="{{$article->id}}">
                        <input type="hidden" class="form-control" id="code" name="code" value="{{$article->code}}">
                        <input type="hidden" class="form-control" id="author_id" name="author_id" value="{{$article->author_id}}">
                        <input type="hidden" id="_token" name="_token" value="{{csrf_token()}}">
                    </div>
                    <div class="form-group">
                        <label for="name">Name: <small></small></label>
                        <input type="text" class="form-control" id="name" name="name">
                    </div>
                    <div class="form-group">
                        <label for="website">Website/Blog: <small></small></label>
                        <input type="text" class="form-control" id="website" name="website">
                    </div>
                    <div class="form-group">
                        <label for="comment">Comment: <small></small></label>
                        <textarea name="comment" id="comment" class="form-control" rows="4" style="resize:none;"></textarea>
                    </div>
                    <button type="submit" class="btn btn-default">Post</button>
                </form>
                @foreach($comments as $comment)
                    <hr />
                    @if(empty($comment->website))
                        <strong>{{$comment->name}}</strong>
                    @else
                        <strong><a href="{{$comment->website}}">{{$comment->name}}</a></strong>
                    @endif
                    <p>{{$comment->comment}}</p>
                    <p>
                        @if ((isset(Auth::user()->id)) && (Auth::user()->id == $article->author_id))
                            <a class="btn btn-danger btn-xs" href="{{url('/comment/delete/'.$comment->code.'/'.$comment->id)}}">Delete Comment</a>
                        @endif
                        <small>{{$comment->created_at}}</small>
                    </p>
                @endforeach
            </div>
        </div>

    </div>
@endsection


@section('my-scripts')
    <script>
        $(document).ready(function() {
            $('#add-comment-form').submit(function(e){
                if ($('#name').val().length < 1) {
                    $('#error-message').html("Name is required.");
                    e.preventDefault();
                }
                if ($('#comment').val().length < 1) {
                    $('#error-message').html("Comment is required.");
                    e.preventDefault();
                }
            });
        });
    </script>
@endsection