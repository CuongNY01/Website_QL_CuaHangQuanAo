<?php
  function pdo_con(){
    $is_localhost = in_array($_SERVER['HTTP_HOST'] ?? '', ['localhost', '127.0.0.1', 'localhost:8000']);

    if ($is_localhost) {
      $servername = "localhost";
      $username = "root";
      $password = "";
      $dbname = "duanmau";
    } else {
      $servername = "sql302.infinityfree.com";
      $username = "if0_43184606";
      $password = "8gZKYLk9Rk6UBlL";
      $dbname = "if0_43184606_duan1";
    }

    try {
      $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
      // set the PDO error mode to exception
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $conn -> query("SET NAMES 'utf8'");
      return $conn;
    } catch(PDOException $e) {
      echo "Lỗi kết nối: " . $e->getMessage();
    }
  }

  function pdo_execute($sql){
    $sql_args = array_slice(func_get_args(), 1);
    try {
      $conn = pdo_con();
      $stmt = $conn->prepare($sql);
      $stmt -> execute($sql_args);
    } catch (PDOException $e) {
      throw $e;
    }finally{
      unset($conn);
    }
  }

  function pdo_query($sql){
    $sql_args = array_slice(func_get_args(), 1);
    try {
      $conn = pdo_con();
      $stmt = $conn->prepare($sql);
      $stmt -> execute($sql_args);
      $rows = $stmt->fetchAll();
      return $rows;
    } catch (PDOException $e) {
      throw $e;
    }finally{
      unset($conn);
    }
  }


  function pdo_query_one($sql){
    $sql_args = array_slice(func_get_args(), 1);
    try {
      $conn = pdo_con();
      $stmt = $conn->prepare($sql);
      $stmt -> execute($sql_args);
      $row = $stmt->fetch(PDO::FETCH_ASSOC);
      return $row;
    } catch (PDOException $e) {
      throw $e;
    }finally{
      unset($conn);
    }
  }
?>