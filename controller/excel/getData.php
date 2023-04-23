<?php
    require "../../vendor/autoload.php";
    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
    $reader->setReadDataOnly(true);
    $spreadsheet = $reader->load($_FILES['file']['tmp_name']);
    $sheet = $spreadsheet->getSheet($spreadsheet->getFirstSheetIndex());
    $data = $sheet->toArray();
    echo json_encode($data);
?>