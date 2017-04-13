<?php require 'includes/common_head.php';

if(!(isset($_SESSION['role']) AND $_SESSION['role']=='admin')){
    $_SESSION['error'] = "You are not authorized to view this page";
    header("location: index.php");
}
?>
<main>
    <aside>
        <h2>Add new users</h2>
        <?php
        $password = substr(hash("sha512", rand().time().rand()), rand(1, 100), rand(6, 8));
        if(isset($_POST['username'])){
            if(add_user($_POST['username'], $_POST['fullname'], $_POST['email'], $password, "user")){
                echo "<p class='success'>User successfully added</p>";
            }else{
                echo "<p class='error'>User could not be added</p>";
            }
        }

            ?>
        <form method="post">
            <label for="fullname" class="icon-user">
                <input type="text" name="fullname" id="fullname">
                <em>Full name</em>
            </label>
            <label for="username" class="icon-id">
                <input type="text" name="username" id="pin">
                <em>User ID</em>
            </label>
            <label for="email" class="icon-mail">
                <input type="text" name="email" id="email">
                <em>E-mail</em>
            </label>


            <button type="submit" name="submit">Add user</button>
            <br class="clear-fix" />
        </form>

        <p class="info">A user once added is automatically sent an email containing his information and an automatically system generated password.</p>
        <p class="create">Need an account? Meet the librarian for info</p>
    </aside>
    <article>
        <?php
        $users = get_users("user");
        if(is_array($users)){
        ?>
        <div class="table">
            <div class="row">
                <h1 class="cell">All Users</h1>


            </div>
        </div>
        <table width="100%">
            <thead>
            <tr>
                <th style="width: 32px;">S/N</th>
                <th>Name</th>
                <th>E-mail</th>
                <th>User ID</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <?php
                $sn = 1;
                foreach ($users as $user) {
                    echo "<td>{$sn}</td>";
                    echo "<td>{$user['fullname']}</td>";
                    echo "<td>{$user['email']}</td>";
                    echo "<td>{$user['username']}</td></tr>";
                    $sn++;
                }
                }else{
                    echo "<p class='info'>No user has been added yet</p>";
                }
                ?>

            </tbody>
        </table>

    </article>
</main>
</body>
</html>