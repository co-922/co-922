<?php
$dbh = new PDO('�e�[�u����', '���[�U�[��','�p�X���[�h');

/*�e�[�u���쐬
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
  �t�@�C���F<br />
  <input type="file" name="upfile" size="30" /><br />
  <br />
  <input type="submit" value="�A�b�v���[�h" />
</form>
</body>
</html>

<?php

// ���M�{�^���������ꂽ��A���͂��󂯎���ăf�[�^�x�[�X�ɉ摜�𑗐M
if (isset($_POST['imageName'])) {
$name = $_POST['imageName'];
} else {
echo '���O����͂��đ��M�{�^���������Ă��������B';
exit;
}
function getPDO() {
// PHP Data Object ��Ԃ�
$dataSourceName = 'mysql:host=localhost;dbname=imagedb;charset=shift-jis';
$user = 'root';
$dbPassword = 'password';

return new PDO($dataSourceName, $user, $dbPassword);
}

// ���M����摜�̒��g�Ɗg���q���擾
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
echo "�o�^����: $name <br>";
echo '<a href="load.php?name='.$name.'">���M�����摜���m�F����</a>';
} catch (Exception $e) {
echo "insert failed: " . $e;
}
?>