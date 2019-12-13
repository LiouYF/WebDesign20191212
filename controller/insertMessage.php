<?php
    // 匯入 conn.php
    include("../include/conn.php");

    try {
        $message = $_POST["message"];

        // 判斷字串長度 如果長度等於 0 丟出錯誤
        if (strlen($message) == 0) {
            throw new Exception("error");
        }

        $sql = "INSERT INTO message(context) VALUES('".$message."')";
        $mysqli -> query($sql);

        $sql = "SELECT * FROM message ORDER BY id DESC LIMIT 0, 1";
        $select = $mysqli -> query($sql);
        $result = mysqli_fetch_assoc($select);

        // 將資料庫資料轉為 JSON 並送出去
        echo json_encode($result);

        // 因為我們透過 AJAX 將資料傳進來，所以不需要將頁面跳轉回首頁
        // 跳轉回首頁
        // header("location: ../views/index.php");

    } catch (Exception $e) {
        // 因為我們透過 AJAX 將資料傳進來，所以不需要將頁面跳轉回首頁
        // 跳轉回首頁
        // header("location: ../views/index.php");
    }
?>