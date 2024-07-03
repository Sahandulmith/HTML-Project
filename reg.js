document.addEventListener("DOMContentLoaded", function() {
    const form = document.querySelector("form");

    form.addEventListener("submit", function(event) {
        const email = form.email.value;
        const password = form.password.value;
        const retypePassword = form.retp.value;

        $(".error").text("");

        if (!validateEmail(email)) {
            $("#emailError").text("Please enter a valid email address.!");
            $("#email").css('border-color','red');
            event.preventDefault();
            return;
        }else {
            $("#email").css('border-color','#aaa');
        }

        if (password.length < 6) {
            $("#passwordError").text("Password must be at least 6 characters long.!");
            $("#password").css('border-color','red');
            event.preventDefault();
            return;
        }else {
            $("#password").css('border-color','#aaa');
        }

        if (password !== retypePassword) {
            $("#retpError").text("Passwords do not match.!");
            $("#retp").css('border-color','red');
            event.preventDefault();
            return;
        }else {
            $("#retp").css('border-color','#aaa');
        }
    });

    function validateEmail(email) {
        const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return re.test(String(email).toLowerCase());
    }
});

