@extends('layouts.main')


@section('content')
    <div>
        <div class="card-shadow">
            <div class="each-article-container-title">{{$article->title}}</div>
            <div class="each-article-container-content">
                <small>Date Posted: {!! $article->created_at !!}</small>
                <div class="view-article-content">{!! $article->content !!}</div>
                @if (!empty($article->tags))
                    <small>Tags: {!! $article->tags !!}</small>
                @endif
            </div>
        </div>
    </div>
@endsection


@section('my-scripts')
    <script>
        $(document).ready(function() {

        });
    </script>
@endsection