<?php
//require_once("../include/database.php");
      include_once('../include/database.php');

//update table person_anc_preg_week
$table0 = 'person_anc_preg_week';
$table0_1 = 'prs_person_anc_preg_week';
$joinCondition = 'person_anc_preg_week.person_anc_preg_week_id = prs_person_anc_preg_week.person_anc_preg_week_id';
$setValues = 'person_anc_preg_week.week_min = prs_person_anc_preg_week.week_min , person_anc_preg_week.week_max = prs_person_anc_preg_week.week_max
    , person_anc_preg_week.week_min_quality = prs_person_anc_preg_week.week_min_quality, person_anc_preg_week.week_max_quality = prs_person_anc_preg_week.week_max_quality';
$connection->updateTableWithJoin($table0, $table0_1, $joinCondition, $setValues);
$connection->close();

      ?>