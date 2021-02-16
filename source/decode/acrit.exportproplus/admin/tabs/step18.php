<?IncludeModuleLangFile( __FILE__ );?>

<?
$bUseRemarketing = $arProfile["USE_REMARKETING"] == "Y" ? 'checked="checked"' : "";
$bUseGoogleTagManager = $arProfile["USE_GOOGLETAGMANAGER"] == "Y" ? 'checked="checked"' : "";
?>

<tr class="heading" align="center">
    <td colspan="2"><b><?=GetMessage( "ACRIT_EXPORTPROPLUS_OP_GOOGLE_TITLE" )?></b></td>
</tr>
<tr align="center">
    <td colspan="2">
        <?=BeginNote();?>
        <?=GetMessage( "ACRIT_EXPORTPROPLUS_OP_GOOGLE_NOTE" );?>
        <?=EndNote();?>
    </td>
</tr>
<tr>
    <td width="40%" class="adm-detail-content-cell-l">
        <span id="hint_PROFILE[GOOGLE_GOOGLEFEED]"></span><script type="text/javascript">BX.hint_replace( BX( 'hint_PROFILE[GOOGLE_GOOGLEFEED]' ), '<?=GetMessage( "ACRIT_EXPORTPROPLUS_OP_GOOGLE_GOOGLEFEED_HELP" )?>' );</script>
        <label for="PROFILE[GOOGLE_GOOGLEFEED]"><b><?=GetMessage( "ACRIT_EXPORTPROPLUS_OP_GOOGLE_GOOGLEFEED" )?></b> </label>
    </td>
    <td width="60%" class="adm-detail-content-cell-r">
        <input type="text" size="30" name="PROFILE[GOOGLE_GOOGLEFEED]" value="<?=$arProfile["GOOGLE_GOOGLEFEED"];?>" />
    </td>
</tr>
<tr>
    <td width="40%" class="adm-detail-content-cell-l">
        <span id="hint_PROFILE[USE_REMARKETING]"></span><script type="text/javascript">BX.hint_replace( BX( 'hint_PROFILE[USE_REMARKETING]' ), '<?=GetMessage( "ACRIT_EXPORTPROPLUS_USE_REMARKETING_HELP" )?>' );</script>
        <label for="PROFILE[USE_REMARKETING]"><b><?=GetMessage( "ACRIT_EXPORTPROPLUS_USE_REMARKETING" )?></b> </label>
    </td>
    <td width="60%" class="adm-detail-content-cell-r">
        <input type="checkbox" name="PROFILE[USE_REMARKETING]" value="Y" <?=$bUseRemarketing?>/>
    </td>
</tr>
<tr class="heading" align="center">
    <td colspan="2"><b><?=GetMessage( "ACRIT_EXPORTPROPLUS_OP_GOOGLETAGMANAGER_TITLE" )?></b></td>
</tr>
<tr>
    <td width="40%" class="adm-detail-content-cell-l">
        <span id="hint_PROFILE[GOOGLETAGMANAGER_ID]"></span><script type="text/javascript">BX.hint_replace( BX( 'hint_PROFILE[GOOGLETAGMANAGER_ID]' ), '<?=GetMessage( "ACRIT_EXPORTPROPLUS_OP_GOOGLETAGMANAGER_ID_HELP" )?>' );</script>
        <label for="PROFILE[GOOGLETAGMANAGER_ID]"><b><?=GetMessage( "ACRIT_EXPORTPROPLUS_OP_GOOGLETAGMANAGER_ID" )?></b> </label>
    </td>
    <td width="60%" class="adm-detail-content-cell-r">
        <input type="text" size="30" name="PROFILE[GOOGLETAGMANAGER_ID]" value="<?=$arProfile["GOOGLETAGMANAGER_ID"];?>" />
    </td>
</tr>
<tr>
    <td width="40%" class="adm-detail-content-cell-l">
        <span id="hint_PROFILE[USE_GOOGLETAGMANAGER]"></span><script type="text/javascript">BX.hint_replace( BX( 'hint_PROFILE[USE_GOOGLETAGMANAGER]' ), '<?=GetMessage( "ACRIT_EXPORTPROPLUS_USE_GOOGLETAGMANAGER_HELP" )?>' );</script>
        <label for="PROFILE[USE_GOOGLETAGMANAGER]"><b><?=GetMessage( "ACRIT_EXPORTPROPLUS_USE_GOOGLETAGMANAGER" )?></b> </label>
    </td>
    <td width="60%" class="adm-detail-content-cell-r">
        <input type="checkbox" name="PROFILE[USE_GOOGLETAGMANAGER]" value="Y" <?=$bUseGoogleTagManager?>/>
    </td>
</tr>