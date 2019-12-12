<?php
    // 匯入 conn.php
    include("../include/conn.php");
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
            <div class="border mx-auto mt-4 p-2 rounded bg-light input">
                <form action="../controller/insertMessage.php" mthod="POST">
                    <input type="text" name="message" class="form-control w-100" placeholder="來點留言吧">
                </form>
            </div>

            <?php
                // 搜尋資料
                $sql = "SELECT * FROM message";
                $select = $mysqli -> query($sql);
                while ($result = mysqli_fetch_assoc($select)) {
            ?>
                    <div class="border mx-auto mt-4 p-2 rounded bg-light message-section">
                        <div class="pb-1">
                            <?php echo $result["context"]?>
                        </div>
                        <div class="border-top pt-2">
                            <div class="float-left text-secondary">
                                <?php echo $result["createTime"]?>
                            </div>
                            <div class="float-right">
                                <button class="btn btn-sm btn-warning text-white">修 改</button>
                                <button class="btn btn-sm btn-danger text-white">刪 除</button>
                            </div>
                        </div>
                    </div>
            <?php
                }
            ?>
        </div>
    </body>
</html>