<?php
$dbh = new PDO('テーブル名', 'ユーザー名','パスワード');

/*テーブル作成
$sql = 'CREATE TABLE ImageData (
id INT(5) PRIMARY KEY AUTO_INCREMENT,
name varchar(20) NOT NULL,
image blob NOT NULL,
extension varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8';
$dbh -> exec($sql);
	echo "Table created successfully";
*/
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=shift-jis" />
<title>sample</title>
</head>
<body>
<form action="3-8gazouload.php" method="post" enctype="multipart/form-data">
  ファイル：<br />
  <input type="file" name="upfile" size="30" /><br />
  <br />
  <input type="submit" value="アップロード" />
</form>
</body>
</html>

<?php

// 送信ボタンが押されたら、入力を受け取ってデータベースに画像を送信
if (isset($_POST['imageName'])) {
$name = $_POST['imageName'];
} else {
echo '名前を入力して送信ボタンを押してください。';
exit;
}
function getPDO() {
// PHP Data Object を返す
$dataSourceName = 'mysql:host=localhost;dbname=imagedb;charset=shift-jis';
$user = 'root';
$dbPassword = 'password';

return new PDO($dataSourceName, $user, $dbPassword);
}

// 送信する画像の中身と拡張子を取得
$imagePath = $_FILES['upfile']['name'];
$image = file_get_contents($imagePath);
$extension = pathinfo($imagePath, PATHINFO_EXTENSION);
try {
$pdo = getPDO();
$tableName = "ImageData";
$insert = $pdo->prepare('INSERT INTO ' . $tableName . ' (name, image, extension) VALUES (:name, :image, :extension)');
$insert->bindValue(':name', $name, PDO::PARAM_STR);
$insert->bindValue(':image', $image, PDO::PARAM_LOB);
$insert->bindValue(':extension', $extension, PDO::PARAM_STR);
$insert->execute();
echo "登録完了: $name <br>";
echo '<a href="load.php?name='.$name.'">送信した画像を確認する</a>';
} catch (Exception $e) {
echo "insert failed: " . $e;
}
?>