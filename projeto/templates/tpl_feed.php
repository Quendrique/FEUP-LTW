<?php 
include_once('../templates/tpl_stories.php');
include_once('../database/db_stories.php');


function draw_feed($username) {?>

    <section id="stories_list" class="page">
    <script src="../audiojs/audio.min.js"></script>
    <script>
    audiojs.events.ready(function() {
        audiojs.createAll();
    });
    </script>

    <?php
    $all_stories =getAllStories();
    foreach($all_stories as $story){
           
                draw_story($story);
            
        
    }    

 } ?> 