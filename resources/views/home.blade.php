@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="m-3">Books Details</h1>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    ALL Books
                    <div class="float-end">
                        <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#add-modal">Add book</button>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Title</th>
                                <th scope="col">Sub Title</th>
                                <th scope="col">Authors</th>
                            </tr>
                        </thead>
                        <tbody id="table-list">

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="add-modal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Create Book</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" ></button>
            </div>
            <div class="modal-body">
                <form id="add-post" method="post">
                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" class="form-control" id="title" name="title">
                    </div>
                    <div class="mb-3">
                        <label for="subtitle" class="form-label">Sub Title</label>
                        <input type="text" class="form-control" id="subtitle" name="subtitle">
                    </div>
                    <div class="mb-3">
                        <label for="authors" class="form-label">Authors</label>
                        <textarea class="form-control" id="authors" name="authors"></textarea>
                    </div>
                    <button type="button" id="add-submit" class="btn btn-primary">Submit</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="https://www.gstatic.com/firebasejs/8.0.0/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.0.0/firebase-database.js"></script>
    <script type="text/javascript">
        // Your web app's Firebase configuration
        const firebaseConfig = {
            apiKey: "{{ config('services.firebase.apiKey') }}",
            authDomain: "{{ config('services.firebase.authDomain') }}",
            databaseURL: "{{ config('services.firebase.databaseURL') }}",
            projectId: "{{ config('services.firebase.projectId') }}",
            storageBucket: "{{ config('services.firebase.storageBucket') }}",
            messagingSenderId: "{{ config('services.firebase.messagingSenderId') }}",
            appId: "{{ config('services.firebase.appId') }}"
        };

        // Initialize Firebase
        // console.log(firebaseConfig);
        const app = firebase.initializeApp(firebaseConfig);

        var database = firebase.database();

        var lastId = 0;

        // get post data
        database.ref("posts").on('value', function(snapshot) {
            var value = snapshot.val();
            var htmls = [];
            $.each(value, function(index, value){
                if(value) {
                    htmls.push('<tr>\
                        <td>'+ index +'</td>\
                        <td>'+ value.title +'</td>\
                        <td>'+ value.subtitle +'</td>\
                        <td>'+ value.authors +'</td>\
                    </tr>');
                }
                lastId = index;
            });
            $('#table-list').html(htmls);
        });

        // add data
        $('#add-submit').on('click', function() {
            var formData = $('#add-post').serializeArray();
            var createId = Number(lastId) + 1;

            firebase.database().ref('posts/' + createId).set({
                title: formData[0].value,
                subtitle: formData[1].value,
                authors: formData[1].value,
            });

            // Reassign lastID value
            lastId = createId;
            $("#add-post")[0].reset();
            $("#add-modal").modal('hide');
            window.location.reload();
        });
    </script>
@endsection
