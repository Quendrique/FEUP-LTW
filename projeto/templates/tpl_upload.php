<?php function draw_upload($username) {
 ?>

 <meta charset="utf-8">
    <script src="../audiojs/audio.min.js"></script>
        <section id="upload" class= "blockStyle blockLayout page">
  
        <div id="h1upload"><h1>New Story</h1></div>
        <form action="../actions/action_upload_story.php" method="POST" enctype="multipart/form-data">
        <input id="username" name="username"  type="hidden"  value=<?=$username?>>

            <div id=uploadInfo>
                <div id = "uploadFile"> 
                    <img id="uploadedImage" src= "../img/templatetrackcover.png" height="200" width="200"/>
                    <script type="text/javascript" src="../scripts/fileScripts.js"></script>
                    <input type="file" name="image" id="image" onchange="onImageSelected(event)"/> 
                </div> 

                <div id="infoBlock">
                    <label class="inputLabel">title:
                        <input class="inputField" type="text" name="title" placeholder="Title" autocomplete="new-username" required>
                    </label>
                    <label class="inputLabel">channel: 
                        <select name="channels">
                        <?php 
                            $all_channels = getChannels();
                            foreach($all_channels as $channel){
                                foreach($channel as $channel_name){ ?>
                                    <option value=<?=$channel_name?>><?=$channel_name?></option> 
                                    <?php
                                    break;
                                }    
                            }?>
                                
                        </select>
                    </label>    
                    <textarea class="inputField" rows="8" cols="50" name="description" placeholder="Description" required></textarea>
                </div> 
            </div>
            
            <hr>

            <div id = "uploadInfo2"> 
                <div id="audiojs">
                    <audio id="uploadedTrack" preload="auto"></audio>
                </div>
                <input type="file" name="track" id="track" onchange="onTrackSelected(event)"/> 
               

            </div> 

            <span id="save"><input type="submit" value="upload" /></span>

        </form>
   </section>
<?php } ?>

