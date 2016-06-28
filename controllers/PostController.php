<?php
include_once("/../crud.php");

class PostController extends Crud{
    public static $crud;

    public function __construct()
    {

    }

    //posts store
    public static function store( $angel_id, $title, $service_type, $mobile, $location, $description, $availability, $hourly_price, $years_of_experience )
    {

        $crud = new Crud();
        $data = array('angel_id'=>$angel_id, 'title'=>$title, 'service_type'=>$service_type, 'mobile'=>$mobile, 'location'=>$location, 'description'=>$description, 'availability'=>$availability, 'hourly_price'=>$hourly_price, 'years_of_experience'=>$years_of_experience);
        $table = 'posts';

        if($crud->insert($table, $data)){

            header("location:dashboard.php");
        }
    }

    //upload post image
    public static function upload_image( $post_id, $image_path )
    {
        //echo $post_id;
        $crud = new Crud();
        $data = array('post_id'=>$post_id, 'image_path'=>$image_path);
        $table = 'images';

        if($crud->insert($table, $data)){

            header("location:dashboard.php");
        }
    }

    //update the post details
    public static function update( $id,$angel_id, $title, $service_type, $mobile, $location, $description, $availability, $hourly_price, $years_of_experience )
    {

        $crud = new Crud();
        $data = array('angel_id'=>$angel_id, 'title'=>$title, 'service_type'=>$service_type, 'mobile'=>$mobile, 'location'=>$location, 'description'=>$description, 'availability'=>$availability, 'hourly_price'=>$hourly_price, 'years_of_experience'=>$years_of_experience);
        $table = 'posts';

        if($crud->doUpdate($table, $data , array('id'=>$id))){

            header("location:dashboard.php");
        }else{
            echo 'fail';
        }
    }

    //auth user
    public static function auth( $user_name  )
    {

        $crud = new Crud();
        $table = 'angels';
        $crud->select($table, array('id'),array('user_name'=>$user_name));

        if(!empty($crud->getResult()[0]['id'])) {
            return $crud->getResult()[0]['id'];
        }else{
            echo 'fail';
        }

    }

    //get post data
    public static function get_post( $angel_id )
    {

        $crud = new Crud();
        $table = 'posts';
        $crud->select($table, array('id', 'angel_id', 'title', 'service_type', 'mobile', 'location', 'description', 'availability', 'hourly_price', 'years_of_experience'),array('angel_id'=>$angel_id));

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

    //delete posts
    public static function delete_post( $id )
    {

        $crud = new Crud();
        $table = 'posts';

        if($crud->delete($table, array('id'=>$id))){

            header("location:delete_post.php");
        }

    }

    //delete post image
    public static function delete_image( $id,$path )
    {

        $crud = new Crud();
        $table = 'images';

        if($crud->delete($table, array('id'=>$id))){
            unlink($path);
            header("location:dashboard.php");
        }

    }
}

?>