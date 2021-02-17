<?
namespace Acrit\ExportProPlus;

use
	\Acrit\Core\Helper,
	\Acrit\Core\Log,
	\Acrit\Core\Options;

# Include module
$strModuleId = pathinfo(__DIR__, PATHINFO_BASENAME);
\Bitrix\Main\Loader::includeModule($strModuleId);
Helper::loadMessages(__FILE__);

# Check rights
$strRight = $APPLICATION->getGroupRight($strModuleId);
if($strRight == 'D'){
	return;
}

# Old core
$bOldCoreDisabled = Helper::getOption($strModuleId, 'disable_old_core') == 'Y';
if(!$bOldCoreDisabled){
	\CJSCore::init('jquery');
	$APPLICATION->AddHeadScript('/bitrix/js/iblock/iblock_edit.js', true);
	$APPLICATION->AddHeadScript('/bitrix/js/'.$strModuleId.'/main.js', true);
}


# Tabs
$arTabs = [
	[
		'DIV' => 'general',
		'TAB' => Helper::getMessage('ACRIT_CORE_TAB_GENERAL_NAME'),
		'TITLE' => Helper::getMessage('ACRIT_CORE_TAB_GENERAL_DESC'),
		'OPTIONS' => [
			'core/common.php',
			'export/multithread.php',
			'core/log.php',
			'export/old_core.php',
			'export/misc.php',
		],
	], [
		'DIV' => 'log',
		'TAB' => Helper::getMessage('ACRIT_CORE_TAB_LOG_NAME'),
		'TITLE' => Helper::getMessage('ACRIT_CORE_TAB_LOG_DESC'),
		'CALLBACK' => function($obOptions, $arTab){
			?>
				<tr>
					<td>
						<?=Log::getInstance($obOptions->getModuleId())->showLog();?>
					</td>
				</tr>
			<?
		},
	], [
		'DIV' => 'crm',
		'TAB' => Helper::getMessage('ACRIT_CORE_TAB_CRM_NAME'),
		'TITLE' => Helper::getMessage('ACRIT_CORE_TAB_CRM_DESC'),
		'OPTIONS' => [
			'core/crm.php',
		],
	], [
		'DIV' => 'rights',
		'TAB' => Helper::getMessage('MAIN_TAB_RIGHTS'),
		'TITLE' => Helper::getMessage('MAIN_TAB_TITLE_RIGHTS'),
		'RIGHTS' => true,
	], [
		'DIV' => 'agents',
		'TAB' => Helper::getMessage('ACRIT_CORE_TAB_AGENTS_NAME'),
		'TITLE' => Helper::getMessage('ACRIT_CORE_TAB_AGENTS_NAME'),
		'CALLBACK' => function($obOptions, $arTab){
			?>
				<tr>
					<td class="heading" colspan="2"><?=GetMessage("SC_SET_CRON_AGENTS_OPTIONS");?></td>
				</tr>
				<tr>
					<td colspan="2" class="adm-detail-content-cell" align="center">
						<a class="adm-btn adm-btn-save" onclick="javascript:SetCronAgentOptions();"><?=GetMessage("ACRIT_EXPORTPROPLUS_SET_CRON_AGENTS_OPTIONS_BUTTON")?></a>
					</td>
				</tr>
				<tr>
					<td class="heading" colspan="2"><?=GetMessage("SC_SET_CRON_AGENTS_INFO");?></td>
				</tr>
				<tr>
					<td colspan="2">
						<?=GetMessage("ACRIT_EXPORTPROPLUS_SET_CRON_AGENTS_OPTIONS_STEPS");?>
					</td>
				</tr>
			<?
		},
	], [
		'DIV' => 'support',
		'TAB' => Helper::getMessage('ACRIT_CORE_TAB_SUPPORT_NAME'),
		'TITLE' => Helper::getMessage('ACRIT_CORE_TAB_SUPPORT_NAME'),
		'CALLBACK' => function($obOptions, $arTab){
			?>
				<tr>
					<td class="heading" colspan="2"><?=GetMessage("SC_MARKET_CATEGORIES");?></td>
				</tr>
				<tr>
					<td colspan="2" class="adm-detail-content-cell" align="center">
						<a class="adm-btn adm-btn-save" onclick="javascript:UpdateMarketCategories();">
							<?=GetMessage("ACRIT_EXPORTPROPLUS_MARKET_CATEGORIES_UPDATE_BUTTON");?>
						</a>
					</td>
				</tr>
				<tr>
					<td class="heading" colspan="2"><?=GetMessage("SC_SET_BITRIX_CLOUD_MONITORING_OPTIONS");?></td>
				</tr>
				<tr>
					<td colspan="2">
						<?=GetMessage("ACRIT_EXPORTPROPLUS_RECOMMENDS");?>
					</td>
				</tr>
			<?
		},
	],
];

if($bOldCoreDisabled){
	$arTabs = array_slice($arTabs, 0, -2);
}

# Display all
$obOptions = new Options($strModuleId, $arTabs, [
	'DISABLED' => $strRight <= 'R',
]);