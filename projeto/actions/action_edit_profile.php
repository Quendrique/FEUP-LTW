<?php

    include_once('../includes/incl_session.php');
    include_once('../database/db_account.php');

    $username = preg_replace ("/[<>]/", '^', $_POST['username']);
    $name = preg_replace ("/[<>]/", '^', $_POST['name']);
    $birthdate = preg_replace ("/[<>]/", '^', $_POST['birthdate']);
    $email = preg_replace ("/[<>]/", '^', $_POST['email']);
    $gender = preg_replace ("/[<>]/", '^', $_POST['gender']);
    $nationality = preg_replace ("/[<>]/", '^', $_POST['nationality']);

    updateProfile($username, $name, $birthdate, $email, $gender, $nationality);
    header("Location: ../pages/profile.php?user=$username");

?>