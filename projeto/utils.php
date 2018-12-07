<?php 
  
function getExtension() {
  $name = $_FILES["image"]["name"];
  return end((explode(".", $name)));
} 

function imageHandler($id) {
  $ext = getExtension();

  // Generate filenames for original, small and medium files
  $originalFileName = "../img/stories/originals/$id.$ext";
  $smallFileName = "../img/stories/thumbs_small/$id.$ext";
  $mediumFileName = "../img/stories/thumbs_medium/$id.$ext";


  move_uploaded_file($_FILES['image']['tmp_name'], $originalFileName);


  // Crete an image representation of the original image
  if($ext == "png")
    $original = imagecreatefrompng($originalFileName);
  else $original = imagecreatefromjpeg($originalFileName);

  $width = imagesx($original);     // width of the original image
  $height = imagesy($original);    // height of the original image
  $square = min($width, $height);  // size length of the maximum square

  // Create and save a small square thumbnail
  $small = imagecreatetruecolor(200, 200);
  imagecopyresized($small, $original, 0, 0, ($width>$square)?($width-$square)/2:0, ($height>$square)?($height-$square)/2:0, 200, 200, $square, $square);
  if($ext == "png") imagepng($small, $smallFileName);
  else imagejpeg($small, $smallFileName);

  // Calculate width and height of medium sized image (max width: 400)
  $mediumwidth = $width;
  $mediumheight = $height;
  if ($mediumwidth > 400) {
    $mediumwidth = 400;
    $mediumheight = $mediumheight * ( $mediumwidth / $width );
  }

  // Create and save a medium image
  $medium = imagecreatetruecolor($mediumwidth, $mediumheight);
  imagecopyresized($medium, $original, 0, 0, 0, 0, $mediumwidth, $mediumheight, $width, $height);

  if($ext == "png") imagepng($medium, $mediumFileName);
  else imagejpeg($medium, $mediumFileName);
}

function trackHandler($id) {

  $fileName = "../tracks/$id.mp3";

  move_uploaded_file($_FILES['track']['tmp_name'], $fileName);
}
?>