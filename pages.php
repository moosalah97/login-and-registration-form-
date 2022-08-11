<?php session_start();?>
<!DOCTYPE HTML>
<html>
    <head>
        <title>ingenuity</title>
        <meta charset="utf-8">
        <meta http-equiv="content-type" content="text/html" />
        <meta name="author" content="lolkittens" />
        <link rel="stylesheet" href="assets/css/bootstrap.css" >
        <link rel="stylesheet" href="style.css" >
        <script src="assets/js/bootstrap.js" ></script>
    </head>
    <body>
        <?php
            require "connection.php";
             if(isset($_GET['action']) && $_GET['action'] == 'logout'){
                session_destroy();
                 header('Location: http://localhost/firstproject/login.php');
             }
        ?>
        <div class="topnav">
            <a class="active" href="#News">News</a>
            <a href="#Politics">Politics</a>
            <a href="#Art">Art</a>
            <a href="./login.php?action=logout" class="btn btn-danger bottom-left"> logout </a>
        </div>

            <div class="container">
                <div class="col-md-6" >
                    <?php
                    $sql1 = "SELECT * FROM posts";
                    $result = mysqli_query($conn, $sql1);

                    if (mysqli_num_rows($result) > 0) {
                        while($row = mysqli_fetch_assoc($result)) {?>
                            <div class="row panel panel-default" style="border: dotted black;margin: 20px;background-color: #d5d5d5">
                                <div class="col-md-12 text-left panel-heading "style="color: #2e11ff">
                                    <h3 class="col-md-3"><?php echo $row["Title"] ?></h3>
                                    <br>
                                </div>
                                <div class="col-md-12 text-center panel-body" style="color: #337ab7;background-color: #d5d5d5; ">
                                    <P><?php echo $row["Content"] ?></P>
                                </div>
                                <div class="col-md-12">
                                    <?php
                                    if ( isset($_POST['comment']) ) {
                                        $sql =" INSERT INTO comments (Content,Userid,Postid) VALUES ('" . $_POST['content'] . "', 1,1) ";
                                        if (mysqli_query($conn, $sql)) {
                                           // echo "good";
                                        } else {
                                            echo "<div class='alert alert-danger center-block text-center'><h2>no comments here</h2>";
                                            echo mysqli_error($conn) . "</div>";
                                        }
                                    }?>
                                <form action="pages.php" method="post">
                                    <div class="col-md-3 " style="margin-top: 10px;padding-left: 0px">
                                        <input type="text" placeholder="leave comment!" name="content">
                                        <button type="submit"  name="comment"class="btn btn-primary">comment</button>
                                        <?php
                                        $sql1 = "SELECT * FROM comments";
                                        $result = mysqli_query($conn, $sql1);
                                        if (mysqli_num_rows($result) > 0) {
                                        while ($row = mysqli_fetch_assoc($result)) { ?>
                                        <p style="background: #d1e9de; padding: 5px"><?php echo $row["content"] ?></p>
                                        <?php }
                                        }?>
                                    </div>
                                </form>
                            </div>
                    <?php }
                    }else{
                        echo "sorry this page empty";
                    }?>
                </div>
            </div>

    </body>
</html>