<?php
require_once($_SERVER["DOCUMENT_ROOT"] . "/config.php"); //config파일의 정보를 가져와 쓴다
require_once(MY_PATH_DB_LIB); //db_lib 파일의 정보를 가져와 쓴다

$conn = null;

try {
    if (strtoupper($_SERVER["REQUEST_METHOD"]) === "GET") {
        // get처리

        // id획득
        $id = isset($_GET["id"]) ?  (int)$_GET["id"] : 0;

        // page 획득
        $page = isset($_GET["page"]) ? (int)$_GET["page"] : 1;

        if ($id < 1) {
            throw new Exception("파라미터 오류");
        }

        // PDO instance
        $conn = my_db_conn();

        // 데이터 조회!!
        $arr_prepare = [
            "id" => $id
        ];

        $result = my_board_select_id($conn, $arr_prepare);
    } else {
        // post처리

        // parm setting ↓        
        // id획득
        $id = isset($_POST["id"]) ?  (int)$_POST["id"] : 0;

        // page 획득
        $page = isset($_POST["page"]) ? (int)$_POST["page"] : 1;

        //get title
        $title = isset($_POST["title"]) ? $_POST["title"] : "";

        $content = isset($_POST["content"]) ? $_POST["content"] : "";

        if ($id < 1 || $title === "") {
            throw new Exception("파라미터 오류");
        }

        // pdo instance
        $conn = my_db_conn();

        //transaction start
        $conn->beginTransaction();
    }
} catch (Throwable $th) {
    require_once(MY_PATH_ERROR);
    exit;
}

?>

<!DOCTYPE html>
<html lang="ko">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/common.css">
    <link rel="stylesheet" href="./css/index.css">
    <link rel="stylesheet" href="./css/update.css">

    <title>수정 페이지</title>

</head>

<body>
    <?php
    require_once(MY_PATH_ROOT . "header.php");
    ?>
    <main>
        <form action="/update.php" method="post">
            <input type="hidden" name="id" value="<?php echo $result["id"] ?>">
            <input type="hidden" name="id" value="<?php echo $result["id"] ?>">

            <div class="box title-box">
                <div class="box-title">글번호</div>
                <div class="box-content"><?php echo $result["id"] ?></div>
            </div>
            <div class="box title-box">
                <div class="box-title">제목</div>
                <div class="box-content">
                    <input class="box-content" type="text" name="title" id="title" value="<?php echo $result["id"] ?>">
                </div>
            </div>
            <div class="box content-box">
                <div class="box-title">내용</div>
                <div class="box-content">
                    <textarea name="content" id="content"><?php echo $result["content"] ?></textarea>
                </div>
            </div>
            <div class="main-footer">
                <button type="submit" class="btn-small">완료</button>
                <a href="/detail.php?id=<?php echo $result["id"] ?>&page=<?php echo $page ?>"><button type="button" class="btn-small">취소</button></a>
            </div>
        </form>
    </main>
</body>

</html>