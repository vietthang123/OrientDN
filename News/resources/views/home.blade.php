@extends('layouts.admin')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="container">
          <div class="background-img">
            <div class="row">
            <!-- Posts weekly -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="post-statistic card border-left-primary shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                <span class="content-color">{{ trans('cruds.post.title') }}</span>
              </div>
              <div class="h5 mb-0 font-weight-bold text-gray-800">
                <span class="content-color">{{$posts}}</span>
              </div>
            </div>
            <div class="col-auto">
              <i class="content-color fas fa-newspaper fa-2x"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="category-statistic card border-left-success shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                <span class="content-color">{{ trans('cruds.category.title') }}</span>
              </div>
              <div class="h5 mb-0 font-weight-bold text-gray-800">
                <span class="content-color">{{$categories}}</span>
              </div>
            </div>
            <div class="col-auto">
              {{-- <i class="fas fa-dollar-sign fa-2x text-gray-300"></i> --}}
              <i class="content-color fas fa-align-justify fa-2x"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="user-statistic card border-left-info shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                <span class="content-color">{{ trans('cruds.user.title') }}</span>
              </div>
              <div class="row no-gutters align-items-center">
                <div class="col-auto">
                  <div class="content-color h5 mb-0 mr-3 font-weight-bold text-gray-800">
                    <span class="content-color">{{$users}}</span>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-auto">
              <i class="content-color fas fa-user fa-2x"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Pending Requests Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="comment-statistic card border-left-warning shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                <span class="content-color">{{ trans('cruds.role.title') }}</span>
              </div>
              <div class="h5 mb-0 font-weight-bold text-gray-800">
                <span class="content-color">{{$roles}}</span>
              </div>
            </div>
            <div class="col-auto">
              <i class="content-color fas fa-briefcase fa-2x"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
                <div class="box">
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                    <div class="content">
                      {{-- <h2>My animated Border </h2> --}}
                      <p><a href="http://www.cakecounter.com/" style="color:#00ffe9;" target="_blank">
                        {{ trans('cruds.home.title') }}
                      @if(Auth::check())
                        <Strong style="color: yellow">{{Auth::user()->name}}</Strong>
                      @endif    
                      </a></p>

                      @can('post_access')
                      <button type="button" class="custom-btn btn-15"
                        onclick="location.href='{{ route('admin.posts.index') }}'">
                        <strong>{{ trans('cruds.post.title') }}</strong>
                      </button>
                      @endcan
                      <p></p>
                      @can('category_access')
                      <button type="button" class="custom-btn btn-15"
                        onclick="location.href='{{ route('admin.categories.index') }}'">
                        <strong>{{ trans('cruds.category.title') }}</strong>
                      </button>
                      @endcan
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
