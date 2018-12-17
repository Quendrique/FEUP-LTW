let voteStory = document.querySelector('body');

if (voteStory) {
  voteStory.addEventListener('click', voteStoryClicked)
}

function voteStoryClicked(event) {
  let info = event.target.closest('article#story button');

  if (info) {
    let user = info.getAttribute('user');
    let story = info.getAttribute('story');
    let action = info.getAttribute('action');
    let oldUpVotes = document.querySelector('article#story section#upvote[data-storyid=' + CSS.escape(story) + '] #numUpvotes').innerHTML;
    let oldDownVotes = document.querySelector('article#story section#downvote[data-storyid=' + CSS.escape(story) + '] #numDownvotes').innerHTML;;
    let newUpVotes = document.querySelector('article#story section#upvote[data-storyid=' + CSS.escape(story) + '] #numUpvotes');
    let newDownVotes = document.querySelector('article#story section#downvote[data-storyid=' + CSS.escape(story) + '] #numDownvotes');
    
    let request = new XMLHttpRequest();
    request.open("POST", "../api/api_vote_story.php", true);
    request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    request.addEventListener("load", function () {
      let updatedStory = JSON.parse(this.responseText);
  
      newUpVotes.innerHTML = updatedStory.upvotes;
      newDownVotes.innerHTML = updatedStory.downvotes;
  
      //update styles
      if(updatedStory.upvotes>oldUpVotes){
        let downButton =  document.querySelector('article#story section#downvote[data-storyid=' + CSS.escape(story) + '] .votedownBtn');
        styleButtons(info,newUpVotes,newDownVotes,downButton,"rgb(131, 193, 233)"); 
  
      }else if(updatedStory.downvotes>oldDownVotes){
        let upButton = document.querySelector('article#story section#upvote[data-storyid=' + CSS.escape(story) + '] .voteupBtn')
        styleButtons(info,newDownVotes,newUpVotes,upButton,"#A46BE5"); 
  
      }else{
        newDownVotes.style.color = "#373843";
        info.style.color = "#373843";
        newUpVotes.style.color = "#373843";
      }

      //check if we're in a profile page and update the user's points dynamically
      let userPoints = document.querySelector('#user_points');
      let currentProfile;
      if (document.querySelector('span#username h1') !== null) {
        currentProfile = document.querySelector('span#username h1').innerHTML;
      }
      if (userPoints && updatedStory['author'] == currentProfile) {
        let requestUser = new XMLHttpRequest();
        requestUser.open("POST", "../api/api_get_user_points.php", true);
        requestUser.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        requestUser.addEventListener('load', function() {
          console.log(this.responseText);
          userPoints.nextSibling.innerHTML = this.responseText;
        });
        requestUser.send(encodeForAjax({user: currentProfile, story: story}));
      }

  
    });
    request.send(encodeForAjax({user: user, story: story, action: action}));
  }
}

function encodeForAjax(data) {
  return Object.keys(data).map(function(k){
    return encodeURIComponent(k) + '=' + encodeURIComponent(data[k])
  }).join('&');
}

function styleButtons(targetVotes,targetButton,oppositeVotes,oppositeButton,color){
  targetVotes.style.color = color;
  targetButton.style.color = color;
  oppositeVotes.style.color = "#373843";
  oppositeButton.style.color = "#373843";
}