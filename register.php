<?php include("header.php");  ?>
<?php include_once("controllers/AngelController.php");  ?>

<?php
if(isset($_POST['submit']))
{
if($_POST['add'] == $_POST['val'] ) {

    if( !empty($_POST["user_name"]) && !empty($_POST["email"]) && !empty($_POST["password"]) ){

        if( AngelController::check($_POST['user_name'], $_POST['email'] )) {

            AngelController::store($_POST['user_name'], $_POST['email'], md5($_POST['password'])); // pass variables to function

        }else {
            echo "<br><br><div class=\" row col-md-8 col-md-offset-2\">
                <div class=\"alert alert-danger\" role=\"alert\">Username or Email already registered</div>
            </div>";
        }
    }else {
        echo "<br><br><div class=\" row col-md-8 col-md-offset-2\">
                <div class=\"alert alert-danger\" role=\"alert\">Required fields are empty</div>
            </div>";
    }

}else{
    echo "<br><br><div class=\" row col-md-8 col-md-offset-2\">
                <div class=\"alert alert-danger\" role=\"alert\">Incorrect Addition</div>
            </div>";
}

}

else
{
// display form
}
?>

<div class=" row col-md-6 col-md-offset-3">
    <br><br>
    <div class="panel panel-default">
        <div class="panel-heading">Registration Form</div>
        <div class="panel-body">
            <form action="" method="post" data-toggle="validator">

                <div class="form-group">
                    <label for="exampleInputEmail1">Username</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" name="user_name" placeholder="Username" required>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Email address</label>
                    <input type="email" name="email" class="form-control" id="exampleInputEmail1" placeholder="Email" data-error=" Email address is invalid" required>
                    <div class="help-block with-errors"></div>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Password</label>
                    <input type="password" class="form-control" name="password"  placeholder="Password" required>
                </div>

                <div class="form-group">
                    <label >ADD : &nbsp;</label>
                    <?php
                    $num1 = mt_rand(0,10);
                    $num2 = mt_rand(0,10);
                    $ans = $num1+$num2;
                    echo "<b>".$num1 ."&nbsp;+&nbsp;".$num2. "</b>";
                    ?>
                    <input type="hidden" name="val" value="<?php echo $ans; ?>">
                    <input type="text" class="form-control"  name="add"  required>
                </div>

                <button type="submit" name="submit" class="btn btn-primary">Register</button>
            </form>
        </div>
    </div>
</div>





<?php include("footer.php");  ?>
