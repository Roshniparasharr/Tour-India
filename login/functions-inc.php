<?php

function emptyInputSignup($fname, $lname, $age, $number, $gender, $address, $email, $username, $password, $aadhar){
    $result = false; // Initialize the variable
    if (empty($fname) || empty($lname) || empty($age) || empty($number) || empty($gender) || empty($address) || empty($email) || empty($username) || empty($password) || empty($aadhar)){
        $result = true;
    }
    return $result;
}

function invalidUid($username){
    $result = false; // Initialize the variable
    if (!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
        $result = true;
    }
    return $result;
}

function invalidEmail($email){
    $result = false; // Initialize the variable
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $result = true;
    }
    return $result;
}


function uidExists($conn, $username, $email){
  $sql = "SELECT * FROM login WHERE usersuid = ? OR usersEmail = ?;";
  $stmt = mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt, $sql)){
    header("location: login.php?error=usernametaken");
    exit();
  }

  mysqli_stmt_bind_param($stmt, "ss", $username, $email);
  mysqli_stmt_execute($stmt);

  $resultData = mysqli_stmt_get_result($stmt);

  if ($row = mysqli_fetch_assoc($resultData)){
    return $row;
  }
  else{
    $result = false;
    return $result;
  }

  mysqli_stmt_close($stmt);
}

  function emptyInputLogin($username, $pwd){
    $result = false; // Initialize the variable
    if (empty($username) || empty($pwd)){
        $result = true;
    }
    return $result;
}


function loginUser($conn, $username, $pwd){
    $uidExists = uidExists($conn, $username, $username);

    if ($uidExists === false){
        header("location: login.php?error=Invalid Credentials");
        exit();
    }

    $pwdHashed = $uidExists["userspwd"];
    $checkpwd = password_verify($pwd, $pwdHashed);

    if ($checkpwd === false){
        header("location: login.php?error=wrongpassword");
        exit();
    }
    else if ($checkpwd === true){
        session_start();
        $_SESSION["usersid"] = $uidExists["usersid"];
        $_SESSION["usersuid"] = $uidExists["usersuid"];
        header("location: loggedinhome.php");
        exit();
    }
}