// Escape input
function escapeHtml(unsafe) {
    return unsafe
         .replace(/&/g, "&amp;")
         .replace(/</g, "&lt;")
         .replace(/>/g, "&gt;")
         .replace(/"/g, "&quot;")
         .replace(/'/g, "&#039;");
}

/**
*
* Complete item
*
*/

var addCategory = document.getElementById('js-add-category');

addCategory.addEventListener('click', function() {
    document.getElementById('category-name-input').classList.remove('hide');
}) 


/**
*
* Complete item
*
*/

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
      group: escapeHtml(event.target.getAttribute('data-group')),      
      data_action: 'delete_item',
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


/**
*
* Edit category titles
*
*/

document.addEventListener('click', function (event) {

	// If the clicked element doesn't have the right selector, bail
  if (!event.target.matches('.js-edit')) return;
  
  // Prompt input for new category name
  var newName = escapeHtml(prompt('Aangepaste categorie naam:')); 

  // Get ListTitleId
  ListTitleId = 'js-list-title_' + escapeHtml(event.target.getAttribute('data-id'));

  // Set new category name
  document.getElementById(ListTitleId).innerHTML = newName;
    
  // Store values for edit
  var data = {
    id: escapeHtml(event.target.getAttribute('data-id')),
    group: escapeHtml(event.target.getAttribute('data-group')),
    new_name: newName,
    data_action: 'edit_category_name'
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


/**
*
* Delete categorie and items
*
*/

document.addEventListener('click', function (event) {

	// If the clicked element doesn't have the right selector, bail
  if (!event.target.matches('.js-delete')) return;  

  // Add class hide to clicked element
  event.target.parentNode.classList.add('hide-animation');
  
  // Set timeout before hide item
  setTimeout(function() {
      event.target.parentNode.classList.add('hide');
  }, 500) 
  
  // Store values of delete
  var data = {
    id: escapeHtml(event.target.getAttribute('data-id')),
    data_action: 'delete_category'
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