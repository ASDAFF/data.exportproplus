<?IncludeModuleLangFile( __FILE__ );?>

<tr class="heading" align="center">
    <td colspan="2"><b><?=GetMessage( "ACRIT_EXPORTPROPLUS_OP_UA_INSTAGRAM_TITLE" )?></b></td>
</tr>
<tr align="center">
    <td colspan="2">
        <?=BeginNote();?>
        <?=GetMessage( "ACRIT_EXPORTPROPLUS_OP_UA_INSTAGRAM_TITLE_ACCESS_DATA" )?>
        <?=EndNote();?>
    </td>
</tr>
<tr>
    <td width="40%" class="adm-detail-content-cell-l">
        <span id="hint_PROFILE[INSTAGRAM][INSTAGRAM_LOGIN]"></span><script type="text/javascript">BX.hint_replace( BX( 'hint_PROFILE[INSTAGRAM][INSTAGRAM_LOGIN]' ), '<?=GetMessage( "ACRIT_EXPORTPROPLUS_OP_UA_INSTAGRAM_LOGIN_HELP" )?>' );</script>
        <label for="PROFILE[INSTAGRAM][INSTAGRAM_LOGIN]"><b><?=GetMessage( "ACRIT_EXPORTPROPLUS_OP_UA_INSTAGRAM_LOGIN" )?></b> </label>
    </td>
    <td width="60%" class="adm-detail-content-cell-r">
        <input type="text" size="30" id="INSTAGRAM_LOGIN" name="PROFILE[INSTAGRAM][INSTAGRAM_LOGIN]" value="<?=$arProfile["INSTAGRAM"]["INSTAGRAM_LOGIN"];?>" />
    </td>
</tr>
<tr>
    <td width="40%" class="adm-detail-content-cell-l">
        <span id="hint_PROFILE[INSTAGRAM][INSTAGRAM_PASSWORD]"></span><script type="text/javascript">BX.hint_replace( BX( 'hint_PROFILE[INSTAGRAM][INSTAGRAM_PASSWORD]' ), '<?=GetMessage( "ACRIT_EXPORTPROPLUS_OP_UA_INSTAGRAM_PASSWORD_HELP" )?>' );</script>
        <label for="PROFILE[INSTAGRAM][INSTAGRAM_PASSWORD]"><b><?=GetMessage( "ACRIT_EXPORTPROPLUS_OP_UA_INSTAGRAM_PASSWORD" )?></b> </label>
    </td>
    <td width="60%" class="adm-detail-content-cell-r">
        <input type="password" size="30" id="INSTAGRAM_PASSWORD" name="PROFILE[INSTAGRAM][INSTAGRAM_PASSWORD]" value="<?=$arProfile["INSTAGRAM"]["INSTAGRAM_PASSWORD"];?>" />
    </td>
</tr>
<?/*<tr>
    <td width="40%" class="adm-detail-content-cell-l">
        <span id="hint_ACRIT_EXPORTPROPLUS_OP_UA_INSTAGRAM_SYNC_SETTINGS_RESET"></span><script type="text/javascript">BX.hint_replace( BX( 'hint_ACRIT_EXPORTPROPLUS_OP_UA_INSTAGRAM_SYNC_SETTINGS_RESET' ), '<?=GetMessage( "ACRIT_EXPORTPROPLUS_OP_UA_INSTAGRAM_SYNC_SETTINGS_RESET_HELP" )?>' );</script>
        <label for="INSTAGRAM_SYNC_SETTINGS_RESET"><b><?=GetMessage( "ACRIT_EXPORTPROPLUS_OP_UA_INSTAGRAM_SYNC_SETTINGS_RESET" )?></b> </label>
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
        <span id="hint_ACRIT_EXPORTPROPLUS_INSTAGRAM_MARKET_ITEMS_DELETE"></span><script type="text/javascript">BX.hint_replace( BX( 'hint_ACRIT_EXPORTPROPLUS_INSTAGRAM_MARKET_ITEMS_DELETE' ), '<?=GetMessage( "ACRIT_EXPORTPROPLUS_INSTAGRAM_MARKET_ITEMS_DELETE_HELP" )?>' );</script>
        <label for="INSTAGRAM_MARKET_ITEMS_DELETE"><b><?=GetMessage( "ACRIT_EXPORTPROPLUS_INSTAGRAM_MARKET_ITEMS_DELETE" )?></b> </label>
    </td>
    <td width="50%" class="adm-detail-content-cell-r">
        <a class="adm-btn adm-btn-save" onclick="if( confirm( '<?=GetMessage( "ACRIT_EXPORTPROPLUS_PROFILE_DELETE_ITEMS_CONFIRM" )?>' ) ){ OkDeleteSyncMediatopics( '<?=$arProfile["ID"];?>' ) }"><?=GetMessage( "ACRIT_EXPORTPROPLUS_INSTAGRAM_MARKET_ITEMS_DELETE_BUTTON" )?></a>
    </td>
</tr>*/?>