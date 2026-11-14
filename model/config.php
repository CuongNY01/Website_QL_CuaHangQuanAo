<?php
  function pdo_con(){
    static $cached_conn = null;
    if ($cached_conn !== null) {
      return $cached_conn;
    }

    $http_host = $_SERVER['HTTP_HOST'] ?? '';
    $is_infinityfree = (strpos($http_host, 'infinityfree') !== false || strpos($http_host, 'epizy.com') !== false);

    if ($is_infinityfree) {
      $servername = "sql302.infinityfree.com";
      $username = "if0_43184606";
      $password = "8gZKYLk9Rk6UBlL";
      $dbname = "if0_43184606_duan1";
      $port = 3306;
      $db_candidates = [$dbname];
    } else {
      $servername = "127.0.0.1";
      $username = "root";
      $password = "";
      $port = 3306;
      $db_candidates = ['duanmau', 'duan1'];
    }

    foreach ($db_candidates as $try_db) {
      try {
        $conn = new PDO("mysql:host=$servername;port=$port;dbname=$try_db;charset=utf8", $username, $password, [
          PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
          PDO::ATTR_TIMEOUT => 2
        ]);
        $cached_conn = $conn;
        return $cached_conn;
      } catch (PDOException $e) {
        // Tiếp tục thử database tiếp theo
      }
    }

    // Dự phòng với localhost
    if (!$is_infinityfree) {
      foreach ($db_candidates as $try_db) {
        try {
          $conn = new PDO("mysql:host=localhost;dbname=$try_db;charset=utf8", $username, $password, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_TIMEOUT => 2
          ]);
          $cached_conn = $conn;
          return $cached_conn;
        } catch (PDOException $e) {
        }
      }
    }

    return null;
  }

  function pdo_show_error($conn) {
    static $shown = false;
    if ($conn === null && !$shown) {
      $shown = true;
      echo "<div style='background: #fff3cd; color: #856404; border: 1px solid #ffeeba; padding: 20px; margin: 20px auto; max-width: 900px; border-radius: 8px; font-family: -apple-system, BlinkMacSystemFont, \"Segoe UI\", Roboto, sans-serif; box-shadow: 0 4px 12px rgba(0,0,0,0.08);'>";
      echo "<h3 style='margin: 0 0 10px 0; color: #856404; display: flex; align-items: center; gap: 8px;'>⚠️ Chưa kết nối được Cơ sở dữ liệu MySQL (Port 3306)</h3>";
      echo "<p style='margin: 5px 0 12px 0; font-size: 14px;'>Hệ thống không thể kết nối đến máy chủ MySQL trên localhost.</p>";
      echo "<div style='background: #fff; padding: 12px 16px; border-radius: 6px; border-left: 4px solid #ffc107; font-size: 14px; line-height: 1.6;'>";
      echo "<b>Hướng dẫn khắc phục nhanh:</b><br>";
      echo "1. Mở ứng dụng <b>XAMPP Control Panel</b> trên máy tính.<br>";
      echo "2. Nhấn nút <b>Start</b> ở hàng <b>MySQL</b> (đèn trạng thái chuyển sang màu xanh lá).<br>";
      echo "3. Tải lại trang (F5).";
      echo "</div>";
      echo "</div>";
    }
  }

  function pdo_execute($sql){
    $sql_args = array_slice(func_get_args(), 1);
    $conn = pdo_con();
    if ($conn === null) {
      pdo_show_error($conn);
      return false;
    }
    try {
      $stmt = $conn->prepare($sql);
      $stmt->execute($sql_args);
      return true;
    } catch (PDOException $e) {
      throw $e;
    }
  }

  function pdo_query($sql){
    $sql_args = array_slice(func_get_args(), 1);
    $conn = pdo_con();
    if ($conn === null) {
      pdo_show_error($conn);
      return [];
    }
    try {
      $stmt = $conn->prepare($sql);
      $stmt->execute($sql_args);
      $rows = $stmt->fetchAll();
      return $rows ? $rows : [];
    } catch (PDOException $e) {
      throw $e;
    }
  }

  function pdo_query_one($sql){
    $sql_args = array_slice(func_get_args(), 1);
    $conn = pdo_con();
    if ($conn === null) {
      pdo_show_error($conn);
      return null;
    }
    try {
      $stmt = $conn->prepare($sql);
      $stmt->execute($sql_args);
      $row = $stmt->fetch(PDO::FETCH_ASSOC);
      return $row ? $row : null;
    } catch (PDOException $e) {
      throw $e;
    }
  }
?>
