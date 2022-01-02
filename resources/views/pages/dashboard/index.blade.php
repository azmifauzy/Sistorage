@extends('master')
@section('content')
  <div id="dashboard" class="container d-grid gap-xl">
    <div class="d-flex gap-xl flex-wrap">
      @include('../../partials/cashier-app-system')
      @include('../../partials/recent-activity')
    </div>

    <section id="menu">
      <h3 tabindex="0">Menu</h3>
      <div class="d-flex gap-lg flex-wrap">
        <a href="/boxes">
          <span tabindex="0">Boxes</span>
          <img 
            src="{{ asset('images/product.png') }}" 
            alt="Menu Product"
          />
        </a>
        <a href="/items">
          <span tabindex="0">Items</span>
          <img 
            src="{{ asset('images/admin.png') }}" 
            alt="Menu Admin"
          />
        </a>
        @if (session('role_id') == 1)
        <a href="/users">
          <span tabindex="0">Users</span>
          <img 
            src="{{ asset('images/categories.png') }}" 
            alt="Menu Categories"
          />
        </a>
        @else 
        <a href="/cashiers">
          <span tabindex="0">Cashiers</span>
          <img 
            src="{{ asset('images/categories.png') }}" 
            alt="Menu Categories"
          />
        </a>
        @endif
      </div>
    </section>
  </div>
@endsection