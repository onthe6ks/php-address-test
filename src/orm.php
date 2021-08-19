<?php
#ORMっぽい（データ入れる構造だけ）

require_once 'pdo_connect.php';


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
    
    public function insert($dbh){
        #データの追加
        try{
            $insert_sql = 'insert into extra (no,To_Network_Address,Flag_To_Network_Address,From_Network_Address,Flag_From_Network_Address,error) values (:no,:tna,:ftna,:fna,:ffna,:e)';
            
            $insert_prepare = $dbh->prepare($insert_sql);
            
            $insert_prepare->bindValue(':no', $this->no, PDO::PARAM_INT);
            $insert_prepare->bindValue(':tna', $this->to_network_address, PDO::PARAM_STR);
            $insert_prepare->bindValue(':ftna', $this->flag_to_network_address, PDO::PARAM_BOOL);
            $insert_prepare->bindValue(':fna', $this->from_network_address, PDO::PARAM_STR);
            $insert_prepare->bindValue(':ffna', $this->flag_from_network_address, PDO::PARAM_BOOL);
            $insert_prepare->bindValue(':e', $this->error, PDO::PARAM_BOOL);
            
            $insert_prepare->execute();
            
        }catch (Exception $e){
            #データ追加失敗
            echo "DB:EEROR　no.",$this->no,' 捕捉した例外: ',  $e->getMessage(), "\n";
        }
        
    }
    
}

?>
