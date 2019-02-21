<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Niek van den Bos">
    <title>Invoice Control - {{ $title ?? '' }}</title>

    <link rel="icon" type="image/png" sizes="16x16" href="/ext_assets/images/favicon.png">
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <link rel="stylesheet" href="/ext_assets/css/style.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    @stack('styles')
</head>

<body>
    <div id="main-wrapper">
        @include('layoutcomponents.top-nav')
        @include('layoutcomponents.side-nav')
        <div class="page-wrapper">
            @include('layoutcomponents.breadcrumbs')

            <div class="container-fluid">
                @yield('content')
            </div>

            <footer class="footer text-center">
                Niek van den Bos | <a href="http://n-vdb.com">n-vdb.com</a>
            </footer>
        </div>
    </div>

    @stack('extra-content')

    {{-- jQuery --}}
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>

    {{-- Bootstrap --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>

    {{-- jQuery perfect scrollbar --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.perfect-scrollbar/0.6.7/js/min/perfect-scrollbar.jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.perfect-scrollbar/1.3.0/perfect-scrollbar.min.js"></script>

    {{-- Toastr --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

    <script src="/ext_assets/js/waves.js"></script>
    <script src="/ext_assets/js/sidebarmenu.js"></script>
    <script src="/ext_assets/js/custom.min.js"></script>

    @stack('scripts')

    <script>
        (() => {
            $('[data-toggle="tooltip"]').tooltip();
        })();
    </script>

    @if ($errors->any())
    <script>
        const errors = {!! json_encode($errors->all()) !!};

        if (errors.length >= 1) {
            toastr.error(`- ${errors.join('<br>- ')}`, 'Not all fields validated correctly!', {
                closeButton: true,
                timeOut: 0
            });
        }
    </script>
    @endif

    @if (session('toastrMessage'))
        <script>
            const method  = {!! '\'' . session('toastrMessage')->type    . '\'' !!};
            const message = {!! '\'' . session('toastrMessage')->message . '\'' !!};
            const title   = {!! '\'' . session('toastrMessage')->title   . '\'' !!};

            toastr[method](message, title);
        </script>
    @endif

</body>

</html>
