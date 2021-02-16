<?
/**
 * Copyright (c) 16/2/2021 Created By/Edited By ASDAFF asdaff.asad@yandex.ru
 */

$strModuleId = 'data.exportproplus';

// Agent for autobackup
\CAgent::AddAgent('Data\ExportProPlus\Backup::autobackup();', $strModuleId, 'N', 3600);

?>