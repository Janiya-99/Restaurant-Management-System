@extends('layouts.main')

@section('title', 'Concessions')
@section('breadcrumb-item', 'Concessions')

@section('breadcrumb-item-active', 'Concessions List')

@section('css')
    <link rel="stylesheet" href="{{ URL::asset('build/css/plugins/style.css') }}">
    <link href="{{ URL::asset('build/css/plugins/animate.min.css') }}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="{{ URL::asset('build/css/uikit.css') }}">
@endsection

@section('content')
    <!-- [ Main Content ] start -->
    <div class="row">
        <!-- [ sample-page ] start -->
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-sm-flex align-items-center justify-content-between">
                        <h5>Concession List</h5>
                        @can('concession-concession-create')
                            <div>
                                <button type="button" class="btn btn-primary" id="addConcession">Add Concession</button>
                            </div>
                        @endcan
                    </div>
                </div>
                <div class="card-body">
                    <div class="card-body table-border-style">
                        <div class="table-responsive">
                            <table class="table table-sm data-table" id="pc-dt-simple">
                                <thead>
                                    <th>#</th>
                                    <th>Concession Name</th>
                                    <th>Image</th>
                                    <th>Description</th>
                                    <th>Action</th>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- [ Main Content ] end -->

    @include('pages.concession.modal')
@endsection
@section('scripts')
    <script type="text/javascript">
        $(function() {
            var table = $('.data-table').DataTable({
                dom: '<"top"lBf>rt<"bottom"ip><"clear">',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ],
                processing: true,
                serverSide: true,
                ajax: "{{ route('concessions.index') }}",
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'name',
                        name: 'name',
                    },
                    {
                        data: 'image',
                        name: 'image',
                    },
                    {
                        data: 'description',
                        name: 'description',
                        default: '-'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    }
                ],
            });
        });
    </script>

    <script>
        $('#addConcession').click(function() {
            $('#submitForm')[0].reset();
            $('.saveBtn').removeClass('btn-success').text('Save Concession');
            $('#submitForm').find('.is-invalid').removeClass('is-invalid');
            $('#submitForm').find('.invalid-feedback').remove();
            $('#modalTitle').text('Create New Concession');
            $('#submitForm').find('input[name="_method"]').remove();
            $('#submitForm').attr('action', '{{ route('concessions.store') }}');
            $('#concessionCreateModal').modal('show');
        });

        $(document).on('click', '.btn-presc-view', function() {
            var id = $(this).data('id');
            $('#prescription_id').val(id);
            loadConcession(id);
        });

        // load prescription
        function loadConcession(id) {
            $.ajax({
                url: '/prescriptions/' + id,
                method: 'GET',
                success: function(data) {
                    $('#prescription_number').text(data.prescription_number);
                    $('#user_name').text(data.user.name);
                    $('#user_age').text(data.user.aged);
                    $('#user_contact_no').text(data.user.contact_no);
                    $('#user_address').text(data.user.address);
                    $('#user_email').text(data.user.email);
                    $('#time_slot').text(data.time_slot.description);
                    $('#note').text(data.note);
                    if (data.images.length > 0) {
                        // Set main image
                        $('#main-image').attr('src', '/storage/' + data.images[0].image_path);

                        // Clear thumbnails
                        const thumbContainer = document.getElementById('thumbnail-container');
                        thumbContainer.innerHTML = '';

                        // Add thumbnails
                        data.images.forEach(image => {
                            const thumb = document.createElement('img');
                            thumb.src = '/storage/' + image.image_path;
                            thumb.className = 'thumb-img';
                            thumb.onclick = () => {
                                document.getElementById('main-image').src = '/storage/' + image
                                    .image_path;
                            };
                            thumbContainer.appendChild(thumb);
                        });
                    }
                },
                error: function(xhr) {
                    console.error('An error occurred:', xhr.responseText);
                }
            });
        }
    </script>
@endsection
