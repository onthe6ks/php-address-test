<?php

#文字列のサブネットを４つの数字配列に変換する
function convert_int_subnet($str_subnet){

    #.で分割してサブネットを分ける
    $array_str_subnet = explode(".",$str_subnet);

    #intに変換
    $array_int_subnet = array_map('intval',$array_str_subnet);
    
    #4分割されていなければエラー
    if(count($array_int_subnet) != 4){
        throw new Exception('subnet mask invalid. Illegal format');
    }
    
    #IPアドレスの範囲(0-255)でなければエラー
    foreach($array_int_subnet as $oct){
        if($oct < 0 || $oct > 256){
            throw new Exception('subnet mask invalid. out of range');
        }
        
    }
    return $array_int_subnet;
}

#ネットワークアドレスの計算
function cal_network_address($ip1,$ip2,$ip3,$ip4,$subnet_mask){

     #IPアドレスの範囲(0-255)でなければエラー
     #TODO あとで整理したい。キャストを余分に実行している
    if(intval($ip1) < 0 || intval($ip1) > 256){
        throw new Exception('IP address invalid. out of range ip1');
    }

    if(intval($ip2) < 0 || intval($ip2) > 256){
        throw new Exception('IP address invalid. out of range ip2');
    }
    
    if(intval($ip3) < 0 || intval($ip3) > 256){
        throw new Exception('IP address invalid. out of range ip3');
    }
    
    if(intval($ip4) < 0 || intval($ip4) > 256){
        throw new Exception('IP address invalid. out of range ip4');
    }

     
     $octs = [];

     #AND演算で求める
     $octs[0] = intval($ip1) & $subnet_mask[0];
     $octs[1] = intval($ip2) & $subnet_mask[1];
     $octs[2] = intval($ip3) & $subnet_mask[2];
     $octs[3] = intval($ip4) & $subnet_mask[3];
     
     
     return $octs[0].".".$octs[1].".".$octs[2].".".$octs[3];
}


?>
