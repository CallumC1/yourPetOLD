<!-- Header imported from dashboard page. -->

<?php
require($_SERVER['DOCUMENT_ROOT'] . "/yourpet/src/handlers/get_user.php");
$user_data = get_user();

?>
<body>
    <!-- Account Info -->
    <div class="flex flex-col items-center bg-[#306060] w-full px-2 border-y-2 text-white">
        <p class="text-center text-xl font-semibold">Your Details</p>
        <div class="flex flex-col sm:flex-row gap-5 font-semibold justify-center">
            <p>First Name: <?= $user_data["first_name"]; ?></p>
            <p>Last Name: <?= $user_data["last_name"]; ?></p>
            <p>Email: <?= $user_data["email"]; ?></p>
        </div>
        <a href="/yourpet/src/handlers/sign_out.php" class="px-1 py-1 text-center text-white underline">Sign Out</a>
    </div>

    <!-- Manage Pets -->

    <h1 class="text-2xl font-semibold text-center">Manage your pets</h1>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 justify-center items-center gap-5 my-10">


        
        <!-- Card -->
        <div class="usedPetCard">
            <span class="flex from-[#306060] to-[#bfd9d9] bg-gradient-to-tr h-16 items-center ">
                <img src="/yourpet/src/assets/images/dog.jpg" class="bg-[#306060] bg-cover border-2 border-white mx-auto rounded-full w-16 h-16 -mb-16 object-fill">
            </span>

            <div class="px-7 mt-10 text-xs">
                <span class="flex items-center justify-center gap-3">
                    <p class="text-lg font-semibold">Bruce</p>
                    <p>•</p>
                    <p class="font-semibold">Age 3</p>
                </span>
                <p class="font-semibold text-center">Dog</p>
                <p class="font-semibold text-center">Golden Retriever</p>                
            </div>

                <!-- Action Buttons -->
            <div class="flex flex-col gap-2 w-4/5 mx-auto mt-auto mb-3">
                <p class="text-xs">Edit the details of your pet below:</p>
                <a href="PHP HERE" class="bg-[#306060] text-white w-full py-1 text-center rounded-md">Edit Pet</a>
            </div>
        </div>

        <!-- AddPetCard -->
        <div class="addPetCard">
            <img src="/yourpet/src/assets/feather-icons/plus-circle.svg" alt="Add pet icon." class="bg-[#306060] rounded-full p-4 w-16 h-16">
        </div>
        <div class="addPetCard">
            <img src="/yourpet/src/assets/feather-icons/plus-circle.svg" alt="Add pet icon." class="bg-[#306060] rounded-full p-4 w-16 h-16">
        </div>

    </div>
</body>
</html>