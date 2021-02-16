<?IncludeModuleLangFile( __FILE__ );

$bGroupPublish = ( $arProfile["OK"]["OK_IS_GROUP_PUBLISH"] == "Y" ) ? 'checked="checked"' : "";?>

<tr class="heading" align="center">
    <td colspan="2"><b><?=GetMessage( "ACRIT_EXPORTPROPLUS_OP_UA_OK_TITLE" )?></b></td>
</tr>
<tr align="center">
    <td colspan="2">
        <?=BeginNote();?>
        <?=GetMessage( "ACRIT_EXPORTPROPLUS_OP_UA_OK_TITLE_ACCESS_DATA" )?>
        <?=EndNote();?>
    </td>
</tr>
<tr>
    <td width="40%" class="adm-detail-content-cell-l">
        <span id="hint_PROFILE[OK][OK_IS_GROUP_PUBLISH]"></span><script type="text/javascript">BX.hint_replace( BX( 'hint_PROFILE[OK][OK_IS_GROUP_PUBLISH]' ), '<?=GetMessage( "ACRIT_EXPORTPROPLUS_OP_UA_OK_IS_GROUP_PUBLISH_HELP" )?>' );</script>
        <label for="PROFILE[OK][OK_IS_GROUP_PUBLISH]"><b><?=GetMessage( "ACRIT_EXPORTPROPLUS_OP_UA_OK_IS_GROUP_PUBLISH" )?></b> </label>
    </td>
    <td width="60%" class="adm-detail-content-cell-r">
        <input type="checkbox" name="PROFILE[OK][OK_IS_GROUP_PUBLISH]" value="Y" <?=$bGroupPublish?>/>
    </td>
</tr>
<tr>
    <td width="40%" class="adm-detail-content-cell-l">
        <span id="hint_PROFILE[OK][OK_GROUP]"></span><script type="text/javascript">BX.hint_replace( BX( 'hint_PROFILE[OK][OK_GROUP]' ), '<?=GetMessage( "ACRIT_EXPORTPROPLUS_OP_UA_OK_GROUP_HELP" )?>' );</script>
        <label for="PROFILE[OK][OK_GROUP]"><b><?=GetMessage( "ACRIT_EXPORTPROPLUS_OP_UA_OK_GROUP" )?></b> </label>
    </td>
    <td width="60%" class="adm-detail-content-cell-r">
        <input type="text" size="30" id="OK_GROUP" name="PROFILE[OK][OK_GROUP]" value="<?=$arProfile["OK"]["OK_GROUP"];?>" />
    </td>
</tr>
<tr>
    <td width="40%" class="adm-detail-content-cell-l">
        <span id="hint_PROFILE[OK][OK_APP_ID]"></span><script type="text/javascript">BX.hint_replace( BX( 'hint_PROFILE[OK][OK_APP_ID]' ), '<?=GetMessage( "ACRIT_EXPORTPROPLUS_OP_UA_OK_APP_ID_HELP" )?>' );</script>
        <label for="PROFILE[OK][OK_APP_ID]"><b><?=GetMessage( "ACRIT_EXPORTPROPLUS_OP_UA_OK_APP_ID" )?></b> </label>
    </td>
    <td width="60%" class="adm-detail-content-cell-r">
        <input type="text" size="30" id="OK_APP_ID" name="PROFILE[OK][OK_APP_ID]" value="<?=$arProfile["OK"]["OK_APP_ID"];?>" />
    </td>
</tr>
<tr>
    <td width="40%" class="adm-detail-content-cell-l">
        <span id="hint_PROFILE[OK][OK_APP_PUBLIC_KEY]"></span><script type="text/javascript">BX.hint_replace( BX( 'hint_PROFILE[OK][OK_APP_PUBLIC_KEY]' ), '<?=GetMessage( "ACRIT_EXPORTPROPLUS_OP_UA_OK_APP_PUBLIC_KEY_HELP" )?>' );</script>
        <label for="PROFILE[OK][OK_APP_PUBLIC_KEY]"><b><?=GetMessage( "ACRIT_EXPORTPROPLUS_OP_UA_OK_APP_PUBLIC_KEY" )?></b> </label>
    </td>
    <td width="60%" class="adm-detail-content-cell-r">
        <input type="text" size="30" id="OK_APP_PUBLIC_KEY" name="PROFILE[OK][OK_APP_PUBLIC_KEY]" value="<?=$arProfile["OK"]["OK_APP_PUBLIC_KEY"];?>" />
    </td>
