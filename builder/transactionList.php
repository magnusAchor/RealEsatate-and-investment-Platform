<?php
include 'connect.php';
if (isset($_SESSION['username']) && !empty($_SESSION['username'])) {
    $username = $_SESSION['username'];
} else {
    // Handle the case where the username is not set or empty
    header("Location: index ");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    
    <title>Transaction List</title>
    <style>
        h1.transclist {
            margin-inline-start: 300px;
        }

        #transact {
            border-collapse: collapse;
            margin-top: 20px;
            max-width: 100%; /* Set max width to 100% for responsiveness */
            font-size: 16px; /* Set the default font size */
        }

        #transact th, #transact td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }

        #transact th {
            background-color: #f2f2f2;
        }

        #transact tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        #transact tr:hover {
            background-color: #ddd;
        }

        #transact-body {
            background-color: #fff;
        }

        /* Add horizontal scrolling for small screens */
        .table-container {
            overflow-x: auto;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
          
            #transact {
    border-collapse: collapse;
    margin-top: 20px;
    max-width: 100%;
    font-size: 10px;
    font-weight: 900;
    font-family: -webkit-body;
        }
        .listedtransact.table-container {
    width: 330px;
    margin-inline-start: 700px;
}
.table-container {
    overflow-x: auto;
}
h1.transclist {
    margin-inline-start: 800px;
    font-size: larger;
    font-family: cursive;
    margin-top: 30px;
    /* text-decoration: wavy; */
}
}

@media (width: 280px)
.listedtransact.table-container {
    width: 250px;
    margin-inline-start: 740px;
}
    </style>
</head>
<body class="listedtransact">
    <h1 class="transclist">Transaction List</h1>
    <?php
        // Your PHP code here...
    ?>
    <div class="listedtransact table-container"> <!-- Wrap the table in a div with class "table-container" -->
        <?php
        $username = $_SESSION['username'];
        $bonding = "
            SELECT *
            FROM payment
            WHERE user1_name = '$username' AND statuess IS NOT NULL AND statuess != 'pending'
            ORDER BY payment_date DESC
        ";

        $hired = $conn->query($bonding);

        $rows = array();

        if ($hired->num_rows > 0) {
            echo '<table id="transact">';
            echo '<thead>';
            echo '<tr>';
            echo '<th>No.</th>';
            echo '<th>Payment date</th>';
            echo '<th>Description</th>';
            echo '<th>Releasedate</th>';
            echo '<th>TransactionReference</th>';
            echo '<th>Amount</th>';
            echo '<th>statuess</th>';
            echo '<th>milestonelabel</th>';
            echo '</tr>';
            echo '</thead>';
            echo '<tbody id="transact-body">';

            while ($hiredwrk = $hired->fetch_assoc()) {
                $rows[] = $hiredwrk;
            }

            foreach ($rows as $row) {
                $id = $row['id'];
                $amount = $row['amount'];
                $releasedate = $row['releasedate'];
                $description = $row['description'];
                $transactionReference = $row['transactionReference'];
                $statuess = $row['statuess'];
                $payment = $row['payment_date'];
                $label = $row['milestonelabel'];

                echo "<tr>";
                echo '<td><input type="radio" name="createSpace[]" value="' . $id . '"></td>'; // Checkbox in the new column
                echo "<td>$payment</td>";
                echo "<td>$description</td>";
                echo "<td>$releasedate</td>";
                echo "<td>$transactionReference</td>";
                echo "<td>$amount</td>";
                echo "<td>$statuess</td>";
                echo "<td>$label</td>";

                echo "</tr>";
            }

            echo '</tbody>';
            echo '</table>';
        } else {
            echo "<p>No histories found.</p>";
        }
        ?>
    </div>
</body>
</html>
