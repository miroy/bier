<?php
require_once "../common/settings.script.php";

// Get all the birthdays from the database.
$db = new mysqli($settings["db_server"], $settings["db_user"], $settings["db_password"], $settings["db_name"]);
$result = $db->query("select * from birthdays order by month, day, year");
$birthdays = $result->fetch_all(MYSQLI_ASSOC);