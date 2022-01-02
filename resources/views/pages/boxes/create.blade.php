@extends('master')
@section('content')
<div id="items">
  <div class="container">
    <div class="row d-flex justify-content-center">
      <div class="col-lg-5">
        <div class="form-input bg-none m-auto">
          <div class="card">
            <h3>Tambah Box</h3>
            <form id="formInput" action="/items" method="post">
              @csrf
              <div class="">
                <select id="selectBarang" name="name" class="outskirt-input w-100 inputBarang">
                  <option value="default" disabled selected hidden>Pilih Barang</option>
                  @foreach ($items as $item)
                    @if ($item->value  > 0)
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
              <button type="submit" id="btnTambahBarang">Add</button>
            </form>
          </div>
        </div>
      </div>
      {{-- kolom kanan --}}
    
    <div class="col-lg-7" id="columnKanan">
      <div class="card">
        <div class="card-header"><b>Data Barang</b></div>

        <form action="/boxes" method="post" id="formAddBoxes">
          @csrf
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
          </div>
          <div class="card">
            <div class="form-input bg-none">
              <div class="card">
                <h3>Tambah Box</h3>
                <div class="mb-3">
                  <label for="sender" class="form-label">Pengirim</label>
                  <input type="text" class="form-control boxesInputs" id="sender" name="sender" placeholder="Pengirim">
                  <small class="inputBoxesTextDanger text-danger"></small>
                </div>
                <div class="mb-3">
                  <label for="receiver" class="form-label">Penerima</label>
                  <input type="text" class="form-control boxesInputs" id="receiver" name="receiver" placeholder="Penerima">
                  <small class="inputBoxesTextDanger text-danger"></small>
                </div>
                <div class="mb-3">
                  <label for="address" class="form-label">Alamat</label>
                  <input type="text" class="form-control boxesInputs" id="address" name="address" placeholder="Alamat">
                  <small class="inputBoxesTextDanger text-danger"></small>
                </div>
                <div class="mb-3">
                  <label for="telepon" class="form-label">Telepon</label>
                  <input type="text" class="form-control boxesInputs" id="telepon" name="telepon" placeholder="Telepon">
                  <small class="inputBoxesTextDanger text-danger"></small>
                </div>
                <button type="submit" class="btn btn-primary" id="btnTambahBoxes">Tambah Box</button>
              </div>
            </div>
          </div>
        </form>
      </div>
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

    const boxesInputs = $('.boxesInputs');
    const btnTambahBoxes = $('#btnTambahBoxes');
    const inputBoxesTextDanger = $('.inputBoxesTextDanger');
    
    btnTambahBoxes.on('click', function(e) {
      e.preventDefault()

      for(var j = 0; j < boxesInputs.length; j++) {
        if (boxesInputs[j].value === '') {
          inputBoxesTextDanger[j].innerHTML = "Please fillout this field";
          
        } else {
          e.preventDefault()
          inputBoxesTextDanger[j].innerHTML = "";
        }

        if(j === 3) {
          if (boxesInputs[0].value === '' || boxesInputs[1].value === '' || boxesInputs[2].value === '' || boxesInputs[3].value === '') {
              // save
          } else{
            Swal.fire({
              icon: 'warning',
              title: 'Tambah Box?',
              showCancelButton: true,
              confirmButtonText: 'Confirm',
            }).then((result) => {

              if (result.isConfirmed) {
                  $(this).closest('#formAddBoxes').submit()
              }
            })
          }
        }
      }
    })

    const tBody = $('#tBody')
    const columnKanan = $('#columnKanan')
    columnKanan.hide()
    const btnTambahBarang = $('#btnTambahBarang')
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

            const namaBarang = $("select[name='name']").val()
            const kategoriBarang = $("select[name='category_id']").val()
            const hargaBarang = $("select[name='price']").val()
            const jumlahBarang = $("select[name='value']").val()

            const data_cart = {
              namaBarang,
              kategoriBarang,
              hargaBarang,
              jumlahBarang,
            }
            const urls = '/kolom?name=' + namaBarang + '&category_id=' + kategoriBarang + '&price=' + hargaBarang + '&value=' + jumlahBarang
            // AJAX
            $.ajax({
              type: "GET",
              url: urls,
              data: data_cart,
              success: function(data) {
                  var parsingHTML = $.parseHTML(data)

                  $("select[name='name']").val('default').change()

                  $('#optionCategory_id').val('');
                  $('#optionCategory_id').html('Kategori');

                  $('#optionPrice_id').val('');
                  $('#optionPrice_id').html(`Harga Per Unit`);

                  $("select[name='value']").val('')
                  $("select[name='value']").html(`<option value="">Jumlah</option>`)

                  $("input[name='value']").val('')
                  columnKanan.show()
                  tBody.append(parsingHTML[0]);
                  for(let i = 0; i < allInputs.length; i++) {
                    inputTextDanger[i].innerHTML = '';
                  }
              }
            })
          }
        }
      }
    })

    
    $(document).on('click', '#btnDeleteRow', function(e) {
      e.preventDefault()
      $(this).closest('.row-keranjang').remove();
      if (tBody.children().length == 0) {
        columnKanan.hide();
      }
    })
})

</script>
@endsection