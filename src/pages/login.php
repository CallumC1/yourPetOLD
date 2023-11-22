<?php
session_start();
include("../components/header.php");
include("../handlers/generate_csrf.php"); ?>

<?php
// Session already started in generate_csrf.php
session_regenerate_id();
generate_csrf();


// Used to keep data in table upon redirect.
$formData = isset($_SESSION['login_form_data']) ? $_SESSION['login_form_data'] : [];
unset($_SESSION['login_form_data']);
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
<div class="flex flex-col items-center justify-center mt-[7rem]">
    <div class="bg-slate-50 drop-shadow-xl w-[22rem] h-full border-2 border-black p-4">

        <form action="/yourpet/src/handlers/login_process.php" method="POST" class="userAuth">

            <p class="text-xl font-bold text-center underline">Login</p>

            <div class="flex flex-col gap-4 mt-3">

                <span class="flex flex-col">
                    <label for="email">Email </label>
                    <input type="email" id="email" name="email" placeholder="Your email address" value="<?=$email?>" required>
                    <?= $msg === "invalid-user" ? "<p class='text-red-500'>Account with email does not exist.</p>" : "" ?>
                </span>

                <span class="flex flex-col">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" placeholder="Your password" required>
                    <img src="/yourpet/src/assets/feather-icons/eye-off.svg" alt="Show Password" class="ml-auto mr-4 w-4 h-full -mt-6" id="togglePassword">
                    <?= $msg === "invalid-password" ? "<p class='text-red-500 mt-2'>Password incorrect.</p>" : "" ?>
                </span>

            </div>

            <?=add_csrf(); ?>
            <button type="submit"
                class="bg-green-600 hover:bg-green-500 transition-colors duration-200 text-center w-full py-2 mt-8 mb-2 text-white font-semibold">
                Login
            </button>

            <p class="text-xs font-semibold text-center">Don't have an account?<br>
                <a href="./signup.php" class="text-blue-500 underline">Sign up here</a>
            </p>
        </form>

    </div>

    

</div>

<script src="/yourpet/src/js/main.js"></script>

</body>
</html>