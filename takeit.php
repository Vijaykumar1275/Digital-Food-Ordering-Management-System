<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Take It From</title>
    <style>
        /* General styles */
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background: linear-gradient(135deg, #ffcc33, #ff66ff, #33ccff, #66ff66);
            background-size: 400% 400%;
            animation: gradientAnimation 15s ease infinite;
            color: white;
        }

        @keyframes gradientAnimation {
            0% {background-position: 0% 50%;}
            50% {background-position: 100% 50%;}
            100% {background-position: 0% 50%;}
        }

        /* Header styles */
        header {
            text-align: center;
            margin-bottom: 20px;
        }

        header h1 {
            font-size: 4em;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
        }

        /* Main section styles */
        main {
            background: rgba(0, 0, 0, 0.3);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
        }

        .address {
            text-align: center;
        }

        .address h2 {
            font-size: 2em;
            margin-bottom: 10px;
        }

        .address p {
            font-size: 1.2em;
            margin: 5px 0;
        }
    </style>
</head>
<body>
    <header>
        <h1>Take It From</h1>
    </header>
    <main>
        <section class="address">
            <h2>Address</h2>
            <p>PG Road</p>
            <p>near REVA UNIVERSITY BANGLORE</p>
            <p>Email: vijaysonke@9901gmail.com</p>
            <p>Phone: 9353796680</p>
        </section>
    </main>
</body>
</html>
