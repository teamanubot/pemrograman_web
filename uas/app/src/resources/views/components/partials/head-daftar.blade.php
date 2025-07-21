<head>
    <meta charset="utf-8">
    <title>TeamAnuBot - Sistem Manajemen Pelanggan</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=5">
    <meta name="description" content="UAS - Pemweb">
    <meta name="author" content="Rivai">
    <link rel="shortcut icon" href="{{ asset('front/images/tab.jpeg') }}" type="image/x-icon">
    <link rel="icon" href="{{ asset('front/images/tab.jpeg') }}" type="image/x-icon">

    <!-- # Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@400;500;700&display=swap" rel="stylesheet">

    <!-- # CSS Plugins -->
    <link rel="stylesheet" href="{{ asset('front/plugins/slick/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('front/plugins/font-awesome/fontawesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('front/plugins/font-awesome/brands.css') }}">
    <link rel="stylesheet" href="{{ asset('front/plugins/font-awesome/solid.css') }}">

    <!-- # Main Style Sheet -->
    <link rel="stylesheet" href="{{ asset('front/css/style.css') }}">
    <style>
        select.form-select {
            all: unset;
            display: block;
            width: 100%;
            padding: 0.375rem 0.75rem;
            font-size: 1rem;
            line-height: 1.5;
            color: #212529;
            background-color: #fff;
            background-clip: padding-box;
            border: 1px solid #ced4da;
            border-radius: 0.375rem;
            appearance: none;
        }

        /* Reset dan set ulang input file */
        input[type="file"] {
            all: revert;
            display: block;
            width: 100%;
            padding: 0.375rem 0.75rem;
            font-size: 1rem;
            line-height: 1.5;
            color: #212529;
            background-color: #fff;
            border: 1px solid #ced4da;
            border-radius: 0.375rem;
            cursor: pointer;
            box-sizing: border-box;
            transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        }

        input[type="file"]:focus {
            border-color: #86b7fe;
            outline: 0;
            box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
        }

        <style>

        /* Reset dulu biar hilang style custom lain */
        input[type="file"].form-control {
            all: revert;
            display: block;
            width: 100%;
            padding: 0.375rem 0.75rem;
            font-size: 1rem;
            line-height: 1.5;
            color: #212529;
            background-color: #fff;
            background-clip: padding-box;
            border: 1px solid #ced4da;
            border-radius: 0.375rem;
            cursor: pointer;
            box-sizing: border-box;
            transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
            /* Bootstrap default font-family */
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif,
                "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol";
        }

        input[type="file"].form-control:focus {
            border-color: #86b7fe;
            outline: 0;
            box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
        }

        /* Optional: jika ingin agar label "Choose file" dan nama file mengikuti Bootstrap 5 styling */
        /* Bootstrap 5 sebenarnya tidak styling detail file input internal, tapi ini cara untuk style basic */

        input[type="file"].form-control::-webkit-file-upload-button {
            all: revert;
            margin-right: 10px;
            border: 1px solid #ced4da;
            border-radius: 0.375rem;
            padding: 0.375rem 0.75rem;
            background-color: #fff;
            cursor: pointer;
            transition: background-color 0.15s ease-in-out, border-color 0.15s ease-in-out;
            font-family: inherit;
            font-size: 1rem;
            line-height: 1.5;
        }

        input[type="file"].form-control::-webkit-file-upload-button:hover {
            background-color: #e9ecef;
            border-color: #adb5bd;
        }

        /* Firefox */
        input[type="file"].form-control::-moz-focus-inner {
            border: 0;
            padding: 0;
        }
    </style>

    </style>
</head>
