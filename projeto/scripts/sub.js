let sub = document.querySelector('section#channel_info button');

//console.log(document.querySelector('section#channel_info button'));

sub.addEventListener('click', subClicked);

function subClicked(event) {
  let info = event.currentTarget;
  let user = info.getAttribute('user');
  let channel = info.getAttribute('channel');
  let action = info.getAttribute('action');
  
  let request = new XMLHttpRequest();
  request.open("POST", "../api/api_sub_channel.php", true);
  request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
  request.addEventListener("load", function () {
    if (action == 1) { // 1 - sub 
      info.innerHTML = 'Unsubscribe';  
      info.setAttribute('action', 0);
      let listItem = document.createElement('li');
      let newSub = document.createElement('a');
      let subList = document.querySelector('section#sidebar_subs ul');
      newSub.setAttribute('href', "../pages/channel_page.php?channel=" + channel);
      newSub.setAttribute('class', 'sidebarPurpleLink');
      listItem.setAttribute('data-channel', channel);
      newSub.innerHTML = channel;
      listItem.appendChild(newSub);
      subList.appendChild(listItem);
    } else { // 0 - unsub
      info.innerHTML = 'Subscribe';  
      info.setAttribute('action', 1);
      document.querySelector('section#sidebar_subs ul li[data-channel=' + CSS.escape(channel) + ']').remove();
    };
    let updatedSubCount = JSON.parse(this.responseText);
    document.querySelector('section#channel_info #sub_count').innerHTML = updatedSubCount.numSubs + ' subscriber(s)';
  });
  request.send(encodeForAjax({user: user, channel: channel, action: action}));
}

function encodeForAjax(data) {
  return Object.keys(data).map(function(k){
    return encodeURIComponent(k) + '=' + encodeURIComponent(data[k])
  }).join('&');
}