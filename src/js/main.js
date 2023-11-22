const password = document.getElementById("password");
const togglePassword = document.getElementById("togglePassword");
let seePassTimeout;

const eyeOnPath = "/yourpet/src/assets/feather-icons/eye.svg"
const eyeOffPath = "/yourpet/src/assets/feather-icons/eye-off.svg"

togglePassword.addEventListener("click", function() {
    // toggle field & icon
    if (password.getAttribute("type") === "password") {
        password.setAttribute("type", "text");
        this.src = eyeOnPath;
    } else {
        password.setAttribute("type", "password");
        this.src = eyeOffPath;
    }

    clearTimeout(seePassTimeout);

    seePassTimeout = setTimeout(function () {
        password.setAttribute("type", "password");
        togglePassword.src = eyeOffPath; // Assuming the initial state is password
    }, 3000);
});