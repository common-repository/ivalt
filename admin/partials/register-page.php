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
        .rounded{
            border-radius: 10px !important;
        }
    </style>
</head>
<body>
<!-- Section: Design Block -->
<section class="m-4">
    <!-- Jumbotron -->
    <div class="md-px-4 py-4 px-md-5 text-lg-start">
        <div class="container">
            <div class="row gx-lg-5 align-items-center">
                <div class="col-md-12 col-sm-12 text-center mb-5">
                    <h2 class="main-title">Welcome To iVALT</h2>
                    <p class="pText">A universal 3-Factor authenticator to access your WordPress Admin securely.</p>
                </div>

                <div class="col-lg-6">
                    <b class="md-mb-4 list-heading">If you haven’t completed the following steps, please
                    do so before setting up your iVALT Wordpress Plugin. </b>
                    <ol class="ol-features">
                        <li>
                            <div>
                                Install iVALT mobile app on your phone.<br/>
                                Download - <a class="text-a" href="https://apps.apple.com/us/app/ivalt/id1507945806">iPhone</a> or <a class="text-a" href="https://play.google.com/store/apps/details?id=com.abisyscorp.ivalt&hl=en_IN">Android</a>
                            </div>
                        </li>
                        <li>Enroll your biometric profile with iVALT
                            mobile app on your phone.</li>
                    </ol>
                </div>

                <div class="col-lg-6 md-mb-3">
                        <div class="custom-card">
                            <section class="loginSection">
                                <h2 class="form-title">Register your iVALT for WordPress</h2>
                                <form action="register_ivalt" id="ivalt_from">
                                    <!-- Email input -->
                                    <label class="form-label" for="mobile">Enter your mobile number<b class="text-danger">*</b></label>
                                    <div class="form-outline mb-4">
                                        <input type="tel" id="mobile" class="form-control mobileInput" />
                                        <!-- Submit button -->
                                        <button  type="submit" class="btn btn-primary registerBtn">Register</button>
                                    </div>
                                    <p class="mt-4 pText text-dark">You will receive an authentication request to your mobile phone.</p>
                                    <input type="hidden" id="dialCode" name="dialCode" value="1" />
                                </form>
                            </section>
                            <section class="authenticationSection" style="display: none">
                                <div class="text-center">
                                    <img src="<?= $url ?>images/Spinner.gif" alt="" class="img-fluid text-center" width="35%">
                                    <h6 class="msg text-dark pText mt-4">Waiting for authentication from your mobile phone…</h6>
                                    <h6 id="counter">05:00</h6>
                                </div>
                                <div class="mt-4">
                                    <p class="text-center">
                                        <a id="cancelDisableIvaltWebId" class="btn btn-error btn-block btn-sm text-light">Cancel</a>
                                    </p>
                                </div>
                            </section>
                        </div>
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
                <div class="col-md-12 col-sm-12 text-center appStoreSection">
                    <h6>Download iVALT Mobile App</h6>
                    <div class="my-3">
                        <a href="https://apps.apple.com/in/app/ivalt/id1507945806" target="_blank">
                            <img src="<?= $url ?>images/apple-store.png" class="img-center storeLinks"/>
                        </a>
                        <a href="https://play.google.com/store/apps/details?id=com.abisyscorp.ivalt&hl=en_IN&gl=US" target="_blank">
                            <img src="<?= $url ?>images/google-playstore.jpg" class="img-center storeLinks"/>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Jumbotron -->
</section>

<input type="hidden" name="email_id" value="<?= $userDetails->data->user_email ?>"/>
<input type="hidden" name="country_code" id="countryCode" value="<?= $countryCode ?>" />
<input type="hidden" name="reg_mobile" value="<?= $registeredMobile ?>"/>
<input type="hidden" name="_token" value=""/>
<input type="hidden" id="custId" name="custId" value="true" >

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

<script>
    var ajaxurl = "<?php echo admin_url('admin-ajax.php'); ?>";
    var $ = jQuery.noConflict();

    var input = document.querySelector("#mobile");
    var dialCode = document.querySelector("#dialCode");

    let instance = window.intlTelInput(input, {
        allowDropdown: true,
        preferredCountries: ['us', 'in'],
        separateDialCode: true,
        utilsScript: "https://ondemandid.com/build/js/utils.js",
        customPlaceholder: function(selectedCountryPlaceholder, selectedCountryData) {
            return "";
        },
    });

    input.addEventListener("countrychange",function() {
        dialCode.value = instance.getSelectedCountryData().dialCode;
    });
</script>
</body>
</html>