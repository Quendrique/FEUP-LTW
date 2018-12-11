function loadPostsActivity(event) {
  let button = event.target;
  let stories = document.getElementById('posts');
    let comments = document.getElementById('comment_list');
  
  if(button.value=="Posts" && stories.style.display == "none"){
    stories.style.display = "inline";
    comments.style.display = "none";
  }else  if(button.value=="Comments" && comments.style.display == "none"){
    stories.style.display = "none";
    comments.style.display = "inline";
  }else{
    stories.style.display = "none";
    comments.style.display = "none";
  }
  
}

function loadChannelsActivity(event) {
  let button = event.target;
  
  if(button.value=="Posts"){
    let stories = document.getElementById('posts');
    let comments = document.getElementById('comment_list');
    stories.style.display = "inline";
    comments.style.display = "none";
  }else{
    let stories = document.getElementById('posts');
    let comments = document.getElementById('comment_list');
    stories.style.display = "none";
    comments.style.display = "inline";
  }
  
}