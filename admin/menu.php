<?
/**
 * Copyright (c) 16/2/2021 Created By/Edited By ASDAFF asdaff.asad@yandex.ru
 */

$strCoreId = 'data.core';
$strModuleId = pathinfo(realpath(__DIR__.'/..'), PATHINFO_BASENAME);
$strFile = $_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/'.$strCoreId.'/admin/export/menu.php';
if(is_file($strFile)){
	return include $strFile;
}
?>