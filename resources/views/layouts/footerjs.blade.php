<script>
    //Handle Delete Function 
    function handleDelete(url, data) {
        Swal.fire({
            html: '<div class="mt-3">' +
                '<lord-icon src="https://cdn.lordicon.com/gsqxdxog.json" trigger="loop" colors="primary:#f7b84b,secondary:#f06548" style="width:100px;height:100px"></lord-icon>' +
                '<div class="mt-4 pt-2 fs-15 mx-5">' +
                '<h4>Are you Sure ?</h4>' +
                '<p class="text-muted mx-4 mb-0">Are you Sure You want to Delete this Record ?</p>' +
                '</div>' +
                '</div>',
            showCancelButton: true,
            confirmButtonClass: 'btn btn-primary w-xs me-2 mb-1',
            confirmButtonText: 'Yes, Delete It!',
            cancelButtonClass: 'btn btn-danger w-xs mb-1',
            buttonsStyling: false,
            showCloseButton: true
        }).then(function(confirm) {
            if (confirm.isConfirmed) {
                const Toast = Swal.mixin({
                    toast: true,
                    position: "bottom",
                    showConfirmButton: false,
                    timer: 2000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.onmouseenter = Swal.stopTimer;
                        toast.onmouseleave = Swal.resumeTimer;
                    }
                });
                $.ajax({
                    url: url,
                    type: 'DELETE',
                    dataType: 'json',
                    data: data,
                    success: function(response) {
                        Toast.fire({
                            icon: "success",
                            title: response.message
                        }).then(() => {
                            location.reload();
                        });
                    },
                    error: function(xhr, status, error) {
                        var errorMessage = xhr.responseJSON.message || 'An error occurred';
                        const Toast = Swal.mixin({
                            toast: true,
                            position: "bottom",
                            showConfirmButton: false,
                            timer: 2000,
                            timerProgressBar: true,
                            didOpen: (toast) => {
                                toast.onmouseenter = Swal.stopTimer;
                                toast.onmouseleave = Swal.resumeTimer;
                            }
                        });
                        Toast.fire({
                            icon: "error",
                            title: errorMessage
                        })
                    },
                });
            }
        });
    }
</script>

<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
    crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="{{ URL::asset('build/js/plugins/popper.min.js') }}"></script>
<script src="{{ URL::asset('build/js/plugins/simplebar.min.js') }}"></script>
<script src="{{ URL::asset('build/js/plugins/bootstrap.min.js') }}"></script>
<script src="{{ URL::asset('build/js/fonts/custom-font.js') }}"></script>
<script src="{{ URL::asset('build/js/pcoded.js') }}"></script>
<script src="{{ URL::asset('build/js/plugins/feather.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.all.min.js" aria-hidden="true"></script>

<!-- DataTables -->
<script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.5/js/dataTables.bootstrap5.min.js"></script>

<!-- DataTables Buttons -->
<script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.bootstrap5.min.js"></script>

<!-- Dependencies for Export Buttons -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>


