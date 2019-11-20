var strength = {
    0: "Erg slecht <i class=\"far fa-angry\"></i>",
    1: "Slecht <i class=\"far fa-angry\"></i>",
    2: "Zwak <i class=\"far fa-frown\"></i>",
    3: "Goed <i class=\"far fa-smile\"></i>",
    4: "Sterk <i class=\"far fa-grin-alt\"></i>"
}

var password = document.getElementById('newPassword');
var meter = document.getElementById('password-strength-meter');
var text = document.getElementById('password-strength-text');

if (password !== null) {
    password.addEventListener('input', function () {
        var val = password.value;
        var result = zxcvbn(val);

        // Update the password strength meter
        meter.value = result.score;

        // Update the text indicator
        if (val !== "") {
            text.innerHTML = "Sterkte: " + "<strong>" + strength[result.score] + "</strong>" + "<span class='feedback'>" + result.feedback.warning + " " + result.feedback.suggestions + "</span";
        } else {
            text.innerHTML = "";
        }
    });
}
