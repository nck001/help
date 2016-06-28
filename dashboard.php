<?php include("header.php");  ?>
<?php include_once("controllers/PostController.php");  ?>
<?php if(isset($_SESSION['user_name'])) { ?>

    <?php
        $angel_id = PostController::auth($_SESSION['user_name']);
        $posts = PostController::get_post( $angel_id );

    if(isset($_POST['delete-image'])){
        $posts = PostController::delete_image( $_POST['id'],$_POST['path'] );

    }


    ?>

<div class=" row col-md-8 col-md-offset-2">
    <table class="table table-hover">
        <thead>
            <th>#</th>
            <th>Title</th>
            <th>Service Type</th>
            <th>Post Images</th>
            <th>Edit</th>
            <th>Delete</th>
        </thead>
        <?php foreach($posts as $index=>$post){ ?>
        <tr>
            <td ><?php  echo $index+1; ?></td>
            <td > <a href="single_post.php?id=<?php  echo $post['id']; ?>" ><?php  echo $post['title']; ?> </td>
            <td ><?php  echo $post['service_type']; ?> </td>
            <td >
                <form action="post_images.php" method="post">
                    <input type="hidden" name="id" value=<?php echo $post['id']; ?> >
                    <button type="submit" name="Upload" class="btn btn-warning">Upload Image</button>

                </form>
                <br>
                <div >
                   <?php $images = PostController::get_images( $post['id'] ) ;
                  // print_r($images);
                   foreach($images as $image) {

                       echo '<div  style="height:50px; float:left; "> <img src = "'.$image['image_path'].'" style="height:50px;  ">
                        <form action="" method="post">
                            <input type="hidden" name="id" value= '. $image["id"].' >
                             <input type="hidden" name="path" value= '. $image["image_path"].' >
                            <button type="submit" name="delete-image" class="btn btn-sm btn-circle btn-danger" style="margin-left:-5px; margin-top:-55px; position:absolute;">X</button>
                        </form>

                       </div>';
                   }
                   ?>
                </div>


            </td>
            <td >
                <form action="update_post.php" method="post">
                    <input type="hidden" name="id" value=<?php echo $post['id']; ?> >
                <button type="submit" name="edit" class="btn btn-primary">Edit</button>
                </form>
            </td>
            <td >
                <form action="delete_post.php" method="post">
                    <input type="hidden" name="id" value=<?php echo $post['id']; ?> >
                <button type="submit" name="delete" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>

        <?php } ?>





    </table>
    <hr>
    <a href="create_post.php"><button type="button" class="btn btn-success">Add new post</button></a>

</div>

<?php } else {
    header("location:login.php");
}?>

<?php include("footer.php");  ?>



