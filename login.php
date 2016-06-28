<?php include("header.php");  ?>
<?php include_once("controllers/AngelController.php");  ?>

<?php
if(isset($_POST['submit']))
{

        //perform update task
        if(AngelController::login($_POST['user_name'], md5($_POST['password'])) == 'false'){

            echo "<br><br><div class=\" row col-md-8 col-md-offset-2\">
                <div class=\"alert alert-danger\" role=\"alert\">Incorrect Inputs</div>
            </div>";

        } // pass variables to function

}

else
{
// display form
}
?>

<div class=" row col-md-6 col-md-offset-3">
    <br><br>
    <div class="panel panel-default">
        <div class="panel-heading">Login Form</div>
        <div class="panel-body">
            <form action="" method="post" data-toggle="validator">

                <div class="form-group">
                    <label >Username</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" name="user_name" placeholder="Username" required>
                </div>

                <div class="form-group">
                    <label >Password</label>
                    <input type="password" class="form-control" name="password"  placeholder="Password" required>
                </div>





                <button type="submit" name="submit" class="btn btn-primary">Login</button>
            </form>
        </div>
    </div>
</div>





<?php include("footer.php");  ?>
