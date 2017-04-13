<?php require 'includes/common_head.php'; ?>

<main>
    <section>

        <?php
        $search = "";
        if(isset($_GET['search'])){
            $books = search_book($_GET['search']);
            $search = $_GET['search'];
        }else{
            $books = get_books();
        }
                    ?>
            <div class="table">
                <div class="row">
                    <h1 class="cell">All books</h1>
                    <form class="cell" style="width: 256px">
                        <label for="search" class="icon-search">
                            <input type="search" name="search" id="search" value="<?php echo $search; ?>">
                            <em>Search</em>
                        </label>
                    </form>

                </div>
            </div>
        <?php
        if(sizeof($books)<=0) {

            echo "<p class='info' style='text-align: center; color: red;'>There are currently no books ";
            if(isset($_GET['search'])){
                echo "for the current search";
            }

            echo "</p>";
        }
        else{
        ?>
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
                            <a href='book.php?isbn={$book['isbn']}' class='book' title='Book'></a>
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
    </section>
</main>
</body>
</html>