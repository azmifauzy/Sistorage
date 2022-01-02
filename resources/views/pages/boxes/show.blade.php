@extends('master')
@section('content')
<div class="row">
  <div class="col-lg-4">
    <div id="items">
      <div class="form-input bg-none">
        <div class="card">
          <h3>{{ $boxes->id }}</h3>
          @if (session()->has('success'))
          <div class="alert alert-success" role="alert">
            {{ session('success') }}
          </div>
          @endif
          <form id="formInput" action="/boxes/{{ $boxes->id }}" method="post">
            @method('put')
            @csrf
            <div class="input-container">
              <input 
                id="name" 
                name="sender"
                type="text"
                class="outskirt-input inputsBoxes" 
                value="{{ $boxes->sender }}" required readonly>
              <label for="name" class="outskirt-label">
                Pengirim
              </label>
            </div>
            <div class="input-container">
              <input 
                id="name" 
                name="receiver"
                type="text"
                class="outskirt-input inputsBoxes" 
                value="{{ $boxes->receiver }}" required readonly>
              <label for="name" class="outskirt-label">
                Penerima
              </label>
            </div>
            <div class="input-container">
              <input 
                id="stockBox" 
                name="address"
                type="text"
                class="outskirt-input inputsBoxes" 
                value="{{ $boxes->address }}" required readonly>
              <label for="stockBox" class="outskirt-label">
                Alamat
              </label>
            </div>
            <div class="input-container">
              <input 
                id="pricePerBox" 
                name="telepon"
                type="number"
                class="outskirt-input inputsBoxes" 
                value="{{ $boxes->telepon }}" required readonly>
              <label for="pricePerBox" class="outskirt-label">
                Telepon
              </label>
            </div>
            <div class="input-container">
              <select id="categories" name="statusBox_id" class="outskirt-input">
                @foreach ($statusBox as $status)
                  @if ($status->id == $boxes->statusBox_id)
                    <option value="{{ $status->id }}" selected>
                      {{ $status->name }}
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
            @if ($boxes->statusBox_id == 1) 
            <button type="submit" id="btnEditBox">Edit</button>
            @endif
            <button type="submit" id="btnConfirmEditBox">Confirm</button>
            <button type="submit" id="btnCancelEditBox">Cancel</button>
            
          </form>
          <form action="/boxes/{{ $boxes->id }}" method="post" id="formDeleteBox">
            @csrf
            @method('delete')
            <button type="submit" class="btn btn-danger w-100" id="btnDeleteBox">
              Delete
            </button>
          </form>
        </div>
      </div>
    </div>
  </div>
  <div class="col-lg-8">
    
    <div class="row">
      <div class="card">
        <div class="card-body">
          <div class=" d-flex justify-content-between">
            <h3 class="text-dark">
              Data Barang
            </h3>
            @if ($boxes->statusBox_id == 1)
            <a href="" id="btnTambahBarang">
              <i class="bi bi-plus-circle"></i> Tambah Barang
            </a>
            @endif
          </div>
          @if (session()->has('successDelete'))
          <div class="alert alert-success" role="alert">
            {{ session('successDelete') }}
          </div>
          @endif
          @if (session()->has('successCreate'))
          <div class="alert alert-success" role="alert">
            {{ session('successCreate') }}
          </div>
          @endif
          <table class="table">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Kategori</th>
                <th scope="col">Nama Barang</th>
                <th scope="col">Jumlah</th>
                <th scope="col">Harga</th>
                @if ($boxes->statusBox_id == 1)
                <th scope="col">Aksi</th>
                @endif
              </tr>
            </thead>
            <tbody>
              @foreach ($boxes->item as $item)
              <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->category->name }}</td>
                <td>{{ $item->name }}</td>
                <td>{{ $item->value }} Unit</td>
                <td>Rp. {{ number_format($item->price, 2) }},-</td>
                <td>
                  @if ($boxes->statusBox_id == 1)
                    @if (session('role_id') == 1)
                    <a href="/items/{{ $item->id }}/edit"><i class="bi bi-pencil-fill text-warning"></i></a>
                    <form action="/items/{{ $item->id }}" method="post" class="d-inline" id="formDeleteData">
                      @csrf
                      @method('delete')
                      <button type="submit" class="text-danger bg-none" id="btnDeleteData"><i class="bi bi-trash"></i></button>
                    </form>
                    @else
                    <form action="/items/{{ $item->id }}" method="post" class="d-inline" id="formDeleteData">
                      @csrf
                      @method('delete')
                      <button type="submit" class="text-danger bg-none" id="btnDeleteData"><i class="bi bi-trash"></i></button>
                    </form>
                    @endif
                  @endif
                </td>
              </tr>
              @endforeach
            </tbody>
            <tfoot>
              <tr>
                <td colspan="4">
                  <b>Total : </b> 
                </td>
                <td>Rp. {{ number_format($totalHarga, 2) }},-</td>
              </tr>
            </tfoot>
          </table>
        </div>
      </div>
    </div>
    <div class="row" id="rowAddBarang">
      <div class="col-lg-8">

        
        <div id="items">
          <div class="form-input bg-none">
            <div class="card">
              <div class=" d-flex justify-content-between">
                <b class="text-dark">
                  Tambah Barang {{ $boxes->id }}
                </b>
                <a href="" id="btnCloseTambahBarang" class="text-danger">
                  <i class="bi bi-x-circle"></i>
                </a>
              </div>
              <form id="formInput" action="/items" method="post">
                @method('post')
                @csrf
                <input type="hidden" value="{{ $boxes->id }}" name="box_id">
                <div class="">
                  <select id="selectBarang" name="name" class="outskirt-input w-100 inputBarang">
                    <option value="default" disabled selected hidden>Pilih Barang</option>
                    @foreach ($items as $item)
                    @if ($item->value > 0)
                    <option value="{{ $item->id }}">
                      {{ $item->name }}
                    </option>
                    @endif
                    @endforeach
                  </select>
                  <label for="selectBarang" class="outskirt-label d-none"></label>
                  <small class="inputTextDanger text-danger"></small>
                </div>
                <div class="input-container">
                  <select id="" name="category_id" class="outskirt-input w-100 inputBarang" aria-readonly="true">
                      <option value="" id="optionCategory_id">
                        Kategori
                      </option>
                  </select>
                  <label for="" class="outskirt-label d-none"></label>
                  <small class="inputTextDanger text-danger"></small>
                </div>
                <div class="input-container">
                  <select id="" name="price" class="outskirt-input w-100 inputBarang" aria-readonly="true">
                      <option value="" id="optionPrice_id">
                        Harga Per Unit
                      </option>
                  </select>
                  <label for="" class="outskirt-label d-none"></label>
                  <small class="inputTextDanger text-danger"></small>
                </div>
                <div class="input-container">
                  <select id="" name="value" class="outskirt-input w-100 inputBarang" aria-readonly="true">
                      <option value="" id="optionValue_id">
                        Jumlah
                      </option>
                  </select>
                  <label for="" class="outskirt-label d-none"></label>
                  <small class="inputTextDanger text-danger"></small>
                </div>
                <button type="submit" id="btnAddBarangToBox">Tambah</button>
              </form>
            </div>
          </div>
        </div>



      </div>
    </div>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script>
  const rowAddBarang = $('#rowAddBarang')
  rowAddBarang.hide()
  
  const btnCloseTambahBarang = $('#btnCloseTambahBarang')
  btnCloseTambahBarang.on('click', function(e) {
    e.preventDefault()
    rowAddBarang.hide()
    btnTambahBarang.show()
  })

  const btnTambahBarang = $('#btnTambahBarang')
  btnTambahBarang.on('click', function(e) {
    e.preventDefault()
    rowAddBarang.show()
    btnTambahBarang.hide()
  })
  const btnCancelEditBox = $('#btnCancelEditBox')
  btnCancelEditBox.hide()

  const btnConfirmEditBox = $('#btnConfirmEditBox')
  btnConfirmEditBox.hide()
  $(document).on('click', '#btnConfirmEditBox', function(e) {
    e.preventDefault()
    Swal.fire({
      icon: 'warning',
      title: 'Simpan Perubahan?',
      showCancelButton: true,
      confirmButtonText: 'Confirm',
    }).then((result) => {

      if (result.isConfirmed) {
        $(this).closest('#formInput').submit()
      }
    })
  })

  const btnEditBox = $('#btnEditBox')
  btnEditBox.show()


  const inputsBoxes = $('.inputsBoxes')

  btnEditBox.on('click', function(e) {
    e.preventDefault()

    for(let i = 0; i < inputsBoxes.length; i++) {
      inputsBoxes[i].removeAttribute('readonly')
    }

    btnConfirmEditBox.show()
    btnCancelEditBox.show()
    btnEditBox.hide()
  })

  btnCancelEditBox.on('click', function(e) {
    e.preventDefault()

      inputsBoxes.attr('readonly', 'true')

    btnConfirmEditBox.hide()
    btnCancelEditBox.hide()
    btnEditBox.show()
  })
  

