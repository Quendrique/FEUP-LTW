function loadPostsActivity(event) {
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

function showComents(event) {
  let section = event.target;
  let stories = document.getElementById('storyContent');
  console.log(stories);
  if(section.style.display=="none"){
    section.style.display = "inline";
  }else{
    section.style.display = "inline";
  }
}