{{-- SEARCHABLE DROPDOWN CDN --}}
<script>
    $(document).ready(function() {
        var Toast = Swal.mixin({
            toast: true,
            position: "bottom",
            showConfirmButton: false,
            timer: 2000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.onmouseenter = Swal.stopTimer;
                toast.onmouseleave = Swal.resumeTimer;
            }
        });

        $(document).on('focus', '.is-invalid', function() {
            $(this).removeClass('is-invalid');
        });

        $(this).siblings('.invalid-feedback').remove();

        // Function to display validation errors
        function handleValidationErrors(errors) {
            $.each(errors, function(key, messages) {
                let inputField;

                if (key.includes('.')) {
                    const parts = key.split('.');
                    const baseName = parts[0];
                    const index = parts[1];

                    if (parts.length === 2) {
                        inputField = $('[name="' + baseName + '[]"]').eq(index);
                    } else if (parts.length === 3) {
                        const fieldName = baseName + '[' + index + '][' + parts[2] + ']';
                        inputField = $('[name="' + fieldName + '"]');
                    }
                } else {
                    inputField = $('[name="' + key + '"]');
                }

                if (inputField.length) {
                    inputField.addClass('is-invalid');
                    if (inputField.closest('.form-group').find('.invalid-feedback').length === 0) {
                        inputField.closest('.form-group').append(
                            '<div class="invalid-feedback">' + messages[0] + '</div>'
                        );
                    }
                }
            });
        }

        // Function to handle ajax form submission with validation 
        function handleAjaxSubmit(formId, buttonClass, spinnerClass) {
            $(document).on('click', buttonClass, function(e) {
                e.preventDefault();

                $('.spinner-grow').show();
                $('.saveBtn').hide();
                $('.is-invalid').removeClass('is-invalid');
                $('.invalid-feedback').remove();

                const formElement = document.getElementById(formId.replace('#', ''));
                var formData = new FormData(formElement);

                $.ajax({
                    type: 'POST',
                    url: $(formId).attr('action'),
                    data: formData,
                    dataType: 'json',
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        Toast.fire({
                            icon: "success",
                            title: response.message
                        }).then(() => {
                            location.reload();
                            $('.spinner-grow').hide();
                            $('section[role="content"]').html(response);
                            if (response.redirect_url) {
                                window.location.href = response.redirect_url;
                            }
                        });
                    },
                    error: function(xhr) {
                        $('.spinner-grow').hide();
                        $('.saveBtn').show();

                        if (xhr.status === 422) {
                            var errors = xhr.responseJSON.errors;
                            handleValidationErrors(errors)
                        } else if (xhr.status === 500) {
                            const Toast = Swal.mixin({
                                toast: true,
                                position: "bottom",
                                showConfirmButton: false,
                                timer: 2000,
                                timerProgressBar: true,
                                didOpen: (toast) => {
                                    toast.onmouseenter = Swal.stopTimer;
                                    toast.onmouseleave = Swal.resumeTimer;
                                }
                            });
                            Toast.fire({
                                icon: "error",
                                title: errorMessage
                            })
                        }
                    }
                });
            });
        }

        //buttons and spinners
        handleAjaxSubmit('#submitForm', '.saveBtn', '.spinner-grow');
        handleAjaxSubmit('#submitFileForm', '.saveFileBtn', '.spinner-grow');
        handleAjaxSubmit('#submitActivityForm', '.saveActivityBtn', '.spinner-grow');
    });
</script>

<script>
    $(document).ready(function() {
        $('.image-input').on('change', function() {
            const input = this;
            const previewSelector = $(this).data('preview-target');
            const preview = $(previewSelector);

            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.attr('src', e.target.result).show();
                };
                reader.readAsDataURL(input.files[0]);
            } else {
                preview.attr('src', '#').hide();
            }
        });
    });
</script>

@if (env('APP_DARK_LAYOUT') == 'default')
    <script>
        if (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches) {
            dark_layout = 'true';
        } else {
            dark_layout = 'false';
        }
        layout_change_default();
        if (dark_layout == 'true') {
            layout_change('dark');
        } else {
            layout_change('light');
        }
    </script>
@endif

@if (env('APP_DARK_LAYOUT') != 'default')
    @if (env('APP_DARK_LAYOUT') == 'true')
        <script>
            layout_change('dark');
        </script>
    @endif
    @if (env('APP_DARK_LAYOUT') == false)
        <script>
            layout_change('light');
        </script>
    @endif
@endif


@if (env('APP_DARK_NAVBAR') == 'true')
    <script>
        layout_sidebar_change('dark');
    </script>
@endif

@if (env('APP_DARK_NAVBAR') == false)
    <script>
        layout_sidebar_change('light');
    </script>
@endif

@if (env('APP_BOX_CONTAINER') == false)
    <script>
        change_box_container('true');
    </script>
@endif

@if (env('APP_BOX_CONTAINER') == false)
    <script>
        change_box_container('false');
    </script>
@endif

@if (env('APP_CAPTION_SHOW') == 'true')
    <script>
        layout_caption_change('true');
    </script>
@endif

@if (env('APP_CAPTION_SHOW') == false)
    <script>
        layout_caption_change('false');
    </script>
@endif

@if (env('APP_RTL_LAYOUT') == 'true')
    <script>
        layout_rtl_change('true');
    </script>
@endif

@if (env('APP_RTL_LAYOUT') == false)
    <script>
        layout_rtl_change('false');
    </script>
@endif

@if (env('APP_PRESET_THEME') != '')
    <script>
        preset_change("{{ env('APP_PRESET_THEME') }}");
    </script>
@endif
