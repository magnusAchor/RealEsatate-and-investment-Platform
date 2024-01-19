<style>
          
        body {
             background-color: #f1c40f;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
           /* display: flex;*/
            justify-content: center;
            align-items: center;
            min-height: 80vh;
        }

        .container {
            display: flex;
            align-items: stretch;
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
        }

        .writtings {
            flex: 1;
            padding: 20px;
            background-color: #f0f0f0;
            border-radius: 10px 0 0 10px;
        }

        .writtings h2 {
            color: #333333;
            margin-bottom: 10px;
        }

        .writtings p {
            color: #666666;
            margin-bottom: 10px;
        }

        .login_form {
            flex: 1;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 0 10px 10px 0;
        }

        .login_form h3 {
            text-align: center;
            color: #333333;
            margin-bottom: 20px;
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 8px;
        }

        input[type="text"],
        input[type="password"] {
            width: 90%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-bottom: 15px;
        }

        input[type="submit"] {
            width: 85%;
            padding: 12px;
            background-color: #4CAF50;
            color: #ffffff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-left: 20px;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        .register-link {
            text-align: center;
            margin-top: 10px;
        }

        .register-link a {
            color: #333333;
            text-decoration: none;
        }
        h1 {
    margin-inline-start: 500px;
    color: olive;
}


        @media screen and (max-width: 768px) {
            h1 {
    margin-inline-start: 50px;
}
            .container {
                flex-direction: column;
            }

            
            .login_form {
                border-radius: 10px;
            }

            .login_form {
                height: 80vh;
                margin-top: 0px;
            }
            .writtings {
            display: none;
        }
       
body {
    background-color: #f4f4f4;
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    /* display: flex; */
    justify-content: center;
    align-items: center;
    min-height: 50vh;
   /* width: fit-content;*/
    overflow-x: hidden;
}
        fieldset#post-container {
           

    margin-inline-start: 1px;
}
h4 {
    margin-inline-start: 1px;
}
        }

        
        
        fieldset#post-container {

    
    margin-inline-start: 1px;
}
header {
    background-color: wheat;
}

#footer {
    background-color: olive; /* Set your desired background color */
    color: #fff; /* Set your desired text color */
    padding: 20px 0; /* Adjust the padding as needed */
}

.footer {
    display: flex;
    justify-content: center;
    width: 100%;
}

.ftt_container {
    width: 100%;
    max-width: 1200px; /* Adjust the maximum width as needed */
    padding: 0 15px;
}

.row {
    display: flex;
   /* flex-wrap: wrap;*/
  /*  justify-content: space-between;*/
}

.col-lg-4,
.col-md-4,
.col-xs-12 {
    flex: 0 0 calc(33.33% - 15px); /* Adjust the column width and spacing as needed */
    max-width: calc(33.33% - 15px); /* Adjust the column width and spacing as needed */
   /* padding: 0 15px; Adjust the column spacing as needed */
}

/* Add your specific styling for widgets, links, and other content within each column */
a {
    color: white;
}
h4 {
    
    display: flex;
    justify-content: center;
}
@media (max-width: 768px) {
    .ftt_container {
    width: -webkit-fill-available;
    max-width: 1100px;
    padding: 0 15px;
    font-size: x-small;
    margin-inline-end: 30px;
}
    
}

</style>
  <script>
        //history.replaceState({}, null, '/');
    
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


        </script>
