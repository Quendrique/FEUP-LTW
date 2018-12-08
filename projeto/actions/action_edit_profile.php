<?php

    include_once('../includes/incl_session.php');
    include_once('../database/db_account.php');

    $username = $_POST['username'];
    $name = $_POST['name'];
    $birthdate = $_POST['birthdate'];
    $email = $_POST['email'];
    $gender = $_POST['gender'];
    $nationality = $_POST['nationality'];

    updateProfile($username, $name, $birthdate, $email, $gender, $nationality);
    header("Location: ../pages/profile.php?user=$username");

?>