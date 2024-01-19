<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Contract Form</title>
    <style>
        
        label {
            font-weight: bold;
        }
        select,  textarea {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        button.milestoneButton,
button#addMilestone,
button#fixedPaymentButton {
    padding: 10px 20px;
    background-color: #3498db;
    color: #fff;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    transition: background-color 0.3s;
}

button.milestoneButton:hover,
button#addMilestone:hover,
button#fixedPaymentButton:hover {
    background-color: black;
}

        #milestonePaymentSection {
            display: none;
        }
        .milestone {
            margin-bottom: 20px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .milestone label {
            font-weight: normal;
        }
        
    </style>
</head>
<body>
    <h1>Payment Contract Form</h1>
    <form id="paymentForm" method="post" action="collect">
        <!-- ... your form content ... -->
        <label for="paymentType">Select Payment Type:</label>
    <select id="paymentType" name="paymentType">
        <option value="fixed">Fixed Payment</option>
        <option value="milestone">Milestone Payment</option>
    </select>
    <br><br>
    <textarea name="paymentDescription" id="paymentDescription" placeholder="why are you making this payment?" required></textarea><br><br>

    <label for="worker">Select Worker:</label>
        <div id="worker" name="worker">
     
       <?php
       // Retrieve and display employed workers in the popup for workspace
       $bonding = "SELECT * FROM relationship WHERE buyers_id = ?";
       $stmt = $conn->prepare($bonding);
       $stmt->bind_param("i", $userID);
       $stmt->execute();
       $hired = $stmt->get_result();
   
       if ($hired->num_rows > 0) {
           while ($hiredwrk = $hired->fetch_assoc()) {
               $fullname = htmlspecialchars($hiredwrk['full_name'], ENT_QUOTES, 'UTF-8');
               $workids = intval($hiredwrk['worker_id']);
   
               echo '<fieldset>';
               echo '<label>';
               echo '<input type="checkbox" name="createSpace[]" value="' . $workids . '|' . $fullname . '"> ' . $fullname . ' (' . $workids . ')';

               //echo '<input type="hidden" name="workersfullname[]" value="' . $fullname . '"> ' ;
               echo '</label>';
               echo '</fieldset><br>';
           }
       } else {
           echo "No worker IDs found.";
       }
      ?>
        
</div> 
        <br>

    <div id="fixedPaymentSection">
        <label for="fixedAmount">Fixed Amount:</label>
        <input type="number" id="fixedAmount" name="fixedAmount">
        <br>
        <label for="releaseDate">Release Date:</label>
        <input type="date" id="releaseDate" name="releaseDate">
        <br>
        
        <button type="submit" id="fixedPaymentButton">Make Fixed Payment</button>
    </div>

    <div id="milestonePaymentSection">
        <div id="milestones">
            <div class="milestone">
                <label for="milestoneAmount">Milestone Amount:</label>
                <input type="number" class="milestoneAmount" name="milestoneAmount[]">
                <br>
                <label for="milestoneDate">Release Date:</label>
                <input type="date" class="milestoneDate" name="milestoneDate[]">
                <br>
                <button type="submit" name="milestoneButton" class="milestoneButton">Make Milestone Payment</button>
            </div>
        </div>
        <button type="button" id="addMilestone">Add Milestone</button>
    </div>
</form>

<script>
    const paymentType = document.getElementById('paymentType');
    const fixedPaymentSection = document.getElementById('fixedPaymentSection');
    const milestonePaymentSection = document.getElementById('milestonePaymentSection');
    const fixedPaymentButton = document.getElementById('fixedPaymentButton');
    const milestonesContainer = document.getElementById('milestones');
    const addMilestoneButton = document.getElementById('addMilestone');

    paymentType.addEventListener('change', function() {
        if (paymentType.value === 'fixed') {
            fixedPaymentSection.style.display = 'block';
            milestonePaymentSection.style.display = 'none';
        } else if (paymentType.value === 'milestone') {
            fixedPaymentSection.style.display = 'none';
            milestonePaymentSection.style.display = 'block';
        }
    });

    ;

    function createMilestone() {
        const milestoneDiv = document.createElement('div');
        milestoneDiv.className = 'milestone';
        
        const milestoneAmountInput = document.createElement('input');
        milestoneAmountInput.type = 'number';
        milestoneAmountInput.className = 'milestoneAmount';
        milestoneAmountInput.name = 'milestoneAmount[]';
        
        const milestoneDateInput = document.createElement('input');
        milestoneDateInput.type = 'date';
        milestoneDateInput.className = 'milestoneDate';
        milestoneDateInput.name = 'milestoneDate[]';
        
        const milestoneButton = document.createElement('button');
        milestoneButton.type = 'submit';
        milestoneButton.className = 'milestoneButton';
        milestoneButton.textContent = 'Make Milestone Payment';
       ;

        milestoneDiv.appendChild(document.createElement('br'));
        milestoneDiv.appendChild(document.createTextNode('Milestone Amount: '));
        milestoneDiv.appendChild(milestoneAmountInput);
        milestoneDiv.appendChild(document.createElement('br'));
        milestoneDiv.appendChild(document.createTextNode('Release Date: '));
        milestoneDiv.appendChild(milestoneDateInput);
        milestoneDiv.appendChild(document.createElement('br'));
        milestoneDiv.appendChild(milestoneButton);

        return milestoneDiv;
    }

    addMilestoneButton.addEventListener('click', function() {
        const milestoneDiv = createMilestone();
        milestonesContainer.appendChild(milestoneDiv);
    });


</script>
    
</body>
</html>



