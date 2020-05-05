// Escape input
function escapeHtml(unsafe) {
    return unsafe
         .replace(/&/g, "&amp;")
         .replace(/</g, "&lt;")
         .replace(/>/g, "&gt;")
         .replace(/"/g, "&quot;")
         .replace(/'/g, "&#039;");
}

// display input field for adding new category

var addCategory = document.getElementById('js-add-category');

addCategory.addEventListener('click', function() {
    document.getElementById('category-name-input').classList.remove('hidden');
}) 


// Animate and complete items, also send data via AJAX to PHP processor
document.addEventListener('click', function (event) {

	// If the clicked element doesn't have the right selector, bail
	if (!event.target.matches('.checkboxLabel')) return;

	// Add class hide to clicked element
    event.target.classList.add('hide-animation');
    
    // Set timeout before hide item
    setTimeout(function() {
        event.target.classList.add('hide');
    }, 500)
    
    // Store values of checkbox
    var data = {
        id: escapeHtml(event.target.getAttribute('data-id')),
        group: escapeHtml(event.target.getAttribute('data-group'))
    };

    // Ajax POST to send checkbox value to PHP processor
    fetch("functions.php", {
      method: "POST",
      mode: "same-origin",
      credentials: "same-origin",
      headers: {
        "Content-Type": "application/json"
      },
        body: JSON.stringify(data)
    }).then(res => {
      console.log("Request complete! response:", res);
    });    

}, false);


// Edit List Titels

var edit = document.getElementById('js-edit');
// var name = document.getElementById('js-list-title').innerHTML;

// console.log(name);

edit.addEventListener('click', function(event) {
    var newName = prompt('What would you like to be the name category name?');
    document.getElementById('js-list-title').innerHTML = newName;
}, false);


/**
*
* Delete categories
*
*/

// Collect click on DELETE
var deleteElem = document.getElementById('js-delete');

// Collect click DELETE CATEGORY and send to PHP processor
deleteElem.addEventListener('click', function (event) {

    // Store values of delete
    var data = {
      id: escapeHtml(event.target.getAttribute('data-id'))
      // group: escapeHtml(event.target.getAttribute('data-group'))
  };


  // Ajax POST to send checkbox value to PHP processor
  fetch("functions.php", {
    method: "POST",
    mode: "same-origin",
    credentials: "same-origin",
    headers: {
      "Content-Type": "application/json"
    },
      body: JSON.stringify(data)
  }).then(res => {
    console.log("Request complete! response:", res);
  }); 
  
}, false);