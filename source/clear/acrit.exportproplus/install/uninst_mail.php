<?
if(!check_bitrix_sessid()) return;
IncludeModuleLangFile(__FILE__);
$APPLICATION->SetTitle(GetMessage("acrit.uninst_fb_PAGE_TITLE", array('#MODULE_NAME#' => $GLOBALS['ACRIT_MODULE_NAME'])));

CAdminMessage::ShowNote(GetMessage('acrit.uninst_fb_MAIL_MOD_UNINST_OK'));
?>
<form action="<?=$APPLICATION->GetCurPage()?>" method="get">
	<p>
		<input type="hidden" name="lang" value="<?=LANG?>" />
		<input type="submit" value="<?=GetMessage( "MOD_BACK" )?>" />
	</p>
</form>