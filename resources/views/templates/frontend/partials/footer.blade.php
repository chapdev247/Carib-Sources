  <footer class="site-footer">
    <div class="container">
      <div class="row">
          <div class="col-md-3">
           <div class="footer-block">
            <div class="header footerlogo">
             <a class="" href="{{ url('/') }}">
             <img src="{{asset('public')}}/img/logo-white.png" class="img-responsive">
             </a>
            </div>
          <div class="row">
           <div class="col-md-6">
              <ul class="footer-link">
                <li><a href="#aboutus">About Us</a></li>
                <li><a href="#how_it_works">How It Works</a></li>
                <li><a href="#contactus">Contact Us</a></li>
                <li><a href="#faq">FAQs</a></li>
              </ul>
           </div>
           <div class="col-md-6">
              <ul class="footer-link">
                <li><a href="http://205.134.251.196/~examin8/CI/Qipost_dev/shipment/tracking">Buyers</a></li>
                <li><a href="#find_service_point">Suppliers</a></li>
                                     
              </ul>
           </div>
          </div>
           </div>
           <div class="clearfix"></div>
           <div class="footer-social">
              <ul class="list-inline">
                  <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                  <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                  <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                  <li><a href="#"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>
              </ul>
           </div>
          </div>
          <div class="col-md-6">
           <div class="footer-block">
           <h3 class="header">Browse Categories</h3>
           <div class="row">
           <div class="col-md-6">
              <ul class="footer-link">
                  <li class="">
                    <a href="product-list.php">Machinery</a>
                  </li>
                  <li class=""><a href="#">Consumer Electronics</a></li>
                  <li><a href="product-list.php">Automobiles &amp; Motorcycles</a></li>
                  <li><a href="product-list.php">Apparel</a></li>

              </ul>
           </div>
           <div class="col-md-6">
              <ul class="footer-link">
                <li><a href="product-list.php">Home &amp; Garden</a></li>
                <li class=""><a href="product-list.php">Packaging &amp; Printing</a></li>
                <li class=""><a href="product-list.php">Sports &amp; Entertainment</a></li>
                <li class=""><a href="product-list.php">All Categories</a></li>                
              </ul>
           </div>
           </div>
           </div>
          </div>
          <div class="col-md-3">
           <div class="footer-block">                
            <h3 class="header">Contact Us</h3>  
            <div class="footer-contact-us">
              <ul>
                <li><span class="icon"><i class="fa fa-map-marker fa-fw" aria-hidden="true"></i></span> 1234 Sed ut perspiciatis Road</li>
                <li><span class="icon"><i class="fa fa-phone fa-fw" aria-hidden="true"></i></span> 
                <span><a href="tel:49 731 456789">+49 731 456789</a></span>
                </li>
                <li>
                  <span class="icon"><i class="fa fa-envelope fa-fw" aria-hidden="true"></i></span> 
                  <a href="mailto:support@qipost.com">support@caribsource.com</a>
                </li>
              </ul>   
            </div>
           </div>
          </div>
      </div>
    </div>
  </footer>
  <div class="copyright">
    <div class="container">
      <div class="text-center">
        <ul class="list-inline no-margin">
          <li>Copyright © Carib Sources 2017</li>
          <li><a href="#">Terms and Condition</a></li><!-- base_url('home/terms'); -->
          <li><a href="#">Privacy policy</a></li><!-- base_url('shipment/privacy'); -->
        </ul>
      </div>
    </div>
  </div>
  <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <!-- Include all compiled plugins (below), or include individual files as needed -->
  <script type="text/javascript" src="{{asset('public')}}/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="{{asset('public')}}/js/slick.min.js"></script>
  <script type="text/javascript" src="{{asset('public')}}/js/wow.min.js"></script>
  <script type="text/javascript" src="{{asset('public')}}/js/accordionmenu.js"></script>
  <script type="text/javascript" src="{{asset('public')}}/js/theme.js"></script>
  <script type="text/javascript" src="{{asset('public')}}/js/jquery.bvalidator.js"></script>
  <script type="text/javascript" src="{{asset('public')}}/js/jquery.maskedinput.min.js"></script>
  <script>
    $(document).ready(function(){
      $('.phone_number_format').mask("9999 99 9999");
      $('.zip_code').mask("99999");
    });
    var options = {
      singleError: true,
    };
    $("form").bValidator(options);
    ///setTimeout(function(){ $(".alert").fadeOut(2000,"swing", function(){ $(this).remove();}); }, 2000);
  </script>
  @yield("scripts")
  </body>
</html>