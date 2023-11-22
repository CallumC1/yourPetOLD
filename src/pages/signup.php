<?php
session_start();
include("../components/header.php");
include("../handlers/generate_csrf.php"); ?>

<?php
// Sessions used to keep data in table upon redirect.
session_regenerate_id();
generate_csrf();


$formData = isset($_SESSION['signup_form_data']) ? $_SESSION['signup_form_data'] : [];
unset($_SESSION['signup_form_data']);
$first_name = isset($formData['first_name']) ? htmlspecialchars($formData['first_name']) : '';
$last_name = isset($formData['last_name']) ? htmlspecialchars($formData['last_name']) : '';
$email = isset($formData['email']) ? htmlspecialchars($formData['email']) : '';


// Check for $_GET messages.
if (isset($_GET["msg"]))
{
    $msg = $_GET["msg"];
} else {
    $msg = NULL;
}

?>
<body>

<div class="flex flex-col items-center justify-center mt-[7rem]">
    <div class="bg-slate-50 drop-shadow-xl w-[22rem] h-full border-2 border-black p-4">

        <form action="/yourpet/src/handlers/signup_process.php" method="POST" class="userAuth">

            <p class="text-xl font-bold text-center underline">Sign Up</p>

            <div class="flex flex-col gap-4 mt-3">

                <span class="flex flex-col">
                    <label for="first_name">First Name</label>
                    <input type="text" id="first_name" name="first_name" placeholder="Your first name" value="<?=$first_name?>" required>
                </span>

                <span class="flex flex-col">
                    <label for="last_name">Last Name</label>
                    <input type="text" id="last_name" name="last_name" placeholder="Your last name" value="<?=$last_name?>" required>
                </span>

                <span class="flex flex-col">
                    <label for="email">Email </label>
                    <input type="email" id="email" name="email" placeholder="Your email address" value="<?=$email?>" required>
                    <?= $msg === "email-already-exists" ? "<p class='text-red-500'>Email already has an account linked.</p>" : "" ?>
                </span>

                <span class="flex flex-col">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" placeholder="Create a password" required>
                    <img src="/yourpet/src/assets/feather-icons/eye-off.svg" alt="Show Password" class="ml-auto mr-4 w-4 h-full -mt-6" id="togglePassword">
                    <?= $msg === "password-short" ? "<p class='text-red-500 mt-2'>Password too short. (5+ characters )</p>" : "" ?>
                </span>

            </div>

            <?=add_csrf(); ?>

            <button type="submit"
                class="bg-green-600 hover:bg-green-500 transition-colors duration-200 text-center w-full py-2 mt-8 mb-2 text-white font-semibold">
                Sign up
            </button>

            <p class="text-xs font-semibold text-center">Already have an account?<br>
                <a href="./login.php" class="text-blue-500 underline">Login here</a>
            </p>
        </form>

    </div>


</div>
<script src="/yourpet/src/js/main.js"></script>

</body>
</html>