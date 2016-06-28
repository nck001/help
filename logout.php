<?php include("header.php");  ?>
<?php include_once("controllers/AngelController.php");  ?>
<?php if(isset($_SESSION['user_name'])) { ?>

<div class=" row col-md-8 col-md-offset-2">
    <div class="alert alert-success" role="alert">Logged out successfully</div>

    <?php


    // Unset all of the session variables.
    $_SESSION = array();

    // If it's desired to kill the session, also delete the session cookie.
    // Note: This will destroy the session, and not just the session data!
    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000,
            $params["path"], $params["domain"],
            $params["secure"], $params["httponly"]
        );
    }

    // Finally, destroy the session.
    session_destroy();

    header( "refresh:2;url=login.php" );
    ?>



</div>

<?php } else {
    header("location:login.php");
}?>

<?php include("footer.php");  ?>
