<?php include("header.php");  ?>
<?php include_once("controllers/PostController.php");  ?>
<?php if(isset($_SESSION['user_name'])) { ?>

    <?php
    if(isset($_POST['delete'])) {
        PostController::delete_post($_POST['id']);
    }
    ?>

    <div class=" row col-md-8 col-md-offset-2">
        <div class="alert alert-success" role="alert">Post deleted successfully</div>
        <a href="dashboard.php"><button type="button"  class="btn btn-primary">Back to Dashboard</button></a>
    </div>

<?php } else {
    header("location:login.php");
}?>

<?php include("footer.php");  ?>



