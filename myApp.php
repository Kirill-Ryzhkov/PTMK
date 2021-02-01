<?php
define('__ROOT__', dirname(__FILE__));
require_once(__ROOT__ . '/dbconn.php');

if ($argv[1] == 1) {

    $create_db = "CREATE DATABASE PTMKtest";
    $use_my_db = "USE PTMKtest";
    $create_table = "
	CREATE TABLE users 
	(
		Id INT AUTO_INCREMENT PRIMARY KEY,
		Full_name VARCHAR(100),
		Birth_date DATE,
		Gender VARCHAR(10)
	)
";
    $create_db_status = $link->query($create_db);
    $use_my_db_status = $link->query($use_my_db);
    $create_table_status = $link->query($create_table);

    if ($create_db_status) {
        echo "Создать бд: Успешно\t\n";
    } else {
        echo "Создать бд: Упс..\t\n";
    }

    if ($use_my_db_status) {
        echo "Использовать PTMKtest: Успешно\t\n";
    } else {
        echo "Использовать PTMKtest: Упс..\t\n";
    }

    if ($create_table_status) {
        echo "Создать таблицу в бд: Успешно\t\n";
    } else {
        echo "Создать таблицу в бд: Упс..\t\n";
    }

}
elseif ($argv[1] == 2) {

    $use_my_db = "USE PTMKtest";
    $full_name = $argv[2] . " " . $argv[3] . " " . $argv[4];
    $new_recording = "
	INSERT INTO `users` (Id, Full_name, Birth_date, Gender)
	VALUES (null, \"$full_name\", \"$argv[5]\", \"$argv[6]\");
";
    $use_my_db_status = $link->query($use_my_db);
    $new_recording_status = $link->query($new_recording);

    if ($use_my_db_status) {
        echo "Использовать PTMKtest: Успешно\t\n";
    } else {
        echo "Использовать PTMKtest: Упс..\t\n";
    }

    if ($new_recording_status) {
        echo "Создать новую запись в бд: Успешно\t\n";
    } else {
        echo "Создать новую запись в бд: Упс..\t\n";
    }


}
elseif ($argv[1] == 3) {

    define('__ROOT__', dirname(__FILE__));
    require_once(__ROOT__ . '/dbconn.php');

    $use_my_db = "USE PTMKtest";
    $taken_sorted_data = "
        SELECT * FROM users GROUP BY Full_name, Birth_date
        ORDER BY Full_name;
    ";

    $use_my_db_status = $link->query($use_my_db);
    $taken_sorted_data_status = $link->query($taken_sorted_data);

    if ($use_my_db_status) {
        echo "Использовать PTMKtest: Успешно\t\n";
    } else {
        echo "Использовать PTMKtest: Упс..\t\n";
    }

    if ($taken_sorted_data_status) {
        echo "Взять уникальные значения: Успешно\t\n";

        while ($row = mysqli_fetch_row($taken_sorted_data_status)) {
            echo "Full name: {$row[1]}\t Birthday: {$row[2]}\t Gender: {$row[3]}\r\n";
        }

    } else {
        echo "Взять уникальные значения: Упс..\t\n";
    }
}
else{
    echo "Неправильный запуск программы! Правильно: 1 задание - php myApp.php 1";
}

mysqli_close($link);