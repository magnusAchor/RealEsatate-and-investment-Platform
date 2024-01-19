<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  $(document).ready(function() {
    $('#myForm').submit(function(e) {
      e.preventDefault();
      
      // Get the form data
      var formData = $(this).serialize();
      
      // Send the form data to PHP scripts using AJAX
      $.ajax({
        url: 'submit_form.php',
        type: 'post',
        data: formData,
        success: function(response) {
          // Handle the response from the first PHP script
          console.log(response);
        }
      });
      
      $.ajax({
        url: 'another_script.php',
        type: 'post',
        data: formData,
        success: function(response) {
          // Handle the response from the second PHP script
          console.log(response);
        }
      });
    });
  });
</script>
