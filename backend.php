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

        <div class="topnav">
            <a style="background-color: #d5d5d5" href="pages.php">ingenuity</a>
            <a href="">Home</a>
            <a href="posts.php">Posts</a>
            <a href="">comments</a>
            <a href="">pages</a>
            <a href="">users</a>
            <a href="./login.php?action=logout" class="btn btn-danger bottom-left"> logout </a>
        </div>
    <?php require "insert.php";?>
    <div class="container">
        <div class="col-md-6">

            <?php
            $sql1 = "select * from posts";
            $result = mysqli_query($conn, $sql1);
            if (mysqli_num_rows($result) > 0) {

                while( $row = mysqli_fetch_array($result)) {
                    ?>
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
                                $sqlComments =" INSERT INTO comments (Content,Userid,Postid) VALUES ('" . $_POST['content'] . "', 1,1) ";
                                if (mysqli_query($conn, $sqlComments)) {
                                    // echo "good";
                                } else {
                                    echo "<div class='alert alert-danger center-block text-center'><h2>no comments here</h2>";
                                    echo mysqli_error($conn) . "</div>";
                                }
                            }


//                    if ( isset($_POST['update']) ) {
//                        $sqlupdate= "UPDATE posts
//                                         SET  Title= '".$_POST['title']."',Content = '".$_POST['content']."'
//                                         WHERE Id='$Id'";
//                        $query = mysqli_query($conn,$sqlupdate);
//                        if ( $query === FALSE ) {
//                            echo mysqli_error($conToNews);
//                            exit;
//                        }
//                    }

                            ?>
                        </div>

                        <form action="backend.php" method="post">
                            <div class="col-md-3 " style="margin-top: 10px;padding-left: 0px">
                                <input type="text" placeholder="leave comment!" name="content">
                                <button type="submit"  name="comment"class="btn btn-primary">comment</button>
                                <a href="http://localhost/firstproject/backend.php/<?php echo $row["Id"] ?>">Update</a>
                                <?php
                                $sqlCommentRes = "SELECT * FROM comments";
                                $result2 = mysqli_query($conn, $sqlCommentRes);
                                if (mysqli_num_rows($result2) > 0) {
                                    while ($row = mysqli_fetch_assoc($result2)) { ?>
                                        <p style="background: #d1e9de; padding: 5px"><?php echo $row["content"] ?></p>
                                    <?php }
                                }?>
                            </div>
                        </form>
                    </div>
                    <?php
                }
            }else{
                echo "sorry this page empty";
            }
            mysqli_close($conn);
            ?>
        </div>
    </div>

    </body>
</html>

    </body>
</html>