<?
$strModuleId = 'acrit.exportproplus';

// Agent for autobackup
\CAgent::AddAgent('Acrit\ExportProPlus\Backup::autobackup();', $strModuleId, 'N', 3600);

?>