<?php while ($row = $result->fetch_assoc()):?>
    <div class="usedPetCard">
        <span class="flex from-[#306060] to-[#bfd9d9] bg-gradient-to-tr h-16 items-center ">
            <?php if ($row["pet_type"] === "dog"): ?>
            <img src="/yourpet/src/assets/images/dog.jpg" class="bg-[#306060] bg-cover border-2 border-white mx-auto rounded-full w-16 h-16 -mb-16 object-cover">
            <?php else: ?>
            <img src="/yourpet/src/assets/images/cat.jpg" class="bg-[#306060] bg-cover border-2 border-white mx-auto rounded-full w-16 h-16 -mb-16 object-cover">
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