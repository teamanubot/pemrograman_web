@php
  use App\Models\Logo;
  $Logo = Logo::first();
@endphp
<header class="navigation bg-tertiary">
	<nav class="navbar navbar-expand-xl navbar-light text-center py-3">
		<div class="container">
			<a class="navbar-brand" href="{{ route ('home') }}">
				<img loading="prelaod" decoding="async" class="img-fluid" width="160" src="{{ $Logo->image ? Storage::url($Logo->image) : asset('front/images/default.png') }}" alt="Wallet">
			</a>
			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"> <span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<ul class="navbar-nav m-auto mb-2 mb-lg-0">
					<li class="nav-item"> <a wire:navigate class="nav-link" href="{{ route ('home') }}">Home</a></li>
					<li class="nav-item"> <a wire:navigate class="nav-link" href="{{ route ('profile') }}">Profile</a></li>
					<li class="nav-item"> <a wire:navigate class="nav-link" href="{{ route ('about') }}">About</a></li>
				</ul>			
			</div>
		</div>
	</nav>
</header>