<?php
IncludeModuleLangFile(__FILE__);

if( $arProfile["USE_IBLOCK_CATEGORY"] == "Y" ){
    $categories = $iblocks;
}
elseif( $arProfile["USE_IBLOCK_PRODUCT_CATEGORY"] == "Y" ){
    $categories = $productIbCategories;
}

if( ( $arProfile["TYPE"] == "ok_trade" ) && !empty( $categories ) ){
    $bUseCatalogsMulticategories = $arProfile["OK"]["OK_IS_CATALOGS_MULTICATEGORIES"] == "Y" ? 'checked="checked"' : "";
}

$bEmptyCatalogs = false;
if( empty( $arProfile["OK"]["OK_CATALOGS"] ) ){
    $bEmptyCatalogs = true;
}
?>

<tr>
    <td width="50%">
        <span id="hint_PROFILE[OK][OK_IS_CATALOGS_MULTICATEGORIES]"></span><script type="text/javascript">BX.hint_replace( BX( 'hint_PROFILE[OK][OK_IS_CATALOGS_MULTICATEGORIES]' ), '<?=GetMessage( "ACRIT_EXPORTPROPLUS_OK_IS_CATALOGS_MULTICATEGORIES_HELP" )?>' );</script>
        <label for="PROFILE[OK][OK_IS_CATALOGS_MULTICATEGORIES]"><?=GetMessage( "ACRIT_EXPORTPROPLUS_OK_IS_CATALOGS_MULTICATEGORIES" );?></label>
    </td>
    <td><input type="checkbox" name="PROFILE[OK][OK_IS_CATALOGS_MULTICATEGORIES]" value="Y" <?=$bUseCatalogsMulticategories?> ></td>
</tr>
<tr align="center">
    <td colspan="2">
        <?=BeginNote();?>
        <?=GetMessage( "ACRIT_EXPORTPROPLUS_OK_CATALOGS_DESCRIPTION" )?>
        <?=EndNote();?>
    </td>
</tr>
<?if( ( $arProfile["TYPE"] == "ok_trade" ) && !empty( $categories ) ){?>
    <tr>
        <td colspan="2" id="market_catalogs_ok">
            <table width="100%">
                <?foreach( $categories as $cat ){
                    $arPartCategory = explode( " / ", $cat["NAME"] );
                    $arPostCategory = explode( " [", $arPartCategory[count( $arPartCategory ) - 1] );

                    $rowValue = "";
                    if( $bEmptyCatalogs ){
                        $rowValue = trim( $arPostCategory[0] );
                    }
                    else{
                        $rowValue = $arProfile["OK"]["OK_CATALOGS"][$cat["ID"]];
                        $rowValueCharset = CAcritExportproplusTools::GetStringCharset( $rowValue );
                        $rowValue = htmlspecialchars( $rowValue, ENT_COMPAT, $rowValueCharset );
                    }?>
                    <tr>
                        <td width="40%">
                            <label form="PROFILE[OK][OK_CATALOGS][<?=$cat["ID"]?>]"><?=$cat["NAME"]?></label>
                        </td>
                        <td width="60%">
                            <input type="text" value="<?=$rowValue?>" name="PROFILE[OK][OK_CATALOGS][<?=$cat["ID"]?>]" style="width: 100%; opacity: 1"/>
                        </td>
                    </tr>
                <?}?>
            </table>
        </td>
    </tr>
<?}?>

<tr>
    <td colspan="2"><br/></td>
</tr>
<tr>
    <td width="50%" class="adm-detail-content-cell-l">
        <span id="hint_ACRIT_EXPORTPROPLUS_OK_CATALOGS_DELETE"></span><script type="text/javascript">BX.hint_replace( BX( 'hint_ACRIT_EXPORTPROPLUS_OK_CATALOGS_DELETE' ), '<?=GetMessage( "ACRIT_EXPORTPROPLUS_OK_CATALOGS_DELETE_HELP" )?>' );</script>
        <label for="OK_CATALOGS_DELETE"><b><?=GetMessage( "ACRIT_EXPORTPROPLUS_OK_CATALOGS_DELETE" )?></b> </label>
    </td>
    <td width="50%" class="adm-detail-content-cell-r">
        <a class="adm-btn adm-btn-save" onclick="if( confirm( '<?=GetMessage( "ACRIT_EXPORTPROPLUS_PROFILE_DELETE_CATALOGS_CONFIRM" )?>' ) ){ OkDeleteSyncCatalogs( '<?=$arProfile["ID"];?>' ) }"><?=GetMessage( "ACRIT_EXPORTPROPLUS_OK_CATALOGS_DELETE_BUTTON" )?></a>
    </td>
