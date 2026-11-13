<?php
  function pdo_con(){
    $http_host = $_SERVER['HTTP_HOST'] ?? '';
    $is_infinityfree = (strpos($http_host, 'infinityfree') !== false || strpos($http_host, 'epizy.com') !== false);

    if ($is_infinityfree) {
      $servername = "sql302.infinityfree.com";
      $username = "if0_43184606";
      $password = "8gZKYLk9Rk6UBlL";
      $dbname = "if0_43184606_duan1";
    } else {
      $servername = "localhost";
      $username = "root";
      $password = "";
      $dbname = "duanmau";
    }

    try {
      $conn = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password);
      // set the PDO error mode to exception
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      return $conn;
    } catch(PDOException $e) {
      if (!$is_infinityfree && $dbname === "duanmau") {
        try {
          $conn = new PDO("mysql:host=$servername;dbname=duan1;charset=utf8", $username, $password);
          $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          return $conn;
        } catch(PDOException $e2) {
          echo "Lỗi kết nối: " . $e->getMessage();
          return null;
        }
      }
      echo "Lỗi kết nối: " . $e->getMessage();
      return null;
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