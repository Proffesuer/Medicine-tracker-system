<br><br><br>
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo">Add New Prescription</button>

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">New Prescriptions</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form>
          <div class="mb-3">
            <label for="medicine" class="col-form-label">Medicine:</label>
            <input type="text" class="form-control" id="medicine">
          </div>
          <div class="mb-3">
            <label for="quantity" class="col-form-label">Quantity:</label>
            <input type="text" class="form-control" id="quantity">
          </div>
          <div class="mb-3">
            <label for="time" class="col-form-label">Times:</label>
            <input type="text" class="form-control" id="times">
          </div>
          <div class="mb-3">
            <label for="days_prescribed" class="col-form-label">Days Prescribed:</label>
            <input type="text" class="form-control" id="days_prescribed">
          </div>
          <div class="mb-3">
            <label for="number_refils" class="col-form-label">Number refils:</label>
            <input type="text" class="form-control" id="number_refils">
          </div>
          <div class="mb-3">
            <label for="instructions" class="col-form-label">Instructions:</label>
            <textarea type="text" class="form-control" id="instructions"></textarea>
          </div>
          <div class="mb-3">
            <label for="user_id" class="col-form-label">User ID:</label>
            <input type="text" class="form-control" id="user_id">
          </div>
          <div class="mb-3">
            <input type="date" class="form-control" id="date">
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