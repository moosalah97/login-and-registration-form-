<!DOCTYPE HTML>
<html>
<head>
    <title>ingenuity</title>
    <meta charset="utf-8">
    <meta http-equiv="content-type" content="text/html" />
    <meta name="author" content="lolkittens" />
    <link rel="stylesheet" href="assets/css/bootstrap.css" >
    <link rel="stylesheet" href="style.css" >
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="assets/js/bootstrap.js" ></script>
</head>
<body>
<?php require "connection.php";?>

<div class="container">
    <div class="col-md-6">
        <form action="backend.php" method="post">
            <div class="col-md-3 " style="margin-top: 10px;padding-left: 0px">
                <input type="text" placeholder="title!" name="Title">
                <textarea placeholder="content" name="Content"></textarea>
                <button type="submit"  name="submit"class="btn btn-primary">post</button>
                <?php
                if(isset($_POST['submit'])) {
                    $sql2 = "INSERT INTO posts (Title,Content,PostType)
                                VALUES ('" . $_POST['Title'] . "', '" . $_POST['Content'] . "', 1) ";
                    $result = mysqli_query($conn, $sql2);
                    if (mysqli_query($conn, $sql2)) {
                        echo "published";
                    } else {
                        echo "error";
                    }
                }?>
            </div>
        </form>
    </div>
</div>

</body>
</html>

</body>
</html>