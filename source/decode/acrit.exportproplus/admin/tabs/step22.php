<?IncludeModuleLangFile( __FILE__ );

$bNeedCaptcha = false;
if( $arProfile["TYPE"] == "vk_trade" ){
    $obVkModel = new CAcritExportproplusVkModel( $arProfile );
    $groupAccountData = $obVkModel->GetAccountInfoData();

    if( is_array( $groupAccountData["error"] ) && !empty( $groupAccountData["error"] ) && ( $groupAccountData["error"]["error_code"] == 14 ) ){
        $groupAccountData["response"]["captcha_sid"] = $groupAccountData["error"]["captcha_sid"];
        $groupAccountData["response"]["captcha_img"] = $groupAccountData["error"]["captcha_img"];
        $bNeedCaptcha = true;
    }
}
?>

<tr class="heading" align="center">
    <td colspan="2"><b><?=GetMessage( "ACRIT_EXPORTPROPLUS_OP_UA_VK_TITLE" )?></b></td>
</tr>
<tr align="center">
    <td colspan="2">
        <?=BeginNote();?>
        <?=GetMessage( "ACRIT_EXPORTPROPLUS_OP_UA_VK_TITLE_ACCESS_DATA" )?>
        <?=EndNote();?>
    </td>
</tr>
<tr>
    <td width="40%" class="adm-detail-content-cell-l">
        <span id="hint_PROFILE[VK][VK_ACCESS_TOKEN]"></span><script type="text/javascript">BX.hint_replace( BX( 'hint_PROFILE[VK][VK_ACCESS_TOKEN]' ), '<?=GetMessage( "ACRIT_EXPORTPROPLUS_OP_UA_VK_ACCESS_TOKEN_HELP" )?>' );</script>
        <label for="PROFILE[VK][VK_ACCESS_TOKEN]"><b><?=GetMessage( "ACRIT_EXPORTPROPLUS_OP_UA_VK_ACCESS_TOKEN" )?></b> </label>
    </td>
    <td width="60%" class="adm-detail-content-cell-r">
        <input type="text" size="30" id="VK_ACCESS_TOKEN" name="PROFILE[VK][VK_ACCESS_TOKEN]" value="<?=$arProfile["VK"]["VK_ACCESS_TOKEN"];?>" />
    </td>
</tr>
<tr>
    <td width="40%" class="adm-detail-content-cell-l">
        <span id="hint_PROFILE[VK][VK_GROUP_PUBLISH]"></span><script type="text/javascript">BX.hint_replace( BX( 'hint_PROFILE[VK][VK_GROUP_PUBLISH]' ), '<?=GetMessage( "ACRIT_EXPORTPROPLUS_OP_UA_VK_GROUP_PUBLISH_HELP" )?>' );</script>
        <label for="PROFILE[VK][VK_GROUP_PUBLISH]"><b><?=GetMessage( "ACRIT_EXPORTPROPLUS_OP_UA_VK_GROUP_PUBLISH" )?></b> </label>
    </td>
    <td width="60%" class="adm-detail-content-cell-r">
        <input type="text" size="30" name="PROFILE[VK][VK_GROUP_PUBLISH]" value="<?=$arProfile["VK"]["VK_GROUP_PUBLISH"];?>" />
    </td>
</tr>
<tr>
    <td width="40%" class="adm-detail-content-cell-l">
        <span id="hint_PROFILE[VK][VK_USER_PUBLISH]"></span><script type="text/javascript">BX.hint_replace( BX( 'hint_PROFILE[VK][VK_USER_PUBLISH]' ), '<?=GetMessage( "ACRIT_EXPORTPROPLUS_OP_UA_VK_USER_PUBLISH_HELP" )?>' );</script>
        <label for="PROFILE[VK][VK_USER_PUBLISH]"><b><?=GetMessage( "ACRIT_EXPORTPROPLUS_OP_UA_VK_USER_PUBLISH" )?></b> </label>
    </td>
    <td width="60%" class="adm-detail-content-cell-r">
        <input type="text" size="30" name="PROFILE[VK][VK_USER_PUBLISH]" value="<?=$arProfile["VK"]["VK_USER_PUBLISH"];?>" />
    </td>
</tr>
<tr>
    <td width="40%" class="adm-detail-content-cell-l">
        <span id="hint_ACRIT_EXPORTPROPLUS_OP_UA_VK_SYNC_SETTINGS_RESET"></span><script type="text/javascript">BX.hint_replace( BX( 'hint_ACRIT_EXPORTPROPLUS_OP_UA_VK_SYNC_SETTINGS_RESET' ), '<?=GetMessage( "ACRIT_EXPORTPROPLUS_OP_UA_VK_SYNC_SETTINGS_RESET_HELP" )?>' );</script>
        <label for="VK_SYNC_SETTINGS_RESET"><b><?=GetMessage( "ACRIT_EXPORTPROPLUS_OP_UA_VK_SYNC_SETTINGS_RESET" )?></b> </label>
    </td>
    <td width="60%" class="adm-detail-content-cell-r">
        <a class="adm-btn adm-btn-save" onclick="if( confirm( '<?=GetMessage( "ACRIT_EXPORTPROPLUS_PROFILE_RESET_SETTINGS_CONFIRM" )?>' ) ){ VkResetSyncSettings( '<?=$arProfile["ID"];?>' ) }"><?=GetMessage( "ACRIT_EXPORTPROPLUS_SYNC_SETTINGS_RESET" )?></a>
    </td>
