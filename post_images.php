<?php include("header.php");  ?>
<?php include_once("controllers/PostController.php");  ?>
<?php if(isset($_SESSION['user_name'])) { ?>

    <?php


    if(isset($_POST['upload_image'])) {


        $target_dir = "assets/uploads/";
        $target_file = $target_dir .time().'_'. basename($_FILES["image"]["name"]);
        $uploadOk = 1;
        $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);


        $check = getimagesize($_FILES["image"]["tmp_name"]);
        if($check !== false) {
            move_uploaded_file($_FILES['image']['tmp_name'], $target_file);
            PostController::upload_image($_POST['post_id'],$target_file);

            ?>

            <div class=" row col-md-8 col-md-offset-2">
                <div class="alert alert-success" role="alert">Image Uploaded successfully</div>
                <a href="post_images.php">
                    <button type="button" class="btn btn-primary">Back to Images</button>
                </a>
            </div>

            <?php

            $uploadOk = 1;
        } else {

            ?>

            <div class=" row col-md-8 col-md-offset-2">
                <div class="alert alert-danger" role="alert">File is not an image.</div>
                <a href="dashboard.php">
                    <button type="button" class="btn btn-primary">Back to Dashboard</button>
                </a>

            </div>

            <?php

            $uploadOk = 0;
        }




    }else {
        ?>

        <div class=" row col-md-8 col-md-offset-2">
            <form action="" method="post" enctype="multipart/form-data" data-toggle="validator">
                <input type="hidden" name="post_id" value= <?php echo $_POST['id']; ?>>
                <div class="form-group">
                    <label for="InputFile">Select Image</label>
                    <input type="file" name="image" required>
                    <p class="help-block">Please upload 2000 X 800 px images</p>
                </div>

                <button type="submit" name="upload_image" class="btn btn-primary">Upload Image</button>
            </form>
            <hr>
            <a href="dashboard.php">
                <button type="button" class="btn btn-primary">Back to Dashboard</button>
            </a>
        </div>


        <?php
    }
    } else {
    header("location:login.php");
}?>

<?php include("footer.php");  ?>



