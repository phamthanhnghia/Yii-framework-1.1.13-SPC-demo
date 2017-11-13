<?php
class ExportList
{
     public static $replace = array("<br>","<BR>");
     public static $replaceNewLine = "\r\n";
     public static $remove = array( "&nbsp;", "<p>", "</p>", "<div>", "</div>","<b>","</b>");
      // Nguyen Dung 10-29-2013
      public static function Export_list_maintain(){
      try{
        Yii::import('application.extensions.vendors.PHPExcel',true);
        $objPHPExcel = new PHPExcel();
        // Set properties
        $objPHPExcel->getProperties()->setCreator("NguyenDung")
                                        ->setLastModifiedBy("NguyenDung")
                                        ->setTitle('Danh Sách Bảo Trì')
                                        ->setSubject("Office 2007 XLSX Document")
                                        ->setDescription("List Maintain")
                                        ->setKeywords("office 2007 openxml php")
                                        ->setCategory("Gas");
        $row=1;
        $i=1;
        $dataAll = $_SESSION['data-excel']->data;
        $cmsFormatter = new CmsFormatter();	

        // 1.sheet 1 Đại Lý
        $objPHPExcel->setActiveSheetIndex(0);		
        $objPHPExcel->getActiveSheet()->getDefaultStyle()->getFont()->setName('Times New Roman');
        $objPHPExcel->getActiveSheet()->getDefaultStyle()->getFont()->setSize(12);            
        $objPHPExcel->getActiveSheet()->setTitle('DS Bảo Trì'); 
        $objPHPExcel->getActiveSheet()->setCellValue("A$row", 'Danh Sách Bảo Trì');
        $objPHPExcel->getActiveSheet()->getStyle("A$row")->getFont()
                            ->setBold(true);    			
        $objPHPExcel->getActiveSheet()->mergeCells("A$row:H$row");
        $row++;
        $index=1;
        $beginBorder = $row;
        $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($index++)."$row", 'SN');
        $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($index++)."$row", 'Đại Lý');
        $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($index++)."$row", 'Ngày Bảo Trì');
        $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($index++)."$row", 'Mã Khách Hàng');
        $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($index++)."$row", 'Khách Hàng');
        $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($index++)."$row", 'Địa Chỉ');
        $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($index++)."$row", 'Điện Thoại');
        $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($index++)."$row", 'Nhân Viên Bảo Trì');
        $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($index++)."$row", 'Thương Hiệu Gas');
        $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($index++)."$row", 'Số Seri');
        $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($index++)."$row", 'Đang Dùng Gas Hướng Minh');
        $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($index++)."$row", 'Ghi Chú');
        $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($index++)."$row", 'Ghi Chú Sau Cuộc Gọi');
        $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($index++)."$row", 'Trạng Thái');
        $index--;

        $objPHPExcel->getActiveSheet()->getStyle("A$row:".MyFunctionCustom::columnName($index).$row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle("A$row:".MyFunctionCustom::columnName($index).$row)->getFont()
                            ->setBold(true);    	
        $row++;

        foreach($dataAll as $data):
            $index=1;
            $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($index++)."$row", $i);
            $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($index++)."$row", $data->agent?$data->agent->first_name:"");
            $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($index++)."$row", $cmsFormatter->formatDate($data->maintain_date));
            $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($index++)."$row", $data->customer?$data->customer->code_bussiness:"");
            $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($index++)."$row", $data->customer?$cmsFormatter->formatNameUser($data->customer):"");
            $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($index++)."$row", $data->customer?$data->customer->address:"");
            $objPHPExcel->getActiveSheet()->setCellValueExplicit(MyFunctionCustom::columnName($index++)."$row",$data->customer?$data->customer->phone:"", PHPExcel_Cell_DataType::TYPE_STRING);
            $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($index++)."$row", $data->maintain_employee?$data->maintain_employee->first_name:"");
            $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($index++)."$row", $data->materials?$data->materials->name:"");
            $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($index++)."$row", $data->seri_no);
            $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($index++)."$row", CmsFormatter::$yesNoFormat[$data->using_gas_huongminh]);
            $note = str_replace(ExportList::$replace, ExportList::$replaceNewLine, $data->note);
            $note = str_replace(ExportList::$remove, " ", $note);            
            $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($index++)."$row", $note);

            $note = str_replace(ExportList::$replace, ExportList::$replaceNewLine, $data->note_update_status);
            $note = str_replace(ExportList::$remove, " ", $note);                            
            $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($index++)."$row", $note);
            $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($index++)."$row", CmsFormatter::$STATUS_MAINTAIN[$data->status]);
            $row++;
            $i++;
        endforeach;	// end body

        $objPHPExcel->getActiveSheet()->getStyle("B$beginBorder:N".$row)
            ->getAlignment()->setWrapText(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(22);
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(15);
        $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(15);
        $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(30);
        $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(15);
        $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(18);
        $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(10);
        $objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(10);

        $row--;		
        $index--;
        $objPHPExcel->getActiveSheet()->getStyle("A$beginBorder:".MyFunctionCustom::columnName($index).$row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);		
        $objPHPExcel->getActiveSheet()->getStyle("A$beginBorder:".MyFunctionCustom::columnName($index).$row)
                        ->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);		

        //save file
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');

        for($level=ob_get_level();$level>0;--$level)
        {
                @ob_end_clean();
        }
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Pragma: public');
        header('Content-type: '.'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="'.'Danh Sách Bảo Trì'.'.'.'xlsx'.'"');

        header('Cache-Control: max-age=0');				
        $objWriter->save('php://output');			
        Yii::app()->end();
        }catch (Exception $e)
        {
            MyFormat::catchAllException($e);
        }     
      }
	  
      // Nguyen Dung 10-29-2013
      public static function Export_list_maintain_sell(){
          try{
        Yii::import('application.extensions.vendors.PHPExcel',true);
        $objPHPExcel = new PHPExcel();
        // Set properties
        $objPHPExcel->getProperties()->setCreator("NguyenDung")
                                        ->setLastModifiedBy("NguyenDung")
                                        ->setTitle('Danh Sách Bán Hàng Bảo Trì')
                                        ->setSubject("Office 2007 XLSX Document")
                                        ->setDescription("List Maintain Sell")
                                        ->setKeywords("office 2007 openxml php")
                                        ->setCategory("Gas");
        $row=1;
        $i=1;
        $dataAll = $_SESSION['data-excel']->data;
        $cmsFormatter = new CmsFormatter();	

        // 1.sheet 1 Đại Lý
        $objPHPExcel->setActiveSheetIndex(0);
        $objPHPExcel->getActiveSheet()->getDefaultStyle()->getFont()->setName('Times New Roman');
        $objPHPExcel->getActiveSheet()->getDefaultStyle()->getFont()->setSize(12);            

        $objPHPExcel->getActiveSheet()->setTitle('Bán Hàng Bảo Trì'); 
        $objPHPExcel->getActiveSheet()->setCellValue("A$row", 'Danh Sách Bán Hàng Bảo Trì');
        $objPHPExcel->getActiveSheet()->getStyle("A$row")->getFont()
                            ->setBold(true);    			
        $objPHPExcel->getActiveSheet()->mergeCells("A$row:H$row");
        $row++;
        $index=1;
        $beginBorder = $row;
        $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($index++)."$row", 'SN');
        $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($index++)."$row", 'Đại Lý');
        $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($index++)."$row", 'Ngày Bán');
        $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($index++)."$row", 'NV PTTT');
        $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($index++)."$row", 'Mã Khách Hàng');
        $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($index++)."$row", 'Khách Hàng');
        $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($index++)."$row", 'Địa Chỉ');
        $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($index++)."$row", 'Điện Thoại');
        $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($index++)."$row", 'PTTT');
        $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($index++)."$row", 'Thương Hiệu Gas Bán');
        $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($index++)."$row", 'SL Vỏ Thu Về');
        $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($index++)."$row", 'Thương Hiệu Gas Vỏ');
        $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($index++)."$row", 'Seri Thu Về');
        $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($index++)."$row", 'Trùng Seri Bảo Trì');
        $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($index++)."$row", 'Ghi Chú Sau Cuộc Gọi');
        $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($index++)."$row", 'Trạng Thái');
        $index--;

        $objPHPExcel->getActiveSheet()->getStyle("A$row:".MyFunctionCustom::columnName($index).$row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle("A$row:".MyFunctionCustom::columnName($index).$row)->getFont()
                            ->setBold(true);    	
        $row++;
        foreach($dataAll as $data):	
            $index=1;
            $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($index++)."$row", $i);
            $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($index++)."$row", $data->agent?$data->agent->first_name:"");
            $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($index++)."$row", $cmsFormatter->formatDate($data->date_sell));
            $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($index++)."$row", $data->maintain_employee?$data->maintain_employee->first_name:"");
            $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($index++)."$row", $data->customer?$data->customer->code_bussiness:"");
            $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($index++)."$row", $data->customer?$cmsFormatter->formatNameUser($data->customer):"");
            $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($index++)."$row", $data->customer?$data->customer->address:"");
            $objPHPExcel->getActiveSheet()->setCellValueExplicit(MyFunctionCustom::columnName($index++)."$row",$data->customer?$data->customer->phone:"", PHPExcel_Cell_DataType::TYPE_STRING);
            $MaintainHistory=$cmsFormatter->formatMaintainHistory($data);
            $MaintainHistory = str_replace(ExportList::$replace, ExportList::$replaceNewLine, $MaintainHistory);
            $MaintainHistory = str_replace(ExportList::$remove, " ", $MaintainHistory);                            
            $MaintainHistory = strip_tags($MaintainHistory);
            $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($index++)."$row", $MaintainHistory);
            $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($index++)."$row", $data->materials_sell?$data->materials_sell->name:"");
            $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($index++)."$row", $data->quantity_vo_back);
            $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($index++)."$row", $data->materials_back?$data->materials_back->name:"");
            $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($index++)."$row", $data->seri_back);
            $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($index++)."$row", CmsFormatter::$STATUS_SAME_SERI[$data->is_same_seri_maintain]);

            $note = str_replace(ExportList::$replace, ExportList::$replaceNewLine, $data->note_update_status);
            $note = str_replace(ExportList::$remove, " ", $note);            
            $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($index++)."$row", $note);
            $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($index++)."$row", CmsFormatter::$STATUS_MAINTAIN[$data->status]);
