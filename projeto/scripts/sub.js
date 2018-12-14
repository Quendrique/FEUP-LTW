let sub = document.querySelector('section#channel_info button');

if (sub) {
  sub.addEventListener('click', subClicked);
}

function subClicked(event) {
  let info = event.currentTarget;
  let user = info.getAttribute('user');
  let channel = info.getAttribute('channel');
  let action = info.getAttribute('action');
  
  let request = new XMLHttpRequest();
  request.open("POST", "../api/api_sub_channel.php", true);
  request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
  request.addEventListener("load", function () {
    let subList = document.querySelector('section#sidebar_subs ul');
    if (action == 1) { // 1 - sub 
      info.innerHTML = 'Unsubscribe';  
      info.setAttribute('action', 0);
      let placeholder = document.querySelector('#sub_list_placeholder');
      if(placeholder) {
        placeholder.remove();
      }
      let listItem = document.createElement('li');
      let newSub = document.createElement('a');
      newSub.setAttribute('href', "../pages/channel_page.php?channel=" + channel);
      newSub.setAttribute('class', 'sidebarPurpleLink');
      listItem.setAttribute('data-channel', channel);
      newSub.innerHTML = channel;
      listItem.appendChild(newSub);
      subList.appendChild(listItem);
    } else { // 0 - unsub
      info.innerHTML = 'Subscribe';  
      info.setAttribute('action', 1);
      let subListChildren = document.querySelector('section#sidebar_subs ul > li');
      document.querySelector('section#sidebar_subs ul li[data-channel=' + CSS.escape(channel) + ']').remove();
      if (subListChildren) {
        let placeholderNew = document.createElement('p');
        placeholderNew.setAttribute('id', 'sub_list_placeholder');
        placeholderNew.innerHTML = 'All channels you subscribe to will appear here!';
        subList.appendChild(placeholderNew);  
      }
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