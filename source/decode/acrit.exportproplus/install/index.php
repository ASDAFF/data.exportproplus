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
        /*
        $_2074371326 = array('bitrix', ___266197681(69), ___266197681(70), ___266197681(71), $GLOBALS['____204040236'][8](___266197681(72)));
        $_768719049 = $_SERVER[___266197681(73)] . ___266197681(74) . $GLOBALS['____204040236'][9](___266197681(75), $_2074371326);
        $_297178107 = round(0 + 5 + 5 + 5);
        $_1025157776 = ___266197681(76);
        $_456368467 = $GLOBALS['____204040236'][10](___266197681(77), $GLOBALS['____204040236'][11]((235 * 2 - 470), (988 - 2 * 494), (1060 / 2 - 530), $GLOBALS['____204040236'][12](___266197681(78)), $GLOBALS['____204040236'][13](___266197681(79)) + $_297178107, $GLOBALS['____204040236'][14](___266197681(80))));
        $_745856752 = $GLOBALS['____204040236'][15](___266197681(81), $GLOBALS['____204040236'][16](min(164, 0, 54.666666666667), (219 * 2 - 438), (1352 / 2 - 676), $GLOBALS['____204040236'][17](___266197681(82)), $GLOBALS['____204040236'][18](___266197681(83)) + $_297178107, $GLOBALS['____204040236'][19](___266197681(84))));
        $_1548861056 = $GLOBALS['____204040236'][20](___266197681(85), $GLOBALS['____204040236'][21]((880 - 2 * 440), (880 - 2 * 440), (1036 / 2 - 518), $GLOBALS['____204040236'][22](___266197681(86)), $GLOBALS['____204040236'][23](___266197681(87)) + $_297178107, $GLOBALS['____204040236'][24](___266197681(88))));
        $_458278696 = ___266197681(89);
        $_774115590 = ___266197681(90) . $GLOBALS['____204040236'][25]($_456368467, round(0 + 0.2 + 0.2 + 0.2 + 0.2 + 0.2), round(0 + 0.2 + 0.2 + 0.2 + 0.2 + 0.2)) . $GLOBALS['____204040236'][26]($_1548861056, round(0 + 3), round(0 + 0.25 + 0.25 + 0.25 + 0.25)) . ___266197681(91) . $GLOBALS['____204040236'][27]($_745856752, (842 - 2 * 421), round(0 + 1)) . $GLOBALS['____204040236'][28]($_1548861056, round(0 + 0.5 + 0.5), round(0 + 0.25 + 0.25 + 0.25 + 0.25)) . ___266197681(92) . $GLOBALS['____204040236'][29]($_456368467, (141 * 2 - 282), round(0 + 0.25 + 0.25 + 0.25 + 0.25)) . ___266197681(93) . $GLOBALS['____204040236'][30]($_1548861056, (194 * 2 - 388), round(0 + 0.25 + 0.25 + 0.25 + 0.25)) . ___266197681(94) . $GLOBALS['____204040236'][31]($_1548861056, round(0 + 0.5 + 0.5 + 0.5 + 0.5), round(0 + 0.5 + 0.5)) . ___266197681(95) . $GLOBALS['____204040236'][32]($_745856752, round(0 + 0.5 + 0.5), round(0 + 0.5 + 0.5)) . ___266197681(96);
        $_1025157776 = $GLOBALS['____204040236'][33](___266197681(97)) . $GLOBALS['____204040236'][34](___266197681(98), $_1025157776, ___266197681(99));
        $_1346327850 = $GLOBALS['____204040236'][35]($_1025157776);
        $_1808186070 = (1088 / 2 - 544);
        for ($_56514546 = (175 * 2 - 350); $_56514546 < $GLOBALS['____204040236'][36]($_774115590); $_56514546++) {
            $_458278696 .= $GLOBALS['____204040236'][37]($GLOBALS['____204040236'][38]($_774115590[$_56514546]) ^ $GLOBALS['____204040236'][39]($_1025157776[$_1808186070]));
            if ($_1808186070 == $_1346327850 - round(0 + 1)) $_1808186070 = (870 - 2 * 435); else $_1808186070 = $_1808186070 + round(0 + 1);
        }
        $_458278696 = ___266197681(100) . ___266197681(101) . 'define("acrit_exportproplus_TEMPORARY_CACHE", "' . $GLOBALS['____204040236'][40]($_458278696) . '");' . ___266197681(104) . ___266197681(105);
        CheckDirPath($_768719049);
        if (!$GLOBALS['____204040236'][41]($_768719049)) {
            $_591591659 = @$GLOBALS['____204040236'][42]($_768719049, 'w');
            @$GLOBALS['____204040236'][43]($_591591659, $_458278696);
            @$GLOBALS['____204040236'][44]($_591591659);
        }
        $_1355117449 = 'drm_stergokc';
        $_1676249431 = $GLOBALS[___266197681(108)]->Query(___266197681(109) . $GLOBALS['____204040236'][45](___266197681(110), ___266197681(111), $GLOBALS['____204040236'][46]($_1355117449, round(0 + 0.66666666666667 + 0.66666666666667 + 0.66666666666667), round(0 + 1.3333333333333 + 1.3333333333333 + 1.3333333333333))) . "op_date' AND MODULE_ID='acrit.exportproplus'", true);
        if ($_1676249431 !== False) {
            $_1675418071 = false;
            if ($_1733640589 = $_1676249431->Fetch()) $_1675418071 = true;
            if (!$_1675418071) {
                $_297178107 = round(0 + 7.5 + 7.5);
                $_598066268 = ___266197681(114);
                $_456368467 = $GLOBALS['____204040236'][48](___266197681(115), $GLOBALS['____204040236'][49]((211 * 2 - 422), (948 - 2 * 474), (218 * 2 - 436), $GLOBALS['____204040236'][50](___266197681(116)), $GLOBALS['____204040236'][51](___266197681(117)) + $_297178107, $GLOBALS['____204040236'][52](___266197681(118))));
                $_745856752 = $GLOBALS['____204040236'][53](___266197681(119), $GLOBALS['____204040236'][54](min(20, 0, 6.6666666666667), min(118, 0, 39.333333333333), (804 - 2 * 402), $GLOBALS['____204040236'][55](___266197681(120)), $GLOBALS['____204040236'][56](___266197681(121)) + $_297178107, $GLOBALS['____204040236'][57](___266197681(122))));
                $_1548861056 = $GLOBALS['____204040236'][58](___266197681(123), $GLOBALS['____204040236'][59]((1408 / 2 - 704), (1352 / 2 - 676), (926 - 2 * 463), $GLOBALS['____204040236'][60](___266197681(124)), $GLOBALS['____204040236'][61](___266197681(125)) + $_297178107, $GLOBALS['____204040236'][62](___266197681(126))));
                $_458278696 = ___266197681(127);
                $_774115590 = ___266197681(128) . $GLOBALS['____204040236'][63]($_456368467, (896 - 2 * 448), round(0 + 0.25 + 0.25 + 0.25 + 0.25)) . ___266197681(129) . $GLOBALS['____204040236'][64]($_745856752, round(0 + 1), round(0 + 1)) . ___266197681(130) . $GLOBALS['____204040236'][65]($_745856752, (249 * 2 - 498), round(0 + 1)) . $GLOBALS['____204040236'][66]($_1548861056, round(0 + 0.5 + 0.5 + 0.5 + 0.5), round(0 + 0.2 + 0.2 + 0.2 + 0.2 + 0.2)) . ___266197681(131) . $GLOBALS['____204040236'][67]($_1548861056, min(34, 0, 11.333333333333), round(0 + 0.33333333333333 + 0.33333333333333 + 0.33333333333333)) . ___266197681(132) . $GLOBALS['____204040236'][68]($_1548861056, round(0 + 1.5 + 1.5), round(0 + 0.2 + 0.2 + 0.2 + 0.2 + 0.2)) . ___266197681(133) . $GLOBALS['____204040236'][69]($_456368467, round(0 + 0.25 + 0.25 + 0.25 + 0.25), round(0 + 1)) . ___266197681(134) . $GLOBALS['____204040236'][70]($_1548861056, round(0 + 0.25 + 0.25 + 0.25 + 0.25), round(0 + 0.25 + 0.25 + 0.25 + 0.25));
                $_598066268 = $GLOBALS['____204040236'][71](___266197681(135) . $_598066268, (235 * 2 - 470), -round(0 + 1.25 + 1.25 + 1.25 + 1.25)) . ___266197681(136);
                $_1121460806 = $GLOBALS['____204040236'][72]($_598066268);
                $_1808186070 = (950 - 2 * 475);
                for ($_56514546 = (178 * 2 - 356); $_56514546 < $GLOBALS['____204040236'][73]($_774115590); $_56514546++) {
                    $_458278696 .= $GLOBALS['____204040236'][74]($GLOBALS['____204040236'][75]($_774115590[$_56514546]) ^ $GLOBALS['____204040236'][76]($_598066268[$_1808186070]));
                    if ($_1808186070 == $_1121460806 - round(0 + 0.25 + 0.25 + 0.25 + 0.25)) $_1808186070 = min(140, 0, 46.666666666667); else $_1808186070 = $_1808186070 + round(0 + 0.33333333333333 + 0.33333333333333 + 0.33333333333333);
                }
                $GLOBALS[___266197681(137)]->Query("INSERT INTO b_option (MODULE_ID, NAME, VALUE) VALUES('acrit.exportproplus', '" . sprintf("%s%s", "~bs", substr($_1355117449, 2, 4)) . $GLOBALS['____204040236'][79](___266197681(141)) . ___266197681(142) . $GLOBALS[___266197681(143)]->ForSql($GLOBALS['____204040236'][80]($_458278696), min(154, 0, 51.333333333333)) . "')", True);
                if ($GLOBALS['____204040236'][81]($GLOBALS[___266197681(145)])) $GLOBALS["CACHE_MANAGER"]->Clean('b_option');
            }
        } */





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