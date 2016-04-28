@extends('layouts.main')


@section('content')
    <div>
        <h3>Create Article</h3>
        <a class="btn btn-default" href="{{url('/my-articles')}}">Back To My Articles</a>
        <form id="create-article-form" action="{{action('ArticleController@postCreateArticle')}}" method="POST" enctype="multipart/form-data">
            <div id="error-message"></div>
            <div class="form-group">
                <label for="title">Title:</label>
                <input type="text" class="form-control" id="title" name="title">
                <input type="hidden" id="_token" name="_token" value="{{csrf_token()}}">
            </div>
            <div class="form-group">
                <textarea name="content" id="content" rows="20" onkeyup="textAreaAdjust(this)" style="overflow:hidden"></textarea>
            </div>
            <div class="form-group">
                <label for="tags">Tags: <small>(Tags separated with commas.)</small></label>
                <input type="text" class="form-control" id="tags" name="tags">
            </div>
            <div class="form-group">
                <label for="password">Password: <small>(Leave blank if post is not password protected.)</small></label>
                <input type="password" class="form-control" id="password" name="password">
            </div>
            <button type="submit" class="btn btn-default">Post</button>
        </form>
    </div>
@endsection


@section('my-scripts')
    <script src="{{url('/js/tinymce/tinymce.min.js')}}"></script>
    <script>
        $(document).ready(function() {
            $('#create-article-form').submit(function(e){
                if ($('#title').val().length < 1) {
                    $('#error-message').html("Title is required.");
                    e.preventDefault();
                }
            });

            tinymce.init({
                selector: "textarea",
                // ===========================================
                // INCLUDE THE PLUGIN
                // ===========================================
                plugins: [
                    "advlist autolink lists link image charmap print preview anchor",
                    "searchreplace visualblocks code fullscreen",
                    "insertdatetime media table contextmenu paste jbimages",
                    "autoresize"
                ],
                // ===========================================
                // PUT PLUGIN'S BUTTON on the toolbar
                // ===========================================
                toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image jbimages",
                // ===========================================
                // SET RELATIVE_URLS to FALSE (This is required for images to display properly)
                // ===========================================
                relative_urls: false,
                autoresize_min_height: 200,
                autoresize_max_height: 2000,
            });
        });
        function textAreaAdjust(o) {
            o.style.height = "1px";
            o.style.height = (25+o.scrollHeight)+"px";
        }
    </script>
@endsection