<?php

    include_once('../includes/incl_session.php');
    include_once('../database/db_account.php');

    $username = htmlentities($_POST['username']);
    $name = htmlentities($_POST['name']);
    $birthdate = htmlentities($_POST['birthdate']);
    $email = htmlentities($_POST['email']);
    $gender = htmlentities($_POST['gender']);
    $nationality = htmlentities($_POST['nationality']);

    try {
        updateProfile($username, $name, $birthdate, $email, $gender, $nationality);
        header("Location: ../pages/profile.php?user=$username");
    } catch (PDOException $e) {
        $_SESSION['messages'][] = array('type' => 'error', 'content' => "Unable to update profile");
        die(header("Location: ../pages/profile.php?user=$username"));
    }

?>