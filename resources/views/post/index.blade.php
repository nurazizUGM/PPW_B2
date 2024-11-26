@extends('layout')
@section('content')
    <div class="card mt-3">
        <div class="card-header d-flex align-items-center">
            Post
            <a href="{{ route('post.create') }}" class="btn btn-sm btn-primary ms-auto">Create</a>
        </div>
        <div class="card-body" id="post-container">
            <div class="spinner-border" role="status" id="loading-spinner">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
    </div>
@endsection

@section('style')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/lightbox2@2.11.5/dist/css/lightbox.min.css">
@endsection

@section('script')
    <script src="https://cdn.jsdelivr.net/npm/lightbox2@2.11.5/dist/js/lightbox.min.js"></script>
    <script>
        let editRoute = "{{ route('post.edit', ':id') }}";

        function deletePost(id) {
            if (confirm('Are you sure?')) {
                $.ajax({
                    url: `{{ route('api.gallery.delete', ':id') }}`.replace(':id', id),
                    method: 'DELETE',
                    error: function(response) {
                        const alert = $(`<div class="alert alert-danger alert-dismissible fade show" role="alert">
                        ${response.statusText}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>`);
                        $('#alert-box').append(alert);
                    },
                    success: function(response) {
                        loadData();
                    }
                })
            }
        }

        function loadData() {
            $('#loading-spinner').show();
            $('#post-items').remove();
            $.ajax({
                url: '{{ route('api.gallery.index') }}',
                error: function() {
                    $('#post-container').html('<p>Failed to load data</p>');
                },
                success: function(response) {
                    if (response.length == 0) {
                        $('#post-container').html('<p>No Post Found</p>');
                    } else {
                        const container = $(
                            '<div class="w-100 d-flex overflow-x-auto gap-2" id="post-items"></div>');
                        for (let post of response) {
                            container.append(`<div class="d-flex flex-column justify-center position-relative">
                            <a href="{{ asset('storage') }}/${post.picture}" data-lightbox="roadtrip"
                                data-title="${post.title}">
                                <img src="{{ asset('storage') }}/${post.picture}" alt="Post Picture" height="100rem"
                                    class="w-100 object-fit-cover">
                            </a>
                            <a href="${editRoute.replace(':id', post.id)}"
                                class="position-absolute start-0 bottom-0 rounded-circle border-0 bg-secondary bg-opacity-75"
                                style="width: 24px">
                                <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                                    <g fill="none" stroke="#ffdd00" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2">
                                        <path stroke-dasharray="20" stroke-dashoffset="20" d="M3 21h18">
                                            <animate fill="freeze" attributeName="stroke-dashoffset" dur="0.2s"
                                                values="20;0" />
                                        </path>
                                        <path stroke-dasharray="48" stroke-dashoffset="48"
                                            d="M7 17v-4l10 -10l4 4l-10 10h-4">
                                            <animate fill="freeze" attributeName="stroke-dashoffset" begin="0.2s"
                                                dur="0.6s" values="48;0" />
                                        </path>
                                        <path stroke-dasharray="8" stroke-dashoffset="8" d="M14 6l4 4">
                                            <animate fill="freeze" attributeName="stroke-dashoffset" begin="0.8s"
                                                dur="0.2s" values="8;0" />
                                        </path>
                                    </g>
                                </svg>
                            </a>
                            <button class="position-absolute end-0 bottom-0 rounded-circle border-0 bg-secondary bg-opacity-75" onclick="deletePost(${post.id})">
                                <svg xmlns="http://www.w3.org/2000/svg" width="0.88em" height="1em"
                                    viewBox="0 0 448 512">
                                    <path fill="#ff0000"
                                        d="M432 32H312l-9.4-18.7A24 24 0 0 0 281.1 0H166.8a23.72 23.72 0 0 0-21.4 13.3L136 32H16A16 16 0 0 0 0 48v32a16 16 0 0 0 16 16h416a16 16 0 0 0 16-16V48a16 16 0 0 0-16-16M53.2 467a48 48 0 0 0 47.9 45h245.8a48 48 0 0 0 47.9-45L416 128H32z" />
                                </svg>
                            </button>
                        </div>`)
                        }
                        $('#post-container').html(container);
                    }
                }
            })
        }

        $(document).ready(loadData)
    </script>
@endsection
