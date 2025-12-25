
<?php include_once "auth.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Books CRUD</title>

    <!-- Bootstrap CSS -->
    <link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/dist/css/admin.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/fa/css/font-awesome.min.css">

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <style>
        #bookImagePreview {
            width: 120px;
            height: 120px;
            object-fit: cover;
            border-radius: 5px;
            border: 1px solid #ddd;
        }
        .pointer { cursor: pointer; }
    </style>
</head>
<body>

<!-- Sidebar -->
<?php include_once "sidebar.php" ?>

<div class="content p-4">

    <nav class="navbar navbar-light bg-white shadow-sm mb-4 p-3 rounded">
        <h4 class="m-0">Books </h4>
    </nav>

    <button class="btn btn-primary mb-3" id="addBookBtn">+ Add New Book</button>

    <!-- Alerts -->
    <div id="alertBox"></div>

    <!-- Books Table -->
    <div class="card shadow-sm">
        <div class="card-header">Books List</div>
        <div class="card-body p-0">
            <table class="table table-striped table-hover mb-0" id="booksTable">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Written By</th>
                        <th>Summary</th>
                        <th width="150">Actions</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
</div>


<!-- ADD/EDIT MODAL -->
<div class="modal fade" id="bookModal" tabindex="-1">
    <div class="modal-dialog">
        <form id="bookForm" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 id="modalTitle">Add Book</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">

                    <input type="hidden" name="id" id="bookId">
                    <input type="hidden" name="old_image" id="oldImage">

                    <div class="mb-3">
                        <label>Book Name</label>
                        <input type="text" name="name" id="bookName" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label>Written By</label>
                        <input type="text" name="written_by" id="bookWriter" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label>Short Summary</label>
                        <textarea name="summary" id="bookSummary" class="form-control" required></textarea>
                    </div>

                    <div class="mb-3">
                        <label>Book Image</label>
                        <input type="file" name="image" id="bookImage" class="form-control" accept="image/*">

                        <img id="bookImagePreview" class="mt-2 d-none" />
                    </div>

                </div>

                <div class="modal-footer">
                    <button class="btn btn-primary">Save</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>

            </div>
        </form>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>


<script>
/* -----------------------------
   Load Books List
--------------------------------*/
function loadBooks() {
    $.post("crud/book_api.php", { action: "list" }, function(data) {
        let rows = "";
        let i = 1;

        data.forEach(book => {
            rows += `
                <tr>
                    <td>${i++}</td>
                    <td><img src="http://localhost/ekta/admin/crud/uploads/books/${book.image}" width="60" height="60" style="object-fit:cover;border-radius:5px"></td>
                    <td>${book.name}</td>
                    <td>${book.written_by}</td>
                    <td>${book.summary.substring(0,40)}...</td>
                    <td>
                        <button class="btn btn-sm btn-warning editBtn" data-id="${book.id}">Edit</button>
                        <button class="btn btn-sm btn-danger deleteBtn" data-id="${book.id}">Delete</button>
                    </td>
                </tr>
            `;
        });

        $("#booksTable tbody").html(rows);
    }, "json");
}

loadBooks();


/* -----------------------------
   Add Button → open modal
--------------------------------*/
$("#addBookBtn").click(function() {
    $("#modalTitle").text("Add Book");
    $("#bookForm")[0].reset();
    $("#bookImagePreview").addClass("d-none");
    $("#bookId").val("");
    $("#oldImage").val("");
    $("#bookModal").modal("show");
});


/* -----------------------------
   Edit Book
--------------------------------*/
$(document).on("click", ".editBtn", function () {
    let id = $(this).data("id");

    $.post("crud/book_api.php", { action: "get", id }, function (book) {
        
        $("#modalTitle").text("Edit Book");
        $("#bookId").val(book.id);
        $("#bookName").val(book.name);
        $("#bookWriter").val(book.written_by);
        $("#bookSummary").val(book.summary);

        $("#oldImage").val(book.image);

        $("#bookImagePreview").removeClass("d-none").attr("src", "http://localhost/ekta/admin/crud/uploads/books/" + book.image);

        $("#bookModal").modal("show");
    }, "json");
});


/* -----------------------------
   Image Preview
--------------------------------*/
$("#bookImage").change(function () {
    const file = this.files[0];
    if (file) {
        $("#bookImagePreview").removeClass("d-none").attr("src", URL.createObjectURL(file));
    }
});


/* -----------------------------
   Submit Form (Add + Update)
--------------------------------*/
$("#bookForm").submit(function (e) {
    e.preventDefault();

    let formData = new FormData(this);

    let action = $("#bookId").val() ? "update" : "add";
    formData.append("action", action);

    $.ajax({
        url: "crud/book_api.php",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function (res) {
            $("#bookModal").modal("hide");
            showAlert(res.success ? "Success!" : "Failed!", res.success);
            loadBooks();
        }
    });
});


/* -----------------------------
   Delete Book
--------------------------------*/
$(document).on("click", ".deleteBtn", function () {
    if (!confirm("Delete this book?")) return;
    let id = $(this).data("id");

    $.post("crud/book_api.php", { action: "delete", id }, function (res) {
        showAlert(res.success ? "Deleted!" : "Error deleting!", res.success);
        loadBooks();
    }, "json");
});


/* -----------------------------
   Alert Box
--------------------------------*/
function showAlert(msg, success = true) {
    $("#alertBox").html(`
        <div class="alert ${success ? "alert-success" : "alert-danger"}">
            ${msg}
        </div>
    `);

    setTimeout(() => $("#alertBox").html(""), 2000);
}
</script>

</body>
</html>
