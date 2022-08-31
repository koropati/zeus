<script type="text/javascript">
    var table;

    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        table = $('.yajra-datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('my-device.list') }}",
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'type',
                    name: 'type'
                },
                {
                    data: 'api_key',
                    name: 'api_key'
                },
                {
                    data: 'expired_at',
                    name: 'expired_at'
                },
                {
                    data: 'status_device',
                    name: 'status_device'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: true,
                    searchable: true
                },
            ]
        });

    });

    function prepShow(condition, res) {
        // Fill
        console.log("RES: ", res);
        if (res != "") {
            $('#device-id').val(res.data.id);
            $('#device-type').val(res.data.device_type).change();
            $('#device-uuid').val(res.data.uuid);
            $('#device-api-key').val(res.data.api_key);
            $('#device-expired-at').val(res.data.expired_at);
            $('#device-description').val(res.data.description);
            $('#device-is-active').val(res.data.is_active);

            if (res.data.is_active == 1) {
                $('#device-is-active').prop('checked', true);
            } else {
                $('#device-is-active').prop('checked', false);
            }
        }

        if (condition == "detail") {
            //Hide or show
            $('#device-modal-title').html("Detail Device");
            $("#device-modal-submit").hide();

            // Disabled or enabled
            $('#device-id').attr("disabled", true);
            $('#device-type').attr("disabled", true);
            $('#device-uuid').attr("disabled", true);
            $('#device-api-key').attr("disabled", true);
            $('#device-expired-at').attr("disabled", true);
            $('#device-description').attr("disabled", true);
            $('#device-is-active').attr("disabled", true);
        } else if (condition == "edit") {
            $("#device-modal-submit").html("Submit");
            $('#device-modal-title').html("Edit Device");
            //Hide or show
            $('#device-note').show();
            $('#device-password-section').show();
            $('#device-password-confirm-section').show();
            $("#device-modal-submit").show();

            // Disabled or enabled
            $('#device-id').attr("disabled", false);
            $('#device-type').attr("disabled", false);
            $('#device-uuid').attr("disabled", false);
            $('#device-api-key').attr("disabled", false);
            $('#device-expired-at').attr("disabled", false);
            $('#device-description').attr("disabled", false);
            $('#device-is-active').attr("disabled", false);
        } else if (condition == "create") {

            $('#device-modal-title').html("Add Device");
            $('#device-id').val('');
            //Hide or show
            $("#device-modal-submit").show();

            // Disabled or enabled
            $('#device-id').attr("disabled", false);
            $('#device-type').attr("disabled", false);
            $('#device-uuid').attr("disabled", false);
            $('#device-api-key').attr("disabled", false);
            $('#device-expired-at').attr("disabled", false);
            $('#device-description').attr("disabled", false);
            $('#device-is-active').attr("disabled", false);
        }
    }

    function detailFunc(id) {
        $.ajax({
            type: "GET",
            url: "{{ route('my-device.edit') }}",
            data: {
                id: id
            },
            dataType: 'json',
            success: function(res) {
                prepShow("detail", res);
                $('#device-modal').modal('show');

            },
            error: function(request, status, error) {
                MyMessage("error", error, request.responseJSON.message);
            }
        });
    }

    function detailLogFunc(id) {
        var urlRedirect = "{{ route('my-device-log.index', ':id_device') }}";
        urlRedirect = urlRedirect.replace(':id_device', "id_device="+id);
        window.open(urlRedirect);
    }

</script>
