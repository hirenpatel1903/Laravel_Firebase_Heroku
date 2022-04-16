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
                                <th scope="col">Content</th>
                                <th scope="col">Action</th>
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
<script src="https://www.gstatic.com/firebasejs/8.0.0/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.0.0/firebase-database.js"></script>
    <script type="text/javascript">
        // Your web app's Firebase configuration
        const firebaseConfig = {
            apiKey: "{{ config('services.firebase.api_key') }}",
            authDomain: "{{ config('services.firebase.auth_domain') }}",
            databaseURL: "{{ config('services.firebase.database_url') }}",
            projectId: "{{ config('services.firebase.project_id') }}",
            storageBucket: "{{ config('services.firebase.storage_bucket') }}",
            messagingSenderId: "{{ config('services.firebase.messaging_sender_id') }}",
            appId: "{{ config('services.firebase.app_id') }}"
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
                        <td>'+ value.content +'</td>\
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
                content: formData[1].value,
            });

            // Reassign lastID value
            lastId = createId;
            $("#add-post")[0].reset();
            $("#add-modal").modal('hide');
        });
    </script>
@endsection
