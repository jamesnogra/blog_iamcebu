@extends('layouts.main')


@section('content')
    <div class="my-center">
        <div class="col-sm-2"></div>
        <div class="col-sm-8">
            <h3>Create New Author</h3>
            <form id="sign-up-form" action="{{action('AuthorController@postSignUp')}}" method="POST">
                <div id="error-message"></div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control" id="email" name="email">
                    <input type="hidden" id="_token" name="_token" value="{{csrf_token()}}">
                </div>
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" class="form-control" id="password" name="password">
                </div>
                <div class="form-group">
                    <label for="first_name">First Name:</label>
                    <input type="text" class="form-control" id="first_name" name="first_name">
                </div>
                <div class="form-group">
                    <label for="last_name">Last Name:</label>
                    <input type="text" class="form-control" id="last_name" name="last_name">
                </div>
                <button type="submit" class="btn btn-default">Sign Up</button>
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
                if ($('#password').val().length < 6) {
                    $('#error-message').html("Password must be 6 or more characters long.");
                    e.preventDefault();
                }
            });
        });
    </script>
@endsection