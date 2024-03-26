document.querySelectorAll(".password-addon").forEach(function (addon) {
    addon.addEventListener("click", function () {
        const passwordInput = this.parentNode.querySelector(".password-input");
        if (passwordInput.type === "password") {
            passwordInput.type = "text";
        } else {
            passwordInput.type = "password";
        }
    });
});

const passwordInput = document.getElementById("password-input");
const confirmPasswordInput = document.getElementById("confirm-password-input");
const passwordContainDiv = document.getElementById("password-contain");

confirmPasswordInput.addEventListener("input", function () {
    validatePassword();
});

function validatePassword() {
    if (passwordInput.value !== confirmPasswordInput.value) {
        confirmPasswordInput.setCustomValidity("Passwords Don't Match");
        passwordContainDiv.style.display = "none";
    } else {
        confirmPasswordInput.setCustomValidity("");
        passwordContainDiv.style.display = "block";
    }
}

passwordInput.addEventListener("keyup", function () {
    checkPasswordStrength();
});

function checkPasswordStrength() {
    const lowercaseRegex = /[a-z]/g;
    const uppercaseRegex = /[A-Z]/g;
    const numberRegex = /[0-9]/g;
    const password = passwordInput.value;

    const lowercaseValid = password.match(lowercaseRegex);
    const uppercaseValid = password.match(uppercaseRegex);
    const numberValid = password.match(numberRegex);
    const lengthValid = password.length >= 8;

    const letter = document.getElementById("pass-lower");
    const capital = document.getElementById("pass-upper");
    const number = document.getElementById("pass-number");
    const length = document.getElementById("pass-length");

    letter.classList.toggle("valid", !!lowercaseValid);
    letter.classList.toggle("invalid", !lowercaseValid);
    capital.classList.toggle("valid", !!uppercaseValid);
    capital.classList.toggle("invalid", !uppercaseValid);
    number.classList.toggle("valid", !!numberValid);
    number.classList.toggle("invalid", !numberValid);
    length.classList.toggle("valid", lengthValid);
    length.classList.toggle("invalid", !lengthValid);
}

passwordInput.addEventListener("focus", function () {
    document.getElementById("password-contain").style.display = "block";
});

passwordInput.addEventListener("blur", function () {
    document.getElementById("password-contain").style.display = "none";
});