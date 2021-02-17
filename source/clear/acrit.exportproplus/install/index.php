<?
IncludeModuleLangFile(__FILE__);

class acrit_exportproplus extends CModule
{
    const MODULE_ID = 'acrit.exportproplus';
    var $MODULE_ID = 'acrit.exportproplus';
    var $MODULE_VERSION;
    var $MODULE_VERSION_DATE;
    var $MODULE_NAME;
    var $MODULE_DESCRIPTION;
    var $MODULE_CSS;
    private $_997989597 = [];
    private $_269256199;
    private $_97845374;
    private $_867037812;
    private $siteEncoding = ['utf-8' => 'utf8', 'UTF-8' => 'utf8', 'WINDOWS-1251' => 'cp1251', 'windows-1251' => 'cp1251',];

    function __construct()
    {
        $this->_269256199 = toLower(preg_replace('#^acrit\.(.*?)$#i', '$1', $this->MODULE_ID));
        $this->_97845374 = toUpper(substr($this->_269256199, 0, 1)) . substr($this->_269256199, 1);
        $this->_867037812 = toUpper($this->_269256199);
        require(__DIR__ . '/version.php');
        if (is_array($arModuleVersion) && array_key_exists('VERSION', $arModuleVersion)) {
            $this->MODULE_VERSION = $arModuleVersion['VERSION'];
            $this->MODULE_VERSION_DATE = $arModuleVersion['VERSION_DATE'];
        }
        $this->MODULE_NAME = GetMessage('ACRIT_EXPORTPROPLUS_MODULE_NAME');
        $this->MODULE_DESCRIPTION = GetMessage('ACRIT_EXPORTPROPLUS_MODULE_DESC');
        $this->PARTNER_NAME = GetMessage('ACRIT_EXPORTPROPLUS_PARTNER_NAME');
        $this->PARTNER_URI = GetMessage('ACRIT_EXPORTPROPLUS_PARTNER_URI');
        $app = \Bitrix\Main\Application::getInstance();
        $dbSite = \Bitrix\Main\SiteTable::getList();
        while ($arSite = $dbSite->Fetch()) {
            if (!$arSite['DOC_ROOT']) $this->siteArray[$arSite['LID']] = $app->getDocumentRoot() . $arSite['DIR']; else {
                $this->siteArray[$arSite['LID']] = $arSite['DOC_ROOT'];
            }
            $this->siteArray[$arSite['LID']] = \Bitrix\Main\IO\Path::normalize($this->siteArray[$arSite['LID']]);
        }
    }

