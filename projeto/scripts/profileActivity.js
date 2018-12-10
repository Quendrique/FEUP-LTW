function loadPostsActivity(event) {
  let button = event.target;
  
  if(button.value=="Posts"){
    let stories = document.getElementById('posts');
    let comments = document.getElementById('comments');
    stories.style.display = "inline";
    comments.style.display = "none";
  }else{
    let stories = document.getElementById('posts');
    let comments = document.getElementById('comments');
    stories.style.display = "none";
    comments.style.display = "inline";
  }
  
}