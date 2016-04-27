@extends('layouts.main')


@section('content')
    <div class="my-center">
        <div class="col-sm-2"></div>
        <div class="col-sm-8">
            <h3>Edit Profile</h3>
            <form id="sign-up-form" action="{{action('AuthorController@postEditProfile')}}" method="POST" enctype="multipart/form-data">
                <div id="error-message"></div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{$author->email}}" readonly>
                    <input type="hidden" id="_token" name="_token" value="{{csrf_token()}}">
                    <input type="hidden" id="code" name="code" value="{{$author->code}}">
                </div>
                <div class="form-group">
                    <label for="password">Password: <small>(Leave blank if unchanged)</small></label>
                    <input type="password" class="form-control" id="password" name="password" autocomplete="off">
                </div>
                <div class="form-group">
                    <label for="first_name">First Name:</label>
                    <input type="text" class="form-control" id="first_name" name="first_name" value="{{$author->first_name}}">
                </div>
                <div class="form-group">
                    <label for="last_name">Last Name:</label>
                    <input type="text" class="form-control" id="last_name" name="last_name" value="{{$author->last_name}}">
                </div>
                <div class="form-group">
                    <label for="last_name">Profile Picture:</label>
                    <label class="btn btn-default" for="my-file-selector">
                        <input id="my-file-selector" name="profile-picture" type="file" style="display:none;">
                        Browse for Pictures
                    </label>
                </div>
                <button type="submit" class="btn btn-default">Save</button>
            </form>
        </div>
        <div class="col-sm-2"></div>
    </div>
@endsection


@section('my-scripts')
    <script>
        $(document).ready(function() {
            $('#sign-up-form').submit(function(e){
                if ($('#email').val().length < 6) {
                    $('#error-message').html("Email is required.");
                    e.preventDefault();
                }
                if ($('#password').val().length > 0 && $('#password').val().length < 6) {
                    $('#error-message').html("Password must be 6 or more characters long.");
                    e.preventDefault();
                }
            });
        });
    </script>
@endsection