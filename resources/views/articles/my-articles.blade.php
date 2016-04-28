@extends('layouts.main')


@section('content')
    <div>
        <h3>My Articles</h3>
        <a class="btn btn-default" href="{{url('/create-article')}}">Create New Article</a>
        <br /><br />
        <div id="all-my-articles">
            @foreach($articles as $article)
                <div class="each-article-container-in-my-articles card-shadow">
                    <div class="each-article-container-title">{{$article->title}}</div>
                    <div class="each-article-container-content my-center">
                        <a class="btn btn-default btn-xs" href="{{url('/'.$article->code.'/'.$article->title)}}"><span class="glyphicon glyphicon-search"></span> View</a>
                        <a class="btn btn-default btn-xs" href="{{url('create-article/'.$article->code)}}"><span class="glyphicon glyphicon-pencil"></span> Edit</a>
                        <a class="btn btn-danger btn-xs" href=""><span class="glyphicon glyphicon-trash"></span> Delete</a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection


@section('my-scripts')
    <script>
        $(document).ready(function() {

        });
    </script>
@endsection