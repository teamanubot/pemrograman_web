<!DOCTYPE html>

<html lang="en-us">
@include('components.partials.head')
<body>
    @include('components.partials.nav')
{{ $slot }}
    @include('components.partials.bottom')
</body>
    @include('components.partials.script')
</html>