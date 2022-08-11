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
        <?php require "connection.php";
        $username='';
        $email='';
        $password='';
        $confirmpassword='';
        $nameError='';
        $emailError='';
        $passError='';
        $confirmpasserror='';

        $error = false;
        if ( isset($_POST['regestration']) ) {
            $username = trim($_POST['username']);
            $username= strip_tags($username);
            $username = htmlspecialchars($username);

            $email = trim($_POST['email']);
            $email = strip_tags($email);
            $email = htmlspecialchars($email);

            $password = trim($_POST['password']);
            $password = strip_tags($password);
            $password = htmlspecialchars($password);

            $confirmpassword = trim($_POST['confirmpassword']);
            $confirmpassword = strip_tags($confirmpassword);
            $confirmpassword = htmlspecialchars($confirmpassword);
            // basic name validation
            if (empty($username)) {
                $error = true;
                $nameError = "Please enter your full name.";
            } else if (strlen($username) <= 3) {
                $error = true;
                $nameError = "Name must have atleat 3 characters.";
            } else if (!preg_match("/^[a-zA-Z ]+$/", $username)) {
                $error = true;
                $nameError = "Name must contain alphabets and space.";
            }
            //basic email validation
            if (!filter_var($email,FILTER_VALIDATE_EMAIL)) {
                $error = true;
                $emailError = "Please enter valid email address.";
            } else {
                // check email exist or not
                $query = "SELECT userEmail FROM users WHERE userEmail='$email'";
                $result = mysqli_query($conn,$query);
                $count = mysqli_num_rows($result );
                if ($count != 0) {
                    $error = true;
                    $emailError = "Provided Email is already in use.";
                }
            }
            // password validation
            if (empty($password)) {
                $error = true;
                $passError = "Please enter password.";
            } else if (strlen($password) < 6) {
                $error = true;
                $passError = "Password must have atleast 6 characters.";
            }else if ($password!==$confirmpassword){
                $error = true;
                $confirmpasserror= "password must be identical.";
            }
            if (!$error) {
                $sql = " INSERT INTO users (username,email,password)
                        VALUES ('" . $_POST['username'] . "', '" . $_POST['email'] . "', '" . md5($_POST['password']) . "') ";
                if (mysqli_query($conn, $sql)) {
                    echo "<h2 class='alert alert-success center-block text-center'>welcome! please logein</h2>";
                    unset($username);
                    unset($email);
                    unset($password);
                    header("Location: http://localhost/firstproject/login.php");
                } else {
                    echo "<div class='alert alert-danger center-block text-center'><h2>Error, Please try again!</h2>";
                    echo mysqli_error($conn,$sql) . "</div>";
                }
            }
        }
        ?>
        <div class="container">
            <div class="row">
                <h1 class="panel text-center alert alert-success"> please enter your data </h1>
                <form action="" method="post" class="form-inline text-center col-md-12">
                    <div class="form-group col-md-12">
                        <label for="username" class="col-md-12 glyphicon glyphicon-user">username</label>
                        <input type="text" name="username" placeholder="type your username"/>
                        <span class="text-danger"><?php echo $nameError; ?></span>
                        <br />
                        <label for="email" class="col-md-12 glyphicon glyphicon-envelope">email</label>
                        <input type="text" name="email" placeholder="type your email"/>
                        <span class="text-danger"><?php echo $emailError; ?></span>
                        <br />
                        <label for="password" class="col-md-12 glyphicon glyphicon-lock">password</label>
                        <input type="password" name="password" placeholder="enter your password"/>
                        <span class="text-danger"><?php echo $passError; ?></span>
                        <br />
                        <label for="password" class="col-md-12 glyphicon glyphicon-lock">confirm your password</label>
                        <input type="password" name="confirmpassword" placeholder="enter your password again"/>
                        <span class="text-danger"><?php echo $confirmpasserror; ?></span>
                        <br />
                    </div>
                    <div class="form-inline radio-inline container text-center">
                    <br />
                    <button class="btn btn-primary center-block" type="submit" name="regestration">register</button>
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>
