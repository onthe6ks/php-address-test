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

?>
