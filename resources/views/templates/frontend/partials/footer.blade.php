	<footer class="footer">
      <div class="container">
        <p class="text-muted">Footer text</p>
      </div>
    </footer>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.4/angular.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/angular-ui-router/1.0.3/angular-ui-router.min.js"></script>
    {!! Html::script("public/js/main.js") !!}
    {{-- {!! Html::script("public/js/directive.js") !!} --}}
    <script>
      $(document).ready(function(){
          $('[data-toggle="tooltip"]').tooltip();   
      });
      setTimeout(function(){ $(".alert").fadeOut(2000,"swing", function(){ $(this).remove();}); }, 2000);
    </script>
    @yield("scripts")
  </body>
</html>