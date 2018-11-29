function onImageSelected(event) {

    event.stopPropagation();

    var input = event.target;
    var reader = new FileReader();
    reader.onload = function(){
      var dataURL = reader.result;
      var output = document.getElementById('uploadedImage');
      output.src = dataURL;
    };
    reader.readAsDataURL(input.files[0]);
}

function onTrackSelected(event) {

    event.stopPropagation();

    var input = event.target;
    var reader = new FileReader();
    reader.onload = function(){
      var dataURL = reader.result;
      var output = document.getElementById('uploadedTrack');
      output.src = dataURL;
    };
    reader.readAsDataURL(input.files[0]);
}