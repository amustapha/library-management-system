<?php require 'includes/common_head.php';

if(!(isset($_SESSION['role']) AND $_SESSION['role']=='admin')){
    $_SESSION['error'] = "You are not authorized to view this page";
    header("location: index.php");
}

$title = "";
$author = "";
$publisher = "";
$isbn = "";
$year = "";
$copies = "";

if(isset($_GET['delete'])){
    if(delete_book($_GET['delete'])){
        echo "<script> alert('Book has been deleted'); </script>";
    }
}

if(isset($_GET['edit'])){
    $book = get_book($_GET['edit']);
    $title = $book['book_title'];
    $author = $book['author'];
    $publisher = $book['publisher'];
    $isbn = $book['isbn'];
    $year  = $book['publication_year'];
    $copies = $book['available_copies'];
}

?>

<main>
    <aside>
        <h2>Has a new book arrived? Add it here</h2>
        <?php
        if(isset($_POST['title'])) {
            if(isset($_GET['edit'])){
                delete_book($_GET['edit']);
            }
            $title = $_POST['title'];
            $author = $_POST['author'];
            $publisher = $_POST['publisher'];
            $isbn = $_POST['isbn'];
            $year = $_POST['year'];
            $copies =  $_POST['copies'];

            $stat = add_book($title, $author, $publisher, $isbn, $year, $copies);
            echo($stat);
            if(strpos($stat, 'success')){
                header("location: books.php");
            }
        }
        ?>
        <form method="post">
            <label for="author" class="icon-user">
                <input type="text" name="author" id="author" value="<?php echo $author; ?>" required>
                <em>Author</em>
            </label>
            <label for="title" class="icon-title">
                <input type="text" name="title" id="title" value="<?php echo $title; ?>" required>
                <em>Book title</em>
            </label>
            <label for="publisher" class="icon-publisher">
                <input type="text" name="publisher" id="publisher" value="<?php echo $publisher; ?>" required>
                <em>Book publisher</em>
            </label>
            <label for="isbn" class="icon-bar-code">
                <input type="text" name="isbn" id="isbn" value="<?php echo $isbn; ?>" required>
                <em>International Serial Book Number</em>
            </label>
            <label for="year" class="icon-calendar">
                <input type="number" name="year" id="year" min="1900" max="2017" value="<?php echo $year; ?>" required>
                <em>Publication Year</em>
            </label>
            <label for="copies" class="icon-shelve">
                <input type="number" name="copies" id="copies" min="1" value="<?php echo $copies; ?>" required>
                <em>Available Copies</em>
            </label>
            <button type="submit" name="submit">Save</button>
            <br class="clear-fix" />
        </form>

        <p class="info">View books on the right side, ensure book does not exist before attempting to add a new one</p>
        <p class="create"></p>
    </aside>
    <article>
        <?php
        $books = get_books();
        if(!is_array($books)) {

            echo "<p class='info' style='text-align: center; color: red;'>There are currently no books </p>";
        }
        else{

            ?>
            <div class="table">
                <div class="row">
                    <h1 class="cell">All books</h1>

                </div>
            </div>
            <table width="100%">
                <thead>
                <tr>
                    <th style="width: 32px;">S/N</th>
                    <th>Title</th>
                    <th>Author</th>
                    <th>Publisher</th>
                    <th style="width: 92px;">ISBN</th>
                    <th style=" width: 48px;">Year</th>
                    <th style="width: 48px;">copies</th>
                    <th style="width: 60px;">Action</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <?php
                    $sn = 1;
                    foreach ($books as $book){
                        echo "<td>{$sn}</td>";
                        echo "<td>{$book['book_title']}</td>";
                        echo "<td>{$book['author']}</td>";
                        echo "<td>{$book['publisher']}</td>";
                        echo "<td>{$book['isbn']}</td>";
                        echo "<td>{$book['publication_year']}</td>";
                        echo "<td>{$book['available_copies']}</td>";
                        echo "<td style='text-align: center'>
                            <a href='?edit={$book['id']}' class='edit' title='Edit'></a>
                            <a href='?delete={$book['id']}' class='delete' title='Delete'></a>
                        </td>
                        </tr>";
                        $sn++;
                    }
                    ?>

                </tbody>
            </table>
            <?php
        }
        ?>
    </article>
</main>
</body>
</html>