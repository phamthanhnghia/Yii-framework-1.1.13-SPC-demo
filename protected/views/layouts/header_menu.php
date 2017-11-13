<?php // xử lý cho 2 category sau, không có cấu trúc giống category thường của product
// 1. Chăm Sóc Da Và Sức Khỏe Từ Bên Trong * 2. Đặc Trị Cực Kỳ Cao Cấp - MPRO
    $mProduct = new MuradProduct();
    $needMore = array(MuradCategory::CAT_CS_DA_BEN_TRONG, MuradCategory::CAT_DAC_TRI_CAO_CAP);
    $aProductByCat = $mProduct->getListFe($needMore);
?>

<li><a href="javascript:void(0)">Giải Pháp Cho Da Bạn</a>
    <div class="submenu clearfix">
        <?php $aTypeCat = MuradCategory::model()->getArrayType(); 
            $aCategoryProduct = MuradCategory::model()->formatCatByType();
            $session = Yii::app()->session;
            $session['HOME_ARR_TYPE_CAT'] = $aTypeCat;
            $session['HOME_CAT_PRODUCT'] = $aCategoryProduct;
        ?>
        <?php foreach ($aTypeCat as $type => $type_name): ?>
            <div class="cols-1">
                <h3><?php echo $type_name; ?></h3>
                <ul class="menusub">
                    <?php foreach ($aCategoryProduct[$type] as $modelCat): ?>
                    <li><a href="<?php echo $modelCat->getUrlListProduct();?>"><?php echo $modelCat->getName(); ?></a></li>
                    <?php endforeach; ?>
                </ul>
                
                <?php if($type == MuradCategory::TYPE_DA_KHAC): ?>
                    <?php foreach (MuradCategory::$ARR_CAT_DIFF as $category_id=>$name): ?>
                        <?php if($category_id != MuradCategory::CAT_DAC_TRI_CAO_CAP) continue; ?>
                            <h3><?php echo $name;?></h3>
                            <ul class="menusub">
                                <?php foreach ($aProductByCat[$category_id] as $modelProduct): ?>
                                <li><a href="<?php echo $modelProduct->getUrlProductDetail();?>"><?php echo $modelProduct->getNameViShow(); ?></a></li>
                                <?php endforeach; ?>
                            </ul>
                    <?php endforeach; ?>
                <?php endif; ?>
                
            </div>
        <?php endforeach; ?>
        
        
        <?php foreach (MuradCategory::$ARR_CAT_DIFF as $category_id=>$name): ?>
            <?php if($category_id == MuradCategory::CAT_DAC_TRI_CAO_CAP) continue; ?>
            <div class="cols-1">
                <h3><?php echo $name;?></h3>
                <ul class="menusub">
                    <?php foreach ($aProductByCat[$category_id] as $modelProduct): ?>
                    <li><a href="<?php echo $modelProduct->getUrlProductDetail();?>"><?php echo $modelProduct->getNameViShow(); ?></a></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endforeach; ?>
        
        <?php 
//            $mProduct = new MuradProduct();
//            $aProductType = $mProduct->getArrayType();
        ?>
<!--        <div class="cols-1">
            <h3>TV OFFERS</h3>
            <ul class="menusub">
                <?php // foreach ($aProductType as $typeId=>$typeName): ?>
                    <li><a href="<?php // echo $mProduct->getUrlType($typeId);?>"><?php // echo $typeName; ?></a></li>
                <?php // endforeach; ?>
            </ul>
        </div>-->

<!--                        <div class="cols-2">
                <a href="#"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/img/nav-eye-lift.jpg" alt=""/></a> 
        </div>-->
    </div>
</li>


<li><a href="<?php echo Yii::app()->createAbsoluteUrl("product/list")?>">Sản phẩm</a>
    <div class="submenu clearfix">
        <?php 
            $mProduct = new MuradProduct();
            $aProductType = $mProduct->getArrayType();
            $mProductRandom = MuradProduct::getRandomProduct();
        ?>
        <div class="cols-1-ad-fix">
            <h3>Danh mục</h3>
            <ul class="menusub">
                <?php foreach ($mProduct->getArrayTypeFe1() as $typeId=>$typeName): ?>
                    <li><a href="<?php echo $mProduct->getUrlType($typeId);?>"><?php echo $typeName; ?></a></li>
                <?php endforeach; ?>
            </ul>
            
        </div>
        <div class="cols-1-ad-fix">
            <h3>&nbsp;</h3>
            <ul class="menusub">
                <?php foreach ($mProduct->getArrayTypeFe2() as $typeId=>$typeName): ?>
                    <li><a href="<?php echo $mProduct->getUrlType($typeId);?>"><?php echo $typeName; ?></a></li>
                <?php endforeach; ?>
            </ul>
        </div>
        <div class="cols-1-ad-fix">
            <h3>&nbsp;</h3>
            <ul class="menusub">
                <?php foreach ($mProduct->getArrayTypeFe3() as $typeId=>$typeName): ?>
                    <li><a href="<?php echo $mProduct->getUrlType($typeId);?>"><?php echo $typeName; ?></a></li>
                <?php endforeach; ?>
            </ul>
        </div>
        
        <div class="cols-2 item_c" style="border-left: 1px solid #999;">
            <a href="#">
                <?php // $this->widget('ProductItem', array('data'=>$mProductRandom)); ?>
                <img src="<?php echo $mProductRandom->getUrlImageDefault('size1'); ?>" alt=""/>
                <p class="item_b item_c"><?php echo $mProductRandom->getName(); ?></p>
            </a> 
        </div>
    </div>
</li>