<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Success</title>
    <style>
        * {
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background: linear-gradient(135deg, #00c9ff, #92fe9d);
            margin: 0;
            padding: 0;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            animation: fadeIn 1s ease-in-out;
        }

        .box {
            background: #fff;
            padding: 40px;
            border-radius: 16px;
            text-align: center;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            position: relative;
        }

        .checkmark {
            width: 100px;
            height: 100px;
            margin: 0 auto 20px;
            border-radius: 50%;
            background: #4BB543;
            position: relative;
            animation: pop 0.5s ease forwards;
        }

        .checkmark::after {
            content: '';
            position: absolute;
            top: 28px;
            left: 26px;
            width: 25px;
            height: 50px;
            border-right: 5px solid white;
            border-bottom: 5px solid white;
            transform: rotate(45deg);
        }

        h2 {
            color: #333;
            font-size: 24px;
            margin: 10px 0;
        }

        p {
            color: #666;
            margin-bottom: 30px;
        }

        .home-btn {
            background: #4BB543;
            color: white;
            border: none;
            padding: 12px 24px;
            font-size: 16px;
            border-radius: 30px;
            cursor: pointer;
            text-decoration: none;
            transition: background 0.3s ease, transform 0.2s ease;
        }

        .home-btn:hover {
            background: #3ca236;
            transform: scale(1.05);
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes pop {
            0% { transform: scale(0); }
            100% { transform: scale(1); }
        }
    </style>
</head>
<body>
    <div class="box">
        <div class="checkmark"></div>
        <h2>Order Placed Successfully!</h2>
        <p>Thank you for your order. Your food will be delivered soon.</p>
        <a href="home.php" class="home-btn">Go to Home</a>
    </div>
</body>
</html>
