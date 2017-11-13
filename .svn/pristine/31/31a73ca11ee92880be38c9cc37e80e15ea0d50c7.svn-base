<?php
class GetData
{
    // get unique month at table $name_model
    // dùng để lấy những tháng nào có dữ liệu
      public static function getUniqueMonth($year,$name_model,$name_field_month,$name_field_year){
            $criteria=new CDbCriteria;
            $criteria->compare("t.$name_field_year",$year);
            $criteria->select = "DISTINCT(t.$name_field_month) as $name_field_month";
            $criteria->order = "t.$name_field_month ASC";
            $model_ = call_user_func(array($name_model, 'model'));
            return CHtml::listData($model_->findAll($criteria),$name_field_month,$name_field_month); 
      }
    
      // get unique year at table $name_model
      // dùng để lấy những năm nào có dữ liệu
      public static function getUniqueYear($year,$name_model,$name_field_month,$name_field_year){
            $criteria=new CDbCriteria;
            if(count($year)>0)
                $criteria->addInCondition("t.$name_field_year",$year);
            $criteria->select = "DISTINCT(t.$name_field_year) as $name_field_year";
            $criteria->order = "t.$name_field_year ASC";
            $model_ = call_user_func(array($name_model, 'model'));
            $models = $model_->findAll($criteria);
            $aRes=array();
            if(count($models)>0)
            foreach($models as $key=>$item){
                $aRes[$item->$name_field_year] = GetData::getUniqueMonth($item->$name_field_year,$name_model,$name_field_month,$name_field_year);
            }
            return $aRes;
        }
    
      // get data from table gas_gas_sell_monthly
      // Báo Cáo Tháng Doanh Thu Đại Lý
      // @param Array ( [2013] => Array ( [01] => 01 [02] => 02 [06] => 06 ) )
      public static function getDataAgentRevenueMonth($aYear,$aAgent, $name_field){
          $aExport = array();
            if(count($aYear)>0){
                foreach($aYear as $year=>$aMonth){
                    foreach($aMonth as $month){
                        $criteria=new CDbCriteria;
                        $criteria->compare('t.sell_year',$year);
                        $criteria->compare('t.sell_month',$month);
                        if(count($aAgent)>0)
                            $criteria->addInCondition('t.agent_id',$aAgent);
                        $criteria->select = "agent_id, sum($name_field) as $name_field";
                        $criteria->group = "agent_id";
                        $res = GasMaterialsSell::model()->findAll($criteria);
                        if(count($res)>0)
                        foreach($res as $obj){
                                $aExport[$year][$month*1][$obj->agent_id] = $obj->$name_field;					
                        }                        
                    }
                }
            }
            return $aExport;
        }
		
	 // get data from table gas_gas_costs_monthly
      // Báo Cáo Tháng Chi Phí Đại Lý
      // @param Array ( [2013] => Array ( [01] => 01 [02] => 02 [06] => 06 ) )
      public static function getDataAgentCost($aYear, $aAgent, $name_field){
          $aExport = array();
            if(count($aYear)>0){
                foreach($aYear as $year=>$aMonth){
                    foreach($aMonth as $month){
                        $criteria=new CDbCriteria;
                        $criteria->compare('t.costs_year',$year);
                        $criteria->compare('t.costs_month',$month);
                        if(count($aAgent)>0)
                            $criteria->addInCondition('t.agent_id',$aAgent);
                        $criteria->select = "agent_id, sum($name_field) as $name_field";
                        $criteria->group = "agent_id";
                        $res = GasCostsMonthly::model()->findAll($criteria);
                        if(count($res)>0)
                        foreach($res as $obj){
                                $aExport[$year][$month*1][$obj->agent_id] = $obj->$name_field;					
                        }                        
                    }
                }
            }
            return $aExport;
        }		
	
