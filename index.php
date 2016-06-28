<?php include("header.php");  ?>
<?php include_once("controllers/WebController.php");  ?>
<?php  $posts = WebController::get_post();
$array = array();
$count = 0;
foreach($posts as $post){
   $array[$count] = $post['location'];
    $count++;
}

$loc = json_encode($array);
?>


    <div id="map_canvas" class="container-fluid"></div>

    <div class="container-fluid"  id="search">
        <div class="row">
            <div class="container">
                <form class="form-inline col-md-12" action="search.php" method="post">
                    <div class="form-group col-md-3">
                        <select class="form-control" name="service_type" >
                            <option value="babysitters">Babysitters</option>
                            <option value="catsitters">Catsitters</option>
                            <option value="housesitters">Housesitters</option>
                            <option value="grannysitters">Grannysitters</option>
                            <option value="plantsitters">Plantsitters</option>
                        </select>
                    </div>
                    <div class="form-group  col-md-3">
                        <select class="form-control" name="price_range" >
                            <option value="0-10">0-10 &pound;</option>
                            <option value="10-20">10-20 &pound;</option>
                            <option value="20-30">20-30 &pound;</option>
                            <option value="30-40">30-40 &pound;</option>
                            <option value="40-50">40-50 &pound;</option>
                        </select>
                    </div>
                    <div class="form-group  col-md-3">
                        <input type="text"  class="form-control" name="location"  placeholder="location">
                    </div>

                    <div class="form-group  col-md-3">
                        <button type="submit" class="btn btn-default col-xs-12 " name ="search" id = "search-btn"><b>Search</b></button>
                    </div>
                </form>
            </div>
        </div>
    </div>


<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h2>Latest Posts</h2>
        </div>
    </div>
    <hr>
</div>


<div class="container">
    <div class="row">
    <?php


   // print_r($posts);
    $count =1;

    foreach($posts as $post){ ?>



        <div class="col-xs-12 col-md-3 col-sm-6">
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
        if($count==4){
            break;
        }else{
            $count++;
        }
    }

    ?>



    </div>

    <hr>

</div>

    <div class="container-fluid" style="background-color: #a94442; color: #ffffff; padding: 50px;" align="center">
        <div class="row">
            <div class="col-md-12">
                <a href="posts.php"> <button class="btn btn-lg btn-default">View All Posts</button></a>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            var map;
            var elevator;
            var myOptions = {
                scrollwheel: false,
                zoom: 10,
                center: new google.maps.LatLng(51.4, 0.05),
                mapTypeId: 'terrain'
            };
            map = new google.maps.Map($('#map_canvas')[0], myOptions);
            var loc = <?php echo $loc ?>;
            var location = loc.toString().split(",");

            var addresses = location;

            for (var x = 0; x < addresses.length; x++) {
                $.getJSON('http://maps.googleapis.com/maps/api/geocode/json?address='+addresses[x]+'&sensor=false', null, function (data) {
                    var p = data.results[0].geometry.location
                    var latlng = new google.maps.LatLng(p.lat, p.lng);
                    new google.maps.Marker({
                        position: latlng,
                        map: map
                    });

                });
            }

        });
    </script>

<?php include("footer.php");  ?>