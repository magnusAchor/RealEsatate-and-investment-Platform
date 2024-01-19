<style>
  
* {
  box-sizing: border-box;
}
.searchengine {
    margin-inline-start: 275px;
}
.popup {
  display: none;
  position: fixed;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  padding: 20px;
  background-color: #f1f1f1;
  border: 1px solid #ccc;
  border-radius: 5px;
  z-index: 9999; 
}

.popup.active {
  display: block;
}








input#search-input {
 
  border: outset;
}

/* post test display  */
.center-container {
    display: flex;
    justify-content: center;
    align-items: center;
  }

  
  .post-button {
    background-color: #4CAF50;
    color: white;
    border: none;
    padding: 5px 10px;
    border-radius: 3px;
    cursor: pointer;
  }

  .media-container {
    display: flex;
    justify-content: center;
  }

  .outer-fieldset {
    background-color: #f1f1f1;
    padding: 10px;
    border-radius: 5px;
    margin-bottom: 10px;
  }

  .inner-fieldset {
    background-color: white;
    padding: 10px;
    border-radius: 5px;
    margin-bottom: 10px;
  }



  

  .no-posts-message {
    text-align: center;
    font-weight: bold;
    color: #888;
    margin: 10px 0;
  }
  
      /* Reset some default styles */
      body, h1, h2, p, ul, li {
          margin: 0;
          padding: 0;
      }

      /* Navigation styles */
      nav {
          background-color: #333;
          color: #fff;
          font-family: Arial, sans-serif;
      }

      ul {
          list-style: none;
          display: flex;
          justify-content: center;
          align-items: center;
          padding: 10px 0;
      }

      li {
          margin: 0 20px;
      }

      a {
          text-decoration: none;
          color: #fff;
          transition: color 0.3s;
      }

      a:hover {
          color: #ff6600;
      }

      body {
 background-color: #f1c40f;
}


ul {
  background-color: darkgreen;
  color: #fff;
  padding: 20px;
  position: fixed;
  top:0;
  width: 100%;
  margin-top: 95px;
  z-index: 2;
}
.header {
  background-color: #000;
  color: #fff;
  padding: 20px;
  position: fixed;
  top: 0;
  width: 100%;
  z-index: 2;
}

input#search-input {
    margin-left: 1030px;
}
/* Add this CSS to ensure equal width for small screens */
html, body {
  max-width: 100%;
  overflow-x: hidden;
}
footer {
    background-color: black;
    color: white;
    min-width: 2000px;
    min-height: 100px;
}
p.footer-cont {
    margin-inline-start: 1000px;
    margin-top: 40px;
}
/* Media query for smaller screens */
@media (max-width: 900px) {
div#nav {
  margin-right: auto;
  font-size: 7px;
  font-weight: 900;
}
  body {
      display: flex;
      flex-direction: column;
      align-items: center;
  }
  
  .tab-container {
      width: 100%;
      padding: 10px;
  }

  .tab {
      max-width: 100%;
  }

  .search-form {
      max-width: 100%;
  }

  .search-results {
      max-width: 100%;
  }

  .popup {
      max-width: 100%;
  }

  .dialog {
      max-width: 100%;
  }
  ul {
          list-style: none;
          display: flex;
          justify-content: flex-start;
          align-items: right;
          padding: 10px 0;
      }



  li {

    font-size: 15px;
    margin: 0 11px;
    
}
div#fund-escrow {
    width: 600px;
    margin-inline-start: 650px;
}

 p#charCount {
    color: blue;
    font-size: xx-small;
    bottom: 20px;
    right: 5px;
}
 
 fieldset#hired {
    margin-inline-start: 850px;
}
button.buyersid {
    margin-inline-start: 1100px;
    border: 0px solid;
    margin-bottom: 5px;
}
h2.Empwrk {
    margin-inline-start: 1000px;
}
}
.hwks {
    background-color: #c3a324;
    border: 0px solid;
    margin-inline-start: 100px;
    cursor: pointer;

}
img.profile-picture {
    border: 1px solid;
}
p.wrkrname {
    margin-left: 80px;
}
form#myForm {
    display: flex;
    margin-top: 20px;
}
fieldset#hired {
    min-height: 55px;
}
img.profile-picture {
    margin-inline-start: 20px;
}

