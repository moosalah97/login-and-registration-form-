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
         <?php require"connection.php";?>
        <div class="container">
            <div class="col-md-6">
                <form action="posts.php" method="post">
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
         <?php
         $con=mysqli_connect("localhost","root","","project1");
         // Check connection
         if (mysqli_connect_errno())
         {
             echo "Failed to connect to MySQL: " . mysqli_connect_error();
         }

         $result = mysqli_query($con,"SELECT * FROM posts");
          echo "<table border='1'>
            <tr>
            <th>Title</th>
            <th>Content</th>
            </tr>";

         while($row = mysqli_fetch_array($result))
         {
             echo "<tr>";
             echo "<td>" . $row['Title'] . "</td>";
             echo "<td>" . $row['Content'] . "</td>";
             echo "</tr>";
         }
         echo "</table>";

         mysqli_close($con);
         ?>

        <div class="container">
            <div class="col-md-6" >

            <?php
            $sql1 = "select * from posts";
            $result = mysqli_query($conn, $sql1);
            print_r($result);

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
                                }?>
                            </div>
                            <form action="posts.php" method="post">
                                <div class="col-md-3 " style="margin-top: 10px;padding-left: 0px">
                                    <input type="text" placeholder="leave comment!" name="content">
                                    <button type="submit"  name="comment"class="btn btn-primary">comment</button>
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