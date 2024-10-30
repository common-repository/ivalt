<!DOCTYPE html>
<html lang="en">
<head>
    <?php
    wp_head();
    ?>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <style type="text/css">
        .loader {
            border: 6px solid #f3f3f3;
            /* Light grey */
            border-top: 6px solid #235be4;
            /* Dark Green */
            border-radius: 100%;
            width: 120px !important;
            height: 120px !important;
            animation: spinloader 2s linear infinite;
            padding:20px;
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
    <div class="login-container mt-5 pb-2">
        <div class="header text-center" >
            <center>
                <h1 class="text-s-bold t-24 pt-2">Waiting for Biometrics from Your Mobile Phone</h1>
            </center>
        </div>
        <center>
            <br/>
            <center>
                <div class="loader">
                    <img src="https://ivalt.com/mfa/ivalt_logo.png"/>
                </div>
            </center>
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
            <h1 class="text-s-bold t-24 pt-2">Your Backup Code Email is on the way!</h1>
        </div>
        <br/><br/>
        <center class="mb-4 mt-2">
            <br/>
            <div class="loader">
                <img src="https://ivalt.com/mfa/ivalt_logo.png"/>
            </div>
            <br/>
            <div class="loginInputSection">
                <div style="width: 75% !important;text-align: left!important;">
                    <label>
                        Enter Backup Code <b class="text-danger">*</b>
                    </label>
                    <input type="text" id="emailVerificationCode" class="form-control input" placeholder="Enter verification code" />
                    <br/>
                    <button class="btn btn-primary btn-block" id="emailVerificationButton">Click here to login</button>
                    <br/>
                    <button class="btn btn-dark btn-block cancelEmailVerification" >Cancel</button>
                </div>
            </div>
            <div class="loadingSection" style="display: none">
                <img src="<?=$url?>images/Loading_2.gif" width="300"/>
            </div>
            <p class=" text-bold text-primary">
                <b>NOTE :</b>Please check your email for a your backup code. If you do not receive an email, please check your spam folder.
            </p>
        </center>
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