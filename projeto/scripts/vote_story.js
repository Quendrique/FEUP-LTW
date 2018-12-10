let upvotes = document.querySelectorAll('article#story section#upvote button');
let downvotes = document.querySelectorAll('article#story section#downvote button');
upvotes.forEach((upvote) => upvote.addEventListener('click', voteStoryClicked)); 
downvotes.forEach((downvote) => downvote.addEventListener('click', voteStoryClicked)); 



function voteStoryClicked(event) {
  let info = event.currentTarget;
  let user = info.getAttribute('user');
  let story = info.getAttribute('story');
  let action = info.getAttribute('action');
  let oldUpVotes = $('#numUpvotes').text();
  let oldDownVotes = $('#numDownvotes').text();
  let newUpVotes = document.querySelector('article#story section#upvote[data-storyid=' + CSS.escape(story) + '] #numUpvotes');
  let newDownVotes = document.querySelector('article#story section#downvote[data-storyid=' + CSS.escape(story) + '] #numDownvotes');

  
  let request = new XMLHttpRequest();
  request.open("POST", "../api/api_vote_story.php", true);
  request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
  request.addEventListener("load", function () {
    let updatedStory = JSON.parse(this.responseText);

    newUpVotes.innerHTML = updatedStory.upvotes;
    newDownVotes.innerHTML = updatedStory.downvotes;

    if(updatedStory.upvotes>oldUpVotes){
      newUpVotes.style.color = "rgb(131, 193, 233)";
      info.style.color = "rgb(131, 193, 233)";
      newDownVotes.style.color = "#373843";
      document.getElementById('votedownBtn').style.color = "#373843";
    }else{
      document.querySelector('article#story section#upvote[data-storyid=' + CSS.escape(story) + '] #numUpvotes').style.color = "#373843";
      info.style.color = "#373843";
    }

    if(updatedStory.downvotes>oldDownVotes){
      newDownVotes.style.color = "#A46BE5";
      info.style.color = "#A46BE5";
      newUpVotes.style.color = "#373843";
      document.getElementById('voteupBtn').style.color = "#373843";
    }else{
      document.querySelector('article#story section#downvote[data-storyid=' + CSS.escape(story) + '] #numDownvotes').style.color = "#373843";
      info.style.color = "#373843";
    }
  });
  request.send(encodeForAjax({user: user, story: story, action: action}));
}

function encodeForAjax(data) {
  return Object.keys(data).map(function(k){
    return encodeURIComponent(k) + '=' + encodeURIComponent(data[k])
  }).join('&');
}