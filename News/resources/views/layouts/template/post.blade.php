@extends('layouts.index')
@section('content')
  <section id="mainContent">
    <div class="content_bottom">
      <div class="col-lg-12 col-md-12">
        <div class="content_bottom">
          <div class="technology_catrarea">
            <div class="single_category">
              <div class="archive_style_1">
                <h2><span class="bold_line"><span></span></span> <span class="solid_line"></span> 
                  <span class="title_text" href="#">{{$category->name}}</span> 
                </h2>
                  @if(count($posts) > 0)
                    @foreach ($posts as $post)
                      @foreach ($post->categories as $post_item)
                        @if($post_item->id == $parent_id)
                          <div class="business_category_left">
                            <ul class="small_catg wow fadeInDown">
                              <li>
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
                                  {{-- <span class="meta_date">{{$post->created_at}}</span>  --}}
                                  <span class="meta_date">{{date('d/m/Y', strtotime($post->created_at))}}</span>
                                  <span class="meta_comment"><a href="#"> Comments</a></span>
                                  <span class="meta_more"><a  href="/{{$post->slug}}">Read More...</a></span>
                                </div>
                                </div>
                                </div>
                              </li>
                            </ul>
                          </div>
                        @endif
                      @endforeach
                    @endforeach
                  @endif
              </div>
            </div>
          </div>
        </div>
        {{-- <div class="pagination_area">
          <nav>
            <ul class="pagination">
              <li><a href="#"><span aria-hidden="true">&laquo;</span><span class="sr-only">Previous</span></a></li>
              <li><a href="#">1</a></li>
              <li><a href="#">2</a></li>
              <li><a href="#">3</a></li>
              <li><a href="#">4</a></li>
              <li><a href="#">5</a></li>
              <li><a href="#"><span aria-hidden="true">&raquo;</span><span class="sr-only">Next</span></a></li>
            </ul>
          </nav>
        </div> --}}
      </div>
      {{-- @include('layouts.template.recent') --}}
    </div>
  </section>
@endsection