<?php
session_start();
//error_reporting(0);

define("db_host", "localhost");
define("db_user", "root");
define("db_password", "encryption");
define("db", "library");
$mysql = mysqli_connect(db_host, db_user, db_password, db);


function add_user($username, $name, $email, $password, $role){
    global $mysql;
    $query = mysqli_query($mysql, "INSERT INTO users (`username`, `fullname`, `email`, `password`, `role`) VALUES('$username', '$name', '$email', '$password', '$role')");
    if (mysqli_affected_rows($mysql) == 1){
        $msg = "<h2>$name</h2>"
            . "Your account has been successfully created with Library Managemnt. You can now login with :"
            . "<b>Username: </b> $username"
            . "<b>Password: </b> $password";
        mail($email, "Account Created", $msg);
        return true;
    }else{
        return false;
    }
}

function remove_user($id){
    global $mysql;
    $query = mysqli_query($mysql, "DELETE FROM users WHERE id='$id'");

    if (mysqli_affected_rows($mysql) >= 1){
        return true;
    }else{
        return false;
    }
}

function login($username, $password){
    global $mysql;

    $query = mysqli_query($mysql, "SELECT id, fullname, role FROM users WHERE username='$username' and password='$password'");
    $result = mysqli_fetch_assoc($query);

    if(mysqli_num_rows($query) == 1){
        $_SESSION['id'] = $result['id'];
        $_SESSION['fullname'] = $result['fullname'];
        $_SESSION['username'] = $username;
        $_SESSION['role'] = $result['role'];
        return true;
    }else{
        return false;
    }

}

function get_users($type){
    global $mysql;

    $query = mysqli_query($mysql, "SELECT id, fullname, username, email, role FROM users WHERE role='$type'");

    $result = array();
    while($row = mysqli_fetch_assoc($query)){
        array_push($result, $row);
    }
    return $result;
}

function add_book($book_title, $author, $publisher, $isbn, $publication_year, $available_copies){
    global $mysql;
    $query = mysqli_query($mysql, "INSERT INTO books VALUES(NULL, '$book_title', '$author', '$publisher', '$isbn', '$publication_year', '$available_copies')");
    if (mysqli_affected_rows($mysql) == 1){
        return "<p class='success'> Book has been successfully added </p>";
    }else{
        if(mysqli_errno($mysql) == 1062){
            if(strpos(mysqli_error($mysql), 'isbn')){
                return "<p class='error'> Book with same ISBN already exists</p>";
            }
        }
        return "<p class='error'> Book could not be added </p>";
    }

}

function get_book($isbn){
    global $mysql;
    $query = mysqli_query($mysql, "SELECT * FROM books WHERE isbn = '$isbn' OR id = '$isbn' ");
    return mysqli_fetch_assoc($query);
}

function get_books(){
    global $mysql;
    $query = mysqli_query($mysql, "SELECT * FROM books ");

    $result = array();
    while($row = mysqli_fetch_assoc($query)){
        array_push($result, $row);
    }
    return $result;
}

function search_book($keyword){
    global $mysql;
    $query = mysqli_query($mysql, "SELECT * FROM books WHERE author LIKE '%{$keyword}%' OR book_title LIKE '%{$keyword}%' OR publisher LIKE '%{$keyword}%' OR isbn LIKE '%{$keyword}%' OR publication_year LIKE '%{$keyword}%' ");
    $result = array();
    while($row = mysqli_fetch_assoc($query)){
        array_push($result, $row);
    }
    return $result;
}

function delete_book($id){
    global $mysql;
    $query = mysqli_query($mysql, "DELETE FROM books WHERE id='$id'");

    if (mysqli_affected_rows($mysql) >= 1){
        return true;
    }else{
        return false;
    }
}

function book_book($book_id, $date, $duration){
    global $mysql;
    $id = $_SESSION['id'];
    $query = mysqli_query($mysql, "INSERT INTO borrow VALUES(NULL, '$id', '$book_id', '$date', '$duration')");
    if (mysqli_affected_rows($mysql) == 1){
        return "<p class='success'> Book has been successfully borrowed</p>";
    }else{
        if(mysqli_errno($mysql) == 1062){
            if(strpos(mysqli_error($mysql), 'user_id')){
                return "<p class='error'> Book has already been borrowed for!</p>";
            }
        }
        return "<p class='error'> Book could not be booked for</p>" . mysqli_error($mysql);
    }

}

//function book();
//var_dump(add_user("rook", "Farook", "rook@gmail.com", "test", "user"));
// var_dump(login("m_bryo", "test"));
// my_courses();
// add_course(2);
//var_dump(get_users("admin"));
?>
