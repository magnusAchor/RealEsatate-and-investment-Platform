<!DOCTYPE html>
<html>
<head>
    <title>Login Form</title>
</head>
<body>
    <form>
        <!-- Country Select -->
        <select id="country" onchange="getStates()">
            <option value="">Select Country</option>
           
            <!-- Add more countries as needed -->
        </select>

        <!-- State Select -->
        <select id="state" onchange="getCities()">
            <option value="">Select State</option>
            <!-- Populate with states based on the selected country -->
        </select>

        <!-- City Select -->
        <select id="city">
            <option value="">Select City</option>
            <!-- Populate with cities based on the selected state -->
        </select>

        <button type="submit">Login</button>
    </form>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        // Populate the country select with predefined countries or fetch countries from the API
        var countries = [
            { name: "Nigeria", code: "NG" },
  { name: "South Africa", code: "ZA" },
  { name: "Kenya", code: "KE" },
  { name: "Ghana", code: "GH" },
  { name: "India", code: "IN" },
  { name: "China", code: "CN" },
  { name: "Japan", code: "JP" },
  { name: "South Korea", code: "KR" },
  { name: "Germany", code: "DE" },
  { name: "France", code: "FR" },
  { name: "United Kingdom", code: "GB" },
  { name: "Spain", code: "ES" },
  { name: "United States", code: "US" },
  { name: "Canada", code: "CA" },
  { name: "Mexico", code: "MX" }
            // Add more countries as needed
        ];

        $(document).ready(function() {
            populateSelect($("#country"), countries);
        });

        function populateSelect(selectElement, data) {
            selectElement.empty();
            selectElement.append($('<option>', {
                value: '',
                text: 'Select ' + selectElement.attr('id')
            }));
            $.each(data, function(index, item) {
                selectElement.append($('<option>', {
                    value: item.code,
                    text: item.name
                }));
            });
        }

        function getStates() {
            var selectedCountry = $("#country").val();
            // Use the Nominatim API to fetch states for the selected country
            $.get("https://nominatim.openstreetmap.org/search?country=" + selectedCountry + "&format=json", function(data) {
                // Extract the states from the API response
                var states = data.map(function(item) {
                    return { name: item.display_name.split(", ")[-2], code: item.address.state };
                });

                // Populate the state select with the fetched states
                populateSelect($("#state"), states);
            });
        }

        function getCities() {
            var selectedState = $("#state").val();
            // Use the Nominatim API to fetch cities for the selected state
            $.get("https://nominatim.openstreetmap.org/search?state=" + selectedState + "&format=json", function(data) {
                // Extract the cities from the API response
                var cities = data.map(function(item) {
                    return { name: item.display_name.split(", ")[0], code: item.address.city };
                });

                // Populate the city select with the fetched cities
                populateSelect($("#city"), cities);
            });
        }
    </script>
</body>
</html>
