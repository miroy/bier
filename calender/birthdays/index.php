<?php
    require_once "index.script.php";
    require_once "../common/months.script.php";
    include "../common/header.php";
?>

<?php
    $lastMonth = 0;  // used to make sure we print month names only once
    
    foreach ($birthdays as $birthday) {
        // Print the name of the month, but only if we haven't already.
        if ($birthday["month"] > $lastMonth) {
            $lastMonth = $birthday["month"];
            $lastDay = 0;  // used to make sure we print day numbers only once per month
?>
            <h1><?= $months[$birthday["month"]] ?></h1>
<?php
        }
        
        // Print the number of the day, but only if we haven't already in the current month.
        if ($birthday["day"] > $lastDay) {
            $lastDay = $birthday["day"];
?>
            <h2><?= $birthday["day"] ?></h2>
<?php
        }
?>
        <p>
            <a href="edit.php?id=<?= $birthday["id"] ?>">
                <?= $birthday["person"] ?>
                (<?= $birthday["year"] ?>)</a>
                
            <a href="delete.php?id=<?= $birthday["id"] ?>">x</a>
        </p>
<?php
    }
?>

<p><a href="create.php">+ Toevoegen</a></p>

<?php
    include "../common/footer.php";
?>