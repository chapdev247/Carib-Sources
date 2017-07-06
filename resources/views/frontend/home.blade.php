@extends('templates/frontend/layout')
@section('title',$data["title"])

@section('mainBody')
    

<!--Banner Container-->
<div class="banner-container home-slider-header">
    <ul class="home-slider no-padding">
      <li>
        <div class="home-banner-img">
            <a href="#"><img src="{{asset('public')}}/img/Marketplace-Overviews.png" height="500"></a>
        </div>
        <div class="slider-caption">
            <div class="theme-container">
                <div class="row">
                    <div class="col-xs-12 col-sm-8 col-md-9">
                        <div class="content-text">
                            <div class="caption-heading">Custom Apparel for Organizations</div>
                            <p>Promote your cause & raise money for your organization</p>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-4 col-md-3">
                        <div class="caption-link">
                            <a class="btn btn-orange learnmore_link" href="#">Learn More</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
      </li>
      <li>
        <div class="home-banner-img">
            <a href="#"><img src="{{asset('public')}}/img/Marketplace-Overviews.png" height="500"></a>
        </div>
        <div class="slider-caption">
            <div class="theme-container">
                <div class="row">
                    <div class="col-xs-12 col-sm-8 col-md-9">
                        <div class="content-text">
                            <div class="caption-heading">Custom Apparel for Organizations Promote your cause & raise money for your organization</div>
                            <p>Promote your cause & raise money for your organization Promote your cause & raise money for your organization</p>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-4 col-md-3">
                        <div class="caption-link">
                            <a class="btn btn-orange learnmore_link" href="#">Learn More</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
      </li>
    </ul>
</div>

<!---========home-info-section========-->
<div class="section-white">
    <div class="home-info-section">
        <div class="theme-container">
            <h3 class="main-heading text-center">
                Join a creative marketplace where <strong>29 million</strong> buyers around <br>the world shop for unique items
            </h3>
            <div class="row">
                <div class="col-md-3">
                    <div class="tile text-center">
                        <div class="tile-img">
                            <a href="#"><img src="{{asset('public')}}/img/support.svg"></a>
                        </div>
                        <div class="content">
                            <header>Talk to us</header>
                            <p>
                                Reach our support staff by email or request a phone call whenever you have a question.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="tile text-center">
                        <div class="tile-img">
                            <a href="#"><img src="{{asset('public')}}/img/handbook.svg"></a>
                        </div>
                        <div class="content">
                            <header>Talk to us</header>
                            <p>
                                Reach our support staff by email or request a phone call whenever you have a question.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="tile text-center">
                        <div class="tile-img">
                            <a href="#"><img src="{{asset('public')}}/img/newsletter.svg"></a>
                        </div>
                        <div class="content">
                            <header>Talk to us</header>
                            <p>
                                Reach our support staff by email or request a phone call whenever you have a question.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="tile text-center">
                        <div class="tile-img">
                            <a href="#"><img src="{{asset('public')}}/img/advice.svg"></a>
                        </div>
                        <div class="content">
                            <header>Talk to us</header>
                            <p>
                                Reach our support staff by email or request a phone call whenever you have a question.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!---========home-info-section========-->

<!--FEATURED PRODUCT SLIDER-->
@if(count($data["featured"])>0)
    <div class="section-white featured-product-block">
        <div class="theme-container home-slide-block">
         <div class="header">
            <h1 >Featured Product</h1>
         </div>
         <div class="right-section">
          <ul class="featured-product-slide no-padding">
            @foreach($data["featured"] as $f_key => $f_product)
                <li class="">
                    <div class="prdoct-slide-tile">
                        {{-- {{ json_decode($f_product->thumb_image)}} --}}
                        <a href="product-list.php" title="Sink">
                            <div class="img_product"> 
                                @if(count(json_decode($f_product->thumb_image))>0)
                                    <img src="{{asset('public').'/'.json_decode($f_product->thumb_image)[0]}}" class="img-responsive" title="{{$f_product->name}}">
                                @else
                                    <img src="{{asset('public')}}/img/default-thumbnail.jpg" class="img-responsive">
                                @endif
                            </div>
                        </a>
                        <div class="info">
                            <h2 class="product-name"><a href="product-list.php" title="Sink" class="a_blue font_bold">{{$f_product->name}}</a></h2>
                            <h4 class="prod_price">{{$f_product->category->name}}</h4>
                        </div>
                    </div>
                </li>             
            @endforeach
         </ul>
         </div>
         <div class="clearfix"></div>
         <br>
         <div class="text-center"><a href="#" class="btn btn-orange">View All Products</a></div>
         <br>
        </div>
    </div>
@endif

@if(count($data["latest"])>0)
<div class="section-white">
    <div class="theme-container home-slide-block">
        <div class="header">
            <h1 class="">Latest Product</h1>
        </div>
        <div class="right-section">
            <ul class="featured-product-slide no-padding">
                @foreach($data["latest"] as $l_key => $l_product)
                <li class="">
                    <div class="prdoct-slide-tile">
                        <a href="product-list.php" title="Sink">
                            <div class="img_product">
                            @if(count(json_decode($l_product->thumb_image))>0)
                                <img src="{{asset('public').'/'.json_decode($l_product->thumb_image)[0]}}" class="img-responsive" title="{{$l_product->name}}">
                            @else
                                <img src="{{asset('public')}}/img/default-thumbnail.jpg" class="img-responsive">
                            @endif
                            </div>
                        </a>
                        <div class="info">
                        <h2 class="product-name"><a href="product-list.php" title="Sink" class="a_blue font_bold">{{$l_product->name}}</a></h2>
                            <h4 class="prod_price">{{$l_product->category->name}}</h4>
                        </div>
                    </div>
                </li> 
                @endforeach
            </ul>
        </div>
        <div class="clearfix"></div>
        <br>
        <div class="text-center"><a href="#" class="btn btn-orange">View All Products</a></div>
        <br>
    </div>
