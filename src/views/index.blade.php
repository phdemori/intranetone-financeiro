@extends('IntranetOne::io.layout.dashboard')

{{-- page level styles --}}
@section('header_styles')
<link rel="stylesheet" type="text/css" href="{{ asset('io/services/io-financeiro.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/pickadate-full.min.css') }}">
@stop

@section('main-heading')
@stop

@section('main-content')
	<!--section ends-->
			@component('IntranetOne::io.components.nav-tabs',
			[
				"_id" => "default-tablist",
				"_active"=>0,
				"_tabs"=> [
					[
						"tab"=>"Listar",
						"icon"=>"ico ico-list",
						"view"=>"Financeiro::table-list"
					],
					[
						"tab"=>"Visualizar",
						"icon"=>"ico ico-eye",
						"view"=>"Financeiro::form"
					],
				]
			])
			@endcomponent
	<!-- content -->
  @stop

  @section('after_body_scripts')
  @endsection

@section('footer_scripts')
    <script src="{{ asset('js/pickadate-full.min.js') }}" type="text/javascript"></script>

    <script src="{{ asset('io/vendors/jquery.mask.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('io/vendors/jquery.autocomplete.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('io/vendors/select2/js/select2.min.js') }}" type="text/javascript"></script>

    <script src="{{ asset('io/services/io-financeiro-babel.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('io/services/io-financeiro-mix.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('io/services/io-financeiro.min.js') }}" type="text/javascript"></script>
@stop
