<?php while ($row = $result->fetch_assoc()):?>
    <div class="usedPetCard">
        <span class="flex from-[#306060] to-[#bfd9d9] bg-gradient-to-tr h-16 items-center ">
            <?php if ($row["pet_type"] === "dog"): ?>
                <a 
                href=""
                class="flex bg-[#306060] border-2 border-white mx-auto rounded-full w-16 h-16 -mb-16 cursor-pointer">
                    <img src="/yourpet/src/assets/feather-icons/camera.svg" class="w-1/2 h-1/2 object-cover m-auto">
                </a>
            <?php else: ?>
                <img src="<?= select_random('cat') ?>" class="bg-[#306060] bg-cover border-2 border-white mx-auto rounded-full w-16 h-16 -mb-16 object-cover">
            <?php endif; ?>
            
        </span>

        <div class="px-7 mt-10 text-xs">
            <span class="flex items-center justify-center gap-3">
                <p class="text-lg font-semibold"><?= $row["pet_name"] ?></p>
                <p>•</p>
                <p class="font-semibold">Age <?= $row["pet_age"] ?></p>
            </span>
            <p class="font-semibold text-center"><?= $row["pet_type"] ?></p>
            <p class="font-semibold text-center"><?= $row["pet_breed"] ?></p>                
        </div>

            <!-- Action Buttons -->
        <div class="flex flex-col gap-2 w-4/5 mx-auto mt-auto mb-3">
            <p class="text-xs">Edit the details of your pet below:</p>
            <a href="/yourpet/src/pages/edit_pet.php?pet_id=<?= $row['pet_id']; ?>" class="bg-[#306060] text-white w-full py-1 text-center rounded-md">Edit Pet</a>
        </div>
    </div>
<?php endwhile; ?>


<?php

function select_random($type){
    if ($type === "cat") {

        $photos = [
            "/yourpet/src/assets/images/cats/cat1.jpg",
            "/yourpet/src/assets/images/cats/cat2.jpg",
            "/yourpet/src/assets/images/cats/cat3.jpg",
            "/yourpet/src/assets/images/cats/cat4.jpg",
            "/yourpet/src/assets/images/cats/cat5.jpg",
            "/yourpet/src/assets/images/cats/cat6.jpg",
            "/yourpet/src/assets/images/cats/cat7.jpg",
            "/yourpet/src/assets/images/cats/cat8.jpg",
        ];
    
    } else {
        $photos = [
            "/yourpet/src/assets/images/dogs/dog1.jpg",
            "/yourpet/src/assets/images/dogs/dog2.jpg",
            "/yourpet/src/assets/images/dogs/dog3.jpg",
            "/yourpet/src/assets/images/dogs/dog4.jpg",
            "/yourpet/src/assets/images/dogs/dog5.jpg",
            "/yourpet/src/assets/images/dogs/dog6.jpg",
            "/yourpet/src/assets/images/dogs/dog7.jpg",
            "/yourpet/src/assets/images/dogs/dog8.jpg",
        ];
    }

    // Select a random index from the array
    $random_index = array_rand($photos);
    $random_photo = $photos[$random_index];

    return $random_photo;

}

?>