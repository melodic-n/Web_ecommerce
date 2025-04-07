<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Notification</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        .container {
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        .header {
            background-color: #4CAF50;
            color: white;
            padding: 10px;
            border-radius: 8px 8px 0 0;
            text-align: center;
        }
        .header h1 {
            margin: 0;
        }
        .content {
            padding: 20px;
        }
        .content h3 {
            color: #333;
            font-size: 18px;
        }
        .content p {
            color: #555;
            font-size: 16px;
        }
        .footer {
            text-align: center;
            font-size: 14px;
            color: #999;
            margin-top: 20px;
        }
        .button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            display: inline-block;
            margin-top: 20px;
        }
        .button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>

    <div class="container">
        <div class="header">
            <h1>Account Login Notification</h1>
        </div>

        <div class="content">
            <h3>Hello {{ $user->name }},</h3>
            <p>We wanted to let you know that your account was accessed.</p>
            <p>If this was not you, we recommend you take action immediately.</p>
            <p>You can review your login activity or change your password by clicking the button below:</p>
            <a href="{{ url('/') }}" class="button">Review Your Account</a>
        </div>

        <div class="footer">
            <p>If you did not log in, please reset your password right away. For any concerns, feel free to contact us.</p>
            <p>&copy; {{ date('Y') }} Your Company Name. All rights reserved.</p>
        </div>
    </div>

</body>
</html>
