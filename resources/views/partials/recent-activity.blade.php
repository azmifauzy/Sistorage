<article id="recentActivity">
  <div id="items">
    <div class="form-input bg-none">
      <div class="card">
        <h3>Info Pengguna</h3>
        <form id="formInput" action="/boxes/assd" method="post">
          <div class="input-container">
            <input 
              id="name" 
              name="sender"
              type="text"
              class="outskirt-input inputsBoxes" 
              value="{{ session('name') }}" required readonly>
            <label for="name" class="outskirt-label">
              Nama
            </label>
          </div>
          <div class="input-container">
            <input 
              id="name" 
              name="receiver"
              type="text"
              class="outskirt-input inputsBoxes" 
              value="{{ $user->role->name }}" required readonly>
            <label for="name" class="outskirt-label">
              Role
            </label>
          </div>
          <div class="input-container">
            <input 
              id="stockBox" 
              name="address"
              type="text"
              class="outskirt-input inputsBoxes" 
              value="{{ $user->status->name }}" required readonly>
            <label for="stockBox" class="outskirt-label">
              Status
            </label>
          </div>
          <div class="input-container">
            <input 
              id="stockBox" 
              name="address"
              type="text"
              class="outskirt-input inputsBoxes" 
              value="{{ session('timelog') }}" required readonly>
            <label for="stockBox" class="outskirt-label">
              Waktu Login
            </label>
          </div>
        </form>
      </div>
    </div>
  </div>
</article>