//                $objPHPExcel->getActiveSheet()->getRowDimension($row)->setRowHeight(30);
            $row++;
            $i++;
        endforeach;	
        $row--;		
        $index--;
        $objPHPExcel->getActiveSheet()->getStyle("A$beginBorder:".MyFunctionCustom::columnName($index).$row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);		
        $objPHPExcel->getActiveSheet()->getStyle("A$beginBorder:".MyFunctionCustom::columnName($index).$row)
                        ->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);		
        $objPHPExcel->getActiveSheet()->getStyle("B$beginBorder:".MyFunctionCustom::columnName($index).$row)
            ->getAlignment()->setWrapText(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(22);
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(15);
        $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(15);
        $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(15);
        $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(30);
        $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(30);
        $objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(10);
        $objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(10);
        $objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('O')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('O')->setWidth(10);


        //save file
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');

        for($level=ob_get_level();$level>0;--$level)
        {
                @ob_end_clean();
        }
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Pragma: public');
        header('Content-type: '.'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="'.'Bán Hàng Bảo Trì'.'.'.'xlsx'.'"');

        header('Cache-Control: max-age=0');				
        $objWriter->save('php://output');			
        Yii::app()->end();
        }catch (Exception $e)
        {
            MyFormat::catchAllException($e);
        }     
      }
	  
      // 10-31-2013 ANH DUNG
      public static function Export_list_for_monitoring_maintain(){
          try{
        Yii::import('application.extensions.vendors.PHPExcel',true);
        $objPHPExcel = new PHPExcel();
        // Set properties
        $objPHPExcel->getProperties()->setCreator("NguyenDung")
                                        ->setLastModifiedBy("NguyenDung")
                                        ->setTitle('Bảo Trì Xuống Lại')
                                        ->setSubject("Office 2007 XLSX Document")
                                        ->setDescription("List Maintain")
                                        ->setKeywords("office 2007 openxml php")
                                        ->setCategory("Gas");
        $row=1;
        $i=1;
        $dataAll = $_SESSION['data-excel']->data;
        $cmsFormatter = new CmsFormatter();	

        // 1.sheet 1 Đại Lý
        $objPHPExcel->setActiveSheetIndex(0);		
        $objPHPExcel->getActiveSheet()->getDefaultStyle()->getFont()->setName('Times New Roman');
        $objPHPExcel->getActiveSheet()->getDefaultStyle()->getFont()->setSize(12);            
        $objPHPExcel->getActiveSheet()->setTitle('Bảo Trì Xuống Lại'); 
        $objPHPExcel->getActiveSheet()->setCellValue("A$row", 'Danh Sách Bảo Trì Cần Xuống Lại');
        $objPHPExcel->getActiveSheet()->getStyle("A$row")->getFont()
                            ->setBold(true);    			
        $objPHPExcel->getActiveSheet()->mergeCells("A$row:H$row");
        $row++;
        $index=1;
        $beginBorder = $row;
        $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($index++)."$row", 'SN');
        $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($index++)."$row", 'Đại Lý');
        $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($index++)."$row", 'Ngày Bảo Trì');
        $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($index++)."$row", 'Mã Khách Hàng');
        $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($index++)."$row", 'Khách Hàng');
        $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($index++)."$row", 'Địa Chỉ');
        $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($index++)."$row", 'Điện Thoại');
        $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($index++)."$row", 'Ghi Chú');
        $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($index++)."$row", 'Ghi Chú Sau Cuộc Gọi');
        $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($index++)."$row", 'Trạng Thái');
        $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($index++)."$row", 'Kết Quả Xử Lý');
        $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($index++)."$row", 'Ghi Chú Sau Xử Lý');
        $index--;

        $objPHPExcel->getActiveSheet()->getStyle("A$row:".MyFunctionCustom::columnName($index).$row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle("A$row:".MyFunctionCustom::columnName($index).$row)->getFont()
                            ->setBold(true);    	
        $row++;
        foreach($dataAll as $data):	
            $index=1;
            $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($index++)."$row", $i);
            $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($index++)."$row", $data->agent?$data->agent->first_name:"");
            $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($index++)."$row", $cmsFormatter->formatDate($data->maintain_date));
            $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($index++)."$row", $data->customer?$data->customer->code_bussiness:"");
            $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($index++)."$row", $data->customer?$cmsFormatter->formatNameUser($data->customer):"");
            $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($index++)."$row", $data->customer?$data->customer->address:"");                
            $objPHPExcel->getActiveSheet()->setCellValueExplicit(MyFunctionCustom::columnName($index++)."$row",$data->customer?$data->customer->phone:"", PHPExcel_Cell_DataType::TYPE_STRING);
            $note = str_replace(ExportList::$replace, ExportList::$replaceNewLine, $data->note);
            $note = str_replace(ExportList::$remove, " ", $note);            
            $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($index++)."$row", $note);
            $note = str_replace(ExportList::$replace, ExportList::$replaceNewLine, $data->note_update_status);
            $note = str_replace(ExportList::$remove, " ", $note);                            
            $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($index++)."$row", $note);
            $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($index++)."$row", CmsFormatter::$STATUS_MAINTAIN[$data->status]);
            // Kết Quả Xử Lý
            $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($index++)."$row", CmsFormatter::$STATUS_MAINTAIN_BACK[$data->status_maintain_back]);
            $note = str_replace(ExportList::$replace, ExportList::$replaceNewLine, $data->note_maintain_back);
            $note = str_replace(ExportList::$remove, " ", $note);                            
            $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($index++)."$row", $note);
            $row++;
            $i++;
        endforeach;	
        $row--;		
        $index--;
        $objPHPExcel->getActiveSheet()->getStyle("A$beginBorder:".MyFunctionCustom::columnName($index).$row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);		
        $objPHPExcel->getActiveSheet()->getStyle("A$beginBorder:".MyFunctionCustom::columnName($index).$row)
                        ->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);		
        $objPHPExcel->getActiveSheet()->getStyle("B$beginBorder:L".$row)
            ->getAlignment()->setWrapText(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(22);
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(15);
        $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(15);
        $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(30);
        $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(15);
        $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(30);
        $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(10);
        $objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(10);

        //save file
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');

        for($level=ob_get_level();$level>0;--$level)
        {
                @ob_end_clean();
        }
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Pragma: public');
        header('Content-type: '.'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="'.'Bảo Trì Cần Xuống Lại'.'.'.'xlsx'.'"');

        header('Cache-Control: max-age=0');				
        $objWriter->save('php://output');			
        Yii::app()->end();
        }catch (Exception $e)
        {
            MyFormat::catchAllException($e);
        }     
      }	        
      
      // 10-31-2013 ANH DUNG
      public static function Export_supervision_list_maintain_call_bad(){
          try{
        Yii::import('application.extensions.vendors.PHPExcel',true);
        $objPHPExcel = new PHPExcel();
        // Set properties
        $objPHPExcel->getProperties()->setCreator("NguyenDung")
                                        ->setLastModifiedBy("NguyenDung")
                                        ->setTitle('Bảo Trì Gọi Xấu')
                                        ->setSubject("Office 2007 XLSX Document")
                                        ->setDescription("List Maintain")
                                        ->setKeywords("office 2007 openxml php")
                                        ->setCategory("Gas");
        $row=1;
        $i=1;
        $dataAll = $_SESSION['data-excel']->data;
        $cmsFormatter = new CmsFormatter();	

        // 1.sheet 1 Đại Lý
        $objPHPExcel->setActiveSheetIndex(0);		
        $objPHPExcel->getActiveSheet()->getDefaultStyle()->getFont()->setName('Times New Roman');
        $objPHPExcel->getActiveSheet()->getDefaultStyle()->getFont()->setSize(12);            
        $objPHPExcel->getActiveSheet()->setTitle('Bảo Trì Gọi Xấu'); 
        $objPHPExcel->getActiveSheet()->setCellValue("A$row", 'Danh Sách Bảo Trì Có Cuộc Gọi Xấu');
        $objPHPExcel->getActiveSheet()->getStyle("A$row")->getFont()
                            ->setBold(true);    			
        $objPHPExcel->getActiveSheet()->mergeCells("A$row:H$row");
        $row++;
        $index=1;
        $beginBorder = $row;
        $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($index++)."$row", 'SN');
        $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($index++)."$row", 'Đại Lý');
        $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($index++)."$row", 'Ngày Bảo Trì');
        $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($index++)."$row", 'Mã Khách Hàng');
        $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($index++)."$row", 'Khách Hàng');
        $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($index++)."$row", 'Địa Chỉ');
        $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($index++)."$row", 'Điện Thoại');
        $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($index++)."$row", 'Ghi Chú');
        $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($index++)."$row", 'Ghi Chú Sau Cuộc Gọi');
        $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($index++)."$row", 'Trạng Thái');
        $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($index++)."$row", 'Kết Quả Xử Lý');
        $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($index++)."$row", 'Ghi Chú Sau Xử Lý');
        $index--;

        $objPHPExcel->getActiveSheet()->getStyle("A$row:".MyFunctionCustom::columnName($index).$row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle("A$row:".MyFunctionCustom::columnName($index).$row)->getFont()
                            ->setBold(true);    	
        $row++;
        foreach($dataAll as $data):	
            $index=1;
            $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($index++)."$row", $i);
            $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($index++)."$row", $data->agent?$data->agent->first_name:"");
            $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($index++)."$row", $cmsFormatter->formatDate($data->maintain_date));
            $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($index++)."$row", $data->customer?$data->customer->code_bussiness:"");
            $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($index++)."$row", $data->customer?$cmsFormatter->formatNameUser($data->customer):"");
            $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($index++)."$row", $data->customer?$data->customer->address:"");                
            $objPHPExcel->getActiveSheet()->setCellValueExplicit(MyFunctionCustom::columnName($index++)."$row",$data->customer?$data->customer->phone:"", PHPExcel_Cell_DataType::TYPE_STRING);
            $note = str_replace(ExportList::$replace, ExportList::$replaceNewLine, $data->note);
            $note = str_replace(ExportList::$remove, " ", $note);            
            $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($index++)."$row", $note);
            $note = str_replace(ExportList::$replace, ExportList::$replaceNewLine, $data->note_update_status);
            $note = str_replace(ExportList::$remove, " ", $note);                            
            $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($index++)."$row", $note);
            $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($index++)."$row", CmsFormatter::$STATUS_MAINTAIN[$data->status]);
            // Kết Quả Xử Lý bảo trì có cuộc gọi xấu
            $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($index++)."$row", CmsFormatter::$STATUS_MAINTAIN_BACK[$data->status_call_bad]);
            $note = str_replace(ExportList::$replace, ExportList::$replaceNewLine, $data->note_call_bad);
            $note = str_replace(ExportList::$remove, " ", $note);                            
            $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($index++)."$row", $note);
            $objPHPExcel->getActiveSheet()->getRowDimension($row)->setRowHeight(30);
            $row++;
            $i++;
        endforeach;	
        $row--;		
        $index--;
        $objPHPExcel->getActiveSheet()->getStyle("A$beginBorder:".MyFunctionCustom::columnName($index).$row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);		
        $objPHPExcel->getActiveSheet()->getStyle("A$beginBorder:".MyFunctionCustom::columnName($index).$row)
                        ->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);		
        $objPHPExcel->getActiveSheet()->getStyle("B$beginBorder:L".$row)
            ->getAlignment()->setWrapText(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(22);
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(15);
        $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(15);
        $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(30);
        $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(15);
        $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(30);
        $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(10);
        $objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(20);

        //save file
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');

        for($level=ob_get_level();$level>0;--$level)
        {
                @ob_end_clean();
        }
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Pragma: public');
        header('Content-type: '.'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="'.'Bảo Trì Gọi Xấu'.'.'.'xlsx'.'"');

        header('Cache-Control: max-age=0');				
        $objWriter->save('php://output');			
        Yii::app()->end();
        }catch (Exception $e)
        {
            MyFormat::catchAllException($e);
        }     
      }
	  
      // 10-31-2013 ANH DUNG
      public static function Export_supervision_list_maintain_sell_call_bad(){
          try{
            Yii::import('application.extensions.vendors.PHPExcel',true);
            $objPHPExcel = new PHPExcel();
            // Set properties
            $objPHPExcel->getProperties()->setCreator("NguyenDung")
                                            ->setLastModifiedBy("NguyenDung")
                                            ->setTitle('Bán Hàng Gọi Xấu')
                                            ->setSubject("Office 2007 XLSX Document")
                                            ->setDescription("List Maintain")
                                            ->setKeywords("office 2007 openxml php")
                                            ->setCategory("Gas");
            $row=1;
            $i=1;
            $dataAll = $_SESSION['data-excel']->data;
            $cmsFormatter = new CmsFormatter();	
            
            // 1.sheet 1 Đại Lý
            $objPHPExcel->setActiveSheetIndex(0);		
            $objPHPExcel->getActiveSheet()->getDefaultStyle()->getFont()->setName('Times New Roman');
            $objPHPExcel->getActiveSheet()->getDefaultStyle()->getFont()->setSize(12);            
            $objPHPExcel->getActiveSheet()->setTitle('Bán Hàng Gọi Xấu'); 
            $objPHPExcel->getActiveSheet()->setCellValue("A$row", 'Danh Sách Bán Hàng Có Cuộc Gọi Xấu');
            $objPHPExcel->getActiveSheet()->getStyle("A$row")->getFont()
                                ->setBold(true);    			
            $objPHPExcel->getActiveSheet()->mergeCells("A$row:H$row");
            $row++;
            $index=1;
            $beginBorder = $row;
            $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($index++)."$row", 'SN');
            $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($index++)."$row", 'Đại Lý');
            $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($index++)."$row", 'Ngày Bán');
            $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($index++)."$row", 'Mã Khách Hàng');
            $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($index++)."$row", 'Khách Hàng');
            $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($index++)."$row", 'Địa Chỉ');
            $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($index++)."$row", 'Điện Thoại');
            $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($index++)."$row", 'Bảo Trì');
            $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($index++)."$row", 'Trạng Thái');
            $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($index++)."$row", 'Ghi Chú Sau Cuộc Gọi');            
            $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($index++)."$row", 'Kết Quả Xử Lý');
            $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($index++)."$row", 'Ghi Chú Sau Xử Lý');
            $index--;
            
            $objPHPExcel->getActiveSheet()->getStyle("A$row:".MyFunctionCustom::columnName($index).$row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $objPHPExcel->getActiveSheet()->getStyle("A$row:".MyFunctionCustom::columnName($index).$row)->getFont()
                                ->setBold(true);    	
            $row++;
            foreach($dataAll as $data):	
                $index=1;
                $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($index++)."$row", $i);
                $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($index++)."$row", $data->agent?$data->agent->first_name:"");
                $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($index++)."$row", $cmsFormatter->formatDate($data->date_sell));
                $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($index++)."$row", $data->customer?$data->customer->code_bussiness:"");
                $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($index++)."$row", $data->customer?$cmsFormatter->formatNameUser($data->customer):"");
                $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($index++)."$row", $data->customer?$data->customer->address:"");                
                $objPHPExcel->getActiveSheet()->setCellValueExplicit(MyFunctionCustom::columnName($index++)."$row",$data->customer?$data->customer->phone:"", PHPExcel_Cell_DataType::TYPE_STRING);
                $MaintainHistory=$cmsFormatter->formatMaintainHistory($data);
                $MaintainHistory = str_replace(ExportList::$replace, ExportList::$replaceNewLine, $MaintainHistory);
                $MaintainHistory = str_replace(ExportList::$remove, " ", $MaintainHistory);                            
                $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($index++)."$row", $MaintainHistory);
                $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($index++)."$row", CmsFormatter::$STATUS_MAINTAIN[$data->status]);
                $note = str_replace(ExportList::$replace, ExportList::$replaceNewLine, $data->note_update_status);
                $note = str_replace(ExportList::$remove, " ", $note);                            
                $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($index++)."$row", $note);
                
                // Kết Quả Xử Lý bảo trì có cuộc gọi xấu
                $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($index++)."$row", CmsFormatter::$STATUS_MAINTAIN_BACK[$data->status_call_bad]);
                $note = str_replace(ExportList::$replace, ExportList::$replaceNewLine, $data->note_call_bad);
                $note = str_replace(ExportList::$remove, " ", $note);                            
                $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($index++)."$row", $note);
                $objPHPExcel->getActiveSheet()->getRowDimension($row)->setRowHeight(30);
                $row++;
                $i++;
            endforeach;	
            $row--;		
            $index--;
            $objPHPExcel->getActiveSheet()->getStyle("A$beginBorder:".MyFunctionCustom::columnName($index).$row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);		
            $objPHPExcel->getActiveSheet()->getStyle("A$beginBorder:".MyFunctionCustom::columnName($index).$row)
                            ->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);		
            $objPHPExcel->getActiveSheet()->getStyle("B$beginBorder:L".$row)
                ->getAlignment()->setWrapText(true);
            $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(22);
            $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(15);
            $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(15);
            $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(30);
            $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(25);
            $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(15);
            $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(30);
            $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(20);
            $objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(25);
            $objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(20);
            $objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(20);

            //save file
            $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');

            for($level=ob_get_level();$level>0;--$level)
            {
                    @ob_end_clean();
            }
            header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
            header('Pragma: public');
            header('Content-type: '.'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment; filename="'.'Bán Hàng Gọi Xấu'.'.'.'xlsx'.'"');

            header('Cache-Control: max-age=0');				
            $objWriter->save('php://output');			
            Yii::app()->end();
        }catch (Exception $e)
        {
            MyFormat::catchAllException($e);
        }                 
      }      
      
      // 10-31-2013 ANH DUNG
      public static function Export_supervision_list_maintain_sell_seri_diff(){
          try{
            Yii::import('application.extensions.vendors.PHPExcel',true);
            $objPHPExcel = new PHPExcel();
            // Set properties
            $objPHPExcel->getProperties()->setCreator("NguyenDung")
                                            ->setLastModifiedBy("NguyenDung")
                                            ->setTitle('Seri Không Trùng')
                                            ->setSubject("Office 2007 XLSX Document")
                                            ->setDescription("List Maintain Sell")
                                            ->setKeywords("office 2007 openxml php")
                                            ->setCategory("Gas");
            $row=1;
            $i=1;
            $dataAll = $_SESSION['data-excel']->data;
            $cmsFormatter = new CmsFormatter();	
            
            // 1.sheet 1 Đại Lý
            $objPHPExcel->setActiveSheetIndex(0);		
            $objPHPExcel->getActiveSheet()->getDefaultStyle()->getFont()->setName('Times New Roman');
            $objPHPExcel->getActiveSheet()->getDefaultStyle()->getFont()->setSize(12);            
            $objPHPExcel->getActiveSheet()->setTitle('Seri Không Trùng'); 
            $objPHPExcel->getActiveSheet()->setCellValue("A$row", 'Danh Sách Bán Hàng Có Seri Không Trùng');
            $objPHPExcel->getActiveSheet()->getStyle("A$row")->getFont()
                                ->setBold(true);    			
            $objPHPExcel->getActiveSheet()->mergeCells("A$row:H$row");
            $row++;
            $index=1;
            $beginBorder = $row;
            $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($index++)."$row", 'SN');
            $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($index++)."$row", 'Đại Lý');
            $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($index++)."$row", 'Ngày Bán');
            $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($index++)."$row", 'Mã Khách Hàng');
            $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($index++)."$row", 'Khách Hàng');
            $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($index++)."$row", 'Địa Chỉ');
            $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($index++)."$row", 'Điện Thoại');
            $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($index++)."$row", 'Bảo Trì');
            $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($index++)."$row", 'Seri Thu Về');
            $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($index++)."$row", 'Trạng Thái');
            $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($index++)."$row", 'Ghi Chú Sau Cuộc Gọi');            
            $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($index++)."$row", 'Kết Quả Xử Lý');
            $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($index++)."$row", 'Ghi Chú Sau Xử Lý');
            $index--;
            
            $objPHPExcel->getActiveSheet()->getStyle("A$row:".MyFunctionCustom::columnName($index).$row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $objPHPExcel->getActiveSheet()->getStyle("A$row:".MyFunctionCustom::columnName($index).$row)->getFont()
                                ->setBold(true);    	
            $row++;
            foreach($dataAll as $data):	
                $index=1;
                $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($index++)."$row", $i);
                $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($index++)."$row", $data->agent?$data->agent->first_name:"");
                $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($index++)."$row", $cmsFormatter->formatDate($data->date_sell));
                $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($index++)."$row", $data->customer?$data->customer->code_bussiness:"");
                $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($index++)."$row", $data->customer?$cmsFormatter->formatNameUser($data->customer):"");
                $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($index++)."$row", $data->customer?$data->customer->address:"");                
                $objPHPExcel->getActiveSheet()->setCellValueExplicit(MyFunctionCustom::columnName($index++)."$row",$data->customer?$data->customer->phone:"", PHPExcel_Cell_DataType::TYPE_STRING);
                $MaintainHistory=$cmsFormatter->formatMaintainHistory($data);
                $MaintainHistory = str_replace(ExportList::$replace, ExportList::$replaceNewLine, $MaintainHistory);
                $MaintainHistory = str_replace(ExportList::$remove, " ", $MaintainHistory);                            
                $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($index++)."$row", $MaintainHistory);
                $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($index++)."$row", $data->seri_back);                
                $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($index++)."$row", CmsFormatter::$STATUS_MAINTAIN[$data->status]);
                $note = str_replace(ExportList::$replace, ExportList::$replaceNewLine, $data->note_update_status);
                $note = str_replace(ExportList::$remove, " ", $note);                            
                $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($index++)."$row", $note);
                
                // Kết Quả Xử Lý bảo trì có cuộc gọi xấu
                $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($index++)."$row", CmsFormatter::$STATUS_MAINTAIN_BACK[$data->status_call_bad]);
                $note = str_replace(ExportList::$replace, ExportList::$replaceNewLine, $data->note_call_bad);
                $note = str_replace(ExportList::$remove, " ", $note);                            
                $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($index++)."$row", $note);
                $objPHPExcel->getActiveSheet()->getRowDimension($row)->setRowHeight(30);
                $row++;
                $i++;
            endforeach;	
            $row--;		
            $index--;
            $objPHPExcel->getActiveSheet()->getStyle("A$beginBorder:".MyFunctionCustom::columnName($index).$row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);		
            $objPHPExcel->getActiveSheet()->getStyle("A$beginBorder:".MyFunctionCustom::columnName($index).$row)
                            ->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);		
            $objPHPExcel->getActiveSheet()->getStyle("B$beginBorder:M".$row)
                ->getAlignment()->setWrapText(true);
            $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(22);
            $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(15);
            $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(15);
            $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(30);
            $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(25);
            $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(15);
            $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(30);
            $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(20);
            $objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(10);
            $objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(20);
            $objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(15);
            $objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(20);

            //save file
            $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');

            for($level=ob_get_level();$level>0;--$level)
            {
                    @ob_end_clean();
            }
            header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
            header('Pragma: public');
            header('Content-type: '.'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment; filename="'.'Seri Không Trùng'.'.'.'xlsx'.'"');

            header('Cache-Control: max-age=0');				
            $objWriter->save('php://output');			
            Yii::app()->end();                     		          
            }catch (Exception $e)
            {
                MyFormat::catchAllException($e);
            }     
      }      
      
      // 10-31-2013 ANH DUNG
      public static function Export_list_customer_maintain(){
          try{
            Yii::import('application.extensions.vendors.PHPExcel',true);
            $objPHPExcel = new PHPExcel();
            // Set properties
            $objPHPExcel->getProperties()->setCreator("NguyenDung")
                                            ->setLastModifiedBy("NguyenDung")
                                            ->setTitle('Khách Hàng Bảo Trì')
                                            ->setSubject("Office 2007 XLSX Document")
                                            ->setDescription("List Customer Maintain")
                                            ->setKeywords("office 2007 openxml php")
                                            ->setCategory("Gas");
            $row=1;
            $i=1;
            $dataAll = $_SESSION['data-excel']->data;
            $cmsFormatter = new CmsFormatter();	
            
            // 1.sheet 1 Đại Lý
            $objPHPExcel->setActiveSheetIndex(0);		
            $objPHPExcel->getActiveSheet()->getDefaultStyle()->getFont()->setName('Times New Roman');
            $objPHPExcel->getActiveSheet()->getDefaultStyle()->getFont()->setSize(12);            
            $objPHPExcel->getActiveSheet()->setTitle('Khách Hàng Bảo Trì'); 
            $objPHPExcel->getActiveSheet()->setCellValue("A$row", 'Danh Sách Khách Hàng Bảo Trì');
            $objPHPExcel->getActiveSheet()->getStyle("A$row")->getFont()
                                ->setBold(true);    			
            $objPHPExcel->getActiveSheet()->mergeCells("A$row:H$row");
            $row++;
            $index=1;
            $beginBorder = $row;
            $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($index++)."$row", 'SN');
            $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($index++)."$row", 'Mã Hệ Thống');
            $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($index++)."$row", 'Mã Khách Hàng');
            $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($index++)."$row", 'Tên Khách Hàng');
            $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($index++)."$row", 'Địa Chỉ');
            $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($index++)."$row", 'Điện Thoại');
            $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($index++)."$row", 'Trạng Thái Bảo Trì');
            $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($index++)."$row", 'Ngày Tạo');
            $index--;
            
            $objPHPExcel->getActiveSheet()->getStyle("A$row:".MyFunctionCustom::columnName($index).$row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $objPHPExcel->getActiveSheet()->getStyle("A$row:".MyFunctionCustom::columnName($index).$row)->getFont()
                                ->setBold(true);    	
            $row++;
            foreach($dataAll as $data):	
                $index=1;
                $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($index++)."$row", $i);
                $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($index++)."$row", $data->code_account);
                $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($index++)."$row", $data->code_bussiness);
                $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($index++)."$row", $data->first_name);
                $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($index++)."$row", $data->address);
                $objPHPExcel->getActiveSheet()->setCellValueExplicit(MyFunctionCustom::columnName($index++)."$row",$data->phone, PHPExcel_Cell_DataType::TYPE_STRING);
                $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($index++)."$row", CmsFormatter::$STATUS_IS_MAINTAIN[$data->is_maintain]);
                $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($index++)."$row", $cmsFormatter->formatDatetime($data->created_date));
                $row++;
                $i++;
            endforeach;	
            $row--;		
            $index--;
            $objPHPExcel->getActiveSheet()->getStyle("A$beginBorder:".MyFunctionCustom::columnName($index).$row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);		
            $objPHPExcel->getActiveSheet()->getStyle("A$beginBorder:".MyFunctionCustom::columnName($index).$row)
                            ->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);		
            $objPHPExcel->getActiveSheet()->getStyle("B$beginBorder:H".$row)
                ->getAlignment()->setWrapText(true);
            $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
            $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(15);
            $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(20);
            $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(40);
            $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(20);
            $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(20);
            $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(20);

            //save file
            $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');

            for($level=ob_get_level();$level>0;--$level)
            {
                    @ob_end_clean();
            }
            header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
            header('Pragma: public');
            header('Content-type: '.'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment; filename="'.'Khách Hàng Bảo Trì'.'.'.'xlsx'.'"');

            header('Cache-Control: max-age=0');				
            $objWriter->save('php://output');			
            Yii::app()->end();                     		          
        }catch (Exception $e)
        {
            MyFormat::catchAllException($e);
        }                 
      }
	        
      
      public static function Export_list_employees(){
          
      }
      
      
 /** @Author: ANH DUNG Apr 04, 2014 */
    public static function DetermineGasGoBack_export_excel(){
        try{
        Yii::import('application.extensions.vendors.PHPExcel',true);
        $objPHPExcel = new PHPExcel();
        // Set properties
        $objPHPExcel->getProperties()->setCreator("NguyenDung")
                                        ->setLastModifiedBy("NguyenDung")
                                        ->setTitle('Xác định bình quay về của PTTT')
                                        ->setSubject("Office 2007 XLSX Document")
                                        ->setDescription("gas go back pttt")
                                        ->setKeywords("office 2007 openxml php")
                                        ->setCategory("Gas");
        $row=1;
        $i=1;

          $TOTAL_ALL = isset($_SESSION['data-excel-gas-go-back']['TOTAL_ALL'])?$_SESSION['data-excel-gas-go-back']['TOTAL_ALL']:array();
          $TOTAL_USING_GAS_HM = isset($_SESSION['data-excel-gas-go-back']['TOTAL_USING_GAS_HM'])?$_SESSION['data-excel-gas-go-back']['TOTAL_USING_GAS_HM']:array();
          $TOTAL_QTY_BIGGER_2 = isset($_SESSION['data-excel-gas-go-back']['TOTAL_QTY_BIGGER_2'])?$_SESSION['data-excel-gas-go-back']['TOTAL_QTY_BIGGER_2']:array();
          $TOTAL_QTY_BIGGER_2_COUNT_CUSTOMER = isset($_SESSION['data-excel-gas-go-back']['TOTAL_QTY_BIGGER_2_COUNT_CUSTOMER'])?$_SESSION['data-excel-gas-go-back']['TOTAL_QTY_BIGGER_2_COUNT_CUSTOMER']:array();
          $ARR_CUSTOMER_ID = isset($_SESSION['data-excel-gas-go-back']['ARR_CUSTOMER_ID'])?$_SESSION['data-excel-gas-go-back']['ARR_CUSTOMER_ID']:array();

          $MONITOR_EMPLOYEE = $_SESSION['data-excel-gas-go-back']['MONITOR_EMPLOYEE'];
          $AGENT_MODEL = $_SESSION['data-excel-gas-go-back']['AGENT_MODEL'];
          $MODEL_CUSTOMER = $_SESSION['data-excel-gas-go-back']['MODEL_CUSTOMER'];

        $cmsFormatter = new CmsFormatter();	

        // 1.sheet 1 Đại Lý
        $objPHPExcel->setActiveSheetIndex(0);
        $objPHPExcel->getActiveSheet()->getDefaultStyle()->getFont()->setName('Times New Roman');
        $objPHPExcel->getActiveSheet()->getDefaultStyle()->getFont()->setSize(12);            
        $model = $_SESSION['data-excel-gas-go-back']['MODEL'];
        $textHead = "Xác định bình quay về của PTTT Từ Ngày $model->date_from đến ngày $model->date_to";
        $objPHPExcel->getActiveSheet()->setTitle('Bình quay về của PTTT'); 
        $objPHPExcel->getActiveSheet()->setCellValue("A$row", $textHead);
        $objPHPExcel->getActiveSheet()->getStyle("A$row")->getFont()
                            ->setBold(true);    			
        $objPHPExcel->getActiveSheet()->mergeCells("A$row:H$row");
        $row++;
        $index=1;
        $beginBorder = $row;
        $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($index++)."$row", 'NV PTTT');
        $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($index++)."$row", 'Đại Lý');
        $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($index++)."$row", 'Tổng BQV');
        $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($index++)."$row", 'Dùng Gas HM');
        $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($index++)."$row", 'Số Bình Mua >= 2');
        $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($index++)."$row", 'Số KH MUA >= 2');
        $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($index++)."$row", 'Số Còn Lại');
        $index--;

        $objPHPExcel->getActiveSheet()->getStyle("A$row:".MyFunctionCustom::columnName($index).$row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle("A$row:".MyFunctionCustom::columnName($index).$row)->getFont()
                            ->setBold(true);    
          $sum_total_all = 0;
          $sum_using_gas_hm = 0;
          $sum_qty_bigger_2 = 0;
          $sum_qty_bigger_2_count_customer = 0;
          $sum_remain = 0;          

        $row++;
          foreach($TOTAL_ALL as $maintain_employee_id=>$item_agent):
              foreach($item_agent as $agent_id=>$item_total_all):
                  $index=1;
                  $name_employer = isset($MONITOR_EMPLOYEE[$maintain_employee_id])?$MONITOR_EMPLOYEE[$maintain_employee_id]->first_name:"";
                  $name_agent = isset($AGENT_MODEL[$agent_id])?$AGENT_MODEL[$agent_id]->first_name:"";
                  $total_using_gas_hm = isset($TOTAL_USING_GAS_HM[$maintain_employee_id][$agent_id])?$TOTAL_USING_GAS_HM[$maintain_employee_id][$agent_id]:0;
                  $qty_bigger_2 = isset($TOTAL_QTY_BIGGER_2[$maintain_employee_id][$agent_id])?$TOTAL_QTY_BIGGER_2[$maintain_employee_id][$agent_id]:0;
                  $qty_bigger_2_customer = isset($TOTAL_QTY_BIGGER_2_COUNT_CUSTOMER[$maintain_employee_id][$agent_id])?$TOTAL_QTY_BIGGER_2_COUNT_CUSTOMER[$maintain_employee_id][$agent_id]:0;
                  $remain = $item_total_all-$total_using_gas_hm-$qty_bigger_2;
                  $infoC = '';
                  if(isset($ARR_CUSTOMER_ID[$maintain_employee_id][$agent_id])){
                      foreach($ARR_CUSTOMER_ID[$maintain_employee_id][$agent_id] as $customer_id){
                          $infoC .= ExportList::$replaceNewLine.$MODEL_CUSTOMER[$customer_id]->first_name." - ".$MODEL_CUSTOMER[$customer_id]->phone;
                      }
                  } 
                  $sum_total_all+=$item_total_all;
                  $sum_using_gas_hm+=$total_using_gas_hm;
                  $sum_qty_bigger_2+=$qty_bigger_2;
                  $sum_qty_bigger_2_count_customer+=$qty_bigger_2_customer;
                  $sum_remain+=$remain;

                  $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($index++)."$row", $name_employer);
                  $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($index++)."$row", $name_agent);
                  $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($index++)."$row", ($item_total_all!=0)?ActiveRecord::formatCurrency($item_total_all):"");
                  $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($index++)."$row", ($total_using_gas_hm!=0)?ActiveRecord::formatCurrency($total_using_gas_hm):"");
                  $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($index++)."$row", ($qty_bigger_2!=0)?ActiveRecord::formatCurrency($qty_bigger_2):"");
                  $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($index++)."$row", (($qty_bigger_2_customer!=0)?ActiveRecord::formatCurrency($qty_bigger_2_customer):"").$infoC);
                  $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($index++)."$row", ($remain!=0)?ActiveRecord::formatCurrency($remain):"");
                  $row++;
                  $i++;
              endforeach;
          endforeach;
          // for sum row total
          $index=1;
          $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($index++)."$row", "");
          $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($index++)."$row", "Tổng Cộng");
          $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($index++)."$row", ($sum_total_all!=0)?ActiveRecord::formatCurrency($sum_total_all):"");
          $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($index++)."$row", ($sum_using_gas_hm!=0)?ActiveRecord::formatCurrency($sum_using_gas_hm):"");
          $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($index++)."$row", ($sum_qty_bigger_2!=0)?ActiveRecord::formatCurrency($sum_qty_bigger_2):"");
          $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($index++)."$row", (($sum_qty_bigger_2_count_customer!=0)?ActiveRecord::formatCurrency($sum_qty_bigger_2_count_customer):"").$infoC);
          $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($index++)."$row", ($sum_remain!=0)?ActiveRecord::formatCurrency($sum_remain):"");
          // for sum row total  

