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

        // 跳轉回首頁
        header("location: ../views/index.php");

    } catch (Exception $e) {
        // 跳轉回首頁
        // header("location: ../views/index.php");
    }
?>