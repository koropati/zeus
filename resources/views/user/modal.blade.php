<div class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" id="user-modal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="user-modal-title">Edit User</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                </button>
            </div>
            <div class="modal-body" id="user-modal-body">
                <form id="user-form">
                    <input type="hidden" class="form-control" id="user-id" name="id">
                    <div class="form-group">
                        <label for="user-name" class="col-form-label">Name:</label>
                        <input type="text" class="form-control" id="user-name" name="name">
                    </div>
                    <div class="form-group">
                        <label for="user-email" class="col-form-label">Email:</label>
                        <input type="email" class="form-control" id="user-email" name="email">
                    </div>
                    <div class="card-content" id="user-note">
                        <div class="alert alert-success">
                            <h4 class="alert-heading">Note!</h4>
                            <p>If you don't want to change your password, please leave the input password field blank
                                below.</p>
                        </div>
                    </div>
                    <div class="form-group" id="user-password-section">
                        <label for="user-password" class="col-form-label">Password:</label>
                        <input type="password" class="form-control" id="user-password" name="password">
                    </div>
                    <div class="form-group" id="user-password-confirm-section">
                        <label for="user-password-confirm" class="col-form-label">Password Confirmation:</label>
                        <input type="password" class="form-control" id="user-password-confirm" name="password_confirm">
                    </div>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="user-modal-submit">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
