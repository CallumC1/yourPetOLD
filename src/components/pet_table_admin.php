<table class="max-w-screen-2xl">
    <!-- <th>ID</th> -->
    <th>Owner Name</th>

    <th>Pet Name</th>
    <th>Pet Type</th>
    <th>Pet Breed</th>
    <th>Pet Age</th>
    <th>#</th>
    
    <?php while ($row = $result->fetch_array(MYSQLI_ASSOC)): ?>
    <tr>
        <!-- <td><?= $row["id"] ?></td> -->
        <td><?= htmlspecialchars($row["first_name"]) . " " . htmlspecialchars($row["last_name"]) ?></td>
        <td><?= htmlspecialchars($row["pet_name"]) ?></td>
        <td><?= htmlspecialchars($row["pet_type"]) ?></td>
        <td><?= htmlspecialchars($row["pet_breed"]) ?></td>
        <td><?= htmlspecialchars($row["pet_age"]) ?></td>
        <td><a href="/yourpet/src/pages/edit_pet.php?pet_id=<?= $row['pet_id']; ?>" class="bg-[#163840] px-3 py-1 rounded-sm text-white">Edit</a></td>
    </tr>
    <?php endwhile; ?>
</table>