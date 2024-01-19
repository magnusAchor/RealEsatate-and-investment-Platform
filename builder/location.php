<?php
include 'connect.php';
if (isset($_SESSION['username']) && !empty($_SESSION['username'])) {
    $username = $_SESSION['username'];

   

   
} else {
    // Handle the case where the username is not set or empty
    echo '<script>alert("User not logged in");</script>';
    header("Location: index " );
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Places Autocomplete Text Box</title>
    <style>
        /* Add your custom CSS styles here */
    </style>
</head>
<body>
    <h1>Places Autocomplete Text Box</h1>
    <form>
        <!-- Location Search Input -->
        <input type="text" id="location-input" placeholder="Enter a location">

        <!-- Suggestions Dropdown -->
        <div id="suggestions"></div>

        <button type="submit">Submit</button>
    </form>

    <script>
        // Function to fetch location suggestions from Nominatim API
        function fetchSuggestions(query) {
            const apiUrl = `https://nominatim.openstreetmap.org/search?q=${query}&format=json`;

            fetch(apiUrl)
                .then(response => response.json())
                .then(data => {
                    const suggestionsContainer = document.getElementById('suggestions');
                    suggestionsContainer.innerHTML = '';

                    data.forEach(place => {
                        const suggestionItem = document.createElement('div');
                        suggestionItem.classList.add('suggestion-item');
                        suggestionItem.innerText = place.display_name;
                        suggestionItem.addEventListener('click', () => {
                            document.getElementById('location-input').value = place.display_name;
                            suggestionsContainer.innerHTML = '';
                        });

                        suggestionsContainer.appendChild(suggestionItem);
                    });
                })
                .catch(error => {
                    console.error('Error fetching suggestions:', error);
                });
        }

        // Function to handle input changes and fetch suggestions
        function handleInput() {
            const input = document.getElementById('location-input');
            const query = input.value.trim();

            if (query.length >= 3) {
                fetchSuggestions(query);
            } else {
                document.getElementById('suggestions').innerHTML = '';
            }
        }

        // Event listener for input changes
        document.getElementById('location-input').addEventListener('input', handleInput);

        // Prevent form submission for demonstration purposes
        document.querySelector('form').addEventListener('submit', (event) => {
            event.preventDefault();
            alert('Form submission is disabled for this example.');
        });
    </script>
</body>
</html>
