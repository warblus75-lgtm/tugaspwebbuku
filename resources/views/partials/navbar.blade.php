<nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow">
    <div class="container">

        <a class="navbar-brand fw-bold" href="{{ route('home') }}">
            📚 TugasPWebBuku
        </a>

        <button class="navbar-toggler"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navbarNav">

            <span class="navbar-toggler-icon"></span>

        </button>

        <div class="collapse navbar-collapse" id="navbarNav">

            <ul class="navbar-nav ms-auto">

                {{-- Home --}}
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home') }}">
                        Home
                    </a>
                </li>

                {{-- Belum Login --}}
                @guest

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">
                            Login
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">
                            Register
                        </a>
                    </li>

                @endguest

                {{-- Sudah Login --}}
                @auth

                    {{-- Menu Admin --}}
                    @if(Auth::user()->role == 'admin')

<li class="nav-item">
    <a class="nav-link" href="{{ route('dashboard') }}">
        Dashboard
    </a>
</li>

<li class="nav-item">
    <a class="nav-link" href="{{ route('kategori.index') }}">
        Kategori
    </a>
</li>

<li class="nav-item">
    <a class="nav-link" href="{{ route('buku.index') }}">
        Buku
    </a>
</li>

<li class="nav-item">
    <a class="nav-link" href="{{ route('transaksi.index') }}">
        Transaksi
    </a>
</li>

                    @endif

                    {{-- Menu Customer --}}
                    @if(Auth::user()->role == 'customer')

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('home') }}">
                                Buku
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('keranjang.index') }}">
                               Keranjang
                            </a>
                        </li>

                        <li class="nav-item">
    <a class="nav-link" href="{{ route('riwayat.index') }}">
        Riwayat
    </a>
</li>

                    @endif

                    {{-- Nama User --}}
                    <li class="nav-item">
                        <span class="nav-link text-warning fw-bold">
                            {{ Auth::user()->name }}
                        </span>
                    </li>

                    {{-- Logout --}}
                    <li class="nav-item">
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf

                            <button type="submit" class="btn btn-link nav-link">
                                Logout
                            </button>
                        </form>
                    </li>

                @endauth

            </ul>

        </div>

    </div>
</nav>