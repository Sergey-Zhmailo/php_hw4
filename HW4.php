<?php
// header
require_once 'header.php';

// DB CONNECT
define('HOST', 'localhost');
define('USER', 'root');
define('PASSWORD', '');
define('DATABASE', 'php_course_test');

$connect = mysqli_connect(HOST, USER, PASSWORD, DATABASE);

// ADD ITEMS TO DB
/*
for ($i = 1; $i <= 56; $i++) {
    $ins = "INSERT INTO users SET user_name='Login".$i."', user_password='pass".$i."'";
    mysqli_query($connect, $ins);
}*/

// NUMBER OF RECORDS IN THE TABLE
$count_query = mysqli_fetch_assoc(mysqli_query($connect, "SELECT COUNT(*) AS total_records FROM users"));
$count_records = $count_query['total_records'];

// PAGES COUNT
$items_per_page = 10;
$total_pages = ceil($count_records / $items_per_page);
?>
<!--content block-->
<div class="row">
    <ul class="collection">
<?php

// GET PAGINATION CURRENT PAGE
if (empty($_GET['page'])) {
    $current_page = 0;
} else {
    $current_page = ($_GET['page'] - 1) * 10;
}

// SHOW DATA
$sql = "SELECT * FROM users ORDER BY id DESC LIMIT " . $current_page . ", 10";
$query = mysqli_query($connect, $sql);
while ($result[] = mysqli_fetch_assoc($query)) {
    $users_data = $result;
}
foreach ($users_data as $user) {
    echo '<li class="collection-item">#' . $user['id'] . ' - Login: ' . $user['user_name'] . ' / Password: ' . $user['user_password'] . '</li>';
}
?>
    </ul>
</div>
<!-- / content block-->
<!--    pagination-wrapper-->
<div class="row center-align pagination-wrapper">
<?php

// CREATE PAGINATION LINKS
for ($i = 1; $i <= $total_pages; $i++) {
    echo '<a class="btn light-blue darken-4" href="/HW4.php?page=' . $i . '">' . $i . '</a>';
}
?>
</div>
<!--    / pagination-wrapper-->
<?php
// footer
require_once 'footer.php';
?>