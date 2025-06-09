<h2>Selamat datang, {{ auth()->user()->name }}</h2>
<p>Ini adalah dashboard user.</p>
<a href="{{ route('logout') }}"
   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
   Logout
</a>

<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    @csrf
</form>
