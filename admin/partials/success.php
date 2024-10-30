<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://ondemandid.com/build/css/intlTelInput.css">
    <link href='https://fonts.googleapis.com/css?family=Inter' rel='stylesheet'>
    <style>
        .btn-error{
            border-top-left-radius: 0.25rem !important;
            border-bottom-left-radius: 0.25rem !important;
            color: white !important;
        }
    </style>
</head>
<body>

<!-- Section: Design Block -->
<section class="mt-3">
    <!-- Jumbotron -->
    <div class="px-4 py-5 px-md-5 text-center text-lg-start">
        <div class="container">
            <div class="row gx-lg-5 align-items-center">
                <div class="col-md-12 col-sm-12 text-center mb-5">
                    <h2 class="main-title">Welcome To iVALT</h2>
                    <p class="pText">A universal 3-Factor authenticator to access your WordPress Admin securely.</p>
                </div>
                <div class="col-md-12 col-sm-12 mb-5 mb-lg-0 d-flex justify-content-center">
                    <div class="custom-card text-center py-5">
                            <section class="authenticationSection" style="display: none">
                                <div class="text-center">
                                    <img src="<?= $url ?>images/Spinner.gif" alt="" class="img-fluid text-center" width="35%">
                                    <h6 class="text-dark pText mt-2">Waiting for authentication from your mobile phone…</h6>
                                </div>
                                <div class="mt-4">
                                    <p class="text-center">
                                        <a id="cancelDisableIvaltWebId" class="btn btn-error btn-block btn-sm">Cancel</a>
                                    </p>
                                </div>
                            </section>
                            <section class="authenticationSuccessSection">
                                <div class="text-center">
                                    <img src="<?= $url ?>images/success.png" alt="" class="text-center successImage">
                                </div>
                                <p class="mt-3 text-dark pText">You have already Installed and Registered iVALT Wordpress Plugin!</p>
                                <div class="mt-4">
                                    <p class="text-center">
                                        <a id="disableIvaltWebId" class="btn btn-error">Disable iVALT</a>
                                    </p>
                                </div>
                            </section>
                        </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Jumbotron -->
</section>
<input id="userLoginEmailId" type="hidden" name="login_email_id" value="<?=$userDetails->data->user_email?>" />
<input type="hidden" name="country_code" id="countryCode" value="<?= $countryCode ?>" />
<input id="userLoginMobile" type="hidden" name="mobile" value="<?= $userMobile ?>" />
<input type="hidden" name="_token" value=""/>
<!-- Section: Design Block -->

<!-- Optional JavaScript; choose one of the two! -->

<!-- Option 1: Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

<!-- Option 2: Separate Popper and Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
<!-- Use as a jQuery plugin -->
<script src="https://ondemandid.com/build/js/intlTelInput-jquery.min.js"></script>
<script src="https://ondemandid.com/build/js/intlTelInput.js"></script>

</body>
</html>