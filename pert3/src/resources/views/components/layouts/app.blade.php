<!DOCTYPE html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@include('components.partials.header')

<body>

<!-- navigation -->
@include('components.partials.navbar')
<!-- /navigation -->

{{ $slot }}
	{{-- @php
		use App\Models\Footer;
		@include('components.partials.footer')
	@endphp --}}
	@include('components.partials.footer')
</body>

@include('components.partials.script')

</html>