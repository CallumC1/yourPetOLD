<?php
// include($_SERVER['DOCUMENT_ROOT'] . "/yourpet/src/components/admin_navbar.php");
require($_SERVER['DOCUMENT_ROOT'] . "/yourpet/src/handlers/get_user.php");
$user_data = get_user();
?>

<!-- Header imported from dashboard page. -->
<body>
    <h1 class="text-2xl font-semibold text-center my-3">Admin Dashboard</h1>
    <!-- Account Info -->
    <?php include($_SERVER['DOCUMENT_ROOT'] . "/yourpet/src/components/account_details.php");  ?>

<form
    method="POST"
    class="flex flex-col w-96 mx-auto my-6 drop-shadow-lg">
    <div class="flex flex-col w-5/6 mx-auto pt-4 gap-y-1">
        <span class="flex gap-3 ">
            <p>Search from: </p>
            <select name="search_type" required>
                <option value="user_name" <?= isset($_POST["search_type"]) && ($_POST["search_type"] === "user_name") ? "selected" : "" ; ?>>Owner Name</option>
                <option value="pet_name" <?= isset($_POST["search_type"]) && ($_POST["search_type"] === "pet_name") ? "selected" : "" ; ?>>Pet Name</option>
                <option value="pet_age" <?= isset($_POST["search_type"]) && ($_POST["search_type"] === "pet_age") ? "selected" : "" ; ?>>Pet Age</option>
            </select>
        </span>

        <label for="search" class="text-black border-2 border-black bg-zinc-200 px-3">Search for:</label>
        <input type="text" name="search" id="search" value="<?= isset($_POST["search"]) ? $_POST["search"] : "" ; ?>" class="border-2 border-black">
        <input type="submit" value="Search" class="bg-[#1a4147] font-semibold mb-4 text-white">
    </div>
</form>

<?php

require_once($_SERVER['DOCUMENT_ROOT'] . "/yourpet/src/handlers/connect_db.php");
$conn = connect_to_database();

// Check if the page value is valid.
if (!isset($_GET['page']) || !is_int($_GET['page'])) {
    (int)$page = 0; 
};

function search_table($conn){
    $sql_start = "SELECT pets.*, users.first_name, users.last_name
    FROM pets
    INNER JOIN users ON users.user_id = pets.FK_user_id";

    // Apply filters to sql
    switch ($_POST["search_type"]) {
        case "user_name":
            $where = "WHERE users.first_name LIKE ?";
            break;
        case "pet_name":
            $where = "WHERE pet_name LIKE ?";
            break;
        case "pet_age":
            $where = "WHERE pet_age LIKE ?";
            break;
    }

    $sql_end = "ORDER BY pet_name LIMIT 10 OFFSET ?";

    $sql = $sql_start . " " . $where . " " . $sql_end;
    $stmt = $conn->prepare($sql);
    
    $searchPatterns = ["{$_POST['search']}%", "%{$_POST['search']}%" ];
        
    foreach ($searchPatterns as $search) {
        $stmt->bind_param("si", $search, $page);
        $stmt->execute();
        $result = $stmt->get_result();
    
        if ($result->num_rows > 0) {
            return $result;
        }
    }
    // If no results are found after both searches
    echo("<p class='text-center text-red-500 font-semibold mt-3'>No Results Found</p>");
    exit();
};

if (isset($_POST["search"])) {
    $result = search_table($conn);
} else {
    $sql = "SELECT pets.*, users.first_name, users.last_name
    FROM pets
    INNER JOIN users ON users.user_id = pets.FK_user_id ORDER BY pet_name LIMIT 10 OFFSET ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $_GET['page']);
    $stmt->execute();
    $result = $stmt->get_result();

}

    $num_rows = mysqli_num_rows($result);
?>

<?php 
// Include pets table.
include($_SERVER['DOCUMENT_ROOT'] . "/yourpet/src/components/pet_table_admin.php");
$result->free_result();

// Include Pagination Button
include($_SERVER['DOCUMENT_ROOT'] . "/yourpet/src/components/pagination.php");
?>


<!-- Modal Popup  -->
<?php
if (isset($_GET["msg"])): ?>
    <div class="fixed bottom-4 right-4 w-fit px-5 py-3 bg-slate-100 rounded-sm border-2 border-red-600 mx-auto mt-3 flex flex-col" id="modal">
        <!-- Display the message relating to the code in ?msg -->
        <p class="font-semibold text-md underline">Data Changed</p>
        <p class=" text-black">
            <?php if ($_GET["msg"] === "edit-pet-success") echo("Successfully edited pet.") ?>
            <?php if ($_GET["msg"] === "delete-pet-success") echo("Successfully deleted pet.") ?>
        </p>
        <button class="bg-red-600 ml-auto w-20 text-white font-semibold  mt-2 rounded-sm" id="modal-close">
            Close
        </button>
    </div>
<?php endif; ?>

<div class="mb-10"></div>

<!-- Close Modal Script -->
<script src="/yourpet/src/js/modal.js"></script>
</body>
</html>