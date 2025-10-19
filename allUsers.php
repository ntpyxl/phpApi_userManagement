<?php 
session_start();

if(!isset($_SESSION['user_id'])) {
    header("Location: login.php");
}

if($_SESSION['is_admin'] !== 1) {
    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Users</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
</head>
<body>
    <div class="container mt-4">
        <h2>Hello there, <?php echo $_SESSION['first_name']?>!</h2>

        <a href="index.php" class="btn btn-info">Home</a>
        <a href="logout.php" class="btn btn-warning">Logout</a>
    </div>
    
    <div class="container border mt-4">
        <div class="my-3">
            <label for="searchField" class="form-label">Search User</label>
            <input type="text" class="form-control" id="searchField">
            <div class="d-flex justify-content-between">
                <button type="button" class="btn mt-2 btn-secondary" id="clearSearchFieldButton">Clear</button>
                <button type="button" class="btn mt-2 btn-secondary" id="clearSearchFieldButton">Add User</button>
            </div>
        </div>

        <div class="row justify-content-center">
            <table class="table table-striped table-hover">
                <tr>
                    <th>User ID</th>
                    <th>Username</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Is Admin</th>
                    <th>Date Added</th>
                </tr>

                <tbody id="userTableBody"></tbody>
            </table>
        </div>
    </div>

    <script src="scripts/script.js"></script>
</body>
</html>