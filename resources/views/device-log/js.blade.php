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
            ajax: "{{ route('device-log.list') }}",
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'device',
                    name: 'device'
                },
                {
                    data: 'ip_address',
                    name: 'ip_address'
                },
                {
                    data: 'status',
                    name: 'status'
                },
                {
                    data: 'code',
                    name: 'code'
                },
                {
                    data: 'created_at',
                    name: 'created_at'
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
            $('#device-log-id').val(res.data.id);
            $('#device-log-device').val(res.data.device.uuid);
            $('#device-log-ip-address').val(res.data.ip_address);
            $('#device-log-uuid').val(res.data.uuid);
            $('#device-log-status').val(res.data.status);
            $('#device-log-code').val(res.data.code);
            $('#device-log-data').val(res.data.data);
            $('#device-log-created-at').val(res.data.created_at);
        }

        if (condition == "detail") {
            //Hide or show
            $('#device-log-modal-title').html("Detail Device");
            $("#device-log-modal-submit").hide();

            // Disabled or enabled
            $('#device-log-id').attr("disabled", true);
            $('#device-log-ip-address').attr("disabled", true);
            $('#device-log-device').attr("disabled", true);
            $('#device-log-uuid').attr("disabled", true);
            $('#device-log-status').attr("disabled", true);
            $('#device-log-code').attr("disabled", true);
            $('#device-log-data').attr("disabled", true);
            $('#device-log-created-at').attr("disabled", true);
        }
    }

    function detailFunc(id) {
        $.ajax({
            type: "GET",
            url: "{{ route('device-log.edit') }}",
            data: {
                id: id
            },
            dataType: 'json',
            success: function(res) {
                prepShow("detail", res);
                $('#device-log-modal').modal('show');

            },
            error: function(request, status, error) {
                MyMessage("error", error, request.responseJSON.message);
            }
        });
    }

    function deleteFunc(id) {
        var id = id;
        swal({
                title: "Are you sure?",
                text: "want to delete.",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes!",
                cancelButtonText: "No, cancel please!",
                closeOnConfirm: false,
                closeOnCancel: false
            },
            function(isConfirm) {
                if (isConfirm) {
                    // ajax
                    $.ajax({
                        type: "POST",
                        url: "{{ route('device-log.destroy') }}",
                        data: {
                            id: id
                        },
                        dataType: 'json',
                        success: function(data) {
                            table.ajax.reload();
                            swal("Deleted", "Success Deleted Data", "success");
                        },
                        error: function(request, status, error) {
                            MyMessage("error", error, request.responseJSON.message);
                        }
                    });
                } else {
                    swal("Cancelled", "Your data still in system :)", "error");
                }
            });
    }

    function deleteAll() {
        $("#device-log-modal-submit-delete").attr("disabled", true);
        $("#device-log-password").attr("disabled", true);
        $.ajax({
            type: "POST",
            url: "{{ route('device-log.destroy') }}",
            data: {
                password: $("#device-log-password").val()
            },
            dataType: 'json',
            success: function(data) {
                table.ajax.reload();
                $('#device-log-form').trigger("reset");
                $("#device-log-modal-submit-delete").attr("disabled", false);
                $("#device-log-password").attr("disabled", false);
                $("#device-log-modal-delete").modal('hide');
                swal("Deleted", "Success Deleted Data", "success");
            },
            error: function(request, status, error) {
                $("#device-log-modal-submit-delete").attr("disabled", false);
                $("#device-log-password").attr("disabled", false);
                $('#device-log-form').trigger("reset");
                MyMessage("error", error, request.responseJSON.message);
            }
        });
    }

    $("#device-log-form-delete").on('submit', function(e) {
        e.preventDefault();
        $("#device-log-modal-submit-delete").attr("disabled", true);
        $("#device-log-password").attr("disabled", true);
        var formData = new FormData(this);
        $.ajax({
            type: 'POST',
            url: "{{ route('device-log.destroy-all') }}",
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: (data) => {
                table.ajax.reload();
                $('#device-log-form').trigger("reset");
                $("#device-log-modal-submit-delete").attr("disabled", false);
                $("#device-log-password").attr("disabled", false);
                $("#device-log-modal-delete").modal('hide');
                swal("Deleted", "Success Deleted Data", "success");
            },
            error: function(request, status, error) {
                $("#device-log-modal-submit-delete").attr("disabled", false);
                $("#device-log-password").attr("disabled", false);
                $('#device-log-form').trigger("reset");
                MyMessage("error", error, request.responseJSON.message);
            }
        });
    });
</script>
