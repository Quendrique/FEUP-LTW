let addComment = document.querySelector('section#add_comment button');
addComment.addEventListener('click', postComment); 

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
    let newComment = JSON.parse(this.responseText);
    let newDisplay = document.createElement('article');
    newDisplay.setAttribute('id', 'comment');
    newDisplay.innerHTML = createComment(newComment, imgsrc);
    let commentList = document.querySelector('section#comment_list');
    commentList.insertBefore(newDisplay, commentList.firstElementChild.nextSibling);
    info.querySelector('textarea[name=comment]').value = '';
  });
  request.send(encodeForAjax({user: user, story: story, comment: comment}));
}

function encodeForAjax(data) {
  return Object.keys(data).map(function(k){
    return encodeURIComponent(k) + '=' + encodeURIComponent(data[k])
  }).join('&');
}

function createComment(data, imgsrc) {

  //[ Y, M, D, h, m, s ]
  var t = data.datetime.split(/[- :]/);

  var html = 
    "<div id ='singleComment'>" +
      "<img  id='userImage'  src="+ imgsrc +" width=35 height=35>" +
      "<div id ='userAndText' class='comment'>" +
        "<span id='user'><a href='../pages/profile.php?user=" + data.author + "'>" + data.author + "</a></span>" +
        "<p>" + data.text + "</p>" +
      "</div>" +
    "</div>" +
    "<footer>" +
      "<section id='upvote' data-commentid=" + data.id + ">" +
        "<button type='submit' class='voteup_btn' id='commentVoteUp' user=" + data.author + " action=1 story=" + data.story_id + " comment=" + data.id + " style='color: rgb(55,56,67)'>" +
          "<i class='fas fa-caret-up fa-lg'></i>" +
        "</button>" +
        "<span id = numUpvotes>" + data.upvotes + "</span>" +
      "</section>" +
      "<section id='downvote' data-commentid="+ data.id +">" +
        "<button type='submit' class='votedown_btn' id='commentVoteDown' user=" + data.author + " action=0 story=" + data.story_id + " comment="+ data.id +"  style='color: rgb(55,56,67)'>" +
          "<i class='fas fa-caret-down fa-lg'></i>" +
        "</button>" +
        "<span id = numDownvotes>"+ data.downvotes +"</span>" +
      "</section>" +
      "<span id ='divDot'>&bull;</span>" +
      "<span id='date'>" + t[2] + "/" + t[1] + "/" + t[0] + "</span>" +
    "</footer>";
    return html;
}