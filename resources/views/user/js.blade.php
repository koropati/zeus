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
            ajax: "{{ route('user.list') }}",
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'email',
                    name: 'email'
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
        $('#user-password').val("");
        $('#user-password-confirm').val("");

        if (res != "") {
            $('#user-id').val(res.response.data.id);
            $('#user-name').val(res.response.data.name);
            $('#user-email').val(res.response.data.email);
        }

        if (condition == "detail") {
            //Hide or show
            $('#user-note').hide();
            $('#user-password-section').hide();
            $('#user-password-confirm-section').hide();
            $('#user-modal-title').html("Detail User");
            $("#user-modal-submit").hide();

            // Disabled or enabled
            $('#user-id').attr("disabled", true);
            $('#user-name').attr("disabled", true);
            $('#user-email').attr("disabled", true);
        } else if (condition == "edit") {
            $("#user-modal-submit").html("Submit");
            $('#user-modal-title').html("Edit User");
            //Hide or show
            $('#user-note').show();
            $('#user-password-section').show();
            $('#user-password-confirm-section').show();
            $("#user-modal-submit").show();

            // Disabled or enabled
            $('#user-id').attr("disabled", false);
            $('#user-name').attr("disabled", false);
            $('#user-email').attr("disabled", false);
        } else if (condition == "create") {
            
            $('#user-modal-title').html("Add User");
            $('#user-id').val('');

            //Hide or show
            $('#user-password-section').show();
            $('#user-password-confirm-section').show();
            $("#user-modal-submit").show();
            $('#user-note').hide();

            // Disabled or enabled
            $('#user-id').attr("disabled", false);
            $('#user-name').attr("disabled", false);
            $('#user-email').attr("disabled", false);
        }
    }

    function add() {
        prepShow("create", "");

        $('#user-form').trigger("reset");
        $('#user-modal').modal('show');
    }

    function detailFunc(id) {
        $.ajax({
            type: "GET",
            url: "{{ route('user.edit') }}",
            data: {
                id: id
            },
            dataType: 'json',
            success: function(res) {
                prepShow("detail", res);
                $('#user-modal').modal('show');

            },
            error: function(request, status, error) {
                MyMessage("error", error, request.responseJSON.message);
            }
        });
    }

    function editFunc(id) {
        $.ajax({
            type: "GET",
            url: "{{ route('user.edit') }}",
            data: {
                id: id
            },
            dataType: 'json',
            success: function(res) {
                prepShow("edit", res);
                $('#user-modal').modal('show');
                
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
                        url: "{{ route('user.destroy') }}",
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
    $("#user-form").on('submit', function(e) {
        e.preventDefault();
        $("#user-modal-submit").attr("disabled", true);
        var formData = new FormData(this);
        console.log("DATA", formData);
        $.ajax({
            type: 'POST',
            url: "{{ route('user.store') }}",
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: (data) => {
                $("#user-modal").modal('hide');
                table.ajax.reload();
                $("#user-modal-submit").html('Submit');
                $("#user-modal-submit").attr("disabled", false);
                MyMessage("success", "Success", data.message);
            },
            error: function(request, status, error) {
                MyMessage("error", error, request.responseJSON.message);
                $("#user-modal-submit").attr("disabled", false);
            }
        });
    });
</script>