</div>
@endif
<div class="clearfix"></div>

<!--===========SELLING SECTION===============-->

<div class="feature-plan-section">
 <div class="theme-container">
  <div class="feature-plan-block">
    <div class="col-md-4">
        <div class="feature-plan-tile">
         <header>Free Seller</header>
         <div class="fee">Free</div>
         <div class="feature-plan-content">
          <ul>
            <li><span class="icon">Ability to quote buying requests</span></li>
            <li><span class="icon">Recive Notification on quote</span></li>
            <!-- <li><span class="icon"><img src="{{asset('public')}}/img/cross-delete.svg" width="34"></span>Verified Seller icon</li>
            <li><span class="icon"><img src="{{asset('public')}}/img/cross-delete.svg" width="34"></span>Listed above free users in search results </li> -->
          </ul>
         </div>
         <div class="feature-plan-footer"><a href="#" class="btn btn-gray">Get It Now</a></div> 
        </div>
    </div>
    <div class="col-md-4">
        <div class="feature-plan-tile premium-plan-title">
         <header class="premium-head">Premium Seller</header>
         <div class="fee">$294.00<span>/Year</span></div>
         <div class="feature-plan-content">
          <ul>
            <li><span class="icon">Ability to quote buying requests</span></li>
            <li><span class="icon">Recive Notification on  quote</span></li>
            <li><span class="icon">Verified Seller icon</span></li>
            <li><span class="icon">Listed above free users in search results</span></li>            
          </ul>
         </div>
        <div class="feature-plan-footer"><a href="#" class="btn btn-gray">Get It Now</a></div>           
        </div>
    </div>
    <div class="col-md-4">
        <div class="feature-plan-tile">
         <header>Featured Products</header>
         <div class="fee">$50.00<span>/Month</span></div>
         <div class="feature-plan-content">
          <ul>
            <li><span class="icon">Listed at the top in search results</span></li>
            <li><span class="icon">Show Products as Home page Featured List</span></li>
            <!-- <li><span class="icon"><img src="{{asset('public')}}/img/check-arrow.svg" width="34"></span>Listed at the top in search results</li>
            <li><span class="icon"><img src="{{asset('public')}}/img/check-arrow.svg" width="34"></span>Show Products as Home page Featured List</li> -->
          </ul>
         </div>
         <div class="feature-plan-footer"><a href="#" class="btn btn-gray">Get It Now</a></div>          
        </div>
    </div>
    <div class="clearfix"></div>
  </div>
 </div>
</div>

<!-- <section class="home-register-section text-center">
        <div class="home-register-content">
            <h2>Ready to start selling?</h2>
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 col-sm-10 col-md-7 col-lg-6 center-block">
                        <p>
                            With no monthly membership costs and low fees, selling on Etsy is a low risk way to start your online business. Start selling today.
                        </p>
                    </div>
                </div>
                <a href="#" class="btn btn-white btn-lg">Open your CaribSources shop</a>
            </div>
        </div>
</section> -->

<div class="section-white">
 <div class="theme-container">
  <div class="row success-story-block ">
    <div class="col-md-12">
     <div class="heading">
      <h3 class="text-uppercase text-center "><span>success story</span></h3>
<!--       <p class="text-center">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod</p> -->
     </div>
       <ul class="succes-slider">
        <li>
            <div class="side-block">       
                <div class="user-comment">
                    <div class="testimonials-text">
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation</p>
                    </div>
                    <div class="user-img">
                        <img src="{{asset('public')}}/img/user-review-default.svg" class="img-circle">
                    </div>
                    <div class="user-name">
                        <b>Someone famous</b>
                        <div><font class="sub-title">millions dream</font></div>
                    </div>
                </div>
            </div>
        </li>
        <li>
            <div class="side-block">       
                <div class="user-comment">
                    <div class="testimonials-text">
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation</p>
                    </div>
                    <div class="user-img">
                        <img src="{{asset('public')}}/img/user-review-default.svg" class="img-circle">
                    </div>
                    <div class="user-name">
                        <b>Someone famous</b>
                        <div><font class="sub-title">millions dream</font></div>
                    </div>
                </div>
            </div>
        </li>
        <li>
            <div class="side-block">       
                <div class="user-comment">
                    <div class="testimonials-text">
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation</p>
                    </div>
                    <div class="user-img">
                        <img src="{{asset('public')}}/img/user-review-default.svg" class="img-circle">
                    </div>
                    <div class="user-name">
                        <b>Someone famous</b>
                        <div><font class="sub-title">millions dream</font></div>
                    </div>
                </div>
            </div>
        </li>
                        <li>
            <div class="side-block">       
                <div class="user-comment">
                    <div class="testimonials-text">
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation</p>
                    </div>
                    <div class="user-img">
                        <img src="{{asset('public')}}/img/user-review-default.svg" class="img-circle">
                    </div>
                    <div class="user-name">
                        <b>Someone famous</b>
                        <div><font class="sub-title">millions dream</font></div>
                    </div>
                </div>
            </div>
        </li>
        
       </ul>
    </div>
  </div>
 </div>
</div>
@endsection