<?php
use App\Models\Setting;
$settings = Setting::first();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Dashboard</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="" content="">
    <meta name="author" content="pixelstrap">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="icon" href="{{ asset('storage/' . $settings->favicon) }}" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('storage/' . $settings->favicon) }}" type="image/x-icon">
    <link rel="preconnect" href="https://fonts.googleapis.com/">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <style>
        .select2-container--default .select2-selection--multiple .select2-selection__choice {
            background-color: #fd7e14 !important;
            border: none !important;
            color: #fff !important;
            border-radius: 0.25rem !important;
            margin-top: 4px !important;
            padding: 3px 10px 3px 8px !important;
            display: inline-flex !important;
            align-items: center !important;
            justify-content: center !important;
            gap: 3px !important;
            float: none !important;
        }

        .select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
            order: 2 !important;
            background: transparent !important;
            color: #fff !important;
            border: none !important;
            font-size: 14px !important;
            font-weight: bold !important;
            line-height: 1 !important;
            cursor: pointer !important;
            margin-left: 0 !important;
            margin-right: 0 !important;
            float: none !important;
            position: static !important;
        }

        .select2-container--default .select2-selection--multiple .select2-selection__choice__remove:hover {
            color: #000 !important;
        }

        .select2-container--default .select2-selection--multiple {
            display: flex !important;
            flex-wrap: wrap !important;
            align-items: center !important;
            min-height: 38px !important;
            padding: 4px 8px !important;
            border: 1px solid #fd7e14 !important;
            border-radius: 0.25rem !important;
            box-sizing: border-box !important;
        }

        .select2-container--default .select2-selection--multiple .select2-selection__choice {
            background-color: #fd7e14 !important;
            color: #fff !important;
            border: none !important;
            border-radius: 0.25rem !important;
            padding: 3px 10px 3px 8px !important;
            display: inline-flex !important;
            align-items: center !important;
            justify-content: center !important;
            gap: 3px !important;
            margin: 0 !important;
        }

        .select2-container--default .select2-selection--multiple .select2-search--inline {
            display: flex !important;
            align-items: center !important;
            width: 100% !important;
        }

        .select2-container--default .select2-selection--multiple .select2-search__field {
            height: 28px !important;
            line-height: 28px !important;
            padding: 0 4px !important;
            margin: 0 !important;
            flex-grow: 1 !important;
            box-sizing: border-box !important;
            font-size: 14px !important;
        }

        .select2-selection__clear {
            display: none !important;
        }
    </style>

    <!-- App css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/themes.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">

    <link id="color" rel="stylesheet" href="{{ asset('assets/css/color-1.css') }}" media="screen">
    <!-- Custom css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/custom.css') }}">
    <!-- <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/responsive.css') }}"> -->

    <style>
        table.display td,
        table.display th {
            border: none !important;
            outline: none !important;
            box-shadow: none !important;
            background-color: inherit !important;
        }

        table.display tr.selected td {
            background-color: inherit !important;
            border: none !important;
        }

        #loader {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: #ffffff;
            z-index: 9999;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .spinner {
            width: 50px;
            height: 50px;
            border: 6px solid #f3f3f3;
            border-top: 6px solid #3498db;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }
    </style>

    @stack('css')


</head>

<body>
    <div id="loader">
        <div class="spinner"></div>
    </div>
    <!-- page-wrapper Start-->
    <div class="page-wrapper compact-wrapper" id="pageWrapper">
        @include('layouts.partials.header')
        <div class="page-body-wrapper">
            @include('layouts.partials.sidebar')
            @yield('content')
            @include('layouts.partials.footer')
        </div>
    </div>
    <script src="{{ asset('assets/js/jquery-3.6.0.min.js') }}"></script>
    <!-- Bootstrap js -->
    <script src="{{ asset('assets/vendor/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- feather icon js -->
    <script src="{{ asset('assets/vendor/fonts/feather-icon/js/feather.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/fonts/feather-icon/js/feather-icon.js') }}"></script>
    <!-- scrollbar js -->
    <script src="{{ asset('assets/vendor/libs/scrollbar/js/simplebar.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/scrollbar/js/custom.js') }}"></script>
    <!-- Sidebar jquery -->
    <script src="{{ asset('assets/vendor/libs/pages/config.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/pages/sidebar-menu.js') }}"></script>

    <!-- Tooltip init -->
    <script src="{{ asset('assets/js/pages/tooltip-init.js') }}"></script>
    <!-- Template js -->
    <script src="{{ asset('assets/js/script.js') }}"></script>

    <script>
        window.addEventListener('load', function() {
            var loader = document.getElementById('loader');
            loader.style.transition = 'opacity 0.5s ease';
            loader.style.opacity = '0';
            setTimeout(function() {
                loader.style.display = 'none';
            }, 500);
        });
    </script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#tags').select2({
                allowClear: true,
                width: '100%'
            });
        });
    </script>


    <script src="{{ asset('assets/vendor/libs/datatable/datatables/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/datatable/datatable-extension/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/datatable/datatable-extension/js/jszip.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/datatable/datatable-extension/js/buttons.colVis.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/datatable/datatable-extension/js/pdfmake.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/datatable/datatable-extension/js/vfs_fonts.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/datatable/datatable-extension/js/dataTables.autoFill.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/datatable/datatable-extension/js/dataTables.select.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/datatable/datatable-extension/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/datatable/datatable-extension/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/datatable/datatable-extension/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/datatable/datatable-extension/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/datatable/datatable-extension/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/datatable/datatable-extension/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/datatable/datatable-extension/js/dataTables.keyTable.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/datatable/datatable-extension/js/dataTables.colReorder.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/datatable/datatable-extension/js/dataTables.fixedHeader.min.js') }}">
    </script>
    <script src="{{ asset('assets/vendor/libs/datatable/datatable-extension/js/dataTables.rowReorder.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/datatable/datatable-extension/js/dataTables.scroller.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/datatable/datatable-extension/js/custom.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @stack('scripts')


</body>

</html>
