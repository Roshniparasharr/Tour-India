<!DOCTYPE html>
<html>
<head>
    <link rel="shortcut icon" href="download.png">
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            overflow: hidden;
            background: linear-gradient(to bottom, #78C7D4, #005273);
        }

        .travel-content {
            position: absolute;
            left: 0;
            width: 40%;
            height: 100%;
            background: rgba(0, 0, 0, 0.7);
            color: #fff;
            padding: 20px;
            box-sizing: border-box;
        }

        .card-container {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 300px;
            background-color: #fff;
            border-radius: 20px;
            box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.2);
            opacity: 0;
            transition: opacity 0.5s;
        }

        .card {
            padding: 20px;
            text-align: center;
        }

        .payment-button {
            margin-top: 20px;
            text-align: center;
        }

        .payment-button a {
            text-decoration: none;
        }

        .payment-button button {
            background-color: #6064b6;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s;
            margin-right: 10px; /* Added margin between buttons */
        }

        .payment-button button:hover {
            background-color: #48508f;
        }
    </style>
</head>
<body>
    
    <div class="card-container">
        <div class="card">
            <h1>Pay using this QR Code</h1>
            <img src="./images/Screenshot (238).png" alt="QR Code" style="max-width: 100%; height: auto;">
            <img src="./images/QR_Code.jpg" alt="QR Code" style="max-width: 100%; height: auto;">
            
            <div class="payment-button">
                <a href="success.html">
                    <button>Payment done</button>
                </a>
                <a href="cash_on_arrival.html"> <!-- Added cash on arrival link -->
                    <button>Cash on Arrival</button>
                </a>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const cardContainer = document.querySelector(".card-container");
            cardContainer.style.opacity = "1";
        });
    </script>
</body>
</html>
