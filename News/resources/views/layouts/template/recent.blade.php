<div class="col-lg-4 col-md-4">
    <div class="content_bottom_right">
      <div class="single_bottom_rightbar">
        <h2>New Post</h2>
        <ul class="small_catg popular_catg wow fadeInDown">

          @foreach ($newsposts as $newspost)
          <li>
            <div class="media wow fadeInDown"> <a href="#" class="media-left">
              <img src="public/uploads/post/{{ $newspost->image }}" alt=""> </a>
              <div class="media-body">
                <h4 class="media-heading"><a href="/{{$newspost->slug}}"><strong>{{ $newspost->name }}</strong></a></h4>
                <div class="comments_box"> 
                  <span class="meta_date">{{date('d/m/Y', strtotime($newspost->created_at))}}</span> 
                  <span class="meta_comment"><a href="#">No Comments</a></span>
                  <span class="meta_more"><a  href="/{{$newspost->slug}}">Read More...</a></span>
                </div>
              </div>
            </div>
          </li>
          @endforeach
        </ul>
        
        
      </div>


      <div class="single_bottom_rightbar">
        <ul role="tablist" class="nav nav-tabs custom-tabs">
          <li class="active" role="presentation"><a data-toggle="tab" role="tab" aria-controls="home" href="#mostPopular">Most Popular</a></li>
          <li role="presentation"><a data-toggle="tab" role="tab" aria-controls="messages" href="#recentComent">Recent Comment</a></li>
        </ul>
        <div class="tab-content">
          <div id="mostPopular" class="tab-pane fade in active" role="tabpanel">
            <ul class="small_catg popular_catg wow fadeInDown">
              <li>
                <div class="media wow fadeInDown"> <a class="media-left" href="#"><img src="images/112x112.jpg" alt=""></a>
                  <div class="media-body">
                    <h4 class="media-heading"><a href="#">Duis condimentum nunc pretium lobortis </a></h4>
                    <p>Nunc tincidunt, elit non cursus euismod, lacus augue ornare metus, egestas imperdiet nulla nisl quis mauris. Suspendisse a pharetra </p>
                  </div>
                </div>
              </li>
              <li>
                <div class="media wow fadeInDown"> <a class="media-left" href="#"><img src="images/112x112.jpg" alt=""></a>
                  <div class="media-body">
                    <h4 class="media-heading"><a href="#">Duis condimentum nunc pretium lobortis </a></h4>
                    <p>Nunc tincidunt, elit non cursus euismod, lacus augue ornare metus, egestas imperdiet nulla nisl quis mauris. Suspendisse a pharetra </p>
                  </div>
                </div>
              </li>
              <li>
                <div class="media wow fadeInDown"> <a class="media-left" href="#"><img src="images/112x112.jpg" alt=""></a>
                  <div class="media-body">
                    <h4 class="media-heading"><a href="#">Duis condimentum nunc pretium lobortis </a></h4>
                    <p>Nunc tincidunt, elit non cursus euismod, lacus augue ornare metus, egestas imperdiet nulla nisl quis mauris. Suspendisse a pharetra </p>
                  </div>
                </div>
              </li>
            </ul>
          </div>
          <div id="recentComent" class="tab-pane fade" role="tabpanel">
            <ul class="small_catg popular_catg">
              <li>
                <div class="media wow fadeInDown"> <a class="media-left" href="#"><img src="images/112x112.jpg" alt=""></a>
                  <div class="media-body">
                    <h4 class="media-heading"><a href="#">Duis condimentum nunc pretium lobortis </a></h4>
                    <p>Nunc tincidunt, elit non cursus euismod, lacus augue ornare metus, egestas imperdiet nulla nisl quis mauris. Suspendisse a pharetra </p>
                  </div>
                </div>
              </li>
              <li>
                <div class="media wow fadeInDown"> <a class="media-left" href="#"><img src="images/112x112.jpg" alt=""></a>
                  <div class="media-body">
                    <h4 class="media-heading"><a href="#">Duis condimentum nunc pretium lobortis </a></h4>
                    <p>Nunc tincidunt, elit non cursus euismod, lacus augue ornare metus, egestas imperdiet nulla nisl quis mauris. Suspendisse a pharetra </p>
                  </div>
                </div>
              </li>
              <li>
                <div class="media wow fadeInDown"> <a class="media-left" href="#"><img src="images/112x112.jpg" alt=""></a>
                  <div class="media-body">
                    <h4 class="media-heading"><a href="#">Duis condimentum nunc pretium lobortis </a></h4>
                    <p>Nunc tincidunt, elit non cursus euismod, lacus augue ornare metus, egestas imperdiet nulla nisl quis mauris. Suspendisse a pharetra </p>
                  </div>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </div>
      <div class="single_bottom_rightbar">
        <h2>Blog Archive</h2>
        <div class="blog_archive wow fadeInDown">
          <form action="#">
            <select>
              <option value="">Blog Archive</option>
              <option value="">October(20)</option>
            </select>
          </form>
        </div>
      </div>
      <div class="single_bottom_rightbar wow fadeInDown">
        <h2>Popular Lnks</h2>
        <ul>
          <li><a href="#">Blog</a></li>
          <li><a href="#">Blog Home</a></li>
          <li><a href="#">Error Page</a></li>
          <li><a href="#">Social link</a></li>
          <li><a href="#">Login</a></li>
        </ul>
      </div>
    </div>
  </div>
