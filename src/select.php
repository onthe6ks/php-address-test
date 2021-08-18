<?php

require_once 'pdo_connect.php';
require_once 'address_utils.php';
require_once 'orm.php';


$sql = 'SELECT * FROM address limit 2';

$prepare = $dbh->prepare($sql);

// プリペアドステートメントを実行する
$prepare->execute();


// 結果を出力
//var_dump($result);

foreach ($prepare as $row) {
    
    $extra = new OrmExtra($row['no']);
    

    #サブネットの形式が正しいか確認    
    try{
        $array_int_subnet = convert_int_subnet($row['subnet_mask']);

    }catch (Exception $e) {
        #変換の失敗と原因の表示
        echo "no.",$row['no'],' 捕捉した例外: ',  $e->getMessage(), "\n";
        $extra->error = true;
    }


    #ネットワークアドレスに変換できるか
    try{
#        $extra->to_network_address = cal_network_address($row['ip1'],$row['ip2'],$row['ip3'],$row['ip4'],$array_int_subnet);
        $extra->to_network_address = cal_network_address("-2",$row['ip2'],$row['ip3'],$row['ip4'],$array_int_subnet);

        $extra->flag_to_network_address = true;
    }catch (Exception $e){
        #変換の失敗と原因の表示
        echo "no.",$row['no'],' 捕捉した例外: ',  $e->getMessage(), "\n";
        $extra->error = true;
        
        #失敗した場合はネットワークアドレスはないこととDBに入っていた情報をそのまま格納
        $extra->flag_to_network_address = false;
        $extra->to_network_address = $row['ip1'].".".$row['ip2'].".".$row['ip3'].".".$row['ip4'];
        
    }

    
    
    echo "===================\n";
    var_dump($row);
    var_dump($extra);

    echo "===================\n";
}



?>