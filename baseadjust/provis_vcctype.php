<?php
// Create a new MySQLConnection object
include_once('../include/database.php');
$url = _URL_;

$tableName = 'prs_provis_vcctype';

$connection->dropTable($tableName);

$connection->createTable($tableName
, 'code char(3) NOT NULL DEFAULT "",
name varchar(150) DEFAULT NULL,
hos_guid varchar(38) DEFAULT NULL,
PRIMARY KEY (code),
UNIQUE KEY ix_name (name)'); 

$curl = curl_init();
            curl_setopt_array($curl, array(
            CURLOPT_URL => "$url/configs/$tableName",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            ));

$response = curl_exec($curl);
curl_close($curl);
$array2 = json_decode($response, true);

foreach ($array2["data"] as $key => $item) {

    //แก้ไขส่วนนี้
    $code = $item['code'];
    $hos_guid = $item['hos_guid'];
    $name = $item['name'];

    $data = array("code" => $code,"name" => $name
      );

      //สิ้นสุด
  
    $connection->insertData("$tableName", $data);

   }
   
   $table0 = 'provis_vcctype';
$table1 = 'prs_provis_vcctype';
$where1 = "prs_provis_vcctype.code not in(select code from provis_vcctype)";
$columns1 = "code,name";
$connection->insertFromSelect($table0, $table1, $where1, $columns1);

$connection->close();


?>