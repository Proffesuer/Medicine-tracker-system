<br><br><br>
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo">Add New Medicine</button>

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Add New Medicine</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form>
          <div class="mb-3">
            <label for="medicine_name" class="col-form-label">Medicine Name:</label>
            <input type="text" class="form-control" id="medicine_name">
          </div>
          <div class="mb-3">
            <label for="indications" class="col-form-label">Indication Name:</label>
            <input type="text" class="form-control" id="indications">
          </div>
          <div class="mb-3">
            <label for="precausions" class="col-form-label">Precausions:</label>
            <input type="text" class="form-control" id="precausions">
          </div>
          <div class="mb-3">
            <label for="storage" class="col-form-label">Storage:</label>
            <input type="text" class="form-control" id="storage">
          </div>
        
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Submit</button>
      </div>
    </div>
  </div>
</div>