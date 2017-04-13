<?php require "includes/system.php";

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Home</title>
    <link rel="stylesheet" type="text/css" href="css/main.css"/>
    <script  src="js/jquery.js" ></script>
    <script  src="js/slick.min.js" ></script>
    <script  src="js/jquery.plugin.js" ></script>
    <script  src="js/jquery.datepick.js" ></script>
    <script  src="js/mine.js" ></script>
</head>
<body>
<header>
    <h2 class="icon-books-arranged">Library Management System</h2>
    <nav>
        <a href="index.php"><span class="icon-home"></span></a>
        <a href="search.php" class="icon-search">Find Books</a>
        <a href="book.php" class="icon-calendar">Borrow a Book</a>
        <?php
        if(isset($_SESSION['id']) && $_SESSION['role']=='admin') {
            ?>
            <a href="books.php" class="icon-books">Add books</a>
            <a href="users.php" class="icon-users">Add Users</a>

            <?php
        }
        if(isset($_SESSION['fullname'])){

            echo "<a href='logout.php' class='icon-logout' >Logout</a>";
            echo "<span href='index.php' class='icon-me' style='float: right'>{$_SESSION['fullname']}</span>";
        }
        ?>

        </a>
    </nav>
</header>