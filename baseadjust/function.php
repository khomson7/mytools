<?php 
 include_once('../include/database.php');

 $fetchdata = new MyFunction();
 $sql = $fetchdata->alert('ddd');
 echo $sql;
class MyFunction {

    public function alert($firstname){
        $result = $firstname ;
        return $result;
    }

    public function insertData($table, $data) {
        $columns = array_keys($data);
        $values = array_map(array($this->conn, 'real_escape_string'), array_values($data));
        $values = "'" . implode("', '", $values) . "'";
        $columns = "`" . implode("`, `", $columns) . "`";
        $sql = "INSERT INTO $table ($columns) VALUES ($values)";

        if ($this->conn->query($sql) === TRUE) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $this->conn->error;
        }
    }

    public function personAncPregWeek($person_anc_preg_week_id,$week_min,$week_max,$week_min_quality,$week_max_quality){
        $result = $firstname ;
        return $result;
    }


}

?>