button.buyersid {
    /* margin-inline-start: 1100px; */
    border: 0px solid;
    margin-bottom: 5px;
}

@media (width: 280px) {
  li {

    font-size: 8px;
    margin: 0 5px;
}
div#fund-escrow {
    /* width: fit-content; */
    margin-inline-start: 700px;
    max-width: 500px;
}
}

@media (width: 375px) {
  li {

    font-size: 10px;
    margin: 0 10px;
}

}
@media (width: 414px) {
  li {

    font-size: 12px;
    margin: 0 8px;
}

}
@media (width: 390px) {
  li {

    font-size: 10px;
    margin: 0 10px;
}

}
@media (width: 393px) {
  li {

    font-size: 10px;
    margin: 0 10px;
}

}
@media (width: 360px) {
  li {

    font-size: 10px;
    margin: 0 9px;
}

}
@media (width: 412px) {
  li {

    font-size: 10px;
    margin: 0 8px;
}

}

fieldset#fund-escrow {
    margin-left: 300px;
}
@media (width: 320px) {
  fieldset#fund-escrow {
    margin-left: 250px;
    max-width: 200px;
}
}
div#pay-milestone {
    margin-left: 300px;
}
div#pay-milestone {
    margin-left: 250px;
}
@media (width: 320px) {
  div#pay-milestone {
    margin-left: 250px;
    max-width: 200px;
}}

@media(width:320px){
  fieldset#hired {
    margin-left: 250px;
    max-width: 200px;
}
}

@media(width:320px){
  div#Employee {
    margin-left: 250px;
}}

.house-icon {
      font-size: 24px;
      border: outset;
    }
    div#workspace {
    display: table-caption;
}
button#chimney {
    margin-left: 80px;
}
@media (max-width: 910px){
button#chimney {
    margin-left: 110px;
    display: block;
}
}
.tab {
      display: none; /* Hide all tabs by default */
    }

    .tab.active {
      display: block; /* Show the active tab */
    }
    
    div#popup {
    overflow-y: auto; 
    max-height: 50vh;
}
fieldset.post-container {

    margin-inline-start: 250px;
  
}
.
 .searchengine {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 10px;
    margin-inline-start: 275px;
    
}




.searchengine input[type="text"],
.searchengine input[type="number"] {
    flex: 1; /* Allow form elements to grow and fill available space */
    max-width: 200px; /* Set a maximum width to prevent them from growing too much */
}

/* Media query for smaller screens */
@media (max-width: 900px) {
    .searchengine input[type="text"],
    .searchengine input[type="number"] {
        flex: auto; /* Reset flex property for better responsiveness */
        max-width: 50px; /* Remove max-width restriction */
    }
    .searchengine {
    
    margin-inline-start: 490px;
    
}

}


</style>

<script>
    //  history.replaceState({}, null, '/77gytuyh-mjhb');
     // Function to open a specific tab
function openTab(tabId) {
  // Hide all tabs
  const tabs = document.querySelectorAll('.tab');
  tabs.forEach(tab => tab.classList.remove('active'));

  // Show the selected tab
  const tab = document.getElementById(tabId);
  if (tab) tab.classList.add('active');
}

    
        
     // Function to show the .postted element
   function showPostted() {
      const posttedElement = document.querySelector('.postted');
      if (posttedElement) {
         posttedElement.style.display = 'block';
      }
   }

   // Event listener to hide the .postted element on page load
   window.addEventListener('load', function () {
      // Hide the .postted element initially
      const posttedElement = document.querySelector('.postted');
      if (posttedElement) {
         posttedElement.style.display = 'none';
      }

      // Call the showPostted function after a slight delay (adjust this delay as needed)
      setTimeout(showPostted, 1000); // 1000 milliseconds (1 second) delay
   });
   
   function showPopup() {
  var popup = document.getElementById("popup");
  popup.classList.add("active");
}

