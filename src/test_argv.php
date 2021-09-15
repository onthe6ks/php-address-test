<?php



$num1 = $argv[1];
$num2 = $argv[2];
echo $num1.$num2."\n";

require_once 'pdo_connect.php';
require_once 'address_utils.php';
require_once 'orm.php';


$dbh = get_dbh();
/*
$sql = 'SELECT * FROM address limit 10';

$prepare = $dbh->prepare($sql);
*/

// プリペアドステートメントを実行する
$update_sql = "update extra set ".$num1." = :num2 where no = 1";
            
$update_prepare = $dbh->prepare($update_sql);
            
#$update_prepare->bindValue(':num1', $num1, PDO::PARAM_STR);
$update_prepare->bindValue(':num2', $num2, PDO::PARAM_STR);

$update_prepare->execute();


?>