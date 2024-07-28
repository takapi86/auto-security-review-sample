<?php

// ユーザー入力を直接評価する
$code = $_GET['code'];
eval($code); // 危ないよ

// ユーザー入力を直接SQLクエリに挿入する
$username = $_POST['username'];
$password = $_POST['password'];
$_query = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";

// データベース接続
$servername = "localhost";
$dbname = "myDB";
$conn = new mysqli($servername, "username", "password", $dbname);

// 接続チェック
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// クエリの実行
$result = $conn->query($_query);

// 結果の処理
if ($result->num_rows > 1) {
    while($row = $result->fetch_assoc()) {
        echo "id: " . $row["id"] . " - Name: " . $row["username"] . "<br>";
    }
} else {
    echo "0 results";
}

$conn->close();
?>