function hidePopup() {
  var popup = document.getElementById("popup");
  popup.classList.remove("active");
}


function openNewPagess(){
        window.location.assign("contractor")
    }




    function openNewPages(){
        window.location.assign("architect")
    }
    function workspace(){
        window.location.assign("worklist")
    }
   

    // Function to open the dialog box
    function openDialog() {
      const dialog = document.getElementById('dialog-box');
      dialog.classList.add('active');
    }

    // Function to proceed to the next page after dialog box confirmation
    function proceedToNextPage() {
      // Perform any necessary actions before proceeding
      // ...

      // Redirect to the next page
      window.location.href = 'next-page.html';
    }

    function searchSelectProperty() {
    const title = document.getElementById("select-property-search-title").value.toLowerCase();
    const location = document.getElementById("select-property-search-location").value.toLowerCase();
    const priceRange = document.getElementById("select-property-search-price").value.toLowerCase();
    const propertyType = document.getElementById("select-property-search-type").value.toLowerCase();

    const allPosts = document.getElementsByClassName("post"); // Assuming each post has the "post" class

    for (let i = 0; i < allPosts.length; i++) {
      const post = allPosts[i];
      const postTitle = post.getElementsByClassName("post-title")[0].innerText.toLowerCase();
      const postLocation = post.getElementsByClassName("post-location")[0].innerText.toLowerCase();
      const postPrice = post.getElementsByClassName("post-price")[0].innerText.toLowerCase();
      const postType = post.getElementsByClassName("post-type")[0].innerText.toLowerCase();

      const titleMatch = postTitle.includes(title);
      const locationMatch = postLocation.includes(location);
      const priceMatch = postPrice.includes(priceRange);
      const typeMatch = propertyType === "" || postType === propertyType;

      if (titleMatch && locationMatch && priceMatch && typeMatch) {
        post.style.display = "block"; // Show the post if it matches the search criteria
      } else {
        post.style.display = "none"; // Hide the post if it doesn't match the search criteria
      }
    }
  }

    // Function to search for properties in the Fund Escrow tab
    function searchFundEscrow() {
      // Code to search for properties in the Fund Escrow tab
      // ...
    }

    // Function to search for properties in the Pay First Milestone tab
    function searchPayMilestone() {
      // Code to search for properties in the Pay First Milestone tab
      // ...
    }

    // Function to search for properties in the Hired Workers tab
    function searchHiredWorkers() {
      // Code to search for properties in the Hired Workers tab
      // ...
    }

    // Function to search for properties in the Employee tab
    function searchEmployee() {
      // Code to search for properties in the Employee tab
      // ...
    }

    // Function to search for properties in the Workspace tab
    function searchWorkspace() {
      // Code to search for properties in the Workspace tab
      // ...
    }
    

  


    //history.replaceState({}, null, '/77gytuyh-mjhb');
    
    
</script>
<script>
        // Function to submit the form when the fieldset is clicked
        function submitForm() {
            var form = document.getElementById('myForm'); // Replace 'myForm' with your form's ID
            form.submit();
        }

        // Add an event listener to the fieldset
        var fieldset = document.getElementById('hired'); // Replace 'hired' with your fieldset's ID
        fieldset.addEventListener('click', submitForm);
        
        
    // Get all elements with the class "chat-fieldset"
    var fieldsets = document.getElementsByClassName('chat-fieldset');

    // Function to submit the form when a fieldset is clicked
    function submitForm(event) {
        // Find the form element within the clicked fieldset
        var form = event.currentTarget.querySelector('form');
        
        // Submit the form
        form.submit();
    }

    // Add a click event listener to each fieldset
    for (var i = 0; i < fieldsets.length; i++) {
        fieldsets[i].addEventListener('click', submitForm);
    }

</script>
