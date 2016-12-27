<?php
    require('spreadsheet-reader-master/SpreadsheetReader.php');

    $Reader = new SpreadsheetReader('example.xlsx');
    
    foreach ($Reader as $Row)
    {
        print_r($Row);
    }