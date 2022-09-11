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
                    <div class="form-group">
                        <label for="user-email" class="col-form-label">Phone Number:</label>
                        <input type="text" class="form-control" id="user-phone-number" name="phone_number">
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
                    
                    <div class="alert alert-success" id="user-account">
                        <h4 class="alert-heading">Account Plan</h4>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>Account Type</label>
                                <select id="user-account-type" name="account_type" class="form-control">
                                    <option value="free">FREE</option>
                                    <option value="standard">STANDARD</option>
                                    <option value="enterprise">ENTERPRISE</option>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Device Number</label>
                                <input type="number" class="form-control" id="user-account-device-number" name="device_number">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>Expired At</label>
                                <input type="text" class="form-control" placeholder="2017-06-04" id="user-account-expired-at" name="expired_at">
                            </div>
                            <div class="form-group col-md-6">
                                <label>Request Quota</label>
                                <input type="number" class="form-control" id="user-account-request-quota" name="request_quota">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label>Account </label>
                                <label class="radio-inline mr-3">
                                    <input type="radio" name="is_active" id="user-account-active" value="1"> Active</label>
                                <label class="radio-inline mr-3">
                                    <input type="radio" name="is_active" id="user-account-non-active" value="0"> Non Active</label>
                            </div>
                        </div>
                        <hr>
                        <p class="mb-0">Whenever you need to, be sure to use margin utilities to keep things nice and tidy.</p>
                    </div>

                    <div class="d-flex justify-content-between align-items-center">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" id="user-modal-submit">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
