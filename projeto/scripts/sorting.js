let sortingCriteria = document.querySelector('section#sidebar_sort form select');
if (sortingCriteria) {
  sortingCriteria.addEventListener('change', changeSortingCriteria);
}

function changeSortingCriteria(event) {
  let selectedCriteria = event.target;
  let request = new XMLHttpRequest();
  let regexChannelPage = /channel_page.php/,
      regexMainPage = /mainpage.php/;
  let origin, channel;

  if (regexChannelPage.test(window.location.pathname)) {
    origin = 'channel_page';
    channel = document.querySelector('section#channel_info').getAttribute('channel');
  } else if (regexMainPage.test(window.location.pathname)) {
    origin = 'main_page';
  } else {
    origin = 'sub_feed';
  }

  request.open("POST", "../api/api_sort_stories.php", true);
  request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
  request.addEventListener("load", function () {
    document.querySelector('section#story_list').parentNode.removeChild(document.querySelector('section#story_list'));
    if (origin == 'channel_page') { //in channel page
      console.log(this.responseText); 
      document.querySelector('section#channel_page').insertAdjacentHTML('beforeend', this.responseText);
    } else { //in main page or sub feed 
      document.querySelector('body').insertAdjacentHTML('beforeend', this.responseText);
      document.querySelector('section#story_list').setAttribute('class', 'page');
    }
    audiojs.createAll();

  });
  request.send(encodeForAjax({criteria: selectedCriteria.options[selectedCriteria.selectedIndex].value, caller: origin, channel: channel}));
};

