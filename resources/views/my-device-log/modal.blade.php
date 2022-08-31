<div class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" id="device-log-modal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="device-log-modal-title">Detail Log Device</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                </button>
            </div>
            <div class="modal-body" id="device-log-modal-body">
                <form id="device-log-form">
                    <input type="hidden" class="form-control" id="device-log-id" name="id">
                    <div class="form-group">
                        <label for="device-log-uuid" class="col-form-label">UUID:</label>
                        <input type="text" class="form-control" id="device-log-uuid">
                    </div>
                    <div class="form-group">
                        <label for="device-uuid" class="col-form-label">DEVICE UUID:</label>
                        <input type="text" class="form-control" id="device-log-device">
                    </div>
                    <div class="form-group">
                        <label for="device-log-ip-address" class="col-form-label">IP Address:</label>
                        <input type="text" class="form-control" id="device-log-ip-address">
                    </div>
                    <div class="form-group">
                        <label for="device-log-created-at" class="col-form-label">Created At:</label>
                        <input type="text" id="device-log-created-at" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="device-log-status" class="col-form-label">Status:</label>
                        <input type="text" id="device-log-status" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="device-log-code" class="col-form-label">Code:</label>
                        <input type="text" id="device-log-code" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="device-log-data" class="col-form-label">Data:</label>
                        <textarea class="form-control h-150px" rows="3" id="device-log-data"></textarea>
                    </div>

                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="device-log-modal-submit">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>