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

        <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    </head>

    <body class="bg">
        <div class="bg-dark text-white p-2 top">
            網 路 位 元 組 - 2019/12/12 上課用
        </div>

        <div id="main" class="w-50 border mx-auto">
            <div class="border mx-auto mt-4 p-2 rounded bg-light input">
            <input id="input" type="text" name="message" class="form-control w-100" placeholder="來點留言吧">
            </div>

            <?php
                // 搜尋資料
                $sql = "SELECT * FROM message";
                $select = $mysqli -> query($sql);
                while ($result = mysqli_fetch_assoc($select)) {
            ?>
                    <div id="ID<?php echo $result["id"]?>" class="border mx-auto mt-4 p-2 rounded bg-light message-section">
                        <div class="pb-1">
                            <?php echo $result["context"]?>
                        </div>
                        <div class="border-top pt-2">
                            <div class="float-left text-secondary">
                                <?php echo $result["createTime"]?>
                            </div>
                            <div class="float-right">
                                <button class="btn btn-sm btn-warning text-white" onclick="location.assign('update.php?id=<?php echo $result["id"]?>')">修 改</button>
                                <button class="btn btn-sm btn-danger text-white" onclick="deleteMessage(<?php echo $result["id"]?>)">刪 除</button>
                            </div>
                        </div>
                    </div>
            <?php
                }
            ?>
        </div>
    </body>
</html>

<script>
    function deleteMessage (id) {
        var message = "確定要刪除嗎?";

        // 確認使用者是否真的要刪除
        if (confirm(message)) {
            // 使用 AJAX 不須重新整理頁面，將刪除資料送到後端去
            $.ajax({
                url: "../controller/deleteMessage.php?id=" + id,
                type: 'GET',
            });

            // 將訊息 ID 的 DIV 套上 css delete 樣式
            $("#ID" + id).toggleClass("delete");

            // 設定 450 微秒 0.45s 將訊息 ID 的 DIV 從頁面上移除
            // 因為需要搭配 css 的動畫時間，所以必須讓 css 動畫跑完再將 div 刪除
            setTimeout(function(){
                // 刪除訊息 ID 的 DIV
                $("#ID" + id).remove();
            }, 450);
        }
    }

    var input = document.getElementById("input");
    input.onkeydown = function(e){
        if (e.keyCode == 13) {
            // 透過 AJAX 不重新整理頁面將資料新增到後端
            $.ajax({
                url: '../controller/insertMessage.php',
                type: 'POST',
                data: {
                    'message' : $("#input").val(),
                },
                // 成功後
                success: function(response) {
                    // 解析 JSON 格式
                    response = JSON.parse(response);

                    // 製作訊息 DIV
                    tmp = "";
                    tmp += "<div id='ID" + response["id"] + "' class='border mx-auto mt-4 p-2 rounded bg-light message-section'>";
                    tmp += "<div class='pb-1'>" + response["context"] +"</div>";
                    tmp += "<div class='border-top pt-2'>";
                    tmp += "<div class='float-left text-secondary'>" + response["createTime"] + "</div>";
                    tmp += "<div class='float-right'>";
                    tmp += "<button class='btn btn-sm btn-warning text-white' onclick='location.replace(\'update.php?id=" + response["id"] + "\')'>修 改</button> ";
                    tmp += "<button class='btn btn-sm btn-danger text-white' onclick='deleteMessage(" + response["id"] + ")'>刪 除</button></div></div></div>";

                    // 累加到 main 中
                    $("#main").append(tmp);
                }
            });

            $("#input").val("");
        }
    }
</script>
