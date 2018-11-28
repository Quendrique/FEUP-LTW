<?php
    include_once('../includes/incl_session.php');
    include_once('../database/db_channels.php');
    include_once('../templates/tpl_common.php');
    include_once('../templates/tpl_account.php');
    include_once('../templates/tpl_upload.php');
    include_once('../database/db_account.php');

  
    $username = $_GET['user'];

    $userdata = getUserData($username);
    draw_header($username);
    /*if(!empty($userdata)) //if user exists
    {
        draw_header($username);
        printProfile($userdata[0]);
    }
    else //if user does not exist
    {
        draw_header(null);
        printProfileError($username);
    }*/
    draw_sidebar_login();
    draw_upload();

   if(isset($_FILES['image'])){
      $errors= array();
      $file_name = $_FILES['image']['name'];
      $file_size =$_FILES['image']['size'];
      $file_tmp =$_FILES['image']['tmp_name'];
      $file_type=$_FILES['image']['type'];
      $file_ext=strtolower(end(explode('.',$_FILES['image']['name'])));
      
      $expensions= array("jpeg","jpg","png");
      
      if(in_array($file_ext,$expensions)=== false){
         $errors[]="extension not allowed, please choose a JPEG or PNG file.";
      }
      
      if($file_size > 2097152){
         $errors[]='File size must be excately 2 MB';
      }
      
      if(empty($errors)==true){
         //do something
         echo "Success";
      }else{
         print_r($errors);
      }
   }

   if(isset($_FILES['track'])){
    $errors= array();
    $file_name = $_FILES['track']['name'];
    $file_size =$_FILES['track']['size'];
    $file_tmp =$_FILES['track']['tmp_name'];
    $file_type=$_FILES['track']['type'];
    $file_ext=strtolower(end(explode('.',$_FILES['track']['name'])));
    
    $expensions= array("mp3");
    
    if(in_array($file_ext,$expensions)=== false){
       $errors[]="extension not allowed, please choose an mp3 file.";
    }
    
    if($file_size > 2097152){
       $errors[]='File size must be excately 2 MB';
    }
    
    if(empty($errors)==true){
       //do something
       echo "Success";
    }else{
       print_r($errors);
    }
 }

   draw_footer();
?>