</script>
<script>
    $(document).ready(function() {
      const btnDeleteData = $('#btnDeleteData');
      $(document).on('click', '#btnDeleteData', function(e) {
        e.preventDefault()
        Swal.fire({
          icon: 'warning',
          title: 'Hapus Barang dalam Box?',
          showCancelButton: true,
          confirmButtonText: 'Hapus',
        }).then((result) => {

          if (result.isConfirmed) {
            $(this).closest('#formDeleteData').submit()
          }
        })
      })


      $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });

      const selectBarang = $('#selectBarang')
      selectBarang.on('change', function(e) {
        e.preventDefault()
        const id = $(this).val();
        fetch(`/getItems/?id=${id}`)
        .then(response => response.json())
        .then(data => {
            // $("select[name='category_id']").val(data.kategoriId)
            $('#optionCategory_id').val(data.kategoriId);
            $('#optionCategory_id').html(data.kategori);

            $('#optionPrice_id').val(data.harga);
            let hargaUnit = data.harga.toLocaleString('id-ID')
            $('#optionPrice_id').html(`Rp. ${hargaUnit} /unit`);

            let createOption = "" 
            for(let x = 1; x <= data.jumlah; x++) {
              createOption += `<option value="${x}">${x} Unit</option>`
            }
            $("select[name='value']").html(createOption)
        });
      })

      const btnTambahBarang = $('#btnAddBarangToBox')
      btnTambahBarang.on('click', function(e) {
        e.preventDefault()

        const allInputs = $('.inputBarang')
        const inputTextDanger  = $('.inputTextDanger')

        for(var i = 0; i < allInputs.length; i++) {
          if (allInputs[i].value === '') {
            inputTextDanger[i].innerHTML = "Please fillout this field";
            
          } else {
            e.preventDefault()
            inputTextDanger[i].innerHTML = "";
          }

          if(i === 3) {
            if (allInputs[0].value === '' || allInputs[1].value === '' || allInputs[2].value === '' || allInputs[3].value === '') {
                // save
            } else {
              $(this).closest('#formInput').submit()
            }
          }
        }


      })
    })
</script>
<script>
  $(document).ready(function() {
    $(document).on('click', '#btnDeleteBox', function(e) {
      e.preventDefault()
      Swal.fire({
        icon: 'warning',
        title: 'Hapus Box?',
        showCancelButton: true,
        confirmButtonText: 'Hapus',
      }).then((result) => {

        if (result.isConfirmed) {
          $(this).closest('#formDeleteBox').submit()
        }
      })
    })
  })
</script>
@endsection