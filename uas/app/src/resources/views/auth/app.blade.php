<!DOCTYPE html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@hasSection('head')
    @yield('head')
@else
    @include('components.partials.head') {{-- Navbar default --}}
@endif
<body>
    @hasSection('nav')
        @yield('nav')
    @else
        @include('components.partials.nav') {{-- Navbar default --}}
    @endif
    <main>
        @yield('content')
    </main>
    @include('components.partials.bottom')
</body>
    @include('components.partials.script')
</html> 