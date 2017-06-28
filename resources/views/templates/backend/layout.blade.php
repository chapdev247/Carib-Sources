@include('templates/backend/partials/header')
@include('templates/backend/partials/top_menu')
<!-- BEGIN CONTAINER -->
<div class="page-container">
	@include('templates/backend/partials/sidebar')
	@yield('mainBody')
</div>
@include('templates/backend/partials/footer')