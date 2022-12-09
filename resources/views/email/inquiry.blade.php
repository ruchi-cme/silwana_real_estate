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
    style="background: #F5F5F5;position: relative;width: 640px;max-width: 100%px; height: 573px;display: block;margin: 0px auto;background-size: 100% 100%;min-width: 280px !important;">
    <th>
        <div class="header-img" style="width: 640px;height: 150px; background: #010211;">
            <img src="{{ asset('images/front/logo.png') }}" alt=""  style="width: 219px;height: 68px;z-index: 99;margin-top: 42px;">
        </div>
    </th>
    <tr>
        <td>
            <div class="main-div" style="width: 100%;max-width: 500px;height: auto;position: relative; margin-left: 70px; border-radius: 10px;background-color: #fff;z-index: 10; box-shadow: 0px 20px 50px rgba(0, 0, 0, 0.1);" >
                <div class="top-icon" style="position: relative;margin-top: 10px;margin-bottom: 30px; padding-top: 22px;">

                    <h3 style="font-family: Poppins;font-size: 24px;font-weight: 600;line-height: 36px;letter-spacing: 0px;text-align: center;margin-top: 19px;margin-bottom: 10px;color: #010211;">Hello,</h3>
                    <h4 style="font-family: Poppins;font-size: 14px;font-weight: 400;line-height: 21px;letter-spacing: 0px;text-align: center;padding-left: 75px;padding-right: 45px;margin: 0px; color: #010211;">You have received new inquiry. Please check in admin for more details. </h4>
                        <div class="one-time-password" style="margin-top: 40px;margin-left: 99px; width: 100%;padding-bottom: 50px">
                            <table>
                                <tbody style="">
                                <tr>
                                    <td style="font-size:16px;font-weight: bold">Name</td>
                                    <td style="font-size: 16px; padding-left: 10px"> {{ $name }}</td>
                                </tr>
                                <tr>
                                    <td style="font-size:16px;font-weight: bold">Phone No.</td>
                                    <td style="font-size: 16px;padding-left: 10px"> {{ $phone }}</td>
                                </tr>
                                <tr>
                                    <td style="font-size:16px;font-weight: bold">Email</td>
                                    <td style="font-size: 16px;padding-left: 10px"> {{ $email }}</td>
                                </tr>

                                </tbody>
                            </table>
                        </div>
                </div>

            </div>
        </td>
    </tr>
    <td>
        <div class="foot" style="width: 100%; max-width: 636px;background-color: #181819; height: 31px;z-index: 10;margin-top: 35px;">
            <p style="text-align: center; font-family: 'Poppins'; font-weight: 600;line-height: 18px;font-size: 12px; color: #fff;padding-top: 6px;
                margin-bottom: 0;">© Copyright {{date('Y')}} Silwana real estate development. All rights reserved</p>
        </div>
    </td>
    </tr>
</table>
</body>
</html>
