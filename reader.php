<?php
    
    require 'spreadsheet-reader-master/SpreadsheetReader.php';

    require_once 'config.php';

    $Reader = new SpreadsheetReader(FILES_PATH . 'OwlSharesTest.csv');

    foreach ($Reader as $Row) {
        print_r($Row);
    }