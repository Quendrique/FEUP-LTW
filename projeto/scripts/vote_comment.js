let upvotesComments = document.querySelectorAll('article#comment section#upvote button');
let downvotesComments = document.querySelectorAll('article#comment section#downvote button');

upvotesComments.forEach((upvoteComments) => upvoteComments.addEventListener('click', voteCommentClicked)); 
downvotesComments.forEach((downvoteComments) => downvoteComments.addEventListener('click', voteCommentClicked)); 

function voteCommentClicked(event) {
  let info = event.currentTarget;
  let user = info.getAttribute('user');
  let story = info.getAttribute('story');
  let action = info.getAttribute('action');
  let comment = info.getAttribute('comment');
  let oldUpVotes =  document.querySelector('article#comment section#upvote[data-commentid=' + CSS.escape(comment) + '] #numUpvotes').innerHTML;
  let oldDownVotes = document.querySelector('article#comment section#downvote[data-commentid=' + CSS.escape(comment) + '] #numDownvotes').innerHTML;
  let newUpVotes = document.querySelector('article#comment section#upvote[data-commentid=' + CSS.escape(comment) + '] #numUpvotes');
  let newDownVotes = document.querySelector('article#comment section#downvote[data-commentid=' + CSS.escape(comment) + '] #numDownvotes');

  
  let request = new XMLHttpRequest();
  request.open("POST", "../api/api_vote_comment.php", true);
  request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
  request.addEventListener("load", function () {
    let updatedComment = JSON.parse(this.responseText);

    newUpVotes.innerHTML = updatedComment.upvotes;
    newDownVotes.innerHTML = updatedComment.downvotes;

    //update 
    if(updatedComment.upvotes>oldUpVotes){
      let downButton = document.querySelector('article#comment section#downvote[data-commentid=' + CSS.escape(comment) + '] #commentVoteDown');
      styleButtons(info,newUpVotes,newDownVotes,downButton,"rgb(131, 193, 233)"); 

    }else if(updatedComment.downvotes>oldDownVotes){
      let upButton = document.querySelector('article#comment section#upvote[data-commentid=' + CSS.escape(comment) + '] #commentVoteUp');
      styleButtons(info,newDownVotes,newUpVotes,upButton,"#A46BE5"); 

    }else{
      newDownVotes.style.color = "#373843";
      info.style.color = "#373843";
      newUpVotes.style.color = "#373843";
    }

  });
  request.send(encodeForAjax({user: user, story: story, action: action, comment: comment}));
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