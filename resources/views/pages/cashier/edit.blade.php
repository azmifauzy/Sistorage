@extends('master')
@section('content')
<div id="items">
  <div class="form-input bg-none">
    <div class="card">
      <h3>Edit {{ $title }}</h3>
      @if (session()->has('success'))
      <div class="alert alert-success" role="alert">
        {{ session('success') }}
      </div>
      @endif
      <form id="formInput" action="/cashiers/{{ $kasir->id }}" method="post">
        @csrf
        @method('put')
        <div class="input-container">
          <input 
            id="name" 
            name="name"
            type="text"
            class="outskirt-input" 
            value="{{ $kasir->name }}"
          />
          <label for="name" class="outskirt-label">
            Fullname
          </label>
        </div>
        <div class="input-container">
          <input 
            id="email" 
            name="email"
            type="email"
            class="outskirt-input" 
            value="{{ $kasir->email }}"
          />
          <label for="email" class="outskirt-label">
            Email
          </label>
        </div>
        <div class="input-container">
          <select id="categories" name="status_id" class="outskirt-input">
            @foreach ($statuses as $status)
              @if ($status->id == $kasir->status_id)
                <option value="{{ $kasir->status_id }}" selected>
                  {{ $kasir->status->name }}
                </option>
              @else
                <option value="{{ $status->id }}">
                  {{ $status->name }}
                </option>
              @endif
            @endforeach
          </select>
          <label for="categories" class="outskirt-label">
            Status
          </label>
        </div>
        <div class="input-container">
          <select id="categories" name="role_id" class="outskirt-input">
            @foreach ($roles as $role)
              @if ($role->id == $kasir->role_id)
                <option value="{{ $kasir->role_id }}" selected>
                  {{ $kasir->role->name }}
                </option>
              @else
                <option value="{{ $role->id }}">
                  {{ $role->name }}
                </option>
              @endif
            @endforeach
          </select>
          <label for="categories" class="outskirt-label">
            Role
          </label>
        </div>
        <button type="submit">Edit</button>
      </form>
    </div>
  </div>
</div>
@endsection