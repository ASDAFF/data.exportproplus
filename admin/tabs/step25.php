<?php
IncludeModuleLangFile(__FILE__);

if( $arProfile["USE_IBLOCK_CATEGORY"] == "Y" ){
    $categories = $iblocks;
}
elseif( $arProfile["USE_IBLOCK_PRODUCT_CATEGORY"] == "Y" ){
    $categories = $productIbCategories;
}

if( ( $arProfile["TYPE"] == "vk_trade" ) && !empty( $categories ) ){
    $bUseAlbumsMulticategories = $arProfile["VK"]["VK_IS_ALBUMS_MULTICATEGORIES"] == "Y" ? 'checked="checked"' : "";
}

$bEmptyPhotoAlbums = false;
if( empty( $arProfile["VK"]["VK_ALBUMS"] ) ){
    $bEmptyPhotoAlbums = true;
}
?>

<tr>
    <td width="50%">
        <span id="hint_PROFILE[VK][VK_IS_ALBUMS_MULTICATEGORIES]"></span><script type="text/javascript">BX.hint_replace( BX( 'hint_PROFILE[VK][VK_IS_ALBUMS_MULTICATEGORIES]' ), '<?=GetMessage( "DATA_EXPORTPROPLUS_VK_IS_ALBUMS_MULTICATEGORIES_HELP" )?>' );</script>
        <label for="PROFILE[VK][VK_IS_ALBUMS_MULTICATEGORIES]"><?=GetMessage( "DATA_EXPORTPROPLUS_VK_IS_ALBUMS_MULTICATEGORIES" );?></label>
    </td>
    <td><input type="checkbox" name="PROFILE[VK][VK_IS_ALBUMS_MULTICATEGORIES]" value="Y" <?=$bUseAlbumsMulticategories?> ></td>
</tr>
<tr align="center">
    <td colspan="2">
        <?=BeginNote();?>
        <?=GetMessage( "DATA_EXPORTPROPLUS_VK_ALBUMS_DESCRIPTION" )?>
        <?=EndNote();?>
    </td>
</tr>
<?if( ( $arProfile["TYPE"] == "vk_trade" ) && !empty( $categories ) ){?>
    <tr>
        <td colspan="2" id="market_albums_vk">
            <table width="100%">
                <?foreach( $categories as $cat ){
                    $arPartCategory = explode( " / ", $cat["NAME"] );
                    $arPostCategory = explode( " [", $arPartCategory[count( $arPartCategory ) - 1] );

                    $rowValue = "";
                    if( $bEmptyPhotoAlbums ){
                        $rowValue = trim( $arPostCategory[0] );
                    }
                    else{
                        $rowValue = $arProfile["VK"]["VK_ALBUMS"][$cat["ID"]];
                        $rowValueCharset = CDataExportproplusTools::GetStringCharset( $rowValue );
                        $rowValue = htmlspecialchars( $rowValue, ENT_COMPAT, $rowValueCharset );
                    }?>
                    <tr>
                        <td width="40%">
                            <label form="PROFILE[VK][VK_ALBUMS][<?=$cat["ID"]?>]"><?=$cat["NAME"]?></label>
                        </td>
                        <td width="60%">
                            <input type="text" value="<?=$rowValue?>" name="PROFILE[VK][VK_ALBUMS][<?=$cat["ID"]?>]" style="width: 100%; opacity: 1"/>
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
        <span id="hint_DATA_EXPORTPROPLUS_VK_ALBUMS_DELETE"></span><script type="text/javascript">BX.hint_replace( BX( 'hint_DATA_EXPORTPROPLUS_VK_ALBUMS_DELETE' ), '<?=GetMessage( "DATA_EXPORTPROPLUS_VK_ALBUMS_DELETE_HELP" )?>' );</script>
        <label for="VK_ALBUMS_DELETE"><b><?=GetMessage( "DATA_EXPORTPROPLUS_VK_ALBUMS_DELETE" )?></b> </label>
    </td>
    <td width="50%" class="adm-detail-content-cell-r">
        <a class="adm-btn adm-btn-save" onclick="if( confirm( '<?=GetMessage( "DATA_EXPORTPROPLUS_PROFILE_DELETE_PHOTO_ALBUMS_CONFIRM" )?>' ) ){ VkDeleteSyncAlbums( '<?=$arProfile["ID"];?>' ) }"><?=GetMessage( "DATA_EXPORTPROPLUS_VK_ALBUMS_DELETE_BUTTON" )?></a>
    </td>
</tr>
<tr>
    <td width="50%" class="adm-detail-content-cell-l">
        <span id="hint_DATA_EXPORTPROPLUS_VK_ALBUMS_DELETE_FORCE"></span><script type="text/javascript">BX.hint_replace( BX( 'hint_DATA_EXPORTPROPLUS_VK_ALBUMS_DELETE_FORCE' ), '<?=GetMessage( "DATA_EXPORTPROPLUS_VK_ALBUMS_DELETE_FORCE_HELP" )?>' );</script>
        <label for="VK_ALBUMS_DELETE_FORCE"><b><?=GetMessage( "DATA_EXPORTPROPLUS_VK_ALBUMS_DELETE_FORCE" )?></b> </label>
    </td>
    <td width="50%" class="adm-detail-content-cell-r">
        &nbsp;<a class="adm-btn adm-btn-red" onclick="if( confirm( '<?=GetMessage( "DATA_EXPORTPROPLUS_PROFILE_DELETEALL_PHOTO_ALBUMS_CONFIRM" )?>' ) ){ VkDeleteAllAlbums( '<?=$arProfile["ID"];?>' ) }"><?=GetMessage( "DATA_EXPORTPROPLUS_VK_ALBUMS_DELETE_BUTTON" )?></a>
    </td>
</tr>