<?php
    require_once "edit.script.php";
    require_once "../common/months.script.php";
    include "../common/header.php";
?>

<h1><?= $birthday["person"] ?></h1>

<form method="post">
    <p>
        <label for="person">Persoon:</label>
        <input type="text" id="person" name="person" value="<?= $birthday["person"] ?>">
    </p>
    
    <p>
        <label for="day">Datum:</label>
        <select name="day">
            <?php for ($day = 1; $day <= 31; $day++) { ?>
                <option <?php if ($day == $birthday["day"]) { echo "selected"; } ?>><?= $day ?></option>
            <?php } ?>
        </select>
        
        <select name="month">
            <?php for ($month = 1; $month <= 12; $month++) { ?>
                <option value="<?= $month ?>" <?php if ($month == $birthday["month"]) { echo "selected"; } ?>><?= $months[$month] ?></option>
            <?php } ?>
        </select>
        
        <select name="year">
            <?php for ($year = date("Y"); $year > 1900; $year--) { ?>
                <option <?php if ($year == $birthday["year"]) { echo "selected"; } ?>><?= $year ?></option>
            <?php } ?>
        <select>
    </p>
    
    <p>
        <input type="submit" value="Opslaan">
    </p>
</form>

<?php
    include "../common/footer.php";
?>