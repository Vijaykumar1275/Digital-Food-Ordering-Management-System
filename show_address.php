<?php
$servername = "localhost";
$username = "your_username";
$password = "your_password";
$dbname = "code_camp_bd_fos";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL query to fetch data
$sql = "SELECT id, name, phone, food_item, quantity, expiry_date, address FROM dona_tion";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Food Donations</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f3f4f6;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            padding: 20px;
        }

        .container {
            background: #ffffff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 900px;
        }

        h1 {
            margin-bottom: 20px;
            color: #333;
            text-align: center;
            font-size: 2.5em;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table, th, td {
            border: 1px solid #dee2e6;
        }

        th, td {
            padding: 12px 15px;
            text-align: left;
            font-size: 1em;
        }

        th {
            background-color: #6c757d;
            color: #fff;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #d1ecf1;
        }

        .no-data {
            text-align: center;
            font-style: italic;
            color: #6c757d;
        }

        .purchase-button, .address-button {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            font-size: 0.9em;
            transition: background-color 0.3s;
        }

        .purchase-button:hover, .address-button:hover {
            background-color: #0056b3;
        }

        .container::after {
            content: '';
            display: table;
            clear: both;
        }

        .header {
            background: linear-gradient(135deg, #6b73ff 0%, #000dff 100%);
            color: white;
            padding: 20px;
            text-align: center;
            border-radius: 10px 10px 0 0;
        }

        .footer {
            background: linear-gradient(135deg, #ff6b6b 0%, #ff0000 100%);
            color: white;
            padding: 10px;
            text-align: center;
            border-radius: 0 0 10px 10px;
            margin-top: 20px;
        }

        .footer a {
            color: #fff;
            text-decoration: none;
            font-weight: bold;
        }

        .footer a:hover {
            text-decoration: underline;
        }

        .food-item {
            padding: 5px 10px;
            border-radius: 5px;
            color: white;
            font-weight: bold;
        }

        .food-item.fruit { background-color: #ff6347; } /* Tomato */
        .food-item.vegetable { background-color: #32cd32; } /* LimeGreen */
        .food-item.grain { background-color: #ffd700; } /* Gold */
        .food-item.dairy { background-color: #1e90ff; } /* DodgerBlue */
        .food-item.meat { background-color: #8b4513; } /* SaddleBrown */
        .food-item.other { background-color: #6a5acd; } /* SlateBlue */

        .large-address {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: white;
            border: 1px solid #000;
            padding: 20px;
            z-index: 1000;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
            border-radius: 10px;
        }
    </style>
    <script>
        function showAddress(address) {
            const addressDiv = document.getElementById('largeAddress');
            addressDiv.innerHTML = address;
            addressDiv.style.display = 'block';
            setTimeout(() => {
                addressDiv.style.display = 'none';
            }, 10000);
        }
    </script>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Food Donations</h1>
        </div>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Phone</th>
                    <th>Food Item</th>
                    <th>Quantity</th>
                    <th>Expiry Date</th>
                    <th>Action</th>
                    <th>Address</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    // Output data of each row
                    while($row = $result->fetch_assoc()) {
                        // Determine the class for the food item based on the item type
                        $foodItemClass = 'other'; // Default class
                        if (stripos($row["food_item"], 'fruit') !== false) {
                            $foodItemClass = 'fruit';
                        } elseif (stripos($row["food_item"], 'vegetable') !== false) {
                            $foodItemClass = 'vegetable';
                        } elseif (stripos($row["food_item"], 'grain') !== false) {
                            $foodItemClass = 'grain';
                        } elseif (stripos($row["food_item"], 'dairy') !== false) {
                            $foodItemClass = 'dairy';
                        } elseif (stripos($row["food_item"], 'meat') !== false) {
                            $foodItemClass = 'meat';
                        }
                        echo "<tr>";
                        echo "<td>" . $row["id"] . "</td>";
                        echo "<td>" . $row["name"] . "</td>";
                        echo "<td>" . $row["phone"] . "</td>";
                        echo "<td><span class='food-item $foodItemClass'>" . $row["food_item"] . "</span></td>";
                        echo "<td>" . $row["quantity"] . "</td>";
                        echo "<td>" . $row["expiry_date"] . "</td>";
                        echo "<td><a href='http://localhost/food-of-vijaysonke/takeit.php' class='purchase-button'>Take It</a></td>";
                        echo "<td><button class='address-button' onclick='showAddress(\"" . $row["address"] . "\")'>Show Address</button></td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='8' class='no-data'>No donations found</td></tr>";
                }
                $conn->close();
                ?>
            </tbody>
        </table>
        <div id="largeAddress" class="large-address"></div>
        <div class="footer">
            <p>Thank you for your generosity! Visit our <a href="#">homepage</a> for more information.</p>
        </div>
    </div>
</body>
</html>