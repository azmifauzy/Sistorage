@extends('master')
@section('content')
<div id="items">
  <div class="form-input bg-none">
    <div class="card">
      <h3>Edit Categories</h3>
      <form id="formInput" action="/categories/{{ $category->id }}" method="POST">
        @csrf
        @method('put')
        <div class="input-container">
          <input 
            id="name" 
            name="name"
            type="text"
            class="outskirt-input" 
            value="{{ $category->name }}"
          />
          <label for="name" class="outskirt-label">
            Name
          </label>
        </div>
        <button type="submit">Edit</button>
      </form>
    </div>
  </div>
</div>
@endsection