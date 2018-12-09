function loadPostsActivity(event) {
    let username = document.getElementById('username').value;
    let info = event.currentTarget;
    info.innerHTML = 'Unsubscribe';  

  }

function encodeForAjax(data) {
    return Object.keys(data).map(function(k){
      return encodeURIComponent(k) + '=' + encodeURIComponent(data[k])
    }).join('&');
  }