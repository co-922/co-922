<?php
$dbh = new PDO('データベース名', 'ユーザー名','パスワード');
$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$sql = 'CREATE TABLE renshu1(
		id INT(5) PRIMARY KEY AUTO_INCREMENT,
		name VARCHAR(20),
		password VARCHAR(100)
		)';
$dbh->exec($sql);
	echo "Table created successfully";
$sql = 'select * from renshu1';
	$stmt = $dbh->prepare($sql);
	$stmt->execute();
	while($result = $stmt->fetch(PDO::FETCH_ASSOC)){
		echo $result['id'].'<br>';
		echo $result['name'].'<br>';
		echo $result['comment'].'<br>';
		echo $result['time'].'<br>';
	}
while ($data = mysql_fetch_array($result)) {
  echo $data['name'];
}	
?>