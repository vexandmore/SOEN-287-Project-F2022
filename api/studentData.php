<?php

$out = array (
    "assignments" => array(
        array("name" => "Assignment1", "median" => 74),
        array("name" => "Assignment2", "median" => 80),
        array("name" => "Assignment3", "median" => 90),
    ),
    "studentData" => array(
        array(
            "name" => "Sophie", 
            "assignments" => array(
                array("name" => "Assignment1", "grade" => 88),
                array("name" => "Assignment2", "grade" => 70),
                array("name" => "Assignment3", "grade" => 92)
            ),
            "report" => array(
                "standard-deviation" => 15,
                "rank" => 18,
                "percentile" => 51
            )
        )
    )
);

$out_json = json_encode($out);

echo $out_json;

?>