<?php function printProfileError($username) {  ?>
  <section id="profile" class= "blockStyle blockLayout page">

   <h1>Profile Error</h1>

   <p>No user with the username <?= $username ?> was found.</p>

   <a href="../pages/mainpage.php">Back to Home</a>

  </section>
<?php } ?>

<?php function printProfile($userdata) {  ?>
  <section id="profile" class= "blockStyle blockLayout page">

    <h1><?=$userdata['username']?></h1>

    <?php if($userdata['name'] !== ""){?>
    <p><b>Name: </b><?=$userdata['name']?></p>  
    <?php } ?>

    <?php if($userdata['birth_day'] !== ""){?>
    <p><b>Birthday: </b><?=$userdata['birth_day']?></p>  
    <?php } ?>

    <?php if($userdata['gender'] !== ""){?>
    <p><b>Gender: </b><?=$userdata['gender']?></p>  
    <?php } ?>

    <?php if($userdata['nationality'] !== ""){?>
    <p><b>Nationality: </b><?=$userdata['nationality']?></p>  
    <?php } ?>

    <?php if($userdata['email'] !== ""){?>
    <p><b>Email: </b><?=$userdata['email']?></p>  
    <?php } ?>

  </section>
<?php } ?>

<?php 

function printProfileEdit($userdata) { 
?>
  <section id="profile" class= "blockStyle blockLayout page">

    <h1>Edit your profile</h1>
    <?php $igmsrc = getUserImage($userdata['username']);?>
    <div id ="content">
      <form action="../actions/action_edit_profile.php" method="POST" enctype="multipart/form-data">
      <div id = "imageInfo">
        <img  id="uploadedImage"  src=<?=$igmsrc?> width=200 height="200">
        <script type="text/javascript" src="../scripts/fileScripts.js"></script>
        <input type="file" name="image" id="image" onchange="onImageSelected(event)"/> 
      </div>
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
      </form>
    <div>
    <hr class="line">

  </section>
<?php } ?>