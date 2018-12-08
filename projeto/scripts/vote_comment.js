let upvotesComments = document.querySelectorAll('article#comment section#upvote button');
let downvotesComments = document.querySelectorAll('article#comment section#downvote button');

console.log(document.querySelectorAll('article#comment section#upvote button'));

upvotesComments.forEach((upvoteComments) => upvoteComments.addEventListener('click', voteCommentClicked)); 
downvotesComments.forEach((downvoteComments) => downvoteComments.addEventListener('click', voteCommentClicked)); 

function voteCommentClicked(event) {
  let info = event.currentTarget;
  console.log(event.currentTarget);
  let user = info.getAttribute('user');
  let story = info.getAttribute('story');
  let action = info.getAttribute('action');
  let comment = info.getAttribute('comment');
  
  let request = new XMLHttpRequest();
  request.open("POST", "../api/api_vote_comment.php", true);
  request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
  request.addEventListener("load", function () {
    let updatedComment = JSON.parse(this.responseText);
    console.log(document.querySelector('article#comment section#upvote[data-commentid=' + CSS.escape(comment) + '] #numUpvotes'));
    document.querySelector('article#comment section#upvote[data-commentid=' + CSS.escape(comment) + '] #numUpvotes').innerHTML = updatedComment.upvotes;
    document.querySelector('article#comment section#downvote[data-commentid=' + CSS.escape(comment) + '] #numDownvotes').innerHTML = updatedComment.downvotes;
    
  });
  request.send(encodeForAjax({user: user, story: story, action: action, comment: comment}));
}

function encodeForAjax(data) {
  return Object.keys(data).map(function(k){
    return encodeURIComponent(k) + '=' + encodeURIComponent(data[k])
  }).join('&');
}