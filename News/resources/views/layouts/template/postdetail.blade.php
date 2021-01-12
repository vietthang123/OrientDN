@extends('layouts.index')
@section('content')
  <section id="mainContent">
    <div class="content_bottom">
      <div class="col-lg-12 col-md-8">
        <div class="content_bottom">
          <div class="single_page_area">

            <ol class="breadcrumb">
              <li><a href="{{URL::to('/')}}">Home</a></li>
              <li><a href="/{{$category->slug}}.html">{{$category->name}}</a></li>
              <li class="active">{!! $post->name !!}</li>
            </ol>

            <h2 class="post_titile">{!! $post->name !!} </h2>
            <div class="single_page_content">
              <div class="post_commentbox"> <a href="#"><i class="fa fa-user"></i>{{ $post->user->name ?? '' }}</a> <span><i class="fa fa-calendar"></i>
                {{date('d/m/Y', strtotime($post->created_at))}}</span> <a href="#"><i class="fa fa-tags"></i>{{$category->name}}</a> </div>
              <img  alt="" src="public/uploads/post/{{ $post->image }}" style="display: block; margin-left: auto; margin-right: auto;" >
              <blockquote><p>{!! $post->title !!}</p></blockquote>
              <p>{!! $post->content !!}</p>
            </div>
          </div>
        </div>
        
        <div class="share_post"> <a class="facebook" href="#"><i class="fa fa-facebook"></i>Facebook</a> <a class="twitter" href="#"><i class="fa fa-twitter"></i>Twitter</a> <a class="googleplus" href="#"><i class="fa fa-google-plus"></i>Google+</a> <a class="linkedin" href="#"><i class="fa fa-linkedin"></i>LinkedIn</a> <a class="stumbleupon" href="#"><i class="fa fa-stumbleupon"></i>StumbleUpon</a> <a class="pinterest" href="#"><i class="fa fa-pinterest"></i>Pinterest</a> </div>
        
        <div class="fb-comments" data-href="{{$link_comment}}" data-width="100%" data-numposts="20" data-lazy="true"></div>
        
        <div class="similar_post">
          <h2>Similar Post You May Like <i class="fa fa-thumbs-o-up"></i></h2>
          <ul class="small_catg similar_nav wow fadeInDown animated">

            @foreach ($similar as $post_similar)
            <li>
              <div class="media wow fadeInDown animated" style="visibility: visible; animation-name: fadeInDown;"> 
                <a class="media-left related-img" href="#">
                  <img src="public/uploads/post/{{ $post_similar->image }}" alt=""></a>
                <div class="media-body">
                  <h4 class="media-heading"><a href="/{{$post_similar->slug}}">{!! $post_similar->name!!}</a></h4>
                  <div class="comments_box"> 
                    {{-- <span class="meta_date">{{$post->created_at}}</span>  --}}
                    <span class="meta_date">{{date('d/m/Y H:i', strtotime($post_similar->created_at))}}</span>
                    <span class="meta_comment"><a href="#"> Comments</a></span>
                    <span class="meta_more"><a  href="/{{$post_similar->slug}}">Read More...</a></span>
                  </div>
                </div>
              </div>
            </li>
            @endforeach

          </ul>
        </div>
      </div>
      {{-- @include('layouts.template.recent') --}}
    </div>
  </section>
@endsection
