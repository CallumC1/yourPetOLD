<?php
include($_SERVER['DOCUMENT_ROOT'] . "/yourpet/src/components/admin_navbar.php");
require($_SERVER['DOCUMENT_ROOT'] . "/yourpet/src/handlers/get_user.php");
$user_data = get_user();
?>

<!-- Header imported from dashboard page. -->
<body>
    <h1 class="text-2xl font-semibold text-center my-3">Admin Dashboard</h1>
    <!-- Account Info -->
    <?php include($_SERVER['DOCUMENT_ROOT'] . "/yourpet/src/components/account_details.php");  ?>

<?php
    require_once($_SERVER['DOCUMENT_ROOT'] . "/yourpet/src/handlers/connect_db.php");
    $conn = connect_to_database();

    $sql = "SELECT pets.*, users.first_name, users.last_name
    FROM pets
    INNER JOIN users ON users.user_id = pets.FK_user_id ORDER BY pet_name LIMIT 10 OFFSET ?";

    // Check if the page value is valid.
    if (!isset($_GET['page']) || !is_int($_GET['page'])) {
        (int)$page = 0; 
    };

    $stmt = $conn->prepare($sql);

    $stmt->bind_param("i", $_GET['page']);
    $stmt->execute();
    $result = $stmt->get_result();

    $num_rows = mysqli_num_rows($result);
?>

<!-- Include pets table. -->
<?php include($_SERVER['DOCUMENT_ROOT'] . "/yourpet/src/components/pet_table_admin.php");?>

<?php
    $result->free_result();
?>


<!-- If user end up on invalid page. Give them an error and option to return to a valid page. -->
<?php if($num_rows == 0): ?>
    <p class="text-red-500 font-semibold text-center my-5">No Rows Found.</p>
    <div class="flex items-center justify-center">

        <a href="./dashboard.php?pages=0" class="font-semibold text-white bg-[#55878a] px-5 py-3 mx-auto">Go back</a>
    </div>
<?php else: ?>
    <div class="flex gap-3 justify-center mx-auto mt-4">
        <a href="./dashboard.php?page=<?php echo ($page <= 10) ? '0' : $_GET['page']-10; ?>" class="bg-[#55878a] px-3 py-1 rounded-sm">Prev</a>
        <!-- Needs check to see if there are any more pages -->
        <div class="bg-[#55878a] rounded-full w-1"></div>
        <a href="./dashboard.php?page=<?php echo ($num_rows < 10) ? $_GET['page'] : $_GET['page']+10; ?>" class="bg-[#55878a] px-3 py-1 rounded-sm">Next</a>
    </div>
<?php endif; ?>

<!-- If there is a msg set in the browser, create a modal popup.  -->
<?php
if (isset($_GET["msg"])): ?>
    <div class="fixed bottom-4 right-4 w-fit px-5 py-3 bg-slate-100 rounded-sm border-2 border-red-600 mx-auto mt-3 flex flex-col" id="modal">
        <!-- Display the message relating to the code in ?msg -->
        <p class="font-semibold text-md underline">Data Changed</p>
        <p class=" text-black">
            <?php if ($_GET["msg"] === "edit-success") echo("Successfully edited pet.") ?>
            <?php if ($_GET["msg"] === "delete-success") echo("Successfully deleted pet.") ?>
        </p>
        <button class="bg-red-600 ml-auto w-20 text-white font-semibold  mt-2 rounded-sm" id="modal-close">
            Close
        </button>
    </div>
<?php endif; ?>

<script>
    function clickHandler(){
        var modal = document.getElementById("modal");
        modal.style.display = "none";
    };

    var modalClose = document.getElementById("modal-close");
    modalClose.addEventListener("click", clickHandler)
</script>
</body>
</html>