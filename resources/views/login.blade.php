@extends('layouts.master')

@section('title')
    ESA: Login
@endsection

@section('content')
    @include('includes.message-block')

    <div class="row login">
        <div class="col-md-6 mx-auto">
            <h3>Login</h3>
            <div class="jumbotron login">
            <form action="{{route('login')}}" method="post">
                <div class="form-group  {{$errors->has('user_name') ? 'has-danger' : '' }}">
                    <label for="user_name">Username</label>
                    <input class="form-control" type="text" name="user_name" id="user_name" value="{{ Request::old('user_name') }}">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input class="form-control" type="password" name="password" id="password">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
                {{Form::token()}}
            </form>
                </div>
        </div>
    </div>

@endsection