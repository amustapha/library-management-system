<?php require 'includes/common_head.php'; ?>

<main>
    <?php
    if(isset($_SESSION['error']) && !is_null($_SESSION['error'])){
        echo "<p class='error' style='text-align: center; font-size: .85em; margin: 1em 0;'>{$_SESSION['error']}</p>";
        $_SESSION['error'] = null;

    }

    if(isset($_SESSION['warning']) && !is_null($_SESSION['warning'])){
        echo "<p class='info' style='text-align: center; font-size: .85em; margin: 1em 0;'>{$_SESSION['error']}</p>";
        $_SESSION['warning'] = null;

    }
?>
    <aside>
        <h2>Welcome to Library Management System</h2>
        <?php
        if (isset($_POST['submit'])){
            if(login($_POST['username'], $_POST['pin'])){
                header("location: search.php");
            }else{
                echo "<p class='error'>The supplied username and password do not match</p>";
            }
        }
        ?>
        <form method="post">
            <label for="username" class="icon-id">
                <input type="text" name="username" id="username">
                <em>User ID</em>
            </label>
            <label for="pin" class="icon-pin">
                <input type="password" name="pin" id="pin">
                <em>Pin</em>
            </label>
            <button type="submit" name="submit">Login</button>
            <br class="clear-fix" />
        </form>

        <p class="info">With library managemen system, you can find books and book for books in the library.... bla.. bla.. bla</p>
        <p class="create">Need an account? Meet the librarian for info</p>
    </aside>
    <article>
        <div class="carousel">
<!--            <img src="images/image1.jpg" />-->
            <img src="images/image2.jpg" />
            <img src="images/image3.jpg" />
            <img src="images/image4.jpg" />
            <img src="images/image5.jpg" />
            <img src="images/image6.jpg" />
            <img src="images/image7.jpg" />
        </div>
    </article>
</main>
</body>
</html>