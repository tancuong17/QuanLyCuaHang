<?php
    require "../../vendor/autoload.php";
    use PhpOffice\PhpSpreadsheet\Spreadsheet;
    use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
    use PhpOffice\PhpSpreadsheet\Style\Border;
    use PhpOffice\PhpSpreadsheet\Style\Color;
    date_default_timezone_set("Asia/Bangkok");
    $connect = new PDO('mysql:host=localhost;dbname=milktea', 'root', '');
    $startDate = $_POST['startDateStatistical'];
    $endDate = $_POST['endDateStatistical'];
    $stament = $connect->prepare("SELECT detail_bill.id_product, product.name, SUM(detail_bill.quantity) as quantity, price.price * SUM(detail_bill.quantity) as total, price.price as price FROM bill INNER JOIN detail_bill ON bill.id and detail_bill.id_order INNER JOIN product ON detail_bill.id_product INNER JOIN price ON product.id = price.id_product WHERE bill.id = detail_bill.id_order and detail_bill.id_product = product.id and product.id = price.id_product AND time(price.start_date) <= time(bill.create_date) AND time(price.end_date) >= time(bill.create_date) and bill.create_date >= date(?) and bill.create_date <= date(?) GROUP BY detail_bill.id_product ORDER BY quantity DESC");
    $stament->execute([$startDate, $endDate]);
    $stament2 = $connect->prepare("SELECT detail_bill.id_product, product.name, SUM(detail_bill.quantity) as quantity, product.price * SUM(detail_bill.quantity) as total, product.price as price FROM bill INNER JOIN detail_bill ON bill.id and detail_bill.id_order INNER JOIN product ON detail_bill.id_product INNER JOIN price ON product.id = price.id_product WHERE bill.id = detail_bill.id_order and detail_bill.id_product = product.id and product.id = price.id_product and bill.create_date >= date(?) and bill.create_date <= date(?) GROUP BY detail_bill.id_product ORDER BY quantity DESC");
    $stament2->execute([$startDate, $endDate]);
    $result = array();
    $result2 = array();
    while ($row = $stament->fetch()) {
        array_push($result, array("id" => $row['id_product'], "name" => $row["name"], "quantity" => $row["quantity"], "price" => $row["price"], "total" => $row["total"]));
    }
    while ($row = $stament2->fetch()) {
        array_push($result2, array("id" => $row['id_product'], "name" => $row["name"], "quantity" => $row["quantity"], "price" => $row["price"], "total" => $row["total"]));
    }
    $result3 = array_diff_key($result2, $result);
    $data = array_merge($result, $result3);
    $spreadsheet = new Spreadsheet();
    $Excel_writer = new Xlsx($spreadsheet);
    $spreadsheet->setActiveSheetIndex(0);
    $sheet = $spreadsheet->getActiveSheet();
    $sheet->setShowGridlines(false);
    foreach (range('A','F') as $col) {
        $sheet->getColumnDimension($col)->setAutoSize(true);
    };
    $sheet->setCellValue("A1", "Tiệm trà sữa NTC Milk&Tea");
    $sheet->setCellValue("A2", "180 Phan Huy Ích, phường 12, quận Gò Vấp, thành phố Hồ Chí Minh");
    $sheet->setCellValue("A3", "Ngày in: ".date("Y/m/d"));
    $sheet->setCellValue("A4", "THỐNG KÊ DOANH THU")->getStyle('A4')->getAlignment()->setHorizontal('center');
    $sheet->getStyle('A4')->getFont()->setBold(true);
    $sheet->mergeCells("A1:F1");
    $sheet->mergeCells("A2:F2");
    $sheet->mergeCells("A3:F3");
    $sheet->mergeCells("A4:F4");
    $sheet->setCellValue("A5", "(".$startDate." đến ".$endDate.")")->getStyle('A5')->getAlignment()->setHorizontal('center');
    $sheet->mergeCells("A5:F5");
    $sheet->setCellValue("A7", "STT");
    $sheet->setCellValue("B7", "Mã sản phẩm");
    $sheet->setCellValue("C7", "Tên sản phẩm");
    $sheet->setCellValue("D7", "Đơn giá sản phẩm");
    $sheet->setCellValue("E7", "Số lượng bán được");
    $sheet->setCellValue("F7", "Doanh thu sản phẩm");
    $sheet->getStyle("A7:F7")->getAlignment()->setHorizontal('center');
    $sheet->getStyle("A7:F7")->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN)->setColor(new Color('000000'));
    $sheet->getStyle("A7:F7")->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('F5F5F5');
    $rowCount = 8;
    $quantityAll = 0;
    $moneyAll = 0;
    for ($i=0; $i < count($data); $i++) {
        $quantityAll += $data[$i]["quantity"];
        $moneyAll += $data[$i]["total"];
        $sheet->setCellValue("A".$rowCount, $i + 1);
        $sheet->setCellValue("B".$rowCount, $data[$i]["id"]);
        $sheet->setCellValue("C".$rowCount, $data[$i]["name"]);
        $sheet->setCellValue("D".$rowCount, $data[$i]["price"]);
        $sheet->setCellValue("E".$rowCount, $data[$i]["quantity"]);
        $sheet->setCellValue("F".$rowCount, $data[$i]["total"]);
        $sheet->getStyle("A".$rowCount.":F".$rowCount)->getNumberFormat()->setFormatCode('#,##0');
        $sheet->getStyle("A".$rowCount)->getAlignment()->setHorizontal('center');
        $sheet->getStyle("B".$rowCount)->getAlignment()->setHorizontal('left');
        $sheet->getStyle("A".$rowCount.":F".$rowCount)->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN)->setColor(new Color('000000'));
        if(($i + 1) == count($data)){
            $sheet->setCellValue("A".($rowCount + 1), "Tổng kết");
            $sheet->setCellValue("B".($rowCount + 1), "");
            $sheet->setCellValue("C".($rowCount + 1), "");
            $sheet->setCellValue("D".($rowCount + 1), "");
            $sheet->setCellValue("E".($rowCount + 1), $quantityAll);
            $sheet->setCellValue("F".($rowCount + 1), $moneyAll);
            $sheet->getStyle("E".($rowCount + 1).":F".($rowCount + 1))->getNumberFormat()->setFormatCode('#,##0');
            $sheet->getStyle('A'.($rowCount + 1))->getFont()->setBold(true);
            $sheet->getStyle('E'.($rowCount + 1))->getFont()->setBold(true);
            $sheet->getStyle('F'.($rowCount + 1))->getFont()->setBold(true);
            $sheet->getStyle("A".($rowCount + 1).":F".($rowCount + 1))->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN)->setColor(new Color('000000'));
        }
        $rowCount += 1;
    }
    $filename = time() . '.xlsx';
    header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment;filename=' . $filename);
    header('Cache-Control: max-age=0');
    $Excel_writer->save('php://output');
    exit();
?>