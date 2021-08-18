<?php

require_once 'pdo_connect.php';
require_once 'address_utils.php';
require_once 'orm.php';


$sql = 'SELECT * FROM address limit 10';

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
        $extra->to_network_address = cal_network_address($row['ip1'],$row['ip2'],$row['ip3'],$row['ip4'],$array_int_subnet);

        $extra->flag_to_network_address = true;
    }catch (Exception $e){
        #変換の失敗と原因の表示
        echo "no.",$row['no'],' 捕捉した例外: ',  $e->getMessage(), "\n";
        $extra->error = true;
        
        #失敗した場合はネットワークアドレスはないこととDBに入っていた情報をそのまま格納
        $extra->flag_to_network_address = false;
        $extra->to_network_address = $row['ip1'].".".$row['ip2'].".".$row['ip3'].".".$row['ip4'];
        
    }
    
    #データの追加
    try{
        $insert_sql = 'insert into extra (no,To_Network_Address,Flag_To_Network_Address,From_Network_Address,Flag_From_Network_Address,error) values (:no,:tna,:ftna,:fna,:ffna,:e)';
        
        $insert_prepare = $dbh->prepare($insert_sql);
        
        $insert_prepare->bindValue(':no', $extra->no, PDO::PARAM_INT);
        $insert_prepare->bindValue(':tna', $extra->to_network_address, PDO::PARAM_STR);
        $insert_prepare->bindValue(':ftna', $extra->flag_to_network_address, PDO::PARAM_BOOL);
        $insert_prepare->bindValue(':fna', $extra->from_network_address, PDO::PARAM_STR);
        $insert_prepare->bindValue(':ffna', $extra->flag_from_network_address, PDO::PARAM_BOOL);
        $insert_prepare->bindValue(':e', $extra->error, PDO::PARAM_BOOL);
        
        $insert_prepare->execute();
        
    }catch (Exception $e){
        #データ追加失敗
        echo "DB:EEROR　no.",$row['no'],' 捕捉した例外: ',  $e->getMessage(), "\n";
    }
    
/*    echo "===================\n";
    var_dump($row);
    var_dump($extra);

    echo "===================\n";
    */
}



?>