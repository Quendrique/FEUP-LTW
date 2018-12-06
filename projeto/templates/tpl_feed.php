<?php 
include_once('../templates/tpl_stories.php');

function draw_feed($username) {?>

    <section id="stories_list" class="page">

    <?php
    $all_channels =getSubbedChannels($username);
    foreach($all_channels as $channel){
        foreach($channel as $channel_name){
            
            $stories_in_channel = getStoriesInChannel($channel_name);
            
            foreach($stories_in_channel as $story){
                draw_story($story);
            }
            break;
        }
    }    

 } ?> 