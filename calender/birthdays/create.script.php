<?php
require_once "../common/settings.script.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Add the new birthday to the database.
    $db = new mysqli($settings["db_server"], $settings["db_user"], $settings["db_password"], $settings["db_name"]);
    $person = $db->escape_string($_POST["person"]);
    $day = $db->escape_string($_POST["day"]);
    $month = $db->escape_string($_POST["month"]);
    $year = $db->escape_string($_POST["year"]);

    $db->query("insert into birthdays(person, day, month, year) values ('$person', '$day', '$month', '$year')");

    // Tell the browser to go back to the index page.
    header("Location: ./");
    exit();
}