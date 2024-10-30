<!DOCTYPE html>
<html lang="en">
<head>
    <?php wp_head(); ?>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href='https://fonts.googleapis.com/css?family=Inter' rel='stylesheet'>
    <style type="text/css">
        html{
            background-color: white !important;
        }
        .rounded{
            border-radius: 10px !important;
        }
        body {
            font-family: 'Inter' !important;
            background: #EBF3FF !important;
            border-radius: 10px !important;
            border: none !important;
        }
        .loader {
            border: 6px solid #f3f3f3;
            /* Light grey */
            border-top: 6px solid #250B42 !important;;
            /* Dark Green */
            border-radius: 100%;
            width: 105px !important;
            height: 105px !important;
            animation: spinloader 2s linear infinite;
            padding:12px;
        }
        .btn-primary{
            border-top-right-radius: 0.25rem !important;
            border-bottom-right-radius: 0.25rem !important;
            color: white !important;
        }
        .btn-error{
            border-top-left-radius: 0.25rem !important;
            border-bottom-left-radius: 0.25rem !important;
            color: white !important;
        }
        .loader img {
            height: 65px !important;
            width: 65px !important;
            animation: spinlogo 2s linear infinite;
        }

        @keyframes spinloader {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        @keyframes spinlogo {
            0% {
                transform: rotate(360deg);
            }

            100% {
                transform: rotate(0deg);
            }
        }
    </style>
</head>
<body>
<section id="wordpressAuthenticationSection">
    <div class="login-container mt-5 pb-2 ">
        <h2 class="text-center form-title">Waiting for Biometrics from Your Mobile Phone</h2>
        <center>
            <div class="loader text-center">
                <img src="<?= $url ?>images/logo.png" class="text-center"/>
            </div>
            <p class="login-time text-n-bold message">Time left to authenticate on your mobile phone…. <b class="minutes text-bold">00</b>:<b class="seconds text-bold">00</b> </p>
            <h4 class="text-center">OR</h4><br/>
            <input type="submit" class="btn btn-primary" id="loginWithBackupCodeButton" value="Login with Backup Code"/>
        </center>
    </div>

    <center>
        <p class="text-center">
            <b>Note:</b> You must have the iVALT mobile app on your phone.
            <a href="https://ivalt.com/User-Guide-for-WordPress.pdf" target="_blank">Click here for more information</a>
        </p>
    </center>
</section>

<section id="emailVerificationSection" style="display: none">
    <div class="login-container mt-5 pb-2">
        <div>
            <h2 class="text-center form-title">Your Backup Code Email is on the way!</h2>
        </div>
        <br/>
        <center class="mb-4 mt-2">
            <div class="loader">
                <img src="<?= $url ?>images/logo.png"/>
            </div>
            <br/>
            <div class="loginInputSection">
                <div style="width: 75% !important;text-align: left!important;">
                    <label>
                        Enter Backup Code <b class="text-danger">*</b>
                    </label>
                    <input type="text" id="emailVerificationCode" class="form-control input" placeholder="Enter verification code" />
                    <div class="d-flex justify-content-start align-items-center mt-3">
                        <button class="btn btn-primary" id="emailVerificationButton" style="margin-right: 15px;">Click here to login</button>
                        <button class="btn btn-error cancelEmailVerification text-light" >Cancel</button>
                    </div>
                </div>
            </div>
            <div class="loadingSection" style="display: none">
            </div>
            <p class="pText text-bold">
                <b>NOTE :</b>Please check your email for a your backup code. If you do not receive an email, please check your spam folder.
            </p>
        </center>
        <div class="mt-2 d-flex justify-content-center invisible error-box">
            <div class="error-alert alert alert-danger d-flex justify-content-between w-75" role="alert">
                <span class="d-flex justify-content-center align-items-center">
                    <span class="bg-danger rounded">
                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="white" viewBox="0 0 16 16" role="img" aria-label="Warning:">
                            <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                        </svg>
                    </span>
                    <span class="px-2 error-message"></span>
                </span>
                <button type="button" class="btn-close" style="float: right"></button>
            </div>
        </div>
    </div>
</section>

<input id="userLoginEmailId" type="hidden" name="login_email_id" value="<?=$userDetails->data->user_email?>" />
<input type="hidden" name="country_code" id="countryCode" value="<?=$countryCode?>" />
<input id="userLoginMobile" type="hidden" name="mobile" value="<?= $userMobile ?>" />

</body>
<?php
// wp_footer();
?>
<input type="hidden" value="login" name="page">
<input type="hidden" value="<?=$_SESSION['login_time']?>" name="login_time">
<script type="text/javascript">
    sendNotification()
</script>

</html>