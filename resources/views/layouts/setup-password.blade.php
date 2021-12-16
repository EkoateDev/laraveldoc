<!DOCTYPE html>
<html>

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        
    <style>
        .email-logo {
            height: 45px;
            position: relative;
            top: 20px;
            padding-bottom: 10px;
        }

        .email-body {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 14px;
            line-height: 2;
            color: #333;
            background-color: #fff;
        }

        .email-header-line {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 12px;
            line-height: 1.42857143;
            color: #333;
            background-color: #fff;
        }

        .email-line {
            clear: both;
            height: 2px;
            border-top: 1px solid #ede9e4;
        }

        .email-footer-text {
            font-style: italic;
            justify-content: left;
            font-size: 12px;
        }

        .set-content-position {
            width: 80%;
            padding-left: 10%;
            padding-right: 10%;
        }

        .text-center {
            text-align: center;
        }

        .text-left {
            text-align: left;
        }
    </style>
</head>

<body class="email-body">
    <div class="email-header-line"></div>
    <div class="set-content-position text-center">
        <div class="email-line"></div>
    </div>
    <div class="set-content-position text-left">
        <div class="font-normal">
            <p>Hi {{ $user->name }},
            </p><br>
            <p>Your account has been created on NekoHub</b>.
            </p>

            <p>Please click on the button below to setup your password
            </p>
            <a class="btn btn-primary" href="{{ url('create-password?token='.$user->set_password_token) }}" role="button">Create
                Password
            </a>
            <br><br>

            <p>This link is active for only 12 hours
            </p>

            <p>Thanks,
            </p>
            <p>NekoHub
            </p><br>
        </div>
    </div>
    <div class="set-content-position text-center">
        <div class="email-line"></div>
    </div>
    <div class="set-content-position text-center">
        <div class="email-line"></div>
    </div>
</body>
<footer>
    <address class="set-content-position text-center">
        <p class="margin-15">NekoHub</p>
    </address>
</footer>

</html>