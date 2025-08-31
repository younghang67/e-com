<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
    <link rel="icon" href="/favicon.ico" type="image/x-icon">
    <title>Admin Panel - @yield('title')</title>
    <!-- Simple bar CSS -->
    <link rel="stylesheet" href="{{ asset('css/admin/simplebar.css') }}">
    <!-- Fonts CSS -->
    <link
        href="https://fonts.googleapis.com/css2?family=Overpass:ital,wght@0,100;0,200;0,300;0,400;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">

    <!-- Icons CSS -->
    <link rel="stylesheet" href="{{ asset('css/admin/feather.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin/select2.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin/dropzone.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin/uppy.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin/jquery.steps.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin/jquery.timepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin/quill.snow.css') }}">
    <!-- Date Range Picker CSS -->
    <link rel="stylesheet" href="{{ asset('css/admin/daterangepicker.css') }}">
    <!-- App CSS -->
    <link rel="stylesheet" href="{{ asset('css/admin/app-light.css') }}" id="lightTheme" disabled>
    <link rel="stylesheet" href="{{ asset('css/admin/app-dark.css') }}" id="darkTheme">


    <!-- CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css" />

    <!-- JS -->
    <script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>

</head>

<body class="vertical  dark  ">
    <div class="wrapper">
        <x-admin.admin-nav />


        <main role="main" class="main-content">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-12">
                        <div class="row align-items-center mb-2">
                            <div class="col">
                                <h2 class="h5 page-title">@yield('title')</h2>
                            </div>
                            <div class="col-auto">
                                @yield('actions')

                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">

                                <div class="card shadow">
                                    <div class="card-body">

                                        @yield('content')

                                    </div>
                                </div>
                            </div>
                        </div>

                    </div> <!-- .col-12 -->
                </div> <!-- .row -->
            </div> <!-- .container-fluid -->
        </main> <!-- main -->
    </div> <!-- .wrapper -->




    <script src="{{ asset('js/admin/jquery.min.js') }}"></script>
    <script src="{{ asset('js/admin/popper.min.js') }}"></script>
    <script src="{{ asset('js/admin/moment.min.js') }}"></script>
    <script src="{{ asset('js/admin/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/admin/simplebar.min.js') }}"></script>
    <script src='{{ asset('js/admin/daterangepicker.js') }}'></script>
    <script src='{{ asset('js/admin/jquery.stickOnScroll.js') }}'></script>
    <script src="{{ asset('js/admin/tinycolor-min.js') }}"></script>
    <script src="{{ asset('js/admin/config.js') }}"></script>
    <script src="{{ asset('js/admin/d3.min.js') }}"></script>
    <script src="{{ asset('js/admin/topojson.min.js') }}"></script>
    <script src="{{ asset('js/admin/datamaps.all.min.js') }}"></script>
    <script src="{{ asset('js/admin/datamaps-zoomto.js') }}"></script>
    <script src="{{ asset('js/admin/datamaps.custom.js') }}"></script>
    <script src="{{ asset('js/admin/Chart.min.js') }}"></script>
    <script>
        /* defind global options */
        Chart.defaults.global.defaultFontFamily = base.defaultFontFamily;
        Chart.defaults.global.defaultFontColor = colors.mutedColor;
    </script>
    <script src="{{ asset('js/admin/gauge.min.js') }}"></script>
    <script src="{{ asset('js/admin/jquery.sparkline.min.js') }}"></script>
    <script src="{{ asset('js/admin/apexcharts.min.js') }}"></script>
    <script src="{{ asset('js/admin/apexcharts.custom.js') }}"></script>
    <script src='{{ asset('js/admin/jquery.mask.min.js') }}'></script>
    <script src='{{ asset('js/admin/select2.min.js') }}'></script>
    <script src='{{ asset('js/admin/jquery.steps.min.js') }}'></script>
    <script src='{{ asset('js/admin/jquery.validate.min.js') }}'></script>
    <script src='{{ asset('js/admin/jquery.timepicker.js') }}'></script>
    <script src='{{ asset('js/admin/dropzone.min.js') }}'></script>
    <script src='{{ asset('js/admin/uppy.min.js') }}'></script>
    {{-- <script src='{{ asset('js/admin/quill.min.js') }}'></script> --}}


    <script src="{{ asset('js/admin/apps.js') }}"></script>



    @if (session()->has('success'))
        <div class="toast-container position-fixed " style="z-index: 11;right:1rem; bottom:1rem;">
            <div class="toast fade  align-items-center text-white bg-success border-0" role="alert"
                aria-live="assertive" aria-atomic="true">
                <div class="d-flex">
                    <div class="toast-body">
                        {{ session('success') }}
                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
                        aria-label="Close"></button>
                </div>
            </div>
        </div>
    @endif

    @if ($errors->any())
        <div class="toast-container position-fixed " style="z-index: 11;right:1rem; bottom:1rem;">
            <div class="toast fade  align-items-center text-white bg-danger border-0" role="alert"
                aria-live="assertive" aria-atomic="true">
                <div class="d-flex">
                    <div class="toast-body">
                        {{ $errors->first() }}
                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
                        aria-label="Close"></button>
                </div>
            </div>
        </div>
    @endif

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var toastEl = document.querySelector('.toast');
            if (toastEl) {
                var option = {
                    autohide: true,
                    delay: 5000 // 5 seconds
                };
                var toast = new bootstrap.Toast(toastEl, option);
                toast.show();
            }
        });
    </script>

    <script src="https://cdn.ckeditor.com/ckeditor5/35.3.0/classic/ckeditor.js"></script>
    {{-- <script src="{{ asset("/vendor/ckeditor.js") }}"></script> --}}
    <script>
        let editor;

        ClassicEditor
            .create(document.querySelector('#description'), {
                ckfinder: {
                    uploadUrl: "{{ route('admin.ckeditor.upload', ['_token' => csrf_token()]) }}",
                }
            })
            .then(newEditor => {
                editor = newEditor;
            })
            .catch(error => {
                console.error(error);
            });


        function extractTableData() {
            if (!editor) return;

            const content = editor.getData();
            const tempElement = document.createElement('div');
            tempElement.innerHTML = content;

            const table = tempElement.querySelector('table');

            if (!table) {
                document.getElementById('output').innerText = 'No table found';
                return;
            }

            const rows = Array.from(table.rows);

            if (rows.length === 0) {
                document.getElementById('output').innerText = 'Empty table';
                return;
            }

            // Extract headers from the first row
            const headers = Array.from(rows[0].cells).map(cell => cell.innerText.trim());

            // Initialize the data structure for columns, excluding the header row
            const columnData = headers.map(() => []);

            // Iterate over the remaining rows and extract data column-wise
            rows.slice(1).forEach(row => {
                Array.from(row.cells).forEach((cell, index) => {
                    if (columnData[index]) {
                        columnData[index].push(cell.innerText.trim());
                    }
                });
            });

            // Structure the data with headers and their corresponding column data
            const columnWiseData = headers.map((header, index) => ({
                header: header,
                data: columnData[index]
            }));

            // Convert to JSON format
            const tableJson = JSON.stringify(columnWiseData, null, 2);
            console.log(tableJson);
        }
    </script>
    <link rel="stylesheet" type="text/css" href="https://npmcdn.com/flatpickr/dist/themes/material_red.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

    {{-- <script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        CKEDITOR.replace('description');
    });
</script> --}}

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const multiselects = document.querySelectorAll('.choices-multiple');

            multiselects.forEach(select => {
                new Choices(select, {
                    removeItemButton: true,
                    placeholder: true,
                    placeholderValue: 'Select options...',
                    searchPlaceholderValue: 'Type to search...',
                });
            });
        });
    </script>


</body>

</html>
