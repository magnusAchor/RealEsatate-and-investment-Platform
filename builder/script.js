function handleButtonClick(postID) {

      
  // Perform actions or logic when the button is clicked
  window.location.assign('employersview.php?id='+ postID);
 
}




function showPopup() {
  var popup = document.getElementById("popup");
  popup.classList.add("active");
}

function hidePopup() {
  var popup = document.getElementById("popup");
  popup.classList.remove("active");
}




    function openNewPages(){
        window.location.assign("architect.php")
    }
    function workspace(){
        window.location.assign("worklist.php")
    }
    // Function to open a specific tab
    function openTab(tabId) {
      // Hide all tabs
      const tabs = document.getElementsByClassName('tab');
      for (let i = 0; i < tabs.length; i++) {
        tabs[i].classList.remove('active');
      }

      // Show the selected tab
      const tab = document.getElementById(tabId);
      tab.classList.add('active');
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

    // Function to search for properties in the Select Property tab
    function searchSelectProperty() {
      const titleInput = document.getElementById('select-property-search-title');
      const locationInput = document.getElementById('select-property-search-location');
      const propertyTypeInput = document.getElementById('select-property-search-property-type');
      const searchResults = document.getElementById('select-property-search-results');

      // Clear previous search results
      searchResults.innerHTML = '';

      // Perform search based on title, location, and property type inputs
      // ...
      // Example code to display search results (replace with your actual logic)
      const title = titleInput.value;
      const location = locationInput.value;
      const propertyType = propertyTypeInput.value;

      // Dummy data for demonstration purposes
      const results = [
        {
          title: 'Property 1',
          description: 'This is the first property.',
          details: 'Location: City A',
          thumbnail: 'property1.jpg',
          price: '$100,000',
          size: '1000 sqft',
        },
        {
          title: 'Property 2',
          description: 'This is the second property.',
          details: 'Location: City B',
          thumbnail: 'property2.jpg',
          price: '$150,000',
          size: '1500 sqft',
        },
      ];

      // Display search results
      results.forEach((result) => {
        const resultElement = document.createElement('div');
        resultElement.classList.add('result');

        const thumbnailElement = document.createElement('img');
        thumbnailElement.src = result.thumbnail;
        thumbnailElement.alt = result.title;

        const titleElement = document.createElement('div');
        titleElement.classList.add('title');
        titleElement.textContent = result.title;

        const descriptionElement = document.createElement('div');
        descriptionElement.classList.add('description');
        descriptionElement.textContent = result.description;

        const priceElement = document.createElement('div');
        priceElement.classList.add('price');
        priceElement.textContent = 'Price: ' + result.price;

        const sizeElement = document.createElement('div');
        sizeElement.classList.add('size');
        sizeElement.textContent = 'Size: ' + result.size;

        resultElement.appendChild(thumbnailElement);
        resultElement.appendChild(titleElement);
        resultElement.appendChild(descriptionElement);
        resultElement.appendChild(priceElement);
        resultElement.appendChild(sizeElement);

        searchResults.appendChild(resultElement);
      });
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
 