	// get data from table gas_gas_costs_monthly
      // Báo Cáo Tháng Chi Phí tổng cộng theo tháng
      // @param Array ( [2013] => Array ( [01] => 01 [02] => 02 [06] => 06 ) )
      public static function getDataCostSumTotal($aYear, $model,  $name_field){
          $aExport = array();
            if(count($aYear)>0){
                foreach($aYear as $year=>$aMonth){
                    foreach($aMonth as $month){
                        $criteria=new CDbCriteria;
                        $criteria->compare('t.costs_year',$year);
                        $criteria->compare('t.costs_month',$month);
                        $criteria->select = "costs_id, sum($name_field) as $name_field";
                        $criteria->group = "costs_id";
                        $res = GasCostsMonthly::model()->findAll($criteria);
                        if(count($res)>0)
                        foreach($res as $obj){
                                $aExport[$year][$month*1][$obj->costs_id] = $obj->$name_field;					
                        }                        
                    }
                }
            }
            return $aExport;
        }		
		
	  // get data from table gas_gas_sell_monthly
      // Xuất Báo Cáo  Doanh Thu Đại Lý Theo Sản Phẩm
      // @param Array ( [2013] => Array ( [01] => 01 [02] => 02 [06] => 06 ) )
      public static function getDataAgentRevenueByMaterial($aYear, $aAgent, $name_field){
          $aExport = array();
		  // Lấy Cấp cha của tất cả các loại vật tư: là mảng obj_parent => array id các id cấp con
		  $aMaterial = GasCostsMonthly::getArrObjMaterialForExport();
            if(count($aYear)>0){
                foreach($aYear as $year=>$aMonth){
					if(count($aAgent)>0 && count($aMonth)>0){
						foreach($aAgent as $agent_id){
							$aMaterialUnique = array();
							foreach($aMonth as $month){
								foreach($aMaterial as $key=>$twoArrObjParentAndSub){
										$criteria=new CDbCriteria;
										$criteria->compare('t.sell_year',$year);
										$criteria->compare('t.sell_month',$month);
										$criteria->compare('t.agent_id',$agent_id);
										$criteria->addInCondition('t.materials_id',$twoArrObjParentAndSub['sub_arr_id']);
										//$criteria->select = 'sum(total_sell) as total_sell';
										$criteria->order = "t.materials_id ASC";
										$res = GasMaterialsSell::model()->findAll($criteria);
										$totalParent=0;
										if(count($res)>0){
											foreach($res as $obj){
												$totalParent += $obj->$name_field;														
											}  
											if($totalParent>0){
												$temp = array();
												$temp['parent_total'] = $totalParent;
												$temp['sub_obj'] = $res;
												$aExport[$year][$agent_id]['month_obj'][$month][$twoArrObjParentAndSub['parent_obj']->id] = $temp;											
												$aMaterialUnique[] = $twoArrObjParentAndSub['parent_obj']->id;
											}
										}  
										
								}
							} // end foreach($aMonth as $month){
							
							if(count($aMaterialUnique)>0)
								// dùng để loại những dòng trống ko dữ liệu
								$aExport[$year][$agent_id]['arrMaterialId'] = array_unique($aMaterialUnique);
							$aExport[$year][$agent_id]['month']	= $aMonth;

						} // end foreach($aAgent as $agent_id){
					}					
					
                }
            }

            return $aExport;
        }
        
