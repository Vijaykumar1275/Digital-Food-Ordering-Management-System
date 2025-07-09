<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Food Donation Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 500px;
            text-align: center;
            max-width: 90%;
        }

        h1 {
            margin-bottom: 30px;
            color: #007bff;
        }

        .form-group {
            margin-bottom: 20px;
            text-align: left;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            color: #555;
            font-weight: bold;
        }

        .form-group input {
            width: 100%;
            padding: 10px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        button {
            background-color: #007bff;
            color: #ffffff;
            border: none;
            padding: 12px 20px;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
            transition: background-color 0.3s ease;
            font-size: 16px;
            margin-top: 20px;
        }

        button:hover {
            background-color: #0056b3;
        }

        p.success {
            color: #28a745;
            font-weight: bold;
            margin-top: 20px;
        }

        p.error {
            color: #dc3545;
            font-weight: bold;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Food Donation</h1>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
            <div class="form-group">
                <label for="name">Donor Name:</label>
                <input type="text" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="phone">Phone:</label>
                <input type="tel" id="phone" name="phone" required>
            </div>
            <div class="form-group">
                <label for="food_item">Food Item:</label>
                <input type="text" id="food_item" name="food_item" required>
            </div>
            <div class="form-group">
                <label for="quantity">Quantity:</label>
                <input type="number" id="quantity" name="quantity" required>
            </div>
            <div class="form-group">
                <label for="expiry_date">Expiry Date:</label>
                <input type="date" id="expiry_date" name="expiry_date" required>
            </div>
            <div class="form-group">
                <label for="address">Receiver's Address:</label>
                <input type="text" id="address" name="address" required>
            </div>
          
            <button type="submit" name="submit">Donate</button>
        </form>
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Database connection parameters
            $servername = "localhost";
            $username = "your_username";
            $password = "your_password";
            $dbname = "code_camp_bd_fos";

            // Create connection
            $conn = new mysqli($servername, $username, $password, $dbname);

            // Check connection
            if ($conn->connect_error) {
                die("<p class='error'>Connection failed: " . $conn->connect_error . "</p>");
            }

            // Prepare and bind
            $stmt = $conn->prepare("INSERT INTO dona_tion (name, phone, food_item, quantity, expiry_date, address) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("sssdss", $name, $phone, $food_item, $quantity, $expiry_date, $address);

            // Set parameters and execute
            $name = htmlspecialchars($_POST['name']);
            $phone = htmlspecialchars($_POST['phone']);
            $food_item = htmlspecialchars($_POST['food_item']);
            $quantity = intval($_POST['quantity']);
            $expiry_date = $_POST['expiry_date'];
            $address = htmlspecialchars($_POST['address']);

            if ($stmt->execute()) {
                echo "<p class='success'>Thank you for your donation!</p>";
            } else {
                echo "<p class='error'>Error: " . $stmt->error . "</p>";
            }

            // Close connections
            $stmt->close();
            $conn->close();
        }
        ?>
    </div>
</body>
</html>
