<?php
    // 匯入 conn.php
    include("../include/conn.php");

    try {
        // 接收資料 id
        $id = $_GET["id"];

        // 判斷是否為數值
        if (!is_numeric($id)) {
            // 丟出
            throw new Exception("error");
        }

        // 從 message 資料表中搜尋 id 為 $id 的資料
        $sql = "SELECT * FROM message WHERE id = " . $id;
        $select = $mysqli -> query($sql);

        // 判斷搜尋到的數量 0 = 沒有搜尋到
        if (mysqli_num_rows($select) == 0) {
            throw new Exception("error");
        }

        $result = mysqli_fetch_assoc($select);
    } catch (Exception $e) {
        // 跳轉回首頁
        header("location: index.php");
    }
?>

<html>
    <head>
        <meta charset="utf8">
        <link rel="stylesheet" href="../static/base.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    </head>

    <body class="bg">
        <div class="bg-dark text-white p-2 top">
            網 路 位 元 組 - 2019/12/12 上課用
        </div>

        <div class="w-50 border mx-auto">
            <div class="border mx-auto mt-4 p-2 rounded bg-light message-section">
                <form action="../controller/insertMessage.php" mthod="POST">
                    <input type="text" class="form-control w-100" value="<?php echo $result["context"]?>">
                </form>
                
                <div class="text-right mt-1">
                    <button class="btn btn-sm btn-danger text-white">取 消</button>
                    <button class="btn btn-sm btn-success text-white">儲 存</button>
                </div>
            </div>
        </div>
    </body>
</html>