</tr>
<tr>
    <td width="50%" class="adm-detail-content-cell-l">
        <span id="hint_ACRIT_EXPORTPROPLUS_OK_CATALOGS_DELETE_FORCE"></span><script type="text/javascript">BX.hint_replace( BX( 'hint_ACRIT_EXPORTPROPLUS_OK_CATALOGS_DELETE_FORCE' ), '<?=GetMessage( "ACRIT_EXPORTPROPLUS_OK_CATALOGS_DELETE_FORCE_HELP" )?>' );</script>
        <label for="OK_CATALOGS_DELETE_FORCE"><b><?=GetMessage( "ACRIT_EXPORTPROPLUS_OK_CATALOGS_DELETE_FORCE" )?></b> </label>
    </td>
    <td width="50%" class="adm-detail-content-cell-r">
        &nbsp;<a class="adm-btn adm-btn-red" onclick="if( confirm( '<?=GetMessage( "ACRIT_EXPORTPROPLUS_PROFILE_DELETEALL_CATALOGS_CONFIRM" )?>' ) ){ OkDeleteAllCatalogs( '<?=$arProfile["ID"];?>' ) }"><?=GetMessage( "ACRIT_EXPORTPROPLUS_OK_CATALOGS_DELETE_BUTTON" )?></a>
    </td>
</tr>
<tr>
    <td colspan="2"><br/></td>
</tr>
<tr>
    <td width="50%" class="adm-detail-content-cell-l">
        <span id="hint_ACRIT_EXPORTPROPLUS_OK_MARKET_ITEMS_DELETE"></span><script type="text/javascript">BX.hint_replace( BX( 'hint_ACRIT_EXPORTPROPLUS_OK_MARKET_ITEMS_DELETE' ), '<?=GetMessage( "ACRIT_EXPORTPROPLUS_OK_MARKET_ITEMS_DELETE_HELP" )?>' );</script>
        <label for="OK_MARKET_ITEMS_DELETE"><b><?=GetMessage( "ACRIT_EXPORTPROPLUS_OK_MARKET_ITEMS_DELETE" )?></b> </label>
    </td>
    <td width="50%" class="adm-detail-content-cell-r">
        <a class="adm-btn adm-btn-save" onclick="if( confirm( '<?=GetMessage( "ACRIT_EXPORTPROPLUS_PROFILE_DELETE_MARKET_ITEMS_CONFIRM" )?>' ) ){ OkDeleteSyncMarketItems( '<?=$arProfile["ID"];?>' ) }"><?=GetMessage( "ACRIT_EXPORTPROPLUS_OK_MARKET_ITEMS_DELETE_BUTTON" )?></a>
    </td>
</tr>
<tr>
    <td width="50%" class="adm-detail-content-cell-l">
        <span id="hint_ACRIT_EXPORTPROPLUS_OK_MARKET_ITEMS_DELETE_FORCE"></span><script type="text/javascript">BX.hint_replace( BX( 'hint_ACRIT_EXPORTPROPLUS_OK_MARKET_ITEMS_DELETE_FORCE' ), '<?=GetMessage( "ACRIT_EXPORTPROPLUS_OK_MARKET_ITEMS_DELETE_FORCE_HELP" )?>' );</script>
        <label for="OK_MARKET_ITEMS_DELETE_FORCE"><b><?=GetMessage( "ACRIT_EXPORTPROPLUS_OK_MARKET_ITEMS_DELETE_FORCE" )?></b> </label>
    </td>
    <td width="50%" class="adm-detail-content-cell-r">
        &nbsp;<a class="adm-btn adm-btn-red" onclick="if( confirm( '<?=GetMessage( "ACRIT_EXPORTPROPLUS_PROFILE_DELETEALL_MARKET_ITEMS_CONFIRM" )?>' ) ){ OkDeleteAllMarketItems( '<?=$arProfile["ID"];?>' ) }"><?=GetMessage( "ACRIT_EXPORTPROPLUS_OK_MARKET_ITEMS_DELETE_BUTTON" )?></a>
    </td>
</tr>