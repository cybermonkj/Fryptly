<?php
ini_set('max_execution_time', 300); //300 seconds 
require_once 'common_help.php';
if (isset($_POST)) {
    $host = $_POST["host"];
    $dbuser = $_POST["dbuser"];
    $dbpassword = $_POST["dbpassword"];
    $dbname = $_POST["dbname"];
    $fullname = $_POST["fullname"];
    $email = $_POST["email"];
    $login_password = $_POST["password"] ? $_POST["password"] : "";
    $timezone = $_POST["timezone"];
    $purchase_code = $_POST["purchase_code"];


    $verification = verify_purchase_code($purchase_code);
    if (!empty($verification) && $verification->status != "success") {
        echo json_encode(array("success" => false, "message" => $verification->message));
        exit();
    }
    
    if (empty($verification->db)) {
        echo json_encode(array("success" => false, "message" => "There was some issue with your request. Please contact with me via: tuyennguyen2906@gmail.com for more details"));
        exit();
    }   
     
    if (!($host && $dbuser && $dbname && $fullname && $email && $login_password && $purchase_code && $timezone)) {
        echo json_encode(array("success" => false, "message" => "Please input all fields."));
        exit();
    }

    if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
        echo json_encode(array("success" => false, "message" => "Please input a valid email."));
        exit();
    }

    $mysqli = @new mysqli($host, $dbuser, $dbpassword, $dbname);

    if (mysqli_connect_errno()) {
        echo json_encode(array("success" => false, "message" => $mysqli->connect_error));
        exit();
    }

    // set random enter_encryption_key
    $config_file_path = "../app/config.php";
    $encryption_key = substr(md5(rand()), 0, 15);
    $config_file = file_get_contents($config_file_path);
    $is_installed = strpos($config_file, "enter_db_host");

    if (!$is_installed) {
        echo json_encode(array("success" => false, "message" => "Seems this app is already installed! You can't reinstall it again."));
        exit();
    }

    //start installation
    $sql = $verification->db;
    //set admin information to database
    $now = date("Y-m-d H:i:s");

    $sql = str_replace('admin_username', $fullname, $sql);
    $sql = str_replace('admin_email', $email, $sql);
    $sql = str_replace('admin_password', md5($login_password), $sql);
    $sql = str_replace('admin_timezone', $timezone, $sql);
    $sql = str_replace('ITEM-PURCHASE-CODE', $purchase_code, $sql);

    //create tables in datbase 
    $mysqli->multi_query($sql);
    do {
        
    } while (mysqli_more_results($mysqli) && mysqli_next_result($mysqli));

    $mysqli->close();
    // database created
    // set the database config file
    $config_file = str_replace('enter_encryption_key', $encryption_key, $config_file);
    $config_file = str_replace('enter_db_host', $host, $config_file);
    $config_file = str_replace('enter_db_username', $dbuser, $config_file);
    $config_file = str_replace('enter_db_password', $dbpassword, $config_file);
    $config_file = str_replace('enter_db_name', $dbname, $config_file);
    $config_file = str_replace('enter_timezone', $timezone, $config_file);

    file_put_contents($config_file_path, $config_file);

    // set the environment = production
    $index_file_path = "../index.php";
    $index_file = file_get_contents($index_file_path);
    $index_file = preg_replace('/installation/', 'production', $index_file, 1); //replace the first occurence of 'pre_installation'
    file_put_contents($index_file_path, $index_file);

    if (file_exists('install.sql')) {
        unlink('install.sql');
    }
    echo json_encode(array("success" => true, "message" => "Installation successfull."));
    exit();
}


