<?php
    // lấy data thống kê sản lượng 
    $DATA_STATISTIC = Sta2::GetOutputOneCustomer( $data['customer_id'],  $data['month_statistic']);
?>
<?php if(isset($DATA_STATISTIC['YEAR_MONTH'])) :?>

<?php
    $YEAR_MONTH = $DATA_STATISTIC['YEAR_MONTH'];
    $OUTPUT = $DATA_STATISTIC['OUTPUT'];
    $GAS_REMAIN= isset($DATA_STATISTIC['GAS_REMAIN'])?$DATA_STATISTIC['GAS_REMAIN']:array();
    $TotalOutput = 0; // Now 27, 2015 để tính toán sản lượng bình quân cho KH
    $TotalMonth = 0;
    $cMonth = date('m');
?>
<style>
    .support_statistic_ouput { margin-bottom: 20px;}
    table.detail-view tr.odd {
        background: #E5F1F4;
    }
</style>
<div class="support_statistic_ouput">
    <table class="hm_table detail-view" style="width:auto;">
        <thead>
            <tr class="odd">
                <th class="item_c">Tháng</th>
                <?php foreach( $YEAR_MONTH as $year=>$aMonth):?>
                    <?php foreach( $aMonth as $month => $not_use_value):?>
                    <th class="w-50 item_c"><?php echo $month."/$year";?></th>
                    <?php endforeach; ?>
                <?php endforeach; ?>
            </tr>
        </thead>
        <tbody>
            <!--begin Bình Bò -->
            <tr class="even">
                <td class="item_b">Bình Bò (Kg)</td>
                <?php foreach( $YEAR_MONTH as $year=>$aMonth):?>
                    <?php foreach( $aMonth as $month => $not_use_value):?>
                    <?php
                        $qty_b50 = isset($OUTPUT[MATERIAL_TYPE_BINHBO_50][$year][$month])?$OUTPUT[MATERIAL_TYPE_BINHBO_50][$year][$month]:0;
                        $qty_b45 = isset($OUTPUT[MATERIAL_TYPE_BINHBO_45][$year][$month])?$OUTPUT[MATERIAL_TYPE_BINHBO_45][$year][$month]:0;
                        $amount_50 = $qty_b50*CmsFormatter::$MATERIAL_VALUE_KG[MATERIAL_TYPE_BINHBO_50];
                        $amount_45 = $qty_b45*CmsFormatter::$MATERIAL_VALUE_KG[MATERIAL_TYPE_BINHBO_45];
                        $remain = isset($GAS_REMAIN[$year][$month])?$GAS_REMAIN[$year][$month]:0;
                        $output_real = ($amount_50 + $amount_45 - $remain);
                        if($cMonth != $month ){ // không tính tháng hiện tại
                            $TotalMonth++;
                            $TotalOutput += $output_real;
                        }
                        
                    ?>
                    <td class="item_r"><?php echo ($output_real!=0)?ActiveRecord::formatCurrency($output_real):""; ?></td>
                    <?php endforeach; ?>
                <?php endforeach; ?>
            </tr>
            <!--end Bình Bò -->
            <!--begin Bình 12 -->
            <tr class="odd">
                <td class="item_b">Bình 12 (Kg)</td>
                <?php foreach( $YEAR_MONTH as $year=>$aMonth):?>
                    <?php foreach( $aMonth as $month => $not_use_value):?>
                    <?php
                        $qty_b12 = isset($OUTPUT[MATERIAL_TYPE_BINH_12][$year][$month])?$OUTPUT[MATERIAL_TYPE_BINH_12][$year][$month]:0;
                        $amount_12 = $qty_b12*CmsFormatter::$MATERIAL_VALUE_KG[MATERIAL_TYPE_BINH_12];
                        if($cMonth != $month ){ // không tính tháng hiện tại
                            $TotalOutput += $amount_12;
                        }
                    ?>
                    <td class="item_r"><?php echo ($amount_12!=0)?ActiveRecord::formatCurrency($amount_12):""; ?></td>
                    <?php endforeach; ?>
                <?php endforeach; ?>
            </tr>
            <!--end Bình 12 -->
            
        </tbody>
    </table>
    <?php 
        if($TotalMonth>1){// NOW 27, 2015 tính sản lượng bình quân của KH theo tháng
            $AVERAGE_OUTPUT_CUSTOMER = round($TotalOutput/$TotalMonth);
            $session=Yii::app()->session;
            $session['AVERAGE_OUTPUT_CUSTOMER'] = $AVERAGE_OUTPUT_CUSTOMER;
        }
    ?>
</div><!-- form -->
<?php else:?>
    Không có dữ liệu
<?php endif;?>
