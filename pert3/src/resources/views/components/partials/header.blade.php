<head>
	<meta charset="utf-8">
	<title>{{ $title ?? 'PemWeb' }}</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=5">
	<meta name="description" content="This is meta description">
	<meta name="author" content="Themefisher">
	<link rel="shortcut icon" href="{{ asset ('front/images/favicon.png') }}" type="image/x-icon">
	<link rel="icon" href="{{ asset ('front/images/favicon.png') }}" type="image/x-icon">

	<!-- # Google Fonts -->
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Rubik:wght@400;500;700&display=swap" rel="stylesheet">

	<!-- # CSS Plugins -->
	<link rel="stylesheet" href="{{ asset ('front/plugins/slick/slick.css') }}">
	<link rel="stylesheet" href="{{ asset ('front/plugins/font-awesome/fontawesome.min.css') }}">
	<link rel="stylesheet" href="{{ asset ('front/plugins/font-awesome/brands.css') }}">
	<link rel="stylesheet" href="{{ asset ('front/plugins/font-awesome/solid.css') }}">

	<!-- # Main Style Sheet -->
	<link rel="stylesheet" href="{{ asset ('front/css/style.css') }}">
    @livewireStyles
</head>