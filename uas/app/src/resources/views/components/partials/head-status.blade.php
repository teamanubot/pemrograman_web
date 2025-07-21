<head>
    <meta charset="utf-8">
    <title>TeamAnuBot - Sistem Manajemen Pelanggan</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=5">
    <meta name="description" content="UTS - Pemweb">
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
        .badge-status {
            display: inline-block;
            padding: 0.35em 0.75em;
            font-weight: bold;
            border-radius: 10px;
            font-size: 0.9em;
        }

        .badge-pending {
            background-color: #ffc107;
            /* Bootstrap warning color */
            color: #000;
        }

        .badge-approved {
            background-color: #28a745;
            /* Bootstrap success color */
            color: #fff;
        }

        .badge-rejected {
            background-color: #dc3545;
            /* Bootstrap danger color */
            color: #fff;
        }
    </style>
</head>
