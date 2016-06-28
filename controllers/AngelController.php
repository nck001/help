<?php
include_once("/../crud.php");

class AngelController extends Crud{
    public static $crud;

    public function __construct()
    {

    }

    //angels store
    public static function store( $user_name ,$email, $password )
    {
        $rand = substr(md5(microtime()),rand(0,26),5);
        $crud = new Crud();
        $data = array('user_name'=>$user_name,'email'=>$email,'password'=>$password,'activation_code'=>$rand);
        $table = 'angels';

        if($crud->insert($table, $data)){


            $emailFrom = "admin@help.com";
            $subject = "Activation Code";
            $headers = 'From:' . $emailFrom . "\r\n";
            $headers .= "Reply-To: " . $email . "\r\n";
            $headers .= "Return-path: " . $email;
            $message = "Your activation code is ".$rand.".";
            mail($email, $subject, $message, $headers);

            header("location:activation.php");



        }
    }

    //angels login
    public static function login( $user_name , $password )
    {

        $crud = new Crud();
        $data = array('user_name'=>$user_name,'password'=>$password);
        $table = 'angels';
        $crud->select($table, array('user_name','account_activation'),array('user_name'=>$user_name,'password'=>$password));



        if(!empty($crud->getResult()[0]['user_name'])) {
            if ($crud->getResult()[0]['user_name'] === $user_name && $crud->getResult()[0]['account_activation'] == 1) {



                $_SESSION['user_name'] = $user_name;
                header("location:dashboard.php");


            }
        }else{
           return false;
        }

    }

    //check the username and email available to register
    public static function check( $user_name , $email )
    {

        $crud = new Crud();
        $crud2 = new Crud();
        $data = array('user_name'=>$user_name,'email'=>$email);
        $table = 'angels';
        $crud->select($table, array('user_name','email'),array('user_name'=>$user_name));
        $crud2->select($table, array('user_name','email'),array('email'=>$email));

        if(!empty($crud->getResult()[0]['user_name']) || !empty($crud2->getResult()[0]['email'])) {

                return false;
        }else{
            return true;
        }

    }

    //active the angel account
    public static function active( $username,$activation )
    {

        $crud = new Crud();
        $data = array('account_activation'=>1);
        $table = 'angels';

        $crud->select($table, array('activation_code'),array('user_name'=>$username));
        $active =  $crud->getResult()[0]['activation_code'];

       // echo $active;

        if($active == $activation ){
            $crud->doUpdate($table, $data , array('user_name'=>$username,'activation_code'=>$activation));
           return true;
        }else{
           return false;
        }
    }
}

?>