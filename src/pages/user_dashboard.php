<!-- Header imported from dashboard page. -->

<?php
require($_SERVER['DOCUMENT_ROOT'] . "/yourpet/src/handlers/get_user.php");
$user_data = get_user();


?>
<body>
    <!-- Account Info -->
    <?php include($_SERVER['DOCUMENT_ROOT'] . "/yourpet/src/components/account_details.php");  ?>

    <!-- Manage Pets -->

    <h1 class="text-2xl font-semibold text-center">Manage your pets</h1>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 justify-center items-center gap-5 my-10">

        <!-- Loop through a users pets and add the below card to every pet. -->
        
        <?php  
            $result = get_user_pets();
            include($_SERVER['DOCUMENT_ROOT'] . "/yourpet/src/components/user_pet_cards.php");
        ?>

        <!-- AddPetCard -->
        <a href="/yourpet/src/pages/add_pet.php" class="addPetCard">
            <img src="/yourpet/src/assets/feather-icons/plus-circle.svg" alt="Add pet icon." class="bg-[#306060] rounded-full p-4 w-16 h-16">
        </a>

    </div>
</body>
</html>