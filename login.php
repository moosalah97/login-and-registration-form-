<?php session_start(); ?>
<!DOCTYPE HTML>
<html>
    <head>
        <title>ingenuity</title>
        <meta charset="utf-8">
        <meta http-equiv="content-type" content="text/html" />
        <meta name="author" content="lolkittens" />
        <link rel="stylesheet" href="assets/css/bootstrap.css" >
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="assets/js/bootstrap.js" ></script>
    </head>
    <body>
<?php
echo "<h2 class='alert alert-success center-block text-center'>welcome! please login</h2>";
    require "connection.php";
    if (isset($_POST['email'])){
        $email = $_POST['email'];
        $password = md5($_POST['password']);
        $sql="SELECT * FROM users WHERE password = '$password' AND email = '$email'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                session_start();
                $_SESSION['userdata'] = array(
                    'email' => $row['email'],
                    'is_login' => true
                );
            }
            header('Location: http://localhost/firstproject/pages.php');
        }else{
            echo "<h2 class='alert alert-danger center-block text-center'>Error, Please try again!</h2>";
        }
    }
?>
        <div class="clearfix"></div>
        <div class="container">
            <div class="row">
                <form action="login.php" method="post" class="form-inline text-center col-md-3">
                    <div class="form-group col-md-12">
                        <label for="email" class="col-md-12">email</label>
                        <input type="text" name="email" placeholder="type your email"/>
                        <br />
                        <label for="password" class="col-md-12">password</label>
                        <input type="password" name="password" placeholder="type your password"/>
                    </div>
                    <div>
                        <button class="btn btn-primary center-block" type="submit">login</button>
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>