let addComment = document.querySelector('section#add_comment button');

if (addComment) {
  addComment.addEventListener('click', postComment); 
}

function postComment() {
  let info = document.querySelector('section#add_comment');
  let user = info.querySelector('input[name=user]').getAttribute('value');
  let story = info.querySelector('input[name=story]').getAttribute('value');
  let comment = info.querySelector('textarea[name=comment]').value;
  let imgsrc = info.querySelector('img').getAttribute('src');

  let request = new XMLHttpRequest();
  request.open("POST", "../api/api_add_comment.php", true);
  request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
  request.addEventListener("load", function () {    
    let newDisplay = document.createElement('article');
    newDisplay.setAttribute('id', 'comment');
    newDisplay.innerHTML = this.responseText
    let commentList = document.querySelector('section#comment_list');
    commentList.appendChild(newDisplay);
    info.querySelector('textarea[name=comment]').value = '';
  });
  request.send(encodeForAjax({user: user, story: story, comment: comment}));
}

function encodeForAjax(data) {
  return Object.keys(data).map(function(k){
    return encodeURIComponent(k) + '=' + encodeURIComponent(data[k])
  }).join('&');
}