<!-- Account Info -->
<div class="flex flex-col items-center bg-[#306060] w-full px-2 border-y-2 text-white">
    <p class="text-center text-xl font-semibold">Your Details</p>
    <div class="flex flex-col sm:flex-row gap-5 font-semibold justify-center">
        <p>First Name: <?=  htmlspecialchars($user_data["first_name"]); ?></p>
        <p>Last Name: <?= htmlspecialchars($user_data["last_name"]); ?></p>
        <p>Email: <?= htmlspecialchars($user_data["email"]); ?></p>
    </div>
    <a href="/yourpet/src/handlers/sign_out.php" class="px-1 py-1 text-center text-white underline">Sign Out</a>
</div>