@extends('layouts.master')

@section('title')
    ESA: Login
@endsection

@section('content')
    @include('includes.message-block')
	

    <div class="row login">
        <div class="col-md-6 mx-auto" id="colcontainer">
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
	
	<script>
		
		if(navigator.userAgent.indexOf("MSIE") !== -1)
		{
			document.getElementById("colcontainer").innerHTML= "<div><h4 style='width:100%; height:100%;'>To Access This Feature Please Upgrade To The Latest Version Of Internet Explorer Or Switch To The Latest Version Of Google Chrome Or Firefox</h4><a href='https://www.google.com/chrome/' ><img src='uploads/chromeicon.png' alt='chrome' script='height:80px; width:80px;'></a><a href='https://www.mozilla.org/en-US/firefox/new/' ><img src='uploads/firefoxicon.png' alt='firefox' script='height:80px; width:80px;'></a></div>";
		}
	</script>

@endsection