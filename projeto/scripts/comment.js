let addComment = document.querySelector('section#add_comment');
addComment.addEventListener('click', postComment); 

function postComment(event) {
  let info = event.currentTarget.querySelector('form');
  let user = info.querySelector('input[name=user]').getAttribute('value');
  let story = info.querySelector('input[name=story]').getAttribute('value');
  let comment = info.querySelector('textarea[name=comment]').value;

  let request = new XMLHttpRequest();
  request.open("POST", "../api/api_add_comment.php", true);
  request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
  request.addEventListener("load", function () {
    //display new comment

    //let commentList = document.querySelector('section#comment_list');
    //commentList.appendChild();
  });
  request.send(encodeForAjax({user: user, story: story, comment: comment}));
}

function encodeForAjax(data) {
  return Object.keys(data).map(function(k){
    return encodeURIComponent(k) + '=' + encodeURIComponent(data[k])
  }).join('&');
}