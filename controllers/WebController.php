<?php
include_once("/../crud.php");

class WebController extends Crud{
    public static $crud;

    public function __construct()
    {

    }



    //get post details to web page
    public static function get_post()
    {

        $crud = new Crud();
        $table = 'posts';
        $crud->select_all_posts($table, array('id', 'angel_id', 'title', 'service_type', 'mobile', 'location', 'description', 'availability', 'hourly_price', 'years_of_experience'));

        return $crud->getResult();

    }

    //get post images
    public static function get_images( $id )
    {

        $crud = new Crud();
        $table = 'images';
        $crud->select($table, array('id','image_path'),array('post_id'=>$id));

        return $crud->getResult();

    }

    //get post details by id
    public static function get_post_id( $id )
    {

        $crud = new Crud();
        $table = 'posts';
        $crud->select($table, array('id', 'angel_id', 'title', 'service_type', 'mobile', 'location', 'description', 'availability', 'hourly_price', 'years_of_experience'),array('id'=>$id));

        return $crud->getResult();

    }

    //get search results data
    public static function search($type,$range,$location)
    {
        preg_match_all('!\d+!', $range, $price);

        $crud = new Crud();
        $table = 'posts';
        $crud->select_search($table, array('id', 'angel_id', 'title', 'service_type', 'mobile', 'location', 'description', 'availability', 'hourly_price', 'years_of_experience'),$type, $location,$price);

        return $crud->getResult();

    }


}

?>