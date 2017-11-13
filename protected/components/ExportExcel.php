<?php
class ExportExcel
{
     // Nguyen Dung 08-29-2013
      public static function export_agent_revenue($dataExport,$dataAgent){
      try{
                Yii::import('application.extensions.vendors.PHPExcel',true);
		$objPHPExcel = new PHPExcel();
		 // Set properties
		 $objPHPExcel->getProperties()->setCreator("NguyenDung")
                            ->setLastModifiedBy("NguyenDung")
                            ->setTitle('Report Monthly Revenue')
                            ->setSubject("Office 2007 XLSX Document")
                            ->setDescription("Report Monthly Revenue")
                            ->setKeywords("office 2007 openxml php")
                            ->setCategory("GAS");
		// step 0: Tạo ra các sheet
                $i=0;
                if(count($dataExport)>0){
                     $objPHPExcel->removeSheetByIndex(0); // may be need
                    foreach($dataExport as $year=>$aMonth){
                        $objPHPExcel->createSheet();
                        $objPHPExcel->setActiveSheetIndex($i);
                        // set default font and font-size
                        $objPHPExcel->getActiveSheet()->getDefaultStyle()->getFont()->setName('Times New Roman');
                        $objPHPExcel->getActiveSheet()->getDefaultStyle()->getFont()->setSize(12);
                        $objPHPExcel->getActiveSheet()->setTitle('NĂM '.$year);
                        $objPHPExcel->getActiveSheet()->setCellValue("A1", 'BÁO CÁO DOANH THU THEO THÁNG CỦA NĂM '.$year);
                        $objPHPExcel->getActiveSheet()->mergeCells("A1:D1");
                        
                        $objPHPExcel->getActiveSheet()->setCellValue("A3", 'Đại Lý');
                        $keyMonth=1;
                        if(count($aMonth)>0){
                            foreach ($aMonth as $month=>$aObj){
                                $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($keyMonth+1).'3', $month);
                                $keyMonth++;
                            }
                        }
                        $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($keyMonth+1).'3', 'Grand Total');
                        $objPHPExcel->getActiveSheet()
                                    ->getStyle('A3:'.MyFunctionCustom::columnName($keyMonth+1).'3')
                                    ->getFont()
                                    ->setBold(true);                        
                        $objPHPExcel->getActiveSheet()->getStyle('B3:'.MyFunctionCustom::columnName($keyMonth+1).'3')
                                    ->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);                        
                        
                        $j=0; // is index of $dataAgent
                        $index = 1;
                        $rowNum = 4;
                        $sumCol = array();                     
                        foreach($dataAgent as $kAgent=>$itemAgent){
                            $sumRow=0;
                            $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($index).($j+$rowNum), $itemAgent->first_name);
                            $keyMonth=1;
                            if(count($aMonth)>0){
                                foreach ($aMonth as $month=>$aObj){
                                    if(isset($dataExport[$year][$month][$itemAgent->id])){
                                        $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($keyMonth+1).($j+$rowNum), $dataExport[$year][$month][$itemAgent->id]);
                                        $sumRow+=$dataExport[$year][$month][$itemAgent->id];
                                        if(isset($sumCol[$month]))
                                            $sumCol[$month]+=$dataExport[$year][$month][$itemAgent->id];
                                        else 
                                            $sumCol[$month]=$dataExport[$year][$month][$itemAgent->id];
                                    }
                                    $keyMonth++;
                                }
                            }
                            $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($index+$keyMonth).($j+$rowNum), $sumRow);
							$objPHPExcel->getActiveSheet()
                                    ->getStyle(MyFunctionCustom::columnName($index+$keyMonth).($j+$rowNum))
                                    ->getFont()
                                    ->setBold(true);  
                            $j++;
                        }
                        // begin write sum col  
                        $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($index).($j+$rowNum), 'Grand Total');
                        $keyMonth=1;
                        $sumAll=0;
                        if(count($aMonth)>0){
                            foreach ($aMonth as $month=>$aObj){
                                if(isset($sumCol[$month])){
                                    $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($index+$keyMonth).($j+$rowNum), $sumCol[$month]);
                                    $sumAll+=$sumCol[$month];
                                }
                                $keyMonth++;
                            }
                        }                        
                        
                        $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($index+$keyMonth).($j+$rowNum), $sumAll);
                        
                        $objPHPExcel->getActiveSheet()
                                        ->getStyle(MyFunctionCustom::columnName($index).($j+$rowNum).':'.MyFunctionCustom::columnName($index+$keyMonth).($j+$rowNum))
                                        ->getFont()
                                        ->setBold(true);		
									
                        $objPHPExcel->getActiveSheet()
                        ->getStyle(MyFunctionCustom::columnName($index+1).($rowNum).':'.MyFunctionCustom::columnName($index+1+$keyMonth).($j+$rowNum) )->getNumberFormat()
                        ->setFormatCode('#,##0');               
                        $objPHPExcel->getActiveSheet()->getStyle(MyFunctionCustom::columnName($index).'3:'.MyFunctionCustom::columnName($index+$keyMonth).($j+$rowNum) )
                                                        ->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			
                     $i++;   
                    } // ********** end for 1 sheet for($i=0;$i<count($model->costs_month);$i++){
                }    
                
		 //save file 
		 $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
		 //$objWriter->save('MyExcel.xslx');

		 for($level=ob_get_level();$level>0;--$level)
		 {
			 @ob_end_clean();
		 }
		 header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
		 header('Pragma: public');
		 header('Content-type: '.'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		 header('Content-Disposition: attachment; filename="'.'Report Monthly Revenue-'.date('d-m-Y').'.'.'xlsx'.'"');
		 header('Cache-Control: max-age=0');				
		 $objWriter->save('php://output');			
		 Yii::app()->end();	
        }catch (Exception $e)
        {
            MyFormat::catchAllException($e);
        }                       
      }
	  
    public static function export_agent_price_root($dataExport,$dataAgent){
    try{
        Yii::import('application.extensions.vendors.PHPExcel',true);
        $objPHPExcel = new PHPExcel();
         // Set properties
         $objPHPExcel->getProperties()->setCreator("NguyenDung")
                    ->setLastModifiedBy("NguyenDung")
                    ->setTitle('Report Monthly Price Root')
                    ->setSubject("Office 2007 XLSX Document")
                    ->setDescription("Report Monthly Price Root")
                    ->setKeywords("office 2007 openxml php")
                    ->setCategory("GAS");
        // step 0: Tạo ra các sheet
        $i=0;
        if(count($dataExport)>0){
             $objPHPExcel->removeSheetByIndex(0); // may be need
            foreach($dataExport as $year=>$aMonth){
                $objPHPExcel->createSheet();
                $objPHPExcel->setActiveSheetIndex($i);
                // set default font and font-size
                $objPHPExcel->getActiveSheet()->getDefaultStyle()->getFont()->setName('Times New Roman');
                $objPHPExcel->getActiveSheet()->getDefaultStyle()->getFont()->setSize(12);
                $objPHPExcel->getActiveSheet()->setTitle('NĂM '.$year);
                $objPHPExcel->getActiveSheet()->setCellValue("A1", 'BÁO CÁO GIÁ VỐN THEO THÁNG CỦA NĂM '.$year);
                $objPHPExcel->getActiveSheet()->mergeCells("A1:D1");

                $objPHPExcel->getActiveSheet()->setCellValue("A3", 'Đại Lý');
                $keyMonth=1;
                if(count($aMonth)>0){
                    foreach ($aMonth as $month=>$aObj){
                        $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($keyMonth+1).'3', $month);
                        $keyMonth++;
                    }
                }
                $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($keyMonth+1).'3', 'Grand Total');
                $objPHPExcel->getActiveSheet()
                            ->getStyle('A3:'.MyFunctionCustom::columnName($keyMonth+1).'3')
                            ->getFont()
                            ->setBold(true);                        
                $objPHPExcel->getActiveSheet()->getStyle('B3:'.MyFunctionCustom::columnName($keyMonth+1).'3')
                            ->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);                        

                $j=0; // is index of $dataAgent
                $index = 1;
                $rowNum = 4;
                $sumCol = array();                     
                foreach($dataAgent as $kAgent=>$itemAgent){
                    $sumRow=0;
                    $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($index).($j+$rowNum), $itemAgent->first_name);
                    $keyMonth=1;
                    if(count($aMonth)>0){
                        foreach ($aMonth as $month=>$aObj){
                            if(isset($dataExport[$year][$month][$itemAgent->id])){
                                $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($keyMonth+1).($j+$rowNum), $dataExport[$year][$month][$itemAgent->id]);
                                $sumRow+=$dataExport[$year][$month][$itemAgent->id];
                                if(isset($sumCol[$month]))
                                    $sumCol[$month]+=$dataExport[$year][$month][$itemAgent->id];
                                else 
                                    $sumCol[$month]=$dataExport[$year][$month][$itemAgent->id];
                            }
                            $keyMonth++;
                        }
                    }
                    $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($index+$keyMonth).($j+$rowNum), $sumRow);
                    $j++;
                }
                // begin write sum col  
                $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($index).($j+$rowNum), 'Grand Total');
                $keyMonth=1;
                $sumAll=0;
                if(count($aMonth)>0){
                    foreach ($aMonth as $month=>$aObj){
                        if(isset($sumCol[$month])){
                            $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($index+$keyMonth).($j+$rowNum), $sumCol[$month]);
                            $sumAll+=$sumCol[$month];
                        }
                        $keyMonth++;
                    }
                }                        

                $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($index+$keyMonth).($j+$rowNum), $sumAll);

                $objPHPExcel->getActiveSheet()
                                ->getStyle(MyFunctionCustom::columnName($index).($j+$rowNum).':'.MyFunctionCustom::columnName($index+$keyMonth).($j+$rowNum))
                                ->getFont()
                                ->setBold(true);		

                $objPHPExcel->getActiveSheet()
                ->getStyle(MyFunctionCustom::columnName($index+1).($rowNum).':'.MyFunctionCustom::columnName($index+1+$keyMonth).($j+$rowNum) )->getNumberFormat()
                ->setFormatCode('#,##0');               
                $objPHPExcel->getActiveSheet()->getStyle(MyFunctionCustom::columnName($index).'3:'.MyFunctionCustom::columnName($index+$keyMonth).($j+$rowNum) )
                                                ->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

             $i++;   
            } // ********** end for 1 sheet for($i=0;$i<count($model->costs_month);$i++){
        }    

         //save file 
         $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
         //$objWriter->save('MyExcel.xslx');

         for($level=ob_get_level();$level>0;--$level)
         {
                 @ob_end_clean();
         }
         header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
         header('Pragma: public');
         header('Content-type: '.'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
         header('Content-Disposition: attachment; filename="'.'Report Monthly Price Root-'.date('d-m-Y').'.'.'xlsx'.'"');
         header('Cache-Control: max-age=0');				
         $objWriter->save('php://output');			
         Yii::app()->end();         
        }catch (Exception $e)
        {
            MyFormat::catchAllException($e);
        }               
    }
	  
    public static function export_agent_cost($dataExport,$dataAgent){
        try{
        Yii::import('application.extensions.vendors.PHPExcel',true);
        $objPHPExcel = new PHPExcel();
         // Set properties
         $objPHPExcel->getProperties()->setCreator("NguyenDung")
                    ->setLastModifiedBy("NguyenDung")
                    ->setTitle('Report Monthly Cost')
                    ->setSubject("Office 2007 XLSX Document")
                    ->setDescription("Report Monthly Cost")
                    ->setKeywords("office 2007 openxml php")
                    ->setCategory("GAS");
        // step 0: Tạo ra các sheet
        $i=0;
        if(count($dataExport)>0){
             $objPHPExcel->removeSheetByIndex(0); // may be need
            foreach($dataExport as $year=>$aMonth){
                $objPHPExcel->createSheet();
                $objPHPExcel->setActiveSheetIndex($i);
                // set default font and font-size
                $objPHPExcel->getActiveSheet()->getDefaultStyle()->getFont()->setName('Times New Roman');
                $objPHPExcel->getActiveSheet()->getDefaultStyle()->getFont()->setSize(12);
                $objPHPExcel->getActiveSheet()->setTitle('NĂM '.$year);
                $objPHPExcel->getActiveSheet()->setCellValue("A1", 'BÁO CÁO CHI PHÍ NĂM THEO ĐẠI LÝ CỦA NĂM '.$year);
                $objPHPExcel->getActiveSheet()->mergeCells("A1:D1");

                $objPHPExcel->getActiveSheet()->setCellValue("A3", 'Đại Lý');
                $keyMonth=1;
                if(count($aMonth)>0){
                    foreach ($aMonth as $month=>$aObj){
                        $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($keyMonth+1).'3', $month);
                        $keyMonth++;
                    }
                }
                $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($keyMonth+1).'3', 'Grand Total');
                $objPHPExcel->getActiveSheet()
                            ->getStyle('A3:'.MyFunctionCustom::columnName($keyMonth+1).'3')
                            ->getFont()
                            ->setBold(true);                        
                $objPHPExcel->getActiveSheet()->getStyle('B3:'.MyFunctionCustom::columnName($keyMonth+1).'3')
                            ->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);                        

                $j=0; // is index of $dataAgent
                $index = 1;
                $rowNum = 4;
                $sumCol = array();                     
                foreach($dataAgent as $kAgent=>$itemAgent){
                    $sumRow=0;
                    $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($index).($j+$rowNum), $itemAgent->first_name);
                    $keyMonth=1;
                    if(count($aMonth)>0){
                        foreach ($aMonth as $month=>$aObj){
                            if(isset($dataExport[$year][$month][$itemAgent->id])){
                                $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($keyMonth+1).($j+$rowNum), $dataExport[$year][$month][$itemAgent->id]);
                                $sumRow+=$dataExport[$year][$month][$itemAgent->id];
                                if(isset($sumCol[$month]))
                                    $sumCol[$month]+=$dataExport[$year][$month][$itemAgent->id];
                                else 
                                    $sumCol[$month]=$dataExport[$year][$month][$itemAgent->id];
                            }
                            $keyMonth++;
                        }
                    }
                    $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($index+$keyMonth).($j+$rowNum), $sumRow);
                                                $objPHPExcel->getActiveSheet()
                            ->getStyle(MyFunctionCustom::columnName($index+$keyMonth).($j+$rowNum))
                            ->getFont()
                            ->setBold(true);    
                    $j++;
                }
                // begin write sum col  
                $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($index).($j+$rowNum), 'Grand Total');
                $keyMonth=1;
                $sumAll=0;
                if(count($aMonth)>0){
                    foreach ($aMonth as $month=>$aObj){
                        if(isset($sumCol[$month])){
                            $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($index+$keyMonth).($j+$rowNum), $sumCol[$month]);
                            $sumAll+=$sumCol[$month];
                        }
                        $keyMonth++;
                    }
                }                        

                $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($index+$keyMonth).($j+$rowNum), $sumAll);

                $objPHPExcel->getActiveSheet()
                                ->getStyle(MyFunctionCustom::columnName($index).($j+$rowNum).':'.MyFunctionCustom::columnName($index+$keyMonth).($j+$rowNum))
                                ->getFont()
                                ->setBold(true);		

                $objPHPExcel->getActiveSheet()
                ->getStyle(MyFunctionCustom::columnName($index+1).($rowNum).':'.MyFunctionCustom::columnName($index+1+$keyMonth).($j+$rowNum) )->getNumberFormat()
                ->setFormatCode('#,##0');               
                $objPHPExcel->getActiveSheet()->getStyle(MyFunctionCustom::columnName($index).'3:'.MyFunctionCustom::columnName($index+$keyMonth).($j+$rowNum) )
                                                ->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

             $i++;   
            } // ********** end for 1 sheet for($i=0;$i<count($model->costs_month);$i++){
        }    

         //save file 
         $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
         //$objWriter->save('MyExcel.xslx');

         for($level=ob_get_level();$level>0;--$level)
         {
                 @ob_end_clean();
         }
         header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
         header('Pragma: public');
         header('Content-type: '.'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
         header('Content-Disposition: attachment; filename="'.'Report Monthly Cost-'.date('d-m-Y').'.'.'xlsx'.'"');
         header('Cache-Control: max-age=0');				
         $objWriter->save('php://output');			
         Yii::app()->end();		          
        }catch (Exception $e)
        {
            MyFormat::catchAllException($e);
        }               
      }
	  	  	  
    public static function export_cost_sum_total($dataExport,$aCost){
        try{
        Yii::import('application.extensions.vendors.PHPExcel',true);
        $objPHPExcel = new PHPExcel();
         // Set properties
         $objPHPExcel->getProperties()->setCreator("NguyenDung")
                    ->setLastModifiedBy("NguyenDung")
                    ->setTitle('Report Cost Sum Total')
                    ->setSubject("Office 2007 XLSX Document")
                    ->setDescription("Report Cost Sum Total")
                    ->setKeywords("office 2007 openxml php")
                    ->setCategory("GAS");
        // step 0: Tạo ra các sheet
        $i=0;
        if(count($dataExport)>0){
             $objPHPExcel->removeSheetByIndex(0); // may be need
            foreach($dataExport as $year=>$aMonth){
                $objPHPExcel->createSheet();
                $objPHPExcel->setActiveSheetIndex($i);
                // set default font and font-size
                $objPHPExcel->getActiveSheet()->getDefaultStyle()->getFont()->setName('Times New Roman');
                $objPHPExcel->getActiveSheet()->getDefaultStyle()->getFont()->setSize(12);
                $objPHPExcel->getActiveSheet()->setTitle('NĂM '.$year);
                $objPHPExcel->getActiveSheet()->setCellValue("A1", 'BÁO CÁO TỔNG CHI PHÍ CỦA NĂM '.$year);
                $objPHPExcel->getActiveSheet()->mergeCells("A1:D1");

                $objPHPExcel->getActiveSheet()->setCellValue("A3", 'Chi Phí');
                $keyMonth=1;
                                        // begin render header month
                if(count($aMonth)>0){
                    foreach ($aMonth as $month=>$aObj){
                        $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($keyMonth+1).'3', $month);
                        $keyMonth++;
                    }
                }
                                        // begin render Grand Total
                $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($keyMonth+1).'3', 'Grand Total');
                $objPHPExcel->getActiveSheet()
                            ->getStyle('A3:'.MyFunctionCustom::columnName($keyMonth+1).'3')
                            ->getFont()
                            ->setBold(true);                        
                $objPHPExcel->getActiveSheet()->getStyle('B3:'.MyFunctionCustom::columnName($keyMonth+1).'3')
                            ->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);                        

                $j=0; // is index of $aCost
                $index = 1;
                $rowNum = 4;
                $sumCol = array();
                                        // begin render body data					
                foreach($aCost as $kCostId=>$objCost){
                    $sumRow=0;
                    $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($index).($j+$rowNum), $objCost->name);
                    $keyMonth=1;
                                                $flagAddRow=false;
                    if(count($aMonth)>0){
                        foreach ($aMonth as $month=>$aObj){
                            if(isset($dataExport[$year][$month][$objCost->id])){
                                                                        $flagAddRow=true;
                                $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($keyMonth+1).($j+$rowNum), $dataExport[$year][$month][$objCost->id]);
                                $sumRow+=$dataExport[$year][$month][$objCost->id];
                                if(isset($sumCol[$month]))
                                    $sumCol[$month]+=$dataExport[$year][$month][$objCost->id];
                                else 
                                    $sumCol[$month]=$dataExport[$year][$month][$objCost->id];
                            }
                            $keyMonth++;
                        }
                    }
                                                if($flagAddRow){
                                                        $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($index+$keyMonth).($j+$rowNum), $sumRow);
                                                        $objPHPExcel->getActiveSheet()
                            ->getStyle(MyFunctionCustom::columnName($index+$keyMonth).($j+$rowNum))
                            ->getFont()
                            ->setBold(true);    
                                                        $j++;
                                                }

                }
                // begin write sum col  
                $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($index).($j+$rowNum), 'Grand Total');
                $keyMonth=1;
                $sumAll=0;
                if(count($aMonth)>0){
                    foreach ($aMonth as $month=>$aObj){
                        if(isset($sumCol[$month])){
                            $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($index+$keyMonth).($j+$rowNum), $sumCol[$month]);
                            $sumAll+=$sumCol[$month];
                        }
                        $keyMonth++;
                    }
                }                        

                $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($index+$keyMonth).($j+$rowNum), $sumAll);

                $objPHPExcel->getActiveSheet()
                                ->getStyle(MyFunctionCustom::columnName($index).($j+$rowNum).':'.MyFunctionCustom::columnName($index+$keyMonth).($j+$rowNum))
                                ->getFont()
                                ->setBold(true);		

                $objPHPExcel->getActiveSheet()
                ->getStyle(MyFunctionCustom::columnName($index+1).($rowNum).':'.MyFunctionCustom::columnName($index+1+$keyMonth).($j+$rowNum) )->getNumberFormat()
                ->setFormatCode('#,##0');               
                $objPHPExcel->getActiveSheet()->getStyle(MyFunctionCustom::columnName($index).'3:'.MyFunctionCustom::columnName($index+$keyMonth).($j+$rowNum) )
                                                ->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

             $i++;   
            } // ********** end for 1 sheet for($i=0;$i<count($model->costs_month);$i++){
        }    

         //save file 
         $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
         //$objWriter->save('MyExcel.xslx');

         for($level=ob_get_level();$level>0;--$level)
         {
                 @ob_end_clean();
         }
         header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
         header('Pragma: public');
         header('Content-type: '.'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
         header('Content-Disposition: attachment; filename="'.'Report Cost Sum Total-'.date('d-m-Y').'.'.'xlsx'.'"');
         header('Cache-Control: max-age=0');				
         $objWriter->save('php://output');			
         Yii::app()->end();	
        }catch (Exception $e)
        {
            MyFormat::catchAllException($e);
        }               
      }
	  	  
	   
    public static function export_agent_gross_profit($dataExportRevenue, $dataExportPriceRoot, $dataAgent){
        try{
        Yii::import('application.extensions.vendors.PHPExcel',true);
        $objPHPExcel = new PHPExcel();
         // Set properties
         $objPHPExcel->getProperties()->setCreator("NguyenDung")
                    ->setLastModifiedBy("NguyenDung")
                    ->setTitle('Report Monthly Gross Profit')
                    ->setSubject("Office 2007 XLSX Document")
                    ->setDescription("Report Monthly Gross Profit")
                    ->setKeywords("office 2007 openxml php")
                    ->setCategory("GAS");
        // step 0: Tạo ra các sheet
        $i=0;
        if(count($dataExportRevenue)>0){
             $objPHPExcel->removeSheetByIndex(0); // may be need
            foreach($dataExportRevenue as $year=>$aMonth){
                $objPHPExcel->createSheet();
                $objPHPExcel->setActiveSheetIndex($i);
                // set default font and font-size
                $objPHPExcel->getActiveSheet()->getDefaultStyle()->getFont()->setName('Times New Roman');
                $objPHPExcel->getActiveSheet()->getDefaultStyle()->getFont()->setSize(12);
                $objPHPExcel->getActiveSheet()->setTitle('NĂM '.$year);
                $objPHPExcel->getActiveSheet()->setCellValue("A1", 'BÁO CÁO LÃI GỘP THEO THÁNG CỦA NĂM '.$year);
                $objPHPExcel->getActiveSheet()->mergeCells("A1:D1");

                $objPHPExcel->getActiveSheet()->setCellValue("A3", 'Đại Lý');
                $keyMonth=1;
                if(count($aMonth)>0){
                    foreach ($aMonth as $month=>$aObj){
                        $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($keyMonth+1).'3', $month);
                        $keyMonth++;
                    }
                }
                $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($keyMonth+1).'3', 'Grand Total');
                $objPHPExcel->getActiveSheet()
                            ->getStyle('A3:'.MyFunctionCustom::columnName($keyMonth+1).'3')
                            ->getFont()
                            ->setBold(true);                        
                $objPHPExcel->getActiveSheet()->getStyle('B3:'.MyFunctionCustom::columnName($keyMonth+1).'3')
                            ->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);                        

                $j=0; // is index of $dataAgent
                $index = 1;
                $rowNum = 4;
                $sumCol = array();                     
                foreach($dataAgent as $kAgent=>$itemAgent){
                    $sumRow=0;
                    $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($index).($j+$rowNum), $itemAgent->first_name);
                    $keyMonth=1;
                    if(count($aMonth)>0){
                        foreach ($aMonth as $month=>$aObj){
                                                                $Revenue = isset($dataExportRevenue[$year][$month][$itemAgent->id])?$dataExportRevenue[$year][$month][$itemAgent->id]:0;
                                                                $PriceRoot = isset($dataExportPriceRoot[$year][$month][$itemAgent->id])?$dataExportPriceRoot[$year][$month][$itemAgent->id]:0;
                            $cellValue = $Revenue-$PriceRoot;
                                                                $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($keyMonth+1).($j+$rowNum), $cellValue);
                                                                $sumRow+=$cellValue;
                                                                if(isset($sumCol[$month]))
                                                                        $sumCol[$month]+=$cellValue;
                                                                else 
                                                                        $sumCol[$month]=$cellValue;

                            $keyMonth++;
                        }
                    }
                    $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($index+$keyMonth).($j+$rowNum), $sumRow);
                    $j++;
                }
                // begin write sum col  
                $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($index).($j+$rowNum), 'Grand Total');
                $keyMonth=1;
                $sumAll=0;
                if(count($aMonth)>0){
                    foreach ($aMonth as $month=>$aObj){
                        if(isset($sumCol[$month])){
                            $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($index+$keyMonth).($j+$rowNum), $sumCol[$month]);
                            $sumAll+=$sumCol[$month];
                        }
                        $keyMonth++;
                    }
                }                        

                $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($index+$keyMonth).($j+$rowNum), $sumAll);

                $objPHPExcel->getActiveSheet()
                                ->getStyle(MyFunctionCustom::columnName($index).($j+$rowNum).':'.MyFunctionCustom::columnName($index+$keyMonth).($j+$rowNum))
                                ->getFont()
                                ->setBold(true);		

                $objPHPExcel->getActiveSheet()
                ->getStyle(MyFunctionCustom::columnName($index+1).($rowNum).':'.MyFunctionCustom::columnName($index+1+$keyMonth).($j+$rowNum) )->getNumberFormat()
                ->setFormatCode('#,##0');               
                $objPHPExcel->getActiveSheet()->getStyle(MyFunctionCustom::columnName($index).'3:'.MyFunctionCustom::columnName($index+$keyMonth).($j+$rowNum) )
                                                ->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

             $i++;   
            } // ********** end for 1 sheet for($i=0;$i<count($model->costs_month);$i++){
        }    

         //save file 
         $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
         //$objWriter->save('MyExcel.xslx');

         for($level=ob_get_level();$level>0;--$level)
         {
                 @ob_end_clean();
         }
         header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
         header('Pragma: public');
         header('Content-type: '.'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
         header('Content-Disposition: attachment; filename="'.'Report Monthly Gross Profit-'.date('d-m-Y').'.'.'xlsx'.'"');
         header('Cache-Control: max-age=0');				
         $objWriter->save('php://output');			
         Yii::app()->end();	
        }catch (Exception $e)
        {
            MyFormat::catchAllException($e);
        }              
      }
	  	  
	  
    public static function export_agent_net_profit($dataExportRevenue, $dataExportPriceRoot, $dataExportCost, $dataAgent){
        try{
        Yii::import('application.extensions.vendors.PHPExcel',true);
        $objPHPExcel = new PHPExcel();
         // Set properties
         $objPHPExcel->getProperties()->setCreator("NguyenDung")
                    ->setLastModifiedBy("NguyenDung")
                    ->setTitle('Report Monthly Net Profit')
                    ->setSubject("Office 2007 XLSX Document")
                    ->setDescription("Report Monthly Net Profit")
                    ->setKeywords("office 2007 openxml php")
                    ->setCategory("GAS");
        // step 0: Tạo ra các sheet
        $i=0;
        if(count($dataExportRevenue)>0){
             $objPHPExcel->removeSheetByIndex(0); // may be need
            foreach($dataExportRevenue as $year=>$aMonth){
                $objPHPExcel->createSheet();
                $objPHPExcel->setActiveSheetIndex($i);
                //  
                $objPHPExcel->getActiveSheet()->getDefaultStyle()->getFont()->setName('Times New Roman');
                $objPHPExcel->getActiveSheet()->getDefaultStyle()->getFont()->setSize(12);
                $objPHPExcel->getActiveSheet()->setTitle('NĂM '.$year);
                $objPHPExcel->getActiveSheet()->setCellValue("A1", 'BÁO CÁO LỢI NHUẬN THUẦN THEO THÁNG CỦA NĂM '.$year);
                $objPHPExcel->getActiveSheet()->mergeCells("A1:D1");

                $objPHPExcel->getActiveSheet()->setCellValue("A3", 'Đại Lý');
                $keyMonth=1;
                if(count($aMonth)>0){
                    foreach ($aMonth as $month=>$aObj){
                        $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($keyMonth+1).'3', $month);
                        $keyMonth++;
                    }
                }
                $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($keyMonth+1).'3', 'Grand Total');
                $objPHPExcel->getActiveSheet()
                            ->getStyle('A3:'.MyFunctionCustom::columnName($keyMonth+1).'3')
                            ->getFont()
                            ->setBold(true);                        
                $objPHPExcel->getActiveSheet()->getStyle('B3:'.MyFunctionCustom::columnName($keyMonth+1).'3')
                            ->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);                        

                $j=0; // is index of $dataAgent
                $index = 1;
                $rowNum = 4;
                $sumCol = array();      

                foreach($dataAgent as $kAgent=>$itemAgent){
                    $sumRow=0;
                    $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($index).($j+$rowNum), $itemAgent->first_name);
                    $keyMonth=1;
                    if(count($aMonth)>0){
                        foreach ($aMonth as $month=>$aObj){
                                                                $Revenue = isset($dataExportRevenue[$year][$month][$itemAgent->id])?$dataExportRevenue[$year][$month][$itemAgent->id]:0;
                                                                $PriceRoot = isset($dataExportPriceRoot[$year][$month][$itemAgent->id])?$dataExportPriceRoot[$year][$month][$itemAgent->id]:0;
                                                                $Cost = isset($dataExportCost[$year][$month][$itemAgent->id])?$dataExportCost[$year][$month][$itemAgent->id]:0;                                    
                            $cellValue = $Revenue-$PriceRoot-$Cost;									
                                                                $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($keyMonth+1).($j+$rowNum), $cellValue);
                                                                $sumRow+=$cellValue;
                                                                if(isset($sumCol[$month]))
                                                                        $sumCol[$month]+=$cellValue;
                                                                else 
                                                                        $sumCol[$month]=$cellValue;

                            $keyMonth++;
                        }
                    }
                    $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($index+$keyMonth).($j+$rowNum), $sumRow);
                    $j++;
                }

                // begin write sum col  
                $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($index).($j+$rowNum), 'Grand Total');
                $keyMonth=1;
                $sumAll=0;
                if(count($aMonth)>0){
                    foreach ($aMonth as $month=>$aObj){
                        if(isset($sumCol[$month])){
                            $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($index+$keyMonth).($j+$rowNum), $sumCol[$month]);
                            $sumAll+=$sumCol[$month];
                        }
                        $keyMonth++;
                    }
                }                        

                $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($index+$keyMonth).($j+$rowNum), $sumAll);

                $objPHPExcel->getActiveSheet()
                                ->getStyle(MyFunctionCustom::columnName($index).($j+$rowNum).':'.MyFunctionCustom::columnName($index+$keyMonth).($j+$rowNum))
                                ->getFont()
                                ->setBold(true);		

                $objPHPExcel->getActiveSheet()
                ->getStyle(MyFunctionCustom::columnName($index+1).($rowNum).':'.MyFunctionCustom::columnName($index+1+$keyMonth).($j+$rowNum) )->getNumberFormat()
                ->setFormatCode('#,##0');               
                $objPHPExcel->getActiveSheet()->getStyle(MyFunctionCustom::columnName($index).'3:'.MyFunctionCustom::columnName($index+$keyMonth).($j+$rowNum) )
                                                ->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

             $i++;   
            } // ********** end for 1 sheet for($i=0;$i<count($model->costs_month);$i++){
        }    

         //save file 
         $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
         //$objWriter->save('MyExcel.xslx');

         for($level=ob_get_level();$level>0;--$level)
         {
                 @ob_end_clean();
         }
         header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
         header('Pragma: public');
         header('Content-type: '.'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
         header('Content-Disposition: attachment; filename="'.'Report Monthly Net Profit-'.date('d-m-Y').'.'.'xlsx'.'"');
         header('Cache-Control: max-age=0');				
         $objWriter->save('php://output');			
         Yii::app()->end();		          
        }catch (Exception $e)
        {
            MyFormat::catchAllException($e);
        }          
      }
	  	  	  	  
    public static function export_agent_revenue_by_material($dataExport,$dataAgent, $dataAllMaterial){
        try{
        Yii::import('application.extensions.vendors.PHPExcel',true);
        $objPHPExcel = new PHPExcel();
         // Set properties
         $objPHPExcel->getProperties()->setCreator("NguyenDung")
                    ->setLastModifiedBy("NguyenDung")
                    ->setTitle('Report Monthly Revenue')
                    ->setSubject("Office 2007 XLSX Document")
                    ->setDescription("Report Monthly Revenue")
                    ->setKeywords("office 2007 openxml php")
                    ->setCategory("GAS");
        // step 0: Tạo ra các sheet
        $i=0;
        if(count($dataExport)>0){
             $objPHPExcel->removeSheetByIndex(0); // may be need
//                    for($i;$i<count($dataExport);$i++){
            foreach($dataExport as $year=>$aAgentId){
                $objPHPExcel->createSheet();
                $objPHPExcel->setActiveSheetIndex($i);
                // set default font and font-size
                $objPHPExcel->getActiveSheet()->getDefaultStyle()->getFont()->setName('Times New Roman');
                $objPHPExcel->getActiveSheet()->getDefaultStyle()->getFont()->setSize(12);
                $objPHPExcel->getActiveSheet()->setTitle('NĂM '.$year);
                $objPHPExcel->getActiveSheet()->setCellValue("A1", 'BÁO CÁO DOANH THU ĐẠI LÝ THEO SẢN PHẨM NĂM '.$year);
                $objPHPExcel->getActiveSheet()->mergeCells("A1:D1");

                $objPHPExcel->getActiveSheet()->setCellValue("A3", 'Đại Lý');
                $objPHPExcel->getActiveSheet()->setCellValue("B3", 'Sản Phẩm');
                $key_agent_id=0;
                $rowNum = 3;
                $index = 1;

                foreach($aAgentId as $agent_id=>$month_obj){		
                    if(isset($dataExport[$year][$agent_id]['arrMaterialId'])){
                            // render heaer of one agent
                            $keyMonth=1;
                            $sumCol = array();
                            foreach($dataExport[$year][$agent_id]['month'] as $month){
                                    $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($keyMonth+2).$rowNum, 'T'.$month);											
                                    $objPHPExcel->getActiveSheet()->getStyle(MyFunctionCustom::columnName($keyMonth+2).$rowNum)
                                    ->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                                    $objPHPExcel->getActiveSheet()
                                                    ->getStyle(MyFunctionCustom::columnName($index).($rowNum).':'.MyFunctionCustom::columnName($index+$keyMonth+2).($rowNum))
                                                    ->getFont()
                                                    ->setBold(true);								
                                    $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($keyMonth+3).$rowNum, 'Grand Total');
                                    $keyMonth++;
                            }
                            $rowNum++;
                            // end render heaer of one agent
                            $cellBeginAgent=MyFunctionCustom::columnName($index+2).$rowNum;
                            $cellBeginMergeAgent=MyFunctionCustom::columnName($index).$rowNum;
                            $cellBeginBorderAgent=MyFunctionCustom::columnName($index).($rowNum-1);

                                foreach($dataExport[$year][$agent_id]['arrMaterialId'] as $keyMaterial=>$material_id){
                                        $keyMonth=1;
                                        $sumRow = 0;
                                                $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($index+1).$rowNum, $dataAllMaterial[$material_id]->name);


                                                foreach($dataExport[$year][$agent_id]['month'] as $month){									
                                                        if($keyMaterial==0){
                                                                $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($index).$rowNum, $dataAgent[$agent_id]->first_name);
                                                        }

                                                        if(isset($dataExport[$year][$agent_id]['month_obj'][$month][$material_id])){
                                                                $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($keyMonth+2).$rowNum, 
                                                                        $dataExport[$year][$agent_id]['month_obj'][$month][$material_id]['parent_total']); 
                                                                $sumRow+=	$dataExport[$year][$agent_id]['month_obj'][$month][$material_id]['parent_total'];												
                                                                if(isset($sumCol[$month]))
                                                                        $sumCol[$month]+=$dataExport[$year][$agent_id]['month_obj'][$month][$material_id]['parent_total'];			
                                                                else
                                                                        $sumCol[$month]=$dataExport[$year][$agent_id]['month_obj'][$month][$material_id]['parent_total'];


                                                        }
                                                        $objPHPExcel->getActiveSheet()
                                                                ->getStyle(MyFunctionCustom::columnName($index).($rowNum).':'.MyFunctionCustom::columnName($index+$keyMonth+2).($rowNum))
                                                                ->getFont()
                                                                ->setBold(true);										
                                                        $keyMonth++;
                                                } // end  foreach($dataExport[$year][$itemAgent->id] as $aMonth){
                                                $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($keyMonth+2).$rowNum, $sumRow);
                                                $rowNum++;
                                                // for detail of one parent id
                                                $key_of_month_out=0;
                                                        foreach($dataExport[$year][$agent_id]['month'] as $month){
                                                                if(isset($dataExport[$year][$agent_id]['month_obj'][$month][$material_id])){
                                                                        if($key_of_month_out!=0)
                                                                            $rowNum-=(count($dataExport[$year][$agent_id]['month_obj'][$month][$material_id]['sub_obj']));                                                                            
                                                                        foreach($dataExport[$year][$agent_id]['month_obj'][$month][$material_id]['sub_obj'] as $keySub=>$subObj){
                                                                                $keyMonth2=1;
                                                                                foreach($dataExport[$year][$agent_id]['month'] as $month2){	
                                                                                        if($subObj->sell_month==$month2){
                                                                                                $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($index+1).$rowNum, $dataAllMaterial[$subObj->materials_id]->name);
                                                                                                $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($keyMonth2+2).$rowNum, $subObj->total_sell);																							
                                                                                        }
                                                                                        $keyMonth2++;
                                                                                }
                                                                                $rowNum++;	
                                                                        }
                                                                }
                                                                $key_of_month_out++;
                                                        }
                                                // end for detail of one parent id

                                } // end foreach($dataExport[$year][$agent_id]['arrMaterialId'] as $keyMaterial=>$material_id){	

                                $objPHPExcel->getActiveSheet()
                                    ->mergeCells($cellBeginMergeAgent.':'.MyFunctionCustom::columnName($index).($rowNum-1));
                                $objPHPExcel->getActiveSheet()->getStyle($cellBeginMergeAgent.':'.MyFunctionCustom::columnName($index).($rowNum))
                                    ->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);


                            // total col
                            $keyMonth=1;
                            $sumOneAgent=0;
                            $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($keyMonth).$rowNum,  'Grand Total');
                            foreach($dataExport[$year][$agent_id]['month'] as $month){
                                    if(isset($sumCol[$month])){
                                            $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($keyMonth+2).$rowNum, $sumCol[$month]);
                                            $sumOneAgent+=$sumCol[$month];	
                                    }
                                    $objPHPExcel->getActiveSheet()
                                                    ->getStyle(MyFunctionCustom::columnName($index).($rowNum).':'.MyFunctionCustom::columnName($index+$keyMonth+2).($rowNum))
                                                    ->getFont()
                                                    ->setBold(true);											
                                    $keyMonth++;
                            }
                            $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($keyMonth+2).$rowNum, $sumOneAgent);

                            // end total col
                             $objPHPExcel->getActiveSheet()
                                    ->getStyle($cellBeginAgent.':'.MyFunctionCustom::columnName($keyMonth+2).$rowNum)->getNumberFormat()
                                    ->setFormatCode('#,##0'); 


                            $objPHPExcel->getActiveSheet()->getStyle($cellBeginBorderAgent.':'.MyFunctionCustom::columnName($keyMonth+2).$rowNum )
                                    ->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);								

                            $rowNum++;	
                        }
                    $key_agent_id++;

                } // end foreach($dataAgent as $kAgent=>$itemAgent){



             $i++;   // for createSheet(
            } // ********** end for 1 sheet for($i=0;$i<count($model->costs_month);$i++){
        }    

         //save file 
         $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
         //$objWriter->save('MyExcel.xslx');

         for($level=ob_get_level();$level>0;--$level)
         {
                 @ob_end_clean();
         }
         header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
         header('Pragma: public');
         header('Content-type: '.'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
         header('Content-Disposition: attachment; filename="'.'Report Monthly Revenue-'.date('d-m-Y').'.'.'xlsx'.'"');
         header('Cache-Control: max-age=0');				
         $objWriter->save('php://output');			
         Yii::app()->end();		          
        }catch (Exception $e)
        {
            MyFormat::catchAllException($e);
        }              
      }
    
	  
    public static function export_agent_price_root_by_material($dataExport,$dataAgent, $dataAllMaterial){
        try{
        Yii::import('application.extensions.vendors.PHPExcel',true);
        $objPHPExcel = new PHPExcel();
         // Set properties
         $objPHPExcel->getProperties()->setCreator("NguyenDung")
                    ->setLastModifiedBy("NguyenDung")
                    ->setTitle('Report Monthly Price Root')
                    ->setSubject("Office 2007 XLSX Document")
                    ->setDescription("Report Monthly Price Root")
                    ->setKeywords("office 2007 openxml php")
                    ->setCategory("GAS");
        // step 0: Tạo ra các sheet
        $i=0;
        if(count($dataExport)>0){
             $objPHPExcel->removeSheetByIndex(0); // may be need
//                    for($i;$i<count($dataExport);$i++){
            foreach($dataExport as $year=>$aAgentId){
                $objPHPExcel->createSheet();
                $objPHPExcel->setActiveSheetIndex($i);
                // set default font and font-size
                $objPHPExcel->getActiveSheet()->getDefaultStyle()->getFont()->setName('Times New Roman');
                $objPHPExcel->getActiveSheet()->getDefaultStyle()->getFont()->setSize(12);
                $objPHPExcel->getActiveSheet()->setTitle('NĂM '.$year);
                $objPHPExcel->getActiveSheet()->setCellValue("A1", 'BÁO CÁO GIÁ VỐN ĐẠI LÝ THEO SẢN PHẨM NĂM '.$year);
                $objPHPExcel->getActiveSheet()->mergeCells("A1:D1");

                $objPHPExcel->getActiveSheet()->setCellValue("A3", 'Đại Lý');
                $objPHPExcel->getActiveSheet()->setCellValue("B3", 'Sản Phẩm');
                $key_agent_id=0;
                $rowNum = 3;
                $index = 1;

                foreach($aAgentId as $agent_id=>$month_obj){		
                    if(isset($dataExport[$year][$agent_id]['arrMaterialId'])){
                            // render heaer of one agent
                            $keyMonth=1;
                            $sumCol = array();
                            foreach($dataExport[$year][$agent_id]['month'] as $month){
                                    $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($keyMonth+2).$rowNum, 'T'.$month);											
                                    $objPHPExcel->getActiveSheet()->getStyle(MyFunctionCustom::columnName($keyMonth+2).$rowNum)
                                    ->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                                    $objPHPExcel->getActiveSheet()
                                                    ->getStyle(MyFunctionCustom::columnName($index).($rowNum).':'.MyFunctionCustom::columnName($index+$keyMonth+2).($rowNum))
                                                    ->getFont()
                                                    ->setBold(true);								
                                    $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($keyMonth+3).$rowNum, 'Grand Total');
                                    $keyMonth++;
                            }
                            $rowNum++;
                            // end render heaer of one agent
                            $cellBeginAgent=MyFunctionCustom::columnName($index+2).$rowNum;
                            $cellBeginMergeAgent=MyFunctionCustom::columnName($index).$rowNum;
                            $cellBeginBorderAgent=MyFunctionCustom::columnName($index).($rowNum-1);

                                foreach($dataExport[$year][$agent_id]['arrMaterialId'] as $keyMaterial=>$material_id){
                                        $keyMonth=1;
                                        $sumRow = 0;
                                                $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($index+1).$rowNum, $dataAllMaterial[$material_id]->name);


                                                foreach($dataExport[$year][$agent_id]['month'] as $month){									
                                                        if($keyMaterial==0){
                                                                $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($index).$rowNum, $dataAgent[$agent_id]->first_name);
                                                        }

                                                        if(isset($dataExport[$year][$agent_id]['month_obj'][$month][$material_id])){
                                                                $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($keyMonth+2).$rowNum, 
                                                                        $dataExport[$year][$agent_id]['month_obj'][$month][$material_id]['parent_total']); 
                                                                $sumRow+=	$dataExport[$year][$agent_id]['month_obj'][$month][$material_id]['parent_total'];												
                                                                if(isset($sumCol[$month]))
                                                                        $sumCol[$month]+=$dataExport[$year][$agent_id]['month_obj'][$month][$material_id]['parent_total'];			
                                                                else
                                                                        $sumCol[$month]=$dataExport[$year][$agent_id]['month_obj'][$month][$material_id]['parent_total'];


                                                        }
                                                        $objPHPExcel->getActiveSheet()
                                                                ->getStyle(MyFunctionCustom::columnName($index).($rowNum).':'.MyFunctionCustom::columnName($index+$keyMonth+2).($rowNum))
                                                                ->getFont()
                                                                ->setBold(true);										
                                                        $keyMonth++;
                                                } // end  foreach($dataExport[$year][$itemAgent->id] as $aMonth){
                                                $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($keyMonth+2).$rowNum, $sumRow);
                                                $rowNum++;
                                                // for detail of one parent id
                                                        $key_of_month_out=0;
                                                        foreach($dataExport[$year][$agent_id]['month'] as $month){	
                                                                if(isset($dataExport[$year][$agent_id]['month_obj'][$month][$material_id])){
                                                                        if($key_of_month_out!=0)
                                                                            $rowNum-=(count($dataExport[$year][$agent_id]['month_obj'][$month][$material_id]['sub_obj']));
                                                                        foreach($dataExport[$year][$agent_id]['month_obj'][$month][$material_id]['sub_obj'] as $keySub=>$subObj){
                                                                                $keyMonth2=1;
                                                                                foreach($dataExport[$year][$agent_id]['month'] as $month2){	
                                                                                        if($subObj->sell_month==$month2){
                                                                                                $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($index+1).$rowNum, $dataAllMaterial[$subObj->materials_id]->name);
                                                                                                $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($keyMonth2+2).$rowNum, $subObj->total_root);																							
                                                                                        }
                                                                                        $keyMonth2++;
                                                                                }
                                                                                $rowNum++;	
                                                                        }
                                                                }
                                                        $key_of_month_out++;
                                                        }
                                                // end for detail of one parent id

                                } // end foreach($dataExport[$year][$agent_id]['arrMaterialId'] as $keyMaterial=>$material_id){	

                                $objPHPExcel->getActiveSheet()
                                    ->mergeCells($cellBeginMergeAgent.':'.MyFunctionCustom::columnName($index).($rowNum-1));
                                $objPHPExcel->getActiveSheet()->getStyle($cellBeginMergeAgent.':'.MyFunctionCustom::columnName($index).($rowNum))
                                    ->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);


                            // total col
                            $keyMonth=1;
                            $sumOneAgent=0;
                            $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($keyMonth).$rowNum,  'Grand Total');
                            foreach($dataExport[$year][$agent_id]['month'] as $month){
                                    if(isset($sumCol[$month])){
                                            $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($keyMonth+2).$rowNum, $sumCol[$month]);
                                            $sumOneAgent+=$sumCol[$month];	
                                    }
                                    $objPHPExcel->getActiveSheet()
                                                    ->getStyle(MyFunctionCustom::columnName($index).($rowNum).':'.MyFunctionCustom::columnName($index+$keyMonth+2).($rowNum))
                                                    ->getFont()
                                                    ->setBold(true);											
                                    $keyMonth++;
                            }
                            $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($keyMonth+2).$rowNum, $sumOneAgent);

                            // end total col
                             $objPHPExcel->getActiveSheet()
                                    ->getStyle($cellBeginAgent.':'.MyFunctionCustom::columnName($keyMonth+2).$rowNum)->getNumberFormat()
                                    ->setFormatCode('#,##0'); 


                            $objPHPExcel->getActiveSheet()->getStyle($cellBeginBorderAgent.':'.MyFunctionCustom::columnName($keyMonth+2).$rowNum )
                                    ->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);								

                            $rowNum++;	
                        }
                    $key_agent_id++;

                } // end foreach($dataAgent as $kAgent=>$itemAgent){



             $i++;   // for createSheet(
            } // ********** end for 1 sheet for($i=0;$i<count($model->costs_month);$i++){
        }    

         //save file 
         $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
         //$objWriter->save('MyExcel.xslx');

         for($level=ob_get_level();$level>0;--$level)
         {
                 @ob_end_clean();
         }
         header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
         header('Pragma: public');
         header('Content-type: '.'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
         header('Content-Disposition: attachment; filename="'.'Report Monthly Price Root-'.date('d-m-Y').'.'.'xlsx'.'"');
         header('Cache-Control: max-age=0');				
         $objWriter->save('php://output');			
         Yii::app()->end();
        }catch (Exception $e)
        {
            MyFormat::catchAllException($e);
        }              
      }
	  
	  
    public static function export_agent_by_costs_2($dataExport,$dataAgent, $aCost){
        try{
        Yii::import('application.extensions.vendors.PHPExcel',true);
        $objPHPExcel = new PHPExcel();
         // Set properties
         $objPHPExcel->getProperties()->setCreator("NguyenDung")
                    ->setLastModifiedBy("NguyenDung")
                    ->setTitle('Report Monthly Agent Cost 2')
                    ->setSubject("Office 2007 XLSX Document")
                    ->setDescription("Report Monthly Agent Cost 2")
                    ->setKeywords("office 2007 openxml php")
                    ->setCategory("GAS");
        // step 0: Tạo ra các sheet
        $i=0;
        if(count($dataExport)>0){
             $objPHPExcel->removeSheetByIndex(0); // may be need
//                    for($i;$i<count($dataExport);$i++){
            foreach($dataExport as $year=>$aAgentId){
                $objPHPExcel->createSheet();
                $objPHPExcel->setActiveSheetIndex($i);
                // set default font and font-size
                $objPHPExcel->getActiveSheet()->getDefaultStyle()->getFont()->setName('Times New Roman');
                $objPHPExcel->getActiveSheet()->getDefaultStyle()->getFont()->setSize(12);
                $objPHPExcel->getActiveSheet()->setTitle('NĂM '.$year);
                $objPHPExcel->getActiveSheet()->setCellValue("A1", 'BÁO CÁO CHI PHÍ ĐẠI LÝ NĂM '.$year);
                $objPHPExcel->getActiveSheet()->mergeCells("A1:D1");

                $objPHPExcel->getActiveSheet()->setCellValue("A3", 'Đại Lý');
                $objPHPExcel->getActiveSheet()->setCellValue("B3", 'Chi Phí');
                $key_agent_id=0;
                $rowNum = 3;
                $index = 1;

                foreach($aAgentId as $agent_id=>$month_){		

                            // render heaer of one agent
                            $keyMonth=1;
                            $sumCol = array();
                            foreach($dataExport[$year][$agent_id]['month'] as $month){
                                    $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($keyMonth+2).$rowNum, 'T'.$month);											
                                    $objPHPExcel->getActiveSheet()->getStyle(MyFunctionCustom::columnName($keyMonth+2).$rowNum)
                                    ->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                                    $objPHPExcel->getActiveSheet()
                                                    ->getStyle(MyFunctionCustom::columnName($index).($rowNum).':'.MyFunctionCustom::columnName($index+$keyMonth+2).($rowNum))
                                                    ->getFont()
                                                    ->setBold(true);								
                                    $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($keyMonth+3).$rowNum, 'Grand Total');
                                    $keyMonth++;
                            }
                            $rowNum++;
                            // end render heaer of one agent
                                                                // write name of agent
                                                                $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($index).$rowNum, $dataAgent[$agent_id]->first_name);

                            $cellBeginAgent=MyFunctionCustom::columnName($index+2).$rowNum;
                            $cellBeginMergeAgent=MyFunctionCustom::columnName($index).$rowNum;
                            $cellBeginBorderAgent=MyFunctionCustom::columnName($index).($rowNum-1);
                                                                        // begin render detail costs one agent
                                foreach($aCost as $cost_id=>$cost_obj){
                                                                                $keyMonth=1;
                                                                                $sumRow = 0;
                                                                                $flagAddRow=false;

                                                                                foreach($dataExport[$year][$agent_id]['month'] as $month){									
                                                                                                if(isset($dataExport[$year][$agent_id][$month][$cost_id])){
                                                                                                        $flagAddRow=true;
                                                                                                                $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($keyMonth+2).$rowNum, 
                                                                                                                                $dataExport[$year][$agent_id][$month][$cost_id]); 
                                                                                                                $sumRow+=	$dataExport[$year][$agent_id][$month][$cost_id];												
                                                                                                                if(isset($sumCol[$month]))
                                                                                                                                $sumCol[$month]+=$dataExport[$year][$agent_id][$month][$cost_id];			
                                                                                                                else
                                                                                                                                $sumCol[$month]=$dataExport[$year][$agent_id][$month][$cost_id];
                                                                                                }

                                                                                                $keyMonth++;
                                                                                } // end  foreach($dataExport[$year][$itemAgent->id] as $aMonth){
                                                                                if($flagAddRow){
                                                                                        $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($index+1).($rowNum), $cost_obj->name);
                                                                                        $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($keyMonth+2).$rowNum, $sumRow);
                                                                                        // bold for sum row
                                                                                        $objPHPExcel->getActiveSheet()															
                                                                                                                ->getStyle(MyFunctionCustom::columnName($keyMonth+2).$rowNum)
                                                                                                                ->getFont()
                                                                                                                ->setBold(true);		 												
                                                                                        $rowNum++;

                                                                                }

                                } // end foreach($aCost as $cost_id=>$cost_obj){
                                                                        // begin render detail costs one agent

                                $objPHPExcel->getActiveSheet()
                                    ->mergeCells($cellBeginMergeAgent.':'.MyFunctionCustom::columnName($index).($rowNum-1));
                                $objPHPExcel->getActiveSheet()->getStyle($cellBeginMergeAgent.':'.MyFunctionCustom::columnName($index).($rowNum))
                                    ->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);


                            // total col
                            $keyMonth=1;
                            $sumOneAgent=0;
                            $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($keyMonth).$rowNum,  'Grand Total');
                            foreach($dataExport[$year][$agent_id]['month'] as $month){
                                    if(isset($sumCol[$month])){
                                            $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($keyMonth+2).$rowNum, $sumCol[$month]);
                                            $sumOneAgent+=$sumCol[$month];	
                                    }
                                    $objPHPExcel->getActiveSheet()
                                                    ->getStyle(MyFunctionCustom::columnName($index).($rowNum).':'.MyFunctionCustom::columnName($index+$keyMonth+2).($rowNum))
                                                    ->getFont()
                                                    ->setBold(true);											
                                    $keyMonth++;
                            }
                            $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($keyMonth+2).$rowNum, $sumOneAgent);

                            // end total col
                             $objPHPExcel->getActiveSheet()
                                    ->getStyle($cellBeginAgent.':'.MyFunctionCustom::columnName($keyMonth+2).$rowNum)->getNumberFormat()
                                    ->setFormatCode('#,##0'); 


                            $objPHPExcel->getActiveSheet()->getStyle($cellBeginBorderAgent.':'.MyFunctionCustom::columnName($keyMonth+2).$rowNum )
                                    ->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);								

                            $rowNum++;	

                    $key_agent_id++;

                } // end foreach($dataAgent as $kAgent=>$itemAgent){

             $i++;   // for createSheet(
            } // ********** end for 1 sheet for($i=0;$i<count($model->costs_month);$i++){
        }    

         //save file 
         $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
         //$objWriter->save('MyExcel.xslx');

         for($level=ob_get_level();$level>0;--$level)
         {
                 @ob_end_clean();
         }
         header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
         header('Pragma: public');
         header('Content-type: '.'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
         header('Content-Disposition: attachment; filename="'.'Report Monthly Agent Cost 2-'.date('d-m-Y').'.'.'xlsx'.'"');
         header('Cache-Control: max-age=0');				
         $objWriter->save('php://output');			
         Yii::app()->end();         
        }catch (Exception $e)
        {
            MyFormat::catchAllException($e);
        }              
      }
	  
    public static function export_agent_by_costs_3($dataExport,$dataAgent, $aCost){
        try{
        Yii::import('application.extensions.vendors.PHPExcel',true);
        $objPHPExcel = new PHPExcel();
         // Set properties
         $objPHPExcel->getProperties()->setCreator("NguyenDung")
                    ->setLastModifiedBy("NguyenDung")
                    ->setTitle('Report Monthly Agent Cost 3')
                    ->setSubject("Office 2007 XLSX Document")
                    ->setDescription("Report Monthly Agent Cost 3")
                    ->setKeywords("office 2007 openxml php")
                    ->setCategory("GAS");
        // step 0: Tạo ra các sheet
        $i=0;
        if(count($dataExport)>0){
             $objPHPExcel->removeSheetByIndex(0); // may be need
//                    for($i;$i<count($dataExport);$i++){
            foreach($dataExport as $year=>$aCostId){
                $objPHPExcel->createSheet();
                $objPHPExcel->setActiveSheetIndex($i);
                // set default font and font-size
                $objPHPExcel->getActiveSheet()->getDefaultStyle()->getFont()->setName('Times New Roman');
                $objPHPExcel->getActiveSheet()->getDefaultStyle()->getFont()->setSize(12);
                $objPHPExcel->getActiveSheet()->setTitle('NĂM '.$year);
                $objPHPExcel->getActiveSheet()->setCellValue("A1", 'BÁO CÁO CHI PHÍ ĐẠI LÝ NĂM '.$year);
                $objPHPExcel->getActiveSheet()->mergeCells("A1:D1");

                $objPHPExcel->getActiveSheet()->setCellValue("A3", 'Chi Phí');
                $objPHPExcel->getActiveSheet()->setCellValue("B3", 'Đại Lý');
                $key_agent_id=0;
                $rowNum = 3;
                $index = 1;

                foreach($aCostId as $cost_id=>$month_){		

                            // render heaer of one agent
                            $keyMonth=1;
                            $sumCol = array();
                            foreach($dataExport[$year][$cost_id]['month'] as $month){
                                    $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($keyMonth+2).$rowNum, 'T'.$month);											
                                    $objPHPExcel->getActiveSheet()->getStyle(MyFunctionCustom::columnName($keyMonth+2).$rowNum)
                                    ->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                                    $objPHPExcel->getActiveSheet()
                                                    ->getStyle(MyFunctionCustom::columnName($index).($rowNum).':'.MyFunctionCustom::columnName($index+$keyMonth+2).($rowNum))
                                                    ->getFont()
                                                    ->setBold(true);								
                                    $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($keyMonth+3).$rowNum, 'Grand Total');
                                    $keyMonth++;
                            }
                            $rowNum++;
                            // end render heaer of one agent
                                                                // write name of agent
                                                                $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($index).$rowNum, $aCost[$cost_id]->name);

                            $cellBeginAgent=MyFunctionCustom::columnName($index+2).$rowNum;
                            $cellBeginMergeAgent=MyFunctionCustom::columnName($index).$rowNum;
                            $cellBeginBorderAgent=MyFunctionCustom::columnName($index).($rowNum-1);
                                                                $flagMergeCell=false;
                                                                        // begin render detail costs one agent
                                foreach($dataAgent as $agent_id=>$agent_obj){
                                                                                $keyMonth=1;
                                                                                $sumRow = 0;
                                                                                $flagAddRow=false;

                                                                                foreach($dataExport[$year][$cost_id]['month'] as $month){									
                                                                                                if(isset($dataExport[$year][$cost_id][$month][$agent_id])){
                                                                                                        $flagAddRow=true;
                                                                                                                $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($keyMonth+2).$rowNum, 
                                                                                                                                $dataExport[$year][$cost_id][$month][$agent_id]); 
                                                                                                                $sumRow+=	$dataExport[$year][$cost_id][$month][$agent_id];												
                                                                                                                if(isset($sumCol[$month]))
                                                                                                                                $sumCol[$month]+=$dataExport[$year][$cost_id][$month][$agent_id];			
                                                                                                                else
                                                                                                                                $sumCol[$month]=$dataExport[$year][$cost_id][$month][$agent_id];
                                                                                                }

                                                                                                $keyMonth++;
                                                                                } // end  foreach($dataExport[$year][$itemAgent->id] as $aMonth){
                                                                                if($flagAddRow){
                                                                                        $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($index+1).($rowNum), $agent_obj->first_name);
                                                                                        $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($keyMonth+2).$rowNum, $sumRow);
                                                                                        // bold for sum row
                                                                                        $objPHPExcel->getActiveSheet()															
                                                                                                                ->getStyle(MyFunctionCustom::columnName($keyMonth+2).$rowNum)
                                                                                                                ->getFont()
                                                                                                                ->setBold(true);		 												
                                                                                        $rowNum++;
                                                                                        $flagMergeCell=true;
                                                                                }

                                } // end foreach($aCost as $cost_id=>$cost_obj){
                                                                        // begin render detail costs one agent
                                                                        if($flagMergeCell){
                                                                                $objPHPExcel->getActiveSheet()
                                                                                        ->mergeCells($cellBeginMergeAgent.':'.MyFunctionCustom::columnName($index).($rowNum-1));
                                                                                $objPHPExcel->getActiveSheet()->getStyle($cellBeginMergeAgent.':'.MyFunctionCustom::columnName($index).($rowNum))
                                                                                        ->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
                                                                        }

                            // total col
                            $keyMonth=1;
                            $sumOneAgent=0;
                            $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($keyMonth).$rowNum,  'Grand Total');
                            foreach($dataExport[$year][$cost_id]['month'] as $month){
                                    if(isset($sumCol[$month])){
                                            $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($keyMonth+2).$rowNum, $sumCol[$month]);
                                            $sumOneAgent+=$sumCol[$month];	
                                    }
                                    $objPHPExcel->getActiveSheet()
                                                    ->getStyle(MyFunctionCustom::columnName($index).($rowNum).':'.MyFunctionCustom::columnName($index+$keyMonth+2).($rowNum))
                                                    ->getFont()
                                                    ->setBold(true);											
                                    $keyMonth++;
                            }
                            $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($keyMonth+2).$rowNum, $sumOneAgent);

                            // end total col
                             $objPHPExcel->getActiveSheet()
                                    ->getStyle($cellBeginAgent.':'.MyFunctionCustom::columnName($keyMonth+2).$rowNum)->getNumberFormat()
                                    ->setFormatCode('#,##0'); 


                            $objPHPExcel->getActiveSheet()->getStyle($cellBeginBorderAgent.':'.MyFunctionCustom::columnName($keyMonth+2).$rowNum )
                                    ->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);								

                            $rowNum++;	

                    $key_agent_id++;

                } // end foreach($dataAgent as $kAgent=>$itemAgent){

             $i++;   // for createSheet(
            } // ********** end for 1 sheet for($i=0;$i<count($model->costs_month);$i++){
        }    

         //save file 
         $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
         //$objWriter->save('MyExcel.xslx');

         for($level=ob_get_level();$level>0;--$level)
         {
                 @ob_end_clean();
         }
         header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
         header('Pragma: public');
         header('Content-type: '.'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
         header('Content-Disposition: attachment; filename="'.'Report Monthly Agent Cost 3-'.date('d-m-Y').'.'.'xlsx'.'"');
         header('Cache-Control: max-age=0');				
         $objWriter->save('php://output');			
         Yii::app()->end();	
        }catch (Exception $e)
        {
            MyFormat::catchAllException($e);
        }     
      }
	  
    public static function export_agent_output_by_material($dataExport,$dataAgent, $dataAllMaterial){
    try{
        Yii::import('application.extensions.vendors.PHPExcel',true);
        $objPHPExcel = new PHPExcel();
         // Set properties
         $objPHPExcel->getProperties()->setCreator("NguyenDung")
                    ->setLastModifiedBy("NguyenDung")
                    ->setTitle('Report Monthly Output')
                    ->setSubject("Office 2007 XLSX Document")
                    ->setDescription("Report Monthly Output")
                    ->setKeywords("office 2007 openxml php")
                    ->setCategory("GAS");
        // step 0: Tạo ra các sheet
        $i=0;
        if(count($dataExport)>0){
             $objPHPExcel->removeSheetByIndex(0); // may be need
//                    for($i;$i<count($dataExport);$i++){
            foreach($dataExport as $year=>$aAgentId){
                $objPHPExcel->createSheet();
                $objPHPExcel->setActiveSheetIndex($i);
                // set default font and font-size
                $objPHPExcel->getActiveSheet()->getDefaultStyle()->getFont()->setName('Times New Roman');
                $objPHPExcel->getActiveSheet()->getDefaultStyle()->getFont()->setSize(12);
                $objPHPExcel->getActiveSheet()->setTitle('NĂM '.$year);
                $objPHPExcel->getActiveSheet()->setCellValue("A1", 'BÁO CÁO SẢN LƯỢNG ĐẠI LÝ THEO SẢN PHẨM NĂM '.$year);
                $objPHPExcel->getActiveSheet()->mergeCells("A1:D1");

                $objPHPExcel->getActiveSheet()->setCellValue("A3", 'Đại Lý');
                $objPHPExcel->getActiveSheet()->setCellValue("B3", 'Sản Phẩm');
                $key_agent_id=0;
                $rowNum = 3;
                $index = 1;

                foreach($aAgentId as $agent_id=>$month_obj){		
                    if(isset($dataExport[$year][$agent_id]['arrMaterialId'])){
                            // render heaer of one agent
                            $keyMonth=1;
                            $sumCol = array();
                            foreach($dataExport[$year][$agent_id]['month'] as $month){
                                    $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($keyMonth+2).$rowNum, 'T'.$month);											
                                    $objPHPExcel->getActiveSheet()->getStyle(MyFunctionCustom::columnName($keyMonth+2).$rowNum)
                                    ->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                                    $objPHPExcel->getActiveSheet()
                                                    ->getStyle(MyFunctionCustom::columnName($index).($rowNum).':'.MyFunctionCustom::columnName($index+$keyMonth+2).($rowNum))
                                                    ->getFont()
                                                    ->setBold(true);								
                                    $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($keyMonth+3).$rowNum, 'Grand Total');
                                    $keyMonth++;
                            }
                            $rowNum++;
                            // end render heaer of one agent
                            $cellBeginAgent=MyFunctionCustom::columnName($index+2).$rowNum;
                            $cellBeginMergeAgent=MyFunctionCustom::columnName($index).$rowNum;
                            $cellBeginBorderAgent=MyFunctionCustom::columnName($index).($rowNum-1);

                                foreach($dataExport[$year][$agent_id]['arrMaterialId'] as $keyMaterial=>$material_id){
                                        $keyMonth=1;
                                        $sumRow = 0;
                                                $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($index+1).$rowNum, $dataAllMaterial[$material_id]->name);


                                                foreach($dataExport[$year][$agent_id]['month'] as $month){									
                                                        if($keyMaterial==0){
                                                                $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($index).$rowNum, $dataAgent[$agent_id]->first_name);
                                                        }

                                                        if(isset($dataExport[$year][$agent_id]['month_obj'][$month][$material_id])){
                                                                $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($keyMonth+2).$rowNum, 
                                                                        $dataExport[$year][$agent_id]['month_obj'][$month][$material_id]['parent_total']); 
                                                                $sumRow+=	$dataExport[$year][$agent_id]['month_obj'][$month][$material_id]['parent_total'];												
                                                                if(isset($sumCol[$month]))
                                                                        $sumCol[$month]+=$dataExport[$year][$agent_id]['month_obj'][$month][$material_id]['parent_total'];			
                                                                else
                                                                        $sumCol[$month]=$dataExport[$year][$agent_id]['month_obj'][$month][$material_id]['parent_total'];


                                                        }
                                                        $objPHPExcel->getActiveSheet()
                                                                ->getStyle(MyFunctionCustom::columnName($index).($rowNum).':'.MyFunctionCustom::columnName($index+$keyMonth+2).($rowNum))
                                                                ->getFont()
                                                                ->setBold(true);										
                                                        $keyMonth++;
                                                } // end  foreach($dataExport[$year][$itemAgent->id] as $aMonth){
                                                $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($keyMonth+2).$rowNum, $sumRow);
                                                $rowNum++;
                                                // for detail of one parent id
                                                    $key_of_month_out=0;
                                                        foreach($dataExport[$year][$agent_id]['month'] as $month){	
                                                                if(isset($dataExport[$year][$agent_id]['month_obj'][$month][$material_id])){
                                                                        if($key_of_month_out!=0)
                                                                            $rowNum-=(count($dataExport[$year][$agent_id]['month_obj'][$month][$material_id]['sub_obj']));
                                                                        foreach($dataExport[$year][$agent_id]['month_obj'][$month][$material_id]['sub_obj'] as $keySub=>$subObj){
                                                                                $keyMonth2=1;
                                                                                foreach($dataExport[$year][$agent_id]['month'] as $month2){	
                                                                                    if($subObj->sell_month==$month2){
                                                                                        $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($index+1).$rowNum, $dataAllMaterial[$subObj->materials_id]->name);
                                                                                        $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($keyMonth2+2).$rowNum, $subObj->qty);																							
                                                                                    }
                                                                                    $keyMonth2++;
                                                                                }
                                                                                $rowNum++;	
                                                                        }
                                                                }
                                                        $key_of_month_out++;
                                                        }
                                                // end for detail of one parent id

                                } // end foreach($dataExport[$year][$agent_id]['arrMaterialId'] as $keyMaterial=>$material_id){	

                                $objPHPExcel->getActiveSheet()
                                    ->mergeCells($cellBeginMergeAgent.':'.MyFunctionCustom::columnName($index).($rowNum-1));
                                $objPHPExcel->getActiveSheet()->getStyle($cellBeginMergeAgent.':'.MyFunctionCustom::columnName($index).($rowNum))
                                    ->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);


                            // total col
                            $keyMonth=1;
                            $sumOneAgent=0;
                            $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($keyMonth).$rowNum,  'Grand Total');
                            foreach($dataExport[$year][$agent_id]['month'] as $month){
                                    if(isset($sumCol[$month])){
                                            $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($keyMonth+2).$rowNum, $sumCol[$month]);
                                            $sumOneAgent+=$sumCol[$month];	
                                    }
                                    $objPHPExcel->getActiveSheet()
                                                    ->getStyle(MyFunctionCustom::columnName($index).($rowNum).':'.MyFunctionCustom::columnName($index+$keyMonth+2).($rowNum))
                                                    ->getFont()
                                                    ->setBold(true);											
                                    $keyMonth++;
                            }
                            $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($keyMonth+2).$rowNum, $sumOneAgent);

                            // end total col
                             $objPHPExcel->getActiveSheet()
                                    ->getStyle($cellBeginAgent.':'.MyFunctionCustom::columnName($keyMonth+2).$rowNum)->getNumberFormat()
                                    ->setFormatCode('#,##0'); 


                            $objPHPExcel->getActiveSheet()->getStyle($cellBeginBorderAgent.':'.MyFunctionCustom::columnName($keyMonth+2).$rowNum )
                                    ->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);								

                            $rowNum++;	
                        }
                    $key_agent_id++;

                } // end foreach($dataAgent as $kAgent=>$itemAgent){



             $i++;   // for createSheet(
            } // ********** end for 1 sheet for($i=0;$i<count($model->costs_month);$i++){
        }    

         //save file 
         $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
         //$objWriter->save('MyExcel.xslx');

         for($level=ob_get_level();$level>0;--$level)
         {
                 @ob_end_clean();
         }
         header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
         header('Pragma: public');
         header('Content-type: '.'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
         header('Content-Disposition: attachment; filename="'.'Report Monthly Output-'.date('d-m-Y').'.'.'xlsx'.'"');
         header('Cache-Control: max-age=0');				
         $objWriter->save('php://output');			
         Yii::app()->end();
        }catch (Exception $e)
        {
            MyFormat::catchAllException($e);
        }              
      }
    
	  
    public static function export_agent_gross_profit_by_material($dataExportRevenue, $dataExportPriceRoot, $dataAgent, $dataAllMaterial){
        try{
        Yii::import('application.extensions.vendors.PHPExcel',true);
        $objPHPExcel = new PHPExcel();
         // Set properties
         $objPHPExcel->getProperties()->setCreator("NguyenDung")
                    ->setLastModifiedBy("NguyenDung")
                    ->setTitle('Report Monthly Gross Profit')
                    ->setSubject("Office 2007 XLSX Document")
                    ->setDescription("Report Monthly Gross Profit")
                    ->setKeywords("office 2007 openxml php")
                    ->setCategory("GAS");
        // step 0: Tạo ra các sheet
        $i=0;
        if(count($dataExportRevenue)>0){
             $objPHPExcel->removeSheetByIndex(0); // may be need
//                    for($i;$i<count($dataExportRevenue);$i++){
            foreach($dataExportRevenue as $year=>$aAgentId){
                $objPHPExcel->createSheet();
                $objPHPExcel->setActiveSheetIndex($i);
                // set default font and font-size
                $objPHPExcel->getActiveSheet()->getDefaultStyle()->getFont()->setName('Times New Roman');
                $objPHPExcel->getActiveSheet()->getDefaultStyle()->getFont()->setSize(12);
                $objPHPExcel->getActiveSheet()->setTitle('NĂM '.$year);
                $objPHPExcel->getActiveSheet()->setCellValue("A1", 'BÁO CÁO LỢI NHUẬN GỘP ĐẠI LÝ THEO SẢN PHẨM NĂM '.$year);
                $objPHPExcel->getActiveSheet()->mergeCells("A1:D1");

                $objPHPExcel->getActiveSheet()->setCellValue("A3", 'Đại Lý');
                $objPHPExcel->getActiveSheet()->setCellValue("B3", 'Sản Phẩm');
                $key_agent_id=0;
                $rowNum = 3;
                $index = 1;

                foreach($aAgentId as $agent_id=>$month_obj){		
                    if(isset($dataExportRevenue[$year][$agent_id]['arrMaterialId'])){
                            // render heaer of one agent
                            $keyMonth=1;
                            $sumCol = array();
                            foreach($dataExportRevenue[$year][$agent_id]['month'] as $month){
                                    $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($keyMonth+2).$rowNum, 'T'.$month);											
                                    $objPHPExcel->getActiveSheet()->getStyle(MyFunctionCustom::columnName($keyMonth+2).$rowNum)
                                    ->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                                    $objPHPExcel->getActiveSheet()
                                                    ->getStyle(MyFunctionCustom::columnName($index).($rowNum).':'.MyFunctionCustom::columnName($index+$keyMonth+2).($rowNum))
                                                    ->getFont()
                                                    ->setBold(true);								
                                    $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($keyMonth+3).$rowNum, 'Grand Total');
                                    $keyMonth++;
                            }
                            $rowNum++;
                            // end render heaer of one agent
                            $cellBeginAgent=MyFunctionCustom::columnName($index+2).$rowNum;
                            $cellBeginMergeAgent=MyFunctionCustom::columnName($index).$rowNum;
                            $cellBeginBorderAgent=MyFunctionCustom::columnName($index).($rowNum-1);
                                // begin render of one parent material
                                foreach($dataExportRevenue[$year][$agent_id]['arrMaterialId'] as $keyMaterial=>$material_id){
                                        $keyMonth=1;
                                        $sumRow = 0;
                                                $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($index+1).$rowNum, $dataAllMaterial[$material_id]->name);


                                                foreach($dataExportRevenue[$year][$agent_id]['month'] as $month){									
                                                        if($keyMaterial==0){
                                                                $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($index).$rowNum, $dataAgent[$agent_id]->first_name);
                                                        }
                                                        $Revenue_ = isset($dataExportRevenue[$year][$agent_id]['month_obj'][$month][$material_id]['parent_total'])?$dataExportRevenue[$year][$agent_id]['month_obj'][$month][$material_id]['parent_total']:0;
                                                        $PriceRoot_ = isset($dataExportPriceRoot[$year][$agent_id]['month_obj'][$month][$material_id]['parent_total'])?$dataExportPriceRoot[$year][$agent_id]['month_obj'][$month][$material_id]['parent_total']:0;
                                                        $cellValue = $Revenue_-$PriceRoot_;

                                                        $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($keyMonth+2).$rowNum, 
                                                                $cellValue); 
                                                        $sumRow+=$cellValue;
                                                        if(isset($sumCol[$month]))
                                                                $sumCol[$month]+=$cellValue;
                                                        else
                                                                $sumCol[$month]=$cellValue;

                                                        $objPHPExcel->getActiveSheet()
                                                                ->getStyle(MyFunctionCustom::columnName($index).($rowNum).':'.MyFunctionCustom::columnName($index+$keyMonth+2).($rowNum))
                                                                ->getFont()
                                                                ->setBold(true);										
                                                        $keyMonth++;
                                                } // end  foreach($dataExportRevenue[$year][$itemAgent->id] as $aMonth){
                                                $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($keyMonth+2).$rowNum, $sumRow);
                                                $rowNum++;
                                                // for detail of one parent id
                                                foreach($dataExportRevenue[$year][$agent_id]['month'] as $month){	
                                                    if(isset($dataExportRevenue[$year][$agent_id]['month_obj'][$month][$material_id])){
                                                            foreach($dataExportRevenue[$year][$agent_id]['month_obj'][$month][$material_id]['sub_obj'] as $keySub=>$subObj){
                                                                    $keyMonth2=1;
                                                                    foreach($dataExportRevenue[$year][$agent_id]['month'] as $month2){	
                                                                            if($subObj->sell_month==$month2){
                                                                                    $PriceRoot_1 = isset($dataExportPriceRoot[$year][$agent_id]['month_obj'][$month][$material_id]['sub_obj'][$keySub]->total_root)?$dataExportPriceRoot[$year][$agent_id]['month_obj'][$month][$material_id]['sub_obj'][$keySub]->total_root:0;
                                                                                    $cellValue_1 = $subObj->total_sell - $PriceRoot_1;
                                                                                    $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($index+1).$rowNum, $dataAllMaterial[$subObj->materials_id]->name);
                                                                                    $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($keyMonth2+2).$rowNum, $cellValue_1);	
                                                                            }
                                                                            $keyMonth2++;
                                                                    }
                                                                    $rowNum++;	
                                                            }
                                                    }
                                                }
                                                // end for detail of one parent id

                                } // end foreach($dataExportRevenue[$year][$agent_id]['arrMaterialId'] as $keyMaterial=>$material_id){	
                                // end render of one parent material    
                                $objPHPExcel->getActiveSheet()
                                    ->mergeCells($cellBeginMergeAgent.':'.MyFunctionCustom::columnName($index).($rowNum-1));
                                $objPHPExcel->getActiveSheet()->getStyle($cellBeginMergeAgent.':'.MyFunctionCustom::columnName($index).($rowNum))
                                    ->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);


                            // total col
                            $keyMonth=1;
                            $sumOneAgent=0;
                            $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($keyMonth).$rowNum,  'Grand Total');
                            foreach($dataExportRevenue[$year][$agent_id]['month'] as $month){
                                    if(isset($sumCol[$month])){
                                            $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($keyMonth+2).$rowNum, $sumCol[$month]);
                                            $sumOneAgent+=$sumCol[$month];	
                                    }
                                    $objPHPExcel->getActiveSheet()
                                                    ->getStyle(MyFunctionCustom::columnName($index).($rowNum).':'.MyFunctionCustom::columnName($index+$keyMonth+2).($rowNum))
                                                    ->getFont()
                                                    ->setBold(true);											
                                    $keyMonth++;
                            }
                            $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($keyMonth+2).$rowNum, $sumOneAgent);

                            // end total col
                             $objPHPExcel->getActiveSheet()
                                    ->getStyle($cellBeginAgent.':'.MyFunctionCustom::columnName($keyMonth+2).$rowNum)->getNumberFormat()
                                    ->setFormatCode('#,##0'); 


                            $objPHPExcel->getActiveSheet()->getStyle($cellBeginBorderAgent.':'.MyFunctionCustom::columnName($keyMonth+2).$rowNum )
                                    ->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);								

                            $rowNum++;	
                        }
                    $key_agent_id++;

                } // end foreach($dataAgent as $kAgent=>$itemAgent){



             $i++;   // for createSheet(
            } // ********** end for 1 sheet for($i=0;$i<count($model->costs_month);$i++){
        }    

         //save file 
         $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
         //$objWriter->save('MyExcel.xslx');

         for($level=ob_get_level();$level>0;--$level)
         {
                 @ob_end_clean();
         }
         header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
         header('Pragma: public');
         header('Content-type: '.'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
         header('Content-Disposition: attachment; filename="'.'Report Monthly Gross Profit-'.date('d-m-Y').'.'.'xlsx'.'"');
         header('Cache-Control: max-age=0');				
         $objWriter->save('php://output');			
         Yii::app()->end();
         }catch (Exception $e)
        {
            MyFormat::catchAllException($e);
        }     
      }
    
      
      
    public static function export_revenue_material_by_agent($dataExport,$dataAgent, $dataAllMaterial, $model){
    try{
        Yii::import('application.extensions.vendors.PHPExcel',true);
        $objPHPExcel = new PHPExcel();
         // Set properties
         $objPHPExcel->getProperties()->setCreator("NguyenDung")
                    ->setLastModifiedBy("NguyenDung")
                    ->setTitle('Report Product Revenue')
                    ->setSubject("Office 2007 XLSX Document")
                    ->setDescription("Report Product Revenue")
                    ->setKeywords("office 2007 openxml php")
                    ->setCategory("GAS");
        // step 0: Tạo ra các sheet
        $i=0;
        if(count($dataExport)>0){
             $objPHPExcel->removeSheetByIndex(0); // may be need
//                    for($i;$i<count($dataExport);$i++){
            foreach($dataExport as $year=>$aMaterialId){
                $objPHPExcel->createSheet();
                $objPHPExcel->setActiveSheetIndex($i);
                // set default font and font-size
                $objPHPExcel->getActiveSheet()->getDefaultStyle()->getFont()->setName('Times New Roman');
                $objPHPExcel->getActiveSheet()->getDefaultStyle()->getFont()->setSize(12);
                $objPHPExcel->getActiveSheet()->setTitle('NĂM '.$year);
                $material_sub_name = $model->materials_sub_id?$dataAllMaterial[$model->materials_sub_id]->name.' ':'';
                $objPHPExcel->getActiveSheet()->setCellValue("A1", 'BÁO CÁO DOANH THU SẢN PHẨM '.$material_sub_name.' NĂM '.$year);
                $objPHPExcel->getActiveSheet()->mergeCells("A1:D1");

                $objPHPExcel->getActiveSheet()->setCellValue("A3", 'Sản Phẩm');
                $objPHPExcel->getActiveSheet()->setCellValue("B3", 'Đại Lý');
                $rowNum = 3;
                $index = 1;

                foreach($aMaterialId as $material_id=>$month_obj){		
                    if(isset($dataExport[$year][$material_id]['arrAgentId']) && count($dataExport[$year][$material_id]['arrAgentId'])>0){
                            // render heaer of one agent
                            $keyMonth=1;
                            $sumCol = array();
                            $key_agent_id=0;
                            foreach($dataExport[$year][$material_id]['month'] as $month){
                                    $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($keyMonth+2).$rowNum, 'T'.$month);											
                                    $objPHPExcel->getActiveSheet()->getStyle(MyFunctionCustom::columnName($keyMonth+2).$rowNum)
                                    ->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                                    $objPHPExcel->getActiveSheet()
                                                    ->getStyle(MyFunctionCustom::columnName($index).($rowNum).':'.MyFunctionCustom::columnName($index+$keyMonth+2).($rowNum))
                                                    ->getFont()
                                                    ->setBold(true);								
                                    $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($keyMonth+3).$rowNum, 'Grand Total');
                                    $keyMonth++;
                            }
                            $rowNum++;
                            // end render heaer of one agent
                            $cellBeginAgent=MyFunctionCustom::columnName($index+2).$rowNum;
                            $cellBeginMergeAgent=MyFunctionCustom::columnName($index).$rowNum;
                            $cellBeginBorderAgent=MyFunctionCustom::columnName($index).($rowNum-1);

                                foreach($dataAgent as $agent_id=>$obj_agent){
                                    if(in_array($agent_id, $dataExport[$year][$material_id]['arrAgentId'])){
                                        $keyMonth=1;
                                        $sumRow = 0;
                                        if($key_agent_id==0){
                                            $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($index).$rowNum, $dataAllMaterial[$material_id]->name);
                                        }
                                        $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($index+1).$rowNum, $obj_agent->first_name);

                                        foreach($dataExport[$year][$material_id]['month'] as $month){									
                                            if(isset($dataExport[$year][$material_id]['month_obj'][$month][$agent_id])){
                                                    $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($keyMonth+2).$rowNum, 
                                                            $dataExport[$year][$material_id]['month_obj'][$month][$agent_id]); 
                                                    $sumRow+=	$dataExport[$year][$material_id]['month_obj'][$month][$agent_id];												
                                                    if(isset($sumCol[$month]))
                                                            $sumCol[$month]+=$dataExport[$year][$material_id]['month_obj'][$month][$agent_id];			
                                                    else
                                                            $sumCol[$month]=$dataExport[$year][$material_id]['month_obj'][$month][$agent_id];


                                            }
//                                                    $objPHPExcel->getActiveSheet()
//                                                            ->getStyle(MyFunctionCustom::columnName($index).($rowNum).':'.MyFunctionCustom::columnName($index+$keyMonth+2).($rowNum))
//                                                            ->getFont()
//                                                            ->setBold(true);										
                                            $keyMonth++;
                                        } // end  foreach($dataExport[$year][$itemAgent->id] as $aMonth){
                                        $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($keyMonth+2).$rowNum, $sumRow);
                                        $rowNum++;
                                        $key_agent_id++;
                                    } // end if in_array()
                                } // end foreach($dataExport[$year][$agent_id]['arrMaterialId'] as $keyMaterial=>$material_id){	

                                $objPHPExcel->getActiveSheet()
                                    ->mergeCells($cellBeginMergeAgent.':'.MyFunctionCustom::columnName($index).($rowNum-1));
                                $objPHPExcel->getActiveSheet()->getStyle($cellBeginMergeAgent.':'.MyFunctionCustom::columnName($index).($rowNum))
                                    ->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);


                            // total col
                            $keyMonth=1;
                            $sumOneMaterial=0;
                            $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($keyMonth).$rowNum,  'Grand Total');
                            foreach($dataExport[$year][$material_id]['month'] as $month){
                                    if(isset($sumCol[$month])){
                                            $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($keyMonth+2).$rowNum, $sumCol[$month]);
                                            $sumOneMaterial+=$sumCol[$month];	
                                    }
                                    $objPHPExcel->getActiveSheet()
                                                    ->getStyle(MyFunctionCustom::columnName($index).($rowNum).':'.MyFunctionCustom::columnName($index+$keyMonth+2).($rowNum))
                                                    ->getFont()
                                                    ->setBold(true);											
                                    $keyMonth++;
                            }
                            $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($keyMonth+2).$rowNum, $sumOneMaterial);

                            // end total col
                             $objPHPExcel->getActiveSheet()
                                    ->getStyle($cellBeginAgent.':'.MyFunctionCustom::columnName($keyMonth+2).$rowNum)->getNumberFormat()
                                    ->setFormatCode('#,##0'); 


                            $objPHPExcel->getActiveSheet()->getStyle($cellBeginBorderAgent.':'.MyFunctionCustom::columnName($keyMonth+2).$rowNum )
                                    ->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);								

                            $rowNum++;	
                        }
                    $key_agent_id++;

                } // end foreach($dataAgent as $kAgent=>$itemAgent){



             $i++;   // for createSheet(
            } // ********** end for 1 sheet for($i=0;$i<count($model->costs_month);$i++){
        }    

         //save file 
         $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
         //$objWriter->save('MyExcel.xslx');

         for($level=ob_get_level();$level>0;--$level)
         {
                 @ob_end_clean();
         }
         header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
         header('Pragma: public');
         header('Content-type: '.'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
         header('Content-Disposition: attachment; filename="'.'Report Product Revenue-'.date('d-m-Y').'.'.'xlsx'.'"');
         header('Cache-Control: max-age=0');				
         $objWriter->save('php://output');			
         Yii::app()->end();		          
         }catch (Exception $e)
        {
            MyFormat::catchAllException($e);
        }     
      }
    
      
      
    public static function export_price_root_material_by_agent($dataExport,$dataAgent, $dataAllMaterial, $model){
        try{
        Yii::import('application.extensions.vendors.PHPExcel',true);
        $objPHPExcel = new PHPExcel();
         // Set properties
         $objPHPExcel->getProperties()->setCreator("NguyenDung")
                    ->setLastModifiedBy("NguyenDung")
                    ->setTitle('Report Product Price Root')
                    ->setSubject("Office 2007 XLSX Document")
                    ->setDescription("Report Product Price Root")
                    ->setKeywords("office 2007 openxml php")
                    ->setCategory("GAS");
        // step 0: Tạo ra các sheet
        $i=0;
        if(count($dataExport)>0){
             $objPHPExcel->removeSheetByIndex(0); // may be need
//                    for($i;$i<count($dataExport);$i++){
            foreach($dataExport as $year=>$aMaterialId){
                $objPHPExcel->createSheet();
                $objPHPExcel->setActiveSheetIndex($i);
                // set default font and font-size
                $objPHPExcel->getActiveSheet()->getDefaultStyle()->getFont()->setName('Times New Roman');
                $objPHPExcel->getActiveSheet()->getDefaultStyle()->getFont()->setSize(12);
                $objPHPExcel->getActiveSheet()->setTitle('NĂM '.$year);
                $material_sub_name = $model->materials_sub_id?$dataAllMaterial[$model->materials_sub_id]->name.' ':'';
                $objPHPExcel->getActiveSheet()->setCellValue("A1", 'BÁO CÁO GIÁ VỐN SẢN PHẨM '.$material_sub_name.' NĂM '.$year);
                $objPHPExcel->getActiveSheet()->mergeCells("A1:D1");

                $objPHPExcel->getActiveSheet()->setCellValue("A3", 'Sản Phẩm');
                $objPHPExcel->getActiveSheet()->setCellValue("B3", 'Đại Lý');
                $rowNum = 3;
                $index = 1;

                foreach($aMaterialId as $material_id=>$month_obj){		
                    if(isset($dataExport[$year][$material_id]['arrAgentId']) && count($dataExport[$year][$material_id]['arrAgentId'])>0){
                            // render heaer of one agent
                            $keyMonth=1;
                            $sumCol = array();
                            $key_agent_id=0;
                            foreach($dataExport[$year][$material_id]['month'] as $month){
                                    $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($keyMonth+2).$rowNum, 'T'.$month);											
                                    $objPHPExcel->getActiveSheet()->getStyle(MyFunctionCustom::columnName($keyMonth+2).$rowNum)
                                    ->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                                    $objPHPExcel->getActiveSheet()
                                                    ->getStyle(MyFunctionCustom::columnName($index).($rowNum).':'.MyFunctionCustom::columnName($index+$keyMonth+2).($rowNum))
                                                    ->getFont()
                                                    ->setBold(true);								
                                    $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($keyMonth+3).$rowNum, 'Grand Total');
                                    $keyMonth++;
                            }
                            $rowNum++;
                            // end render heaer of one agent
                            $cellBeginAgent=MyFunctionCustom::columnName($index+2).$rowNum;
                            $cellBeginMergeAgent=MyFunctionCustom::columnName($index).$rowNum;
                            $cellBeginBorderAgent=MyFunctionCustom::columnName($index).($rowNum-1);

                                foreach($dataAgent as $agent_id=>$obj_agent){
                                    if(in_array($agent_id, $dataExport[$year][$material_id]['arrAgentId'])){
                                        $keyMonth=1;
                                        $sumRow = 0;
                                        if($key_agent_id==0){
                                            $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($index).$rowNum, $dataAllMaterial[$material_id]->name);
                                        }
                                        $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($index+1).$rowNum, $obj_agent->first_name);

                                        foreach($dataExport[$year][$material_id]['month'] as $month){									
                                            if(isset($dataExport[$year][$material_id]['month_obj'][$month][$agent_id])){
                                                    $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($keyMonth+2).$rowNum, 
                                                            $dataExport[$year][$material_id]['month_obj'][$month][$agent_id]); 
                                                    $sumRow+=	$dataExport[$year][$material_id]['month_obj'][$month][$agent_id];												
                                                    if(isset($sumCol[$month]))
                                                            $sumCol[$month]+=$dataExport[$year][$material_id]['month_obj'][$month][$agent_id];			
                                                    else
                                                            $sumCol[$month]=$dataExport[$year][$material_id]['month_obj'][$month][$agent_id];


                                            }
//                                                    $objPHPExcel->getActiveSheet()
//                                                            ->getStyle(MyFunctionCustom::columnName($index).($rowNum).':'.MyFunctionCustom::columnName($index+$keyMonth+2).($rowNum))
//                                                            ->getFont()
//                                                            ->setBold(true);										
                                            $keyMonth++;
                                        } // end  foreach($dataExport[$year][$itemAgent->id] as $aMonth){
                                        $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($keyMonth+2).$rowNum, $sumRow);
                                        $rowNum++;
                                        $key_agent_id++;
                                    } // end if in_array()
                                } // end foreach($dataExport[$year][$agent_id]['arrMaterialId'] as $keyMaterial=>$material_id){	

                                $objPHPExcel->getActiveSheet()
                                    ->mergeCells($cellBeginMergeAgent.':'.MyFunctionCustom::columnName($index).($rowNum-1));
                                $objPHPExcel->getActiveSheet()->getStyle($cellBeginMergeAgent.':'.MyFunctionCustom::columnName($index).($rowNum))
                                    ->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);


                            // total col
                            $keyMonth=1;
                            $sumOneMaterial=0;
                            $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($keyMonth).$rowNum,  'Grand Total');
                            foreach($dataExport[$year][$material_id]['month'] as $month){
                                    if(isset($sumCol[$month])){
                                            $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($keyMonth+2).$rowNum, $sumCol[$month]);
                                            $sumOneMaterial+=$sumCol[$month];	
                                    }
                                    $objPHPExcel->getActiveSheet()
                                                    ->getStyle(MyFunctionCustom::columnName($index).($rowNum).':'.MyFunctionCustom::columnName($index+$keyMonth+2).($rowNum))
                                                    ->getFont()
                                                    ->setBold(true);											
                                    $keyMonth++;
                            }
                            $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($keyMonth+2).$rowNum, $sumOneMaterial);

                            // end total col
                             $objPHPExcel->getActiveSheet()
                                    ->getStyle($cellBeginAgent.':'.MyFunctionCustom::columnName($keyMonth+2).$rowNum)->getNumberFormat()
                                    ->setFormatCode('#,##0'); 


                            $objPHPExcel->getActiveSheet()->getStyle($cellBeginBorderAgent.':'.MyFunctionCustom::columnName($keyMonth+2).$rowNum )
                                    ->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);								

                            $rowNum++;	
                        }
                    $key_agent_id++;

                } // end foreach($dataAgent as $kAgent=>$itemAgent){



             $i++;   // for createSheet(
            } // ********** end for 1 sheet for($i=0;$i<count($model->costs_month);$i++){
        }    

         //save file 
         $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
         //$objWriter->save('MyExcel.xslx');

         for($level=ob_get_level();$level>0;--$level)
         {
                 @ob_end_clean();
         }
         header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
         header('Pragma: public');
         header('Content-type: '.'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
         header('Content-Disposition: attachment; filename="'.'Report Product Price Root-'.date('d-m-Y').'.'.'xlsx'.'"');
         header('Cache-Control: max-age=0');				
         $objWriter->save('php://output');			
         Yii::app()->end();		
         }catch (Exception $e)
        {
            MyFormat::catchAllException($e);
        }     
      }
    
      
    public static function export_output_material_by_agent($dataExport,$dataAgent, $dataAllMaterial, $model){
        try{
        Yii::import('application.extensions.vendors.PHPExcel',true);
        $objPHPExcel = new PHPExcel();
         // Set properties
         $objPHPExcel->getProperties()->setCreator("NguyenDung")
                    ->setLastModifiedBy("NguyenDung")
                    ->setTitle('Report Product Output')
                    ->setSubject("Office 2007 XLSX Document")
                    ->setDescription("Report Product Output")
                    ->setKeywords("office 2007 openxml php")
                    ->setCategory("GAS");
        // step 0: Tạo ra các sheet
        $i=0;
        if(count($dataExport)>0){
             $objPHPExcel->removeSheetByIndex(0); // may be need
//                    for($i;$i<count($dataExport);$i++){
            foreach($dataExport as $year=>$aMaterialId){
                $objPHPExcel->createSheet();
                $objPHPExcel->setActiveSheetIndex($i);
                // set default font and font-size
                $objPHPExcel->getActiveSheet()->getDefaultStyle()->getFont()->setName('Times New Roman');
                $objPHPExcel->getActiveSheet()->getDefaultStyle()->getFont()->setSize(12);
                $objPHPExcel->getActiveSheet()->setTitle('NĂM '.$year);
                $material_sub_name = $model->materials_sub_id?$dataAllMaterial[$model->materials_sub_id]->name.' ':'';
                $objPHPExcel->getActiveSheet()->setCellValue("A1", 'BÁO CÁO SẢN LƯỢNG SẢN PHẨM '.$material_sub_name.' NĂM '.$year);
                $objPHPExcel->getActiveSheet()->mergeCells("A1:D1");

                $objPHPExcel->getActiveSheet()->setCellValue("A3", 'Sản Phẩm');
                $objPHPExcel->getActiveSheet()->setCellValue("B3", 'Đại Lý');
                $rowNum = 3;
                $index = 1;

                foreach($aMaterialId as $material_id=>$month_obj){		
                    if(isset($dataExport[$year][$material_id]['arrAgentId']) && count($dataExport[$year][$material_id]['arrAgentId'])>0){
                            // render heaer of one agent
                            $keyMonth=1;
                            $sumCol = array();
                            $key_agent_id=0;
                            foreach($dataExport[$year][$material_id]['month'] as $month){
                                    $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($keyMonth+2).$rowNum, 'T'.$month);											
                                    $objPHPExcel->getActiveSheet()->getStyle(MyFunctionCustom::columnName($keyMonth+2).$rowNum)
                                    ->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                                    $objPHPExcel->getActiveSheet()
                                                    ->getStyle(MyFunctionCustom::columnName($index).($rowNum).':'.MyFunctionCustom::columnName($index+$keyMonth+2).($rowNum))
                                                    ->getFont()
                                                    ->setBold(true);								
                                    $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($keyMonth+3).$rowNum, 'Grand Total');
                                    $keyMonth++;
                            }
                            $rowNum++;
                            // end render heaer of one agent
                            $cellBeginAgent=MyFunctionCustom::columnName($index+2).$rowNum;
                            $cellBeginMergeAgent=MyFunctionCustom::columnName($index).$rowNum;
                            $cellBeginBorderAgent=MyFunctionCustom::columnName($index).($rowNum-1);

                                foreach($dataAgent as $agent_id=>$obj_agent){
                                    if(in_array($agent_id, $dataExport[$year][$material_id]['arrAgentId'])){
                                        $keyMonth=1;
                                        $sumRow = 0;
                                        if($key_agent_id==0){
                                            $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($index).$rowNum, $dataAllMaterial[$material_id]->name);
                                        }
                                        $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($index+1).$rowNum, $obj_agent->first_name);

                                        foreach($dataExport[$year][$material_id]['month'] as $month){									
                                            if(isset($dataExport[$year][$material_id]['month_obj'][$month][$agent_id])){
                                                    $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($keyMonth+2).$rowNum, 
                                                            $dataExport[$year][$material_id]['month_obj'][$month][$agent_id]); 
                                                    $sumRow+=	$dataExport[$year][$material_id]['month_obj'][$month][$agent_id];												
                                                    if(isset($sumCol[$month]))
                                                            $sumCol[$month]+=$dataExport[$year][$material_id]['month_obj'][$month][$agent_id];			
                                                    else
                                                            $sumCol[$month]=$dataExport[$year][$material_id]['month_obj'][$month][$agent_id];


                                            }
//                                                    $objPHPExcel->getActiveSheet()
//                                                            ->getStyle(MyFunctionCustom::columnName($index).($rowNum).':'.MyFunctionCustom::columnName($index+$keyMonth+2).($rowNum))
//                                                            ->getFont()
//                                                            ->setBold(true);										
                                            $keyMonth++;
                                        } // end  foreach($dataExport[$year][$itemAgent->id] as $aMonth){
                                        $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($keyMonth+2).$rowNum, $sumRow);
                                        $rowNum++;
                                        $key_agent_id++;
                                    } // end if in_array()
                                } // end foreach($dataExport[$year][$agent_id]['arrMaterialId'] as $keyMaterial=>$material_id){	

                                $objPHPExcel->getActiveSheet()
                                    ->mergeCells($cellBeginMergeAgent.':'.MyFunctionCustom::columnName($index).($rowNum-1));
                                $objPHPExcel->getActiveSheet()->getStyle($cellBeginMergeAgent.':'.MyFunctionCustom::columnName($index).($rowNum))
                                    ->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);


                            // total col
                            $keyMonth=1;
                            $sumOneMaterial=0;
                            $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($keyMonth).$rowNum,  'Grand Total');
                            foreach($dataExport[$year][$material_id]['month'] as $month){
                                    if(isset($sumCol[$month])){
                                            $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($keyMonth+2).$rowNum, $sumCol[$month]);
                                            $sumOneMaterial+=$sumCol[$month];	
                                    }
                                    $objPHPExcel->getActiveSheet()
                                                    ->getStyle(MyFunctionCustom::columnName($index).($rowNum).':'.MyFunctionCustom::columnName($index+$keyMonth+2).($rowNum))
                                                    ->getFont()
                                                    ->setBold(true);											
                                    $keyMonth++;
                            }
                            $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($keyMonth+2).$rowNum, $sumOneMaterial);

                            // end total col
                             $objPHPExcel->getActiveSheet()
                                    ->getStyle($cellBeginAgent.':'.MyFunctionCustom::columnName($keyMonth+2).$rowNum)->getNumberFormat()
                                    ->setFormatCode('#,##0'); 


                            $objPHPExcel->getActiveSheet()->getStyle($cellBeginBorderAgent.':'.MyFunctionCustom::columnName($keyMonth+2).$rowNum )
                                    ->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);								

                            $rowNum++;	
                        }
                    $key_agent_id++;

                } // end foreach($dataAgent as $kAgent=>$itemAgent){



             $i++;   // for createSheet(
            } // ********** end for 1 sheet for($i=0;$i<count($model->costs_month);$i++){
        }    

         //save file 
         $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
         //$objWriter->save('MyExcel.xslx');

         for($level=ob_get_level();$level>0;--$level)
         {
                 @ob_end_clean();
         }
         header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
         header('Pragma: public');
         header('Content-type: '.'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
         header('Content-Disposition: attachment; filename="'.'Report Product Output-'.date('d-m-Y').'.'.'xlsx'.'"');
         header('Cache-Control: max-age=0');				
         $objWriter->save('php://output');			
         Yii::app()->end();		          
         }catch (Exception $e)
        {
            MyFormat::catchAllException($e);
        }     
      }
    
      
    public static function export_gross_profit_material_by_agent($dataExportRevenue, $dataExportPriceRoot, $dataAgent, $dataAllMaterial, $model){
        try{
        Yii::import('application.extensions.vendors.PHPExcel',true);
        $objPHPExcel = new PHPExcel();
         // Set properties
         $objPHPExcel->getProperties()->setCreator("NguyenDung")
                    ->setLastModifiedBy("NguyenDung")
                    ->setTitle('Report Product Gross Profit')
                    ->setSubject("Office 2007 XLSX Document")
                    ->setDescription("Report Product Gross Profit")
                    ->setKeywords("office 2007 openxml php")
                    ->setCategory("GAS");
        // step 0: Tạo ra các sheet
        $i=0;
        if(count($dataExportRevenue)>0){
             $objPHPExcel->removeSheetByIndex(0); // may be need
//                    for($i;$i<count($dataExportRevenue);$i++){
            foreach($dataExportRevenue as $year=>$aMaterialId){
                $objPHPExcel->createSheet();
                $objPHPExcel->setActiveSheetIndex($i);
                // set default font and font-size
                $objPHPExcel->getActiveSheet()->getDefaultStyle()->getFont()->setName('Times New Roman');
                $objPHPExcel->getActiveSheet()->getDefaultStyle()->getFont()->setSize(12);
                $objPHPExcel->getActiveSheet()->setTitle('NĂM '.$year);
                $material_sub_name = $model->materials_sub_id?$dataAllMaterial[$model->materials_sub_id]->name.' ':'';
                $objPHPExcel->getActiveSheet()->setCellValue("A1", 'BÁO CÁO LỢI NHUẬN GỘP SẢN PHẨM '.$material_sub_name.' NĂM '.$year);
                $objPHPExcel->getActiveSheet()->mergeCells("A1:D1");

                $objPHPExcel->getActiveSheet()->setCellValue("A3", 'Sản Phẩm');
                $objPHPExcel->getActiveSheet()->setCellValue("B3", 'Đại Lý');
                $rowNum = 3;
                $index = 1;

                foreach($aMaterialId as $material_id=>$month_obj){		
                    if(isset($dataExportRevenue[$year][$material_id]['arrAgentId']) && count($dataExportRevenue[$year][$material_id]['arrAgentId'])>0){
                            // render heaer of one agent
                            $keyMonth=1;
                            $sumCol = array();
                            $key_agent_id=0;
                            foreach($dataExportRevenue[$year][$material_id]['month'] as $month){
                                    $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($keyMonth+2).$rowNum, 'T'.$month);											
                                    $objPHPExcel->getActiveSheet()->getStyle(MyFunctionCustom::columnName($keyMonth+2).$rowNum)
                                    ->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                                    $objPHPExcel->getActiveSheet()
                                                    ->getStyle(MyFunctionCustom::columnName($index).($rowNum).':'.MyFunctionCustom::columnName($index+$keyMonth+2).($rowNum))
                                                    ->getFont()
                                                    ->setBold(true);								
                                    $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($keyMonth+3).$rowNum, 'Grand Total');
                                    $keyMonth++;
                            }
                            $rowNum++;
                            // end render heaer of one agent
                            $cellBeginAgent=MyFunctionCustom::columnName($index+2).$rowNum;
                            $cellBeginMergeAgent=MyFunctionCustom::columnName($index).$rowNum;
                            $cellBeginBorderAgent=MyFunctionCustom::columnName($index).($rowNum-1);

                                foreach($dataAgent as $agent_id=>$obj_agent){
                                    if(in_array($agent_id, $dataExportRevenue[$year][$material_id]['arrAgentId'])){
                                        $keyMonth=1;
                                        $sumRow = 0;
                                        if($key_agent_id==0){
                                            $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($index).$rowNum, $dataAllMaterial[$material_id]->name);
                                        }
                                        $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($index+1).$rowNum, $obj_agent->first_name);

                                        foreach($dataExportRevenue[$year][$material_id]['month'] as $month){
                                            $Revenue = isset($dataExportRevenue[$year][$material_id]['month_obj'][$month][$agent_id])?$dataExportRevenue[$year][$material_id]['month_obj'][$month][$agent_id]:0;
                                            $PriceRoot = isset($dataExportPriceRoot[$year][$material_id]['month_obj'][$month][$agent_id])?$dataExportPriceRoot[$year][$material_id]['month_obj'][$month][$agent_id]:0;
                                            $cellValue = $Revenue-$PriceRoot;

                                            $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($keyMonth+2).$rowNum, 
                                                    $cellValue); 
                                            $sumRow+=$cellValue;
                                            if(isset($sumCol[$month]))
                                                    $sumCol[$month]+=$cellValue;
                                            else
                                                    $sumCol[$month]=$cellValue;

//                                                    $objPHPExcel->getActiveSheet()
//                                                            ->getStyle(MyFunctionCustom::columnName($index).($rowNum).':'.MyFunctionCustom::columnName($index+$keyMonth+2).($rowNum))
//                                                            ->getFont()
//                                                            ->setBold(true);										
                                            $keyMonth++;
                                        } // end  foreach($dataExportRevenue[$year][$itemAgent->id] as $aMonth){
                                        $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($keyMonth+2).$rowNum, $sumRow);
                                        $rowNum++;
                                        $key_agent_id++;
                                    } // end if in_array()
                                } // end foreach($dataExportRevenue[$year][$agent_id]['arrMaterialId'] as $keyMaterial=>$material_id){	

                                $objPHPExcel->getActiveSheet()
                                    ->mergeCells($cellBeginMergeAgent.':'.MyFunctionCustom::columnName($index).($rowNum-1));
                                $objPHPExcel->getActiveSheet()->getStyle($cellBeginMergeAgent.':'.MyFunctionCustom::columnName($index).($rowNum))
                                    ->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);


                            // total col
                            $keyMonth=1;
                            $sumOneMaterial=0;
                            $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($keyMonth).$rowNum,  'Grand Total');
                            foreach($dataExportRevenue[$year][$material_id]['month'] as $month){
                                    if(isset($sumCol[$month])){
                                            $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($keyMonth+2).$rowNum, $sumCol[$month]);
                                            $sumOneMaterial+=$sumCol[$month];	
                                    }
                                    $objPHPExcel->getActiveSheet()
                                                    ->getStyle(MyFunctionCustom::columnName($index).($rowNum).':'.MyFunctionCustom::columnName($index+$keyMonth+2).($rowNum))
                                                    ->getFont()
                                                    ->setBold(true);											
                                    $keyMonth++;
                            }
                            $objPHPExcel->getActiveSheet()->setCellValue(MyFunctionCustom::columnName($keyMonth+2).$rowNum, $sumOneMaterial);

                            // end total col
                             $objPHPExcel->getActiveSheet()
                                    ->getStyle($cellBeginAgent.':'.MyFunctionCustom::columnName($keyMonth+2).$rowNum)->getNumberFormat()
                                    ->setFormatCode('#,##0'); 


                            $objPHPExcel->getActiveSheet()->getStyle($cellBeginBorderAgent.':'.MyFunctionCustom::columnName($keyMonth+2).$rowNum )
                                    ->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);								

                            $rowNum++;	
                        }
                    $key_agent_id++;

                } // end foreach($dataAgent as $kAgent=>$itemAgent){



             $i++;   // for createSheet(
            } // ********** end for 1 sheet for($i=0;$i<count($model->costs_month);$i++){
        }    

         //save file 
         $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
         //$objWriter->save('MyExcel.xslx');

         for($level=ob_get_level();$level>0;--$level)
         {
                 @ob_end_clean();
         }
         header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
         header('Pragma: public');
         header('Content-type: '.'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
         header('Content-Disposition: attachment; filename="'.'Report Product Gross Profit-'.date('d-m-Y').'.'.'xlsx'.'"');
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