<?php
//require_once("../include/database.php");
      include_once('../include/database.php');
      $url = _URL_;
      //ประกาศชื่อตาราง (แก้ไขส่วนนี้)
$tableName = 'prs_person_anc_preg_week';

$connection->dropTable($tableName);

$api = new API("$url/configs/command/$tableName");
      $data = $api->getData();

      
      foreach($data["data"] as $key =>$row) {

      //  $drop_table = $row["table_name"];

        $create_table = $row["create_table"];

        $connection->createTable2($create_table);

       // echo $create_table; 
      }

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
    $person_anc_preg_week_id = $item['person_anc_preg_week_id'];
    $week_min= $item['week_min'];
    $week_max= $item['week_max'];
    $week_min_quality= $item['week_min_quality'];
    $week_max_quality= $item['week_max_quality'];
  
    $data = array("person_anc_preg_week_id" => $person_anc_preg_week_id, "week_min" => $week_min
    ,"week_max" => $week_max,"week_min_quality"=> $week_min_quality,"week_max_quality"=> $week_max_quality
      );

      //สิ้นสุด
  
    $connection->insertData("$tableName", $data);

   } 

   $connection->close();