    function DoInstall()
    {
        global $APPLICATION, $DB, $DBType, $step, $install;
        $GLOBALS['ACRIT_MODULE_ID'] = $this->MODULE_ID;
        $GLOBALS['ACRIT_MODULE_NAME'] = $this->MODULE_NAME;
        if ($APPLICATION->GetGroupRight('main') < 'W') {
            return;
        }
        if (!\Bitrix\Main\Loader::includeModule('acrit.core')) {
            $APPLICATION->ThrowException(getMessage('ACRIT_' . $this->_867037812 . '_NO_CORE'));
            return false;
        }
        if (!CheckVersion(PHP_VERSION, '5.4.0')) {
            $APPLICATION->ThrowException(GetMessage('ACRIT_' . $this->_867037812 . '_PHP_REQUIRE'));
            return false;
        }
        $this->reset();
        CJSCore::Init('jquery');
        if (!isset($step) || ($step < 1)) {
            $APPLICATION->IncludeAdminFile(GetMessage('ACRIT_' . $this->_867037812 . '_RECOMMENDED'), $_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/' . $this->MODULE_ID . '/install/step.php');
        } elseif (($step == 3) && ($install == 'Y')) {
            RegisterModule($this->MODULE_ID);
            $this->InstallFiles();
            $this->InstallDB();
            $this->InstallEvents();
            $this->RegisterGadget();
            require __DIR__ . '/_agents.php';
            if (\Bitrix\Main\Loader::includeModule('acrit.core') && class_exists('\Acrit\Core\Helper')) {
                $_2130876983 = \Acrit\Core\Cli::getPhpPath();
                if (strlen($_2130876983)) {
                    \Bitrix\Main\Config\Option::set($this->MODULE_ID, 'php_path', $_2130876983);
                }
            }
            $_1675345452 = new \CUrlRewriter();
            foreach ($this->siteArray as $_84438248 => $sireDir) {
                $_1675345452->add(['SITE_ID' => $_84438248, 'CONDITION' => '#^/acrit.' . $this->_269256199 . '/(.*)#', 'PATH' => '/acrit.' . $this->_269256199 . '/index.php', 'RULE' => 'path=$1',]);
            }
            $APPLICATION->IncludeAdminFile(GetMessage('MOD_INST_OK'), $_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/' . $this->MODULE_ID . '/install/step3.php');
        } elseif ($step == 2) {
            CheckDirPath(__DIR__ . '/db/category');
            CopyDirFiles(__DIR__ . '/db/', __DIR__ . '/db/category');
            $APPLICATION->IncludeAdminFile(GetMessage('MOD_INST_OK'), $_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/' . $this->MODULE_ID . '/install/step2.php');
        }
    }

    function reset()
    {
        global $DB;
        $DB->Query("DELETE FROM b_option WHERE `MODULE_ID`='" . $this->MODULE_ID . "' AND `NAME`='~bsm_stop_date';");
    }

    function InstallFiles($arParams = [])
    {
        global $DB, $DBType, $APPLICATION;
        if (is_dir($p = $_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/' . $this->MODULE_ID . '/admin')) {
            if ($dir = opendir($p)) {
                while (false !== ($item = readdir($dir))) {
                    if (in_array($item, ['.', '..', 'menu.php', 'tabs', 'new'])) {
                        continue;
                    }
                    file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/bitrix/admin/acrit_' . $this->_269256199 . '_' . $item, '' . $this->MODULE_ID . '/admin/' . $item . '");?>');
                }
                closedir($dir);
            }
        }
        if ($_ENV['COMPUTERNAME'] != 'BX') {
            CopyDirFiles($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/' . $this->MODULE_ID . '/install/admin', $_SERVER['DOCUMENT_ROOT'] . '/bitrix/admin/', true, true);
            CopyDirFiles($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/' . $this->MODULE_ID . '/install/components', $_SERVER['DOCUMENT_ROOT'] . '/bitrix/components/', true, true);
            CopyDirFiles($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/' . $this->MODULE_ID . '/install/js', $_SERVER['DOCUMENT_ROOT'] . '/bitrix/js', true, true);
            CopyDirFiles($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/' . $this->MODULE_ID . '/install/themes', $_SERVER['DOCUMENT_ROOT'] . '/bitrix/themes', true, true);
            CopyDirFiles($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/' . $this->MODULE_ID . '/install/gadgets', $_SERVER['DOCUMENT_ROOT'] . '/bitrix/gadgets', true, true);
            CopyDirFiles($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/' . $this->MODULE_ID . '/install/tools', $_SERVER['DOCUMENT_ROOT'] . '/bitrix/tools', true, true);
            CopyDirFiles($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/' . $this->MODULE_ID . '/install/bitrix', $_SERVER['DOCUMENT_ROOT'] . '/bitrix', true, true);
            foreach ($this->siteArray as $sireDir) {
                CopyDirFiles($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/' . $this->MODULE_ID . '/install/public', $sireDir, true, true);
            }
        }
        return true;
    }

    function InstallDB($arParams = [])
    {
        global $APPLICATION, $DB, $DBType;
        if (\Bitrix\Main\Loader::includeModule('security')) {
            $dbSecurityFilter = \CSecurityFilterMask::GetList();
            $arFilterMask = [];
            while ($arSecurityFilter = $dbSecurityFilter->Fetch()) {
                $arFilterMask[] = ['MASK' => $arSecurityFilter['FILTER_MASK'], 'SITE_ID' => $arSecurityFilter['SITE_ID'],];
            }
            $arFilterMask[] = ['MASK' => '/bitrix/admin/acrit_' . $this->_269256199 . '_edit.php', 'SITE_ID' => '',];
            $arFilterMask[] = ['MASK' => '/bitrix/admin/acrit_' . $this->_269256199 . '_new_edit.php*', 'SITE_ID' => '',];
            \CSecurityFilterMask::Update($arFilterMask);
        }
        $this->errors = $DB->RunSQLBatch($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/' . $this->MODULE_ID . '/install/db/install.sql');
        if ($this->errors === false && \Bitrix\Main\Loader::includeModule('acrit.core')) {
            $this->errors = \Acrit\Core\Helper::runCoreSqlBatch('export/install.sql', $this->MODULE_ID);
        }
        if (is_array($this->errors)) {
            $APPLICATION->ThrowException(implode('<br>', $this->errors));
            return false;
        }
        return true;
    }

    function InstallEvents()
    {
        RegisterModuleDependences('main', 'OnBuildGlobalMenu', $this->MODULE_ID, 'CAcrit' . $this->_97845374 . 'Menu', 'OnBuildGlobalMenu');
        RegisterModuleDependences('main', 'OnEndBufferContent', $this->MODULE_ID, 'CAcrit' . $this->_97845374 . 'Remarketing', 'OnEndBufferContent');
        RegisterModuleDependences('main', 'OnEndBufferContent', $this->MODULE_ID, 'CAcrit' . $this->_97845374 . 'GoogleTagManager', 'OnEndBufferContent');
        RegisterModuleDependences($this->MODULE_ID, 'OnCondCatControlBuildList', $this->MODULE_ID, 'CAcritCatalogCondCtrlGroup', 'GetControlDescr', 100);
        RegisterModuleDependences($this->MODULE_ID, 'OnCondCatControlBuildList', $this->MODULE_ID, 'CAcritCatalogCondCtrlIBlockFields', 'GetControlDescr', 200);
        RegisterModuleDependences($this->MODULE_ID, 'OnCondCatControlBuildList', $this->MODULE_ID, 'CAcritCatalogCondCtrlIBlockProps', 'GetControlDescr', 300);
        return true;
    }

    function RegisterGadget()
    {
        $_583394875 = explode('.', $this->MODULE_ID);
        $_1070370708 = [toUpper($_583394875[1]) . '@' . time() => ['COLUMN' => 0, 'ROW' => 0, 'HIDE' => 'N',],];
        $_690364932 = \CUserOptions::getOption('intranet', '~gadgets_admin_index');
        if (is_array($_690364932[0]['GADGETS']) && !empty($_690364932[0]['GADGETS'])) {
            $_690364932[0]['GADGETS'] = array_merge($_1070370708, $_690364932[0]['GADGETS']);
        } else {
            $_690364932[0]['GADGETS'] = $_1070370708;
        }
        \CUserOptions::SetOption('intranet', '~gadgets_admin_index', $_690364932, false, false);
    }

    function DoUninstall()
    {
        global $APPLICATION, $DB, $DBType;
        if ($APPLICATION->GetGroupRight('main') < 'W') {
            return;
        }
        if (!\Bitrix\Main\Loader::includeModule('acrit.core')) {
            $APPLICATION->ThrowException(getMessage('ACRIT_' . $this->_867037812 . '_NO_CORE'));
            return false;
        }
        $GLOBALS['ACRIT_MODULE_ID'] = $this->MODULE_ID;
        $GLOBALS['ACRIT_MODULE_NAME'] = $this->MODULE_NAME;
        if ($_REQUEST['step'] < 2) {
            $APPLICATION->IncludeAdminFile(GetMessage('acrit.' . $this->_269256199 . '_UNINSTALL_TITLE'), $_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/' . $this->MODULE_ID . '/install/uninst_form.php');
        } elseif ($_REQUEST['step'] == 2) {
            global $APPLICATION;
            $this->UnRegisterGadget();
            $this->UnInstallEvents();
            $this->UnInstallFiles();
            if ($_REQUEST['savedata'] != 'Y') {
                $this->UnInstallDB();
            }
            \CAdminNotify::DeleteByModule($this->MODULE_ID);
            UnRegisterModule($this->MODULE_ID);
            $this->reset();
            $APPLICATION->IncludeAdminFile(GetMessage('acrit.' . $this->_269256199 . '_UNINSTALL_TITLE'), $_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/' . $this->MODULE_ID . '/install/uninst_mail.php');
        }
    }

    function UnRegisterGadget()
    {
        $_583394875 = explode('.', $this->MODULE_ID);
        $_1224451718 = ToUpper($_583394875[1]);
        $_690364932 = \CUserOptions::getOption('intranet', '~gadgets_admin_index');
        foreach ($_690364932[0]['GADGETS'] as $_878013893 => $_171703485) {
            if (stripos($_878013893, $_1224451718 . '@') !== false) {
                unset($_690364932[0]['GADGETS'][$_878013893]);
            }
        }
        \CUserOptions::SetOption('intranet', '~gadgets_admin_index', $_690364932, false, false);
    }

    function UnInstallEvents()
    {
        UnRegisterModuleDependences('main', 'OnBuildGlobalMenu', $this->MODULE_ID, 'CAcrit' . $this->_97845374 . 'Menu', 'OnBuildGlobalMenu');
        UnRegisterModuleDependences('main', 'OnEndBufferContent', $this->MODULE_ID, 'CAcrit' . $this->_97845374 . 'Remarketing', 'OnEndBufferContent');
        UnRegisterModuleDependences('main', 'OnEndBufferContent', $this->MODULE_ID, 'CAcrit' . $this->_97845374 . 'GoogleTagManager', 'OnEndBufferContent');
        UnRegisterModuleDependences($this->MODULE_ID, 'OnCondCatControlBuildList', $this->MODULE_ID, 'CAcritCatalogCondCtrlGroup', 'GetControlDescr');
        UnRegisterModuleDependences($this->MODULE_ID, 'OnCondCatControlBuildList', $this->MODULE_ID, 'CAcritCatalogCondCtrlIBlockFields', 'GetControlDescr');
        UnRegisterModuleDependences($this->MODULE_ID, 'OnCondCatControlBuildList', $this->MODULE_ID, 'CAcritCatalogCondCtrlIBlockProps', 'GetControlDescr');
        return true;
    }

    function UnInstallFiles()
    {
        global $DB, $DBType, $APPLICATION;
        if (is_dir($p = $_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/' . $this->MODULE_ID . '/admin')) {
            $_70108581 = str_replace('.', '_', $this->MODULE_ID);
            if ($dir = opendir($p)) {
                while (false !== ($item = readdir($dir))) {
                    if (($item == '..') || ($item == '.')) {
                        continue;
                    }
                    if (file_exists($_SERVER['DOCUMENT_ROOT'] . '/bitrix/admin/' . $_70108581 . '_' . $item)) {
                        unlink($_SERVER['DOCUMENT_ROOT'] . '/bitrix/admin/' . $_70108581 . '_' . $item);
                    }
                }
                closedir($dir);
            }
        }
        if (is_dir($p = $_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/' . $this->MODULE_ID . '/install/components')) {
            if ($dir = opendir($p)) {
                while (false !== ($item = readdir($dir))) {
                    if (($item == '..') || ($item == '.') || !is_dir($p0 = $p . '/' . $item)) {
                        continue;
                    }
                    $dir0 = opendir($p0);
                    while (false !== ($item0 = readdir($dir0))) {
                        if (($item0 == '..') || ($item0 == '.')) {
                            continue;
                        }
                        DeleteDirFilesEx('/bitrix/components/' . $item . '/' . $item0);
                    }
                    closedir($dir0);
                }
                closedir($dir);
            }
        }
        if (is_dir($p = $_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/' . $this->MODULE_ID . '/install/bitrix')) {
            if ($dir = opendir($p)) {
                while (false !== ($item = readdir($dir))) {
                    if (($item == '..') || ($item == '.')) {
                        continue;
                    }
                    if (file_exists($_SERVER['DOCUMENT_ROOT'] . '/bitrix/' . $item)) {
                        unlink($_SERVER['DOCUMENT_ROOT'] . '/bitrix/' . $item);
                    }
                }
                closedir($dir);
            }
        }
        if ($_ENV['COMPUTERNAME'] != 'BX') {
            DeleteDirFilesEx('/bitrix/js/acrit.' . $this->_269256199 . '/');
            DeleteDirFilesEx('/bitrix/gadgets/acrit/' . $this->_269256199 . '/');
            DeleteDirFilesEx('/bitrix/tools/acrit.' . $this->_269256199 . '/');
            DeleteDirFilesEx('/bitrix/themes/.default/acrit/' . $this->_269256199 . '/');
            DeleteDirFilesEx('/bitrix/themes/.default/acrit/' . $this->_269256199 . '/');
            DeleteDirFilesEx('/bitrix/themes/.default/acrit.' . $this->_269256199 . '.css');
            DeleteDirFilesEx('/upload/acrit_' . $this->_269256199 . '/');
            DeleteDirFiles($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/' . $this->MODULE_ID . '/install/components', $_SERVER['DOCUMENT_ROOT'] . '/bitrix/components/');
            foreach ($this->siteArray as $sireDir) {
                DeleteDirFiles($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/' . $this->MODULE_ID . '/install/public', $sireDir);
            }
            DeleteDirFiles($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/' . $this->MODULE_ID . '/install/admin', $_SERVER['DOCUMENT_ROOT'] . '/bitrix/admin/');
        }
        DeleteDirFilesEx('/upload/' . $this->_269256199 . '_log');
        DeleteDirFilesEx('/' . $this->MODULE_ID);
        return true;
    }

    function UninstallDB($arParams = [])
    {
        global $APPLICATION, $DB, $DBType;
        $this->errors = false;
        if (\Bitrix\Main\Loader::includeModule('security')) {
            $dbSecurityFilter = \CSecurityFilterMask::GetList();
            $acritMask = ['/bitrix/admin/acrit_' . $this->_269256199 . '_edit.php', '/bitrix/admin/acrit_' . $this->_269256199 . '_new_edit.php*'];
            $arFilterMask = [];
            while ($arSecurityFilter = $dbSecurityFilter->Fetch()) {
                if (!in_array($arSecurityFilter['FILTER_MASK'], $acritMask)) {
                    $arFilterMask[] = ['MASK' => $arSecurityFilter['FILTER_MASK'], 'SITE_ID' => $arSecurityFilter['SITE_ID'],];
                }
            }
            \CSecurityFilterMask::Update($arFilterMask);
        }
        if (\Bitrix\Main\Loader::includeModule('acrit.core')) {
            $this->errors = $DB->RunSQLBatch($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/' . $this->MODULE_ID . '/install/db/uninstall.sql');
            \Acrit\Core\Helper::runCoreSqlBatch('export/uninstall.sql', $this->MODULE_ID);
        }
        return true;
    }
} ?>