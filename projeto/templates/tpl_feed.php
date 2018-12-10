<?php 
include_once('../templates/tpl_stories.php');
include_once('../database/db_stories.php');


function draw_feed($username) { ?>

    <section id="stories_list" class="page">
        <script src="../audiojs/audio.min.js"></script>
        <script>
        audiojs.events.ready(function() {
            audiojs.createAll();
        });
        </script>

        <?php
        if ($username !== null) {
            $all_stories =getAllStories();
            foreach($all_stories as $story){
                draw_story($story);
            }
        } else { ?>
            <h2>Sign in to see all posts!</h2>
        <?php } ?>     
    </section>
 <?php }
 
 function draw_sub_feed($username) { ?>

    <section id="stories_list" class="page">
        <script src="../audiojs/audio.min.js"></script>
        <script>
        audiojs.events.ready(function() {
            audiojs.createAll();
        });
        </script>

        <?php
        if ($username !== null) {
            $all_stories =getAllSubStories($username);
            foreach($all_stories as $story){
                draw_story($story);
            }
        } else {
            die(header('Location: ../pages/mainpage.php'));
        } ?>     
    </section>
 <?php } 

 ?> 
