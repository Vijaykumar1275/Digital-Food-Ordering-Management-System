<!DOCTYPE html>
<html>
<head>
    <title>Search Orders by Date Range</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f9f9f9;
            color: #333;
        }
        h2 {
            color: #4CAF50;
            text-align: center;
        }
        form {
            margin-bottom: 20px;
            background-color: #e8f0fe;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            margin: 0 auto;
        }
        form label {
            margin-right: 10px;
            font-weight: bold;
        }
        form input[type="date"],
        form input[type="submit"] {
            margin-right: 10px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }
        form input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            cursor: pointer;
        }
        form input[type="submit"]:hover {
            background-color: #45a049;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            background-color: #fff;
            margin-top: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th {
            background-color: #4CAF50;
            color: white;
            padding: 10px;
            text-align: left;
        }
        td {
            padding: 10px;
            text-align: left;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>

<h2>Search Orders by Date Range</h2>

<form method="post">
    <label for="start_date">Start Date</label>
    <input type="date" id="start_date" name="start_date" required>
    <label for="end_date">End Date</label>
    <input type="date" id="end_date" name="end_date" required><br><br><br>
    <input type="submit" name="search_range" value="Search Range">
    
</form>

<?php
try {
    $con = new PDO("mysql:host=localhost;dbname=code_camp_bd_fos", 'root', '');
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if (isset($_POST["search_range"])) {
        $start_date = $_POST["start_date"];
        $end_date = $_POST["end_date"];

    
        $end_date = date('Y-m-d', strtotime($end_date . ' +1 day'));

        $sth = $con->prepare("SELECT * FROM users_orders WHERE date >= :start_date AND date < :end_date");
        $sth->bindParam(':start_date', $start_date, PDO::PARAM_STR);
        $sth->bindParam(':end_date', $end_date, PDO::PARAM_STR);

        $sth->setFetchMode(PDO::FETCH_OBJ);
        $sth->execute();


        if ($sth->rowCount() > 0) {
            echo '<br><br><br>
            <table>
                <tr>
                    <th>Title</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Status</th>
                    <th>Date</th>
                </tr>';

            while ($row = $sth->fetch()) {
                echo '<tr>
                    <td>' . htmlspecialchars($row->title) . '</td>
                    <td>' . htmlspecialchars($row->price) . '</td>
                    <td>' . htmlspecialchars($row->quantity) . '</td>
                    <td>' . htmlspecialchars($row->status) . '</td>
                    <td>' . htmlspecialchars($row->date) . '</td>
                </tr>';
            }

            echo '</table>';
        } else {
            echo "<p>No orders found within the specified date range.</p>";
        }
    }

    if (isset($_POST["search_date"])) {
        $date = $_POST["start_date"];

    
        $sth = $con->prepare("SELECT * FROM users_orders WHERE date = :date");
        $sth->bindParam(':date', $date, PDO::PARAM_STR);

        $sth->setFetchMode(PDO::FETCH_OBJ);
        $sth->execute();

  
        if ($sth->rowCount() > 0) {
            echo '<br><br><br>
            <table>
                <tr>
                    <th>Title</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Status</th>
                    <th>Date</th>

                </tr>';

            while ($row = $sth->fetch()) {
                echo '<tr>
                    <td>' . htmlspecialchars($row->title) . '</td>
                    <td>' . htmlspecialchars($row->price) . '</td>
                    <td>' . htmlspecialchars($row->quantity) . '</td>
                    <td>' . htmlspecialchars($row->status) . '</td>
                    <td>' . htmlspecialchars($row->date) . '</td>
                </tr>';
            }

            echo '</table>';
        } else {
            echo "<p>No orders found for the specified date.</p>";
        }
    }
} catch (PDOException $e) {
    echo "<p>Error: " . $e->getMessage() . "</p>";
}
?>

</body>
</html>