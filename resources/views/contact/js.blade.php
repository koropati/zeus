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
            ajax: "{{ route('contact.list') }}",
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
                    data: 'phone_number',
                    name: 'phone_number'
                },
                {
                    data: 'status',
                    name: 'status'
                },
                {
                    data: 'owner',
                    name: 'owner'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: true,
                    searchable: true
                },
            ]
        });

        var urlUserDropDown = "{{ route('user.drop-down') }}";

        $("#contact-owner").select2({
            dropdownParent: $("#contact-modal"),
            placeholder: 'Select an user',
            ajax: {
                url: urlUserDropDown,
                dataType: 'json',
                delay: 250,
                processResults: function(data) {
                    return {
                        results: $.map(data, function(item) {
                            return {
                                text: item.name,
                                slug: item.email,
                                id: item.id
                            }
                        })
                    };
                },
                cache: true
            }
        });

        $('#contact-is-emergency').change(function() {
            cb = $(this);
            cb.val(cb.prop('checked') ? 1 : 0);
        });
    });

    function prepShow(condition, res) {
        // Fill
        console.log("RES: ", res);
        if (res != "") {
            $('#contact-id').val(res.data.id);
            $('#contact-name').val(res.data.name);
            $('#contact-email').val(res.data.email);
            $('#contact-phone-number').val(res.data.phone_number);
            $('#contact-address').val(res.data.address);
            $('#contact-is-emergency').val(res.data.is_emergency);

            // Set the value, creating a new option if necessary
            if ($('#contact-owner').find("option[value='" + res.data.user_id + "']").length) {
                $('#contact-owner').val(res.data.user_id).trigger('change');
            } else {
                // Create a DOM Option and pre-select by default
                var newOption = new Option(res.data.user.name, res.data.user_id, true, true);
                // Append it to the select
                $('#contact-owner').append(newOption).trigger('change');
            }

            if (res.data.is_emergency == 1) {
                $('#contact-is-emergency').prop('checked', true);
            } else {
                $('#contact-is-emergency').prop('checked', false);
            }
        }

        if (condition == "detail") {
            //Hide or show
            $('#contact-modal-title').html("Detail Contact");
            $("#contact-modal-submit").hide();

            // Disabled or enabled
            $('#contact-id').attr("disabled", true);
            $('#contact-name').attr("disabled", true);
            $('#contact-email').attr("disabled", true);
            $('#contact-phone-number').attr("disabled", true);
            $('#contact-address').attr("disabled", true);
            $('#contact-is-emergency').attr("disabled", true);
            $('#contact-owner').attr("disabled", true);
        } else if (condition == "edit") {
            $("#contact-modal-submit").html("Submit");
            $('#contact-modal-title').html("Edit Contact");
            //Hide or show
            $('#contact-note').show();
            $('#contact-password-section').show();
            $('#contact-password-confirm-section').show();
            $("#contact-modal-submit").show();

            // Disabled or enabled
            $('#contact-id').attr("disabled", false);
            $('#contact-name').attr("disabled", false);
            $('#contact-email').attr("disabled", false);
            $('#contact-phone-number').attr("disabled", false);
            $('#contact-address').attr("disabled", false);
            $('#contact-is-emergency').attr("disabled", false);
            $('#contact-owner').attr("disabled", false);
        } else if (condition == "create") {
            $('#select2-contact-owner-container').html("");
            $('#contact-modal-title').html("Add Contact");
            $('#contact-id').val('');

            //Hide or show
            $("#contact-modal-submit").show();

            // Disabled or enabled
            $('#contact-id').attr("disabled", false);
            $('#contact-name').attr("disabled", false);
            $('#contact-email').attr("disabled", false);
            $('#contact-phone-number').attr("disabled", false);
            $('#contact-address').attr("disabled", false);
            $('#contact-is-emergency').attr("disabled", false);
            $('#contact-owner').attr("disabled", false);
        }
    }

    function add() {
        prepShow("create", "");

        $('#contact-form').trigger("reset");
        $('#contact-modal').modal('show');
    }

    function detailFunc(id) {
        $.ajax({
            type: "GET",
            url: "{{ route('contact.edit') }}",
            data: {
                id: id
            },
            dataType: 'json',
            success: function(res) {
                prepShow("detail", res);
                $('#contact-modal').modal('show');

            },
            error: function(request, status, error) {
                MyMessage("error", error, request.responseJSON.message);
            }
        });
    }

    function editFunc(id) {
        $.ajax({
            type: "GET",
            url: "{{ route('contact.edit') }}",
            data: {
                id: id
            },
            dataType: 'json',
            success: function(res) {
                prepShow("edit", res);
                $('#contact-modal').modal('show');

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
                        url: "{{ route('contact.destroy') }}",
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
    $("#contact-form").on('submit', function(e) {
        e.preventDefault();
        $("#contact-modal-submit").attr("disabled", true);
        var formData = new FormData(this);
        console.log("DATA", formData);
        $.ajax({
            type: 'POST',
            url: "{{ route('contact.store') }}",
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: (data) => {
                $("#contact-modal").modal('hide');
                table.ajax.reload();
                $("#contact-modal-submit").html('Submit');
                $("#contact-modal-submit").attr("disabled", false);
                MyMessage("success", "Success", data.message);
            },
            error: function(request, status, error) {
                MyMessage("error", error, request.responseJSON.message);
                $("#contact-modal-submit").attr("disabled", false);
            }
        });
    });
</script>
