
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Document-3</title>
</head>
<style>
    @font-face {
        font-family: 'Poppins';
        src: url('./fonts/Poppins-Bold.woff2') format('woff2'),
        url('Poppins-Bold.woff') format('woff');
        font-weight: bold;
        font-style: normal;
        font-display: swap;
    }

    @font-face {
        font-family: 'Poppins';
        src: url('./fonts/Poppins-SemiBold.woff2') format('woff2'),
        url('Poppins-SemiBold.woff') format('woff');
        font-weight: 600;
        font-style: normal;
        font-display: swap;
    }
    @font-face {
        font-family: 'Poppins';
        src: url('./fonts/Poppins-Regular.woff2') format('woff2'),
        url('Poppins-Regular.woff') format('woff');
        font-weight: normal;
        font-style: normal;
        font-display: swap;
    }

    @font-face {
        font-family: 'Inter';
        src: url('./fonts/Inter-Regular.woff2') format('woff2'),
        url('Inter-Regular.woff') format('woff');
        font-weight: normal;
        font-style: normal;
        font-display: swap;
    }

    @font-face {
        font-family: 'Inter';
        src: url('./fonts/Inter-SemiBold.woff2') format('woff2'),
        url('Inter-SemiBold.woff') format('woff');
        font-weight: 600;
        font-style: normal;
        font-display: swap;
    }
    .reset-passoword-btn:hover{
        color: #010211 !important;
    }
</style>

<body style="box-sizing: border-box;padding: 0; margin: 0px;">
<table
    style="background: #F5F5F5;position: relative;width: 640px;max-width: 100%px; height: 757px;display: block;margin: 0px auto;background-size: 100% 100%;min-width: 280px !important;">
    <th>
        <div class="logo">
            <img src="{{ asset('images/front/logo.svg') }}" alt=""
                 style="width: 219px;height: 68px !important;position: absolute;z-index: 99;left: 212px;top: 36px;">
        </div>
        <div class="header-img">
            <img src="{{ asset('images/front/header-bg-img.png') }}" alt=""
                 style="width: 640px;height: 206px;position: absolute;top: 0px;left: 0px;background-size: cover;z-index: 1;">
        </div>

    </th>
    <tr>
        <td>
            <div class="main-div"
                 style="width: 500px;height: auto;top: 145px;left: 65px;border-radius: 10px;background-color: #fff;position: absolute;z-index: 10;">
                <div class="top-icon" style="position: relative;margin-top: 30px;margin-bottom: 30px;">
                    <img src="{{ asset('images/front/header-bg-img.png') }}" alt=""
                         style="border-radius: 50%;width: 98px;height: 98px;display: flex;align-items: center;justify-content: center;display: block;margin: 0px auto;margin-top: 20px!important;">

                    <h3 style="font-family: Poppins;font-size: 24px;font-weight: 600;line-height: 36px;letter-spacing: 0px;text-align: center;margin-top: 19px;margin-bottom: 10px;color: #010211;">Hello,</h3>
                    <h4 style="font-family: Poppins;font-size: 14px;font-weight: 400;line-height: 21px;letter-spacing: 0px;text-align: center;padding-left: 75px;padding-right: 45px;margin: 0px; color: #010211;">If you’ve lost your password or wish to reset it,
                        use the link below to get started.</h4>

                    <div class="one-time-password" style="width: 100%; max-width: 288px;height: auto;padding:30px 40px 30px 40px; border: 2px dashed #B48D4E; border-radius: 2px; margin: 0px auto ;margin-top: 40px !important;margin-bottom: 50px !important;  box-sizing: border-box;text-align: center;">
                        <a href="{{ URL($link. $token) }}" class="reset-passoword-btn" style="background: #B48D4E;padding: 6px 19px 6px 19px;font-family: Poppins;font-size:14px;font-weight: 400;line-height: 21px;letter-spacing: 0px;text-align: center;text-decoration: none;color: #fff !important;margin:0px auto;transition: 0.3s;">Reset Your Password</a>

                    </div>
                </div>

                <div class="extra-text" style="width: 500px;height: auto;padding: 20px 50px 20px 50px; background-color: #B48D4E;border-radius: 0px 0px 10px 10px;">
                    <h4 style="font-family: Poppins;font-size: 14px;font-weight: 400;line-height: 21px;letter-spacing: 0px;text-align: center;color: #fff;">If you did not request a password reset, you can safely ignore this email.</h4>
                </div>
            </div>

        </td>
    </tr>
    <td>
        <div class="foot"
             style="width: 640px;background-color: #181819; height: 31px;position: absolute;left: 0px; bottom:0%;z-index: 10;">
            <p style="display: flex;justify-content: center;align-self:center;align-items: center;font-family: 'Poppins'; font-weight: 600;line-height: 18px;font-size: 12px; color: #fff;margin-top: 6px;
                margin-bottom: 0;">© Copyright {{date('Y')}} Silwana real estate development. All rights reserved</p>
        </div>
    </td>
    </tr>
</table>
</body>
</html>
