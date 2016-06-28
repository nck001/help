<?php include("header.php");  ?>
<?php include_once("controllers/AngelController.php");  ?>

<?php
if(isset($_POST['submit'])) {

    if (AngelController::active($_POST['user_name'], $_POST['activation'])) {

        echo "<br><br><div class=\" row col-md-12 \">
                <div class=\"alert alert-success\" role=\"alert\">Account Activated</div>
            </div>";
        echo "<a href=\"login.php\" class=\" row col-md-12 \">
                <button type=\"button\" class=\"btn btn-primary \">Go to login page</button>
            </a>";


    } else {


        echo "<br><br><div class=\" row col-md-8 col-md-offset-2\">
                <div class=\"alert alert-danger\" role=\"alert\">Incorrect Inputs</div>
            </div>";
    }
}


?>

<div class=" row col-md-6 col-md-offset-3">
    <br><br>
    <div class="panel panel-default">
        <div class="panel-heading">Account Activation Form</div>
        <div class="panel-body">
            <form action="" method="post" data-toggle="validator">

                <div class="form-group">
                    <label >Username</label>
                    <input type="text" class="form-control"  name="user_name" placeholder="Username" required>
                </div>

                <div class="form-group">
                    <label >Activation Code</label>
                    <input type="text" class="form-control"  name="activation" placeholder="Activation Code" required>
                </div>

                <button type="submit" name="submit" class="btn btn-primary">Activate</button>
            </form>
        </div>
    </div>
</div>





<?php include("footer.php");  ?>
