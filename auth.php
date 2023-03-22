<?php include_once('includes/load.php'); ?>
<?php
$req_fields = array('username','password' );
validate_fields($req_fields);
$username = remove_junk($_POST['username']);
$password = remove_junk($_POST['password']);

if(empty($errors)){
  $user_id = authenticate($username, $password);
  if($user_id){
    //create session with id
     $session->login($user_id);
    //Update Sign in time
     updateLastLogIn($user_id);
     // redirect user to group home page by user level
           if($user['user_level'] === '1'):
             $session->msg("s", "Hello ".$user['username'].", Welcome to Sales Management System.");
             redirect('admin.php',false);
           elseif ($user['user_level'] === '2'):
              $session->msg("s", "Hello ".$user['username'].", Welcome to Sales Management System.");
             redirect('special.php',false);
           else:
              $session->msg("s", "Hello ".$user['username'].", Welcome to Sales Management System.");
             redirect('home.php',false);
           endif;

  } else {
    $session->msg("d", "Sorry Username/Password incorrect.");
    redirect('index.php',false);
  }

} else {
   $session->msg("d", $errors);
   redirect('index.php',false);
}

?>

