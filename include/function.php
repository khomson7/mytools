<?php 
 include_once('./database.php');

 $fetchdata = new MyFunction();
 $sql = $fetchdata->alert('ddd');
 echo $sql;
class MyFunction {

    public function alert($firstname){
        $result = $firstname ;
        return $result;
    }


}

?>