{{--
<!DOCTYPE html>
<html>

<head>
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
    <div class="set-content-position text-center">
        <img class="email-logo" src="{{ asset('logo/logo.png') }}">
    </div>
    <div class="email-header-line"></div>
    <div class="set-content-position text-center">
        <div class="email-line"></div>
    </div>
    <div class="set-content-position text-left">
        <div class="font-normal">
            <p>Hi {{ $user->name }},
            <p><br>
            <p>Your account has been created on NekoHub</b>.
            <p>

            <p>Please click on the link below or copy and paste it in your internet browser to setup your password
            <p>

                <a
                    href="{{ url('http://localhost:8000/create-password/?id='.$user->id.'&token='.$user->set_password_token) }}">{{
                    url('http://localhost:8000/create-password/?id='.$user->id.'&token='.$user->set_password_token)
                    }}</a><br><br>

            <p>This link is active for only 12 hours
            <p>

            <p>Thanks,
            <p>
            <p>NekoHub
            <p><br>
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

</html> --}}

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>

<body class="email-body">

    <div class="container">
        <div class="email-header-line"></div>
        <div class="set-content-position text-center">
            <div class="email-line"></div>
        </div>
    </div>

    <div class="set-content-position text-center">
        <div class="font-normal text-left">
            {{-- <p>Hi {{ $user->name }}, --}}
            </p><br>
            <p>Your account has been created on NekoHub.</p>

            <p>Please click on the button below to setup your password</p>

            <a class="btn btn-primary" href="{{ url('/create-password/?token='.$user->token) }}" role="button">Create
                Password
            </a>
            <br><br>

            <p>This link is active for only 12 hours</p>

            <p>Thanks,</p>
            <p>NekoHub</p><br>
        </div>
    </div>
</body>

<footer class="footer mt-auto py-3 bg-light">
    <div class="container text-center">
        <span class="text-muted">NekoHub.</span>
    </div>
</footer>

</html>