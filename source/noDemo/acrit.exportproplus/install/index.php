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
    private $_1326577262 = ['utf-8' => 'utf8', 'UTF-8' => 'utf8', 'WINDOWS-1251' => 'cp1251', 'windows-1251' => 'cp1251',];

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
        $_1722886076 = \Bitrix\Main\Application::getInstance();
        $_1565144168 = \Bitrix\Main\SiteTable::getList();
        while ($_935681985 = $_1565144168->Fetch()) {
            if (!$_935681985['DOC_ROOT']) $this->_997989597[$_935681985['LID']] = $_1722886076->getDocumentRoot() . $_935681985['DIR']; else {
                $this->_997989597[$_935681985['LID']] = $_935681985['DOC_ROOT'];
            }
            $this->_997989597[$_935681985['LID']] = \Bitrix\Main\IO\Path::normalize($this->_997989597[$_935681985['LID']]);
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
                \Acrit\Core\Helper::startBitrixCloudMonitoring('admin@acrit.ru');
                $_2130876983 = \Acrit\Core\Cli::getPhpPath();
                if (strlen($_2130876983)) {
                    \Bitrix\Main\Config\Option::set($this->MODULE_ID, 'php_path', $_2130876983);
                }
            }
            $_1675345452 = new \CUrlRewriter();
            foreach ($this->_997989597 as $_84438248 => $_1376128280) {
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

    function InstallFiles($_261457188 = [])
    {
        global $DB, $DBType, $APPLICATION;
        if (is_dir($_599757263 = $_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/' . $this->MODULE_ID . '/admin')) {
            if ($_139523034 = opendir($_599757263)) {
                while (false !== ($_196259126 = readdir($_139523034))) {
                    if (in_array($_196259126, ['.', '..', 'menu.php', 'tabs', 'new'])) {
                        continue;
                    }
                    file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/bitrix/admin/acrit_' . $this->_269256199 . '_' . $_196259126, '' . $this->MODULE_ID . '/admin/' . $_196259126 . '");?>');
                }
                closedir($_139523034);
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
            foreach ($this->_997989597 as $_1376128280) {
                CopyDirFiles($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/' . $this->MODULE_ID . '/install/public', $_1376128280, true, true);
            }
        }
        return true;
    }

    function InstallDB($_261457188 = [])
    {
        global $APPLICATION, $DB, $DBType;
        if (\Bitrix\Main\Loader::includeModule('security')) {
            $_1514107607 = \CSecurityFilterMask::GetList();
            $_232453927 = [];
            while ($_264167126 = $_1514107607->Fetch()) {
                $_232453927[] = ['MASK' => $_264167126['FILTER_MASK'], 'SITE_ID' => $_264167126['SITE_ID'],];
            }
            $_232453927[] = ['MASK' => '/bitrix/admin/acrit_' . $this->_269256199 . '_edit.php', 'SITE_ID' => '',];
            $_232453927[] = ['MASK' => '/bitrix/admin/acrit_' . $this->_269256199 . '_new_edit.php*', 'SITE_ID' => '',];
            \CSecurityFilterMask::Update($_232453927);
        }
        $this->_945354433 = $DB->RunSQLBatch($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/' . $this->MODULE_ID . '/install/db/install.sql');
        if ($this->_945354433 === false && \Bitrix\Main\Loader::includeModule('acrit.core')) {
            $this->_945354433 = \Acrit\Core\Helper::runCoreSqlBatch('export/install.sql', $this->MODULE_ID);
        }
        if (is_array($this->_945354433)) {
            $APPLICATION->ThrowException(implode('<br>', $this->_945354433));
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
        if (is_dir($_599757263 = $_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/' . $this->MODULE_ID . '/admin')) {
            $_70108581 = str_replace('.', '_', $this->MODULE_ID);
            if ($_139523034 = opendir($_599757263)) {
                while (false !== ($_196259126 = readdir($_139523034))) {
                    if (($_196259126 == '..') || ($_196259126 == '.')) {
                        continue;
                    }
                    if (file_exists($_SERVER['DOCUMENT_ROOT'] . '/bitrix/admin/' . $_70108581 . '_' . $_196259126)) {
                        unlink($_SERVER['DOCUMENT_ROOT'] . '/bitrix/admin/' . $_70108581 . '_' . $_196259126);
                    }
                }
                closedir($_139523034);
            }
        }
        if (is_dir($_599757263 = $_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/' . $this->MODULE_ID . '/install/components')) {
            if ($_139523034 = opendir($_599757263)) {
                while (false !== ($_196259126 = readdir($_139523034))) {
                    if (($_196259126 == '..') || ($_196259126 == '.') || !is_dir($_1419399555 = $_599757263 . '/' . $_196259126)) {
                        continue;
                    }
                    $_1012131558 = opendir($_1419399555);
                    while (false !== ($_786890750 = readdir($_1012131558))) {
                        if (($_786890750 == '..') || ($_786890750 == '.')) {
                            continue;
                        }
                        DeleteDirFilesEx('/bitrix/components/' . $_196259126 . '/' . $_786890750);
                    }
                    closedir($_1012131558);
                }
                closedir($_139523034);
            }
        }
        if (is_dir($_599757263 = $_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/' . $this->MODULE_ID . '/install/bitrix')) {
            if ($_139523034 = opendir($_599757263)) {
                while (false !== ($_196259126 = readdir($_139523034))) {
                    if (($_196259126 == '..') || ($_196259126 == '.')) {
                        continue;
                    }
                    if (file_exists($_SERVER['DOCUMENT_ROOT'] . '/bitrix/' . $_196259126)) {
                        unlink($_SERVER['DOCUMENT_ROOT'] . '/bitrix/' . $_196259126);
                    }
                }
                closedir($_139523034);
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
            foreach ($this->_997989597 as $_1376128280) {
                DeleteDirFiles($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/' . $this->MODULE_ID . '/install/public', $_1376128280);
            }
            DeleteDirFiles($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/' . $this->MODULE_ID . '/install/admin', $_SERVER['DOCUMENT_ROOT'] . '/bitrix/admin/');
        }
        DeleteDirFilesEx('/upload/' . $this->_269256199 . '_log');
        DeleteDirFilesEx('/' . $this->MODULE_ID);
        return true;
    }

    function UninstallDB($_261457188 = [])
    {
        global $APPLICATION, $DB, $DBType;
        $this->_945354433 = false;
        if (\Bitrix\Main\Loader::includeModule('security')) {
            $_1514107607 = \CSecurityFilterMask::GetList();
            $_836166561 = ['/bitrix/admin/acrit_' . $this->_269256199 . '_edit.php', '/bitrix/admin/acrit_' . $this->_269256199 . '_new_edit.php*'];
            $_232453927 = [];
            while ($_264167126 = $_1514107607->Fetch()) {
                if (!in_array($_264167126['FILTER_MASK'], $_836166561)) {
                    $_232453927[] = ['MASK' => $_264167126['FILTER_MASK'], 'SITE_ID' => $_264167126['SITE_ID'],];
                }
            }
            \CSecurityFilterMask::Update($_232453927);
        }
        if (\Bitrix\Main\Loader::includeModule('acrit.core')) {
            $this->_945354433 = $DB->RunSQLBatch($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/' . $this->MODULE_ID . '/install/db/uninstall.sql');
            \Acrit\Core\Helper::runCoreSqlBatch('export/uninstall.sql', $this->MODULE_ID);
        }
        return true;
    }
} ?>