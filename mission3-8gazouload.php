<?php
if (isset($_GET['id'])) {
$ID = $_GET['id'];
}
$pdo = new PDO('テーブル', 'ユーザ','パス');
// 拡張子によってMIMEタイプを切り替えるための配列
$MIMETypes = array(
'png' => 'image/png',
'jpg' => 'image/jpeg',
'jpeg' => 'image/jpeg',
'gif' => 'image/gif',
'bmp' => 'image/bmp',
);
try {
$tableName = "ImageData";
// データベースから条件に一致する行を取り出す
$data = $pdo->query('SELECT * FROM ' . $tableName . ' WHERE id = "' . $ID . '"')->fetch(PDO::FETCH_ASSOC);
// 画像として扱うための設定
header('Content-type: ' . $MIMETypes[$data['extension']]);
echo $data['image'];
} catch (Exception $e) {
echo "load failed: " . $e;
}
?>