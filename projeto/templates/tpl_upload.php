<?php


 function draw_upload() {
 ?>

 <meta charset="utf-8">
    <script src="../audiojs/audio.min.js"></script>

    <script>
      audiojs.events.ready(function() {
        audiojs.createAll();
      });
    </script>

  <section id="upload">
  
        <div id="h1upload"><h1> Upload</h1></div>
        <form action="../actions/action_upload_story.php" method="POST" enctype="multipart/form-data">

            <div id=uploadInfo>
                <div id = "uploadFile"> 
                    <img id="uploadedImage" src= "../img/templatetrackcover.png" height="200" width="200"/>
                        <!--<label class="fileUploadLabel uploadButton" for="image">Upload Image</label>-->
                        <script type="text/javascript" src="../scripts/preview.js"></script>
                        <input type="file" name="image" id="image" onchange="onImageSelected(event)"/> 
                </div> 

                <div id="infoBlock">
                    <label class="inputLabel">title:
                        <input class="inputField" type="text" name="title" placeholder="title" autocomplete="new-username" required>
                    </label> 
                    
                    <textarea class="inputField" rows="8" cols="50" name="description" placeholder="Description" required></textarea>
                </div> 
            </div> 

            <hr>
            
            <div id = "uploadInfo"> 
                <!--<label class="fileUploadLabel uploadButton " for="image">Upload Track</label>-->
                    <input type="file" name="track" id="track" onchange="onTrackSelected(event)"/> 
                <div id="audiojs">
                    <audio id="uploadedTrack" src="../sampleTrack.mp3" preload="auto"></audio>
                </div>

            </div> 

            <span id="save"><input type="submit" value="upload" /></span>

        </form>
   </section>
<?php } ?>

