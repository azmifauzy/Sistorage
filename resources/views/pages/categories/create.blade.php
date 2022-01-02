@extends('master')
@section('content')
<div id="items">
  <div class="form-input bg-none">
    <div class="card">
      <h3>Add Categories</h3>
      <form id="formInput" action="/categories" method="POST">
        @csrf
        <div class="input-container">
          <input 
            id="name" 
            name="name"
            type="text"
            class="outskirt-input" 
          />
          <label for="name" class="outskirt-label">
            Name
          </label>
        </div>
        <button type="submit">Add</button>
      </form>
    </div>
  </div>
</div>
@endsection