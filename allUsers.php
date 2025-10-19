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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
                <button type="button" class="btn mt-2 btn-secondary" id="clearSearchFieldButton" data-bs-toggle="modal" data-bs-target="#addUserModal">Add User</button>
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

    <div class="modal fade" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" id="addUserModal">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <form onsubmit="registerUser(event, 'allUsers.php')" class="border p-3" id="addUserForm">
                        <div class="mb-3">
                            <label for="usernameField" class="form-label">Username</label>
                            <input type="text" class="form-control" id="usernameField" name="username" required>
                        </div>

                        <div class="mb-3">
                            <label for="firstnameField" class="form-label">First name</label>
                            <input type="text" class="form-control" id="firstnameField" name="firstname" required>
                        </div>

                        <div class="mb-3">
                            <label for="lastnameField" class="form-label">Last name</label>
                            <input type="text" class="form-control" id="lastnameField" name="lastname" required>
                        </div>

                        <div class="mb-3">
                            <label for="roleField" class="form-label">User Role</label>
                            <select class="form-select" aria-label="Default select example" id="roleField" name="role" required>
                                <option value="" selected disabled>Select user role</option>
                                <option value="0">User</option>
                                <option value="1">Admin</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="passwordField" class="form-label">Password</label>
                            <input type="password" class="form-control" id="passwordField" name="password" required>
                        </div>

                        <div class="mb-3">
                            <label for="confirmPasswordField" class="form-label">Confirm Password</label>
                            <input type="password" class="form-control" id="confirmPasswordField" name="confirmPassword" required>
                        </div>
                    </form>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" form="addUserForm">Add User</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>

    <script src="scripts/script.js"></script>
    <script src="scripts/register.js"></script>
</body>
</html>