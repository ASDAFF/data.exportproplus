<?php
IncludeModuleLangFile(__FILE__);

if( $arProfile["USE_IBLOCK_CATEGORY"] == "Y" ){
    $categories = $iblocks;
}
elseif( $arProfile["USE_IBLOCK_PRODUCT_CATEGORY"] == "Y" ){
    $categories = $productIbCategories;
}

if( ( $arProfile["TYPE"] == "vk_trade" ) && !empty( $categories ) ){
    if( intval( $arProfile["ID"] ) > 0 ){
        $obVkTools = new CAcritExportproplusVkTools( $arProfile );
        $marketCategory = $obVkTools->GetTypes();
    }
}
?>

<tr align="center">
    <td colspan="2">
        <?=BeginNote();?>
        <?=GetMessage( "ACRIT_EXPORTPROPLUS_VK_CATEGORY_DESCRIPTION" )?>
        <?=EndNote();?>
    </td>
</tr>
<?if( ( $arProfile["TYPE"] == "vk_trade" ) && !empty( $categories ) ){?>
    <tr>
        <td colspan="2" id="market_category_data_vk">
            <table width="100%">
                <?foreach( $categories as $cat ){?>
                    <tr>
                        <td width="40%">
                            <label form="PROFILE[MARKET_CATEGORY][VK][CATEGORY_LIST][<?=$cat["ID"]?>]"><?=$cat["NAME"]?></label>
                        </td>
                        <td width="60%">
                            <input type="text" readonly="readonly" value="<?=$marketCategory[$arProfile["MARKET_CATEGORY"]["VK"]["CATEGORY_LIST"][$cat["ID"]]]?>" name="PROFILE_MARKET_CATEGORY_CATEGORY_LIST_VK_<?=$cat["ID"]?>_NAME" style="width: 100%; opacity: 1"/>
                            <input type="hidden" value="<?=$arProfile["MARKET_CATEGORY"]["VK"]["CATEGORY_LIST"][$cat["ID"]]?>" name="PROFILE[MARKET_CATEGORY][VK][CATEGORY_LIST][<?=$cat["ID"]?>]" />
                            <span class="field-edit" onclick="ShowMarketCategoryList( <?=$cat["ID"]?>, 'market_category_list_vk' )" style="cursor: pointer; background: #9ec710 !important;" title="<?=GetMessage( "ACRIT_EXPORTPROPLUS_MARKET_CATEGORY_DATA_SELECT_SECTION" );?>"></span>
                        </td>
                    </tr>
                <?}?>
            </table>
            <div id="market_category_list_vk" style="display: none">
                <input onkeyup="FilterMarketCategoryList( this, 'market_category_list_vk' )" placeholder="<?=GetMessage( "ACRIT_EXPORTPROPLUS_MARKET_CATEGORY_DATA_WINDOW_PLACEHOLDER" );?>">
                <select onclick="SetMarketCategoryVk( this.value, this )" size="25">
                    <option></option>
                    <?foreach( $marketCategory as $marketCatIndex => $marketCat ){?>
                        <option value="<?=$marketCatIndex?>" data-search="<?=strtolower( $marketCat )?>"><?=$marketCat?></option>
                    <?}?>
                </select>
            </div>
        </td>
    </tr>
<?}?>