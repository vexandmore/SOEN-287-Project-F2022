<?php

if ($_SERVER['REQUEST_METHOD']=='POST')

    {
        #SELECT Grade FROM `grades` WHERE StudentID=40291824;
        #Dont know how to convert above sql query to php
        
        $Assignment_1 = floatval ($_POST['Assignment1']);
        $Assignment_2 = floatval ($_POST['Assignment2']);
        $Assignment_3 = floatval ($_POST['Assignment3']);
        $Final = floatval ($_POST['Final']);
        $Midterm = floatval ($_POST['Midterm']);
        $Project_1 = floatval ($_POST['Project_1']);
        $Project_2 = floatval ($_POST['Project_2']);
        $Q1 = floatval ($_POST['Q1']);
        $Q2 = floatval ($_POST['Q2']);
        $Q3 = floatval ($_POST['Q3']);
        $Marks=(($Q1+$Q2+$Q3+$Project_1+$Project_2+$Assignment_1+$Assignment_2++$Assignment_3+$Midterm+$Final)/9);
        
        echo $Marks
    }
