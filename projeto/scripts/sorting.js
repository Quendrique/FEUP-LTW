let sortingCriteria = document.querySelector('section#sidebar_sort form select');

sortingCriteria.addEventListener('change', changeSortingCriteria);

function changeSortingCriteria(event) {
  let selectedCriteria = event.target;
  console.log(selectedCriteria.options[selectedCriteria.selectedIndex].value);

  let request = new XMLHttpRequest();
  request.open("POST", "../api/api_sort_stories.php", true);
  request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
  request.addEventListener("load", function () {
    console.log(document.querySelector('section#story_list'));
    document.querySelector('section#story_list').innerHTML = this.responseText;
  });
  request.send(encodeForAjax({criteria: selectedCriteria.options[selectedCriteria.selectedIndex].value}));
};

