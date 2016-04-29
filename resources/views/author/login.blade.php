@extends('layouts.main')


@section('content')
    <div>
        <div class="col-sm-2"></div>
        <div class="col-sm-8">
            <h3>Login</h3>
            <form id="login-form" action="{{action('AuthorController@postLogin')}}" method="POST">
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
                <button type="submit" class="btn btn-default">Login</button>
            </form>
        </div>
        <div class="col-sm-2"></div>
    </div>
@endsection


@section('my-scripts')
    <script>
        $(document).ready(function() {
            $('#login-form').submit(function(e){
                if ($('#email').val().length < 6) {
                    $('#error-message').html("Email is required.");
                    e.preventDefault();
                }
                if ($('#password').val().length < 6) {
                    $('#error-message').html("Password must be 6 or more characters long.");
                    e.preventDefault();
                }
            });

            var error_code = {{$error_code}};
            if (error_code == 0) {
                $('#error-message').html("Incorrect login credentials. Please try again.");
            }
        });
    </script>
@endsection