@extends('layouts.admin')
@section('content')
<link rel="stylesheet" type="text/css" href="{{asset('frontend/template/css/style.css')}}">
<section id="mainContent">
    <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="error_page_content">
          <h1>403</h1>
          <h2>Sorry :(</h2>
          <h3>You don't have permission in this page! Please use another account!</h3>

          <button type="button" class="custom-btn btn-7"
                onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                <span><strong>{{ trans('global.login') }}</strong></span>
            </button>
        </div>
      </div>
    </div>
  </section>
@endsection