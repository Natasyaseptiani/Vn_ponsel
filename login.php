<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="card my-5">
                    <form class="card-body cardbody-color p-lg-5" method="post" action="login_process.php">
                        <div class="mb-3">
                            <input type="text" class="form-control" name="username" aria-describedby="emailHelp" placeholder="User Name" required>
                        </div>
                        <div class="mb-3">
                            <div class="input-group">
                                <input type="password" class="form-control" name="password" id="password" placeholder="Password" required>
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary" type="button" id="showPassword" onclick="togglePassword()">Show</button>
                                </div>
                            </div>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-color px-5 mb-5 w-100">Login</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <style>
        .btn-color {
            background-color: #0e1c36;
            color: #fff;
        }

        .profile-image-pic {
            height: 150px;
            width: 150px;
            object-fit: cover;
        }

        .cardbody-color {
            background-color: #ebf2fa;
        }

        a {
            text-decoration: none;
        }
    </style>

    <script>
        function togglePassword() {
            var passwordField = document.getElementById("password");
            var showPasswordButton = document.getElementById("showPassword");

            if (passwordField.type === "password") {
                passwordField.type = "text";
                showPasswordButton.textContent = "Hide";
            } else {
                passwordField.type = "password";
                showPasswordButton.textContent = "Show";
            }
        }
    </script>

</body>
</html>
