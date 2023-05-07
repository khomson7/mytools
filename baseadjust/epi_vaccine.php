<?php
//require_once("../include/database.php");
      include_once('../include/database.php');
      $url = _URL_;
      //ประกาศชื่อตาราง (แก้ไขส่วนนี้)
$tableName = 'prs_epi_vaccine';

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
    $age_max = $item['age_max'];
    $age_min = $item['age_min'];
    $check_code = $item['check_code'];
    $combine_vaccine = $item['combine_vaccine'];
    $epi_vaccine_id = $item['epi_vaccine_id'];
    $epi_vaccine_name = $item['epi_vaccine_name'];
    $export_vaccine_code = $item['export_vaccine_code'];
    $hos_guid = $item['hos_guid'];
    $icode = $item['icode'];
    $price = $item['price'];
    $vaccine_code = $item['vaccine_code'];
    $vaccine_in_use = $item['vaccine_in_use'];

    //echo $epi_vaccine_id;
  
    $data = array("epi_vaccine_id" => $epi_vaccine_id,"epi_vaccine_name" => $epi_vaccine_name,"vaccine_code" => $vaccine_code
    ,"age_min" => $age_min,"age_max" => $age_max,"export_vaccine_code" => $export_vaccine_code,"vaccine_in_use" => $vaccine_in_use,"hos_guid" => $hos_guid
    ,"icode" => $icode,"price" => $price,"combine_vaccine" => $combine_vaccine,"check_code" => $check_code
      );

      //สิ้นสุด
  
    $connection->insertData("$tableName", $data); 

   } 



   ?>