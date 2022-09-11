<script type="text/javascript">
    var table;

    function getMillis() {
        const d = new Date();
        return String(d.getTime());
    }

    const shuffle = str => [...str].sort(() => Math.random() - .5).join('');

    function makeID(length) {
        var result = '';
        var characters = shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789' + getMillis());
        var charactersLength = characters.length;
        for (var i = 0; i < length; i++) {
            result += characters.charAt(Math.floor(Math.random() *
                charactersLength));
        }
        return result;
    }


    function generateUUID() {
        var d = new Date().getTime();
        if (window.performance && typeof window.performance.now === "function") {
            d += performance.now();
        }
        var uuid = 'xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx'.replace(/[xy]/g, function(c) {
            var r = (d + Math.random() * 16) % 16 | 0;
            d = Math.floor(d / 16);
            return (c == 'x' ? r : (r & 0x3 | 0x8)).toString(16);
        });
        return uuid;
    }

    function generateAPIKey() {
        return makeID(8) + "-" + makeID(8) + "-" + makeID(8);
    };

    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        table = $('.yajra-datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('device.list') }}",
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

        $('#device-expired-at').bootstrapMaterialDatePicker({
            format: 'YYYY-MM-DD hh:mm:ss'
        });

        var urlUserDropDown = "{{ route('user.drop-down') }}";

        $("#device-owner").select2({
            theme: "bootstrap",
            dropdownParent: $("#device-modal"),
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

        $('#device-is-active').change(function() {
            cb = $(this);
            cb.val(cb.prop('checked') ? 1 : 0);
        });

        $('#device-owner').change(function() {
            generateDescription();
        });

        $('#device-type').change(function() {
            generateDescription();
        });

        $('#create-new-device').on('click', function() {
            let myUUID = generateUUID();
            let myAPIKey = generateAPIKey();

            $('#device-uuid').val(myUUID);
            $('#device-api-key').val(myAPIKey);
        });

        $('#generate-uuid').on('click', function() {
            $('#device-uuid').val(generateUUID());
            generateDescription();
        });

        $('#generate-api-key').on('click', function() {
            $('#device-api-key').val(generateAPIKey());
        });
    });

    function generateDescription() {
        var dataDescription = "";
        dataDescription = dataDescription + $('#device-type').val();
        dataDescription = dataDescription + " OWNER: " + $('#device-owner').val();
        dataDescription = dataDescription + " UNIQ: " + $('#device-uuid').val();
        $('#device-description').val(dataDescription);
    }

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

            // Set the value, creating a new option if necessary
            if ($('#device-owner').find("option[value='" + res.data.user_id + "']").length) {
                $('#device-owner').val(res.data.user_id).trigger('change');
            } else {
                // Create a DOM Option and pre-select by default
                var newOption = new Option(res.data.user.name, res.data.user_id, true, true);
                // Append it to the select
                $('#device-owner').append(newOption).trigger('change');
            }

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
            $('#device-owner').attr("disabled", true);
            $('#generate-uuid').attr("disabled", true);
            $('#generate-api-key').attr("disabled", true);
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
            $('#device-owner').attr("disabled", false);
            $('#generate-uuid').attr("disabled", false);
            $('#generate-api-key').attr("disabled", false);
        } else if (condition == "create") {
            let myUUID = generateUUID();
            let myAPIKey = generateAPIKey();
            $('#select2-device-owner-container').html("");
            $('#device-modal-title').html("Add Device");

            $('#device-id').val('');
            $('#device-uuid').val(myUUID);
            $('#device-api-key').val(myAPIKey);

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
            $('#device-owner').attr("disabled", false);
            $('#generate-uuid').attr("disabled", false);
            $('#generate-api-key').attr("disabled", false);
        }
    }

    function add() {
        prepShow("create", "");

        $('#device-form').trigger("reset");
        $('#device-modal').modal('show');
    }

    function detailFunc(id) {
        $.ajax({
            type: "GET",
            url: "{{ route('device.edit') }}",
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

    function editFunc(id) {
        $.ajax({
            type: "GET",
            url: "{{ route('device.edit') }}",
            data: {
                id: id
            },
            dataType: 'json',
            success: function(res) {
                prepShow("edit", res);
                $('#device-modal').modal('show');

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
                        url: "{{ route('device.destroy') }}",
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
    $("#device-form").on('submit', function(e) {
        e.preventDefault();
        $("#device-modal-submit").attr("disabled", true);
        var formData = new FormData(this);
        console.log("DATA", formData);
        $.ajax({
            type: 'POST',
            url: "{{ route('device.store') }}",
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: (data) => {
                $("#device-modal").modal('hide');
                table.ajax.reload();
                $("#device-modal-submit").html('Submit');
                $("#device-modal-submit").attr("disabled", false);
                MyMessage("success", "Success", data.message);
            },
            error: function(request, status, error) {
                MyMessage("error", error, request.responseJSON.message);
                $("#device-modal-submit").attr("disabled", false);
            }
        });
    });
</script>
