<br><br><br>
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo">Create New User</button>

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">New User</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form>
          <div class="mb-3">
            <label for="username" class="col-form-label">username:</label>
            <input type="text" class="form-control" id="username">
          </div>
          <div class="mb-3">
            <label for="email" class="col-form-label">Email:</label>
            <input type="text" class="form-control" id="email">
          </div>
          <div class="mb-3">
            <label for="phone" class="col-form-label">Phone:</label>
            <input type="text" class="form-control" id="phone">
          </div>
          <div class="mb-3">
            <label for="dob" class="col-form-label">DOB:</label>
            <input type="date" class="form-control" id="dob">
          </div>
          <div class="mb-3">
            <label for="image" class="col-form-label">image:</label>
            <input type="text" class="form-control" id="image">
          </div>
          <div class="mb-3">
            <label for="role" class="col-form-label">Role:</label>
            <input type="text" class="form-control" id="role">
          </div>
          <div class="mb-3">
            <label for="password" class="col-form-label">Password:</label>
            <input type="text" class="form-control" id="password">
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Send message</button>
      </div>
    </div>
  </div>
</div>