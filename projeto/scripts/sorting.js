let sortingCriteria = document.querySelector('section#sidebar_sort form select');

sortingCriteria.addEventListener('change', changeSortingCriteria);

function changeSortingCriteria(event) {
  let selectedCriteria = event.target;
  console.log(selectedCriteria.options[selectedCriteria.selectedIndex].value);

  let request = new XMLHttpRequest();
  request.open("POST", "../api/api_sort_stories.php", true);
  request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
  request.addEventListener("load", function () {
    let channelPageElems = document.querySelectorAll('section#channel_page > :not(#channel_info)');
    channelPageElems.forEach(function(elem) {
      elem.parentElement.removeChild(elem);
    });
    console.log(this.responseText);
    document.querySelector('section#channel_page').insertAdjacentHTML('beforeend', this.responseText);
  });
  request.send(encodeForAjax({criteria: selectedCriteria.options[selectedCriteria.selectedIndex].value}));
};

