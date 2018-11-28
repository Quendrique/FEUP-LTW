<?php function draw_upload() {
 ?>
  <section id="upload">
        <h1> Upload</h1>
        <div id=uploadInfo>
            <div id = "uploadFile"> 
                <img src= "../img/unknownuser.png" height="150" width="150"/>
                <form action="" method="POST" enctype="multipart/form-data">
                    <label class="fileUploadLabel uploadButton" for="image">Upload Image</label>
                    <input type="file" name="image" id="image"/> 
                    <!--<input type="submit" class="submit"/>-->
                </form>
            </div> 
            <div id="infoBlock">
                <form action="" method="POST" enctype="multipart/form-data">
                    <label class="inputLabel">title:
                        <input class="inputField" type="text" name="title" placeholder="title" autocomplete="new-username" required>
                    </label> 
                    <label class="inputLabel">channel:
                        <select name="channels" class="inputField" required>
                            <option value="">None</option>
                        </select>    
                    </label> 
                        <textarea class="inputField" rows="8" cols="50" placeholder="Description" required></textarea>
                </form> 
            </div> 
        </div>  
        <div id = "uploadFile"> 
                <form action="" method="POST" enctype="multipart/form-data">
                    <label class="fileUploadLabel uploadButton" for="image">Upload Track</label>
                    <input type="file" name="track" id="track"/> 
                    <!--<input type="submit" class="submit"/>-->
                </form>
        </div>           
                 
   </section>
<?php } ?>



