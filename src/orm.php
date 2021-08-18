<?php
#ORMっぽい（データ入れる構造だけ）

class OrmExtra
{
    public $no = null;
    public $to_network_address = null;
    public $flag_to_network_address = false;
    public $from_network_address = null;
    public $flag_from_network_address = false;
    public $error = false;
    
    #コンストラクタ
    function __construct($no){
        $this->no = $no;
    }
    
}

?>
