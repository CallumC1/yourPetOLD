<!-- If user end up on invalid page. Give them an error and option to return to a valid page. -->
<?php if($num_rows == 0): ?>
    <p class="text-red-500 font-semibold text-center my-5">No Rows Found.</p>
    <div class="flex items-center justify-center">
        <a href="./dashboard.php?pages=0" class="font-semibold text-white bg-[#55878a] px-5 py-3 mx-auto">Go back</a>
    </div>
<?php else: ?>
    <div class="flex gap-3 justify-center mx-auto mt-4">
        <a href="./dashboard.php?page=<?php echo ($page <= 10) ? '0' : $page-10; ?>" class="bg-[#55878a] px-3 py-1 rounded-sm">Prev</a>
        <!-- Needs check to see if there are any more pages -->
        <div class="bg-[#55878a] rounded-full w-1"></div>
        <a href="./dashboard.php?page=<?php echo ($num_rows < 10) ? $_GET["page"] : $page+10; ?>" class="bg-[#55878a] px-3 py-1 rounded-sm">Next</a>
    </div>
<?php endif; ?>