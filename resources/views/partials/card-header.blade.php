<div class="card-header">
  <div class=" d-flex justify-content-between">
    <h3 class="text-dark">
      Show All {{ $title }}
    </h3>
    <a 
      id="goToAddForm" 
      href="/{{ strtolower($title) }}/create" 
      title="add item"
    >
      <i class="bi bi-plus-circle"></i> Add {{ $title }}
    </a>
  </div>
</div>