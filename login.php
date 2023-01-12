<?php

    include "db_connection.php";

    $query = "SELECT * FROM users;";

    $query_result = mysqli_query($connection, $query);

    if (!$query_result) {
        die("Query failed ".mysqli_error());
    }

    $emails = array();

    while($row = mysqli_fetch_assoc($query_result)) {
        array_push($emails, $row['email']);
    }

    if (isset($_POST['submit'])) {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $registredEmail = false;

        foreach($emails as $key => $value) {
            if ($value == $email) {
                $registredEmail = true;
            }
        }

        if ($email && $password) {

            if ($registredEmail) {
                echo "This email already exists, please input another email";
            } else {
                $query_insert = "INSERT INTO users (user_name, email, password) VALUES
                ('$username', '$email', '$password');";
                $query_insert_result = mysqli_query($connection, $query_insert);

                if(!$query_insert_result) {
                    die("Query failed".mysqli_error());
                } else {                
                    echo "You are signed up";
                }

            }

        } else {
            echo "You must input email and password";
        }

    }

?>

<!DOCTYPE html>
<html>
<head>
    <title></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>
<body>
    <form action="login.php" method="post">
        <div class="mb-3">
            <label for="exampleInputUsername1" class="form-label">User name</label>
            <input type="text" class="form-control" name="username" id="exampleInputUsername1" aria-describedby="emailHelp">
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Email address</label>
            <input type="email" class="form-control" name="email" id="exampleInputEmail1" aria-describedby="emailHelp">
            <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Password</label>
            <input type="password" class="form-control" name="password" id="exampleInputPassword1">
        </div>
        <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="exampleCheck1">
            <label class="form-check-label" for="exampleCheck1">Check me out</label>
        </div>
        <button type="submit" class="btn btn-primary" name="submit">Submit</button>
    </form>
</body>
</html>