</tr>
<tr>
    <td width="40%" class="adm-detail-content-cell-l">
        <span id="hint_PROFILE[OK][OK_APP_SECRET_KEY]"></span><script type="text/javascript">BX.hint_replace( BX( 'hint_PROFILE[OK][OK_APP_SECRET_KEY]' ), '<?=GetMessage( "ACRIT_EXPORTPROPLUS_OP_UA_OK_APP_SECRET_KEY_HELP" )?>' );</script>
        <label for="PROFILE[OK][OK_APP_SECRET_KEY]"><b><?=GetMessage( "ACRIT_EXPORTPROPLUS_OP_UA_OK_APP_SECRET_KEY" )?></b> </label>
    </td>
    <td width="60%" class="adm-detail-content-cell-r">
        <input type="text" size="30" id="OK_APP_SECRET_KEY" name="PROFILE[OK][OK_APP_SECRET_KEY]" value="<?=$arProfile["OK"]["OK_APP_SECRET_KEY"];?>" />
    </td>
</tr>
<tr>
    <td width="40%" class="adm-detail-content-cell-l">
        <span id="hint_PROFILE[OK][OK_ACCESS_TOKEN]"></span><script type="text/javascript">BX.hint_replace( BX( 'hint_PROFILE[OK][OK_ACCESS_TOKEN]' ), '<?=GetMessage( "ACRIT_EXPORTPROPLUS_OP_UA_OK_ACCESS_TOKEN_HELP" )?>' );</script>
        <label for="PROFILE[OK][OK_ACCESS_TOKEN]"><b><?=GetMessage( "ACRIT_EXPORTPROPLUS_OP_UA_OK_ACCESS_TOKEN" )?></b> </label>
    </td>
    <td width="60%" class="adm-detail-content-cell-r">
        <input type="text" size="30" id="OK_ACCESS_TOKEN" name="PROFILE[OK][OK_ACCESS_TOKEN]" value="<?=$arProfile["OK"]["OK_ACCESS_TOKEN"];?>" />
    </td>
</tr>
<tr>
    <td width="40%" class="adm-detail-content-cell-l">
        <span id="hint_ACRIT_EXPORTPROPLUS_OP_UA_OK_SYNC_SETTINGS_RESET"></span><script type="text/javascript">BX.hint_replace( BX( 'hint_ACRIT_EXPORTPROPLUS_OP_UA_OK_SYNC_SETTINGS_RESET' ), '<?=GetMessage( "ACRIT_EXPORTPROPLUS_OP_UA_OK_SYNC_SETTINGS_RESET_HELP" )?>' );</script>
        <label for="OK_SYNC_SETTINGS_RESET"><b><?=GetMessage( "ACRIT_EXPORTPROPLUS_OP_UA_OK_SYNC_SETTINGS_RESET" )?></b> </label>
    </td>
    <td width="60%" class="adm-detail-content-cell-r">
        <a class="adm-btn adm-btn-save" onclick="if( confirm( '<?=GetMessage( "ACRIT_EXPORTPROPLUS_PROFILE_RESET_SETTINGS_CONFIRM" )?>' ) ){ OkResetSyncSettings( '<?=$arProfile["ID"];?>' ) }"><?=GetMessage( "ACRIT_EXPORTPROPLUS_SYNC_SETTINGS_RESET" )?></a>
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
        <a class="adm-btn adm-btn-save" onclick="if( confirm( '<?=GetMessage( "ACRIT_EXPORTPROPLUS_PROFILE_DELETE_ITEMS_CONFIRM" )?>' ) ){ OkDeleteSyncMediatopics( '<?=$arProfile["ID"];?>' ) }"><?=GetMessage( "ACRIT_EXPORTPROPLUS_OK_MARKET_ITEMS_DELETE_BUTTON" )?></a>
    </td>
</tr>
<tr>
    <td width="50%" class="adm-detail-content-cell-l">
        <span id="hint_ACRIT_EXPORTPROPLUS_OK_MARKET_ITEMS_DELETE_FORCE"></span><script type="text/javascript">BX.hint_replace( BX( 'hint_ACRIT_EXPORTPROPLUS_OK_MARKET_ITEMS_DELETE_FORCE' ), '<?=GetMessage( "ACRIT_EXPORTPROPLUS_OK_MARKET_ITEMS_DELETE_FORCE_HELP" )?>' );</script>
        <label for="OK_MARKET_ITEMS_DELETE_FORCE"><b><?=GetMessage( "ACRIT_EXPORTPROPLUS_OK_MARKET_ITEMS_DELETE_FORCE" )?></b> </label>
    </td>
    <td width="50%" class="adm-detail-content-cell-r">
        &nbsp;<a class="adm-btn adm-btn-red" onclick="if( confirm( '<?=GetMessage( "ACRIT_EXPORTPROPLUS_PROFILE_DELETEALL_ITEMS_CONFIRM" )?>' ) ){ OkDeleteAllMediatopics( '<?=$arProfile["ID"];?>' ) }"><?=GetMessage( "ACRIT_EXPORTPROPLUS_OK_MARKET_ITEMS_DELETE_FORCE_BUTTON" )?></a>
    </td>
</tr>