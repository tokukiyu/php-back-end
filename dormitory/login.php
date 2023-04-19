<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login </title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.1/css/bootstrap.min.css" integrity="sha512-T584yQ/tdRR5QwOpfvDfVQUidzfgc2339Lc8uBDtcp/wYu80d7jwBgAxbyMh0a9YM9F8N3tdErpFI8iaGx6x5g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="style.css">

</head>

<body>

    <div class="row justify-content-center">
        <div class="col-5">
            <div class="card m-5">
                <div class="card-header bg-primary">login to DMS</div>
                <div class="card-body">
                    <form class="form-group" action="" method="post">
                        <input class="form-control m-2" type="text" name="username" placeholder="Enter Admin username">
                        <input class="form-control m-2" type="password" name="password" placeholder="Enter password">
                        <input class="btn btn-secondary m-2" type="submit" name="login" value="Login">
                    </form>
                </div>
            </div>
        </div>

    </div>
</body>

</html>
<?php
include "config.php";
include "function.php";
if (isset($_POST['login'])) {
    global $conn;
    $username = check_input($_POST['username']);
    $password = check_input($_POST['password']);

    if (!empty($username) and !empty($password)) {
        //
        
        $sql = "SELECT staff.*, `admin`.*  FROM staff
                RIGHT JOIN `admin` ON `admin`.staff_id=staff.staff_id
                where staff.`role`='admin' or staff.`role`='Admin' limit 1 ";

        $res = mysqli_query($conn, $sql);
        if (mysqli_num_rows($res) > 0) {
            $data = mysqli_fetch_assoc($res);
            if ($data['username'] === $username and $data['password'] === $password) {
                $_SESSION['staff_id'] = $data['staff_id'];
                header("Location:./");
                die();
            } else {
                echo ' <div class="alert alert-warning m-2 " role="alert">
                enter your password and username please
              </div>';
            }
        }
    } else {
        echo ' <div class="alert alert-warning m-2 " role="alert">
                  wrong password or username
                </div>';
    }
}
?>