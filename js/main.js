// Escape input
function escapeHtml(unsafe) {
    return unsafe
         .replace(/&/g, "&amp;")
         .replace(/</g, "&lt;")
         .replace(/>/g, "&gt;")
         .replace(/"/g, "&quot;")
         .replace(/'/g, "&#039;");
}

// Animate and complete items, also send dato via AJAX to PHP Processor
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
        cat: escapeHtml(event.target.getAttribute('data-cat'))
    };

    // Ajax POST to send checkbox value to PHP processor
    fetch("functions.php", {
      method: "POST",
      mode: "same-origin",
      credentials: "same-origin",
      headers: {
        "Content-Type": "application/json"
      },      
        // body: event.target.getAttribute('data-id')
        body: JSON.stringify(data)
    }).then(res => {
      console.log("Request complete! response:", res);
    });    

}, false);


// Collect form data and display in list
// @TODO: https://gomakethings.com/getting-an-array-of-form-data-with-vanilla-js/
// @TODO: Collect data from seperated forms in on function

var form1 = document.getElementById('form-1');
var form2 = document.getElementById('form-2');
var form3 = document.getElementById('form-3');
var form4 = document.getElementById('form-4');

form1.addEventListener('submit', addItem);
form2.addEventListener('submit', addItem2);
form3.addEventListener('submit', addItem3);
form4.addEventListener('submit', addItem4);

function addItem() {
    // Collect value from input
    var item = document.getElementById("item").value;

    // Create a new element
    var newNode = document.createElement('p');
    newNode.innerHTML += '<input type="checkbox" id="' + item + '" />';
    newNode.innerHTML += '<label class="checkboxLabel" for="' + item + '">' + item + '</label>';

    // Get the parent node
    var parentNode = document.querySelector('.list');

    // Insert the new node before the reference node
    parentNode.append(newNode);

    // Reset input
    // form1.reset();    
}


function addItem2() {
    // Collect value from input
    var item = document.getElementById("item2").value;
    
    // Reset input
    form2.reset(); 

    // Create a new element
    var newNode = document.createElement('p');
    newNode.innerHTML += '<input type="checkbox" id="' + item + '" />';
    newNode.innerHTML += '<label class="checkboxLabel" for="' + item + '">' + item + '</label>';

    // Get the parent node
    var parentNode = document.querySelector('.list2');

    // Insert the new node before the reference node
    parentNode.append(newNode);
}


function addItem3() {
    // Collect value from input
    var item = document.getElementById("item3").value;
    
    // Reset input
    form3.reset(); 

    // Create a new element
    var newNode = document.createElement('p');
    newNode.innerHTML += '<input type="checkbox" id="' + item + '" />';
    newNode.innerHTML += '<label class="checkboxLabel" for="' + item + '">' + item + '</label>';

    // Get the parent node
    var parentNode = document.querySelector('.list3');

    // Insert the new node before the reference node
    parentNode.append(newNode);
}


function addItem4() {
    // Collect value from input
    var item = document.getElementById("item4").value;
    
    // Reset input
    form4.reset(); 

    // Create a new element
    var newNode = document.createElement('p');
    newNode.innerHTML += '<input type="checkbox" id="' + item + '" />';
    newNode.innerHTML += '<label class="checkboxLabel" for="' + item + '">' + item + '</label>';

    // Get the parent node
    var parentNode = document.querySelector('.list4');

    // Insert the new node before the reference node
    parentNode.append(newNode);
}

// Edit List Titels

var edit = document.getElementById('js-edit');
// var name = document.getElementById('js-list-title').innerHTML;

// console.log(name);

edit.addEventListener('click', function(event) {
    var newName = prompt('What would you like to be the name category name?');
    document.getElementById('js-list-title').innerHTML = newName;
}, false);