<?php
if (isset($_GET['id'])) {
$ID = $_GET['id'];
}
$pdo = new PDO('�e�[�u��', '���[�U','�p�X');
// �g���q�ɂ����MIME�^�C�v��؂�ւ��邽�߂̔z��
$MIMETypes = array(
'png' => 'image/png',
'jpg' => 'image/jpeg',
'jpeg' => 'image/jpeg',
'gif' => 'image/gif',
'bmp' => 'image/bmp',
);
try {
$tableName = "ImageData";
// �f�[�^�x�[�X��������Ɉ�v����s�����o��
$data = $pdo->query('SELECT * FROM ' . $tableName . ' WHERE id = "' . $ID . '"')->fetch(PDO::FETCH_ASSOC);
// �摜�Ƃ��Ĉ������߂̐ݒ�
header('Content-type: ' . $MIMETypes[$data['extension']]);
echo $data['image'];
} catch (Exception $e) {
echo "load failed: " . $e;
}
?>