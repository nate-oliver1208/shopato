@extends('templates.base-template')


@push('styles')
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
    <style>
        a.nostyle:link, a.nostyle:visited {
            text-decoration: inherit;
            color: inherit;
            cursor: auto;
        }
        .brand-link img {
            height: 35px;
            margin-right: 10px;
        }
        .main-header {
            background-color: #ffeb80;
        }
        .content-wrapper {
            background-color: #fffbea;
        }
        footer.main-footer {
            background-color: #ffeb80;
            color: #333;
        }
    </style>

@endpush



@section('header')
    <body class="hold-transition layout-top-nav">
        <div class="wrapper">

		</div>

@endsection



@section('content')
			<div class="content-wrapper">
				<div class="content-header">
					@yield('breadcrumb')
				</div>

				<div class="{{$page_width ?? 'container'}}">
					@yield('page')
				</div>
			</div>

		</div>

@endsection



@push('scripts')
    <script src="{{ asset('adminlte/plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('adminlte/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('adminlte/plugins/select2/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('adminlte/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('adminlte/plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('adminlte/dist/js/adminlte.js') }}"></script>
    <script src="{{ asset('js/util.js') }}"></script>
    <script>
        $(document).ready(function(){
            setTimeout(function() {
                $('#success-display').hide(500)
            }, 4000);
        });
    </script>
@endpush