<?php

require_once 'pdo_connect.php';
require_once 'address_utils.php';

$sql = 'SELECT * FROM address limit 2';

$prepare = $dbh->prepare($sql);

// プリペアドステートメントを実行する
$prepare->execute();

// PDO::FETCH_ASSOCは、対応するカラム名にふられているものと同じキーを付けた 連想配列として取得します。
//$result = $prepare->fetchAll(PDO::FETCH_ASSOC);

// 結果を出力
//var_dump($result);

foreach ($prepare as $row) {
 
// データベースのフィールド名で出力
//echo $row['no'].'：'.$row['subnet_mask']."\n";

#.で分割してサブネットを分ける

#$array_int_subnet = convert_int_subnet($row['subnet_mask']);

$array_int_subnet = convert_int_subnet("");

echo "===================\n";
var_dump($array_int_subnet);
echo "===================\n";
}



?>