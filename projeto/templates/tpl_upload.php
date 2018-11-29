<?php


 function draw_upload() {
 ?>

 <meta charset="utf-8">
    <script src="../audiojs/audio.min.js"></script>
    <link rel="stylesheet" href="../css/audiojs.css" media="screen">

    <script>
      audiojs.events.ready(function() {
        audiojs.createAll();
      });
    </script>

  <section id="upload">
  
        <div id="h1upload"><h1> Upload</h1></div>
        <div id=uploadInfo>
            <div id = "uploadFile"> 
                <img id="uploadedImage" src= "../img/templatetrackcover.png" height="150" width="150"/>
                <form action="" method="POST" enctype="multipart/form-data">
                    <label class="fileUploadLabel uploadButton" for="image">Upload Image</label>
                    <script type="text/javascript" src="../scripts/preview.js"></script>
                    <input type="file" name="image" id="image" onchange="onImageSelected(event)"/> 
                    <input type="submit" class="submitButton"/>
                </form>
            </div> 
            <div id="infoBlock">
                <form action="" method="POST" enctype="multipart/form-data">
                    <label class="inputLabel">title:
                        <input class="inputField" type="text" name="title" placeholder="title" autocomplete="new-username" required>
                    </label> 
                    <label class="inputLabel">channel:
                        <select name="channels" class="inputField" required>
                            <option value=""></option>
                        </select>    
                    </label> 
                        <textarea class="inputField" rows="8" cols="50" placeholder="Description" required></textarea>
                </form> 
            </div> 
        </div>  
        <hr>
        
                <form action="" method="POST" enctype="multipart/form-data">
                <div id = "uploadInfo"> 
                    <div id="uploadTrack">
                        <label class="fileUploadLabel uploadButton " for="image">Upload Track</label>
                        <input type="file" name="track" id="track" onchange="onTrackSelected(event)"/> 
                        <input type="submit" class="submitButton"/>
                    </div>    
                    <div id="audiojs">
                        <audio id="uploadedTrack" src="../sampleTrack.mp3" preload="auto"></audio>
                    </div>
                </form>
        </div>  
        <span id="save"><input type="submit" value="save" /></span>
   </section>
<?php } ?>

