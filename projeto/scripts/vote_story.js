let upvotes = document.querySelectorAll('section #upvote button');
let downvotes = document.querySelectorAll('section #downvote button');
upvotes.forEach((upvote) => upvote.addEventListener('click', voteClicked)); 
downvotes.forEach((downvote) => downvote.addEventListener('click', voteClicked)); 

function voteClicked(event) {
  let info = event.currentTarget;
  let user = info.getAttribute('user');
  let story = info.getAttribute('story');
  let action = info.getAttribute('action');
  
  let request = new XMLHttpRequest();
  request.open("POST", "../api/api_vote_story.php", true);
  request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
  request.addEventListener("load", function () {
    let updatedStory = JSON.parse(this.responseText);
    document.querySelector('section #upvote[data-storyid=' + CSS.escape(story) + '] #numUpvotes').innerHTML = updatedStory.upvotes;
    document.querySelector('section #downvote[data-storyid=' + CSS.escape(story) + '] #numDownvotes').innerHTML = updatedStory.downvotes;
    
  });
  request.send(encodeForAjax({user: user, story: story, action: action}));
}

function encodeForAjax(data) {
  return Object.keys(data).map(function(k){
    return encodeURIComponent(k) + '=' + encodeURIComponent(data[k])
  }).join('&');
}