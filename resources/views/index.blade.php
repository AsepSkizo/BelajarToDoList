<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="#">{{ $title }}</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Features</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Pricing</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container">


        {{-- Modal Tambah List --}}
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah List</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="list-name" class="form-label">List</label>
                            <input type="text" class="form-control" id="list-name" placeholder="Gaming">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" id="cancel-list"
                            data-bs-dismiss="modal">Close</button>
                        <button type="submit" id="save-list" class="btn btn-primary">Save list</button>
                    </div>
                </div>
            </div>
        </div>

        {{-- Modal Update List --}}
        <div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Ubah Modal</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="update-name" class="form-label">List</label>
                            <input type="text" class="form-control" id="update-name" placeholder="Gaming">
                        </div>
                        <div class="mb-3">
                            <input type="hidden" class="form-control" id="idList" placeholder="">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" id="cancel-list"
                            data-bs-dismiss="modal">Close</button>
                        <button type="submit" id="save-change" class="btn btn-primary">Save Change</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 m-3">
            <div class="col-12 mb-3">
                <div class="d-flex justify-content-beetwen">
                    <span class="col-8">To Do List</span>
                    <button class="btn btn-sm btn-success col-1" id="add-item">New List <i
                            class="fa-solid fa-plus"></i></button>
                </div>
            </div>
            <ul class="list-group pt-4">
                <div id="list-container"></div>
            </ul>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"
        integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script src="https://kit.fontawesome.com/768f649122.js" crossorigin="anonymous"></script>

    <script>
        $(document).ready(function() {});
        showAllLists();

        $("#add-item").click(function() {
            //   alert("test");
            $("#exampleModal").modal("show");
        });

        $("#save-list").click(function(e) {
            //   alert("test");
            e.preventDefault();
            let listName = $("#list-name").val();
            if (listName != "") {
                $.ajax({
                    type: "POST",
                    url: "{{ route('list.store') }}",
                    data: {
                        _token: "{{ csrf_token() }}",
                        listName: listName,
                    },
                    dataType: "JSON",
                    success: function(response) {
                        showAllLists();
                        $("#list-name").val("");
                        $("#exampleModal").modal("hide");
                    },
                });
            }
        });

        function doneToDoList(idList) {
            console.log(idList);
            $.ajax({
                type: "POST",
                url: `{{ route('list.done') }}`,
                data: {
                    _token: `{{ csrf_token() }}`,
                    idList: idList,
                },
                dataType: "JSON",
                success: function(response) {
                    showAllLists();
                },
            });
        }

        function deleteToDoList(idList) {
            console.log(idList);
            $.ajax({
                type: "POST",
                url: `{{ route('list.delete') }}`,
                data: {
                    _token: `{{ csrf_token() }}`,
                    idList: idList,
                },
                dataType: "JSON",
                success: function(response) {
                    showAllLists();
                },
            });
        }

        function updateItem(idList, listLama) {
            // let lama = listLama;
            $("#updateModal").modal("show");
            $("#update-name").val(listLama);
            $("#idList").val(idList);
        }
        $("#save-change").click(function(e) {
            //   alert("test");
            e.preventDefault();
            let listUpdate = $("#update-name").val();
            let listId = $("#idList").val();
            if (listUpdate != "") {
                $.ajax({
                    type: "POST",
                    url: "{{ route('list.update') }}",
                    data: {
                        _token: "{{ csrf_token() }}",
                        listBaru: listUpdate,
                        idList: listId,
                    },
                    dataType: "JSON",
                    success: function(response) {
                        showAllLists();
                        $("#updateModal").modal("hide");
                    },
                });
            }
        });

        function showAllLists() {
            $.ajax({
                type: "GET",
                url: "{{ route('list.showAll') }}",
                dataType: "JSON",
                success: function(response) {
                    let listHtml = "";
                    response.data.forEach((list) => {
                        let action =
                            `<i onclick="doneToDoList(${list.id})" class="fa-solid fa-check fa-xl mx-1"></i>`;
                        let color = "list-group-item-primary";
                        if (list.done) {
                            action = "";
                            color = "list-group-item-success";
                        }
                        listHtml +=
                            `<li class='list-group-item ${color}'><div class='row'><div class='col-6 p-1'><span class='m-2'>${list.list_name}</span></div><div class='col-6 p-2'><div class='d-flex justify-content-end m-2'>${action}<i onclick="updateItem(${list.id},'${list.list_name}')" class="fa-solid fa-pen-to-square fa-xl mx-1"></i><i  onclick="deleteToDoList(${list.id})" class='fa-solid fa-trash fa-xl mx-1'></i></div></div></div></li>`;
                    });
                    $("#list-container").html(listHtml);
                },
            });
        }
    </script>
</body>

</html>
