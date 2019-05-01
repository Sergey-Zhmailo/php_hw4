<?php

    require_once 'header.php';
?>

            <h6>БД. Подключение БД. Запросы к БД.</h6>
            <hr>
<?php
            /*
            define('QW', 123); // создание константы
            echo QW;
            define('QW', 456);
            echo QW;
            */

            define('HOST', 'localhost');
            define('USER', 'root');
            define('PASSWORD', '');
            define('DATABASE', 'php_course_test');

//            $dbh = mysql_connect(HOST, USER, PASSWORD) or die ('error');
//            mysql_select_db(DATABASE) or die ('error2');

            $connect = mysqli_connect(HOST, USER, PASSWORD, DATABASE);

            // Получение данных
            $sql = "SELECT * FROM users"; // для запросов двойные кавычки!
            $query = mysqli_query($connect, $sql);
            while ($res[] = mysqli_fetch_assoc($query)) {
                $users = $res;
            }

//            foreach ($users as $user) {
//                echo 'Имя: ' . $user['user_name'] . ', Пароль: ' . $user['user_password'] . '<br/>';
//            }


            // количество записей в таблице
            $res = mysqli_fetch_assoc(mysqli_query($connect, "SELECT COUNT(*) AS kol FROM users"));
            echo $res['kol'] . '<br/>';


            // Запись данных
            $sql2 = "INSERT INTO users SET user_name='Vanya', user_password='qweerty'";
//            mysqli_query($connect, $sql2);

            // Обновление данных
            $sql3 = "UPDATE users SET password='xxxxxx' WHERE username='Vanya'";
//            mysqli_query($connect, $sql3 );

            // Удаление данных
            $sql4 = "DELETE FROM users WHERE user_id=11";
//            mysqli_query($connect, $sql4);

            // Массовое наполнение таблицы

            /*
            for ($i = 1; $i <= 50; $i++) {
                $ins = "INSERT INTO users SET user_name='Login".$i."', user_password='pass".$i."'";
                mysqli_query($connect, $ins);
            }
            */


            // Страницы пагинации

            $page = 6;
            for ($i = 1; $i <= $page; $i++) {
                echo '<a href="/index.php?page='. $i. '">' . $i . '</a>';
            }
            echo '<br/>';

            // Псевдоним
           /*
            $sql5 = "SELECT u.user_name, u.user_password FROM users u ORDER BY u.id DESC"; //ASC
            $query5 = mysqli_query($connect, $sql5);
            while ($res5[] = mysqli_fetch_assoc($query5)) {
                $users5 = $res5;
            }
            foreach ($users5 as $user5) {
                echo 'Name: ' . $user5['user_name'] . '. Password: ' . $user5['user_password'] . '<br/>';
            }
            */


            // Лимит
            if (empty($_GET['page'])) {
                $page = 0;
            } else {
                $page = ($_GET['page'] - 1) * 10;
            }

            $sql5 = "SELECT u.user_name, u.user_password FROM users u ORDER BY u.id DESC LIMIT " . $page .", 10"; //  с какой позиции сколько запсей
            $query5 = mysqli_query($connect, $sql5);
            while ($res5[] = mysqli_fetch_assoc($query5)) {
                $users5 = $res5;
            }
            foreach ($users5 as $user5) {
                echo 'Name: ' . $user5['user_name'] . '. Password: ' . $user5['user_password'] . '<br/>';
            }

            // Условия AND OR
/*
            echo '<hr>';
            $sql6 = "SELECT * FROM users WHERE id = 10 OR id = 30";
            $query6 = mysqli_query($connect, $sql6);
            while ($res6[] = mysqli_fetch_assoc($query6)) {
                $users6 = $res6;
            }
            foreach ($users6 as $user6) {
                echo 'id: ' . $user6['id'] . '. Name: ' . $user6['user_name'] . 'Password: ' . $user6['user_password'] . '<br/>';
            }*/

// Получение одного значения
/*$sql7 = "SELECT * FROM users WHERE id=1";
$query7 = mysqli_query($connect, $sql7);
$user7 = mysqli_fetch_assoc($query7);
echo $user7['user_name'];*/

// Join

$sql8 = "SELECT * FROM users u LEFT JOIN users_info ui ON(u.id=ui.id)";
$query8 = mysqli_query($connect, $sql8);
while ($res8[] = mysqli_fetch_assoc($query8)) {
    $users8 = $res8;
}
foreach ($users8 as $user8) {
    echo 'id: ' . $user8['id'] . '. Name: ' . $user8['user_name'] . 'Password: ' . $user8['user_password'] . 'tel: ' . $user8['tel'] . '<br/>';
}

// ========================= PREPARE ======
/*
// Prepare
define('HOST', '127.0.0.1');
define('USER', 'root');
define('PASSWORD', '');
define('DATABASE', 'php_course_test');

$connect = new mysqli(HOST, USER, PASSWORD, DATABASE); // иницилизируем подключение к бд

// Check connection
if ($connect->connect_error) {
    die("Connection failed: " . $connect->connect_error);
}
$input_value = 'Vanya'; // значение из формы
$sql = "SELECT * FROM users WHERE user_name= ? "; // объявляем переменную с запросом
$stmt = $connect -> prepare($sql); // подготавливаем наш запрос
$stmt -> bind_param('s', $input_value); // присваеваем первому ? в запросе параметр с типом данных s (string)
$stmt->execute(); // выполняем подготовленный запрос
$result = $stmt -> get_result(); // получаем результат из подготовленного запроса

while ($res[] = mysqli_fetch_assoc($result)) {
    $users = $res;
}
foreach ($users as $user) {
    echo 'Имя: ' . $user['user_name'] . ', Пароль: ' . $user['user_password'] . '<br/>';
}
$result->free(); // очищаем результат
$stmt->close(); // закрываем подготовленный запрос
$connect->close(); // закрываем подключение
*/




            // footer
            require_once 'footer.php';
            ?>

<!--
         arg = (page - 1) * limit
            page=1 0-6
            page=1 7-13
            page=1 14-20-->