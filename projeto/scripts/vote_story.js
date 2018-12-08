let upvotes = document.querySelectorAll('article#story section#upvote button');
let downvotes = document.querySelectorAll('article#story section#downvote button');
upvotes.forEach((upvote) => upvote.addEventListener('click', voteStoryClicked)); 
downvotes.forEach((downvote) => downvote.addEventListener('click', voteStoryClicked)); 

function voteStoryClicked(event) {
  let info = event.currentTarget;
  let user = info.getAttribute('user');
  let story = info.getAttribute('story');
  let action = info.getAttribute('action');
  
  let request = new XMLHttpRequest();
  request.open("POST", "../api/api_vote_story.php", true);
  request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
  request.addEventListener("load", function () {
    let updatedStory = JSON.parse(this.responseText);
    document.querySelector('article#story section#upvote[data-storyid=' + CSS.escape(story) + '] #numUpvotes').innerHTML = updatedStory.upvotes;
    document.querySelector('article#story section#downvote[data-storyid=' + CSS.escape(story) + '] #numDownvotes').innerHTML = updatedStory.downvotes;
    
  });
  request.send(encodeForAjax({user: user, story: story, action: action}));
}

function encodeForAjax(data) {
  return Object.keys(data).map(function(k){
    return encodeURIComponent(k) + '=' + encodeURIComponent(data[k])
  }).join('&');
}