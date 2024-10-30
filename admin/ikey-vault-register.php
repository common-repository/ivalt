<div class="container">
   <div class="text-row"> <h1 class="text-s-bold">Welcome to iVALT™ Universal 3-Factor Authentication</h1>
    <p class="text-p justify">If you have not done so, YOU MUST DOWNLOAD the <a href="https://ivalt.com/help/index.html" target="_blank">iVALT</a> mobile application to enable facial recognition from your mobile phone.   The mobile app communicates with the WordPress plugin during the login process.   Please download the iVALT mobile app from Google Play (iVALT-WP) or from iVALT.com. Once downloaded, please open the app to REGISTER your mobile number and ENROLL your facial profile (follow the instructions in the app).  Once these two steps are completed on your mobile phone and you have installed the iVALT WordPress plugin on your WordPress site, you are ready to start using iVALT 3-Factor Authentication for Wordpress!</p>
</div>
  

    
    <div class="registration_process pt-1">
        <div class="login-box pl-2 pr-2 pt-1">
        <div class="row register-divs text-center ">
            <h2 class="text-n-bold" style="font-size: 24px;">Enter Mobile</h2>
            <input type="number" name="mobile" value="" autocomplete="off" class="mbile_input mt-5" placeholder="xxx-xxx-xxxx" />
            <br/>
            <span class="red error">Error: </span>
        </div>
        <div class="row register-divs mt-5 text-center">
            <input type="submit" name="signup" value="Register" class=" submit-btn register_user btn-bg-active" />
            <p class="mt-5 text-p justify">You will receive an authentication request to your mobile phone</p>
        </div>
        <div class="wait-for-confirmation">
            <h4 class="text-p">Waiting for authentication from your mobile phone…</h4>
        </div>
        <div class="row">
            <img src="<?=$url?>images/loader.gif" width="100" class="register-loader img-center" />
        </div>

      <div class="row">
      <img src="<?=$url?>images/loader.gif" class="ikeyvault-loader img-center" />
      </div>
    </div>
    
    <div class="ivalt-help-box mt-10">
        <div class="box-left">
           <button type="button" onclick="openWin()" class="submit-btn  btn-bg-help">Click here for HELP!</button> 
        </div>
        <div class="box-right"><img src="<?=$url?>images/android-playstore.png" class=" img-center" /></div>
    </div>

    </div>
    
    


    <div class="register_status">
        <div id="wrap">
            <svg class="checkmark" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52">
                <circle class="checkmark-circle" cx="26" cy="26" r="25" fill="none" />
                <path class="checkmark-check" fill="none" d="M14.1 27.2l7.1 7.2 16.7-16.8" />
            </svg>
        </div>
        <center> <h1 class="registered-text text-n-bold">You have Already Installed and Registered the iVALT WordPress Plugin! <!-- <b>iVALT™</b>! --></h1> <br/>
                 <h1 class="register-success-text text-n-bold">You have successfully registered with <b>iVALT™</b>!</h1>
        </center> 
    </div>
</div>

<input type="hidden" name="email_id" value="<?=$userDetails->data->user_email?>" />
<input type="hidden" name="country_code" value="<?=$countryCode?>" />
<input type="hidden" name="reg_mobile" value="<?=$registeredMobile?>" />
<input type="hidden" name="_token" value="" />
<script type="text/javascript">
    var $ = jQuery;
    $(document).ready(function(){
        validateUserRegister();
    });
</script>
<script type="text/javascript">

    function openWin() {
    window.open("https://ivalt.com/help/index.html");
    }
    
</script>  