</tr>
<tr>
    <td colspan="2"><br/></td>
</tr>
<tr>
    <td width="50%" class="adm-detail-content-cell-l">
        <span id="hint_ACRIT_EXPORTPROPLUS_VK_MARKET_ITEMS_DELETE"></span><script type="text/javascript">BX.hint_replace( BX( 'hint_ACRIT_EXPORTPROPLUS_VK_MARKET_ITEMS_DELETE' ), '<?=GetMessage( "ACRIT_EXPORTPROPLUS_VK_MARKET_ITEMS_DELETE_HELP" )?>' );</script>
        <label for="VK_MARKET_ITEMS_DELETE"><b><?=GetMessage( "ACRIT_EXPORTPROPLUS_VK_MARKET_ITEMS_DELETE" )?></b> </label>
    </td>
    <td width="50%" class="adm-detail-content-cell-r">
        <a class="adm-btn adm-btn-save" onclick="if( confirm( '<?=GetMessage( "ACRIT_EXPORTPROPLUS_PROFILE_DELETE_ITEMS_CONFIRM" )?>' ) ){ VkDeleteSyncProducts( '<?=$arProfile["ID"];?>' ) }"><?=GetMessage( "ACRIT_EXPORTPROPLUS_VK_MARKET_ITEMS_DELETE_BUTTON" )?></a>
    </td>
</tr>
<tr>
    <td width="50%" class="adm-detail-content-cell-l">
        <span id="hint_ACRIT_EXPORTPROPLUS_VK_MARKET_ITEMS_DELETE_FORCE"></span><script type="text/javascript">BX.hint_replace( BX( 'hint_ACRIT_EXPORTPROPLUS_VK_MARKET_ITEMS_DELETE_FORCE' ), '<?=GetMessage( "ACRIT_EXPORTPROPLUS_VK_MARKET_ITEMS_DELETE_FORCE_HELP" )?>' );</script>
        <label for="VK_MARKET_ITEMS_DELETE_FORCE"><b><?=GetMessage( "ACRIT_EXPORTPROPLUS_VK_MARKET_ITEMS_DELETE_FORCE" )?></b> </label>
    </td>
    <td width="50%" class="adm-detail-content-cell-r">
        &nbsp;<a class="adm-btn adm-btn-red" onclick="if( confirm( '<?=GetMessage( "ACRIT_EXPORTPROPLUS_PROFILE_DELETEALL_ITEMS_CONFIRM" )?>' ) ){ VkDeleteAllProducts( '<?=$arProfile["ID"];?>' ) }"><?=GetMessage( "ACRIT_EXPORTPROPLUS_VK_MARKET_ITEMS_DELETE_FORCE_BUTTON" )?></a>
    </td>
</tr>
<?if( $bNeedCaptcha ){?>
    <tr id="captcha_block">
        <td width="40%" class="adm-detail-content-cell-l">
            <span id="hint_VK_GROUP_NEED_CAPTCHA"></span><script type="text/javascript">BX.hint_replace( BX( 'hint_VK_GROUP_NEED_CAPTCHA' ), '<?=GetMessage( "ACRIT_EXPORTPROPLUS_OP_UA_VK_NEED_CAPTCHA_HELP" )?>' );</script>
            <label for="VK_GROUP_NEED_CAPTCHA"><b><?=GetMessage( "ACRIT_EXPORTPROPLUS_OP_UA_VK_NEED_CAPTCHA" )?></b> </label>
        </td>
        <td width="60%" class="adm-detail-content-cell-r">
            <img id="captcha_word" src="<?=$groupAccountData["error"]["captcha_img"]?>" /><br/><br/>
            <input type="text" size="30" id="vk_captcha" name="vk_captcha" value="" placeholder="<?=GetMessage( "ACRIT_EXPORTPROPLUS_OP_UA_VK_NEED_CAPTCHA_WORD" );?>" />&nbsp;&nbsp;
            <a class="adm-btn adm-btn-save" onclick="SendVkCaptcha( '<?=$arProfile["ID"];?>', $( '#vk_captcha' ).val(), '<?=$groupAccountData["error"]["captcha_sid"];?>' )"><?=GetMessage( "ACRIT_EXPORTPROPLUS_SEND_VK_CAPTCHA" )?></a>
        </td>
    </tr>
<?}?>