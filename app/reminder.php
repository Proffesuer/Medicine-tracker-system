<br><br><br>
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo">Add New Reminder</button>

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">New Reminder</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form>
          <div class="mb-3">
            <label for="prescription_id" class="col-form-label">Prescription ID:</label>
            <input type="text" class="form-control" id="prescription_id">
          </div>
          <div class="mb-3">
            <label for="phone" class="col-form-label">Phone Number:</label>
            <input type="number" class="form-control" id="phone">
          </div>
          <div class="mb-3">
            <label for="mode" class="col-form-label">Mode:</label>
            <input type="text" class="form-control" id="mode">
          </div>
          <div class="mb-3">
            <label for="status" class="col-form-label">Status:</label>
            <input type="text" class="form-control" id="status">
          </div>
          <div class="mb-3">
            <label for="patient" class="col-form-label">Patient:</label>
            <input type="text" class="form-control" id="patient">
          </div>
          <div class="mb-3">
            <label for="time_date_start" class="col-form-label">Time/Date Start:</label>
            <input type="text" class="form-control" id="time_date_start">
          </div>
          <div class="mb-3">
            <label for="user_id" class="col-form-label">use id:</label>
            <input type="text" class="form-control" id="user_id">
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