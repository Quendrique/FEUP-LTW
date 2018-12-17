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

  if(comment != '')
  {
      let request = new XMLHttpRequest();
      request.open("POST", "../api/api_add_comment.php", true);
      request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
      request.addEventListener("load", function () {    
      document.querySelector('section#comments').insertAdjacentHTML('beforeend', this.responseText);
      info.querySelector('textarea[name=comment]').value = '';
      });
      request.send(encodeForAjax({user: user, story: story, comment: comment}));
  }
  else
  {
    document.forms["insert_comment"].querySelector('input[type="submit"]').click();
  }
}

function encodeForAjax(data) {
  return Object.keys(data).map(function(k){
    return encodeURIComponent(k) + '=' + encodeURIComponent(data[k])
  }).join('&');
}