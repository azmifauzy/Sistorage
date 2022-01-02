@extends('master')
@section('content')
<div id="items">
  <div class="container">
    <div class="row">
      <div class="col-lg-5">
        <div class="form-input bg-none">
          <div class="card">
            <h3>Tambah Barang</h3>
            <form id="formInput" action="/items" method="post">
              @csrf
              <div class="input-container">
                <input 
                  id="name" 
                  name="name"
                  type="text"
                  class="outskirt-input boxesInputs" 
                />
                <small class="inputBoxesTextDanger text-danger"></small>
                <label for="name" class="outskirt-label">
                  Name
                </label>
              </div>
              <div class="input-container">
                <select id="categories" name="category_id" class="outskirt-input">
                  @foreach ($categories as $category)
                    <option value="{{ $category->id }}">
                      {{ $category->name }}
                    </option>
                  @endforeach
                </select>
                <label for="categories" class="outskirt-label">
                  Kategori
                </label>
              </div>
              <div class="input-container">
                <input 
                  id="stockBox" 
                  name="price"
                  type="number"
                  class="outskirt-input boxesInputs" 
                />
                <small class="inputBoxesTextDanger text-danger"></small>
                <label for="stockBox" class="outskirt-label">
                  Harga
                </label>
              </div>
              <div class="input-container">
                <input 
                  id="pricePerBox" 
                  name="value"
                  type="number"
                  class="outskirt-input boxesInputs" 
                />
                <small class="inputBoxesTextDanger text-danger"></small>
                <label for="pricePerBox" class="outskirt-label">
                  Jumlah
                </label>
              </div>
              
              <button type="submit" id="btnTambahBarang">Tambah</button>
            </form>
          </div>
        </div>
      </div>
      <div class="col-lg-7">
        <form action="/storages" id="formSimpanData" method="post">
          @csrf
          @method('post')
          <div class="card" id="cardRight">
            <div class="card-header">
              <b>List Barang</b>
            </div>
            <div class="card-body">
              <table class="table">
                <thead>
                  <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Kategori</th>
                    <th scope="col">Harga</th>
                    <th scope="col">Jumlah</th>
                    <th scope="col">Aksi</th>
                  </tr>
                </thead>
                <tbody id="tBody">
                  
                </tbody>
              </table>
              <div class="pt-3">
                  <button class="btn btn-sm btn-primary" id="btnSimpanData">Simpan Data</button>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<script 
  src="https://code.jquery.com/jquery-3.6.0.min.js" 
  integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" 
  crossorigin="anonymous">
</script>
<script>

  $(document).ready(function() {
    $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });


    const btnSimpanData = $('#btnSimpanData');
    $(document).on('click', '#btnSimpanData', function(e) {
      e.preventDefault()
      Swal.fire({
        icon: 'warning',
        title: 'Simpan Data Barang?',
        showCancelButton: true,
        confirmButtonText: 'Simpan',
      }).then((result) => {

        if (result.isConfirmed) {
          $(this).closest('#formSimpanData').submit()
        }
      })
    })


    

    const cardRight = $('#cardRight')
    cardRight.hide()

    const btnTambahBarang = $('#btnTambahBarang')
    const boxesInputs = $('.boxesInputs');
    const inputBoxesTextDanger = $('.inputBoxesTextDanger');
    btnTambahBarang.on('click', function(e) {
      e.preventDefault()


      for(var j = 0; j < boxesInputs.length; j++) {
        if (boxesInputs[j].value === '') {
          inputBoxesTextDanger[j].innerHTML = "Please fillout this field";
          
        } else {
          e.preventDefault()
          inputBoxesTextDanger[j].innerHTML = "";
        }

        if(j === 2) {
          if (boxesInputs[0].value === '' || boxesInputs[1].value === '' || boxesInputs[2].value === '') {
              // save
          } else{
            
            const data_cart = {
              namaBarang: $("input[name='name']").val(),
              kategoriBarang: $("select[name='category_id']").val(),
              hargaBarang: $("input[name='price']").val(),
              jumlahBarang: $("input[name='value']").val(),
            }
            const urls = '/addItems?name=' + $("input[name='name']").val() + '&category_id=' + $("select[name='category_id']").val() + '&price=' + $("input[name='price']").val() + '&value=' + $("input[name='value']").val()

            // AJAX
            $.ajax({
              type: "GET",
              url: urls,
              data: data_cart,
              success: function(data) {
                  var parsingHTML = $.parseHTML(data)

                  $("input[name='name']").val('')
                  $("input[name='price']").val('')
                  $("input[name='value']").val('')

                  cardRight.show()
                  tBody.append(parsingHTML[0]);
              }
            })
          }
        }
      }

      $(document).on('click', '#btnDeleteRow', function(e) {
        e.preventDefault()
        $(this).closest('.row-keranjang').remove();
        if (tBody.children().length == 0) {
          columnKanan.hide();
        }
    })
    })



  })
</script>
@endsection