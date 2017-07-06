<!-- BEGIN FOOTER -->
<div class="page-footer">
  <div class="page-footer-inner">
    2017 &copy; Carib Sources
  </div>
  <div class="scroll-to-top">
    <i class="icon-arrow-up"></i>
  </div>
</div>
<!-- END FOOTER -->
<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
<!-- BEGIN CORE PLUGINS -->
<script src="{{asset('public/')}}/theme/assets/global/plugins/jquery.min.js" type="text/javascript"></script>
<script src="{{asset('public/')}}/theme/assets/global/plugins/jquery-migrate.min.js" type="text/javascript"></script>
<!-- IMPORTANT! Load jquery-ui.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->
<script src="{{asset('public/')}}/theme/assets/global/plugins/jquery-ui/jquery-ui.min.js" type="text/javascript"></script>
<script src="{{asset('public/')}}/theme/assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="{{asset('public/')}}/theme/assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" type="text/javascript"></script>
<script src="{{asset('public/')}}/theme/assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<script src="{{asset('public/')}}/theme/assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
<script src="{{asset('public/')}}/theme/assets/global/plugins/jquery.cokie.min.js" type="text/javascript"></script>
<script src="{{asset('public/')}}/theme/assets/global/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>
<script src="{{asset('public/')}}/theme/assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="{{asset('public/')}}/theme/assets/global/plugins/flot/jquery.flot.min.js" type="text/javascript"></script>
<script src="{{asset('public/')}}/theme/assets/global/plugins/flot/jquery.flot.resize.min.js" type="text/javascript"></script>
<script src="{{asset('public/')}}/theme/assets/global/plugins/flot/jquery.flot.categories.min.js" type="text/javascript"></script>
<script src="{{asset('public/')}}/theme/assets/global/plugins/jquery.pulsate.min.js" type="text/javascript"></script>
<script src="{{asset('public/')}}/theme/assets/global/plugins/bootstrap-daterangepicker/moment.min.js" type="text/javascript"></script>
<script src="{{asset('public/')}}/theme/assets/global/plugins/bootstrap-daterangepicker/daterangepicker.js" type="text/javascript"></script>
<!-- IMPORTANT! fullcalendar depends on jquery-ui.min.js for drag & drop support -->
<script src="{{asset('public/')}}/theme/assets/global/plugins/fullcalendar/fullcalendar.min.js" type="text/javascript"></script>
<script src="{{asset('public/')}}/theme/assets/global/plugins/jquery-easypiechart/jquery.easypiechart.min.js" type="text/javascript"></script>
<script src="{{asset('public/')}}/theme/assets/global/plugins/jquery.sparkline.min.js" type="text/javascript"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="{{asset('public/')}}/theme/assets/global/scripts/metronic.js" type="text/javascript"></script>
<script src="{{asset('public/')}}/theme/assets/admin/layout/scripts/layout.js" type="text/javascript"></script>
<script src="{{asset('public/')}}/theme/assets/admin/layout/scripts/quick-sidebar.js" type="text/javascript"></script>
<script src="{{asset('public/')}}/theme/assets/admin/layout/scripts/demo.js" type="text/javascript"></script>
<script src="{{asset('public/')}}/theme/assets/admin/pages/scripts/index.js" type="text/javascript"></script>
<script src="{{asset('public/')}}/theme/assets/admin/pages/scripts/tasks.js" type="text/javascript"></script>
<!-- END PAGE LEVEL SCRIPTS -->
<script>
jQuery(document).ready(function() {    
   Metronic.init(); // init metronic core componets
   Layout.init(); // init layout
   QuickSidebar.init(); // init quick sidebar
   Demo.init(); // init demo features
   Index.init();   
   Index.initDashboardDaterange();
   Index.initJQVMAP(); // init index page's custom scripts
   Index.initCalendar(); // init index page's custom scripts
   Index.initCharts(); // init index page's custom scripts
   Index.initChat();
   Index.initMiniCharts();
   Tasks.initDashboardWidget();
});
</script>
<script>
  $(document).ready(function(){
      $('[data-toggle="tooltip"]').tooltip();   
  });
  // setTimeout(function(){ $(".alert").fadeOut(2000,"swing", function(){ $(this).remove();}); }, 2000);
  var slugify = function(ele,f_name) {
    var str = ele.value;
    str = str.replace(/^\s+|\s+$/g, ''); // trim
    str = str.toLowerCase();

    // remove accents, swap ñ for n, etc
    var from = "ãàáäâẽèéëêìíïîõòóöôùúüûñç·/_,:;";
    var to   = "aaaaaeeeeeiiiiooooouuuunc------";
    for (var i=0, l=from.length ; i<l ; i++) {
        str = str.replace(new RegExp(from.charAt(i), 'g'), to.charAt(i));
    }

    str = str.replace(/[^a-z0-9 -]/g, '') // remove invalid chars
    .replace(/\s+/g, '-') // collapse whitespace and replace by -
    .replace(/-+/g, '-'); // collapse dashes
    document.getElementsByName(f_name)[0].value = str;
  };
  var show_hide = function(id,show) {
    if (show) 
      $("#"+id).show();
    else
      $("#"+id).hide();
  };
</script>

@yield("scripts")
<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>