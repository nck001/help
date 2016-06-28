<?php include("header.php");  ?>
<?php include_once("controllers/PostController.php");  ?>
<?php if(isset($_SESSION['user_name'])) { ?>

    <?php

    $angel_id = PostController::auth($_SESSION['user_name']);

    if(isset($_POST['edit'])) {

        $post = PostController::get_post_id( $_POST['id'] );
        //print_r($post);
        //echo $post[0]['title'];

    }




    if(isset($_POST['submit']))
    {
       // $address = str_replace(","," ",$_POST['location']);

        PostController::update($_POST['post_id'],$angel_id,$_POST['title'],$_POST['service_type'],$_POST['mobile'],str_replace(","," ",$_POST['location']),$_POST['description'],$_POST['availability'],$_POST['hourly_price'],$_POST['years_of_experience']); // pass variables to function

        ?>

        <div class=" row col-md-8 col-md-offset-2">
            <div class="alert alert-success" role="alert">Post Updated successfully</div>
            <a href="dashboard.php"><button type="button"  class="btn btn-primary">Back to Dashboard</button></a>
        </div>

        <?php
    }

    else
    { ?>
        <div class=" row col-md-8 col-md-offset-2">
        <form action="" method="post" data-toggle="validator">

            <input type="hidden" class="form-control" name="post_id" value=<?php echo $_POST['id']; ?>  required>

        <div class="form-group">
            <label >Title</label>
            <input type="text" class="form-control" name="title" value="<?php echo $post[0]['title']; ?>"  required>
        </div>
        <div class="form-group">
            <label >Service Type</label>

            <select class="form-control" name="service_type" >
                <option value="babysitters" <?php if($post[0]['service_type']=='babysitters') echo "selected='selected'"; ?> >Babysitters</option>
                <option value="catsitters" <?php if($post[0]['service_type']=='catsitters') echo "selected='selected'"; ?>>Catsitters</option>
                <option value="housesitters" <?php if($post[0]['service_type']=='housesitters') echo "selected='selected'"; ?>>Housesitters</option>
                <option value="grannysitters" <?php if($post[0]['service_type']=='grannysitters') echo "selected='selected'"; ?>>Grannysitters</option>
                <option value="plantsitters" <?php if($post[0]['service_type']=='plantsitters') echo "selected='selected'"; ?>>Plantsitters</option>
            </select>

        </div>
        <div class="form-group">
            <label >Mobile</label>
            <input type="text" class="form-control" name="mobile" value="<?php echo $post[0]['mobile']; ?>" required>
        </div>

        <div class="form-group">
            <label >Address</label>

            <textarea rows="4" cols="50" class="form-control" name="location"  required><?php echo $post[0]['location']; ?></textarea>
        </div>

        <div class="form-group">
            <label >Description</label>
            <textarea rows="4" cols="50" class="form-control" name="description"   required> <?php echo $post[0]['description']; ?></textarea>
        </div>
        <div class="form-group">
            <label >Availability</label>

            <select class="form-control" name="availability" >
                <option value="weekdays" <?php if($post[0]['availability']=='weekdays') echo "selected='selected'"; ?>>Week days</option>
                <option value="weekends" <?php if($post[0]['availability']=='weekends') echo "selected='selected'"; ?>>Weekends</option>
                <option value="holidays" <?php if($post[0]['availability']=='holidays') echo "selected='selected'"; ?>>Holidays</option>
                <option value="all" <?php if($post[0]['availability']=='all') echo "selected='selected'"; ?>>All</option>
            </select>

        </div>

        <div class="form-group">
            <label >Hourly Price &pound;</label>
            <input type="number" class="form-control" name="hourly_price"  value=<?php echo $post[0]['hourly_price']; ?> required>
        </div>

        <div class="form-group">
            <label >Years of experience</label>
            <input type="number" class="form-control" name="years_of_experience"  value=<?php echo $post[0]['years_of_experience']; ?> required>
        </div>

        <button type="submit" name="submit" class="btn btn-primary">Publish</button>
        </form>

        </div>
    <?php } ?>





<?php } else {
    header("location:login.php");
}?>

<?php include("footer.php");  ?>
