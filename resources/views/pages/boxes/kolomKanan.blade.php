<tr class="row-keranjang">
  <td>
    {{ $name }}
    <input 
      type="hidden" 
      name="barangId[]" 
      value="{{ $barangId }}"
    />
    <input 
      type="hidden" 
      name="name[]" 
      value="{{ $name }}"
    />
  </td>
  <td>
    {{ $kategoriName }}
    <input 
      type="hidden" 
      name="category_id[]" 
      value="{{ $category_id }}"
    />
  </td>
  <td>
    Rp. {{ number_format($price, 2) }},-
    <input 
      type="hidden" 
      name="price[]" 
      value="{{ $price }}"
    />
  </td>
  <td>
    {{ $value }} Unit
    <input 
      type="hidden" 
      name="value[]" 
      value="{{ $value }}"
    />
  </td>
  <td>
    <button class="text-danger" id="btnDeleteRow">
      <i class="bi bi-trash"></i>
    </button>
  </td>
</tr>