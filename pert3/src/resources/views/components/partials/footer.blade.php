{{-- @php
    use App\Models\Footer;
    $footer = Footer::first();
@endphp --}}


<footer class="section-sm bg-tertiary">
	<div class="container">
		<div class="container d-flex justify-content-center">
            @if('footer')
            <a wire:navigate href="{{ route ('home') }}"> {{ $footer->footer ?? '' }} </a>
            @endif
        </div>
	</div>
</footer>