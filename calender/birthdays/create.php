<?php
    require_once "create.script.php";
    require_once "../common/months.script.php";
    include "../common/header.php";
?>

<h1>Nieuwe verjaardag</h1>

<form method="post">
    <p>
        <label for="person">Persoon:</label>
        <input type="text" id="person" name="person">
    </p>
    
    <p>
        <label for="day">Datum:</label>
        <select name="day">
            <?php for ($day = 1; $day <= 31; $day++) { ?>
                <option><?= $day ?></option>
            <?php } ?>
        </select>
        
        <select name="month">
            <?php for ($month = 1; $month <= 12; $month++) { ?>
                <option value="<?= $month ?>"><?= $months[$month] ?></option>
            <?php } ?>
        </select>
        
        <select name="year">
            <?php for ($year = date("Y"); $year > 1900; $year--) { ?>
                <option><?= $year ?></option>
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