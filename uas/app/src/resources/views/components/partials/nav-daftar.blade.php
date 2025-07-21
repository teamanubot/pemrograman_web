<!-- navigation -->
<header class="navigation bg-tertiary">
	<nav class="navbar navbar-expand-xl navbar-light text-center py-3">
		<div class="container">
			<a class="navbar-brand" href="/">
				Sistem Manajemen Pelanggan TeamAnuBot
			</a>
			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"> <span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<ul class="navbar-nav m-auto mb-2 mb-lg-0">
					<li class="nav-item"> <a class="nav-link" href="/">Home</a></li>
					<li class="nav-item "> <a class="nav-link" href="/cek-status">Cek Status</a></li>
				</ul>
				@if (Auth::guard('akun')->check())
                    <span>Halo, {{ Auth::guard('akun')->user()->name }}</span>
                    <form method="POST" action="{{ route('akun.logout') }}">
                        @csrf
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <button type="submit">Logout</button>
                    </form>
                @else
                    <a href="{{ route('akun.login') }}">Login Akun</a>&nbsp;|&nbsp;
                    <a href="{{ route('akun.register') }}">Daftar Akun</a>
                @endif		
			</div>
		</div>
	</nav>
</header>