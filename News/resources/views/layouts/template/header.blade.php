<header id="header">
    <div class="row">
      <div class="col-lg-12 col-md-12">
        <div class="header_top">
          <div class="header_top_left">
            <ul class="top_nav">
              <li><a href="{{URL::to('/')}}">Home</a></li>
              <li><a href="#">About</a></li>
              <li><a href="{{URL::to('/contact')}}">Contact</a></li>
              <li><a href="{{URL::to('/404')}}">Error Page</a></li>
            </ul>
          </div>
          <div class="header_top_right">
            <form action="#" class="search_form">
              <input type="text" placeholder="Text to Search">
              <input type="submit" value="">
            </form>
          </div>
        </div>
        <div class="header_bottom">
          <div class="header_bottom_left"><a class="logo" href="{{URL::to('/')}}">News<strong>NVT</strong> <span>Always updated with news to you</span></a></div>
        </div>
      </div>
    </div>
  </header>
  <div id="navarea">
    <nav class="navbar navbar-default" role="navigation">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav custom_nav">
            <li class=""><a href="{{URL::to('/')}}">Home</a></li>
            @if(count($categories) > 0)
              @foreach ($categories as $category)
                  <li class="dropdown"> <a href="#" aria-expanded="false">{{$category->name}}</a>       
                  <ul class="dropdown-menu" role="menu">
                    @foreach ($category->children_categories as $subCategory)
                        <li><a href="/{{ $subCategory->slug }}.html">{{$subCategory->name}}</a></li>
                     @endforeach
                  </ul>
                  </li>
              @endforeach
            @endif
            <li><a href="{{URL::to('/contact')}}">Contact</a></li>
          </ul>
        </div>
      </div>
    </nav>
  </div>