      // get data from table gas_gas_sell_monthly
      // Xuất Báo Cáo  Doanh Thu Sản Phẩm
      // @param Array ( [2013] => Array ( [01] => 01 [02] => 02 [06] => 06 ) )
      public static function getDataRevenueMaterialByAgent($aYear, $model, $name_field){
          $aMaterialSelect = $model->materials_id;
          $aExport = array();
            // Lấy Cấp cha của tất cả các loại vật tư: là mảng obj_parent => array id các id cấp con
            $aMaterial = GasCostsMonthly::getArrObjMaterialForExportV1();
            if(count($aYear)>0){
                foreach($aYear as $year=>$aMonth){
                    if(count($aMonth)>0){
                            foreach($aMaterialSelect as $material_id){
                                    $aAgentUnique = array();
                                    foreach($aMonth as $month){
//                                            foreach($aMaterial as $key=>$twoArrObjParentAndSub){
                                        $criteria=new CDbCriteria;
                                        $criteria->compare('t.sell_year',$year);
                                        $criteria->compare('t.sell_month',$month);
                                        if(count($aMaterial[$material_id])>0)
                                            $criteria->addInCondition('t.materials_id',$aMaterial[$material_id]);
                                        if($model->materials_sub_id)
                                            $criteria->compare('t.materials_id', $model->materials_sub_id);
                                        $criteria->select = "agent_id, sum($name_field) as $name_field";
                                        $criteria->group = 'agent_id';
//                                        $criteria->order = "t.agent_id ASC";
                                        $res = GasMaterialsSell::model()->findAll($criteria);
                                        if(count($res)>0){
                                                foreach($res as $obj){
                                                    if($obj->$name_field>0){
                                                        $aExport[$year][$material_id]['month_obj'][$month][$obj->agent_id] = $obj->$name_field;											
                                                        $aAgentUnique[] = $obj->agent_id;
                                                    }
                                                }  
                                        }  

//                                            } // end foreach($aMaterial as $key=>$twoArrObjParentAndSub
                                    } // end foreach($aMonth as $month){

                                    if(count($aAgentUnique)>0)
                                            // dùng để loại những dòng trống ko dữ liệu
                                            $aExport[$year][$material_id]['arrAgentId'] = $aAgentUnique;
                                    else
                                        $aExport[$year][$material_id]['arrAgentId'] = array();
                                    $aExport[$year][$material_id]['month']	= $aMonth;

                            } // end foreach($aAgent as $agent_id){
                    }					
					
                }
            }

            return $aExport;
        }
		
	  // get data from table GasCostsMonthly
      // Xuất Báo Cáo  Chi Phí cho từng đại lý
      // @param Array ( [2013] => Array ( [01] => 01 [02] => 02 [06] => 06 ) )
      public static function getDataAgentByCosts2($aYear, $model, $name_field){
		 $aAgent = $model->agent_id;
          $aExport = array();
            if(count($aYear)>0){
                foreach($aYear as $year=>$aMonth){
					if(count($aAgent)>0 && count($aMonth)>0){
						foreach($aAgent as $agent_id){
							foreach($aMonth as $month){
								$criteria=new CDbCriteria;
								$criteria->compare('t.costs_year',$year);
								$criteria->compare('t.costs_month',$month);
								$criteria->compare('t.agent_id',$agent_id);
								//$criteria->order = "t.costs_id ASC";
								$res = GasCostsMonthly::model()->findAll($criteria);										
								if(count($res)>0){
									foreach($res as $obj){
										$aExport[$year][$agent_id][$month][$obj->costs_id] = $obj->$name_field;											
									}  
								}  
							} // end foreach($aMonth as $month){
							
							$aExport[$year][$agent_id]['month']	= $aMonth;

						} // end foreach($aAgent as $agent_id){
					}					
					
                }
            }
            return $aExport;
        }		
		
	  // get data from table GasCostsMonthly
      // Xuất Báo Cáo  Chi Phí  đại lý theo từng chi phí
      // @param Array ( [2013] => Array ( [01] => 01 [02] => 02 [06] => 06 ) )
      public static function getDataAgentByCosts3($aYear, $model, $name_field){
		 $aCosts = $model->costs_id;
          $aExport = array();
            if(count($aYear)>0){
                foreach($aYear as $year=>$aMonth){
					if(count($aCosts)>0 && count($aMonth)>0){
						foreach($aCosts as $cost_id){
							foreach($aMonth as $month){
								$criteria=new CDbCriteria;
								$criteria->compare('t.costs_year',$year);
								$criteria->compare('t.costs_month',$month);
								$criteria->compare('t.costs_id',$cost_id);
								//$criteria->order = "t.costs_id ASC";
								$res = GasCostsMonthly::model()->findAll($criteria);										
								if(count($res)>0){
									foreach($res as $obj){
										$aExport[$year][$cost_id][$month][$obj->agent_id] = $obj->$name_field;											
									}  
								}  
							} // end foreach($aMonth as $month){
							
							$aExport[$year][$cost_id]['month']	= $aMonth;

						} // end foreach($aCosts as $agent_id){
					}					
					
                }
            }
            return $aExport;
        }		
    
}
?>