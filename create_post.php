<?php include("header.php");  ?>
<?php include_once("controllers/PostController.php");  ?>
<?php if(isset($_SESSION['user_name'])) { ?>

    <?php
    if(isset($_POST['submit']))
    {
        $angel_id = PostController::auth($_SESSION['user_name']);
        PostController::store($angel_id,$_POST['title'],$_POST['service_type'],$_POST['mobile'],str_replace(","," ",$_POST['location']),$_POST['description'],$_POST['availability'],$_POST['hourly_price'],$_POST['years_of_experience']); // pass variables to function
    }

    else
    {
// display form
    }

    //`id`, `angel_id`, `title`, `service_type`, `mobile`, `location`, `description`, `availability`, `hourly_price`, `years_of_experience`
    ?>

    <div class=" row col-md-8 col-md-offset-2">
        <form action="" method="post" data-toggle="validator">
            <div class="form-group">
                <label >Title</label>
                <input type="text" class="form-control" name="title"  placeholder="Title" required>
            </div>
            <div class="form-group">
                <label >Service Type</label>

                <select class="form-control" name="service_type" >
                    <option value="babysitters">Babysitters</option>
                    <option value="catsitters">Catsitters</option>
                    <option value="housesitters">Housesitters</option>
                    <option value="grannysitters">Grannysitters</option>
                    <option value="plantsitters">Plantsitters</option>
                </select>

            </div>
            <div class="form-group">
                <label >Mobile</label>
                <input type="text" class="form-control" name="mobile"  placeholder="Mobile" required>
            </div>

            <div class="form-group">
                <label >Address</label>

                <textarea rows="4" cols="50" class="form-control" name="location" required></textarea>
            </div>

            <div class="form-group">
                <label >Description</label>
                <textarea rows="4" cols="50" class="form-control" name="description" required></textarea>
            </div>
            <div class="form-group">
                <label >Availability</label>

                <select class="form-control" name="availability" >
                    <option value="weekdays">Week days</option>
                    <option value="weekends">Weekends</option>
                    <option value="holidays">Holidays</option>
                    <option value="all">All</option>
                </select>

            </div>

            <div class="form-group">
                <label >Hourly Price &pound;</label>
                <input type="number" class="form-control" name="hourly_price"  placeholder="Hourly Price" required>
            </div>

            <div class="form-group">
                <label >Years of experience</label>
                <input type="number" class="form-control" name="years_of_experience"  placeholder="Years of experience" required>
            </div>

            <button type="submit" name="submit" class="btn btn-primary">Publish</button>
        </form>

    </div>

<?php } else {
    header("location:login.php");
}?>

<?php include("footer.php");  ?>
