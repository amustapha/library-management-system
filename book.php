<?php require 'includes/common_head.php';

$book = "";
if(isset($_GET['isbn'])){
    $book = get_book($_GET['isbn']);
    if(!isset($_SESSION['id'])){
        $_SESSION['error'] = "You must login first before proceediong";
        header("location: index.php");
    }
}
?>

<main>
    <aside>
        <h2>What book are you looking for?</h2>
        <?php
         if(!is_array($book)){
            ?>
            <form>
                <label for="isbn" class="icon-bar-code">
                    <input type="text" name="isbn" id="isbn">
                    <em>International Serial Book Number</em>
                </label>

                <button type="submit" >Look Up</button>
                <br class="clear-fix"/>
            </form>
            <?php
        }else {
            ?>
            <form method="post">
                <?php
                if(isset($_POST['date'])){
                    echo book_book($_POST['book_id'], $_POST['date'], $_POST['duration']);
                }
                ?>
                <input type="hidden" name="book_id" value="<?php echo $book['id'] ?>" />
                <label for="date" class="icon-calendar">
                    <input type="text" name="date" id="date">
                    <em>Book Date</em>
                </label>
                <label for="duration" class="icon-view">
                    <input type="number" name="duration" id="duration" max="7" min="1">
                    <em>Book Duration (days)</em>
                </label>
                <div class="info" style="margin: 8px 0">
                    Please note that the book must be returned within the stipulated time, and delay is a punishable offence
                </div>
                <button type="submit">Book</button>
                <br class="clear-fix"/>
            </form>

            <?php
        }
        ?>

        <p class="create">Not the book you are looking for? <a href="search.php">See more here</a> </p>
    </aside>
    <article>
        
        <?php
        if(is_array($book)) {

            echo "<ul class=normalize'>
            <li class='row'><b class='icon-title'>Book title: </b>{$book['book_title']}</li>
            <li><b class='icon-user'>Author: </b>{$book['author']}</li>
            <li><b class='icon-publisher'>Publisher: </b>{$book['publisher']}</li>
            <li><b class='icon-bar-code'>ISBN: </b>{$book['isbn']}</li>
            <li><b class='icon-calendar'>Publication Year: </b>{$book['publication_year']}</li>
        </ul>";
        }else{
            if(isset($_GET['isbn'])){
                echo "<p class='info' style='text-align: center; color: red;'>The ISBN entered does not exist</p>";

            }else{
                echo "<p class='info' style='text-align: center; color: red;'>No book has been selected yet</p>";

            }
        }
        ?>
    </article>
</main>
</body>
</html>