let sortingCriteria = document.querySelector('section#sidebar_sort form select');

sortingCriteria.addEventListener('change', changeSortingCriteria);

function changeSortingCriteria(event) {
  let selectedCriteria = event.target;
  let request = new XMLHttpRequest();
  request.open("POST", "../api/api_sort_stories.php", true);
  request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
  request.addEventListener("load", function () {
    document.querySelector('section#story_list').parentNode.removeChild(document.querySelector('section#story_list'));
    let toUpdate;
    if (toUpdate = document.querySelector('section#channel_page')) { //in channel page
      toUpdate.insertAdjacentHTML('beforeend', this.responseText);
    } else { //in main page or sub feed 
      document.querySelector('body').insertAdjacentHTML('beforeend', this.responseText);
      document.querySelector('section#story_list').setAttribute('class', 'page');
    }
    audiojs.createAll();

  });
  request.send(encodeForAjax({criteria: selectedCriteria.options[selectedCriteria.selectedIndex].value}));
};

