<?IncludeModuleLangFile( __FILE__ );?>

<tr class="heading" align="center">
    <td colspan="2"><b><?=GetMessage( "ACRIT_EXPORTPROPLUS_OP_UA_FB_TITLE" )?></b></td>
</tr>
<tr align="center">
    <td colspan="2">
        <?=BeginNote();?>
        <?=GetMessage( "ACRIT_EXPORTPROPLUS_OP_UA_FB_TITLE_ACCESS_DATA" )?>
        <?=EndNote();?>
    </td>
</tr>
<tr>
    <td width="40%" class="adm-detail-content-cell-l">
        <span id="hint_PROFILE[FB][FB_PAGE_PUBLISH]"></span><script type="text/javascript">BX.hint_replace( BX( 'hint_PROFILE[FB][FB_PAGE_PUBLISH]' ), '<?=GetMessage( "ACRIT_EXPORTPROPLUS_OP_UA_FB_PAGE_PUBLISH_HELP" )?>' );</script>
        <label for="PROFILE[FB][FB_PAGE_PUBLISH]"><b><?=GetMessage( "ACRIT_EXPORTPROPLUS_OP_UA_FB_PAGE_PUBLISH" )?></b> </label>
    </td>
    <td width="60%" class="adm-detail-content-cell-r">
        <input type="text" size="30" id="FB_PAGE_PUBLISH" name="PROFILE[FB][FB_PAGE_PUBLISH]" value="<?=$arProfile["FB"]["FB_PAGE_PUBLISH"];?>" />
    </td>
</tr>
<tr>
    <td width="40%" class="adm-detail-content-cell-l">
        <span id="hint_PROFILE[FB][FB_APP_ID]"></span><script type="text/javascript">BX.hint_replace( BX( 'hint_PROFILE[FB][FB_APP_ID]' ), '<?=GetMessage( "ACRIT_EXPORTPROPLUS_OP_UA_FB_APP_ID_HELP" )?>' );</script>
        <label for="PROFILE[FB][FB_APP_ID]"><b><?=GetMessage( "ACRIT_EXPORTPROPLUS_OP_UA_FB_APP_ID" )?></b> </label>
    </td>
    <td width="60%" class="adm-detail-content-cell-r">
        <input type="text" size="30" id="FB_APP_ID" name="PROFILE[FB][FB_APP_ID]" value="<?=$arProfile["FB"]["FB_APP_ID"];?>" />
    </td>
</tr>
<tr>
    <td width="40%" class="adm-detail-content-cell-l">
        <span id="hint_PROFILE[FB][FB_APP_SECRET]"></span><script type="text/javascript">BX.hint_replace( BX( 'hint_PROFILE[FB][FB_APP_SECRET]' ), '<?=GetMessage( "ACRIT_EXPORTPROPLUS_OP_UA_FB_APP_SECRET_HELP" )?>' );</script>
        <label for="PROFILE[FB][FB_APP_SECRET]"><b><?=GetMessage( "ACRIT_EXPORTPROPLUS_OP_UA_FB_APP_SECRET" )?></b> </label>
    </td>
    <td width="60%" class="adm-detail-content-cell-r">
        <input type="text" size="30" id="FB_APP_SECRET" name="PROFILE[FB][FB_APP_SECRET]" value="<?=$arProfile["FB"]["FB_APP_SECRET"];?>" />
    </td>
</tr>
<tr>
    <td width="40%" class="adm-detail-content-cell-l">
        <span id="hint_PROFILE[FB][FB_ACCESS_TOKEN]"></span><script type="text/javascript">BX.hint_replace( BX( 'hint_PROFILE[FB][FB_ACCESS_TOKEN]' ), '<?=GetMessage( "ACRIT_EXPORTPROPLUS_OP_UA_FB_ACCESS_TOKEN_HELP" )?>' );</script>
        <label for="PROFILE[FB][FB_ACCESS_TOKEN]"><b><?=GetMessage( "ACRIT_EXPORTPROPLUS_OP_UA_FB_ACCESS_TOKEN" )?></b> </label>
    </td>
    <td width="60%" class="adm-detail-content-cell-r">
        <input type="text" size="30" id="FB_ACCESS_TOKEN" name="PROFILE[FB][FB_ACCESS_TOKEN]" value="<?=$arProfile["FB"]["FB_ACCESS_TOKEN"];?>" />
    </td>
</tr>