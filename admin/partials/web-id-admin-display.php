<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://ondemandid.com/build/css/intlTelInput.css">
    <style>
        .display-4{
            font-size: 1.4rem;
        }
        .bd-callout-info {
            border-left-width: 5px;
            border-left-color: #0d6efd!important;
        }
        .iti {
            width: 100% !important;
        }
    </style>
</head>
<body>
<!-- Section: Design Block -->
<section class="mt-3">
    <!-- Jumbotron -->
    <div class="px-4 py-5 px-md-5 text-center text-lg-start" style="background-color: hsl(0, 0%, 96%)">
        <div class="container">
            <div class="row gx-lg-5 align-items-center">
                <div class="col-lg-6 mb-5 mb-lg-0">
                    <h1 class="my-2 display-4 fw-bold ls-tight">
                        <div class="my-2">
                            <img src="https://ivalt.com/mfa/ivalt_logo.png" alt="" width="10%" class="img-fluid">
                        </div>
                        <span class="text-primary">Welcome to iVALT™ Universal 3-Factor Authentication</span>
                    </h1>
                    <b class="my-2">Secured by iVALT™ Universal 3-Factor Authentication</b>
                    <p style="color: hsl(217, 10%, 50.8%)">
                        If you have not done so, YOU MUST DOWNLOAD the <a
                                href="https://ivalt.com/help/index.html" target="_blank">iVALT</a> mobile application to enable
                        facial recognition from your mobile phone. The mobile app communicates with the WordPress plugin during the
                        login process. Please download the iVALT mobile app from Google Play (iVALT-WP) or from iVALT.com. Once
                        downloaded, please open the app to REGISTER your mobile number and ENROLL your facial profile (follow the
                        instructions in the app). Once these two steps are completed on your mobile phone and you have installed the
                        iVALT WordPress plugin on your WordPress site, you are ready to start using iVALT 3-Factor Authentication
                        for WordPress!
                    </p>
                    <div class="box-right">
                        <img src="<?= $url ?>images/android-playstore.png" class="img-center" width="30%"/>
                    </div>
                </div>

                <div class="col-lg-6 mb-5 mb-lg-0">
                    <div class="card shadow-sm bd-callout bd-callout-info">
                        <div class="card-body py-5">
                            <div class="text-center">
                                <img src="<?= $url ?>images/animation.gif" alt="" class="img-fluid text-center" width="60%">
                                <h6 class="text-primary mt-2">Waiting for authentication from your mobile phone…</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Jumbotron -->
</section>
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
    var input = document.querySelector("#phone");
    var dialCode = document.querySelector("#dialCode");
    let instance = window.intlTelInput(input, {
        allowDropdown: true,
        preferredCountries: ['us', 'in'],
        separateDialCode: true,
        utilsScript: "https://ondemandid.com/build/js/utils.js",
    });

    input.addEventListener("countrychange",function() {
        dialCode.value = instance.getSelectedCountryData().dialCode;
    });

</script>
</body>
</html>