@extends('master')
@section('content')
<div id="items">
  <div class="form-input bg-none">
    <div class="card">
      <h3>Edit Items</h3>
      @if (session()->has('success'))
      <div class="alert alert-success" role="alert">
        {{ session('success') }}
      </div>
      @endif
      <form id="formInput" action="/storages/{{ $item->id }}" method="post">
        @csrf
        @method('put')
        <div class="input-container">
          <input 
            id="name" 
            name="name"
            type="text"
            class="outskirt-input" 
            value="{{ $item->name }}"
          />
          <label for="name" class="outskirt-label">
            Name
          </label>
        </div>
        <div class="input-container">
          <select id="categories" name="category_id" class="outskirt-input">
            @foreach ($categories as $category)
              @if ($category->id == $item->category_id)
                <option value="{{ $item->category_id }}" selected>
                  {{ $item->category->name }}
                </option>
              @else
                <option value="{{ $category->id }}">
                  {{ $category->name }}
                </option>
              @endif
            @endforeach
          </select>
          <label for="categories" class="outskirt-label">
            Categories
          </label>
        </div>
        <div class="input-container">
          <input 
            id="harga" 
            name="price"
            type="number"
            class="outskirt-input" 
            value="{{ $item->price }}"
          />
          <label for="harga" class="outskirt-label">
            Harga
          </label>
        </div>
        <div class="input-container">
          <input 
            id="jumlah" 
            name="value"
            type="number"
            class="outskirt-input" 
            value="{{ $item->value }}"
          />
          <label for="jumlah" class="outskirt-label">
            Jumlah
          </label>
        </div>
        <button type="submit">Edit</button>
      </form>
    </div>
  </div>
</div>
@endsection