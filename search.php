<?php include("header.php");  ?>
<?php include_once("controllers/WebController.php");  ?>
<?php  $posts = WebController::search($_POST['service_type'],$_POST['price_range'],$_POST['location']);
//print_r($posts) ;
?>


    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>Search Results</h2>
            </div>
        </div>
        <hr>
    </div>

   <?php if (empty($posts)) {
    echo "<br><br><div class=\" row col-md-8 col-md-offset-2\">
                <div class=\"alert alert-danger\" role=\"alert\">No Search Results</div>
            </div>";
    } ?>


    <div class="container">
        <div class="row">
            <?php


            // print_r($posts);
            $count =1;

            foreach($posts as $post){ ?>



                <div class="col-xs-12 col-md-3">
                    <div class="panel panel-default">
                        <div class="panel-image">
                            <?php $images = WebController::get_images($post['id']);
                            //print_r($images[0]['image_path']);
                            if(empty($images[0]['image_path'])){
                                echo '<div  style="height: 200px; margin: 0 auto; background-color: #a94442;" > </div>';
                            }else{
                                ?>
                                <img src="<?php echo $images[0]['image_path']; ?>" class="panel-image-preview img-responsive" style="height: 200px; margin: 0 auto;" />
                            <?php }?>

                        </div>
                        <div class="panel-body">
                            <h4><?php echo $post['title']; ?></h4>
                            <p><?php echo substr($post['description'], 0, 100); ?></p>
                        </div>

                        <div align="center"><a href="single_post.php?id=<?php echo $post['id']; ?>"><button class="btn btn-danger " style="margin: 10px;">View Details</button></a></div>



                    </div>
                </div>
                <?php
                if($count==8){
                    break;
                }else{
                    $count++;
                }
            }

            ?>



        </div>

        <hr>

    </div>



<?php include("footer.php");  ?>