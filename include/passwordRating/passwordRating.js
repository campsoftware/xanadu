// From https://github.com/caitlindaitch/passwordStrengthMeter with modifications of the class names.

var password = document.getElementById('Password');

password.addEventListener('keyup', function(){
	var passwordArray = password.value.split('');
	var totalScore = 0;

	var rating = {
		number: 0,
		lowercase: 0,
		uppercase: 0,
		specialChar: 0,
		total: 0
	}

	var validation = {
		isNumber: function(val){
			var pattern = /^\d+$/;
			return pattern.test(val);
		},
		isLowercase: function(val){
			var pattern = /[a-z]/;
			return pattern.test(val);
		},
		isUppercase: function(val){
			var pattern = /[A-Z]/;
			return pattern.test(val);
		},
		isSpecialChar: function(val){
			var pattern = /^[!@#\$%\^\&*\)\(+=._-]+$/g;
			return pattern.test(val);
		}
	}

	for (var i=0; i<passwordArray.length; i++){
		if (validation.isNumber(passwordArray[i])){
			rating.number = 1;
		} else if (validation.isLowercase(passwordArray[i])){
			rating.lowercase = 1;
		} else if (validation.isUppercase(passwordArray[i])){
			rating.uppercase = 1;
		} else if (validation.isSpecialChar(passwordArray[i])){
			rating.specialChar = 1;
		}
	}

	function assessTotalScore(){
		var ratingElement = document.querySelector(".passwordRating");
		rating.total = rating.number + rating.lowercase + rating.uppercase + rating.specialChar;

		if (rating.total === 1){
			ratingElement.innerHTML = "&nbsp;Weak&nbsp;";
			ratingElement.classList.remove("passwordModerate", "passwordStrong");
			ratingElement.classList.add("passwordWeak");
		} else if (rating.total === 2){
			ratingElement.innerHTML = "&nbsp;Moderate&nbsp;";
			ratingElement.classList.remove("passwordWeak", "passwordStrong");
			ratingElement.classList.add("passwordModerate");
		} else if (rating.total === 3){
			ratingElement.innerHTML = "&nbsp;Strong&nbsp;";
			ratingElement.classList.remove("passwordWeak", "passwordModerate");
			ratingElement.classList.add("passwordStrong");
		}
	}

	assessTotalScore();
});
