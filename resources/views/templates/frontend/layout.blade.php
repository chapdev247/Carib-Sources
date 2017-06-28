  @include('templates/frontend/partials/header')
  
  <div class="container">
  	@include('templates/frontend/partials/messages')
    @yield('mainBody')

  </div> <!-- /container -->
  @include('templates/frontend/partials/footer')
