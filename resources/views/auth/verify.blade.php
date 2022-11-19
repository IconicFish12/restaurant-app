<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reset Password</title>
    <style>
        *{
            margin: 0;
            padding: 0;
            font-family: "Poppins", sans-serif;
        }

        .container{
            width: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }

        .section{
            margin: 10px;
            border: 1px solid #000;
            border-radius: 15px;

        }

        .btn {
            display: flex;
            justify-content: center;
            padding: 16px;
            background-color: #4e73df;
            font-size: 14.6px;
            border: 0;
            color: white;
            font-weight: 600;
            cursor: pointer;
            margin-top: 16px;
            border-radius: 4px;
        }


    </style>
</head>
<body>

    <div class="container">
        <div class="section">
            <h2 style="margin-top: 20px; text-align: center; font-weight: bold">Reset Password</h2>
            <p style="font-size: 20px; text-align: center;">We Accept Requests to reset your password</p>
            <br>
            <span style="margin-top: 16px; font-size: 20px; text-align: center;">
                Click this button to reset your password
            </span>
            <a style="text-decoration: none;" href="{{ asset('reset-password/'. $data->token) }}">
                <button class="btn">
                    Reset Password
                </button>
            </a>
        </div>
    </div>

</body>
</html>
