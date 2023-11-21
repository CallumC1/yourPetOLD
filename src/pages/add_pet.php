<?php include($_SERVER['DOCUMENT_ROOT'] . "/yourpet/src/components/header.php"); ?>
<body>
    
</body>
</html>

<?php
session_start();
require($_SERVER['DOCUMENT_ROOT'] . "/yourpet/src/handlers/get_user.php");
$user_data = get_user();
?>

<form
    method="POST"
    action="./handlers/add_pet_process.php"
    class="border-2 border-black flex flex-col w-96 mx-auto mt-10 drop-shadow-lg">
    <div class="flex flex-col w-5/6 mx-auto pt-4">

        <span class="flex justify-between my-1">
            <label for="petName" class="text-black border-2 border-black bg-zinc-200 px-3">Pet Name:</label>
            <input type="text" name="petName" id="petName" class="inputFields" required>
        </span>
        
        <span class="flex justify-between my-1">
            <label for="petType" class="text-black border-2 border-black bg-zinc-200 px-3">Pet Type:</label>
            <select name="petType" id="petType" class="inputFields" required>
                <option value="dog">Dog</option>
                <option value="cat">Cat</option>
            </select>
        </span>

        <span class="flex justify-between my-1">
            <label for="petBreed" class="text-black border-2 border-black bg-zinc-200 px-3">Pet Breed:</label>
            <input type="text" name="petBreed" id="petBreed" class="inputFields" required>
        </span>
        
        <span class="flex justify-between my-1">
            <label for="petAge" class="text-black border-2 border-black bg-zinc-200 px-3">Pet Age:</label>
            <input type="number" name="petAge" id="petAge" class="inputFields" required>
    </div>
    </span>

    <button type="submit" class="w-full h-12 bg-[#1a4147] hover:bg-[#12323b] text-white font-semibold mt-2">Add Pet</button>
</form>