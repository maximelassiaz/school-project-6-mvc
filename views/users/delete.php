<?php
    $title = "GameXChange - Delete profile";
?>

<h1 class="text-center">Delete account</h1>

<div class="mx-auto w-50 mt-5 text-center">
    <form method="POST" class="p-3">
        <h2 class="text-center">Warning</h2>
        <p>Deleting your account is a permanent action and cannot be undone</p>
        <input type="hidden" name="user-id" value="<?= $_GET['id'] ?? "" ?>">
        <button class="btn danger" type="submit">Delete my account</button>
    </form>
</div>