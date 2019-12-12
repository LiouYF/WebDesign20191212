<?php
    // 匯入 conn.php
    include("../include/conn.php");

    $sql = "SELECT * FROM message ORDER BY id DESC LIMIT 0, 1";
    $select = $mysqli -> query($sql);
    $result = mysqli_fetch_assoc($select);

    echo json_encode($result);
?>