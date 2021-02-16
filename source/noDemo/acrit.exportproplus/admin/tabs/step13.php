<?php
IncludeModuleLangFile(__FILE__);

if( $arProfile["USE_IBLOCK_CATEGORY"] == "Y" ){
    $categories = $iblocks;
}
elseif( $arProfile["USE_IBLOCK_PRODUCT_CATEGORY"] == "Y" ){
    $categories = $productIbCategories;
}

if( ( ( $arProfile["TYPE"] == "ozon" ) || ( $arProfile["TYPE"] == "ozon_api" ) )  && !empty( $categories ) ){
    $ozonAppId = $arProfile["OZON_APPID"];
    $ozonAppKey = $arProfile["OZON_APPKEY"];

    $marketCategory = array();
    if( !empty( $ozonAppId ) && !empty( $ozonAppKey ) ){
        $ozon = new CExportproplusOzon( $ozonAppId, $ozonAppKey );
        $marketCategory = $ozon->GetAllTypes();
    }

    foreach( $marketCategory as $key => $cat ){
        $marketCategory[$cat["ProductTypeId"]] = $cat;
        unset( $marketCategory[$key] );
    }
}
?>

<tr align="center">
    <td colspan="2">
        <?=BeginNote();?>
        <?=GetMessage( "ACRIT_EXPORTPROPLUS_OZON_CATEGORY_DESCRIPTION" )?>
        <?=EndNote();?>
    </td>
</tr>
<tr>
    <td colspan="2" id="market_category_data_ozon">
        <table width="100%">
            <?foreach( $categories as $cat ){
                $bHasDesc = false;
                if( strlen( trim( $marketCategory[$arProfile["MARKET_CATEGORY"]["OZON"]["CATEGORY_LIST"][$cat["ID"]]]["PathName"] ) ) > 0 ){
                    $bHasDesc = true;
                    $catDesc = $ozon->GetDescription( $marketCategory[$arProfile["MARKET_CATEGORY"]["OZON"]["CATEGORY_LIST"][$cat["ID"]]]["ProductTypeId"] );
                    $ozonCatLocalServerPath = $_SERVER["DOCUMENT_ROOT"]."/upload/acrit.exportproplus/ozon_api_cat_".$marketCategory[$arProfile["MARKET_CATEGORY"]["OZON"]["CATEGORY_LIST"][$cat["ID"]]]["ProductTypeId"].".xsd";
                    $ozonCatLocalPath = "/upload/acrit.exportproplus/ozon_api_cat_".$marketCategory[$arProfile["MARKET_CATEGORY"]["OZON"]["CATEGORY_LIST"][$cat["ID"]]]["ProductTypeId"].".xsd";
                    file_put_contents( $ozonCatLocalServerPath, $catDesc );
                }?>
                <tr>
                    <td width="40%">
                        <label form="PROFILE[MARKET_CATEGORY][OZON][CATEGORY_LIST][<?=$cat["ID"]?>]"><?=$cat["NAME"]?></label>
                        <?if( $bHasDesc ){?>
                            <span id="hint_PROFILE[CAT_<?=$cat["ID"]?>_DESC]"></span><script type="text/javascript">BX.hint_replace( BX( 'hint_PROFILE[CAT_<?=$cat["ID"]?>_DESC]' ), '<a href="<?=$ozonCatLocalPath?>" target="_blank"><?=GetMessage( "ACRIT_EXPORTPROPLUS_OZON_CAT_DESC_HELP" )?></a>' );</script>
                        <?}?>
                    </td>
                    <td width="60%">
                        <input type="text" readonly="readonly" value="<?=$marketCategory[$arProfile["MARKET_CATEGORY"]["OZON"]["CATEGORY_LIST"][$cat["ID"]]]["PathName"]?>" name="PROFILE_MARKET_CATEGORY_CATEGORY_LIST_OZON_<?=$cat["ID"]?>_NAME" style="width: 100%; opacity: 1"/>
                        <input type="hidden" value="<?=$arProfile["MARKET_CATEGORY"]["OZON"]["CATEGORY_LIST"][$cat["ID"]]?>" name="PROFILE[MARKET_CATEGORY][OZON][CATEGORY_LIST][<?=$cat["ID"]?>]" />
                        <span class="field-edit" onclick="ShowMarketCategoryList( <?=$cat["ID"]?>, 'market_category_list_ozon' )" style="cursor: pointer; background: #9ec710 !important;" title="<?=GetMessage( "ACRIT_EXPORTPROPLUS_MARKET_CATEGORY_DATA_SELECT_SECTION" );?>"></span>
                    </td>
                </tr>
            <?}?>
        </table>
        <div id="market_category_list_ozon" style="display: none">
            <?$sortetMarketCategory = array();
            if( CAcritExportproplusTools::ArrayValidate( $marketCategory ) ){
                foreach( $marketCategory as $marketCat ){
                    $sortetMarketCategory[$marketCat["PathName"]] = $marketCat;
                }
            }

            $marketCategory = $sortetMarketCategory;
            unset( $sortetMarketCategory );
            ksort( $marketCategory );?>
            <input onkeyup="FilterMarketCategoryList( this, 'market_category_list_ozon' )" placeholder="<?=GetMessage( "ACRIT_EXPORTPROPLUS_MARKET_CATEGORY_DATA_WINDOW_PLACEHOLDER" );?>">
            <select onclick="SetMarketCategoryOzon( this.value, this )" size="25">
                <option></option>
                <?foreach( $marketCategory as $marketCat ){?>
                    <option value="<?=$marketCat["ProductTypeId"]?>" data-search="<?=strtolower( $marketCat["PathName"] )?>"><?=$marketCat["PathName"]?></option>
                <?}?>
            </select>
        </div>
    </td>
</tr>
