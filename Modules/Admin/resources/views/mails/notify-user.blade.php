<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>User Alert</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .header {
            background-color: #4CAF50;
            color: white;
            padding: 10px 0;
            text-align: center;
        }
        .content {
            margin: 20px 0;
        }
        .footer {
            text-align: center;
            color: #777;
            font-size: 12px;
            margin-top: 20px;
        }
        .button {
            display: inline-block;
            padding: 10px 20px;
            margin: 20px 0;
            background-color: #4CAF50;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }
        .code {
            font-weight: bold;
            color: #4CAF50;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Notification Of Approval</h1>
        </div>
        <div class="content">
            <p>Hello!</p>
            <p> Your Account has being Approved.</p>

            <p>Click on the link to visit the dashboard.<a href="https://eurekaedu.academy/advocate/dashboard">Dashboard</a></p>
            <p>Thank you!</p>
        </div>
        <div class="footer">
            &copy; {{ date('Y') }} Your Company. All rights reserved.
        </div>
    </div>
</body>
</html>
