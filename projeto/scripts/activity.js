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

function loadSearchResults(event) {
  let button = event.target;
  let stories = document.getElementById('search_stories');
  let channels = document.getElementById('search_channels');
  let comments = document.getElementById('search_comments');
  let storiesH1 = document.getElementById('activityStories');
  let channelsH1 = document.getElementById('activityChannels');
  let commentsH1 = document.getElementById('activityComments');

  if(button.value=="All" ){
    stories.style.display = "inline";
    comments.style.display = "inline";
    channels.style.display = "inline";

    storiesH1.style.display = "flex";
    channelsH1.style.display = "flex";
    commentsH1.style.display = "flex";
  }else{
    storiesH1.style.display = "none";
    channelsH1.style.display = "none";
    commentsH1.style.display = "none";
  
    if(button.value=="Posts" ){
      stories.style.display = "inline";
      comments.style.display = "none";
      channels.style.display = "none";

    }else if(button.value=="Comments" ){
      stories.style.display = "none";
      comments.style.display = "inline";
      channels.style.display = "none";

    }else if(button.value=="Channels" ){
      stories.style.display = "none";
      comments.style.display = "none";
      channels.style.display = "inline";
    }
}
  
}