//          $row--;		
        $index--;
        $objPHPExcel->getActiveSheet()->getStyle("A$beginBorder:".MyFunctionCustom::columnName($index).$row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);		
        $objPHPExcel->getActiveSheet()->getStyle("A$beginBorder:".MyFunctionCustom::columnName($index).$row)
                        ->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);		
        $objPHPExcel->getActiveSheet()->getStyle("B$beginBorder:".MyFunctionCustom::columnName($index).$row)
            ->getAlignment()->setWrapText(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(10);
        $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(10);
        $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(10);
        $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(30);

        //save file
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');

        for($level=ob_get_level();$level>0;--$level)
        {
                @ob_end_clean();
        }
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Pragma: public');
        header('Content-type: '.'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="'.' Xác định bình quay về của PTTT'.'.'.'xlsx'.'"');

        header('Cache-Control: max-age=0');				
        $objWriter->save('php://output');			
        Yii::app()->end();
        }catch (Exception $e)
        {
            MyFormat::catchAllException($e);
        }     
    }
    
    
    /**
     * @Author: ANH DUNG Aug 24, 2015
     * @Todo: customer bò, mối
     */
    public static function CustomerStoreCard(){
        try{
        Yii::import('application.extensions.vendors.PHPExcel',true);
        $objPHPExcel = new PHPExcel();
        // Set properties
        $objPHPExcel->getProperties()->setCreator("NguyenDung")
                                        ->setLastModifiedBy("NguyenDung")
                                        ->setTitle('DS Khách Hàng')
                                        ->setSubject("Office 2007 XLSX Document")
                                        ->setDescription("List Customer")
                                        ->setKeywords("office 2007 openxml php")
                                        ->setCategory("Gas");
        $row=1;
        $i=1;
        $dataAll = $_SESSION['data-excel']->data;
        $aAgent = Users::getSelectByRoleNotRoleAgent(ROLE_AGENT);
        $aTypePay = GasTypePay::getArrAll();

        $cmsFormatter = new CmsFormatter();

        // 1.sheet 1 Đại Lý
        $objPHPExcel->setActiveSheetIndex(0);		
        $objPHPExcel->getActiveSheet()->getDefaultStyle()->getFont()->setName('Times New Roman');
        $objPHPExcel->getActiveSheet()->getDefaultStyle()->getFont()->setSize(12);            
        $objPHPExcel->getActiveSheet()->setTitle('DS Khách Hàng'); 
        $objPHPExcel->getActiveSheet()->setCellValue("A$row", 'Danh Sách Khách Hàng ');
        $objPHPExcel->getActiveSheet()->getStyle("A$row")->getFont()
                            ->setBold(true);    			
        $objPHPExcel->getActiveSheet()->mergeCells("A$row:H$row");
        $row++;
        $index=1;
        $beginBorder = $row;
        $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($index++)."$row", 'SN');
        $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($index++)."$row", 'Đại Lý');
        $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($index++)."$row", 'Mã Khách Hàng');
        $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($index++)."$row", 'Loại');
        $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($index++)."$row", 'Tên Khách Hàng');
        $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($index++)."$row", 'Địa Chỉ');
        $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($index++)."$row", 'Điện Thoại');
        $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($index++)."$row", 'NV Sale');
        $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($index++)."$row", 'Hạn Thanh Toán');
        $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($index++)."$row", 'Trạng Thái');
        $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($index++)."$row", 'Ngày Tạo');
        $index--;

        $objPHPExcel->getActiveSheet()->getStyle("A$row:".MyFunctionCustom::columnName($index).$row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle("A$row:".MyFunctionCustom::columnName($index).$row)->getFont()
                            ->setBold(true);    	
        $row++;
        foreach($dataAll as $data):
            $index=1;
            $AgentName = isset($aAgent[$data->area_code_id]) ? $aAgent[$data->area_code_id]:'';
            $TypePay = isset($aTypePay[$data->payment_day]) ? $aTypePay[$data->payment_day]:'';
            $TypeBoMoi = $data->is_maintain?CmsFormatter::$CUSTOMER_BO_MOI[$data->is_maintain]:"";
            $data->md5pass = 'for_export';
            $Sale = $cmsFormatter->formatSaleAndLevel($data);

            $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($index++)."$row", $i);
            $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($index++)."$row", $AgentName);
            $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($index++)."$row", $data->code_bussiness);
            $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($index++)."$row", $TypeBoMoi);
            $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($index++)."$row", $data->first_name);
            $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($index++)."$row", $data->address);
            $objPHPExcel->getActiveSheet()->setCellValueExplicit(MyFunctionCustom::columnName($index++)."$row",$data->phone, PHPExcel_Cell_DataType::TYPE_STRING);
            $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($index++)."$row", $cmsFormatter->formatSaleAndLevel($data));
            $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($index++)."$row", $TypePay);
            $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($index++)."$row", $cmsFormatter->formatStatusLayHang($data));
            $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($index++)."$row", $cmsFormatter->formatDatetime($data->created_date));
            $row++;
            $i++;
        endforeach;	
        $row--;		
        $index--;
//        $objPHPExcel->getActiveSheet()->getStyle("A$beginBorder:".MyFunctionCustom::columnName($index).$row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle("A$beginBorder:A".$row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle("C$beginBorder:C".$row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle("D$beginBorder:D".$row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        
        
        $objPHPExcel->getActiveSheet()->getStyle("A$beginBorder:".MyFunctionCustom::columnName($index).$row)
                        ->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle("B$beginBorder:H".$row)
            ->getAlignment()->setWrapText(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(40);
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(18);
        $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(40);
        $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(80);
        $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(40);
        $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(15);
        $objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(20);

        //save file
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');

        for($level=ob_get_level();$level>0;--$level)
        {
                @ob_end_clean();
        }
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Pragma: public');
        header('Content-type: '.'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="'.'customer-list-'.date("Y-m-d").'.'.'xlsx'.'"');

        header('Cache-Control: max-age=0');				
        $objWriter->save('php://output');			
        Yii::app()->end();                     		          
      }catch (Exception $e)
      {
          MyFormat::catchAllException($e);
      }                 
    }
    
}
?>