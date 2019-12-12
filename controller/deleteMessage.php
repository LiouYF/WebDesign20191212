<?php
    // 匯入 conn.php
    include("../include/conn.php");

    try {
        $id = $_GET["id"];

        // 判斷是否有這個 id 資料
        $sql = "SELECT * FROM message WHERE id = " . $id;
        $select = $mysqli -> query($sql);
        if (mysqli_num_rows($select) == 0) {
            throw new Exception("error");
        }

        $sql = "DELETE FROM message WHERE id = " . $id;
        $mysqli -> query($sql);

        header("location: ../views/index.php");
    } catch (Exception $e) {
        header("location: ../views/index.php");
    }
?>