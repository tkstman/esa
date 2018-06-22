<nav class="col-md-2 d-none d-md-block bg-light sidebar navbar-fixed-top">
	<div style="padding-bottom: 10px;border-bottom: 1px solid red;padding-right: 5px;padding-left: 5px;">
		<form action="{{route('login')}}" method="post" id="searcher">
			<input class="form-control" type="text" name="searchapp" id="searchapp" placeholder="Search All Apps" style="font-size: 13px;margin-top: 10px;height: 30px;">
			{{Form::token()}}
		</form>
	</div>
  <div class="sidebar-sticky">
	<ul class="nav flex-column">     
<!--Print different user names-->	
	@foreach($sidebar as $side)		
	  <li class="nav-item slideout"  data-name="{{$side->user_id}}">
		<a class="nav-link arrow" href="{{'#'.$side->user_id}}">
		  <svg xmlns="http://www.w3.org/2000/svg" x="0" y="10px" width="24" height="24" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
		  {{$side->frst_nm . " " . $side->last_nm}}
		</a>
	  </li>
	  <br>
	@endforeach
	<li class="nav-item">
		<a class="nav-link arrow" href="#top">
		  <svg xmlns="http://www.w3.org/2000/svg" x="0" y="10px" width="24" height="24" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
		  BACK TO TOP
		</a>
	  </li>
    <li class="nav-item slideout" data-name="search" id="searchslide" style="display:none">
	</li>
	</ul>
  </div>
</nav>