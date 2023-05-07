<?php
//require_once("../include/database.php");
      include_once('../include/database.php');
      $url = _URL_;


      $api0 = new API("$url/configs/prsdbcommand");
      $data0 = $api0->getData();

      foreach($data0 as $row) {

         $drop_table = $row["table_names"];

//echo $drop_table;
         $connection->dropTable($drop_table);
      

      
      //Api
      $api = new API("$url/configs/command/$drop_table");
      $data = $api->getData();

      
      foreach($data["data"] as $key =>$row) {

      //  $drop_table = $row["table_name"];

        $create_table = $row["create_table"];

        $connection->createTable2($create_table);

       // echo $create_table; 
      }
//createTabble function
          
        }


      

      ?>