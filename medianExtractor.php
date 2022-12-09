<?php

function getMedians($assignmentName){
    include "api/studentData.php";
    
    foreach ($assignments as $name){
        if ($name["name"] == $assignmentName){
            return $name["median"];
            break;
        }
    }
}
?>