<html>

<head>
    <title>Welcome Email</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0
        }

        .container {
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 20px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            overflow: hidden
        }

        .header {
            text-align: center;
            padding: 20px 0;
            background-color: #4CAF50;
            color: #ffffff;
            border-radius: 10px 10px 0 0
        }

        .header h1 {
            margin: 0;
            font-size: 28px
        }

        .content {
            padding: 20px
        }

        .content p {
            font-size: 16px;
            color: #333333;
            line-height: 1.6
        }

        .content .user-info {
            background-color: #f9f9f9;
            padding: 15px;
            border-radius: 5px;
            margin: 20px 0
        }

        .content .user-info table {
            width: 100%;
            border-collapse: collapse
        }

        .content .user-info table th,
        .content .user-info table td {
            padding: 10px;
            text-align: left
        }

        .content .user-info table th {
            color: #4CAF50;
            border-radius: 5px 5px 0 0
        }

        .content .user-info table td {
            border-bottom: 1px solid #eeeeee
        }

        .footer {
            text-align: center;
            padding: 20px 0;
            font-size: 14px;
            color: #999999;
            border-top: 1px solid #eeeeee
        }

        .button {
            display: inline-block;
            padding: 10px 20px;
            margin-top: 20px;
            background-color: #4CAF50;
            color: #ffffff;
            text-decoration: none;
            border-radius: 5px;
            font-size: 16px
        }

        .button:hover {
            background-color: #45a049
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>Welcome to {{ config('app.name') }}!</h1>
        </div>
        <div class="content">
            <p>Hi {{ $data->name }},</p>
            <p>Thank you for registering on our platform. Here are your registration details:</p>
            <div class="user-info">
                <table>
                    <tr>
                        <th>Detail</th>
                        <th>Information</th>
                    </tr>
                    <tr>
                        <td><strong>Name:</strong></td>
                        <td>{{ $data->name }}</td>
                    </tr>
                    <tr>
                        <td><strong>Email:</strong></td>
                        <td>{{ $data->email }}</td>
                    </tr>
                    <tr>
                        <td><strong>Registration Date:</strong></td>
                        <td>{{ \Carbon\Carbon::now()->format('F d, Y H:i') }}</td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="footer">
            <p>&copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</p>
        </div>
    </div>
</body>

</html>
