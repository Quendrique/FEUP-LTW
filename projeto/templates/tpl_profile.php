<?php function printProfileError($username) {  ?>
  <section id="profile" class= "blockStyle blockLayout page">

   <h1>Profile Error</h1>

   <p>No user with the username <?= $username ?> was found.</p>

   <a href="../pages/mainpage.php">Back to Home</a>

  </section>
<?php } ?>


<?php function printProfile($userdata) {  ?>
  <section id="profile" class= "page">
    <section id="profileInf" class= " blockLayout blockStyle">
      <span id="username"><h1><?=$userdata['username']?></h1></span>
      <div id ="info">
          <?php $igmsrc = getUserImage($userdata['username']);?>
          <img  id="uploadedImage"  src=<?=$igmsrc?> width=200 height="200">
            <div id ="personalData">
            <?php if($userdata['name'] !== ""){?>
            <span><b>Name: </b></span><span><?=$userdata['name']?></span>
            <?php } ?>
            
            <?php if($userdata['birth_day'] !== ""){?>
            <span><b>Birthday: </b></span><span><?=$userdata['birth_day']?></span>
            <?php } ?>

            <?php if($userdata['gender'] !== ""){?>
            <span><b>Gender: </b></span><span><?=$userdata['gender']?></span>
            <?php } ?>

            <?php if($userdata['nationality'] !== ""){?>
            <span><b>Nationality: </b></span><span><?=$userdata['nationality']?></span>
            <?php } ?>

            <?php if($userdata['email'] !== ""){?>
            <span><b>Email: </b></span><span><?=$userdata['email']?></span>
            <?php } ?>
            
            <span><b>Points: </b></span><span><?=$userdata['points']?></span>

  </section>
  <?php draw_activity($userdata['username']);?>
<?php } ?>

<?php 

function printProfileEdit($userdata) { 
  ?>
    <section id="profile" class= " page">
      <section id="profileInf" class= "blockStyle blockLayout ">
        <h1>My profile</h1>
        <?php $igmsrc = getUserImage($userdata['username']);?>
        <div id ="content">
          <form action="../actions/action_edit_profile.php" method="POST" enctype="multipart/form-data">
          <div id = "imageInfo">
            <img  id="uploadedImage"  src=<?=$igmsrc?> width=200 height="200">
            <script type="text/javascript" src="../scripts/fileScripts.js"></script>
            <input type="file" name="image" id="image" onchange="onImageSelected(event)"/> 
          </div>
          <div id = "textForm">
            <input class="inputField" type="text" name="username" value=<?=$userdata['username']?> hidden>
            <p>Name: </p>
            <input class="inputField" type="text" name="name" value="<?=$userdata['name']?>" >
            <p>Birth Date: </p>
            <input class="inputField" type="date" name="birthdate" value=<?=$userdata['birth_day']?>>
  
            <p>Gender: </p>
            <select name="gender">
              <?php if($userdata['gender'] == ""){?>
              <option value="" selected></option>
              <?php } else { ?>
              <option value=""></option>
              <?php } ?>
              <?php if($userdata['gender'] == "Male"){?>
              <option value="Male" selected>Male</option>
              <?php } else { ?>
              <option value="Male">Male</option>
              <?php } ?>
              <?php if($userdata['gender'] == "Female"){?>
              <option value="Female" selected>Female</option>
              <?php } else { ?>
              <option value="Female">Female</option>
              <?php } ?>
            </select>
  
            <p>Nationality: </p>
            <input class="inputField" type="text" name="nationality" value=<?=$userdata['nationality']?>>
  
            <p>E-mail: </p>
            <input class="inputField" type="email" name="email" value=<?=$userdata['email']?>>
  
            <input class="inputField" id="submit" type="submit" value="save changes">
            </div>
          </form>
         </div>
      </section>
      <?php draw_activity($userdata['username']);?>
    </section>
  
  
  <?php } ?>

<?php
include('../templates/tpl_stories.php');
include('../database/db_stories.php');
function draw_activity($username) { ?>
          <script type="text/javascript" src="../scripts/profileActivity.js"></script>
  <span id="activityTitle"><h1>Activity</h1></span>
  <div id ="links">
    <input type="button" value="Posts" id="Posts" onclick="loadPostsActivity(event)" />
    <input type="button" value="Comments" id="Comments"  onclick="loadPostsActivity(event)" />
  </div>
  <section id = "activity">
    <section id = "posts" style="display:inline;">
    <?php draw_stories(getStoriesByUser($username)) ?>
    </section>
    <section id = "comments" style="display:none;">
    <?php $comments = getCommentsByUser($username);
    foreach($comments as $comment){
      draw_comment($comment);
    }?>
    </section>
  </section>
  <?php
} ?>