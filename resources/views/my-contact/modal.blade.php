<div class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" id="contact-modal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="contact-modal-title">Edit Contact</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                </button>
            </div>
            <div class="modal-body" id="contact-modal-body">
                <form id="contact-form">
                    <input type="hidden" class="form-control" id="contact-id" name="id">
                    <input type="hidden" class="form-control" id="contact-user-id" name="user_id" value="{{ auth()->user()->id }}">
                    <div class="form-group">
                        <label for="contact-name" class="col-form-label">Name:</label>
                        <input type="text" class="form-control" id="contact-name" name="name">
                    </div>
                    <div class="form-group">
                        <label for="contact-email" class="col-form-label">Email:</label>
                        <input type="email" class="form-control" id="contact-email" name="email">
                    </div>
                    <div class="form-group">
                        <label for="contact-phone-number" class="col-form-label">Phone Number:</label>
                        <input type="text" class="form-control" id="contact-phone-number" name="phone_number">
                    </div>
                    <div class="form-group">
                        <label for="contact-address" class="col-form-label">Address:</label>
                        <textarea class="form-control h-150px" rows="3" id="contact-address" name="address"></textarea>
                    </div>
                    <div class="form-group">
                        <div class="form-check form-check-inline">
                            <label class="form-check-label">
                                <input type="checkbox" class="form-check-input" value="1" name="is_emergency"
                                    id="contact-is-emergency">Is Emergency</label>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between align-items-center">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" id="contact-modal-submit">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
