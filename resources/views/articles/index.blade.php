@extends('layouts.main')

@section('content')
    <div>
        @foreach($articles as $article)
            <div class="card-shadow">
                <a href="{{url('/'.$article->code.'/'.$article->title)}}">
                    <div class="each-article-container-title">{{$article->title}}</div>
                </a>
                <div class="each-article-container-content">
                    <small>Date Posted: {!! $article->created_at !!}</small>
                    <div class="view-article-content">{!! $article->content !!}</div>
                    <a class="btn btn-default" href="{{url('/'.$article->code.'/'.$article->title)}}">Post Comment</a>
                    @if (!empty($article->tags))
                        <p><small>Tags:</small></p>
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
        @endforeach
    </div>
    <div class="my-center">{!! $articles->appends(['sort' => 'id'])->render() !!}</div>
@endsection