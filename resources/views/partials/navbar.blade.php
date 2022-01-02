<nav id="navbar">
  <div class="container d-flex align-items-center justify-content-between">
    <h2 tabindex="0">{{ $title }}</h2>
    <div class="d-flex align-items-center gap-sm">
      <p tabindex="0"><b>{{ session('name') }}</b></p>
      <img src="{{ asset('images/user.png') }}" alt="Admin 101">
    </div>
  </div>
</nav>