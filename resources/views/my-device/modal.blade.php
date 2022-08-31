<div class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" id="device-modal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="device-modal-title">Edit Device</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                </button>
            </div>
            <div class="modal-body" id="device-modal-body">
                <form id="device-form">
                    <input type="hidden" class="form-control" id="device-id" name="id">
                    <div class="form-group">
                        <label for="device-type" class="col-form-label">Device Type:</label>
                        <select class="form-control" id="device-type" name="device_type">
                            <option selected="selected">Choose...</option>
                            <option value="stun_gun">Stunt Gun</option>
                            <option value="panic_button">Panic Button</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="device-uuid" class="col-form-label">UUID:</label>
                            <input type="text" class="form-control" id="device-uuid" name="uuid" readonly="readonly">
                    </div>
                    <div class="form-group">
                        <label for="device-api-key" class="col-form-label">API KEY:</label>
                            <input type="text" class="form-control" id="device-api-key" name="api_key" readonly="readonly">
                    </div>
                    <div class="form-group">
                        <label for="device-expired-at" class="col-form-label">Expired At:</label>
                        <input type="text" id="device-expired-at" class="form-control" name="expired_at">
                    </div>
                    <div class="form-group">
                        <label for="device-description" class="col-form-label">Description:</label>
                        <textarea class="form-control h-150px" rows="3" id="device-description" name="description"></textarea>
                    </div>
                    <div class="form-group">
                        <div class="form-check form-check-inline">
                            <label class="form-check-label">
                                <input type="checkbox" class="form-check-input" value="1" name="is_active"
                                    id="device-is-active">Is Active</label>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between align-items-center">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" id="device-modal-submit">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
