<?php 
session_start();
include($_SERVER['DOCUMENT_ROOT'] . "/yourpet/src/components/header.php");
?>
<body>
    
</body>
</html>

<?php

require($_SERVER['DOCUMENT_ROOT'] . "/yourpet/src/handlers/get_user.php");
require($_SERVER['DOCUMENT_ROOT'] . "/yourpet/src/handlers/get_pet.php");

$user_data = get_user();

$pet = get_pet_by_id($_GET["pet_id"]);

// Check user owns the pet.
$user_id = $user_data["user_id"];
$pet_user_id = $pet["FK_user_id"];

if (!($user_id === $pet_user_id) && ($user_data["user_roles"] != "admin")) {
    die("You do not own this pet.");
}


?>

<form
    method="POST"
    action="/yourpet/src/handlers/edit_pet_process.php"
    class="border-2 border-black flex flex-col w-96 mx-auto mt-10 drop-shadow-lg">
    <div class="flex flex-col w-5/6 mx-auto pt-4">

        <span class="flex justify-between my-1">
            <label for="pet_name" class="text-black border-2 border-black bg-zinc-200 px-3">Pet Name:</label>
            <input type="text" name="pet_name" id="pet_name" value="<?= $pet['pet_name'] ?>" class="inputFields" required>
        </span>
        
        <span class="flex justify-between my-1">
            <label for="pet_type" class="text-black border-2 border-black bg-zinc-200 px-3">Pet Type:</label>
            <select name="pet_type" id="pet_type" class="inputFields" required>
                <option value="dog" <?= $pet['pet_type'] === 'dog' ? "selected": "" ?>>Dog</option>
                <option value="cat" <?= $pet['pet_type'] === 'cat' ? "selected": "" ?>>Cat</option>
            </select>
        </span>

        <span class="flex justify-between my-1">
            <label for="pet_breed" class="text-black border-2 border-black bg-zinc-200 px-3">Pet Breed:</label>
            <input type="text" name="pet_breed" id="pet_breed" value="<?= $pet['pet_breed'] ?>" class="inputFields" required>
        </span>
        
        <span class="flex justify-between my-1">
            <label for="pet_age" class="text-black border-2 border-black bg-zinc-200 px-3">Pet Age:</label>
            <input type="number" name="pet_age" id="pet_age" value="<?= $pet['pet_age'] ?>" class="inputFields" required>
        </span>
    </div>
    <input type="hidden" name="pet_id" id="pet_id" value="<?= $_GET["pet_id"] ?>" required>


    <button type="submit" class="w-full h-12 bg-[#1a4147] hover:bg-[#12323b] text-white font-semibold mt-2">Edit Pet</button>
</form>

<!-- Delete Pet -->
<a href="/yourpet/src/handlers/delete_pet_process.php?pet_id=<?=$pet["pet_id"]?>" class="border-2 bg-red-700 border-black flex flex-col w-96 mx-auto mt-10 drop-shadow-lg items-center text-white font-semibold">Delete <?=$pet["pet_name"]?>?</a>