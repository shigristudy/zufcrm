@php
$config = [
    'appName' => config('app.name'),
    'locale' => $locale = app()->getLocale(),
    'locales' => config('app.locales'),
    'githubAuth' => config('services.github.client_id'),
];
@endphp
<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="Vuexy admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords" content="admin template, Vuexy admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="PIXINVENT">
    <title>Fixed Layout - Vuexy - Bootstrap HTML admin template</title>
    <link rel="apple-touch-icon" href="{{ asset('app-assets/images/ico/apple-icon-120.png') }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('app-assets/images/ico/favicon.ico') }}">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600" rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/vendors.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/ui/prism.min.css') }}">
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/bootstrap-extended.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/colors.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/components.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/themes/dark-layout.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/themes/semi-dark-layout.css') }}">

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/core/menu/menu-types/vertical-menu.css') }}">
    <!-- END: Page CSS-->
    <style>

      /*! CSS Used from: https://pixinvent.com/demo/vuexy-html-bootstrap-admin-template/app-assets/vendors/css/tables/datatable/datatables.min.css */

div.dataTables_wrapper div.dataTables_filter {
    text-align: right;
}

div.dataTables_wrapper div.dataTables_filter label {
    font-weight: normal;
    white-space: nowrap;
    text-align: left;
}

div.dataTables_wrapper div.dataTables_filter input {
    margin-left: 0.5em;
    display: inline-block;
    width: auto;
}

@media screen and (max-width: 767px) {
    div.dataTables_wrapper div.dataTables_filter {
        text-align: center;
    }
}

div.dataTables_wrapper div.dataTables_filter label {
    margin-top: 1rem;
}

div.dataTables_wrapper div.dataTables_length label {
    font-weight: normal;
    text-align: left;
    white-space: nowrap;
}

div.dataTables_wrapper div.dataTables_length select {
    width: auto;
    display: inline-block;
}

@media screen and (max-width: 767px) {
    div.dataTables_wrapper div.dataTables_length {
        text-align: center;
    }
}


div.dataTables_wrapper div.dataTables_length label {
    margin-top: 1rem;
}

div.dataTables_wrapper div.dataTables_length select {
    background-position: calc(100% - 3px) 5px, calc(100% - 20px) 13px, 100% 0;
    padding: 0 .8rem;
}
table.dataTable thead .sorting:after, table.dataTable thead .sorting_asc:after, table.dataTable thead .sorting_desc:after {
    display: none;
}
table.dataTable thead .sorting:before, table.dataTable thead .sorting_asc:before, table.dataTable thead .sorting_desc:before{
    content: unset !important;
}

    </style>
    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">
    <!-- END: Custom CSS-->
</head>
<body class="vertical-layout vertical-menu-modern 2-columns navbar-sticky fixed-footer pace-done pace-done menu-expanded" data-open="click" data-menu="vertical-menu-modern" data-col="2-columns">
  <!-- BEGIN: Header-->
  <div class="content-overlay"></div>
  <div class="header-navbar-shadow"></div>
  <div id="app"></div>

  {{-- Global configuration object --}}
  <script>
    window.config = @json($config);
  </script>

  <script src="{{ asset('app-assets/vendors/js/vendors.min.js') }}"></script>
  <script src="{{ asset('app-assets/vendors/js/forms/select/select2.full.min.js') }}"></script>
  <!-- BEGIN Vendor JS-->
  <!-- BEGIN: Page Vendor JS-->
  <script src="{{ asset('app-assets/vendors/js/ui/prism.min.js') }}"></script>
  <!-- END: Page Vendor JS-->
  <!-- BEGIN: Theme JS-->
  <script src="{{ asset('app-assets/js/core/app-menu.js') }}"></script>
  <script src="{{ asset('app-assets/js/core/app.js') }}"></script>
  {{-- Load the application scripts --}}
  <script src="{{ mix('dist/js/app.js') }}"></script>
</body>
</html>
