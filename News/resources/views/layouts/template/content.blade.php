@extends('layouts.index')
@section('content')
<section id="mainContent">
    <div class="content_bottom">
      <div class="col-lg-8 col-md-8">
        <div class="content_bottom_left">   
          @if(count($categories) > 0)
            @foreach ($categories as $category)
            <div class="single_category wow fadeInDown">
              <h2> <span class="bold_line"><span></span></span><span class="solid_line"></span> 
                <a class="title_text" href="#">{{$category->name}}</a>
              </h2>
              @foreach ($category->children_categories as $subCategory)
                <a class="title_text" href="#">{{$subCategory->name}}</a>
                <div class="business_category wow fadeInDown">
                  <ul class="small_catg">
                    <li>
                      @foreach ($subCategory->posts as $post)                  
                        <div class="business_category_left">
                          {{-- <ul class="small_catg wow fadeInDown"> --}}
                            {{-- <li> --}}
                              <div class="media wow fadeInDown"> 
                                  <a class="media-left" href="/{{$post->slug}}">
                                    <img src="public/uploads/post/{{ $post->image }}" alt="">
                                  </a>
                                  <div class="media-body">
                                    <h4 class="media-heading">
                                      <a href="/{{$post->slug}}">{!! $post->name !!}</a>
                                    </h4>
                                    <div>
                                      <p>{!! $post->title !!}</p>
                                    </div>
                                    <div class="comments_box">
                                      <span class="meta_date">{{date('d/m/Y', strtotime($post->created_at))}}</span>
                                      <span class="meta_comment"><a href="#"> Comments</a></span>
                                      <span class="meta_more"><a  href="/{{$post->slug}}">Read More...</a></span>
                                    </div>
                                  </div>
                              </div>
                            {{-- </li> --}}
                          {{-- </ul> --}}
                        </div>
                      @endforeach
                    </li>
                  </ul>
                </div>
              @endforeach
            </div>
            @endforeach
          @endif
        </div>
      </div>
      @include('layouts.template.recent')
    </div>
  </section>
  @endsection
