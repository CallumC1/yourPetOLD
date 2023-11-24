<?php 
session_start();
include($_SERVER['DOCUMENT_ROOT'] . "/yourpet/src/components/header.php");

require($_SERVER['DOCUMENT_ROOT'] . "/yourpet/src/handlers/get_user.php");
$user_data = get_user();
?>

<form
    method="POST"
    action="/yourpet/src/handlers/add_pet_process.php"
    enctype="multipart/form-data"
    class="border-2 border-black flex flex-col w-96 mx-auto mt-10 drop-shadow-lg">
    <div class="flex flex-col w-5/6 mx-auto pt-4">

        <span class="flex justify-between my-1">
            <label for="pet_name" class="text-black border-2 border-black bg-zinc-200 px-3">Pet Name:</label>
            <input type="text" name="pet_name" id="pet_name" class="inputFields" required>
        </span>
        
        <span class="flex justify-between my-1">
            <label for="pet_type" class="text-black border-2 border-black bg-zinc-200 px-3">Pet Type:</label>
            <select name="pet_type" id="pet_type" class="inputFields" required>
                <option value="dog">Dog</option>
                <option value="cat">Cat</option>
            </select>
        </span>

        <span class="flex justify-between my-1">
            <label for="pet_breed" class="text-black border-2 border-black bg-zinc-200 px-3">Pet Breed:</label>
            <input type="text" name="pet_breed" id="pet_breed" class="inputFields" required>
        </span>
        
        <span class="flex justify-between my-1">
            <label for="pet_age" class="text-black border-2 border-black bg-zinc-200 px-3">Pet Age:</label>
            <input type="number" name="pet_age" id="pet_age" max="18" class="inputFields" required>
        </span>
    </div>

    <button type="submit" class="w-full h-12 bg-[#1a4147] hover:bg-[#12323b] text-white font-semibold mt-2">Add Pet</button>
</form>

</body>
</html>