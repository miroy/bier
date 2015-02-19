<?php
    require_once "delete.script.php";
    require_once "../common/months.script.php";
    include "../common/header.php";
?>

<h1>Verjaardag verwijderen</h1>
 
<form method="post">
    <p>Weet je zeker dat je de verjaardag van <?= $birthday["person"] ?> op <?= $birthday["day"] ?> <?= $months[$birthday["month"]] ?> wilt verwijderen?</p>
    <p>
        <input type="submit" value="Ja" name="confirmed">
        <input type="submit" value="Nee">
    </p>
</form>

<?php
    include "../common/footer.php";
?>