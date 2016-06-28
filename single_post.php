<?php include("header.php");  ?>
<?php include_once("controllers/PostController.php");  ?>

<?php
    if(isset($_GET['id'])){

        $post = PostController::get_post_id( $_GET['id'] );
        $images = PostController::get_images( $_GET['id'] );
       // print_r($images);

        ?>

        <div id="myCarousel" class="carousel slide" data-ride="carousel">
            <!-- Indicators -->


            <!-- Wrapper for slides -->
            <div class="carousel-inner" role="listbox">
                <?php foreach($images as $index=>$image){

                    if($index == 0){ ?>
                        <div class="item active"><img src="<?php echo $image['image_path']; ?> " /> </div>
                    <?php }else{ ?>
                        <div class="item"><img src="<?php echo $image['image_path']; ?> " /> </div>
                    <?php }


                } ?>



            </div>

            <!-- Left and right controls -->
            <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>





        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2><?php echo $post[0]['title'];?></h2>
                </div>
            </div>
            <hr>
        </div>


        <div class="container">
            <div class="row">

        <div class="col-md-4">
        <div class="panel panel-default ">
                    <div class="panel-heading">Service Type</div>
                    <div class="panel-body">
                        <?php echo $post[0]['service_type'];?>
                    </div>
                </div>
        </div>

        <div class="col-md-4">
        <div class="panel panel-default ">
                    <div class="panel-heading">Mobile</div>
                    <div class="panel-body">
                        <?php echo $post[0]['mobile'];?>
                    </div>
                </div>
        </div>

        <div class="col-md-4">
        <div class="panel panel-default">
                    <div class="panel-heading">Availability</div>
                    <div class="panel-body">
                        <?php echo $post[0]['availability'];?>
                    </div>
                </div>
        </div>

        <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-heading">Hourly Price</div>
                    <div class="panel-body">
                        <?php echo $post[0]['hourly_price'];?>
                    </div>
                </div>
        </div>

        <div class="col-md-4">
                <div class="panel panel-default ">
                    <div class="panel-heading">Years of Experience</div>
                    <div class="panel-body">
                        <?php echo $post[0]['years_of_experience'];?>
                    </div>
                </div>
        </div>

        <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-heading">Address</div>
                    <div class="panel-body">
                        <?php echo $post[0]['location'];?>
                    </div>
                </div>
        </div>


            </div>

            <hr>

            <div class="row">
                <div class="col-md-12">
                    <h3>Description</h3>
                </div>
            </div>
            <hr>

            <div class="row">
                <div class="col-md-12">
                <?php echo $post[0]['description'];?>
                    </div>
            </div>
            <br><br>


        </div>
    <?php }else{

        header("location:posts.php");

    }
?>







<?php include("footer.php");  ?>