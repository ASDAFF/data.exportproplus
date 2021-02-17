<?
IncludeModuleLangFile(__FILE__);
$APPLICATION->SetTitle(GetMessage("acrit.uninst_fb_PAGE_TITLE", array('#MODULE_NAME#' => $GLOBALS['ACRIT_MODULE_NAME'])));
?>
<form action="<?=$APPLICATION->GetCurPage()?>" method="get" name="acrit_uninst_feedback" class="acrit-uninst-feedback" id="acrit_uninst_feedback" style="max-width: 500px; background: #fff; padding: 10px 20px 20px 20px;">
	<?=bitrix_sessid_post()?>
	<input type="hidden" name="lang" value="<?=LANG?>">
	<input type="hidden" name="id" value="<?=$GLOBALS['ACRIT_MODULE_ID'];?>">
	<input type="hidden" name="uninstall" value="Y">
	<input type="hidden" name="step" value="2">
	<input type="hidden" name="prevstep" value="1">

	<?// Custom ?>
	<p>
		<input type="checkbox" name="savedata" id="savedata" value="Y" checked="checked" />
		<label for="savedata"><?=GetMessage("MOD_UNINST_SAVE_TABLES")?></label><br />
	</p>
	<input type="submit" name="inst" value="<?=GetMessage("acrit.uninst_fb_DEL")?>">
</form>