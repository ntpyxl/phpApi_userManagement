<?php 
session_start();

if(isset($_SESSION['user_id'])) {
    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <h2 class="text-center mt-4">Register Page</h2>
    <div class="container mt-4">
        <div class="row justify-content-center">
            <form onsubmit="registerUser(event)" class="col-md-6 col-lg-4 border p-3">
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
                    <select class="form-select" aria-label="Default select example" id="roleField" name="role"> required
                        <option selected disabled>Select user role</option>
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
                

                <div class="d-flex mb-3 justify-content-end">
                    <button type="submit" class="btn btn-primary" id="registerButton" name="registerButton">Register</button>
                </div>
            </form>

            <div class="col-12 text-center mt-3">
                Already registered? <a href="login.php">Login here.</a>
            </div>
        </div>
    </div>

    <script src="scripts/register.js"></script>
</body>
</html>