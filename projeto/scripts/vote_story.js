let upvotes = document.querySelectorAll('article#story section#upvote button');
let downvotes = document.querySelectorAll('article#story section#downvote button');
upvotes.forEach((upvote) => upvote.addEventListener('click', voteStoryClicked)); 
downvotes.forEach((downvote) => downvote.addEventListener('click', voteStoryClicked)); 



function voteStoryClicked(event) {
  let info = event.currentTarget;
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
      let downButton =  document.querySelector('article#story section#downvote[data-storyid=' + CSS.escape(story) + '] #votedownBtn');
      console.log(downButton);
      styleButtons(info,newUpVotes,newDownVotes,downButton,"rgb(131, 193, 233)"); 

    }else if(updatedStory.downvotes>oldDownVotes){
      let upButton = document.querySelector('article#story section#upvote[data-storyid=' + CSS.escape(story) + '] #voteupBtn')
      styleButtons(info,newDownVotes,newUpVotes,upButton,"#A46BE5"); 

    }else{
      newDownVotes.style.color = "#373843";
      info.style.color = "#373843";
      newUpVotes.style.color = "#373843";
    }

  });
  request.send(encodeForAjax({user: user, story: story, action: action}));
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