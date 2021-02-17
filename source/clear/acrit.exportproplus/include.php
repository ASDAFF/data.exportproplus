<?

use Acrit\Core\Helper;

$_445730901 = end(explode('/', str_replace('\\', '/', pathinfo(__FILE__, PATHINFO_DIRNAME))));
$_565738227 = toUpper(preg_replace('#^.*?\.(.*?)$#', '$1', $_445730901));
define('ACRIT_CORE', 'acrit.core');
IncludeModuleLangFile(__FILE__);
if (\Bitrix\Main\Loader::includeModule('acrit.core')) {
    $_288983588 = ['CrmProfilesTable', 'ProfileTable', 'ProfileIBlockTable', 'ProfileFieldTable', 'ProfileValueTable', 'AdditionalFieldTable', 'CategoryCustomNameTable', 'CategoryRedefinitionTable', 'ExportDataTable', 'ExternalIdTable', 'HistoryTable', 'ProfileFieldFeature', 'Backup',];
    Helper::setModuleAutoloadClasses($_445730901, $_288983588, __NAMESPACE__);
    $GLOBALS['ACRIT_' . $_565738227 . '_AUTOLOAD_CLASSES'] =& $_288983588;
    if (Helper::getOption($_445730901, 'disable_old_core') == 'Y') {
        return;
    }
}
IncludeModuleLangFile(__FILE__);
global $DBType;
$arClasses = array(
    'CExportproplusProfileDB' => 'classes/mysql/cexportproplusprofiledb.php',
    'CExportproplusMarketDB' => 'classes/mysql/cexportpropluspro_marketdb.php',
    'CExportproplusMarketTiuDB' => 'classes/mysql/cexportpropluspro_markettiudb.php',
    'CExportproplusMarketPromuaDB' => 'classes/mysql/cexportpropluspro_marketpromuadb.php',
    'CExportproplusMarketMailruDB' => 'classes/mysql/cexportpropluspro_marketmailrudb.php',

    'CExportproplusProfile' => 'classes/general/cexportproplusprofile.php',
    'CExportproplusVariant' => 'classes/general/cexportproplusprofile.php',

    'CAcritGlobalCondCtrl' => 'classes/general/cexportpropluscond.php',
    'CAcritGlobalCondCtrlComplex' => 'classes/general/cexportpropluscond.php',
    'CAcritGlobalCondCtrlAtoms' => 'classes/general/cexportpropluscond.php',
    'CAcritGlobalCondCtrlGroup' => 'classes/general/cexportpropluscond.php',
    'CAcritGlobalCondTree' => 'classes/general/cexportpropluscond.php',
    'CAcritCatalogCondCtrl' => 'classes/general/cexportpropluscond.php',
    'CAcritCatalogCondCtrlComplex' => 'classes/general/cexportpropluscond.php',
    'CAcritCatalogCondCtrlGroup' => 'classes/general/cexportpropluscond.php',
    'CAcritCatalogCondCtrlIBlockFields' => 'classes/general/cexportpropluscond.php',
    'CAcritCatalogCondCtrlIBlockProps' => 'classes/general/cexportpropluscond.php',
    'CAcritCatalogCondTree' => 'classes/general/cexportpropluscond.php',

    'CAcritExportproplusCatalog' => 'classes/general/cexportproplusfilter.php',
    'CAcritExportproplusPrices' => 'classes/general/cexportproplusfilter.php',
    'CAcritExportproplusProps' => 'classes/general/cexportproplusfilter.php',
    'CAcritExportproplusCatalogCond' => 'classes/general/cexportproplusfilter.php',

    'CAcritExportproplusLog' => 'classes/general/cexportpropluslog.php',
    'AcritExportproplusSession' => 'classes/general/cexportproplussession.php',
    'CAcritExportproplusUrlRewrite' => 'classes/general/cexportproplusurlrewrite.php',

    'CAcritExportproplusTools' => 'classes/general/cexportproplustools.php',
    'CAcritExportproplusStringProcess' => 'classes/general/cexportproplustools.php',
    'CAcritExportproplusMarketCategories' => 'classes/general/cexportproplustools.php',

    'CAcritExportproplusExport' => 'classes/general/cexportproplusexport.php',
    'CExportproplusAgent' => 'classes/general/cexportproplusagent.php',
    'CExportproplusInformer' => 'classes/general/cexportproplusinformer.php',
    'CExportproplusMarketEbayDB' => 'classes/mysql/cexportpropluspro_marketebaydb.php',

    'Threads' => 'classes/general/threads.php',
    'ThreadsSession' => 'classes/general/threads.php',
    'CExportproplusOzon' => 'classes/general/ozon.php',
    'OdnoklassnikiSDK' => 'classes/general/odnoklassniki_sdk.php',

    'CAcritExportproplusVkTools' => 'classes/general/cexportproplusvktools.php',
    'CAcritExportproplusFbTools' => 'classes/general/cexportproplusfbtools.php',
    'CAcritExportproplusOkTools' => 'classes/general/cexportproplusoktools.php',
    'CAcritExportproplusInstagramTools' => 'classes/general/cexportproplusinstagramtools.php',
);

CModule::AddAutoloadClasses('acrit.exportproplus', $arClasses);

class CAcritExportproplusMenu
{
    public function OnBuildGlobalMenu(&$aGlobalMenu, &$aModuleMenu)
    {
        global $USER, $APPLICATION, $adminMenu, $adminPage;
        if (\Bitrix\Main\Config\Option::get('acrit.exportproplus', 'disable_old_core') == 'Y') {
            return;
        }
        if (is_array($adminMenu->aGlobalMenu) && key_exists('global_menu_acrit', $adminMenu->aGlobalMenu)) {
            return;
        }
        $gName = COption::GetOptionString('acrit.exportproplus', 'acritmenu_groupname');
        if (strlen(trim($gName)) <= 0) {
            $gName = GetMessage('ACRITMENU_GROUPNAME_DEFAULT');
        }
        $aMenu = array(
            'menu_id' => 'acrit',
            'sort' => 150,
            'text' => $gName,
            'title' => GetMessage('ACRIT_MENU_TITLE'),
            'icon' => 'clouds_menu_icon',
            'page_icon' => 'clouds_page_icon',
            'items_id' => 'global_menu_acrit',
            'items' => array()
        );
        $aGlobalMenu['global_menu_acrit'] = $aMenu;
    }
}

class CAcritExportproplusElement
{
    public $profile = null;
    public $DEMO = 2;
    public $isDemo = true;
    public $DEMO_CNT;
    public $MODULEID = "acrit.exportproplus";
    public $stepElements = 50;
    public $dateFields = array();
    public $_1191875341 = array();
    public $_940439577;
    public $log;
    public $_317570903;
    public $_1294848254;
    public $_2021795626;
    public $_1500291233;
    public $_360787538;
    public $_488061881;
    public $_116831045;
    public $_112131147;
    public $dbRes;
    public $_1735599212;
    public $_2046460632;
    protected $_1330835753 = array("utf8" => "utf-8", "cp1251" => "windows-1251",);

    public function __construct($profile)
    {
        global $APPLICATION;
        $this->_1717979731 = @CModule::IncludeModule('iblock');
        $this->_398863350 = @CModule::IncludeModule('highloadblock');
        $this->_242106918 = @CModule::IncludeModule('sale');
        $this->_1768427482 = @CModule::IncludeModule('catalog');
        $this->DEMO = CModule::IncludeModuleEx($this->MODULEID);
        if ($this->DEMO == 1) {
            $this->isDemo = false;
        }
        $this->_1418746172 = 50;
        $this->profile = $profile;
        $this->dbRes = new CExportproplusProfileDB();
        $this->_1735599212 = new CExportproplusProfile();
        $this->profile['PROFILE_CATEGORIES'] = $this->_1735599212->GetSections($this->profile['IBLOCK_ID'], $this->profile['CHECK_INCLUDE'] == 'Y', true);
        $this->_1500291233 = new CAcritExportproplusVkTools($profile);
        $this->_2021795626 = false;
        if (($this->profile['TYPE'] == 'ozon_api') || ($this->profile['TYPE'] == 'vk_trade') || ($this->profile['TYPE'] == 'fb_trade') || ($this->profile['TYPE'] == 'instagram_trade') || ($this->profile['TYPE'] == 'ok_trade')) {
            $this->_2021795626 = true;
        }
        if ($profile['TYPE'] == 'ozon_api') {
            $this->_112131147 = new CExportproplusOzon($profile['OZON_APPID'], $profile['OZON_APPKEY']);
        }
        $this->_360787538 = new CAcritExportproplusOkTools($profile);
        $this->_488061881 = new CAcritExportproplusInstagramTools($profile);
        $this->_116831045 = new CAcritExportproplusFb($profile);
        if (intval($this->profile['SETUP']['EXPORT_STEP']) > 0) $this->stepElements = $this->profile['SETUP']['EXPORT_STEP'];
        $this->_15755796 = array('TIMESTAMP_X', 'DATE_CREATE', 'DATE_ACTIVE_FROM', 'DATE_ACTIVE_TO');
        $this->_1191875341 = array('advantshop', 'pulscen_csv', 'ym_simple_csv');
        $this->_940439577 = new CAcritExportproplusLog($this->profile['ID']);
        $this->_317570903 = 'Y-m-dTh:i:s±h:i';
        $_1136836731 = CAcritExportproplusTools::GetStringCharset($this->_317570903);
        if ($_1136836731 == 'cp1251') {
            $this->_317570903 = $APPLICATION->ConvertCharset($this->_317570903, 'windows-1251', 'UTF-8');
        }
        $_827311422 = ($this->profile['DATEFORMAT'] == $this->_317570903) ? CAcritExportproplusTools::GetYandexDateTime(date('d.m.Y H:i:s')) : date(str_replace('_', ' ', $this->profile['DATEFORMAT']), time());
        $this->_12750998 = array('#ENCODING#' => $this->_1330835753[$this->profile['ENCODING']], '#SHOP_NAME#' => $this->profile['SHOPNAME'], '#COMPANY_NAME#' => $this->profile['COMPANY'], '#SITE_URL#' => $this->profile['SITE_PROTOCOL'] . '://' . $this->profile['DOMAIN_NAME'], '#PROFILE_DESCRIPTION#' => $this->profile['DESCRIPTION'], '#DATE#' => $_827311422,);
        $this->_1294848254 = CAcritExportproplusTools::GetProcessPriceId($this->profile);
        if (($this->profile['TYPE'] == 'tiu_standart') || ($this->profile['TYPE'] == 'tiu_standart_vendormodel')) {
            $_514197488 = new CExportproplusMarketTiuDB();
        } elseif ($this->profile['TYPE'] == 'ua_prom_ua') {
            $_514197488 = new CExportproplusMarketPromuaDB();
        } elseif ($this->profile['TYPE'] == 'mailru' || $this->profile['TYPE'] == 'mailru_clothing') {
            $_514197488 = new CExportproplusMarketMailruDB();
        } else {
            $_514197488 = new CExportproplusMarketDB();
        }
        $this->_2046460632 = $_514197488->GetMarketList($this->profile['MARKET_CATEGORY']['CATEGORY']);
    }

    public function GetElementCount()
    {
        return $this->_672194824;
    }

    public function CalcProcessXMLLoadingByOneProduct()
    {
        $_1736671340 = getmicrotime();
        $_1461419195 = self::PrepareProcess();
        if (!is_object($_1461419195)) return false;
        $_243855875 = AcritExportproplusSession::GetSession($this->profile['ID']);
        $_243855875['EXPORTPROPLUS']['LOG'][$this->profile['ID']]['STEPS'] = $this->isDemo ? 1 : $_1461419195->_1235249829;
        AcritExportproplusSession::SetSession($this->profile['ID'], $_243855875);
        while ($_485935950 = $_1461419195->GetNextElement()) {
            $_11678077 = array();
            $_1799584481 = $this->__705054251($_485935950);
            if (!$_1799584481) continue;
            if ($this->profile['USE_IBLOCK_CATEGORY'] == 'Y') {
                $_982944057 = $_1799584481['IBLOCK_ID'];
            } elseif ($this->profile['USE_IBLOCK_PRODUCT_CATEGORY'] == 'Y') {
                $_982944057 = $_1799584481['IBLOCK_PRODUCT_SECTION_ID'];
            } else {
                $_982944057 = $_1799584481['IBLOCK_SECTION_ID'];
            }
            if (CAcritExportproplusTools::isVariant($this->profile, $_982944057)) {
                if (!$_1799584481['SKIP']) {
                    $_11678077[$_1799584481['ITEM'][$_1525266428]][] = $_1799584481;
                }
                $_1799584481 = $_1799584481['ITEM'];
            }
            unset($_1799584481);
        }
        unset($_485935950, $_1799584481);
        CAcritExportproplusTools::SaveCurrencies($this->profile, $this->_1364486914);
        return round(getmicrotime() - $_1736671340, 3);
    }

    public function PrepareProcess($_1634919591 = 1, $_341676656 = false)
    {
        if ($_1634919591 == 1) {
            $this->_940439577->Init($this->profile);
            $this->_1634919591 = $_1634919591;
        }
        $this->_2112071826 = CExportproplusProfile::LoadCurrencyRates();
        $_954971976 = $this->PrepareIBlock();
        if (empty($_954971976)) {
            return true;
        }
        $_275052511 = GetMessage('ACRIT_EXPORTPROPLUS_A_AA_A');
        preg_match_all('/.*(<[\w\d_-]+).*(#[\w\d_-]+:*[\w\d_-]+#).*(<\/.+>)/', $this->profile['OFFER_TEMPLATE'], $this->_547888680);
        preg_match_all('/(#[\w\d_-]+:*[\w\d_-]+#)/', $this->profile['OFFER_TEMPLATE'], $this->_547888680['ALL_TAGS']);
        $this->_1325327767 = array();
        foreach ($this->_547888680['ALL_TAGS'][0] as $_1442734221) {
            $this->_1325327767[$_1442734221] = '';
        }
        $this->_1325327767['#MARKET_CATEGORY#'] = '';
        $this->_845490442 = array('ID' => array());
        $this->_1931809273 = array();
        foreach ($this->profile['XMLDATA'] as $_1639684675) {
            if (!empty($_1639684675['VALUE']) || !empty($_1639684675['CONTVALUE_FALSE']) || !empty($_1639684675['CONTVALUE_TRUE']) || !empty($_1639684675['COMPLEX_TRUE_VALUE']) || !empty($_1639684675['COMPLEX_FALSE_VALUE']) || !empty($_1639684675['COMPLEX_TRUE_CONTVALUE']) || !empty($_1639684675['COMPLEX_FALSE_CONTVALUE']) || ($_1639684675['TYPE'] == 'composite') || ($_1639684675['TYPE'] == 'arithmetics') || ($_1639684675['TYPE'] == 'stack')) {
                if ($_1639684675['TYPE'] == 'composite') {
                    foreach ($_1639684675['COMPOSITE_TRUE'] as $_628180431 => $_111434879) {
                        if ($_111434879['COMPOSITE_TRUE_TYPE'] == 'field') {
                            $_47247544 = explode('-', $_111434879['COMPOSITE_TRUE_VALUE']);
                            switch (count($_47247544)) {
                                case 1:
                                    $this->_1020535029[] = $_47247544[0];
                                    break;
                                case 2:
                                    $this->_1931809273[] = $_47247544[1];
                                    break;
                                case 3:
                                    $this->_845490442['ID'][] = $_47247544[2];
                                    break;
                            }
                        }
                    }
                    foreach ($_1639684675['COMPOSITE_FALSE'] as $_628180431 => $_111434879) {
                        if ($_111434879['COMPOSITE_FALSE_TYPE'] == 'field') {
                            $_47247544 = explode('-', $_111434879['COMPOSITE_FALSE_VALUE']);
                            switch (count($_47247544)) {
                                case 1:
                                    $this->_1020535029[] = $_47247544[0];
                                    break;
                                case 2:
                                    $this->_1931809273[] = $_47247544[1];
                                    break;
                                case 3:
                                    $this->_845490442['ID'][] = $_47247544[2];
                                    break;
                            }
                        }
                    }
                } elseif ($_1639684675['TYPE'] == 'arithmetics') {
                    foreach ($_1639684675['ARITHMETICS_TRUE'] as $_1630858607 => $_1528140672) {
                        if ($_1528140672['ARITHMETICS_TRUE_TYPE'] == 'field') {
                            $_47247544 = explode('-', $_1528140672['ARITHMETICS_TRUE_VALUE']);
                            switch (count($_47247544)) {
                                case 1:
                                    $this->_1020535029[] = $_47247544[0];
                                    break;
                                case 2:
                                    $this->_1931809273[] = $_47247544[1];
                                    break;
                                case 3:
                                    $this->_845490442['ID'][] = $_47247544[2];
                                    break;
                            }
                        }
                    }
                    foreach ($_1639684675['ARITHMETICS_FALSE'] as $_1630858607 => $_1528140672) {
                        if ($_1528140672['ARITHMETICS_FALSE_TYPE'] == 'field') {
                            $_47247544 = explode('-', $_1528140672['ARITHMETICS_FALSE_VALUE']);
                            switch (count($_47247544)) {
                                case 1:
                                    $this->_1020535029[] = $_47247544[0];
                                    break;
                                case 2:
                                    $this->_1931809273[] = $_47247544[1];
                                    break;
                                case 3:
                                    $this->_845490442['ID'][] = $_47247544[2];
                                    break;
                            }
                        }
                    }
                } elseif ($_1639684675['TYPE'] == 'stack') {
                    foreach ($_1639684675['STACK_TRUE'] as $_845292619 => $_279295239) {
                        if ($_279295239['STACK_TRUE_TYPE'] == 'field') {
                            $_47247544 = explode('-', $_279295239['STACK_TRUE_VALUE']);
                            switch (count($_47247544)) {
                                case 1:
                                    $this->_1020535029[] = $_47247544[0];
                                    break;
                                case 2:
                                    $this->_1931809273[] = $_47247544[1];
                                    break;
                                case 3:
                                    $this->_845490442['ID'][] = $_47247544[2];
                                    break;
                            }
                        }
                    }
                    foreach ($_1639684675['STACK_FALSE'] as $_845292619 => $_279295239) {
                        if ($_279295239['STACK_FALSE_TYPE'] == 'field') {
                            $_47247544 = explode('-', $_279295239['STACK_FALSE_VALUE']);
                            switch (count($_47247544)) {
                                case 1:
                                    $this->_1020535029[] = $_47247544[0];
                                    break;
                                case 2:
                                    $this->_1931809273[] = $_47247544[1];
                                    break;
                                case 3:
                                    $this->_845490442['ID'][] = $_47247544[2];
                                    break;
                            }
                        }
                    }
                } else {
                    if ($_1639684675['TYPE'] == 'field') {
                        $_1757453782 = $_1639684675['VALUE'];
                        $_47247544 = explode('-', $_1757453782);
                        switch (count($_47247544)) {
                            case 1:
                                $this->_1020535029[] = $_47247544[0];
                                break;
                            case 2:
                                $this->_1931809273[] = $_47247544[1];
                                break;
                            case 3:
                                $this->_845490442['ID'][] = $_47247544[2];
                                break;
                        }
                    } elseif ($_1639684675['TYPE'] == 'complex') {
                        $_1757453782 = $_1639684675['COMPLEX_TRUE_VALUE'];
                        $_47247544 = explode('-', $_1757453782);
                        switch (count($_47247544)) {
                            case 1:
                                $this->_1020535029[] = $_47247544[0];
                                break;
                            case 2:
                                $this->_1931809273[] = $_47247544[1];
                                break;
                            case 3:
                                $this->_845490442['ID'][] = $_47247544[2];
                                break;
                        }
                        $_1757453782 = $_1639684675['COMPLEX_FALSE_VALUE'];
                        $_47247544 = explode('-', $_1757453782);
                        switch (count($_47247544)) {
                            case 1:
                                $this->_1020535029[] = $_47247544[0];
                                break;
                            case 2:
                                $this->_1931809273[] = $_47247544[1];
                                break;
                            case 3:
                                $this->_845490442['ID'][] = $_47247544[2];
                                break;
                        }
                    }
                    if (isset($_1639684675['MINIMUM_OFFER_PRICE']) && ($_1639684675['MINIMUM_OFFER_PRICE'] == 'Y')) {
                        $_589631444['DELAY'] = true;
                    }
                }
                if ($_1639684675['CONDITION']['CHILDREN']) {
                    if (!function_exists(findChildren)) {
                        function findChildren($_627188624)
                        {
                            $_257451773 = array();
                            foreach ($_627188624 as $_1383715979) {
                                if (strstr($_1383715979['CLASS_ID'], 'CondIBProp')) {
                                    $_896652823 = explode(':', $_1383715979['CLASS_ID']);
                                    $_257451773[] = $_896652823[2];
                                }
                                if ($_1383715979['CHILDREN']) {
                                    $_257451773 = array_merge($_257451773, findChildren($_1383715979['CHILDREN']));
                                }
                            }
                            return $_257451773;
                        }
                    }
                    $this->_845490442['ID'] = array_merge($this->_845490442['ID'], findChildren($_1639684675['CONDITION']['CHILDREN']));
                }
            }
            if ($_1639684675['EVAL_FILTER']) {
                preg_match_all('/.*?PROPERTY_(\d+)|(CATALOG_PRICE_[\d]+_WD|CATALOG_PRICE_[\d]+_D).*?/', $this->profile['EVAL_FILTER'], $_1263637527);
                if (is_array($_1263637527[1])) {
                    $this->_845490442['ID'] = array_merge($this->_845490442['ID'], $_1263637527[1]);
                }
                if (is_array($_1263637527[2])) {
                    $this->_1931809273 = array_merge($this->_1931809273, $_1263637527[2]);
                }
            }
        }
        preg_match_all('/.*?PROPERTY_(\d+)|(CATALOG_PRICE_[\d]+_WD|CATALOG_PRICE_[\d]+_D).*?/', $this->profile['EVAL_FILTER'], $_1263637527);
        if (is_array($_1263637527[1])) {
            $this->_845490442['ID'] = array_merge($this->_845490442['ID'], $_1263637527[1]);
        }
        if (is_array($_1263637527[2])) {
            $this->_1931809273 = array_merge($this->_1931809273, $_1263637527[2]);
        }
        $dbEvents = GetModuleEvents('acrit.exportproplus', 'OnBeforePropertiesSelect');
        $_1892215348 = array();
        while ($_257451012 = $dbEvents->Fetch()) {
            ExecuteModuleEventEx($_257451012, array(array('ID' => $this->profile['ID'], 'CODE' => $this->profile['CODE'], 'NAME' => $this->profile['NAME']), &$_1892215348));
        }
        foreach ($_1892215348 as $_47247544) {
            if (is_array($_47247544)) {
                foreach ($_47247544 as $_504799882) {
                    $_470119335 = explode('-', $_504799882);
                    if (count($_470119335) == 3) {
                        $this->_845490442['ID'][] = $_470119335[2];
                    }
                }
            } else {
                $_470119335 = explode('-', $_47247544);
                if (count($_470119335) == 3) {
                    $this->_845490442['ID'][] = $_470119335[2];
                }
            }
        }
        $this->_845490442['ID'] = array_unique($this->_845490442['ID']);
        $this->_845490442['ID'] = array_filter($this->_845490442['ID']);
        $this->_1364486914 = array();
        $_1525266428 = str_replace('-', '_', $this->profile['VARIANT']['PRICE']);
        $_1653209660 = array('SEX_VALUE' => 'SEX', 'COLOR_VALUE' => 'COLOR', 'SIZE_VALUE' => 'SIZE', 'WEIGHT_VALUE' => 'WEIGHT', 'SEXOFFER_VALUE' => 'SEXOFFER', 'COLOROFFER_VALUE' => 'COLOROFFER', 'SIZEOFFER_VALUE' => 'SIZEOFFER', 'WEIGHTOFFER_VALUE' => 'WEIGHTOFFER');
        if (is_array($this->profile['VARIANT']) && !empty($this->profile['VARIANT'])) {
            foreach ($this->profile['VARIANT'] as $_1043938606 => $_365814225) {
                if (key_exists($_1043938606, $_1653209660)) {
                    $_876620395 = explode('-', $_365814225);
                    if (count($_876620395) == 3) {
                        $this->_845490442['ID'][] = $_876620395[2];
                        $this->_831285158[$_1653209660[$_1043938606]] = 'PROPERTY_' . $_876620395[2] . '_DISPLAY_VALUE';
                    }
                }
            }
        }
        $_1350042265 = array('IBLOCK_ID' => 'ASC', 'ID' => 'ASC',);
        $_12820925 = array('IBLOCK_ID' => $_954971976, 'SECTION_ID' => $this->profile['CATEGORY'],);
        if ($this->profile['CHECK_INCLUDE'] != 'Y') {
            $_12820925['INCLUDE_SUBSECTIONS'] = 'Y';
        }
        $_1671974018 = array('nPageSize' => $this->stepElements, 'iNumPage' => $_1634919591);
        $_1461419195 = CIBlockElement::GetList($_1350042265, $_12820925, false, ($_341676656) ? false : $_1671974018, array());
        return $_1461419195;
    }

    protected function PrepareIBlock()
    {
        $_2129797772 = array();
        $this->_2078735835 = array();
        if ((($this->profile['USE_SKU'] == 'Y') || ($this->profile['TYPE'] == 'advantshop')) && (CAcritExportproplusTools::ArrayValidate($this->profile['IBLOCK_ID']))) {
            foreach ($this->profile['IBLOCK_ID'] as $_1230546977) {
                if ($this->_1768427482) {
                    if ($_1577003840 = CCatalog::GetByID($_1230546977)) {
                        if (intval($_1577003840['PRODUCT_IBLOCK_ID']) > 0 && in_array($_1577003840['PRODUCT_IBLOCK_ID'], $this->profile['IBLOCK_ID'])) $_2129797772[] = $_1577003840['IBLOCK_ID'];
                        if (intval($_1577003840['OFFERS_IBLOCK_ID']) > 0) $this->_2078735835[$_1577003840['IBLOCK_ID']] = $_1577003840;
                    }
                }
            }
        }
        return array_diff((is_array($this->profile['IBLOCK_ID']) ? $this->profile['IBLOCK_ID'] : array()), $_2129797772);
    }

    private function __705054251($_485935950, $_851873695 = false, $_409953385 = false, $_1768420642 = false, $_1030859019 = array(), &$_1658004309 = array())
    {
        static $_1063913501;
        global $DB, $USER;
        $_1304010677 = false;
        $this->_29195840 = false;
        $_5222085 = array();
        $_1799584481 = self::__502044406($_485935950, $_851873695);
        if ($this->_1768427482) {
            $_623193173 = $this->profile;
            if ($_623193173['SKIP_WITH_SKU'] == 'Y' && !$_851873695 && $_1799584481['_OFFERS_COUNT'] > 0) {
                $_1304010677 = true;
            }
            if ($_623193173['SETUP']['VALIDATE_CONDITIONS'] == 'Y') {
                $_1329090688 = serialize($_623193173['CONDITION']);
                foreach ($_623193173['CONDITION']['CHILDREN'] as $_570963501 => $_1323407158) {
                    if (isset($_1323407158['CHILDREN']) && is_array($_1323407158['CHILDREN']) && !empty($_1323407158['CHILDREN'])) {
                        foreach ($_1323407158['CHILDREN'] as $_1575322126 => $_895381109) {
                            if (isset($_895381109['CLASS_ID']) && !empty($_895381109['CLASS_ID'])) {
                                if (stripos($_895381109['CLASS_ID'], 'CondIBProp') !== false) {
                                    $_1956293131 = explode(':', $_895381109['CLASS_ID']);
                                    if ($_1956293131[1] != $_1799584481['IBLOCK_ID']) {
                                        unset($_623193173['CONDITION']['CHILDREN'][$_570963501]['CHILDREN'][$_1575322126]);
                                        if (empty($_623193173['CONDITION']['CHILDREN'][$_570963501]['CHILDREN'])) {
                                            unset($_623193173['CONDITION']['CHILDREN'][$_570963501]);
                                        }
                                    }
                                }
                            }
                        }
                    } else {
                        if (isset($_1323407158['CLASS_ID']) && !empty($_1323407158['CLASS_ID'])) {
                            if (stripos($_1323407158['CLASS_ID'], 'CondIBProp') !== false) {
                                $_1956293131 = explode(':', $_1323407158['CLASS_ID']);
                                if ($_1956293131[1] != $_1799584481['IBLOCK_ID']) {
                                    unset($_623193173['CONDITION']['CHILDREN'][$_570963501]);
                                    if (empty($_623193173['CONDITION']['CHILDREN'])) {
                                        unset($_623193173['CONDITION']['CHILDREN']);
                                    }
                                }
                            }
                        }
                    }
                }
                $_1100111501 = serialize($_623193173['CONDITION']);
                if ($_1329090688 !== $_1100111501) {
                    $_1543470442 = new CAcritExportproplusCatalogCond();
                    CAcritExportproplusProps::$_463054691 = CExportproplusProfile::PrepareIBlock($_623193173['IBLOCK_ID'], $_623193173['USE_SKU']);
                    $_1543470442->Init(BT_COND_MODE_GENERATE, BT_COND_BUILD_CATALOG, array());
                    $_623193173['EVAL_FILTER'] = $_1543470442->Generate($_623193173['CONDITION'], array('FIELD' => '$GLOBALS["CHECK_COND"]'));
                }
            }
            if (!CAcritExportproplusTools::CheckCondition($_1799584481, $_623193173['EVAL_FILTER'])) {
                if (!$_851873695 && ($_623193173['EXPORT_DATA_SKU_BY_OFFER'] == 'Y')) {
                    $_1513665106 = false;
                    return $_1513665106;
                } else {
                    $_1513665106 = ($_409953385) ? false : $_1799584481;
                    return $_1513665106;
                }
            } elseif (!$_851873695 && ($_623193173['EXPORT_DATA_SKU_BY_OFFER'] == 'Y')) {
                $_1513665106 = ($_409953385) ? false : $_1799584481;
                return $_1513665106;
            }
        }
        $this->_940439577->IncProduct();
        if ($_409953385) {
            $_1766828534 = array();
        } else {
            $_1108326879 = $this->profile['OFFER_TEMPLATE'];
            $_1766828534 = $this->_1325327767;
        }
        if (empty($_1063913501[$_1799584481['IBLOCK_ID']])) {
            $_683024549 = CIBlockSection::GetList(array('LEFT_MARGIN' => 'ASC'), array('IBLOCK_ID' => $_1799584481['IBLOCK_ID']));
            while ($_1617843728 = $_683024549->GetNext(false, false)) {
                if (intval($_1617843728['PICTURE'])) {
                    $_1617843728['PICTURE'] = CAcritExportproplusTools::GetFilePath($_1617843728['PICTURE']);
                }
                if (intval($_1617843728['DETAIL_PICTURE'])) {
                    $_1617843728['DETAIL_PICTURE'] = CAcritExportproplusTools::GetFilePath($_1617843728['DETAIL_PICTURE']);
                }
                $_1063913501[$_1799584481['IBLOCK_ID']][$_1617843728['ID']] = $_1617843728;
            }
        }
        if (!$_409953385) {
            $_1250329899 = array();
            if ($this->profile['EXPORT_PARENT_CATEGORIES_TO_OFFER'] == 'Y') {
                $_1250329899 = $_1799584481['SECTION_PARENT_ID'];
                if ($this->profile['EXPORT_OFFER_CATEGORIES_TO_OFFER'] == 'Y') {
                    foreach ($_1799584481['SECTION_ID'] as $_401081284) {
                        if (!in_array($_401081284, $_1250329899)) {
                            $_1250329899[] = $_401081284;
                        }
                    }
                }
            } elseif ($this->profile['EXPORT_OFFER_CATEGORIES_TO_OFFER'] == 'Y') {
                $_1250329899 = $_1799584481['SECTION_ID'];
            }
            $_1731610958 = '';
            if (!empty($_1250329899)) {
                foreach ($_1250329899 as $_1188981139) {
                    $_1731610958 .= '<categoryId>' . $_1188981139 . '</categoryId>' . PHP_EOL;
                }
                $_1108326879 = str_replace('<categoryId>#CATEGORYID#</categoryId>', $_1731610958, $_1108326879);
            }
            $_1766828534['#GROUP_ITEM_ID#'] = $_1799584481['GROUP_ITEM_ID'];
        }
        $_1642182436 = $_1799584481;
        $_548088880 = ($_409953385) ? '' : '#';
        foreach ($this->profile['XMLDATA'] as $_29195840 => $_1639684675) {
            $this->_29195840 = $_29195840;
            $_1799584481 = $_1642182436;
            $_1295533077 = $_548088880 . $_1639684675['CODE'] . $_548088880;
            $_579528835 = ($_1639684675['USE_CONDITION'] == 'Y');
            if ($_579528835) {
                $_1777028725 = (CAcritExportproplusTools::CheckCondition($_1799584481, $_1639684675['EVAL_FILTER']) == true);
            }
            if ($_579528835 && !$_1777028725) {
                if (($_1639684675['TYPE'] == 'const') || (($_1639684675['TYPE'] == 'complex') && ($_1639684675['COMPLEX_FALSE_TYPE'] == 'const'))) {
                    $_1639684675['CONTVALUE_FALSE'] = ($_1639684675['TYPE'] == 'const') ? $_1639684675['CONTVALUE_FALSE'] : $_1639684675['COMPLEX_FALSE_CONTVALUE'];
                    $_1766828534[$_1295533077] = $_1639684675['CONTVALUE_FALSE'];
                } else {
                    if ($_1639684675['TYPE'] == 'composite') {
                        $_240357056 = '';
                        $_1773008965 = (strlen($_1639684675['COMPOSITE_FALSE_DIVIDER']) > 0) ? $_1639684675['COMPOSITE_FALSE_DIVIDER'] : ' ';
                        foreach ($_1639684675['COMPOSITE_FALSE'] as $_628180431 => $_111434879) {
                            if ($_628180431 > 1) {
                                $_240357056 .= $_1773008965;
                            }
                            if ($_111434879['COMPOSITE_FALSE_TYPE'] == 'const') {
                                $_240357056 .= CAcritExportproplusTools::RoundNumber($_111434879['COMPOSITE_FALSE_CONTVALUE'], $_1639684675['ROUND']['PRECISION'], $_1639684675['ROUND']['MODE']);
                            } elseif ($_111434879['COMPOSITE_FALSE_TYPE'] == 'field') {
                                $_647344568 = '';
                                if (($_1639684675['CODE'] == 'URL') && function_exists('detailLink')) {
                                    $_647344568 = detailLink($_1799584481['ID']);
                                } else {
                                    $_47247544 = explode('-', $_111434879['COMPOSITE_FALSE_VALUE']);
                                    switch (count($_47247544)) {
                                        case 1:
                                            $_1799584481 = $_1642182436;
                                            if (isset($this->_508964447[$_29195840])) {
                                                $_1799584481 = $this->__1641660486($_485935950);
                                            }
                                            if (strpos($_111434879['COMPOSITE_FALSE_VALUE'], '.') !== false) {
                                                $_1117656864 = explode('.', $_111434879['COMPOSITE_FALSE_VALUE']);
                                                switch ($_1117656864[0]) {
                                                    case 'SECTION':
                                                        $_1490539831 = $_1063913501[$_1642182436['IBLOCK_ID']][$_1642182436['IBLOCK_SECTION_ID']];
                                                        $_1438955011 = $_1490539831[$_1117656864[1]] ?: '';
                                                        break;
                                                    default:
                                                        $_1438955011 = '';
                                                }
                                                unset($_1117656864);
                                                $_647344568 = CAcritExportproplusTools::RoundNumber($_1438955011, $_1639684675['ROUND']['PRECISION'], $_1639684675['ROUND']['MODE']);
                                            } else {
                                                $_647344568 = CAcritExportproplusTools::RoundNumber($_1799584481[$_111434879['COMPOSITE_FALSE_VALUE']], $_1639684675['ROUND']['PRECISION'], $_1639684675['ROUND']['MODE']);
                                            }
                                            $_1799584481 = $_1642182436;
                                            break;
                                        case 2:
                                            $_480208289 = null;
                                            $_647344568 = $_1799584481['CATALOG_' . $_47247544[1]];
                                            if (($_1639684675['VALUE'] == 'CATALOG-PURCHASING_PRICE') && isset($_1799584481['CATALOG_PURCHASING_PRICE'])) {
                                                preg_match('/PURCHASING_PRICE/', $_47247544[1], $_540983714);
                                            } else {
                                                preg_match('/PRICE_[\d]+/', $_47247544[1], $_540983714);
                                            }
                                            $_1284853936 = $_1799584481["CATALOG_{$_540983714[0]}_CURRENCY"];
                                            if (strpos($_47247544[1], '_CURRENCY') > 0) {
                                                $_647344568 = $_1284853936;
                                                $_647344568 = CAcritExportproplusTools::RoundNumber($_647344568, $_1639684675['ROUND']['PRECISION'], $_1639684675['ROUND']['MODE']);
                                                if (is_array($_851873695)) {
                                                    $_480208289 = $_647344568;
                                                }
                                                if ($this->profile['CURRENCY']['CONVERT_CURRENCY'] == 'Y') {
                                                    if ($this->profile['CURRENCY'][$_1284853936]['CHECK']) {
                                                        $_615351990 = $this->profile['CURRENCY'][$_1284853936]['CONVERT_TO'];
                                                        $_647344568 = $_615351990;
                                                        $_647344568 = CAcritExportproplusTools::RoundNumber($_647344568, $_1639684675['ROUND']['PRECISION'], $_1639684675['ROUND']['MODE']);
                                                        if (is_array($_851873695)) {
                                                            $_480208289 = $_647344568;
                                                        }
                                                    }
                                                }
                                            } elseif (!empty($_540983714[0])) {
                                                if ($this->profile['CURRENCY']['CONVERT_CURRENCY'] == 'Y') {
                                                    if ($this->profile['CURRENCY'][$_1284853936]['CHECK']) {
                                                        $_615351990 = $this->profile['CURRENCY'][$_1284853936]['CONVERT_TO'];
                                                        if ($this->profile['CURRENCY'][$_1284853936]['RATE'] == 'SITE') {
                                                            $_647344568 = CAcritExportproplusTools::RoundNumber(CCurrencyRates::ConvertCurrency($_1799584481['CATALOG_' . $_47247544[1]], $this->profile['CURRENCY'][$_1284853936]['CONVERT_FROM'], $_615351990), $_1639684675['ROUND']['PRECISION'], $_1639684675['ROUND']['MODE'], 0);
                                                            if (is_array($_851873695)) {
                                                                $_480208289 = $_647344568;
                                                            }
                                                        } else {
                                                            $_647344568 = CAcritExportproplusTools::RoundNumber($_647344568 * $this->_2112071826[$this->profile['CURRENCY'][$_1284853936]['RATE']][$_1284853936]['RATE'] / $this->_2112071826[$this->profile['CURRENCY'][$_1284853936]['RATE']][$_615351990]['RATE'] / $this->_2112071826[$this->profile['CURRENCY'][$_1284853936]['RATE']][$_1284853936]['RATE_CNT'] * $this->_2112071826[$this->profile['CURRENCY'][$_1284853936]['RATE']][$_615351990]['RATE_CNT'], $_1639684675['ROUND']['PRECISION'], $_1639684675['ROUND']['MODE'], 0);
                                                            if (is_array($_851873695)) {
                                                                $_480208289 = $_647344568;
                                                            }
                                                        }
                                                    }
                                                    if (!in_array($_1284853936, $this->_1364486914)) $this->_1364486914[] = $_1284853936;
                                                } else {
                                                    if (!in_array($_1284853936, $this->_1364486914)) $this->_1364486914[] = $_1284853936;
                                                }
                                                if ($this->profile['CURRENCY'][$_1284853936]['CHECK']) {
                                                    $_647344568 += $_647344568 * floatval($this->profile['CURRENCY'][$_1284853936]['PLUS']) / 100;
                                                    $_647344568 = CAcritExportproplusTools::RoundNumber($_647344568, $_1639684675['ROUND']['PRECISION'], $_1639684675['ROUND']['MODE']);
                                                    if (is_array($_851873695)) {
                                                        $_480208289 = $_647344568;
                                                    }
                                                }
                                            }
                                            if (stripos($_47247544[1], '_WD') !== false) {
                                                if (in_array('PRICE_' . $_1799584481['CATALOG_' . $_47247544[1] . '_PRICEID'] . '_WD', $this->_1931809273) || in_array('PRICE_' . $_1799584481['CATALOG_' . $_47247544[1] . '_PRICEID'] . '_D', $this->_1931809273)) {
                                                    $_1432753308 = CCatalogDiscount::GetDiscountByPrice($_1799584481['CATALOG_' . $_47247544[1] . '_ID'], $USER->GetUserGroupArray(), 'N', $this->profile['LID']);
                                                    $_1156465674 = CCatalogProduct::CountPriceWithDiscount($_647344568, $_1799584481['CATALOG_' . $_47247544[1] . '_CURRENCY'], $_1432753308);
                                                    $_277498185 = $_647344568 - $_1156465674;
                                                } else {
                                                    $_1156465674 = $_647344568;
                                                    $_277498185 = 0;
                                                }
                                                $_1799584481["CATALOG_PRICE_{$_1799584481['CATALOG_'.$_47247544[1].'_PRICEID']}_D"] = $_277498185;
                                                $_1799584481["CATALOG_PRICE_{$_1799584481['CATALOG_'.$_47247544[1].'_PRICEID']}_WD"] = $_1156465674;
                                                $_647344568 = $_1156465674;
                                                $_480208289 = $_647344568;
                                            }
                                            if ($_1639684675['BITRIX_ROUND_MODE'] == 'Y') {
                                                $_647344568 = CAcritExportproplusTools::BitrixRoundNumber($_647344568, $_47247544[1]);
                                            } else {
                                                $_647344568 = CAcritExportproplusTools::RoundNumber($_647344568, $_1639684675['ROUND']['PRECISION'], $_1639684675['ROUND']['MODE']);
                                            }
                                            if (is_array($_851873695)) {
                                                $_480208289 = $_647344568;
                                            }
                                            if (is_array($_851873695) && !is_null($_480208289)) $_5222085[$_29195840][$_1639684675['CODE']][] = $_480208289;
                                            break;
                                        case 3:
                                            $_1799584481 = $_1642182436;
                                            if (isset($this->_508964447[$_29195840])) {
                                                $_1799584481 = $this->__1641660486($_485935950);
                                            }
                                            if (($_47247544[0] == $_1799584481['IBLOCK_ID']) || ($_47247544[0] == $_851873695['IBLOCK_ID'])) {
                                                if ($this->_2078735835[$_47247544[0]]['OFFERS_PROPERTY_ID'] == $_47247544[2]) {
                                                    $_1799584481["PROPERTY_{$_47247544[2]}_DISPLAY_VALUE"] = CAcritExportproplusTools::RoundNumber($_1799584481["PROPERTY_{$_47247544[2]}_VALUE"][0], $_1639684675['ROUND']['PRECISION'], $_1639684675['ROUND']['MODE']);
                                                }
                                                if ($this->profile['XMLDATA']["{$_1639684675['CODE']}"]['PROCESS_LOGIC'] == 'N') {
                                                    $_212220634 = $_1799584481["PROPERTY_{$_47247544[2]}_VALUE"];
                                                } else {
                                                    $_212220634 = $_1799584481["PROPERTY_{$_47247544[2]}_DISPLAY_VALUE"];
                                                }
                                                if (is_array($_212220634)) {
                                                    $_55309008 = CAcritExportproplusTools::ParseMultiproFormat($_212220634, $this->profile, $_1639684675['CODE']);
                                                    $_212220634 = (is_array($_55309008) && !empty($_55309008)) ? $_55309008 : $_212220634;
                                                    $_647344568 = array();
                                                    foreach ($_212220634 as $_32014025) {
                                                        if (intval($this->profile['XMLDATA'][$_1639684675['CODE']]['MULTIPROP_LIMIT']) > 0) {
                                                            if (count($_647344568) < $this->profile['XMLDATA'][$_1639684675['CODE']]['MULTIPROP_LIMIT']) {
                                                                $_647344568[] = CAcritExportproplusTools::RoundNumber($_32014025, $_1639684675['ROUND']['PRECISION'], $_1639684675['ROUND']['MODE']);
                                                            }
                                                        } else {
                                                            $_647344568[] = CAcritExportproplusTools::RoundNumber($_32014025, $_1639684675['ROUND']['PRECISION'], $_1639684675['ROUND']['MODE']);
                                                        }
                                                    }
                                                    $_723690939 = '';
                                                    if (!empty($_647344568)) {
                                                        foreach ($_647344568 as $_271923141 => $_1038738500) {
                                                            if ($_271923141) {
                                                                $_723690939 .= $_1773008965;
                                                            }
                                                            $_723690939 .= $_1038738500;
                                                        }
                                                    }
                                                    if (strlen($_723690939) > 0) {
                                                        $_647344568 = $_723690939;
                                                    }
                                                    if ($_1639684675['MULTIPROP_TO_STRING'] == 'Y') {
                                                        $_1574328650 = (strlen($_1639684675['MULTIPROP_DIVIDER']) > 0) ? $_1639684675['MULTIPROP_DIVIDER'] : ' ';
                                                        $_647344568 = implode($_1574328650, $_647344568);
                                                    }
                                                } else {
                                                    $_647344568 = CAcritExportproplusTools::RoundNumber($_212220634, $_1639684675['ROUND']['PRECISION'], $_1639684675['ROUND']['MODE']);
                                                }
                                            }
                                            $_1799584481 = $_1642182436;
                                            break;
                                        case 5:
                                            $_1799584481 = $_1642182436;
                                            $_1799584481['HL'] = $this->__745667146($_47247544[0], $_47247544[3], $_1799584481);
                                            $_212220634 = $_1799584481['HL'][$_47247544[4]]['VALUE'];
                                            if (is_array($_212220634)) {
                                                $_55309008 = CAcritExportproplusTools::ParseMultiproFormat($_212220634, $this->profile, $_1639684675['CODE']);
                                                $_212220634 = (is_array($_55309008) && !empty($_55309008)) ? $_55309008 : $_212220634;
                                                $_647344568 = array();
                                                foreach ($_212220634 as $_32014025) {
                                                    if (intval($this->profile['XMLDATA'][$_1639684675['CODE']]['MULTIPROP_LIMIT']) > 0) {
                                                        if (count($_647344568) < $this->profile['XMLDATA'][$_1639684675['CODE']]['MULTIPROP_LIMIT']) {
                                                            $_647344568[] = CAcritExportproplusTools::RoundNumber($_32014025, $_1639684675['ROUND']['PRECISION'], $_1639684675['ROUND']['MODE']);
                                                        }
                                                    } else {
                                                        $_647344568[] = CAcritExportproplusTools::RoundNumber($_32014025, $_1639684675['ROUND']['PRECISION'], $_1639684675['ROUND']['MODE']);
                                                    }
                                                }
                                                $_723690939 = '';
                                                if (!empty($_647344568)) {
                                                    foreach ($_647344568 as $_271923141 => $_1038738500) {
                                                        if ($_271923141) {
                                                            $_723690939 .= $_1773008965;
                                                        }
                                                        $_723690939 .= $_1038738500;
                                                    }
                                                }
                                                if (strlen($_723690939) > 0) {
                                                    $_647344568 = $_723690939;
                                                }
                                                if ($_1639684675['MULTIPROP_TO_STRING'] == 'Y') {
                                                    $_1574328650 = (strlen($_1639684675['MULTIPROP_DIVIDER']) > 0) ? $_1639684675['MULTIPROP_DIVIDER'] : ' ';
                                                    $_647344568 = implode($_1574328650, $_647344568);
                                                }
                                            } else {
                                                $_647344568 = CAcritExportproplusTools::RoundNumber($_212220634, $_1639684675['ROUND']['PRECISION'], $_1639684675['ROUND']['MODE']);
                                            }
                                            break;
                                    }
                                }
                                $_240357056 .= $_647344568;
                            }
                        }
                        $_1766828534[$_1295533077] = CAcritExportproplusTools::RoundNumber($_240357056, $_1639684675['ROUND']['PRECISION'], $_1639684675['ROUND']['MODE']);
                    } elseif ($_1639684675['TYPE'] == 'arithmetics') {
                        $_385967419 = trim($_1639684675['ARITHMETICS_FALSE_DIVIDER']);
                        $_1639684675['ARITHMETICS_FALSE'] = array_reverse($_1639684675['ARITHMETICS_FALSE'], true);
                        $_1175835693 = true;
                        foreach ($_1639684675['ARITHMETICS_FALSE'] as $_1630858607 => $_1528140672) {
                            if ($_1528140672['ARITHMETICS_FALSE_TYPE'] == 'const') {
                                $_385967419 = str_replace('x' . $_1630858607, CAcritExportproplusTools::RoundNumber($_1528140672['ARITHMETICS_FALSE_CONTVALUE'], $_1639684675['ROUND']['PRECISION'], $_1639684675['ROUND']['MODE']), $_385967419);
                            } elseif ($_1528140672['ARITHMETICS_FALSE_TYPE'] == 'field') {
                                $_1266989984 = '';
                                if (($_1639684675['CODE'] == 'URL') && function_exists('detailLink')) {
                                    $_1266989984 = detailLink($_1799584481['ID']);
                                } else {
                                    $_47247544 = explode('-', $_1528140672['ARITHMETICS_FALSE_VALUE']);
                                    switch (count($_47247544)) {
                                        case 1:
                                            $_1799584481 = $_1642182436;
                                            if (isset($this->_508964447[$_29195840])) {
                                                $_1799584481 = $this->__1641660486($_485935950);
                                            }
                                            if (strpos($_1528140672['ARITHMETICS_FALSE_VALUE'], '.') !== false) {
                                                $_1117656864 = explode('.', $_1528140672['ARITHMETICS_FALSE_VALUE']);
                                                switch ($_1117656864[0]) {
                                                    case 'SECTION':
                                                        $_1490539831 = $_1063913501[$_1642182436['IBLOCK_ID']][$_1642182436['IBLOCK_SECTION_ID']];
                                                        $_1438955011 = $_1490539831[$_1117656864[1]] ?: '';
                                                        break;
                                                    default:
                                                        $_1438955011 = '';
                                                }
                                                unset($_1117656864);
                                                $_1266989984 = CAcritExportproplusTools::RoundNumber($_1438955011, $_1639684675['ROUND']['PRECISION'], $_1639684675['ROUND']['MODE']);
                                            } else {
                                                $_1266989984 = CAcritExportproplusTools::RoundNumber($_1799584481[$_1528140672['ARITHMETICS_FALSE_VALUE']], $_1639684675['ROUND']['PRECISION'], $_1639684675['ROUND']['MODE']);
                                            }
                                            $_1799584481 = $_1642182436;
                                            break;
                                        case 2:
                                            $_480208289 = null;
                                            $_1266989984 = $_1799584481['CATALOG_' . $_47247544[1]];
                                            if (($_1639684675['VALUE'] == 'CATALOG-PURCHASING_PRICE') && isset($_1799584481['CATALOG_PURCHASING_PRICE'])) {
                                                preg_match('/PURCHASING_PRICE/', $_47247544[1], $_540983714);
                                            } else {
                                                preg_match('/PRICE_[\d]+/', $_47247544[1], $_540983714);
                                            }
                                            $_1284853936 = $_1799584481["CATALOG_{$_540983714[0]}_CURRENCY"];
                                            if (strpos($_47247544[1], '_CURRENCY') > 0) {
                                                $_1266989984 = $_1284853936;
                                                $_1266989984 = CAcritExportproplusTools::RoundNumber($_1266989984, $_1639684675['ROUND']['PRECISION'], $_1639684675['ROUND']['MODE']);
                                                if (is_array($_851873695)) {
                                                    $_480208289 = $_1266989984;
                                                }
                                                if ($this->profile['CURRENCY']['CONVERT_CURRENCY'] == 'Y') {
                                                    if ($this->profile['CURRENCY'][$_1284853936]['CHECK']) {
                                                        $_615351990 = $this->profile['CURRENCY'][$_1284853936]['CONVERT_TO'];
                                                        $_1266989984 = $_615351990;
                                                        $_1266989984 = CAcritExportproplusTools::RoundNumber($_1266989984, $_1639684675['ROUND']['PRECISION'], $_1639684675['ROUND']['MODE']);
                                                        if (is_array($_851873695)) {
                                                            $_480208289 = $_1266989984;
                                                        }
                                                    }
                                                }
                                            } elseif (!empty($_540983714[0])) {
                                                if ($this->profile['CURRENCY']['CONVERT_CURRENCY'] == 'Y') {
                                                    if ($this->profile['CURRENCY'][$_1284853936]['CHECK']) {
                                                        $_615351990 = $this->profile['CURRENCY'][$_1284853936]['CONVERT_TO'];
                                                        if ($this->profile['CURRENCY'][$_1284853936]['RATE'] == 'SITE') {
                                                            $_1266989984 = CAcritExportproplusTools::RoundNumber(CCurrencyRates::ConvertCurrency($_1799584481['CATALOG_' . $_47247544[1]], $this->profile['CURRENCY'][$_1284853936]['CONVERT_FROM'], $_615351990), $_1639684675['ROUND']['PRECISION'], $_1639684675['ROUND']['MODE'], 0);
                                                            if (is_array($_851873695)) {
                                                                $_480208289 = $_1266989984;
                                                            }
                                                        } else {
                                                            $_1266989984 = CAcritExportproplusTools::RoundNumber($_1266989984 * $this->_2112071826[$this->profile['CURRENCY'][$_1284853936]['RATE']][$_1284853936]['RATE'] / $this->_2112071826[$this->profile['CURRENCY'][$_1284853936]['RATE']][$_615351990]['RATE'] / $this->_2112071826[$this->profile['CURRENCY'][$_1284853936]['RATE']][$_1284853936]['RATE_CNT'] * $this->_2112071826[$this->profile['CURRENCY'][$_1284853936]['RATE']][$_615351990]['RATE_CNT'], $_1639684675['ROUND']['PRECISION'], $_1639684675['ROUND']['MODE'], 0);
                                                            if (is_array($_851873695)) {
                                                                $_480208289 = $_1266989984;
                                                            }
                                                        }
                                                    }
                                                    if (!in_array($_1284853936, $this->_1364486914)) $this->_1364486914[] = $_1284853936;
                                                } else {
                                                    if (!in_array($_1284853936, $this->_1364486914)) $this->_1364486914[] = $_1284853936;
                                                }
                                                if ($this->profile['CURRENCY'][$_1284853936]['CHECK']) {
                                                    $_1266989984 += $_1266989984 * floatval($this->profile['CURRENCY'][$_1284853936]['PLUS']) / 100;
                                                    $_1266989984 = CAcritExportproplusTools::RoundNumber($_1266989984, $_1639684675['ROUND']['PRECISION'], $_1639684675['ROUND']['MODE']);
                                                    if (is_array($_851873695)) {
                                                        $_480208289 = $_1266989984;
                                                    }
                                                }
                                            }
                                            if (stripos($_47247544[1], '_WD') !== false) {
                                                if (in_array('PRICE_' . $_1799584481['CATALOG_' . $_47247544[1] . '_PRICEID'] . '_WD', $this->_1931809273) || in_array('PRICE_' . $_1799584481['CATALOG_' . $_47247544[1] . '_PRICEID'] . '_D', $this->_1931809273)) {
                                                    $_1432753308 = CCatalogDiscount::GetDiscountByPrice($_1799584481['CATALOG_' . $_47247544[1] . '_ID'], $USER->GetUserGroupArray(), 'N', $this->profile['LID']);
                                                    $_1156465674 = CCatalogProduct::CountPriceWithDiscount($_1266989984, $_1799584481['CATALOG_' . $_47247544[1] . '_CURRENCY'], $_1432753308);
                                                    $_277498185 = $_1266989984 - $_1156465674;
                                                } else {
                                                    $_1156465674 = $_1266989984;
                                                    $_277498185 = 0;
                                                }
                                                $_1799584481["CATALOG_PRICE_{$_1799584481['CATALOG_'.$_47247544[1].'_PRICEID']}_D"] = $_277498185;
                                                $_1799584481["CATALOG_PRICE_{$_1799584481['CATALOG_'.$_47247544[1].'_PRICEID']}_WD"] = $_1156465674;
                                                $_1266989984 = $_1156465674;
                                                $_480208289 = $_1266989984;
                                            }
                                            if ($_1639684675['BITRIX_ROUND_MODE'] == 'Y') {
                                                $_1266989984 = CAcritExportproplusTools::BitrixRoundNumber($_1266989984, $_47247544[1]);
                                            } else {
                                                $_1266989984 = CAcritExportproplusTools::RoundNumber($_1266989984, $_1639684675['ROUND']['PRECISION'], $_1639684675['ROUND']['MODE']);
                                            }
                                            if (is_array($_851873695)) {
                                                $_480208289 = $_1266989984;
                                            }
                                            if (is_array($_851873695) && !is_null($_480208289)) $_5222085[$_29195840][$_1639684675['CODE']][] = $_480208289;
                                            break;
                                        case 3:
                                            $_1799584481 = $_1642182436;
                                            if (isset($this->_508964447[$_29195840])) {
                                                $_1799584481 = $this->__1641660486($_485935950);
                                            }
                                            if (($_47247544[0] == $_1799584481['IBLOCK_ID']) || ($_47247544[0] == $_851873695['IBLOCK_ID'])) {
                                                if ($this->_2078735835[$_47247544[0]]['OFFERS_PROPERTY_ID'] == $_47247544[2]) {
                                                    $_1799584481["PROPERTY_{$_47247544[2]}_DISPLAY_VALUE"] = CAcritExportproplusTools::RoundNumber($_1799584481["PROPERTY_{$_47247544[2]}_VALUE"][0], $_1639684675['ROUND']['PRECISION'], $_1639684675['ROUND']['MODE']);
                                                }
                                                if ($this->profile['XMLDATA']["{$_1639684675['CODE']}"]['PROCESS_LOGIC'] == 'N') {
                                                    $_212220634 = $_1799584481["PROPERTY_{$_47247544[2]}_VALUE"];
                                                } else {
                                                    $_212220634 = $_1799584481["PROPERTY_{$_47247544[2]}_DISPLAY_VALUE"];
                                                }
                                                if (is_array($_212220634)) {
                                                    $_1266989984 = CAcritExportproplusTools::RoundNumber($_212220634[0], $_1639684675['ROUND']['PRECISION'], $_1639684675['ROUND']['MODE']);
                                                } else {
                                                    $_1266989984 = CAcritExportproplusTools::RoundNumber($_212220634, $_1639684675['ROUND']['PRECISION'], $_1639684675['ROUND']['MODE']);
                                                }
                                            }
                                            $_1799584481 = $_1642182436;
                                            break;
                                        case 5:
                                            $_1799584481 = $_1642182436;
                                            $_1799584481['HL'] = $this->__745667146($_47247544[0], $_47247544[3], $_1799584481);
                                            $_212220634 = $_1799584481['HL'][$_47247544[4]]['VALUE'];
                                            if (is_array($_212220634)) {
                                                $_1266989984 = CAcritExportproplusTools::RoundNumber($_212220634[0], $_1639684675['ROUND']['PRECISION'], $_1639684675['ROUND']['MODE']);
                                            } else {
                                                $_1266989984 = CAcritExportproplusTools::RoundNumber($_212220634, $_1639684675['ROUND']['PRECISION'], $_1639684675['ROUND']['MODE']);
                                            }
                                            break;
                                    }
                                }
                                $_385967419 = str_replace('x' . $_1630858607, CAcritExportproplusTools::RoundNumber($_1266989984, $_1639684675['ROUND']['PRECISION'], $_1639684675['ROUND']['MODE']), $_385967419);
                                if (!strlen(trim($_1266989984))) {
                                    $this->_940439577->AddMessage("{$_1799584481['NAME']} (ID:{$_1799584481['ID']}) : " . str_replace('#FIELD#', 'x' . $_1630858607, GetMessage('ACRIT_EXPORTPROPLUS_ARITHMETICS_FIELD_NO_OPERAND')));
                                    $this->_940439577->IncProductError();
                                    $_1175835693 = false;
                                }
                            }
                        }
                        if ($_1175835693) {
                            $_1766828534[$_1295533077] = CAcritExportproplusTools::RoundNumber(CAcritExportproplusTools::CalculateString($_385967419), $_1639684675['ROUND']['PRECISION'], $_1639684675['ROUND']['MODE']);
                        } else {
                            $_1766828534[$_1295533077] = '';
                        }
                    } elseif ($_1639684675['TYPE'] == 'stack') {
                        $_1880174775 = '';
                        foreach ($_1639684675['STACK_FALSE'] as $_845292619 => $_279295239) {
                            if ($_279295239['STACK_FALSE_TYPE'] == 'const') {
                                $_1880174775 = CAcritExportproplusTools::RoundNumber($_279295239['STACK_FALSE_CONTVALUE'], $_1639684675['ROUND']['PRECISION'], $_1639684675['ROUND']['MODE']);
                            } elseif ($_279295239['STACK_FALSE_TYPE'] == 'field') {
                                $_1880174775 = '';
                                if (($_1639684675['CODE'] == 'URL') && function_exists('detailLink')) {
                                    $_1880174775 = detailLink($_1799584481['ID']);
                                } else {
                                    $_47247544 = explode('-', $_279295239['STACK_FALSE_VALUE']);
                                    switch (count($_47247544)) {
                                        case 1:
                                            $_1799584481 = $_1642182436;
                                            if (isset($this->_508964447[$_29195840])) {
                                                $_1799584481 = $this->__1641660486($_485935950);
                                            }
                                            if (strpos($_279295239['STACK_FALSE_VALUE'], '.') !== false) {
                                                $_1117656864 = explode('.', $_279295239['STACK_FALSE_VALUE']);
                                                switch ($_1117656864[0]) {
                                                    case 'SECTION':
                                                        $_1490539831 = $_1063913501[$_1642182436['IBLOCK_ID']][$_1642182436['IBLOCK_SECTION_ID']];
                                                        $_1438955011 = $_1490539831[$_1117656864[1]] ?: '';
                                                        break;
                                                    default:
                                                        $_1438955011 = '';
                                                }
                                                unset($_1117656864);
                                                $_1880174775 = CAcritExportproplusTools::RoundNumber($_1438955011, $_1639684675['ROUND']['PRECISION'], $_1639684675['ROUND']['MODE']);
                                            } else {
                                                $_1880174775 = CAcritExportproplusTools::RoundNumber($_1799584481[$_279295239['STACK_FALSE_VALUE']], $_1639684675['ROUND']['PRECISION'], $_1639684675['ROUND']['MODE']);
                                            }
                                            $_1799584481 = $_1642182436;
                                            break;
                                        case 2:
                                            $_480208289 = null;
                                            $_1880174775 = $_1799584481['CATALOG_' . $_47247544[1]];
                                            if (($_1639684675['VALUE'] == 'CATALOG-PURCHASING_PRICE') && isset($_1799584481['CATALOG_PURCHASING_PRICE'])) {
                                                preg_match('/PURCHASING_PRICE/', $_47247544[1], $_540983714);
                                            } else {
                                                preg_match('/PRICE_[\d]+/', $_47247544[1], $_540983714);
                                            }
                                            $_1284853936 = $_1799584481["CATALOG_{$_540983714[0]}_CURRENCY"];
                                            if (strpos($_47247544[1], '_CURRENCY') > 0) {
                                                $_1880174775 = $_1284853936;
                                                $_1880174775 = CAcritExportproplusTools::RoundNumber($_1880174775, $_1639684675['ROUND']['PRECISION'], $_1639684675['ROUND']['MODE']);
                                                if (is_array($_851873695)) {
                                                    $_480208289 = $_1880174775;
                                                }
                                                if ($this->profile['CURRENCY']['CONVERT_CURRENCY'] == 'Y') {
                                                    if ($this->profile['CURRENCY'][$_1284853936]['CHECK']) {
                                                        $_615351990 = $this->profile['CURRENCY'][$_1284853936]['CONVERT_TO'];
                                                        $_1880174775 = $_615351990;
                                                        $_1880174775 = CAcritExportproplusTools::RoundNumber($_1880174775, $_1639684675['ROUND']['PRECISION'], $_1639684675['ROUND']['MODE']);
                                                        if (is_array($_851873695)) {
                                                            $_480208289 = $_1880174775;
                                                        }
                                                    }
                                                }
                                            } elseif (!empty($_540983714[0])) {
                                                if ($this->profile['CURRENCY']['CONVERT_CURRENCY'] == 'Y') {
                                                    if ($this->profile['CURRENCY'][$_1284853936]['CHECK']) {
                                                        $_615351990 = $this->profile['CURRENCY'][$_1284853936]['CONVERT_TO'];
                                                        if ($this->profile['CURRENCY'][$_1284853936]['RATE'] == 'SITE') {
                                                            $_1880174775 = CAcritExportproplusTools::RoundNumber(CCurrencyRates::ConvertCurrency($_1799584481['CATALOG_' . $_47247544[1]], $this->profile['CURRENCY'][$_1284853936]['CONVERT_FROM'], $_615351990), $_1639684675['ROUND']['PRECISION'], $_1639684675['ROUND']['MODE'], 0);
                                                            if (is_array($_851873695)) {
                                                                $_480208289 = $_1880174775;
                                                            }
                                                        } else {
                                                            $_1880174775 = CAcritExportproplusTools::RoundNumber($_1880174775 * $this->_2112071826[$this->profile['CURRENCY'][$_1284853936]['RATE']][$_1284853936]['RATE'] / $this->_2112071826[$this->profile['CURRENCY'][$_1284853936]['RATE']][$_615351990]['RATE'] / $this->_2112071826[$this->profile['CURRENCY'][$_1284853936]['RATE']][$_1284853936]['RATE_CNT'] * $this->_2112071826[$this->profile['CURRENCY'][$_1284853936]['RATE']][$_615351990]['RATE_CNT'], $_1639684675['ROUND']['PRECISION'], $_1639684675['ROUND']['MODE'], 0);
                                                            if (is_array($_851873695)) {
                                                                $_480208289 = $_1880174775;
                                                            }
                                                        }
                                                    }
                                                    if (!in_array($_1284853936, $this->_1364486914)) $this->_1364486914[] = $_1284853936;
                                                } else {
                                                    if (!in_array($_1284853936, $this->_1364486914)) $this->_1364486914[] = $_1284853936;
                                                }
                                                if ($this->profile['CURRENCY'][$_1284853936]['CHECK']) {
                                                    $_1880174775 += $_1880174775 * floatval($this->profile['CURRENCY'][$_1284853936]['PLUS']) / 100;
                                                    $_1880174775 = CAcritExportproplusTools::RoundNumber($_1880174775, $_1639684675['ROUND']['PRECISION'], $_1639684675['ROUND']['MODE']);
                                                    if (is_array($_851873695)) {
                                                        $_480208289 = $_1880174775;
                                                    }
                                                }
                                            }
                                            if (stripos($_47247544[1], '_WD') !== false) {
                                                if (in_array('PRICE_' . $_1799584481['CATALOG_' . $_47247544[1] . '_PRICEID'] . '_WD', $this->_1931809273) || in_array('PRICE_' . $_1799584481['CATALOG_' . $_47247544[1] . '_PRICEID'] . '_D', $this->_1931809273)) {
                                                    $_1432753308 = CCatalogDiscount::GetDiscountByPrice($_1799584481['CATALOG_' . $_47247544[1] . '_ID'], $USER->GetUserGroupArray(), 'N', $this->profile['LID']);
                                                    $_1156465674 = CCatalogProduct::CountPriceWithDiscount($_1880174775, $_1799584481['CATALOG_' . $_47247544[1] . '_CURRENCY'], $_1432753308);
                                                    $_277498185 = $_1880174775 - $_1156465674;
                                                } else {
                                                    $_1156465674 = $_1880174775;
                                                    $_277498185 = 0;
                                                }
                                                $_1799584481["CATALOG_PRICE_{$_1799584481['CATALOG_'.$_47247544[1].'_PRICEID']}_D"] = $_277498185;
                                                $_1799584481["CATALOG_PRICE_{$_1799584481['CATALOG_'.$_47247544[1].'_PRICEID']}_WD"] = $_1156465674;
                                                $_1880174775 = $_1156465674;
                                                $_480208289 = $_1880174775;
                                            }
                                            if ($_1639684675['BITRIX_ROUND_MODE'] == 'Y') {
                                                $_1880174775 = CAcritExportproplusTools::BitrixRoundNumber($_1880174775, $_47247544[1]);
                                            } else {
                                                $_1880174775 = CAcritExportproplusTools::RoundNumber($_1880174775, $_1639684675['ROUND']['PRECISION'], $_1639684675['ROUND']['MODE']);
                                            }
                                            if (is_array($_851873695)) {
                                                $_480208289 = $_1880174775;
                                            }
                                            if (is_array($_851873695) && !is_null($_480208289)) $_5222085[$_29195840][$_1639684675['CODE']][] = $_480208289;
                                            break;
                                        case 3:
                                            $_1799584481 = $_1642182436;
                                            if (isset($this->_508964447[$_29195840])) {
                                                $_1799584481 = $this->__1641660486($_485935950);
                                            }
                                            if (($_47247544[0] == $_1799584481['IBLOCK_ID']) || ($_47247544[0] == $_851873695['IBLOCK_ID'])) {
                                                if ($this->_2078735835[$_47247544[0]]['OFFERS_PROPERTY_ID'] == $_47247544[2]) {
                                                    $_1799584481["PROPERTY_{$_47247544[2]}_DISPLAY_VALUE"] = CAcritExportproplusTools::RoundNumber($_1799584481["PROPERTY_{$_47247544[2]}_VALUE"][0], $_1639684675['ROUND']['PRECISION'], $_1639684675['ROUND']['MODE']);
                                                }
                                                if ($this->profile['XMLDATA']["{$_1639684675['CODE']}"]['PROCESS_LOGIC'] == 'N') {
                                                    $_212220634 = $_1799584481["PROPERTY_{$_47247544[2]}_VALUE"];
                                                } else {
                                                    $_212220634 = $_1799584481["PROPERTY_{$_47247544[2]}_DISPLAY_VALUE"];
                                                }
                                                if (is_array($_212220634)) {
                                                    $_55309008 = CAcritExportproplusTools::ParseMultiproFormat($_212220634, $this->profile, $_1639684675['CODE']);
                                                    $_212220634 = (is_array($_55309008) && !empty($_55309008)) ? $_55309008 : $_212220634;
                                                    $_1880174775 = array();
                                                    foreach ($_212220634 as $_32014025) {
                                                        if (intval($this->profile['XMLDATA'][$_1639684675['CODE']]['MULTIPROP_LIMIT']) > 0) {
                                                            if (count($_1880174775) < $this->profile['XMLDATA'][$_1639684675['CODE']]['MULTIPROP_LIMIT']) {
                                                                $_1880174775[] = CAcritExportproplusTools::RoundNumber($_32014025, $_1639684675['ROUND']['PRECISION'], $_1639684675['ROUND']['MODE']);
                                                            }
                                                        } else {
                                                            $_1880174775[] = CAcritExportproplusTools::RoundNumber($_32014025, $_1639684675['ROUND']['PRECISION'], $_1639684675['ROUND']['MODE']);
                                                        }
                                                    }
                                                    if ($_1639684675['MULTIPROP_TO_STRING'] == 'Y') {
                                                        $_1574328650 = (strlen($_1639684675['MULTIPROP_DIVIDER']) > 0) ? $_1639684675['MULTIPROP_DIVIDER'] : ' ';
                                                        $_1880174775 = implode($_1574328650, $_1880174775);
                                                    }
                                                } else {
                                                    $_1880174775 = CAcritExportproplusTools::RoundNumber($_212220634, $_1639684675['ROUND']['PRECISION'], $_1639684675['ROUND']['MODE']);
                                                }
                                            }
                                            $_1799584481 = $_1642182436;
                                            break;
                                        case 5:
                                            $_1799584481 = $_1642182436;
                                            $_1799584481['HL'] = $this->__745667146($_47247544[0], $_47247544[3], $_1799584481);
                                            $_212220634 = $_1799584481['HL'][$_47247544[4]]['VALUE'];
                                            if (is_array($_212220634)) {
                                                $_55309008 = CAcritExportproplusTools::ParseMultiproFormat($_212220634, $this->profile, $_1639684675['CODE']);
                                                $_212220634 = (is_array($_55309008) && !empty($_55309008)) ? $_55309008 : $_212220634;
                                                $_1880174775 = array();
                                                foreach ($_212220634 as $_32014025) {
                                                    if (intval($this->profile['XMLDATA'][$_1639684675['CODE']]['MULTIPROP_LIMIT']) > 0) {
                                                        if (count($_1880174775) < $this->profile['XMLDATA'][$_1639684675['CODE']]['MULTIPROP_LIMIT']) {
                                                            $_1880174775[] = CAcritExportproplusTools::RoundNumber($_32014025, $_1639684675['ROUND']['PRECISION'], $_1639684675['ROUND']['MODE']);
                                                        }
                                                    } else {
                                                        $_1880174775[] = CAcritExportproplusTools::RoundNumber($_32014025, $_1639684675['ROUND']['PRECISION'], $_1639684675['ROUND']['MODE']);
                                                    }
                                                }
                                                if ($_1639684675['MULTIPROP_TO_STRING'] == 'Y') {
                                                    $_1574328650 = (strlen($_1639684675['MULTIPROP_DIVIDER']) > 0) ? $_1639684675['MULTIPROP_DIVIDER'] : ' ';
                                                    $_1880174775 = implode($_1574328650, $_1880174775);
                                                }
                                            } else {
                                                $_1880174775 = CAcritExportproplusTools::RoundNumber($_212220634, $_1639684675['ROUND']['PRECISION'], $_1639684675['ROUND']['MODE']);
                                            }
                                            break;
                                    }
                                }
                            }
                            if ((is_array($_1880174775) && !empty($_1880174775)) || (strlen(trim($_1880174775)) > 0)) {
                                $_1766828534[$_1295533077] = CAcritExportproplusTools::RoundNumber($_1880174775, $_1639684675['ROUND']['PRECISION'], $_1639684675['ROUND']['MODE']);
                                break;
                            }
                        }
                    } else {
                        $_1639684675['VALUE'] = $_1639684675['COMPLEX_FALSE_VALUE'];
                        if (($_1639684675['CODE'] == 'URL') && function_exists('detailLink')) {
                            $_1766828534[$_1295533077] = detailLink($_1799584481['ID']);
                            if (!$_409953385) {
                                $_1616301007 = stripos($_1108326879, '?');
                                $_865844506 = stripos($_1108326879, '?utm_source');
                                if ($_1616301007 != $_865844506) {
                                    $_1108326879 = str_replace('?utm_source', '&amp;utm_source', $_1108326879);
                                }
                            }
                        } else {
                            if (function_exists('acritRedefine')) {
                                $_1766828534[$_1295533077] = acritRedefine($_1295533077, $_1799584481['ID'], $this->profile['ID']);
                            }
                            if (!$_1766828534[$_1295533077]) {
                                $_47247544 = explode('-', $_1639684675['VALUE']);
                                switch (count($_47247544)) {
                                    case 1:
                                        $_1799584481 = $_1642182436;
                                        if (isset($this->_508964447[$_29195840])) {
                                            $_1799584481 = $this->__1641660486($_485935950);
                                        }
                                        if (strpos($_1639684675['VALUE'], '.') !== false) {
                                            $_1117656864 = explode('.', $_1639684675['VALUE']);
                                            switch ($_1117656864[0]) {
                                                case 'SECTION':
                                                    $_1490539831 = $_1063913501[$_1642182436['IBLOCK_ID']][$_1642182436['IBLOCK_SECTION_ID']];
                                                    $_1438955011 = $_1490539831[$_1117656864[1]] ?: '';
                                                    break;
                                                default:
                                                    $_1438955011 = '';
                                            }
                                            unset($_1117656864);
                                            $_1766828534[$_1295533077] = CAcritExportproplusTools::RoundNumber($_1438955011, $_1639684675['ROUND']['PRECISION'], $_1639684675['ROUND']['MODE']);
                                        } else {
                                            $_1766828534[$_1295533077] = CAcritExportproplusTools::RoundNumber($_1799584481[$_1639684675['VALUE']], $_1639684675['ROUND']['PRECISION'], $_1639684675['ROUND']['MODE']);
                                        }
                                        $_1799584481 = $_1642182436;
                                        break;
                                    case 2:
                                        $_480208289 = null;
                                        $_1766828534[$_1295533077] = $_1799584481['CATALOG_' . $_47247544[1]];
                                        if (($_1639684675['VALUE'] == 'CATALOG-PURCHASING_PRICE') && isset($_1799584481['CATALOG_PURCHASING_PRICE'])) {
                                            preg_match('/PURCHASING_PRICE/', $_47247544[1], $_540983714);
                                        } else {
                                            preg_match('/PRICE_[\d]+/', $_47247544[1], $_540983714);
                                        }
                                        $_1284853936 = $_1799584481["CATALOG_{$_540983714[0]}_CURRENCY"];
                                        if (strpos($_47247544[1], '_CURRENCY') > 0) {
                                            $_1766828534[$_1295533077] = $_1284853936;
                                            $_1766828534[$_1295533077] = CAcritExportproplusTools::RoundNumber($_1766828534[$_1295533077], $_1639684675['ROUND']['PRECISION'], $_1639684675['ROUND']['MODE']);
                                            if (is_array($_851873695)) {
                                                $_480208289 = $_1766828534[$_1295533077];
                                            }
                                            if ($this->profile['CURRENCY']['CONVERT_CURRENCY'] == 'Y') {
                                                if ($this->profile['CURRENCY'][$_1284853936]['CHECK']) {
                                                    $_615351990 = $this->profile['CURRENCY'][$_1284853936]['CONVERT_TO'];
                                                    $_1766828534[$_1295533077] = $_615351990;
                                                    $_1766828534[$_1295533077] = CAcritExportproplusTools::RoundNumber($_1766828534[$_1295533077], $_1639684675['ROUND']['PRECISION'], $_1639684675['ROUND']['MODE']);
                                                    if (is_array($_851873695)) {
                                                        $_480208289 = $_1766828534[$_1295533077];
                                                    }
                                                }
                                            }
                                        } elseif (!empty($_540983714[0])) {
                                            if ($this->profile['CURRENCY']['CONVERT_CURRENCY'] == 'Y') {
                                                if ($this->profile['CURRENCY'][$_1284853936]['CHECK']) {
                                                    $_615351990 = $this->profile['CURRENCY'][$_1284853936]['CONVERT_TO'];
                                                    if ($this->profile['CURRENCY'][$_1284853936]['RATE'] == 'SITE') {
                                                        $_1766828534[$_1295533077] = CAcritExportproplusTools::RoundNumber(CCurrencyRates::ConvertCurrency($_1799584481['CATALOG_' . $_47247544[1]], $this->profile['CURRENCY'][$_1284853936]['CONVERT_FROM'], $_615351990), $_1639684675['ROUND']['PRECISION'], $_1639684675['ROUND']['MODE'], 0);
                                                        if (is_array($_851873695)) {
                                                            $_480208289 = $_1766828534[$_1295533077];
                                                        }
                                                    } else {
                                                        $_1766828534[$_1295533077] = CAcritExportproplusTools::RoundNumber($_1766828534[$_1295533077] * $this->_2112071826[$this->profile['CURRENCY'][$_1284853936]['RATE']][$_1284853936]['RATE'] / $this->_2112071826[$this->profile['CURRENCY'][$_1284853936]['RATE']][$_615351990]['RATE'] / $this->_2112071826[$this->profile['CURRENCY'][$_1284853936]['RATE']][$_1284853936]['RATE_CNT'] * $this->_2112071826[$this->profile['CURRENCY'][$_1284853936]['RATE']][$_615351990]['RATE_CNT'], $_1639684675['ROUND']['PRECISION'], $_1639684675['ROUND']['MODE'], 0);
                                                        if (is_array($_851873695)) {
                                                            $_480208289 = $_1766828534[$_1295533077];
                                                        }
                                                    }
                                                }
                                                if (!in_array($_1284853936, $this->_1364486914)) $this->_1364486914[] = $_1284853936;
                                            } else {
                                                if (!in_array($_1284853936, $this->_1364486914)) $this->_1364486914[] = $_1284853936;
                                            }
                                            if ($this->profile['CURRENCY'][$_1284853936]['CHECK']) {
                                                $_1766828534[$_1295533077] += $_1766828534[$_1295533077] * floatval($this->profile['CURRENCY'][$_1284853936]['PLUS']) / 100;
                                                $_1766828534[$_1295533077] = CAcritExportproplusTools::RoundNumber($_1766828534[$_1295533077], $_1639684675['ROUND']['PRECISION'], $_1639684675['ROUND']['MODE']);
                                                if (is_array($_851873695)) {
                                                    $_480208289 = $_1766828534[$_1295533077];
                                                }
                                            }
                                        }
                                        if (stripos($_47247544[1], '_WD') !== false) {
                                            if (in_array('PRICE_' . $_1799584481['CATALOG_' . $_47247544[1] . '_PRICEID'] . '_WD', $this->_1931809273) || in_array('PRICE_' . $_1799584481['CATALOG_' . $_47247544[1] . '_PRICEID'] . '_D', $this->_1931809273)) {
                                                $_1432753308 = CCatalogDiscount::GetDiscountByPrice($_1799584481['CATALOG_' . $_47247544[1] . '_ID'], $USER->GetUserGroupArray(), 'N', $this->profile['LID']);
                                                $_1156465674 = CCatalogProduct::CountPriceWithDiscount($_1766828534[$_1295533077], $_1799584481['CATALOG_' . $_47247544[1] . '_CURRENCY'], $_1432753308);
                                                $_277498185 = $_1766828534[$_1295533077] - $_1156465674;
                                            } else {
                                                $_1156465674 = $_1766828534[$_1295533077];
                                                $_277498185 = 0;
                                            }
                                            $_1799584481["CATALOG_PRICE_{$_1799584481['CATALOG_'.$_47247544[1].'_PRICEID']}_D"] = $_277498185;
                                            $_1799584481["CATALOG_PRICE_{$_1799584481['CATALOG_'.$_47247544[1].'_PRICEID']}_WD"] = $_1156465674;
                                            $_1766828534[$_1295533077] = $_1156465674;
                                            $_480208289 = $_1766828534[$_1295533077];
                                        }
                                        if ($_1639684675['BITRIX_ROUND_MODE'] == 'Y') {
                                            $_1766828534[$_1295533077] = CAcritExportproplusTools::BitrixRoundNumber($_1766828534[$_1295533077], $_47247544[1]);
                                        } else {
                                            $_1766828534[$_1295533077] = CAcritExportproplusTools::RoundNumber($_1766828534[$_1295533077], $_1639684675['ROUND']['PRECISION'], $_1639684675['ROUND']['MODE']);
                                        }
                                        if (is_array($_851873695)) {
                                            $_480208289 = $_1766828534[$_1295533077];
                                        }
                                        if (is_array($_851873695) && !is_null($_480208289)) $_5222085[$_29195840][$_1639684675['CODE']][] = $_480208289;
                                        if (isset($_1639684675['MINIMUM_OFFER_PRICE']) && ($_1639684675['MINIMUM_OFFER_PRICE'] == 'Y') && ($_1030859019['MINIMUM_OFFER_PRICE'] == 'Y')) {
                                            if (isset($_1658004309[$_29195840][$_1639684675['CODE']]) && count($_1658004309[$_29195840][$_1639684675['CODE']])) {
                                                if (isset($_1639684675['MINIMUM_OFFER_PRICE_CODE']) && strlen($_1639684675['MINIMUM_OFFER_PRICE_CODE'])) {
                                                    $_1766828534[$_548088880 . $_1639684675['MINIMUM_OFFER_PRICE_CODE'] . $_548088880] = min($_1658004309[$_29195840][$_1639684675['CODE']]);
                                                }
                                            }
                                        } elseif (isset($_1639684675['MINIMUM_OFFER_PRICE']) && ($_1639684675['MINIMUM_OFFER_PRICE'] == 'Y')) {
                                        }
                                        break;
                                    case 3:
                                        $_1799584481 = $_1642182436;
                                        if (isset($this->_508964447[$_29195840])) {
                                            $_1799584481 = $this->__1641660486($_485935950);
                                        }
                                        if ($_47247544[0] == $_1799584481['IBLOCK_ID'] || $_47247544[0] == $_851873695['IBLOCK_ID']) {
                                            if ($this->_2078735835[$_47247544[0]]['OFFERS_PROPERTY_ID'] == $_47247544[2]) {
                                                $_1799584481["PROPERTY_{$_47247544[2]}_DISPLAY_VALUE"] = CAcritExportproplusTools::RoundNumber($_1799584481["PROPERTY_{$_47247544[2]}_VALUE"][0], $_1639684675['ROUND']['PRECISION'], $_1639684675['ROUND']['MODE']);
                                            }
                                            if ($this->profile['XMLDATA']["{$_1639684675['CODE']}"]['PROCESS_LOGIC'] == 'N') {
                                                $_212220634 = $_1799584481["PROPERTY_{$_47247544[2]}_VALUE"];
                                            } else {
                                                $_212220634 = $_1799584481["PROPERTY_{$_47247544[2]}_DISPLAY_VALUE"];
                                            }
                                            if (is_array($_212220634)) {
                                                $_55309008 = CAcritExportproplusTools::ParseMultiproFormat($_212220634, $this->profile, $_1639684675['CODE']);
                                                $_212220634 = (is_array($_55309008) && !empty($_55309008)) ? $_55309008 : $_212220634;
                                                $_1766828534[$_1295533077] = array();
                                                foreach ($_212220634 as $_32014025) {
                                                    if (intval($this->profile['XMLDATA'][$_1639684675['CODE']]['MULTIPROP_LIMIT']) > 0) {
                                                        if (count($_1766828534[$_1295533077]) < $this->profile['XMLDATA'][$_1639684675['CODE']]['MULTIPROP_LIMIT']) {
                                                            $_1766828534[$_1295533077][] = CAcritExportproplusTools::RoundNumber($_32014025, $_1639684675['ROUND']['PRECISION'], $_1639684675['ROUND']['MODE']);
                                                        }
                                                    } else {
                                                        $_1766828534[$_1295533077][] = CAcritExportproplusTools::RoundNumber($_32014025, $_1639684675['ROUND']['PRECISION'], $_1639684675['ROUND']['MODE']);
                                                    }
                                                }
                                                if ($_1639684675['MULTIPROP_TO_STRING'] == 'Y') {
                                                    $_1574328650 = (strlen($_1639684675['MULTIPROP_DIVIDER']) > 0) ? $_1639684675['MULTIPROP_DIVIDER'] : ' ';
                                                    $_1766828534[$_1295533077] = implode($_1574328650, $_1766828534[$_1295533077]);
                                                }
                                            } else {
                                                $_1766828534[$_1295533077] = CAcritExportproplusTools::RoundNumber($_212220634, $_1639684675['ROUND']['PRECISION'], $_1639684675['ROUND']['MODE']);
                                            }
                                        }
                                        $_1799584481 = $_1642182436;
                                        break;
                                    case 5:
                                        $_1799584481 = $_1642182436;
                                        $_1799584481['HL'] = $this->__745667146($_47247544[0], $_47247544[3], $_1799584481);
                                        $_212220634 = $_1799584481['HL'][$_47247544[4]]['VALUE'];
                                        if (is_array($_212220634)) {
                                            $_55309008 = CAcritExportproplusTools::ParseMultiproFormat($_212220634, $this->profile, $_1639684675['CODE']);
                                            $_212220634 = (is_array($_55309008) && !empty($_55309008)) ? $_55309008 : $_212220634;
                                            $_1766828534[$_1295533077] = array();
                                            foreach ($_212220634 as $_32014025) {
                                                if (intval($this->profile['XMLDATA'][$_1639684675['CODE']]['MULTIPROP_LIMIT']) > 0) {
                                                    if (count($_1766828534[$_1295533077]) < $this->profile['XMLDATA'][$_1639684675['CODE']]['MULTIPROP_LIMIT']) {
                                                        $_1766828534[$_1295533077][] = CAcritExportproplusTools::RoundNumber($_32014025, $_1639684675['ROUND']['PRECISION'], $_1639684675['ROUND']['MODE']);
                                                    }
                                                } else {
                                                    $_1766828534[$_1295533077][] = CAcritExportproplusTools::RoundNumber($_32014025, $_1639684675['ROUND']['PRECISION'], $_1639684675['ROUND']['MODE']);
                                                }
                                            }
                                            if ($_1639684675['MULTIPROP_TO_STRING'] == 'Y') {
                                                $_1574328650 = (strlen($_1639684675['MULTIPROP_DIVIDER']) > 0) ? $_1639684675['MULTIPROP_DIVIDER'] : ' ';
                                                $_1766828534[$_1295533077] = implode($_1574328650, $_1766828534[$_1295533077]);
                                            }
                                        } else {
                                            $_1766828534[$_1295533077] = CAcritExportproplusTools::RoundNumber($_212220634, $_1639684675['ROUND']['PRECISION'], $_1639684675['ROUND']['MODE']);
                                        }
                                        break;
                                }
                            }
                        }
                    }
                }
            } else {
                if (($_1639684675['TYPE'] == 'field') || ($_1639684675['TYPE'] == 'composite') || ($_1639684675['TYPE'] == 'arithmetics') || ($_1639684675['TYPE'] == 'stack') || (($_1639684675['TYPE'] == 'complex') && ($_1639684675['COMPLEX_TRUE_TYPE'] == 'field'))) {
                    if ($_1639684675['TYPE'] == 'composite') {
                        $_240357056 = '';
                        $_1333249708 = (strlen($_1639684675['COMPOSITE_TRUE_DIVIDER']) > 0) ? $_1639684675['COMPOSITE_TRUE_DIVIDER'] : ' ';
                        foreach ($_1639684675['COMPOSITE_TRUE'] as $_628180431 => $_111434879) {
                            if ($_628180431 > 1) {
                                $_240357056 .= $_1333249708;
                            }
                            if ($_111434879['COMPOSITE_TRUE_TYPE'] == 'const') {
                                $_240357056 .= CAcritExportproplusTools::RoundNumber($_111434879['COMPOSITE_TRUE_CONTVALUE'], $_1639684675['ROUND']['PRECISION'], $_1639684675['ROUND']['MODE']);
                            } elseif ($_111434879['COMPOSITE_TRUE_TYPE'] == 'field') {
                                $_647344568 = '';
                                if (($_1639684675['CODE'] == 'URL') && function_exists('detailLink')) {
                                    $_647344568 = detailLink($_1799584481['ID']);
                                } else {
                                    $_47247544 = explode('-', $_111434879['COMPOSITE_TRUE_VALUE']);
                                    switch (count($_47247544)) {
                                        case 1:
                                            $_1799584481 = $_1642182436;
                                            if (isset($this->_508964447[$_29195840])) {
                                                $_1799584481 = $this->__1641660486($_485935950);
                                            }
                                            if (strpos($_111434879['COMPOSITE_TRUE_VALUE'], '.') !== false) {
                                                $_1117656864 = explode('.', $_111434879['COMPOSITE_TRUE_VALUE']);
                                                switch ($_1117656864[0]) {
                                                    case 'SECTION':
                                                        $_1490539831 = $_1063913501[$_1642182436['IBLOCK_ID']][$_1642182436['IBLOCK_SECTION_ID']];
                                                        $_1438955011 = $_1490539831[$_1117656864[1]] ?: '';
                                                        break;
                                                    default:
                                                        $_1438955011 = '';
                                                }
                                                unset($_1117656864);
                                                $_647344568 = CAcritExportproplusTools::RoundNumber($_1438955011, $_1639684675['ROUND']['PRECISION'], $_1639684675['ROUND']['MODE']);
                                            } else {
                                                $_647344568 = CAcritExportproplusTools::RoundNumber($_1799584481[$_111434879['COMPOSITE_TRUE_VALUE']], $_1639684675['ROUND']['PRECISION'], $_1639684675['ROUND']['MODE']);
                                            }
                                            $_1799584481 = $_1642182436;
                                            break;
                                        case 2:
                                            $_480208289 = null;
                                            $_647344568 = $_1799584481['CATALOG_' . $_47247544[1]];
                                            if (($_1639684675['VALUE'] == 'CATALOG-PURCHASING_PRICE') && isset($_1799584481['CATALOG_PURCHASING_PRICE'])) {
                                                preg_match('/PURCHASING_PRICE/', $_47247544[1], $_540983714);
                                            } else {
                                                preg_match('/PRICE_[\d]+/', $_47247544[1], $_540983714);
                                            }
                                            $_1284853936 = $_1799584481["CATALOG_{$_540983714[0]}_CURRENCY"];
                                            if (strpos($_47247544[1], '_CURRENCY') > 0) {
                                                $_647344568 = $_1284853936;
                                                $_647344568 = CAcritExportproplusTools::RoundNumber($_647344568, $_1639684675['ROUND']['PRECISION'], $_1639684675['ROUND']['MODE']);
                                                if (is_array($_851873695)) {
                                                    $_480208289 = $_647344568;
                                                }
                                                if ($this->profile['CURRENCY']['CONVERT_CURRENCY'] == 'Y') {
                                                    if ($this->profile['CURRENCY'][$_1284853936]['CHECK']) {
                                                        $_615351990 = $this->profile['CURRENCY'][$_1284853936]['CONVERT_TO'];
                                                        $_647344568 = $_615351990;
                                                        $_647344568 = CAcritExportproplusTools::RoundNumber($_647344568, $_1639684675['ROUND']['PRECISION'], $_1639684675['ROUND']['MODE']);
                                                        if (is_array($_851873695)) {
                                                            $_480208289 = $_647344568;
                                                        }
                                                    }
                                                }
                                            } elseif (!empty($_540983714[0])) {
                                                if ($this->profile['CURRENCY']['CONVERT_CURRENCY'] == 'Y') {
                                                    if ($this->profile['CURRENCY'][$_1284853936]['CHECK']) {
                                                        $_615351990 = $this->profile['CURRENCY'][$_1284853936]['CONVERT_TO'];
                                                        if ($this->profile['CURRENCY'][$_1284853936]['RATE'] == 'SITE') {
                                                            $_647344568 = CAcritExportproplusTools::RoundNumber(CCurrencyRates::ConvertCurrency($_1799584481['CATALOG_' . $_47247544[1]], $this->profile['CURRENCY'][$_1284853936]['CONVERT_FROM'], $_615351990), $_1639684675['ROUND']['PRECISION'], $_1639684675['ROUND']['MODE'], 0);
                                                            if (is_array($_851873695)) {
                                                                $_480208289 = $_647344568;
                                                            }
                                                        } else {
                                                            $_647344568 = CAcritExportproplusTools::RoundNumber($_647344568 * $this->_2112071826[$this->profile['CURRENCY'][$_1284853936]['RATE']][$_1284853936]['RATE'] / $this->_2112071826[$this->profile['CURRENCY'][$_1284853936]['RATE']][$_615351990]['RATE'] / $this->_2112071826[$this->profile['CURRENCY'][$_1284853936]['RATE']][$_1284853936]['RATE_CNT'] * $this->_2112071826[$this->profile['CURRENCY'][$_1284853936]['RATE']][$_615351990]['RATE_CNT'], $_1639684675['ROUND']['PRECISION'], $_1639684675['ROUND']['MODE'], 0);
                                                            if (is_array($_851873695)) {
                                                                $_480208289 = $_647344568;
                                                            }
                                                        }
                                                    }
                                                    if (!in_array($_1284853936, $this->_1364486914)) $this->_1364486914[] = $_1284853936;
                                                } else {
                                                    if (!in_array($_1284853936, $this->_1364486914)) $this->_1364486914[] = $_1284853936;
                                                }
                                                if ($this->profile['CURRENCY'][$_1284853936]['CHECK']) {
                                                    $_647344568 += $_647344568 * floatval($this->profile['CURRENCY'][$_1284853936]['PLUS']) / 100;
                                                    $_647344568 = CAcritExportproplusTools::RoundNumber($_647344568, $_1639684675['ROUND']['PRECISION'], $_1639684675['ROUND']['MODE']);
                                                    if (is_array($_851873695)) {
                                                        $_480208289 = $_647344568;
                                                    }
                                                }
                                            }
                                            if (stripos($_47247544[1], '_WD') !== false) {
                                                if (in_array('PRICE_' . $_1799584481['CATALOG_' . $_47247544[1] . '_PRICEID'] . '_WD', $this->_1931809273) || in_array('PRICE_' . $_1799584481['CATALOG_' . $_47247544[1] . '_PRICEID'] . '_D', $this->_1931809273)) {
                                                    $_1432753308 = CCatalogDiscount::GetDiscountByPrice($_1799584481['CATALOG_' . $_47247544[1] . '_ID'], $USER->GetUserGroupArray(), 'N', $this->profile['LID']);
                                                    $_1156465674 = CCatalogProduct::CountPriceWithDiscount($_647344568, $_1799584481['CATALOG_' . $_47247544[1] . '_CURRENCY'], $_1432753308);
                                                    $_277498185 = $_647344568 - $_1156465674;
                                                } else {
                                                    $_1156465674 = $_647344568;
                                                    $_277498185 = 0;
                                                }
                                                $_1799584481["CATALOG_PRICE_{$_1799584481['CATALOG_'.$_47247544[1].'_PRICEID']}_D"] = $_277498185;
                                                $_1799584481["CATALOG_PRICE_{$_1799584481['CATALOG_'.$_47247544[1].'_PRICEID']}_WD"] = $_1156465674;
                                                $_647344568 = $_1156465674;
                                                $_480208289 = $_647344568;
                                            }
                                            if ($_1639684675['BITRIX_ROUND_MODE'] == 'Y') {
                                                $_647344568 = CAcritExportproplusTools::BitrixRoundNumber($_647344568, $_47247544[1]);
                                            } else {
                                                $_647344568 = CAcritExportproplusTools::RoundNumber($_647344568, $_1639684675['ROUND']['PRECISION'], $_1639684675['ROUND']['MODE']);
                                            }
                                            if (is_array($_851873695)) {
                                                $_480208289 = $_647344568;
                                            }
                                            if (is_array($_851873695) && !is_null($_480208289)) $_5222085[$_29195840][$_1639684675['CODE']][] = $_480208289;
                                            break;
                                        case 3:
                                            $_1799584481 = $_1642182436;
                                            if (isset($this->_508964447[$_29195840])) {
                                                $_1799584481 = $this->__1641660486($_485935950);
                                            }
                                            if (($_47247544[0] == $_1799584481['IBLOCK_ID']) || ($_47247544[0] == $_851873695['IBLOCK_ID'])) {
                                                if ($this->_2078735835[$_47247544[0]]['OFFERS_PROPERTY_ID'] == $_47247544[2]) {
                                                    $_1799584481["PROPERTY_{$_47247544[2]}_DISPLAY_VALUE"] = CAcritExportproplusTools::RoundNumber($_1799584481["PROPERTY_{$_47247544[2]}_VALUE"][0], $_1639684675['ROUND']['PRECISION'], $_1639684675['ROUND']['MODE']);
                                                }
                                                if ($this->profile['XMLDATA']["{$_1639684675['CODE']}"]['PROCESS_LOGIC'] == 'N') {
                                                    $_212220634 = $_1799584481["PROPERTY_{$_47247544[2]}_VALUE"];
                                                } else {
                                                    $_212220634 = $_1799584481["PROPERTY_{$_47247544[2]}_DISPLAY_VALUE"];
                                                }
                                                if (is_array($_212220634)) {
                                                    $_55309008 = CAcritExportproplusTools::ParseMultiproFormat($_212220634, $this->profile, $_1639684675['CODE']);
                                                    $_212220634 = (is_array($_55309008) && !empty($_55309008)) ? $_55309008 : $_212220634;
                                                    $_647344568 = array();
                                                    foreach ($_212220634 as $_32014025) {
                                                        if (intval($this->profile['XMLDATA'][$_1639684675['CODE']]['MULTIPROP_LIMIT']) > 0) {
                                                            if (count($_647344568) < $this->profile['XMLDATA'][$_1639684675['CODE']]['MULTIPROP_LIMIT']) {
                                                                $_647344568[] = CAcritExportproplusTools::RoundNumber($_32014025, $_1639684675['ROUND']['PRECISION'], $_1639684675['ROUND']['MODE']);
                                                            }
                                                        } else {
                                                            $_647344568[] = CAcritExportproplusTools::RoundNumber($_32014025, $_1639684675['ROUND']['PRECISION'], $_1639684675['ROUND']['MODE']);
                                                        }
                                                    }
                                                    $_723690939 = '';
                                                    if (!empty($_647344568)) {
                                                        foreach ($_647344568 as $_271923141 => $_1038738500) {
                                                            if ($_271923141) {
                                                                $_723690939 .= $_1333249708;
                                                            }
                                                            $_723690939 .= $_1038738500;
                                                        }
                                                    }
                                                    if (strlen($_723690939) > 0) {
                                                        $_647344568 = $_723690939;
                                                    }
                                                    if ($_1639684675['MULTIPROP_TO_STRING'] == 'Y') {
                                                        $_1574328650 = (strlen($_1639684675['MULTIPROP_DIVIDER']) > 0) ? $_1639684675['MULTIPROP_DIVIDER'] : ' ';
                                                        $_647344568 = implode($_1574328650, $_647344568);
                                                    }
                                                } else {
                                                    $_647344568 = CAcritExportproplusTools::RoundNumber($_212220634, $_1639684675['ROUND']['PRECISION'], $_1639684675['ROUND']['MODE']);
                                                }
                                            }
                                            $_1799584481 = $_1642182436;
                                            break;
                                        case 5:
                                            $_1799584481 = $_1642182436;
                                            $_1799584481['HL'] = $this->__745667146($_47247544[0], $_47247544[3], $_1799584481);
                                            $_212220634 = $_1799584481['HL'][$_47247544[4]]['VALUE'];
                                            if (is_array($_212220634)) {
                                                $_55309008 = CAcritExportproplusTools::ParseMultiproFormat($_212220634, $this->profile, $_1639684675['CODE']);
                                                $_212220634 = (is_array($_55309008) && !empty($_55309008)) ? $_55309008 : $_212220634;
                                                $_647344568 = array();
                                                foreach ($_212220634 as $_32014025) {
                                                    if (intval($this->profile['XMLDATA'][$_1639684675['CODE']]['MULTIPROP_LIMIT']) > 0) {
                                                        if (count($_647344568) < $this->profile['XMLDATA'][$_1639684675['CODE']]['MULTIPROP_LIMIT']) {
                                                            $_647344568[] = CAcritExportproplusTools::RoundNumber($_32014025, $_1639684675['ROUND']['PRECISION'], $_1639684675['ROUND']['MODE']);
                                                        }
                                                    } else {
                                                        $_647344568[] = CAcritExportproplusTools::RoundNumber($_32014025, $_1639684675['ROUND']['PRECISION'], $_1639684675['ROUND']['MODE']);
                                                    }
                                                }
                                                $_723690939 = '';
                                                if (!empty($_647344568)) {
                                                    foreach ($_647344568 as $_271923141 => $_1038738500) {
                                                        if ($_271923141) {
                                                            $_723690939 .= $_1333249708;
                                                        }
                                                        $_723690939 .= $_1038738500;
                                                    }
                                                }
                                                if (strlen($_723690939) > 0) {
                                                    $_647344568 = $_723690939;
                                                }
                                                if ($_1639684675['MULTIPROP_TO_STRING'] == 'Y') {
                                                    $_1574328650 = (strlen($_1639684675['MULTIPROP_DIVIDER']) > 0) ? $_1639684675['MULTIPROP_DIVIDER'] : ' ';
                                                    $_647344568 = implode($_1574328650, $_647344568);
                                                }
                                            } else {
                                                $_647344568 = CAcritExportproplusTools::RoundNumber($_212220634, $_1639684675['ROUND']['PRECISION'], $_1639684675['ROUND']['MODE']);
                                            }
                                            $_1799584481 = $_1642182436;
                                            break;
                                    }
                                }
                                $_240357056 .= $_647344568;
                            }
                        }
                        $_1766828534[$_1295533077] = CAcritExportproplusTools::RoundNumber($_240357056, $_1639684675['ROUND']['PRECISION'], $_1639684675['ROUND']['MODE']);
                    } elseif ($_1639684675['TYPE'] == 'arithmetics') {
                        $_1461018321 = trim($_1639684675['ARITHMETICS_TRUE_DIVIDER']);
                        $_1639684675['ARITHMETICS_TRUE'] = array_reverse($_1639684675['ARITHMETICS_TRUE'], true);
                        $_685823106 = true;
                        foreach ($_1639684675['ARITHMETICS_TRUE'] as $_1630858607 => $_1528140672) {
                            if ($_1528140672['ARITHMETICS_TRUE_TYPE'] == 'const') {
                                $_1461018321 = str_replace('x' . $_1630858607, CAcritExportproplusTools::RoundNumber($_1528140672['ARITHMETICS_TRUE_CONTVALUE'], $_1639684675['ROUND']['PRECISION'], $_1639684675['ROUND']['MODE']), $_1461018321);
                            } elseif ($_1528140672['ARITHMETICS_TRUE_TYPE'] == 'field') {
                                $_1266989984 = '';
                                if (($_1639684675['CODE'] == 'URL') && function_exists('detailLink')) {
                                    $_1266989984 = detailLink($_1799584481['ID']);
                                } else {
                                    $_47247544 = explode('-', $_1528140672['ARITHMETICS_TRUE_VALUE']);
                                    switch (count($_47247544)) {
                                        case 1:
                                            $_1799584481 = $_1642182436;
                                            if (isset($this->_508964447[$_29195840])) {
                                                $_1799584481 = $this->__1641660486($_485935950);
                                            }
                                            if (strpos($_1528140672['ARITHMETICS_TRUE_VALUE'], '.') !== false) {
                                                $_1117656864 = explode('.', $_1528140672['ARITHMETICS_TRUE_VALUE']);
                                                switch ($_1117656864[0]) {
                                                    case 'SECTION':
                                                        $_1490539831 = $_1063913501[$_1642182436['IBLOCK_ID']][$_1642182436['IBLOCK_SECTION_ID']];
                                                        $_1438955011 = $_1490539831[$_1117656864[1]] ?: '';
                                                        break;
                                                    default:
                                                        $_1438955011 = '';
                                                }
                                                unset($_1117656864);
                                                $_1266989984 = CAcritExportproplusTools::RoundNumber($_1438955011, $_1639684675['ROUND']['PRECISION'], $_1639684675['ROUND']['MODE']);
                                            } else {
                                                $_1266989984 = CAcritExportproplusTools::RoundNumber($_1799584481[$_1528140672['ARITHMETICS_TRUE_VALUE']], $_1639684675['ROUND']['PRECISION'], $_1639684675['ROUND']['MODE']);
                                            }
                                            $_1799584481 = $_1642182436;
                                            break;
                                        case 2:
                                            $_480208289 = null;
                                            $_1266989984 = $_1799584481['CATALOG_' . $_47247544[1]];
                                            if (($_1639684675['VALUE'] == 'CATALOG-PURCHASING_PRICE') && isset($_1799584481['CATALOG_PURCHASING_PRICE'])) {
                                                preg_match('/PURCHASING_PRICE/', $_47247544[1], $_540983714);
                                            } else {
                                                preg_match('/PRICE_[\d]+/', $_47247544[1], $_540983714);
                                            }
                                            $_1284853936 = $_1799584481["CATALOG_{$_540983714[0]}_CURRENCY"];
                                            if (strpos($_47247544[1], '_CURRENCY') > 0) {
                                                $_1266989984 = $_1284853936;
                                                $_1266989984 = CAcritExportproplusTools::RoundNumber($_1266989984, $_1639684675['ROUND']['PRECISION'], $_1639684675['ROUND']['MODE']);
                                                if (is_array($_851873695)) {
                                                    $_480208289 = $_1266989984;
                                                }
                                                if ($this->profile['CURRENCY']['CONVERT_CURRENCY'] == 'Y') {
                                                    if ($this->profile['CURRENCY'][$_1284853936]['CHECK']) {
                                                        $_615351990 = $this->profile['CURRENCY'][$_1284853936]['CONVERT_TO'];
                                                        $_1266989984 = $_615351990;
                                                        $_1266989984 = CAcritExportproplusTools::RoundNumber($_1266989984, $_1639684675['ROUND']['PRECISION'], $_1639684675['ROUND']['MODE']);
                                                        if (is_array($_851873695)) {
                                                            $_480208289 = $_1266989984;
                                                        }
                                                    }
                                                }
                                            } elseif (!empty($_540983714[0])) {
                                                if ($this->profile['CURRENCY']['CONVERT_CURRENCY'] == 'Y') {
                                                    if ($this->profile['CURRENCY'][$_1284853936]['CHECK']) {
                                                        $_615351990 = $this->profile['CURRENCY'][$_1284853936]['CONVERT_TO'];
                                                        if ($this->profile['CURRENCY'][$_1284853936]['RATE'] == 'SITE') {
                                                            $_1266989984 = CAcritExportproplusTools::RoundNumber(CCurrencyRates::ConvertCurrency($_1799584481['CATALOG_' . $_47247544[1]], $this->profile['CURRENCY'][$_1284853936]['CONVERT_FROM'], $_615351990), $_1639684675['ROUND']['PRECISION'], $_1639684675['ROUND']['MODE'], 0);
                                                            if (is_array($_851873695)) {
                                                                $_480208289 = $_1266989984;
                                                            }
                                                        } else {
                                                            $_1266989984 = CAcritExportproplusTools::RoundNumber($_1266989984 * $this->_2112071826[$this->profile['CURRENCY'][$_1284853936]['RATE']][$_1284853936]['RATE'] / $this->_2112071826[$this->profile['CURRENCY'][$_1284853936]['RATE']][$_615351990]['RATE'] / $this->_2112071826[$this->profile['CURRENCY'][$_1284853936]['RATE']][$_1284853936]['RATE_CNT'] * $this->_2112071826[$this->profile['CURRENCY'][$_1284853936]['RATE']][$_615351990]['RATE_CNT'], $_1639684675['ROUND']['PRECISION'], $_1639684675['ROUND']['MODE'], 0);
                                                            if (is_array($_851873695)) {
                                                                $_480208289 = $_1266989984;
                                                            }
                                                        }
                                                    }
                                                    if (!in_array($_1284853936, $this->_1364486914)) $this->_1364486914[] = $_1284853936;
                                                } else {
                                                    if (!in_array($_1284853936, $this->_1364486914)) $this->_1364486914[] = $_1284853936;
                                                }
                                                if ($this->profile['CURRENCY'][$_1284853936]['CHECK']) {
                                                    $_1266989984 += $_1266989984 * floatval($this->profile['CURRENCY'][$_1284853936]['PLUS']) / 100;
                                                    $_1266989984 = CAcritExportproplusTools::RoundNumber($_1266989984, $_1639684675['ROUND']['PRECISION'], $_1639684675['ROUND']['MODE']);
                                                    if (is_array($_851873695)) {
                                                        $_480208289 = $_1266989984;
                                                    }
                                                }
                                            }
                                            if (stripos($_47247544[1], '_WD') !== false) {
                                                if (in_array('PRICE_' . $_1799584481['CATALOG_' . $_47247544[1] . '_PRICEID'] . '_WD', $this->_1931809273) || in_array('PRICE_' . $_1799584481['CATALOG_' . $_47247544[1] . '_PRICEID'] . '_D', $this->_1931809273)) {
                                                    $_1432753308 = CCatalogDiscount::GetDiscountByPrice($_1799584481['CATALOG_' . $_47247544[1] . '_ID'], $USER->GetUserGroupArray(), 'N', $this->profile['LID']);
                                                    $_1156465674 = CCatalogProduct::CountPriceWithDiscount($_1266989984, $_1799584481['CATALOG_' . $_47247544[1] . '_CURRENCY'], $_1432753308);
                                                    $_277498185 = $_1266989984 - $_1156465674;
                                                } else {
                                                    $_1156465674 = $_1266989984;
                                                    $_277498185 = 0;
                                                }
                                                $_1799584481["CATALOG_PRICE_{$_1799584481['CATALOG_'.$_47247544[1].'_PRICEID']}_D"] = $_277498185;
                                                $_1799584481["CATALOG_PRICE_{$_1799584481['CATALOG_'.$_47247544[1].'_PRICEID']}_WD"] = $_1156465674;
                                                $_1266989984 = $_1156465674;
                                                $_480208289 = $_1266989984;
                                            }
                                            if ($_1639684675['BITRIX_ROUND_MODE'] == 'Y') {
                                                $_1266989984 = CAcritExportproplusTools::BitrixRoundNumber($_1266989984, $_47247544[1]);
                                            } else {
                                                $_1266989984 = CAcritExportproplusTools::RoundNumber($_1266989984, $_1639684675['ROUND']['PRECISION'], $_1639684675['ROUND']['MODE']);
                                            }
                                            if (is_array($_851873695)) {
                                                $_480208289 = $_1266989984;
                                            }
                                            if (is_array($_851873695) && !is_null($_480208289)) $_5222085[$_29195840][$_1639684675['CODE']][] = $_480208289;
                                            break;
                                        case 3:
                                            $_1799584481 = $_1642182436;
                                            if (isset($this->_508964447[$_29195840])) {
                                                $_1799584481 = $this->__1641660486($_485935950);
                                            }
                                            if (($_47247544[0] == $_1799584481['IBLOCK_ID']) || ($_47247544[0] == $_851873695['IBLOCK_ID'])) {
                                                if ($this->_2078735835[$_47247544[0]]['OFFERS_PROPERTY_ID'] == $_47247544[2]) {
                                                    $_1799584481["PROPERTY_{$_47247544[2]}_DISPLAY_VALUE"] = CAcritExportproplusTools::RoundNumber($_1799584481["PROPERTY_{$_47247544[2]}_VALUE"][0], $_1639684675['ROUND']['PRECISION'], $_1639684675['ROUND']['MODE']);
                                                }
                                                if ($this->profile['XMLDATA']["{$_1639684675['CODE']}"]['PROCESS_LOGIC'] == 'N') {
                                                    $_212220634 = $_1799584481["PROPERTY_{$_47247544[2]}_VALUE"];
                                                } else {
                                                    $_212220634 = $_1799584481["PROPERTY_{$_47247544[2]}_DISPLAY_VALUE"];
                                                }
                                                if (is_array($_212220634)) {
                                                    $_1266989984 = CAcritExportproplusTools::RoundNumber($_212220634[0], $_1639684675['ROUND']['PRECISION'], $_1639684675['ROUND']['MODE']);
                                                } else {
                                                    $_1266989984 = CAcritExportproplusTools::RoundNumber($_212220634, $_1639684675['ROUND']['PRECISION'], $_1639684675['ROUND']['MODE']);
                                                }
                                            }
                                            $_1799584481 = $_1642182436;
                                            break;
                                        case 5:
                                            $_1799584481 = $_1642182436;
                                            $_1799584481['HL'] = $this->__745667146($_47247544[0], $_47247544[3], $_1799584481);
                                            $_212220634 = $_1799584481['HL'][$_47247544[4]]['VALUE'];
                                            if (is_array($_212220634)) {
                                                $_1266989984 = CAcritExportproplusTools::RoundNumber($_212220634[0], $_1639684675['ROUND']['PRECISION'], $_1639684675['ROUND']['MODE']);
                                            } else {
                                                $_1266989984 = CAcritExportproplusTools::RoundNumber($_212220634, $_1639684675['ROUND']['PRECISION'], $_1639684675['ROUND']['MODE']);
                                            }
                                            $_1799584481 = $_1642182436;
                                            break;
                                    }
                                }
                                $_1461018321 = str_replace('x' . $_1630858607, CAcritExportproplusTools::RoundNumber($_1266989984, $_1639684675['ROUND']['PRECISION'], $_1639684675['ROUND']['MODE']), $_1461018321);
                                if (!strlen(trim($_1266989984))) {
                                    $this->_940439577->AddMessage("{$_1799584481['NAME']} (ID:{$_1799584481['ID']}) : " . str_replace('#FIELD#', 'x' . $_1630858607, GetMessage('ACRIT_EXPORTPROPLUS_ARITHMETICS_FIELD_NO_OPERAND')));
                                    $this->_940439577->IncProductError();
                                    $_685823106 = false;
                                }
                            }
                        }
                        if ($_685823106) {
                            $_1766828534[$_1295533077] = CAcritExportproplusTools::RoundNumber(CAcritExportproplusTools::CalculateString($_1461018321), $_1639684675['ROUND']['PRECISION'], $_1639684675['ROUND']['MODE']);
                        } else {
                            $_1766828534[$_1295533077] = '';
                        }
                    } elseif ($_1639684675['TYPE'] == 'stack') {
                        $_1880174775 = '';
                        foreach ($_1639684675['STACK_TRUE'] as $_845292619 => $_279295239) {
                            if ($_279295239['STACK_TRUE_TYPE'] == 'const') {
                                $_1880174775 = CAcritExportproplusTools::RoundNumber($_279295239['STACK_TRUE_CONTVALUE'], $_1639684675['ROUND']['PRECISION'], $_1639684675['ROUND']['MODE']);
                            } elseif ($_279295239['STACK_TRUE_TYPE'] == 'field') {
                                $_1880174775 = '';
                                if (($_1639684675['CODE'] == 'URL') && function_exists('detailLink')) {
                                    $_1880174775 = detailLink($_1799584481['ID']);
                                } else {
                                    $_47247544 = explode('-', $_279295239['STACK_TRUE_VALUE']);
                                    switch (count($_47247544)) {
                                        case 1:
                                            $_1799584481 = $_1642182436;
                                            if (isset($this->_508964447[$_29195840])) {
                                                $_1799584481 = $this->__1641660486($_485935950);
                                            }
                                            if (strpos($_279295239['STACK_TRUE_VALUE'], '.') !== false) {
                                                $_1117656864 = explode('.', $_279295239['STACK_TRUE_VALUE']);
                                                switch ($_1117656864[0]) {
                                                    case 'SECTION':
                                                        $_1490539831 = $_1063913501[$_1642182436['IBLOCK_ID']][$_1642182436['IBLOCK_SECTION_ID']];
                                                        $_1438955011 = $_1490539831[$_1117656864[1]] ?: '';
                                                        break;
                                                    default:
                                                        $_1438955011 = '';
                                                }
                                                unset($_1117656864);
                                                $_1880174775 = CAcritExportproplusTools::RoundNumber($_1438955011, $_1639684675['ROUND']['PRECISION'], $_1639684675['ROUND']['MODE']);
                                            } else {
                                                $_1880174775 = CAcritExportproplusTools::RoundNumber($_1799584481[$_279295239['STACK_TRUE_VALUE']], $_1639684675['ROUND']['PRECISION'], $_1639684675['ROUND']['MODE']);
                                            }
                                            $_1799584481 = $_1642182436;
                                            break;
                                        case 2:
                                            $_480208289 = null;
                                            $_1880174775 = $_1799584481['CATALOG_' . $_47247544[1]];
                                            if (($_1639684675['VALUE'] == 'CATALOG-PURCHASING_PRICE') && isset($_1799584481['CATALOG_PURCHASING_PRICE'])) {
                                                preg_match('/PURCHASING_PRICE/', $_47247544[1], $_540983714);
                                            } else {
                                                preg_match('/PRICE_[\d]+/', $_47247544[1], $_540983714);
                                            }
                                            $_1284853936 = $_1799584481["CATALOG_{$_540983714[0]}_CURRENCY"];
                                            if (strpos($_47247544[1], '_CURRENCY') > 0) {
                                                $_1880174775 = $_1284853936;
                                                $_1880174775 = CAcritExportproplusTools::RoundNumber($_1880174775, $_1639684675['ROUND']['PRECISION'], $_1639684675['ROUND']['MODE']);
                                                if (is_array($_851873695)) {
                                                    $_480208289 = $_1880174775;
                                                }
                                                if ($this->profile['CURRENCY']['CONVERT_CURRENCY'] == 'Y') {
                                                    if ($this->profile['CURRENCY'][$_1284853936]['CHECK']) {
                                                        $_615351990 = $this->profile['CURRENCY'][$_1284853936]['CONVERT_TO'];
                                                        $_1880174775 = $_615351990;
                                                        $_1880174775 = CAcritExportproplusTools::RoundNumber($_1880174775, $_1639684675['ROUND']['PRECISION'], $_1639684675['ROUND']['MODE']);
                                                        if (is_array($_851873695)) {
                                                            $_480208289 = $_1880174775;
                                                        }
                                                    }
                                                }
                                            } elseif (!empty($_540983714[0])) {
                                                if ($this->profile['CURRENCY']['CONVERT_CURRENCY'] == 'Y') {
                                                    if ($this->profile['CURRENCY'][$_1284853936]['CHECK']) {
                                                        $_615351990 = $this->profile['CURRENCY'][$_1284853936]['CONVERT_TO'];
                                                        if ($this->profile['CURRENCY'][$_1284853936]['RATE'] == 'SITE') {
                                                            $_1880174775 = CAcritExportproplusTools::RoundNumber(CCurrencyRates::ConvertCurrency($_1799584481['CATALOG_' . $_47247544[1]], $this->profile['CURRENCY'][$_1284853936]['CONVERT_FROM'], $_615351990), $_1639684675['ROUND']['PRECISION'], $_1639684675['ROUND']['MODE'], 0);
                                                            if (is_array($_851873695)) {
                                                                $_480208289 = $_1880174775;
                                                            }
                                                        } else {
                                                            $_1880174775 = CAcritExportproplusTools::RoundNumber($_1880174775 * $this->_2112071826[$this->profile['CURRENCY'][$_1284853936]['RATE']][$_1284853936]['RATE'] / $this->_2112071826[$this->profile['CURRENCY'][$_1284853936]['RATE']][$_615351990]['RATE'] / $this->_2112071826[$this->profile['CURRENCY'][$_1284853936]['RATE']][$_1284853936]['RATE_CNT'] * $this->_2112071826[$this->profile['CURRENCY'][$_1284853936]['RATE']][$_615351990]['RATE_CNT'], $_1639684675['ROUND']['PRECISION'], $_1639684675['ROUND']['MODE'], 0);
                                                            if (is_array($_851873695)) {
                                                                $_480208289 = $_1880174775;
                                                            }
                                                        }
                                                    }
                                                    if (!in_array($_1284853936, $this->_1364486914)) $this->_1364486914[] = $_1284853936;
                                                } else {
                                                    if (!in_array($_1284853936, $this->_1364486914)) $this->_1364486914[] = $_1284853936;
                                                }
                                                if ($this->profile['CURRENCY'][$_1284853936]['CHECK']) {
                                                    $_1880174775 += $_1880174775 * floatval($this->profile['CURRENCY'][$_1284853936]['PLUS']) / 100;
                                                    $_1880174775 = CAcritExportproplusTools::RoundNumber($_1880174775, $_1639684675['ROUND']['PRECISION'], $_1639684675['ROUND']['MODE']);
                                                    if (is_array($_851873695)) {
                                                        $_480208289 = $_1880174775;
                                                    }
                                                }
                                            }
                                            if (stripos($_47247544[1], '_WD') !== false) {
                                                if (in_array('PRICE_' . $_1799584481['CATALOG_' . $_47247544[1] . '_PRICEID'] . '_WD', $this->_1931809273) || in_array('PRICE_' . $_1799584481['CATALOG_' . $_47247544[1] . '_PRICEID'] . '_D', $this->_1931809273)) {
                                                    $_1432753308 = CCatalogDiscount::GetDiscountByPrice($_1799584481['CATALOG_' . $_47247544[1] . '_ID'], $USER->GetUserGroupArray(), 'N', $this->profile['LID']);
                                                    $_1156465674 = CCatalogProduct::CountPriceWithDiscount($_1880174775, $_1799584481['CATALOG_' . $_47247544[1] . '_CURRENCY'], $_1432753308);
                                                    $_277498185 = $_1880174775 - $_1156465674;
                                                } else {
                                                    $_1156465674 = $_1880174775;
                                                    $_277498185 = 0;
                                                }
                                                $_1799584481["CATALOG_PRICE_{$_1799584481['CATALOG_'.$_47247544[1].'_PRICEID']}_D"] = $_277498185;
                                                $_1799584481["CATALOG_PRICE_{$_1799584481['CATALOG_'.$_47247544[1].'_PRICEID']}_WD"] = $_1156465674;
                                                $_1880174775 = $_1156465674;
                                                $_480208289 = $_1880174775;
                                            }
                                            if ($_1639684675['BITRIX_ROUND_MODE'] == 'Y') {
                                                $_1880174775 = CAcritExportproplusTools::BitrixRoundNumber($_1880174775, $_47247544[1]);
                                            } else {
                                                $_1880174775 = CAcritExportproplusTools::RoundNumber($_1880174775, $_1639684675['ROUND']['PRECISION'], $_1639684675['ROUND']['MODE']);
                                            }
                                            if (is_array($_851873695)) {
                                                $_480208289 = $_1880174775;
                                            }
                                            if (is_array($_851873695) && !is_null($_480208289)) $_5222085[$_29195840][$_1639684675['CODE']][] = $_480208289;
                                            break;
                                        case 3:
                                            $_1799584481 = $_1642182436;
                                            if (isset($this->_508964447[$_29195840])) {
                                                $_1799584481 = $this->__1641660486($_485935950);
                                            }
                                            if (($_47247544[0] == $_1799584481['IBLOCK_ID']) || ($_47247544[0] == $_851873695['IBLOCK_ID'])) {
                                                if ($this->_2078735835[$_47247544[0]]['OFFERS_PROPERTY_ID'] == $_47247544[2]) {
                                                    $_1799584481["PROPERTY_{$_47247544[2]}_DISPLAY_VALUE"] = CAcritExportproplusTools::RoundNumber($_1799584481["PROPERTY_{$_47247544[2]}_VALUE"][0], $_1639684675['ROUND']['PRECISION'], $_1639684675['ROUND']['MODE']);
                                                }
                                                if ($this->profile['XMLDATA']["{$_1639684675['CODE']}"]['PROCESS_LOGIC'] == 'N') {
                                                    $_212220634 = $_1799584481["PROPERTY_{$_47247544[2]}_VALUE"];
                                                } else {
                                                    $_212220634 = $_1799584481["PROPERTY_{$_47247544[2]}_DISPLAY_VALUE"];
                                                }
                                                if (is_array($_212220634)) {
                                                    $_55309008 = CAcritExportproplusTools::ParseMultiproFormat($_212220634, $this->profile, $_1639684675['CODE']);
                                                    $_212220634 = (is_array($_55309008) && !empty($_55309008)) ? $_55309008 : $_212220634;
                                                    $_1880174775 = array();
                                                    foreach ($_212220634 as $_32014025) {
                                                        if (intval($this->profile['XMLDATA'][$_1639684675['CODE']]['MULTIPROP_LIMIT']) > 0) {
                                                            if (count($_1880174775) < $this->profile['XMLDATA'][$_1639684675['CODE']]['MULTIPROP_LIMIT']) {
                                                                $_1880174775[] = CAcritExportproplusTools::RoundNumber($_32014025, $_1639684675['ROUND']['PRECISION'], $_1639684675['ROUND']['MODE']);
                                                            }
                                                        } else {
                                                            $_1880174775[] = CAcritExportproplusTools::RoundNumber($_32014025, $_1639684675['ROUND']['PRECISION'], $_1639684675['ROUND']['MODE']);
                                                        }
                                                    }
                                                    if ($_1639684675['MULTIPROP_TO_STRING'] == 'Y') {
                                                        $_1574328650 = (strlen($_1639684675['MULTIPROP_DIVIDER']) > 0) ? $_1639684675['MULTIPROP_DIVIDER'] : ' ';
                                                        $_1880174775 = implode($_1574328650, $_1880174775);
                                                    }
                                                } else {
                                                    $_1880174775 = CAcritExportproplusTools::RoundNumber($_212220634, $_1639684675['ROUND']['PRECISION'], $_1639684675['ROUND']['MODE']);
                                                }
                                            }
                                            $_1799584481 = $_1642182436;
                                            break;
                                        case 5:
                                            $_1799584481 = $_1642182436;
                                            $_1799584481['HL'] = $this->__745667146($_47247544[0], $_47247544[3], $_1799584481);
                                            $_212220634 = $_1799584481['HL'][$_47247544[4]]['VALUE'];
                                            if (is_array($_212220634)) {
                                                $_55309008 = CAcritExportproplusTools::ParseMultiproFormat($_212220634, $this->profile, $_1639684675['CODE']);
                                                $_212220634 = (is_array($_55309008) && !empty($_55309008)) ? $_55309008 : $_212220634;
                                                $_1880174775 = array();
                                                foreach ($_212220634 as $_32014025) {
                                                    if (intval($this->profile['XMLDATA'][$_1639684675['CODE']]['MULTIPROP_LIMIT']) > 0) {
                                                        if (count($_1880174775) < $this->profile['XMLDATA'][$_1639684675['CODE']]['MULTIPROP_LIMIT']) {
                                                            $_1880174775[] = CAcritExportproplusTools::RoundNumber($_32014025, $_1639684675['ROUND']['PRECISION'], $_1639684675['ROUND']['MODE']);
                                                        }
                                                    } else {
                                                        $_1880174775[] = CAcritExportproplusTools::RoundNumber($_32014025, $_1639684675['ROUND']['PRECISION'], $_1639684675['ROUND']['MODE']);
                                                    }
                                                }
                                                if ($_1639684675['MULTIPROP_TO_STRING'] == 'Y') {
                                                    $_1574328650 = (strlen($_1639684675['MULTIPROP_DIVIDER']) > 0) ? $_1639684675['MULTIPROP_DIVIDER'] : ' ';
                                                    $_1880174775 = implode($_1574328650, $_1880174775);
                                                }
                                            } else {
                                                $_1880174775 = CAcritExportproplusTools::RoundNumber($_212220634, $_1639684675['ROUND']['PRECISION'], $_1639684675['ROUND']['MODE']);
                                            }
                                            break;
                                    }
                                }
                            }
                            if ((is_array($_1880174775) && !empty($_1880174775)) || (strlen(trim($_1880174775)) > 0)) {
                                $_1766828534[$_1295533077] = CAcritExportproplusTools::RoundNumber($_1880174775, $_1639684675['ROUND']['PRECISION'], $_1639684675['ROUND']['MODE']);
                                break;
                            }
                        }
                    } else {
                        $_1639684675['VALUE'] = ($_1639684675['TYPE'] == 'field') ? $_1639684675['VALUE'] : $_1639684675['COMPLEX_TRUE_VALUE'];
                        if (($_1639684675['CODE'] == 'URL') && function_exists('detailLink')) {
                            $_1766828534[$_1295533077] = detailLink($_1799584481['ID']);
                            if (!$_409953385) {
                                $_1616301007 = stripos($_1108326879, '?');
                                $_865844506 = stripos($_1108326879, '?utm_source');
                                if ($_1616301007 != $_865844506) {
                                    $_1108326879 = str_replace('?utm_source', '&amp;utm_source', $_1108326879);
                                }
                            }
                        } else {
                            if (function_exists('acritRedefine')) {
                                $_1766828534[$_1295533077] = acritRedefine($_1295533077, $_1799584481['ID'], $this->profile['ID']);
                            }
                            if (!$_1766828534[$_1295533077]) {
                                $_47247544 = explode('-', $_1639684675['VALUE']);
                                switch (count($_47247544)) {
                                    case 1:
                                        $_1799584481 = $_1642182436;
                                        if (isset($this->_508964447[$_29195840])) {
                                            $_1799584481 = $this->__1641660486($_485935950);
                                        }
                                        if (strpos($_1639684675['VALUE'], '.') !== false) {
                                            $_1117656864 = explode('.', $_1639684675['VALUE']);
                                            switch ($_1117656864[0]) {
                                                case 'SECTION':
                                                    $_1490539831 = $_1063913501[$_1642182436['IBLOCK_ID']][$_1642182436['IBLOCK_SECTION_ID']];
                                                    $_1438955011 = $_1490539831[$_1117656864[1]] ?: '';
                                                    break;
                                                default:
                                                    $_1438955011 = '';
                                            }
                                            unset($_1117656864);
                                            $_1766828534[$_1295533077] = CAcritExportproplusTools::RoundNumber($_1438955011, $_1639684675['ROUND']['PRECISION'], $_1639684675['ROUND']['MODE']);
                                        } else {
                                            $_1766828534[$_1295533077] = CAcritExportproplusTools::RoundNumber($_1799584481[$_1639684675['VALUE']], $_1639684675['ROUND']['PRECISION'], $_1639684675['ROUND']['MODE']);
                                        }
                                        $_1799584481 = $_1642182436;
                                        break;
                                    case 2:
                                        $_480208289 = null;
                                        $_1766828534[$_1295533077] = $_1799584481['CATALOG_' . $_47247544[1]];
                                        if (($_1639684675['VALUE'] == 'CATALOG-PURCHASING_PRICE') && isset($_1799584481['CATALOG_PURCHASING_PRICE'])) {
                                            preg_match('/PURCHASING_PRICE/', $_47247544[1], $_540983714);
                                        } else {
                                            preg_match('/PRICE_[\d]+/', $_47247544[1], $_540983714);
                                        }
                                        $_1284853936 = $_1799584481["CATALOG_{$_540983714[0]}_CURRENCY"];
                                        if (strpos($_47247544[1], '_CURRENCY') > 0) {
                                            $_1766828534[$_1295533077] = $_1284853936;
                                            $_1766828534[$_1295533077] = CAcritExportproplusTools::RoundNumber($_1766828534[$_1295533077], $_1639684675['ROUND']['PRECISION'], $_1639684675['ROUND']['MODE']);
                                            if (is_array($_851873695)) {
                                                $_480208289 = $_1766828534[$_1295533077];
                                            }
                                            if ($this->profile['CURRENCY']['CONVERT_CURRENCY'] == 'Y') {
                                                if ($this->profile['CURRENCY'][$_1284853936]['CHECK']) {
                                                    $_615351990 = $this->profile['CURRENCY'][$_1284853936]['CONVERT_TO'];
                                                    $_1766828534[$_1295533077] = $_615351990;
                                                    $_1766828534[$_1295533077] = CAcritExportproplusTools::RoundNumber($_1766828534[$_1295533077], $_1639684675['ROUND']['PRECISION'], $_1639684675['ROUND']['MODE']);
                                                    if (is_array($_851873695)) {
                                                        $_480208289 = $_1766828534[$_1295533077];
                                                    }
                                                }
                                            }
                                        } elseif (!empty($_540983714[0])) {
                                            if ($this->profile['CURRENCY']['CONVERT_CURRENCY'] == 'Y') {
                                                if ($this->profile['CURRENCY'][$_1284853936]['CHECK']) {
                                                    $_615351990 = $this->profile['CURRENCY'][$_1284853936]['CONVERT_TO'];
                                                    if ($this->profile['CURRENCY'][$_1284853936]['RATE'] == 'SITE') {
                                                        $_1766828534[$_1295533077] = CAcritExportproplusTools::RoundNumber(CCurrencyRates::ConvertCurrency($_1799584481['CATALOG_' . $_47247544[1]], $this->profile['CURRENCY'][$_1284853936]['CONVERT_FROM'], $_615351990), $_1639684675['ROUND']['PRECISION'], $_1639684675['ROUND']['MODE'], 0);
                                                        if (is_array($_851873695)) {
                                                            $_480208289 = $_1766828534[$_1295533077];
                                                        }
                                                    } else {
                                                        $_1766828534[$_1295533077] = CAcritExportproplusTools::RoundNumber($_1766828534[$_1295533077] * $this->_2112071826[$this->profile['CURRENCY'][$_1284853936]['RATE']][$_1284853936]['RATE'] / $this->_2112071826[$this->profile['CURRENCY'][$_1284853936]['RATE']][$_615351990]['RATE'] / $this->_2112071826[$this->profile['CURRENCY'][$_1284853936]['RATE']][$_1284853936]['RATE_CNT'] * $this->_2112071826[$this->profile['CURRENCY'][$_1284853936]['RATE']][$_615351990]['RATE_CNT'], $_1639684675['ROUND']['PRECISION'], $_1639684675['ROUND']['MODE'], 0);
                                                        if (is_array($_851873695)) {
                                                            $_480208289 = $_1766828534[$_1295533077];
                                                        }
                                                    }
                                                }
                                                if (!in_array($_1284853936, $this->_1364486914)) $this->_1364486914[] = $_1284853936;
                                            } else {
                                                if (!in_array($_1284853936, $this->_1364486914)) $this->_1364486914[] = $_1284853936;
                                            }
                                            if ($this->profile['CURRENCY'][$_1284853936]['CHECK']) {
                                                $_1766828534[$_1295533077] += $_1766828534[$_1295533077] * floatval($this->profile['CURRENCY'][$_1284853936]['PLUS']) / 100;
                                                $_1766828534[$_1295533077] = CAcritExportproplusTools::RoundNumber($_1766828534[$_1295533077], $_1639684675['ROUND']['PRECISION'], $_1639684675['ROUND']['MODE']);
                                                if (is_array($_851873695)) {
                                                    $_480208289 = $_1766828534[$_1295533077];
                                                }
                                            }
                                        }
                                        if (stripos($_47247544[1], '_WD') !== false) {
                                            if (in_array('PRICE_' . $_1799584481['CATALOG_' . $_47247544[1] . '_PRICEID'] . '_WD', $this->_1931809273) || in_array('PRICE_' . $_1799584481['CATALOG_' . $_47247544[1] . '_PRICEID'] . '_D', $this->_1931809273)) {
                                                $_1432753308 = CCatalogDiscount::GetDiscountByPrice($_1799584481['CATALOG_' . $_47247544[1] . '_ID'], $USER->GetUserGroupArray(), 'N', $this->profile['LID']);
                                                $_1156465674 = CCatalogProduct::CountPriceWithDiscount($_1766828534[$_1295533077], $_1799584481['CATALOG_' . $_47247544[1] . '_CURRENCY'], $_1432753308);
                                                $_277498185 = $_1766828534[$_1295533077] - $_1156465674;
                                            } else {
                                                $_1156465674 = $_1766828534[$_1295533077];
                                                $_277498185 = 0;
                                            }
                                            $_1799584481["CATALOG_PRICE_{$_1799584481['CATALOG_'.$_47247544[1].'_PRICEID']}_D"] = $_277498185;
                                            $_1799584481["CATALOG_PRICE_{$_1799584481['CATALOG_'.$_47247544[1].'_PRICEID']}_WD"] = $_1156465674;
                                            $_1766828534[$_1295533077] = $_1156465674;
                                            $_480208289 = $_1766828534[$_1295533077];
                                        }
                                        if ($_1639684675['BITRIX_ROUND_MODE'] == 'Y') {
                                            $_1766828534[$_1295533077] = CAcritExportproplusTools::BitrixRoundNumber($_1766828534[$_1295533077], $_47247544[1]);
                                        } else {
                                            $_1766828534[$_1295533077] = CAcritExportproplusTools::RoundNumber($_1766828534[$_1295533077], $_1639684675['ROUND']['PRECISION'], $_1639684675['ROUND']['MODE']);
                                        }
                                        if (is_array($_851873695)) {
                                            $_480208289 = $_1766828534[$_1295533077];
                                        }
                                        if (is_array($_851873695) && !is_null($_480208289)) $_5222085[$_29195840][$_1639684675['CODE']][] = $_480208289;
                                        if (isset($_1639684675['MINIMUM_OFFER_PRICE']) && ($_1639684675['MINIMUM_OFFER_PRICE'] == 'Y') && ($_1030859019['MINIMUM_OFFER_PRICE'] == 'Y')) {
                                            if (count($_1658004309[$_29195840][$_1639684675['CODE']])) {
                                                if (isset($_1639684675['MINIMUM_OFFER_PRICE_CODE']) && strlen($_1639684675['MINIMUM_OFFER_PRICE_CODE'])) {
                                                    $_1766828534[$_548088880 . $_1639684675['MINIMUM_OFFER_PRICE_CODE'] . $_548088880] = min($_1658004309[$_29195840][$_1639684675['CODE']]);
                                                }
                                            }
                                        } elseif (isset($_1639684675['MINIMUM_OFFER_PRICE']) && ($_1639684675['MINIMUM_OFFER_PRICE'] == 'Y')) {
                                        }
                                        break;
                                    case 3:
                                        $_1799584481 = $_1642182436;
                                        if (isset($this->_508964447[$_29195840])) {
                                            $_1799584481 = $this->__1641660486($_485935950);
                                        }
                                        if (($_47247544[0] == $_1799584481['IBLOCK_ID']) || ($_47247544[0] == $_851873695['IBLOCK_ID'])) {
                                            if ($this->_2078735835[$_47247544[0]]['OFFERS_PROPERTY_ID'] == $_47247544[2]) {
                                                $_1799584481["PROPERTY_{$_47247544[2]}_DISPLAY_VALUE"] = CAcritExportproplusTools::RoundNumber($_1799584481["PROPERTY_{$_47247544[2]}_VALUE"][0], $_1639684675['ROUND']['PRECISION'], $_1639684675['ROUND']['MODE']);
                                            }
                                            if ($this->profile['XMLDATA']["{$_1639684675['CODE']}"]['PROCESS_LOGIC'] == 'N') {
                                                $_212220634 = $_1799584481["PROPERTY_{$_47247544[2]}_VALUE"];
                                            } else {
                                                $_212220634 = $_1799584481["PROPERTY_{$_47247544[2]}_DISPLAY_VALUE"];
                                            }
                                            if (is_array($_212220634)) {
                                                $_55309008 = CAcritExportproplusTools::ParseMultiproFormat($_212220634, $this->profile, $_1639684675['CODE']);
                                                $_212220634 = (is_array($_55309008) && !empty($_55309008)) ? $_55309008 : $_212220634;
                                                $_1766828534[$_1295533077] = array();
                                                foreach ($_212220634 as $_32014025) {
                                                    if (intval($this->profile['XMLDATA'][$_1639684675['CODE']]['MULTIPROP_LIMIT']) > 0) {
                                                        if (count($_1766828534[$_1295533077]) < $this->profile['XMLDATA'][$_1639684675['CODE']]['MULTIPROP_LIMIT']) {
                                                            $_1766828534[$_1295533077][] = CAcritExportproplusTools::RoundNumber($_32014025, $_1639684675['ROUND']['PRECISION'], $_1639684675['ROUND']['MODE']);
                                                        }
                                                    } else {
                                                        $_1766828534[$_1295533077][] = CAcritExportproplusTools::RoundNumber($_32014025, $_1639684675['ROUND']['PRECISION'], $_1639684675['ROUND']['MODE']);
                                                    }
                                                }
                                                if ($_1639684675['MULTIPROP_TO_STRING'] == 'Y') {
                                                    $_1574328650 = (strlen($_1639684675['MULTIPROP_DIVIDER']) > 0) ? $_1639684675['MULTIPROP_DIVIDER'] : ' ';
                                                    $_1766828534[$_1295533077] = implode($_1574328650, $_1766828534[$_1295533077]);
                                                }
                                            } else {
                                                $_1766828534[$_1295533077] = CAcritExportproplusTools::RoundNumber($_212220634, $_1639684675['ROUND']['PRECISION'], $_1639684675['ROUND']['MODE']);
                                            }
                                        }
                                        $_1799584481 = $_1642182436;
                                        break;
                                    case 5:
                                        $_1799584481 = $_1642182436;
                                        $_1799584481['HL'] = $this->__745667146($_47247544[0], $_47247544[3], $_1799584481);
                                        $_212220634 = $_1799584481['HL'][$_47247544[4]]['VALUE'];
                                        if (is_array($_212220634)) {
                                            $_55309008 = CAcritExportproplusTools::ParseMultiproFormat($_212220634, $this->profile, $_1639684675['CODE']);
                                            $_212220634 = (is_array($_55309008) && !empty($_55309008)) ? $_55309008 : $_212220634;
                                            $_1766828534[$_1295533077] = array();
                                            foreach ($_212220634 as $_32014025) {
                                                if (intval($this->profile['XMLDATA'][$_1639684675['CODE']]['MULTIPROP_LIMIT']) > 0) {
                                                    if (count($_1766828534[$_1295533077]) < $this->profile['XMLDATA'][$_1639684675['CODE']]['MULTIPROP_LIMIT']) {
                                                        $_1766828534[$_1295533077][] = CAcritExportproplusTools::RoundNumber($_32014025, $_1639684675['ROUND']['PRECISION'], $_1639684675['ROUND']['MODE']);
                                                    }
                                                } else {
                                                    $_1766828534[$_1295533077][] = CAcritExportproplusTools::RoundNumber($_32014025, $_1639684675['ROUND']['PRECISION'], $_1639684675['ROUND']['MODE']);
                                                }
                                            }
                                            if ($_1639684675['MULTIPROP_TO_STRING'] == 'Y') {
                                                $_1574328650 = (strlen($_1639684675['MULTIPROP_DIVIDER']) > 0) ? $_1639684675['MULTIPROP_DIVIDER'] : ' ';
                                                $_1766828534[$_1295533077] = implode($_1574328650, $_1766828534[$_1295533077]);
                                            }
                                        } else {
                                            $_1766828534[$_1295533077] = CAcritExportproplusTools::RoundNumber($_212220634, $_1639684675['ROUND']['PRECISION'], $_1639684675['ROUND']['MODE']);
                                        }
                                        break;
                                }
                            }
                        }
                    }
                } elseif (($_1639684675['TYPE'] == 'const') || (($_1639684675['TYPE'] == 'complex') && ($_1639684675['COMPLEX_TRUE_TYPE'] == 'const'))) {
                    $_1639684675['CONTVALUE_TRUE'] = ($_1639684675['TYPE'] == 'const') ? $_1639684675['CONTVALUE_TRUE'] : $_1639684675['COMPLEX_TRUE_CONTVALUE'];
                    $_1766828534[$_1295533077] = CAcritExportproplusTools::RoundNumber($_1639684675['CONTVALUE_TRUE'], $_1639684675['ROUND']['PRECISION'], $_1639684675['ROUND']['MODE']);
                } else {
                    $_1766828534[$_1295533077] = '';
                }
            }
            if ($_1639684675['EXPORT_ROWCATEGORY_PARENT_LIST'] == 'Y') {
                $_1945237947 = CIBlockSection::GetNavChain(false, $_1766828534[$_1295533077]);
                if ($_1945237947->SelectedRowsCount()) {
                    $_1394192210 = '';
                    while ($_3160030 = $_1945237947->GetNext()) {
                        $_1394192210 = (strlen($_1394192210) <= 0) ? $_3160030['NAME'] : $_1394192210 . ' > ' . $_3160030['NAME'];
                    }
                    if (strlen($_1394192210) > 0) {
                        $_1766828534[$_1295533077] = $_1394192210;
                    }
                }
            } else {
                if ($DB->IsDate($_1766828534[$_1295533077]) && ($this->profile['DATEFORMAT'] == $this->_317570903)) {
                    $_1766828534[$_1295533077] = CAcritExportproplusTools::RoundNumber(CAcritExportproplusTools::GetYandexDateTime($_1766828534[$_1295533077]), $_1639684675['ROUND']['PRECISION'], $_1639684675['ROUND']['MODE']);
                    $_206406255 = MakeTimeStamp('');
                    $_1161211064 = date('Y-m-d', $_206406255);
                    if (stripos($_1766828534[$_1295533077], $_1161211064) !== false) {
                        $_1304010677 = true;
                        $this->_940439577->AddMessage("{$_1799584481['NAME']} (ID:{$_1799584481['ID']}) : " . str_replace('#FIELD#', $_1295533077, GetMessage('ACRIT_EXPORTPROPLUS_REQUIRED_FIELD_SKIP')));
                        $this->_940439577->IncProductError();
                    }
                }
                if ($_409953385) {
                    $_1766828534 = CAcritExportproplusStringProcess::ProcessTagOptions($_1766828534, $_1639684675, $_1295533077);
                } else {
                    $_1766828534 = CAcritExportproplusStringProcess::ProcessTagOptions($_1766828534, $_1639684675, $_1295533077, true, $_1108326879, $this->_547888680);
                }
            }
            if (($_1639684675['REQUIRED'] == 'Y') && (empty($_1766828534[$_1295533077]) || !isset($_1766828534[$_1295533077]))) {
                $_1304010677 = true;
                $this->_940439577->AddMessage("{$_1799584481['NAME']} (ID:{$_1799584481['ID']}) : " . str_replace('#FIELD#', $_1295533077, GetMessage('ACRIT_EXPORTPROPLUS_REQUIRED_FIELD_SKIP')));
                $this->_940439577->IncProductError();
            }
        }
        $_1799584481 = $_1642182436;
        array_walk($_1766828534, function (&$_1438955011) {
            if (is_array($_1438955011)) {
                foreach ($_1438955011 as $_2141483972 => $_32014025) $_1438955011[$_2141483972] = $_32014025;
            } else $_1438955011 = $_1438955011;
        });
        if (!$_409953385) {
            $_1766828534[$_548088880 . 'MARKET_CATEGORY' . $_548088880] = '';
            if (function_exists('acritRedefine')) {
                $_1767388196 = acritRedefine($_548088880 . 'MARKET_CATEGORY' . $_548088880, $_1799584481['ID'], $this->profile['ID']);
                if ($_1767388196) {
                    $_1766828534[$_548088880 . 'CATEGORYID' . $_548088880] = $_1767388196;
                    $_1766828534[$_548088880 . 'MARKET_CATEGORY' . $_548088880] = $this->_2046460632[$_1766828534[$_548088880 . 'CATEGORYID' . $_548088880] - 1];
                }
            }
            if (!$_1766828534[$_548088880 . 'MARKET_CATEGORY' . $_548088880]) {
                switch ($this->profile['TYPE']) {
                    case 'ebay':
                    case 'ebay_1':
                    case 'ebay_2':
                        if ($this->profile['USE_IBLOCK_CATEGORY'] == 'Y') {
                            $_1766828534[$_548088880 . 'MARKET_CATEGORY' . $_548088880] = $this->profile['MARKET_CATEGORY']['EBAY']['CATEGORY_LIST'][$_1799584481['IBLOCK_ID']];
                        } elseif ($this->profile['USE_IBLOCK_PRODUCT_CATEGORY'] == 'Y') {
                            $_1766828534[$_548088880 . 'MARKET_CATEGORY' . $_548088880] = $this->profile['MARKET_CATEGORY']['EBAY']['CATEGORY_LIST'][$_1799584481['IBLOCK_PRODUCT_SECTION_ID']];
                        } else {
                            $_1766828534[$_548088880 . 'MARKET_CATEGORY' . $_548088880] = $this->profile['MARKET_CATEGORY']['EBAY']['CATEGORY_LIST'][$_1799584481['IBLOCK_SECTION_ID']];
                        }
                        $_1759525527 = $this->profile['MARKET_CATEGORY']['EBAY']['CATEGORY_LIST'];
                        break;
                    case 'google':
                    case 'google_online':
                        if (($this->profile['USE_IBLOCK_CATEGORY'] == 'Y') && ($this->profile['USE_MARKET_CATEGORY'] == 'Y')) {
                            $_1766828534[$_548088880 . 'MARKET_CATEGORY' . $_548088880] = $this->profile['MARKET_CATEGORY']['CATEGORY_LIST'][$_1799584481['IBLOCK_ID']];
                        } elseif (($this->profile['USE_IBLOCK_PRODUCT_CATEGORY'] == 'Y') && ($this->profile['USE_MARKET_CATEGORY'] == 'Y')) {
                            $_1766828534[$_548088880 . 'MARKET_CATEGORY' . $_548088880] = $this->profile['MARKET_CATEGORY']['CATEGORY_LIST'][$_1799584481['IBLOCK_PRODUCT_SECTION_ID']];
                        } else {
                            if ($this->profile['USE_MARKET_CATEGORY'] == 'Y') {
                                $_1766828534[$_548088880 . 'MARKET_CATEGORY' . $_548088880] = $this->profile['MARKET_CATEGORY']['CATEGORY_LIST'][$_1799584481['IBLOCK_SECTION_ID']];
                            }
                        }
                        $_1759525527 = $this->profile['MARKET_CATEGORY']['CATEGORY_LIST'];
                        break;
                    case 'ozon':
                    case 'ozon_api':
                        if ($this->profile['USE_IBLOCK_CATEGORY'] == 'Y') {
                            if (strlen(trim($this->profile['MARKET_CATEGORY']['OZON']['CATEGORY_LIST'][$_1799584481['IBLOCK_ID']])) <= 0) {
                                return $_1799584481;
                            }
                            $_1766828534[$_548088880 . 'MARKET_CATEGORY' . $_548088880] = $this->profile['MARKET_CATEGORY']['OZON']['CATEGORY_LIST'][$_1799584481['IBLOCK_ID']];
                            if (!empty($_1768420642)) {
                                foreach ($_1768420642 as $_1474817292) {
                                    if ($_1474817292['ProductTypeId'] == $this->profile['MARKET_CATEGORY']['OZON']['CATEGORY_LIST'][$_1799584481['IBLOCK_ID']]) {
                                        $_1766828534[$_548088880 . 'CAPABILITY_TYPE' . $_548088880] = $_1474817292['Name'];
                                    }
                                }
                            }
                        } elseif ($this->profile['USE_IBLOCK_PRODUCT_CATEGORY'] == 'Y') {
                            if (strlen(trim($this->profile['MARKET_CATEGORY']['OZON']['CATEGORY_LIST'][$_1799584481['IBLOCK_PRODUCT_SECTION_ID']])) <= 0) {
                                return $_1799584481;
                            }
                            $_1766828534[$_548088880 . 'MARKET_CATEGORY' . $_548088880] = $this->profile['MARKET_CATEGORY']['OZON']['CATEGORY_LIST'][$_1799584481['IBLOCK_PRODUCT_SECTION_ID']];
                            if (!empty($_1768420642)) {
                                foreach ($_1768420642 as $_1474817292) {
                                    if ($_1474817292['ProductTypeId'] == $this->profile['MARKET_CATEGORY']['OZON']['CATEGORY_LIST'][$_1799584481['IBLOCK_PRODUCT_SECTION_ID']]) {
                                        $_1766828534[$_548088880 . 'CAPABILITY_TYPE' . $_548088880] = $_1474817292['Name'];
                                    }
                                }
                            }
                        } else {
                            if (strlen(trim($this->profile['MARKET_CATEGORY']['OZON']['CATEGORY_LIST'][$_1799584481['IBLOCK_SECTION_ID']])) <= 0) {
                                return $_1799584481;
                            }
                            $_1766828534[$_548088880 . 'MARKET_CATEGORY' . $_548088880] = $this->profile['MARKET_CATEGORY']['OZON']['CATEGORY_LIST'][$_1799584481['IBLOCK_SECTION_ID']];
                            if (!empty($_1768420642)) {
                                foreach ($_1768420642 as $_1474817292) {
                                    if ($_1474817292['ProductTypeId'] == $this->profile['MARKET_CATEGORY']['OZON']['CATEGORY_LIST'][$_1799584481['IBLOCK_SECTION_ID']]) {
                                        $_1766828534[$_548088880 . 'CAPABILITY_TYPE' . $_548088880] = $_1474817292['Name'];
                                    }
                                }
                            }
                        }
                        $_1759525527 = $this->profile['MARKET_CATEGORY']['OZON']['CATEGORY_LIST'];
                        break;
                    case 'vk_trade':
                        if (!$_409953385) {
                            if ($this->profile['USE_IBLOCK_CATEGORY'] == 'Y') {
                                $_1766828534[$_548088880 . 'MARKET_CATEGORY' . $_548088880] = $this->profile['MARKET_CATEGORY']['VK']['CATEGORY_LIST'][$_1799584481['IBLOCK_ID']];
                            } elseif ($this->profile['USE_IBLOCK_PRODUCT_CATEGORY'] == 'Y') {
                                $_1766828534[$_548088880 . 'MARKET_CATEGORY' . $_548088880] = $this->profile['MARKET_CATEGORY']['VK']['CATEGORY_LIST'][$_1799584481['IBLOCK_PRODUCT_SECTION_ID']];
                            } else {
                                $_1766828534[$_548088880 . 'MARKET_CATEGORY' . $_548088880] = $this->profile['MARKET_CATEGORY']['VK']['CATEGORY_LIST'][$_1799584481['IBLOCK_SECTION_ID']];
                            }
                            $_1759525527 = $this->profile['MARKET_CATEGORY']['VK']['CATEGORY_LIST'];
                            break;
                        }
                    case 'y_realty':
                        break;
                    case 'tiu_standart':
                    case 'tiu_standart_vendormodel':
                        $_171110304 = false;
                        if ($this->profile['USE_IBLOCK_CATEGORY'] == 'Y') {
                            $_1766828534[$_548088880 . 'MARKET_CATEGORY' . $_548088880] = $this->profile['MARKET_CATEGORY']['CATEGORY_LIST'][$_1799584481['IBLOCK_ID']];
                            if (!empty($this->_1615441130) && !empty($_1766828534[$_548088880 . 'MARKET_CATEGORY' . $_548088880])) {
                                foreach ($this->_1615441130 as $_506626893) {
                                    if ($_506626893['NAME'] == $this->profile['MARKET_CATEGORY']['CATEGORY_LIST'][$_1799584481['IBLOCK_ID']]) {
                                        $_1766828534[$_548088880 . 'PORTAL_ID' . $_548088880] = $_506626893['PORTAL_ID'];
                                        $_1766828534[$_548088880 . 'PORTAL_URL' . $_548088880] = $_506626893['PORTAL_URL'];
                                        break;
                                    }
                                }
                                $_171110304 = true;
                            }
                        } elseif ($this->profile['USE_IBLOCK_PRODUCT_CATEGORY'] == 'Y') {
                            $_1766828534[$_548088880 . 'MARKET_CATEGORY' . $_548088880] = $this->profile['MARKET_CATEGORY']['CATEGORY_LIST'][$_1799584481['IBLOCK_PRODUCT_SECTION_ID']];
                            if (!empty($this->_1615441130) && !empty($_1766828534[$_548088880 . 'MARKET_CATEGORY' . $_548088880])) {
                                foreach ($this->_1615441130 as $_506626893) {
                                    if ($_506626893['NAME'] == $this->profile['MARKET_CATEGORY']['CATEGORY_LIST'][$_1799584481['IBLOCK_PRODUCT_SECTION_ID']]) {
                                        $_1766828534[$_548088880 . 'PORTAL_ID' . $_548088880] = $_506626893['PORTAL_ID'];
                                        $_1766828534[$_548088880 . 'PORTAL_URL' . $_548088880] = $_506626893['PORTAL_URL'];
                                        break;
                                    }
                                }
                                $_171110304 = true;
                            }
                        } else {
                            $_1766828534[$_548088880 . 'MARKET_CATEGORY' . $_548088880] = $this->profile['MARKET_CATEGORY']['CATEGORY_LIST'][$_1799584481['IBLOCK_SECTION_ID']];
                            if (!empty($this->_1615441130) && !empty($_1766828534[$_548088880 . 'MARKET_CATEGORY' . $_548088880])) {
                                foreach ($this->_1615441130 as $_506626893) {
                                    if ($_506626893['NAME'] == $this->profile['MARKET_CATEGORY']['CATEGORY_LIST'][$_1799584481['IBLOCK_SECTION_ID']]) {
                                        $_1766828534[$_548088880 . 'PORTAL_ID' . $_548088880] = $_506626893['PORTAL_ID'];
                                        $_1766828534[$_548088880 . 'PORTAL_URL' . $_548088880] = $_506626893['PORTAL_URL'];
                                        break;
                                    }
                                }
                                $_171110304 = true;
                            }
                        }
                        if ((strlen(trim($_1766828534[$_548088880 . 'MARKET_CATEGORY' . $_548088880])) > 0) && is_array($this->_2046460632) && !empty($this->_2046460632) && $_171110304) {
                            $_1615441130 = trim($_1766828534[$_548088880 . 'MARKET_CATEGORY' . $_548088880]);
                            $_1766828534[$_548088880 . 'CATEGORYID' . $_548088880] = array_search($_1615441130, $this->_2046460632) + 1;
                        }
                        $_1759525527 = $this->profile['MARKET_CATEGORY']['CATEGORY_LIST'];
                        break;
                    case 'mailru':
                    case 'mailru_clothing':
                        $_171110304 = false;
                        if ($this->profile['USE_IBLOCK_CATEGORY'] == 'Y') {
                            $_1766828534[$_548088880 . 'MARKET_CATEGORY' . $_548088880] = $this->profile['MARKET_CATEGORY']['CATEGORY_LIST'][$_1799584481['IBLOCK_ID']];
                            if (!empty($this->_1615441130) && !empty($_1766828534[$_548088880 . 'MARKET_CATEGORY' . $_548088880])) {
                                foreach ($this->_1615441130 as $_506626893) {
                                    if ($_506626893['NAME'] == $this->profile['MARKET_CATEGORY']['CATEGORY_LIST'][$_1799584481['IBLOCK_ID']]) {
                                        $_1766828534[$_548088880 . 'PORTAL_ID' . $_548088880] = $_506626893['PORTAL_ID'];
                                        break;
                                    }
                                }
                                $_171110304 = true;
                            }
                        } elseif ($this->profile['USE_IBLOCK_PRODUCT_CATEGORY'] == 'Y') {
                            $_1766828534[$_548088880 . 'MARKET_CATEGORY' . $_548088880] = $this->profile['MARKET_CATEGORY']['CATEGORY_LIST'][$_1799584481['IBLOCK_PRODUCT_SECTION_ID']];
                            if (!empty($this->_1615441130) && !empty($_1766828534[$_548088880 . 'MARKET_CATEGORY' . $_548088880])) {
                                foreach ($this->_1615441130 as $_506626893) {
                                    if ($_506626893['NAME'] == $this->profile['MARKET_CATEGORY']['CATEGORY_LIST'][$_1799584481['IBLOCK_PRODUCT_SECTION_ID']]) {
                                        $_1766828534[$_548088880 . 'PORTAL_ID' . $_548088880] = $_506626893['PORTAL_ID'];
                                        break;
                                    }
                                }
                                $_171110304 = true;
                            }
                        } else {
                            $_1766828534[$_548088880 . 'MARKET_CATEGORY' . $_548088880] = $this->profile['MARKET_CATEGORY']['CATEGORY_LIST'][$_1799584481['IBLOCK_SECTION_ID']];
                            if (!empty($this->_1615441130) && !empty($_1766828534[$_548088880 . 'MARKET_CATEGORY' . $_548088880])) {
                                foreach ($this->_1615441130 as $_506626893) {
                                    if ($_506626893['NAME'] == $this->profile['MARKET_CATEGORY']['CATEGORY_LIST'][$_1799584481['IBLOCK_SECTION_ID']]) {
                                        $_1766828534[$_548088880 . 'PORTAL_ID' . $_548088880] = $_506626893['PORTAL_ID'];
                                        break;
                                    }
                                }
                                $_171110304 = true;
                            }
                        }
                        if ((strlen(trim($_1766828534[$_548088880 . 'MARKET_CATEGORY' . $_548088880])) > 0) && is_array($this->_2046460632) && !empty($this->_2046460632) && $_171110304) {
                            $_1615441130 = trim($_1766828534[$_548088880 . 'MARKET_CATEGORY' . $_548088880]);
                            $_1766828534[$_548088880 . 'CATEGORYID' . $_548088880] = array_search($_1615441130, $this->_2046460632) + 1;
                        }
                        $_1759525527 = $this->profile['MARKET_CATEGORY']['CATEGORY_LIST'];
                        break;
                    case 'ua_prom_ua':
                        $_171110304 = false;
                        if ($this->profile['USE_IBLOCK_CATEGORY'] == 'Y') {
                            $_1766828534[$_548088880 . 'MARKET_CATEGORY' . $_548088880] = $this->profile['MARKET_CATEGORY']['CATEGORY_LIST'][$_1799584481['IBLOCK_ID']];
                            if (!empty($this->_1615441130) && !empty($_1766828534[$_548088880 . 'MARKET_CATEGORY' . $_548088880])) {
                                foreach ($this->_1615441130 as $_506626893) {
                                    if ($_506626893['NAME'] == $this->profile['MARKET_CATEGORY']['CATEGORY_LIST'][$_1799584481['IBLOCK_ID']]) {
                                        $_1766828534[$_548088880 . 'PORTAL_ID' . $_548088880] = $_506626893['PORTAL_ID'];
                                        $_1766828534[$_548088880 . 'PORTAL_URL' . $_548088880] = $_506626893['PORTAL_URL'];
                                        break;
                                    }
                                }
                                $_171110304 = true;
                            }
                        } elseif ($this->profile['USE_IBLOCK_PRODUCT_CATEGORY'] == 'Y') {
                            $_1766828534[$_548088880 . 'MARKET_CATEGORY' . $_548088880] = $this->profile['MARKET_CATEGORY']['CATEGORY_LIST'][$_1799584481['IBLOCK_PRODUCT_SECTION_ID']];
                            if (!empty($this->_1615441130) && !empty($_1766828534[$_548088880 . 'MARKET_CATEGORY' . $_548088880])) {
                                foreach ($this->_1615441130 as $_506626893) {
                                    if ($_506626893['NAME'] == $this->profile['MARKET_CATEGORY']['CATEGORY_LIST'][$_1799584481['IBLOCK_PRODUCT_SECTION_ID']]) {
                                        $_1766828534[$_548088880 . 'PORTAL_ID' . $_548088880] = $_506626893['PORTAL_ID'];
                                        $_1766828534[$_548088880 . 'PORTAL_URL' . $_548088880] = $_506626893['PORTAL_URL'];
                                        break;
                                    }
                                }
                                $_171110304 = true;
                            }
                        } else {
                            $_1766828534[$_548088880 . 'MARKET_CATEGORY' . $_548088880] = $this->profile['MARKET_CATEGORY']['CATEGORY_LIST'][$_1799584481['IBLOCK_SECTION_ID']];
                            if (!empty($this->_1615441130) && !empty($_1766828534[$_548088880 . 'MARKET_CATEGORY' . $_548088880])) {
                                foreach ($this->_1615441130 as $_506626893) {
                                    if ($_506626893['NAME'] == $this->profile['MARKET_CATEGORY']['CATEGORY_LIST'][$_1799584481['IBLOCK_SECTION_ID']]) {
                                        $_1766828534[$_548088880 . 'PORTAL_ID' . $_548088880] = $_506626893['PORTAL_ID'];
                                        $_1766828534[$_548088880 . 'PORTAL_URL' . $_548088880] = $_506626893['PORTAL_URL'];
                                        break;
                                    }
                                }
                                $_171110304 = true;
                            }
                        }
                        if ((strlen(trim($_1766828534[$_548088880 . 'MARKET_CATEGORY' . $_548088880])) > 0) && is_array($this->_2046460632) && !empty($this->_2046460632) && $_171110304) {
                            $_1615441130 = trim($_1766828534[$_548088880 . 'MARKET_CATEGORY' . $_548088880]);
                            $_1766828534[$_548088880 . 'CATEGORYID' . $_548088880] = array_search($_1615441130, $this->_2046460632) + 1;
                        }
                        $_1759525527 = $this->profile['MARKET_CATEGORY']['CATEGORY_LIST'];
                        break;
                    default:
                        $_171110304 = false;
                        if (($this->profile['USE_IBLOCK_CATEGORY'] == 'Y') && ($this->profile['USE_MARKET_CATEGORY'] == 'Y')) {
                            $_1766828534[$_548088880 . 'MARKET_CATEGORY' . $_548088880] = htmlspecialcharsbx($this->profile['MARKET_CATEGORY']['CATEGORY_LIST'][$_1799584481['IBLOCK_ID']]);
                            $_171110304 = true;
                        } elseif (($this->profile['USE_IBLOCK_PRODUCT_CATEGORY'] == 'Y') && ($this->profile['USE_MARKET_CATEGORY'] == 'Y')) {
                            $_1766828534[$_548088880 . 'MARKET_CATEGORY' . $_548088880] = htmlspecialcharsbx($this->profile['MARKET_CATEGORY']['CATEGORY_LIST'][$_1799584481['IBLOCK_PRODUCT_SECTION_ID']]);
                            $_171110304 = true;
                        } else {
                            if ($this->profile['USE_MARKET_CATEGORY'] == 'Y') {
                                if (is_array($_1799584481['SECTION_ID']) && !empty($_1799584481['SECTION_ID'])) {
                                    $_1766828534[$_548088880 . 'MARKET_CATEGORY' . $_548088880] = '';
                                    foreach ($_1799584481['SECTION_ID'] as $_401081284) {
                                        $_792912379 = htmlspecialcharsbx(trim($this->profile['MARKET_CATEGORY']['CATEGORY_LIST'][$_401081284]));
                                        if (strlen($_792912379) > 0) {
                                            $_1766828534[$_548088880 . 'MARKET_CATEGORY' . $_548088880] = $_792912379;
                                            break;
                                        }
                                    }
                                    if ($_1766828534[$_548088880 . 'MARKET_CATEGORY' . $_548088880] == '') {
                                        $_1766828534[$_548088880 . 'MARKET_CATEGORY' . $_548088880] = htmlspecialcharsbx($this->profile['MARKET_CATEGORY']['CATEGORY_LIST'][$_1799584481['IBLOCK_SECTION_ID']]);
                                    }
                                } else {
                                    $_1766828534[$_548088880 . 'MARKET_CATEGORY' . $_548088880] = htmlspecialcharsbx($this->profile['MARKET_CATEGORY']['CATEGORY_LIST'][$_1799584481['IBLOCK_SECTION_ID']]);
                                }
                                $_171110304 = true;
                            }
                        }
                        if ((strlen(trim($_1766828534[$_548088880 . 'MARKET_CATEGORY' . $_548088880])) > 0) && is_array($this->_2046460632) && !empty($this->_2046460632) && $_171110304) {
                            $_1615441130 = trim($_1766828534[$_548088880 . 'MARKET_CATEGORY' . $_548088880]);
                            $_1766828534[$_548088880 . 'CATEGORYID' . $_548088880] = array_search($_1615441130, $this->_2046460632) + 1;
                        }
                        $_1759525527 = $this->profile['MARKET_CATEGORY']['CATEGORY_LIST'];
                        break;
                }
            }
            if ($this->profile['SETUP']['USE_CATEGORY_REDEFINE_TAG'] == 'Y') {
                if (strlen(trim($this->profile['SETUP']['CATEGORY_REDEFINE_TAG'])) > 0) {
                    $_1366184680 = $_1759525527[$_1766828534[$_548088880 . $this->profile['SETUP']['CATEGORY_REDEFINE_TAG'] . $_548088880]];
                    $_1207475988 = $this->profile['PROFILE_CATEGORIES'][$_1766828534[$_548088880 . $this->profile['SETUP']['CATEGORY_REDEFINE_TAG'] . $_548088880]]['NAME'];
                    if (strlen(trim($_1366184680)) > 0) {
                        $_1766828534[$_548088880 . $this->profile['SETUP']['CATEGORY_REDEFINE_TAG'] . $_548088880] = trim($_1366184680);
                    } elseif (strlen(trim($_1207475988)) > 0) {
                        $_1766828534[$_548088880 . $this->profile['SETUP']['CATEGORY_REDEFINE_TAG'] . $_548088880] = trim($_1207475988);
                    }
                }
            }
            $_1766828534[$_548088880 . 'VK_MARKET_ALBUMS' . $_548088880] = '';
            switch ($this->profile['TYPE']) {
                case 'vk_trade':
                    if ($this->profile['USE_IBLOCK_CATEGORY'] == 'Y') {
                        $_1766828534[$_548088880 . 'VK_MARKET_ALBUMS' . $_548088880] = $this->profile['VK']['VK_MARKET_ALBUMS'][$_1799584481['IBLOCK_ID']];
                    } elseif ($this->profile['USE_IBLOCK_PRODUCT_CATEGORY'] == 'Y') {
                        $_1766828534[$_548088880 . 'VK_MARKET_ALBUMS' . $_548088880] = $this->profile['VK']['VK_MARKET_ALBUMS'][$_1799584481['IBLOCK_PRODUCT_SECTION_ID']];
                    } elseif ($this->profile['VK']['VK_IS_MARKET_ALBUMS_MULTICATEGORIES'] == 'Y') {
                        $_1766828534[$_548088880 . 'VK_MARKET_ALBUMS' . $_548088880] = array();
                        foreach ($_1799584481['SECTION_EXDATA'] as $_1496645552 => $_994241955) {
                            $_1766828534[$_548088880 . 'VK_MARKET_ALBUMS' . $_548088880][$_1496645552] = array('ID' => $_1799584481['IBLOCK_SECTION_ID'], 'NAME' => $this->profile['VK']['VK_MARKET_ALBUMS'][$_1496645552], 'PICTURE' => (intval($_994241955['PICTURE']) > 0) ? array($_SERVER['DOCUMENT_ROOT'] . CFile::GetPath($_994241955['PICTURE'])) : false, 'DETAIL_PICTURE' => (intval($_994241955['DETAIL_PICTURE']) > 0) ? array($_SERVER['DOCUMENT_ROOT'] . CFile::GetPath($_994241955['DETAIL_PICTURE'])) : false);
                        }
                    } else {
                        $_1766828534[$_548088880 . 'VK_MARKET_ALBUMS' . $_548088880] = array();
                        $_1766828534[$_548088880 . 'VK_MARKET_ALBUMS' . $_548088880][] = array('ID' => $_1799584481['IBLOCK_SECTION_ID'], 'NAME' => $this->profile['VK']['VK_MARKET_ALBUMS'][$_1799584481['IBLOCK_SECTION_ID']], 'PICTURE' => (intval($_994241955[0]['PICTURE']) > 0) ? array($_SERVER['DOCUMENT_ROOT'] . CFile::GetPath($_994241955[0]['PICTURE'])) : false, 'DETAIL_PICTURE' => (intval($_994241955[0]['DETAIL_PICTURE']) > 0) ? array($_SERVER['DOCUMENT_ROOT'] . CFile::GetPath($_994241955[0]['DETAIL_PICTURE'])) : false);
                    }
                    break;
                default:
                    break;
            }
            $_1766828534[$_548088880 . 'VK_ALBUMS' . $_548088880] = '';
            switch ($this->profile['TYPE']) {
                case 'vk_trade':
                    if ($this->profile['USE_IBLOCK_CATEGORY'] == 'Y') {
                        $_1766828534[$_548088880 . 'VK_ALBUMS' . $_548088880] = $this->profile['VK']['VK_ALBUMS'][$_1799584481['IBLOCK_ID']];
                    } elseif ($this->profile['USE_IBLOCK_PRODUCT_CATEGORY'] == 'Y') {
                        $_1766828534[$_548088880 . 'VK_ALBUMS' . $_548088880] = $this->profile['VK']['VK_ALBUMS'][$_1799584481['IBLOCK_PRODUCT_SECTION_ID']];
                    } elseif ($this->profile['VK']['VK_IS_ALBUMS_MULTICATEGORIES'] == 'Y') {
                        $_1766828534[$_548088880 . 'VK_ALBUMS' . $_548088880] = array();
                        foreach ($_1799584481['SECTION_EXDATA'] as $_1496645552 => $_994241955) {
                            $_1766828534[$_548088880 . 'VK_ALBUMS' . $_548088880][$_1496645552] = array('ID' => $_1799584481['IBLOCK_SECTION_ID'], 'NAME' => $this->profile['VK']['VK_ALBUMS'][$_1496645552], 'PICTURE' => (intval($_994241955['PICTURE']) > 0) ? array($_SERVER['DOCUMENT_ROOT'] . CFile::GetPath($_994241955['PICTURE'])) : false, 'DETAIL_PICTURE' => (intval($_994241955['DETAIL_PICTURE']) > 0) ? array($_SERVER['DOCUMENT_ROOT'] . CFile::GetPath($_994241955['DETAIL_PICTURE'])) : false);
                        }
                    } else {
                        $_1766828534[$_548088880 . 'VK_ALBUMS' . $_548088880] = array();
                        $_1766828534[$_548088880 . 'VK_ALBUMS' . $_548088880][] = array('ID' => $_1799584481['IBLOCK_SECTION_ID'], 'NAME' => $this->profile['VK']['VK_ALBUMS'][$_1799584481['IBLOCK_SECTION_ID']], 'PICTURE' => (intval($_994241955[0]['PICTURE']) > 0) ? array($_SERVER['DOCUMENT_ROOT'] . CFile::GetPath($_994241955[0]['PICTURE'])) : false, 'DETAIL_PICTURE' => (intval($_994241955[0]['DETAIL_PICTURE']) > 0) ? array($_SERVER['DOCUMENT_ROOT'] . CFile::GetPath($_994241955[0]['DETAIL_PICTURE'])) : false);
                    }
                    break;
                default:
                    break;
            }
            $_1766828534[$_548088880 . 'OK_ALBUMS' . $_548088880] = '';
            switch ($this->profile['TYPE']) {
                case 'ok_trade':
                    if ($this->profile['USE_IBLOCK_CATEGORY'] == 'Y') {
                        $_1766828534[$_548088880 . 'OK_ALBUMS' . $_548088880] = $this->profile['OK']['OK_ALBUMS'][$_1799584481['IBLOCK_ID']];
                    } elseif ($this->profile['USE_IBLOCK_PRODUCT_CATEGORY'] == 'Y') {
                        $_1766828534[$_548088880 . 'OK_ALBUMS' . $_548088880] = $this->profile['OK']['OK_ALBUMS'][$_1799584481['IBLOCK_PRODUCT_SECTION_ID']];
                    } elseif ($this->profile['OK']['OK_IS_ALBUMS_MULTICATEGORIES'] == 'Y') {
                        $_1766828534[$_548088880 . 'OK_ALBUMS' . $_548088880] = array();
                        foreach ($_1799584481['SECTION_EXDATA'] as $_1496645552 => $_994241955) {
                            $_1766828534[$_548088880 . 'OK_ALBUMS' . $_548088880][$_1496645552] = array('ID' => $_1799584481['IBLOCK_SECTION_ID'], 'NAME' => $this->profile['OK']['OK_ALBUMS'][$_1496645552], 'PICTURE' => (intval($_994241955['PICTURE']) > 0) ? array($_SERVER['DOCUMENT_ROOT'] . CFile::GetPath($_994241955['PICTURE'])) : false, 'DETAIL_PICTURE' => (intval($_994241955['DETAIL_PICTURE']) > 0) ? array($_SERVER['DOCUMENT_ROOT'] . CFile::GetPath($_994241955['DETAIL_PICTURE'])) : false);
                        }
                    } else {
                        $_1766828534[$_548088880 . 'OK_ALBUMS' . $_548088880][] = array('ID' => $_1799584481['IBLOCK_SECTION_ID'], 'NAME' => $this->profile['OK']['OK_ALBUMS'][$_1799584481['IBLOCK_SECTION_ID']], 'PICTURE' => (intval($_994241955[0]['PICTURE']) > 0) ? array($_SERVER['DOCUMENT_ROOT'] . CFile::GetPath($_994241955[0]['PICTURE'])) : false, 'DETAIL_PICTURE' => (intval($_994241955[0]['DETAIL_PICTURE']) > 0) ? array($_SERVER['DOCUMENT_ROOT'] . CFile::GetPath($_994241955[0]['DETAIL_PICTURE'])) : false);
                    }
                    break;
                default:
                    break;
            }
            $_1766828534[$_548088880 . 'OK_CATALOGS' . $_548088880] = '';
            switch ($this->profile['TYPE']) {
                case 'ok_trade':
                    if ($this->profile['USE_IBLOCK_CATEGORY'] == 'Y') {
                        $_1766828534[$_548088880 . 'OK_CATALOGS' . $_548088880] = $this->profile['OK']['OK_CATALOGS'][$_1799584481['IBLOCK_ID']];
                    } elseif ($this->profile['USE_IBLOCK_PRODUCT_CATEGORY'] == 'Y') {
                        $_1766828534[$_548088880 . 'OK_CATALOGS' . $_548088880] = $this->profile['OK']['OK_CATALOGS'][$_1799584481['IBLOCK_PRODUCT_SECTION_ID']];
                    } elseif ($this->profile['OK']['OK_IS_ALBUMS_MULTICATEGORIES'] == 'Y') {
                        $_1766828534[$_548088880 . 'OK_CATALOGS' . $_548088880] = array();
                        foreach ($_1799584481['SECTION_EXDATA'] as $_1496645552 => $_994241955) {
                            $_1766828534[$_548088880 . 'OK_CATALOGS' . $_548088880][$_1496645552] = array('ID' => $_1799584481['IBLOCK_SECTION_ID'], 'NAME' => $this->profile['OK']['OK_CATALOGS'][$_1496645552], 'PICTURE' => (intval($_994241955['PICTURE']) > 0) ? array($_SERVER['DOCUMENT_ROOT'] . CFile::GetPath($_994241955['PICTURE'])) : false, 'DETAIL_PICTURE' => (intval($_994241955['DETAIL_PICTURE']) > 0) ? array($_SERVER['DOCUMENT_ROOT'] . CFile::GetPath($_994241955['DETAIL_PICTURE'])) : false);
                        }
                    } else {
                        $_1766828534[$_548088880 . 'OK_CATALOGS' . $_548088880][] = array('ID' => $_1799584481['IBLOCK_SECTION_ID'], 'NAME' => $this->profile['OK']['OK_CATALOGS'][$_1799584481['IBLOCK_SECTION_ID']], 'PICTURE' => (intval($_994241955[0]['PICTURE']) > 0) ? array($_SERVER['DOCUMENT_ROOT'] . CFile::GetPath($_994241955[0]['PICTURE'])) : false, 'DETAIL_PICTURE' => (intval($_994241955[0]['DETAIL_PICTURE']) > 0) ? array($_SERVER['DOCUMENT_ROOT'] . CFile::GetPath($_994241955[0]['DETAIL_PICTURE'])) : false);
                    }
                    break;
                default:
                    break;
            }
            if ($this->profile['TYPE'] == 'vk_trade') {
                if ((strlen($_1766828534[$_548088880 . 'NAME' . $_548088880]) > 0) && (intval($_1766828534[$_548088880 . 'PRICE' . $_548088880]) > 0) && (strlen($_1766828534[$_548088880 . 'URL' . $_548088880]) > 0) && (strlen($_1766828534[$_548088880 . 'PHOTO' . $_548088880]) > 0) && (intval($_1766828534[$_548088880 . 'MARKET_CATEGORY' . $_548088880]) > 0)) {
                    $_421487420 = array();
                    $_421487420['ID'] = $_1766828534[$_548088880 . 'ID' . $_548088880];
                    $_421487420['NAME'] = $_1766828534[$_548088880 . 'NAME' . $_548088880];
                    $_421487420['DESCRIPTION'] = $_1766828534[$_548088880 . 'DESCRIPTION' . $_548088880];
                    $_1996143159 = '';
                    if (strlen($_1766828534[$_548088880 . 'UTM_SOURCE' . $_548088880]) > 0) {
                        $_1996143159 .= (strlen($_1996143159) > 0) ? '&amp;' : '?';
                        $_1996143159 .= 'utm_source=' . $_1766828534[$_548088880 . 'UTM_SOURCE' . $_548088880];
                    }
                    if (strlen($_1766828534[$_548088880 . 'UTM_MEDIUM' . $_548088880]) > 0) {
                        $_1996143159 .= (strlen($_1996143159) > 0) ? '&amp;' : '?';
                        $_1996143159 .= 'utm_medium=' . $_1766828534[$_548088880 . 'UTM_MEDIUM' . $_548088880];
                    }
                    if (strlen($_1766828534[$_548088880 . 'UTM_TERM' . $_548088880]) > 0) {
                        $_1996143159 .= (strlen($_1996143159) > 0) ? '&amp;' : '?';
                        $_1996143159 .= 'utm_term=' . $_1766828534[$_548088880 . 'UTM_TERM' . $_548088880];
                    }
                    if (strlen($_1766828534[$_548088880 . 'UTM_CONTENT' . $_548088880]) > 0) {
                        $_1996143159 .= (strlen($_1996143159) > 0) ? '&amp;' : '?';
                        $_1996143159 .= 'utm_content=' . $_1766828534[$_548088880 . 'UTM_CONTENT' . $_548088880];
                    }
                    if (strlen($_1766828534[$_548088880 . 'UTM_CAMPAIGN' . $_548088880]) > 0) {
                        $_1996143159 .= (strlen($_1996143159) > 0) ? '&amp;' : '?';
                        $_1996143159 .= 'utm_campaign=' . $_1766828534[$_548088880 . 'UTM_CAMPAIGN' . $_548088880];
                    }
                    $_421487420['URL'] = $_1766828534[$_548088880 . 'URL' . $_548088880] . ((strlen($_1996143159) > 0) ? $_1996143159 : '');
                    $_421487420['URL_LABEL'] = $_1766828534[$_548088880 . 'URL_LABEL' . $_548088880];
                    $_421487420['DESCRIPTION_PREFIX'] = GetMessage('ACRIT_FB_PRICE') . $_1766828534[$_548088880 . 'PRICE' . $_548088880] . ' ' . GetMessage('ACRIT_FB_PRICE_CURRENCY') . '

';
                    $_421487420['PRICE'] = $_1766828534[$_548088880 . 'PRICE' . $_548088880];
                    $_421487420['CATEGORYID'] = $_1766828534[$_548088880 . 'CATEGORYID' . $_548088880];
                    $_421487420['MARKET_CATEGORY'] = $_1766828534[$_548088880 . 'MARKET_CATEGORY' . $_548088880];
                    $_421487420['VK']['VK_MARKET_ALBUMS'] = $_1766828534[$_548088880 . 'VK_MARKET_ALBUMS' . $_548088880];
                    $_421487420['VK']['VK_ALBUMS'] = $_1766828534[$_548088880 . 'VK_ALBUMS' . $_548088880];
                    $_421487420['PHOTO'] = array();
                    $_421487420['PHOTO'][] = $_SERVER['DOCUMENT_ROOT'] . $_1766828534[$_548088880 . 'PHOTO' . $_548088880];
                    foreach ($_1766828534[$_548088880 . 'ADDITIONAL_PHOTOS' . $_548088880] as $_2078368228 => $_1631641155) {
                        $_1766828534[$_548088880 . 'ADDITIONAL_PHOTOS' . $_548088880][$_2078368228] = $_SERVER['DOCUMENT_ROOT'] . $_1631641155;
                    }
                    $_421487420['ADDITIONAL_PHOTOS'] = $_1766828534[$_548088880 . 'ADDITIONAL_PHOTOS' . $_548088880];
                    $_421487420['IS_DELETED'] = 0;
                    $this->_1500291233->SaveMarketItem($_421487420);
                    $this->DemoCountInc();
                }
            } elseif ($this->profile['TYPE'] == 'fb_trade') {
                if ((strlen($_1766828534[$_548088880 . 'NAME' . $_548088880]) > 0) && (intval($_1766828534[$_548088880 . 'PRICE' . $_548088880]) > 0) && (strlen($_1766828534[$_548088880 . 'URL' . $_548088880]) > 0) && (strlen($_1766828534[$_548088880 . 'PHOTO' . $_548088880]) > 0)) {
                    $_421487420 = array();
                    $_421487420['ID'] = $_1766828534[$_548088880 . 'ID' . $_548088880];
                    $_421487420['NAME'] = $_1766828534[$_548088880 . 'NAME' . $_548088880];
                    $_421487420['URL'] = $this->profile['SITE_PROTOCOL'] . '://' . $this->profile['DOMAIN_NAME'] . $_1766828534[$_548088880 . 'URL' . $_548088880];
                    $_421487420['MESSAGE'] = GetMessage('ACRIT_FB_PRICE') . $_1766828534[$_548088880 . 'PRICE' . $_548088880] . ' ' . $_1766828534[$_548088880 . 'CURRENCYID' . $_548088880] . '

' . $_1766828534[$_548088880 . 'URL_LABEL' . $_548088880] . $_421487420['URL'] . '

' . $_1766828534[$_548088880 . 'MESSAGE' . $_548088880];
                    $_421487420['DESCRIPTION'] = $_1766828534[$_548088880 . 'DESCRIPTION' . $_548088880];
                    if (is_array($_1766828534[$_548088880 . 'PHOTO' . $_548088880]) && !empty($_1766828534[$_548088880 . 'PHOTO' . $_548088880])) {
                        $_421487420['PHOTO'] = $this->profile['SITE_PROTOCOL'] . '://' . $this->profile['DOMAIN_NAME'] . $_1766828534[$_548088880 . 'PHOTO' . $_548088880][0];
                    } else {
                        $_421487420['PHOTO'] = $this->profile['SITE_PROTOCOL'] . '://' . $this->profile['DOMAIN_NAME'] . $_1766828534[$_548088880 . 'PHOTO' . $_548088880];
                    }
                    $this->_116831045->ProcessData($_421487420);
                    $this->DemoCountInc();
                }
            } elseif ($this->profile['TYPE'] == 'instagram_trade') {
                if ((strlen($_1766828534[$_548088880 . 'NAME' . $_548088880]) > 0) && (strlen($_1766828534[$_548088880 . 'MESSAGE' . $_548088880]) > 0) && (intval($_1766828534[$_548088880 . 'PRICE' . $_548088880]) > 0) && (strlen($_1766828534[$_548088880 . 'URL' . $_548088880]) > 0) && ((strlen($_1766828534[$_548088880 . 'PHOTO' . $_548088880]) > 0) || is_array($_1766828534[$_548088880 . 'PHOTO' . $_548088880]))) {
                    $_421487420 = array();
                    $_421487420['ID'] = $_1766828534[$_548088880 . 'ID' . $_548088880];
                    $_421487420['NAME'] = $_1766828534[$_548088880 . 'NAME' . $_548088880];
                    $_421487420['URL'] = $this->profile['SITE_PROTOCOL'] . '://' . $this->profile['DOMAIN_NAME'] . $_1766828534[$_548088880 . 'URL' . $_548088880];
                    $_421487420['DESCRIPTION'] = $_1766828534[$_548088880 . 'NAME' . $_548088880] . '

' . GetMessage('ACRIT_FB_PRICE') . $_1766828534[$_548088880 . 'PRICE' . $_548088880] . ' ' . $_1766828534[$_548088880 . 'CURRENCYID' . $_548088880] . '

' . $_1766828534[$_548088880 . 'URL_LABEL' . $_548088880] . $_421487420['URL'] . '

' . $_1766828534[$_548088880 . 'MESSAGE' . $_548088880];
                    if (is_array($_1766828534[$_548088880 . 'PHOTO' . $_548088880]) && !empty($_1766828534[$_548088880 . 'PHOTO' . $_548088880])) {
                        $_421487420['PHOTO'] = array();
                        foreach ($_1766828534[$_548088880 . 'PHOTO' . $_548088880] as $_1819348880) {
                            $_421487420['PHOTO'][] = $_SERVER['DOCUMENT_ROOT'] . $_1819348880;
                        }
                    } else {
                        $_421487420['PHOTO'] = $_SERVER['DOCUMENT_ROOT'] . $_1766828534[$_548088880 . 'PHOTO' . $_548088880];
                    }
                    $this->_488061881->SavePost($_421487420);
                    $this->DemoCountInc();
                }
            } elseif ($this->profile['TYPE'] == 'ok_trade') {
                if ((strlen($_1766828534[$_548088880 . 'NAME' . $_548088880]) > 0) && (intval($_1766828534[$_548088880 . 'PRICE' . $_548088880]) > 0) && (strlen($_1766828534[$_548088880 . 'URL' . $_548088880]) > 0) && (strlen($_1766828534[$_548088880 . 'PHOTO' . $_548088880]) > 0)) {
                    $_421487420 = array();
                    $_421487420['ID'] = $_1766828534[$_548088880 . 'ID' . $_548088880];
                    $_421487420['NAME'] = $_1766828534[$_548088880 . 'NAME' . $_548088880];
                    $_1996143159 = '';
                    if (strlen($_1766828534[$_548088880 . 'UTM_SOURCE' . $_548088880]) > 0) {
                        $_1996143159 .= (strlen($_1996143159) > 0) ? '&amp;' : '?';
                        $_1996143159 .= 'utm_source=' . $_1766828534[$_548088880 . 'UTM_SOURCE' . $_548088880];
                    }
                    if (strlen($_1766828534[$_548088880 . 'UTM_MEDIUM' . $_548088880]) > 0) {
                        $_1996143159 .= (strlen($_1996143159) > 0) ? '&amp;' : '?';
                        $_1996143159 .= 'utm_medium=' . $_1766828534[$_548088880 . 'UTM_MEDIUM' . $_548088880];
                    }
                    if (strlen($_1766828534[$_548088880 . 'UTM_TERM' . $_548088880]) > 0) {
                        $_1996143159 .= (strlen($_1996143159) > 0) ? '&amp;' : '?';
                        $_1996143159 .= 'utm_term=' . $_1766828534[$_548088880 . 'UTM_TERM' . $_548088880];
                    }
                    if (strlen($_1766828534[$_548088880 . 'UTM_CONTENT' . $_548088880]) > 0) {
                        $_1996143159 .= (strlen($_1996143159) > 0) ? '&amp;' : '?';
                        $_1996143159 .= 'utm_content=' . $_1766828534[$_548088880 . 'UTM_CONTENT' . $_548088880];
                    }
                    if (strlen($_1766828534[$_548088880 . 'UTM_CAMPAIGN' . $_548088880]) > 0) {
                        $_1996143159 .= (strlen($_1996143159) > 0) ? '&amp;' : '?';
                        $_1996143159 .= 'utm_campaign=' . $_1766828534[$_548088880 . 'UTM_CAMPAIGN' . $_548088880];
                    }
                    $_421487420['URL'] = $this->profile['SITE_PROTOCOL'] . '://' . $this->profile['DOMAIN_NAME'] . $_1766828534[$_548088880 . 'URL' . $_548088880] . ((strlen($_1996143159) > 0) ? $_1996143159 : '');
                    $_421487420['DESCRIPTION'] = GetMessage('ACRIT_OK_PRICE') . $_1766828534[$_548088880 . 'PRICE' . $_548088880] . ' ' . $_1766828534[$_548088880 . 'CURRENCYID' . $_548088880] . '

' . $_1766828534[$_548088880 . 'URL_LABEL' . $_548088880] . $_421487420['URL'] . '

' . $_1766828534[$_548088880 . 'DESCRIPTION' . $_548088880];
                    $_421487420['DESCRIPTION_MARKET'] = $_1766828534[$_548088880 . 'URL_LABEL' . $_548088880] . '<a href="' . $_421487420['URL'] . '">' . $_421487420['URL'] . '</a>

' . $_1766828534[$_548088880 . 'DESCRIPTION' . $_548088880];
                    $_421487420['PRICE'] = $_1766828534[$_548088880 . 'PRICE' . $_548088880];
                    $_421487420['CURRENCY'] = $_1766828534[$_548088880 . 'CURRENCYID' . $_548088880];
                    $_421487420['OK']['OK_ALBUMS'] = $_1766828534[$_548088880 . 'OK_ALBUMS' . $_548088880];
                    $_421487420['OK']['OK_CATALOGS'] = $_1766828534[$_548088880 . 'OK_CATALOGS' . $_548088880];
                    if (is_array($_1766828534[$_548088880 . 'PHOTO' . $_548088880]) && !empty($_1766828534[$_548088880 . 'PHOTO' . $_548088880])) {
                        $_421487420['PHOTO'][] = $_SERVER['DOCUMENT_ROOT'] . $_1766828534[$_548088880 . 'PHOTO' . $_548088880][0];
                    } else {
                        $_421487420['PHOTO'][] = $_SERVER['DOCUMENT_ROOT'] . $_1766828534[$_548088880 . 'PHOTO' . $_548088880];
                    }
                    $this->_360787538->ProcessData($_421487420);
                    $this->DemoCountInc();
                }
            } else {
                if (isset($_1766828534[$_548088880 . 'PRICE_VALUE' . $_548088880])) {
                    $_1766828534[$_548088880 . 'PRICE_VALUE' . $_548088880] = intval($_1766828534[$_548088880 . 'PRICE_VALUE' . $_548088880]);
                }
                if (isset($_1766828534[$_548088880 . 'OBJECT_IMAGE' . $_548088880])) {
                    if (!file_exists($_1766828534[$_548088880 . 'OBJECT_IMAGE' . $_548088880])) {
                        $_1766828534[$_548088880 . 'OBJECT_IMAGE' . $_548088880] = $this->_12750998[$_548088880 . 'SITE_URL' . $_548088880] . $_1766828534[$_548088880 . 'OBJECT_IMAGE' . $_548088880];
                    }
                }
                $_1108326879 = str_replace(array_keys($this->_12750998), array_values($this->_12750998), $_1108326879);
                $_1108326879 = str_replace(array_keys($_1766828534), array_values($_1766828534), $_1108326879);
                $_1108326879 = preg_replace('/(
[	]*
)/', '
', $_1108326879);
                $_1108326879 = preg_replace('//', '
', $_1108326879);
                $_1108326879 = preg_replace('/\s\w+\W*\w*=""/', '', $_1108326879);
                if ($this->profile['USE_EMPTY_TAG_CUT'] == 'Y') {
                    $_1108326879 = preg_replace('#(<\S+/>)#i', '', $_1108326879);
                    $_438827263 = '#(<(.*)>\s*<\/\2>)#is';
                    while (preg_match($_438827263, $_1108326879)) {
                        $_1108326879 = preg_replace($_438827263, '', $_1108326879);
                    }
                }
                if ($this->profile['SETUP']['CONVERT_DATA_REGEXP'] == 'Y') {
                    if (!empty($this->profile['CONVERT_DATA'])) {
                        foreach ($this->profile['CONVERT_DATA'] as $_1304710919) {
                            $_1108326879 = preg_replace($_1304710919[0], $_1304710919[1], $_1108326879);
                        }
                    }
                } else {
                    if (!empty($this->profile['CONVERT_DATA'])) {
                        foreach ($this->profile['CONVERT_DATA'] as $_1304710919) {
                            $_1108326879 = str_replace($_1304710919[0], $_1304710919[1], $_1108326879);
                        }
                    }
                }
                if ($this->profile['USE_IBLOCK_CATEGORY'] == 'Y') {
                    $_982944057 = $_1799584481['IBLOCK_ID'];
                } elseif ($this->profile['USE_IBLOCK_PRODUCT_CATEGORY'] == 'Y') {
                    $_982944057 = $_1799584481['IBLOCK_PRODUCT_SECTION_ID'];
                } else {
                    $_982944057 = $_1799584481['IBLOCK_SECTION_ID'];
                }
                if (!$_1304010677) {
                    if ($this->profile['TYPE'] == 'ozon_api') {
                        preg_match('/.*?(<description>.*?<\/description>).*?/is', $_1108326879, $_1528162432);
                        $_1812644809 = array('SKU' => array('Name' => $_1766828534[$_548088880 . 'NAME' . $_548088880], 'ManufacturerIdentifier' => $_1766828534[$_548088880 . 'MANUFACTURER_IDENTIFIER' . $_548088880], 'GrossWeight' => $_1766828534[$_548088880 . 'GROSS_WEIGHT' . $_548088880],), 'Price' => array('SellingPrice' => $_1766828534[$_548088880 . 'SELLING_PRICE' . $_548088880],), 'Availability' => array('DaysForShippingDelay' => $_1766828534[$_548088880 . 'SUPPLY_PERIOD' . $_548088880], 'SupplyState' => $_1766828534[$_548088880 . 'SUPPLY_STATE' . $_548088880], 'SellingState' => $_1766828534[$_548088880 . 'SELLING_STATE' . $_548088880],), 'Description' => $_1528162432[1], 'MerchantSKU' => $_1766828534[$_548088880 . 'ID' . $_548088880], 'ProductTypeID' => $_1766828534[$_548088880 . 'MARKET_CATEGORY' . $_548088880],);
                        $_1717737781 = \Bitrix\Main\Web\Json::encode($_1812644809);
                        $_1372257598 = $this->_112131147->SaveProduct($_1717737781);
                        if (!isset($this->profile['SETUP']['OZON_JOBS'])) {
                            $this->profile['SETUP']['OZON_JOBS'] = array();
                            $this->profile['SETUP']['OZON_DATA'] = array();
                        }
                        $this->profile['SETUP']['OZON_JOBS'][] = $_1372257598['JobId'];
                        $this->profile['SETUP']['OZON_DATA'][$_1766828534[$_548088880 . 'ID' . $_548088880]] = $_1717737781;
                        $this->dbRes->Update($this->profile['ID'], $this->profile);
                    } else {
                        if (is_array($_5222085) && count($_5222085)) {
                            $_1658004309 = array_merge_recursive($_1658004309, $_5222085);
                        }
                        $_1000619923 = (intval($_1799584481['ELEMENT_ID']) > 0) ? $_1799584481['ELEMENT_ID'] : $_1799584481['ID'];
                        $_927913034 = CIBlockElement::GetElementGroups($_1000619923, true);
                        $_1250329899 = array();
                        while ($_1725265970 = $_927913034->Fetch()) {
                            $_1250329899[] = $_1725265970['ID'];
                        }
                        CAcritExportproplusTools::SaveSections($this->profile, $_1250329899);
                        $this->DemoCountInc();
                        if (!CAcritExportproplusTools::isVariant($this->profile, $_982944057)) {
                            if (isset($_1030859019['DELAY_FLUSH']) && ($_1030859019['DELAY_FLUSH'] === true)) {
                                CAcritExportproplusExport::Save($_1108326879 . $this->_86593573);
                                $this->_86593573 = '';
                            } elseif (isset($_1030859019['DELAY_SKU']) && ($_1030859019['DELAY_SKU'] === true)) {
                                $this->_86593573 .= $_1108326879;
                                $this->_940439577->IncProductExport();
                            } elseif (isset($_1030859019['DELAY']) && ($_1030859019['DELAY'] === true)) {
                                $this->_940439577->IncProductExport();
                            } else {
                                CAcritExportproplusExport::Save($_1108326879);
                                $this->_940439577->IncProductExport();
                            }
                        }
                    }
                }
                unset($_485935950, $_2112464209, $_515712160);
                if (CAcritExportproplusTools::isVariant($this->profile, $_982944057)) return array('ITEM' => $_1799584481, 'XML' => $_1108326879, 'SKIP' => $_1304010677, 'OFFER' => is_array($_851873695));
            }
            return $_1799584481;
        } else {
            if (!$_1304010677) {
                $this->DemoCountInc();
                $this->_940439577->IncProductExport();
            }
            return !empty($_1766828534) ? $_1766828534 : false;
        }
    }

    private function __502044406($_485935950, $_851873695 = false)
    {
        $this->AddResolve();
        $_1799584481 = $this->__1641660486($_485935950);
        if (!$_851873695 && (intval($this->_2078735835[$_1799584481['IBLOCK_ID']]['OFFERS_IBLOCK_ID']) > 0) && (intval($this->_2078735835[$_1799584481['IBLOCK_ID']]['OFFERS_PROPERTY_ID']) > 0)) {
            $_2058813866 = array('IBLOCK_ID' => $this->_2078735835[$_1799584481['IBLOCK_ID']]['OFFERS_IBLOCK_ID'], 'PROPERTY_' . $this->_2078735835[$_1799584481['IBLOCK_ID']]['OFFERS_PROPERTY_ID'] => $_1799584481['ID']);
            $_274455752 = CIBlockElement::GetList(array(), $_2058813866, false, false, array());
            $_1799584481['_OFFERS_COUNT'] = $_274455752->SelectedRowsCount();
        }
        if (!$_851873695 && ($this->profile['EXPORT_DATA_OFFER_WITH_SKU_DATA'] != 'Y')) {
            if ($_1799584481['_OFFERS_COUNT'] > 0) {
                return $_1799584481;
            }
        }
        if (($this->profile['EXPORT_DATA_OFFER_WITH_SKU_DATA'] == 'Y') && !$_851873695 && $this->_2078735835[$_1799584481['IBLOCK_ID']]['OFFERS_IBLOCK_ID']) {
            $_422846302 = array('CATALOG_PRICE_' . $this->_1294848254 => 'ASC',);
            $_1487562205 = array('IBLOCK_ID' => $this->_2078735835[$_1799584481['IBLOCK_ID']]['OFFERS_IBLOCK_ID'], 'PROPERTY_' . $this->_2078735835[$_1799584481['IBLOCK_ID']]['OFFERS_PROPERTY_ID'] => $_1799584481['ID'], '!CATALOG_PRICE_' . $this->_1294848254 => false, 'ACTIVE' => 'Y');
            if ($this->profile['SETUP']['OFFER_WITH_SKU_USE_QUANTITY'] == 'Y') {
                $_1487562205['!CATALOG_QUANTITY'] = false;
            }
            $_1843558287 = CIBlockElement::GetList($_422846302, $_1487562205, false, false, array());
            $_1801520229 = false;
            if ($_522409400 = $_1843558287->GetNextElement()) {
                $_374146712 = $this->__1641660486($_522409400);
                foreach ($_374146712 as $_519674945 => $_297601288) {
                    if ((is_array($_1799584481[$_519674945]) && empty($_1799584481[$_519674945])) || (!is_array($_1799584481[$_519674945]) && (strlen(trim($_1799584481[$_519674945])) <= 0)) || (!$_1799584481[$_519674945]) || !isset($_1799584481[$_519674945])) {
                        $_1799584481[$_519674945] = $_297601288;
                        if (strpos($_519674945, 'STORE_AMOUNT') !== false) {
                            $_1801520229 = true;
                        }
                    }
                }
            }
            if ($_1801520229) {
                while ($_522409400 = $_1843558287->GetNextElement()) {
                    $_374146712 = $this->__1641660486($_522409400);
                    foreach ($_374146712 as $_519674945 => $_297601288) {
                        if (isset($_1799584481[$_519674945]) && strpos($_519674945, 'STORE_AMOUNT') !== false) {
                            $_1799584481[$_519674945] += $_297601288;
                        }
                    }
                }
            }
        }
        if ($this->_1768427482 && is_array($_851873695)) {
            $_1153331116 = array('NAME', 'PREVIEW_TEXT', 'DETAIL_TEXT', 'PREVIEW_PICTURE', 'DETAIL_PICTURE', 'CATALOG_QUANTITY', 'CATALOG_QUANTITY_RESERVED', 'CATALOG_WEIGHT', 'CATALOG_WIDTH', 'CATALOG_LENGTH', 'CATALOG_HEIGHT', 'CATALOG_PURCHASING_PRICE', 'CATALOG_BARCODE',);
            if ($this->profile['SETUP']['SKU_USE_CANONICAL'] == 'Y' && trim($_851873695['CANONICAL_PAGE_URL']) != '') {
                $_851873695['CANONICAL_PAGE_URL'] = preg_replace('#https?://[^/]+#i', '', $_851873695['CANONICAL_PAGE_URL']);
                $_851873695['DETAIL_PAGE_URL'] = $_851873695['CANONICAL_PAGE_URL'];
                $_1799584481['DETAIL_PAGE_URL'] = $_851873695['DETAIL_PAGE_URL'];
            }
            foreach ($_851873695 as $_1208095729 => $_1438955011) {
                if (!isset($_1799584481[$_1208095729]) || empty($_1799584481[$_1208095729])) {
                    if (!in_array($_1208095729, $_1153331116) && strpos($_1208095729, 'STORE_AMOUNT') === false) {
                        $_1799584481[$_1208095729] = $_1438955011;
                    }
                }
            }
            if (array_key_exists('DETAIL_PICTURE', $_851873695)) {
                $_851873695['DETAIL_PICTURE'] = CFile::GetPath($_851873695['~DETAIL_PICTURE']);
            }
            if (array_key_exists('PREVIEW_PICTURE', $_851873695)) {
                $_851873695['PREVIEW_PICTURE'] = CFile::GetPath($_851873695['~PREVIEW_PICTURE']);
            }
            $_1799584481['ELEMENT_ID'] = $_851873695['ID'];
            $_1799584481['IBLOCK_SECTION_ID'] = $_851873695['IBLOCK_SECTION_ID'];
            foreach ($this->profile['NAMESCHEMA'] as $_1208095729 => $_1438955011) {
                switch ($_1438955011) {
                    case $_1208095729 . '_OFFER':
                        if ($_1208095729 == 'CATALOG_PRICE') {
                            foreach ($this->_1931809273 as $_1078316754) {
                                $_1799584481[$_1208095729 . '_' . $_1078316754] = $_851873695[$_1208095729 . '_' . $_1078316754];
                                $_1799584481[$_1208095729 . '_' . $_1078316754] = ($_1799584481[$_1208095729 . '_' . $_1078316754]);
                            }
                        } else {
                            $_1799584481[$_1208095729] = $_851873695[$_1208095729];
                            $_1799584481[$_1208095729] = ($_1799584481[$_1208095729]);
                        }
                        break;
                    case $_1208095729 . '_OFFER_SKU':
                        if ($_1208095729 == 'CATALOG_PRICE') {
                            foreach ($this->_1931809273 as $_1078316754) {
                                $_1799584481[$_1208095729 . '_' . $_1078316754] = $_851873695[$_1208095729 . '_' . $_1078316754];
                                $_1799584481[$_1208095729 . '_' . $_1078316754] = ($_1799584481[$_1208095729 . '_' . $_1078316754]);
                            }
                        }
                        $_1799584481[$_1208095729] = implode(' ', array($_851873695[$_1208095729], $_1799584481[$_1208095729]));
                        $_1799584481[$_1208095729] = ($_1799584481[$_1208095729]);
                        break;
                    case $_1208095729 . '_OFFER_IF_SKU_EMPTY':
                        if ($_1208095729 == 'CATALOG_PRICE') {
                            foreach ($this->_1931809273 as $_1078316754) {
                                if (!isset($_1799584481[$_1208095729 . '_' . $_1078316754]) || empty($_1799584481[$_1208095729 . '_' . $_1078316754])) {
                                    if (isset($_851873695[$_1208095729 . '_' . $_1078316754]) && !empty($_851873695[$_1208095729 . '_' . $_1078316754])) {
                                        $_1438955011 = $_851873695[$_1208095729 . '_' . $_1078316754];
                                        if (is_array($_1438955011)) {
                                            foreach ($_1438955011 as $_793883927 => $_1276515699) $_1799584481[$_1208095729 . '_' . $_1078316754][$_793883927] = ($_1276515699);
                                        } else {
                                            $_1799584481[$_1208095729 . '_' . $_1078316754] = $_1438955011;
                                            $_1799584481[$_1208095729 . '_' . $_1078316754] = ($_1799584481[$_1208095729 . '_' . $_1078316754]);
                                        }
                                    }
                                }
                            }
                        } else {
                            if (!isset($_1799584481[$_1208095729]) || empty($_1799584481[$_1208095729])) {
                                if (isset($_851873695[$_1208095729]) && !empty($_851873695[$_1208095729])) {
                                    $_1438955011 = $_851873695[$_1208095729];
                                    if (is_array($_1438955011)) {
                                        foreach ($_1438955011 as $_793883927 => $_1276515699) $_1799584481[$_1208095729][$_793883927] = ($_1276515699);
                                    } else {
                                        $_1799584481[$_1208095729] = $_1438955011;
                                        $_1799584481[$_1208095729] = ($_1799584481[$_1208095729]);
                                    }
                                }
                            }
                        }
                        break;
                }
            }
        } else {
            $_1799584481['GROUP_ITEM_ID'] = $_1799584481['ID'];
        }
        return $_1799584481;
    }

    protected function AddResolve()
    {
        foreach ($this->profile["XMLDATA"] as $_29195840 => $_1639684675) {
            if (!empty($_1639684675["VALUE"]) || !empty($_1639684675["CONTVALUE_FALSE"]) || !empty($_1639684675["CONTVALUE_TRUE"]) || !empty($_1639684675["COMPLEX_TRUE_VALUE"]) || !empty($_1639684675["COMPLEX_FALSE_VALUE"]) || !empty($_1639684675["COMPLEX_TRUE_CONTVALUE"]) || !empty($_1639684675["COMPLEX_FALSE_CONTVALUE"])) {
                $_1757453782 = ($_1639684675["TYPE"] == "field") ? $_1639684675["VALUE"] : $_1639684675['COMPLEX_TRUE_VALUE'];
                $_47247544 = explode('-', $_1757453782);
                switch (count($_47247544)) {
                    case 1:
                        if (!is_null($_1639684675['RESOLVE']) && strlen($_1639684675['RESOLVE']) > 0) {
                            $this->_508964447[$_29195840]['FIELDS'][$_47247544[0]] = $_1639684675['RESOLVE'];
                        }
                        break;
                    case 2:
                        if (!is_null($_1639684675['RESOLVE']) && strlen($_1639684675['RESOLVE'])) {
                            $this->_508964447[$_29195840]['PRICES'][$_47247544[1]] = $_1639684675['RESOLVE'];
                        }
                        break;
                    case 3:
                        if (!is_null($_1639684675['RESOLVE']) && strlen($_1639684675['RESOLVE'])) {
                            $this->_508964447[$_29195840]['PROPERTIES'][$_47247544[2]] = $_1639684675['RESOLVE'];
                        }
                        break;
                }
            }
        }
    }

    private function __1641660486($_485935950)
    {
        global $DB, $USER;
        if (!is_object($USER)) $USER = new CUser();
        $_1799584481 = $_485935950->GetFields();
        foreach ($_1799584481 as $_2068810781 => $_1271938232) {
            if (isset($_1799584481['~' . $_2068810781])) {
                $_1799584481[$_2068810781] = $_1799584481['~' . $_2068810781];
            }
        }
        if (in_array('DETAIL_PICTURE', $this->_1020535029)) {
            $_1799584481['DETAIL_PICTURE'] = CFile::GetPath($_1799584481['DETAIL_PICTURE']);
        }
        if (in_array('PREVIEW_PICTURE', $this->_1020535029)) {
            $_1799584481['PREVIEW_PICTURE'] = CFile::GetPath($_1799584481['PREVIEW_PICTURE']);
        }
        foreach ($_1799584481 as $_1208095729 => &$_1438955011) {
            if (in_array($_1208095729, $this->_15755796)) {
                $_1438955011 = date(str_replace('_', ' ', $this->profile['DATEFORMAT']), strtotime($_1438955011));
            }
        }
        if ($this->profile['USE_IBLOCK_PRODUCT_CATEGORY'] == 'Y') {
            $_887648010 = CCatalog::GetByID($_1799584481['IBLOCK_ID']);
            $_119952027 = $_887648010['SKU_PROPERTY_ID'];
            $_585880663 = $_887648010['PRODUCT_IBLOCK_ID'];
            $_1027951075 = CAcritExportproplusTools::GetProperties($_1799584481, array('ID' => $_119952027));
            foreach ($_1027951075 as $_1704556277 => $_346600900) {
                if (intval($_346600900['VALUE']) > 0) {
                    $_1473527329 = CIBlockElement::GetList(array(), array('IBLOCK_ID' => $_585880663, 'ID' => $_346600900['VALUE']), false, false, array('ID', 'IBLOCK_ID', 'IBLOCK_SECTION_ID'));
                    if ($_1464953499 = $_1473527329->GetNext()) {
                        $_1799584481['IBLOCK_PRODUCT_SECTION_ID'] = $_1464953499['IBLOCK_SECTION_ID'];
                    }
                }
            }
        }
        $_1799584481['SECTION_ID'] = array();
        $_1799584481['SECTION_EXDATA'] = array();
        $_1799584481['IBLOCK_SECTION_NAME'] = array();
        $_727770066 = CIBlockElement::GetElementGroups($_1799584481['ID'], true);
        while ($_1370975761 = $_727770066->Fetch()) {
            if (in_array('IBLOCK_SECTION_NAME', $this->_1020535029)) {
                $_1799584481['IBLOCK_SECTION_NAME'] = $_1370975761['NAME'];
            }
            $_1799584481['SECTION_ID'][] = $_1370975761['ID'];
            $_1799584481['SECTION_EXDATA'][$_1370975761['ID']] = $_1370975761;
        }
        $_1799584481['ALL_SECTION_ID'] = $_1799584481['SECTION_ID'];
        if (is_array($_1799584481['SECTION_ID']) && !empty($_1799584481['SECTION_ID']) && is_array($this->profile['CATEGORY']) && !empty($this->profile['CATEGORY'])) {
            $_1715674806 = $_1799584481['SECTION_ID'];
            foreach ($_1715674806 as $_2085552139 => $_340672755) {
                $_1175723977 = CIBlockSection::GetNavChain(false, $_340672755);
                $_945247598 = false;
                while ($_419516118 = $_1175723977->GetNext()) {
                    if (in_array($_419516118['ID'], $this->profile['CATEGORY'])) {
                        $_945247598 = true;
                        break;
                    }
                }
                if (!$_945247598) {
                    unset($_1799584481['SECTION_ID'][$_2085552139]);
                }
            }
        }
        $_1799584481['SECTION_PARENT_ID'] = array();
        $_899378343 = CIBlockSection::GetNavChain(false, $_1799584481['IBLOCK_SECTION_ID']);
        while ($_2098705473 = $_899378343->GetNext()) {
            $_1799584481['SECTION_PARENT_ID'][] = $_2098705473['ID'];
        }
        $_1316603764 = array('IBLOCK_ID' => $_1799584481['IBLOCK_ID'], 'ID' => $_1799584481['IBLOCK_SECTION_ID'],);
        $_1236435482 = CIBlockSection::GetList(array(), $_1316603764, false, array('ID', 'IBLOCK_ID', 'IBLOCK_SECTION_ID', 'NAME', 'UF_*',));
        $_1290390566 = CAcritExportproplusTools::GetIblockUserFields($_1799584481['IBLOCK_ID']);
        if (($_1665603153 = $_1236435482->GetNext()) && is_array($_1290390566) && !empty($_1290390566)) {
            foreach ($_1290390566 as $_1228977320) {
                if (in_array($_1228977320['FIELD_NAME'], $this->_1020535029)) {
                    $_1799584481[$_1228977320['FIELD_NAME']] = $_1665603153[$_1228977320['FIELD_NAME']];
                    $_1438955011 = $_1665603153[$_1228977320['FIELD_NAME']];
                    if ($this->GetResolveProperties($_1228977320, $_1228977320['FIELD_NAME'], 'FIELDS', $_1438955011)) {
                        $_1799584481[$_1228977320['FIELD_NAME']] = $_1438955011;
                    }
                }
            }
        }
        if (count($this->_845490442['ID'])) {
            $_838141040 = CAcritExportproplusTools::GetProperties($_1799584481, array('ID' => $this->_845490442['ID']));
            foreach ($this->_845490442['ID'] as $_1384817406) {
                if (!isset($_838141040[$_1384817406])) {
                    $_1799584481["PROPERTY_{$_1384817406}_VALUE"] = array();
                }
            }
            foreach ($_838141040 as $_2037385115) {
                if ($_2037385115['USER_TYPE'] == 'DateTime') {
                    $_2037385115['DISPLAY_VALUE'] = date(str_replace('_', ' ', $this->profile['DATEFORMAT']), strtotime($_2037385115['VALUE']));
                } elseif ($_2037385115['PROPERTY_TYPE'] == 'E') {
                    $_2037385115['ORIGINAL_VALUE'] = array();
                    if (!empty($_2037385115['VALUE'])) {
                        $_255923444 = CIBlockElement::GetList(array(), array('ID' => $_2037385115['VALUE']), false, false, array('ID', 'NAME'));
                        while ($_1175210055 = $_255923444->GetNext()) {
                            $_2037385115['DISPLAY_VALUE'][] = $_1175210055['NAME'];
                            $_2037385115['ORIGINAL_VALUE'][] = $_1175210055['ID'];
                        }
                    }
                } elseif ($_2037385115['PROPERTY_TYPE'] == 'G') {
                    $_2037385115['ORIGINAL_VALUE'] = array();
                    if (!empty($_2037385115['VALUE'])) {
                        $_255923444 = CIBlockSection::GetList(array(), array('ID' => $_2037385115['VALUE']), false, array('ID', 'NAME'));
                        while ($_1175210055 = $_255923444->GetNext()) {
                            $_2037385115['DISPLAY_VALUE'][] = $_1175210055['NAME'];
                            $_2037385115['ORIGINAL_VALUE'][] = $_1175210055['ID'];
                        }
                    }
                } elseif ($this->GetResolveProperties($_2037385115, $_2037385115['ID'], 'PROPERTIES')) {
                } else {
                    $_2037385115 = CIBlockFormatProperties::GetDisplayValue($_1799584481, $_2037385115, 'acrit_exportproplus_event');
                    if (empty($_2037385115['VALUE_ENUM_ID'])) {
                        if (!is_array($_2037385115['DISPLAY_VALUE'])) $_2037385115['ORIGINAL_VALUE'] = array($_2037385115['DISPLAY_VALUE']); else $_2037385115['ORIGINAL_VALUE'] = $_2037385115['DISPLAY_VALUE'];
                    } else {
                        if (!is_array($_2037385115['VALUE_ENUM_ID'])) $_2037385115['ORIGINAL_VALUE'] = array($_2037385115['VALUE_ENUM_ID']); else $_2037385115['ORIGINAL_VALUE'] = $_2037385115['VALUE_ENUM_ID'];
                    }
                }
                if ($_2037385115['PROPERTY_TYPE'] == 'F') {
                    $_2037385115['DISPLAY_VALUE'] = array();
                    if (count($_2037385115['ORIGINAL_VALUE']) > 1) {
                        if (is_array($_2037385115['FILE_VALUE']) && !empty($_2037385115['FILE_VALUE'])) {
                            foreach ($_2037385115['FILE_VALUE'] as $_1451049482) {
                                $_2037385115['DISPLAY_VALUE'][] = $_1451049482['SRC'];
                            }
                        } elseif (is_array($_2037385115['VALUE']) && !empty($_2037385115['VALUE'])) {
                            foreach ($_2037385115['VALUE'] as $_1451049482) {
                                $_2037385115['DISPLAY_VALUE'][] = CFile::GetPath($_1451049482);
                            }
                        }
                    } else {
                        if (isset($_2037385115['VALUE']) && !empty($_2037385115['VALUE'])) {
                            $_2037385115['DISPLAY_VALUE'] = $_2037385115['FILE_VALUE']['SRC'];
                        } elseif (isset($_2037385115['VALUE']) && !empty($_2037385115['VALUE'])) {
                            $_2037385115['DISPLAY_VALUE'] = CFile::GetPath($_2037385115['VALUE']);
                        }
                    }
                }
                $_1799584481["PROPERTY_{$_2037385115['ID']}_DISPLAY_VALUE"] = $_2037385115['DISPLAY_VALUE'];
                $_1799584481["PROPERTY_{$_2037385115['CODE']}_DISPLAY_VALUE"] = $_1799584481["PROPERTY_{$_2037385115['ID']}_VALUE"];
                $_1799584481["PROPERTY_{$_2037385115['ID']}_VALUE"] = $_2037385115['ORIGINAL_VALUE'];
                $_1799584481["PROPERTY_{$_2037385115['CODE']}_VALUE"] = $_1799584481["PROPERTY_{$_2037385115['ID']}_VALUE"];
            }
        }
        if ($this->_1768427482) {
            $_887539035 = CCatalogProduct::GetByID($_1799584481['ID']);
            $_1799584481['CATALOG_QUANTITY'] = $_887539035['QUANTITY'];
            $_1799584481['CATALOG_QUANTITY_RESERVED'] = $_887539035['QUANTITY_RESERVED'];
            $_1799584481['CATALOG_WEIGHT'] = $_887539035['WEIGHT'];
            $_1799584481['CATALOG_WIDTH'] = $_887539035['WIDTH'];
            $_1799584481['CATALOG_LENGTH'] = $_887539035['LENGTH'];
            $_1799584481['CATALOG_HEIGHT'] = $_887539035['HEIGHT'];
            $_2112464209 = CPrice::GetList(array(), array('PRODUCT_ID' => $_1799584481['ID']));
            while ($_1168058661 = $_2112464209->Fetch()) {
                if (((intval($_1168058661['QUANTITY_FROM']) > 0) || (intval($_1168058661['QUANTITY_TO']) > 0)) && (intval($_1168058661['QUANTITY_FROM']) !== 1)) {
                    continue;
                }
                if (in_array('PRICE_' . $_1168058661['CATALOG_GROUP_ID'] . '_WD', $this->_1931809273) || in_array('PRICE_' . $_1168058661['CATALOG_GROUP_ID'] . '_D', $this->_1931809273)) {
                    $_1432753308 = CCatalogDiscount::GetDiscountByPrice($_1168058661['ID'], $USER->GetUserGroupArray(), 'N', $this->profile['LID']);
                    $_1156465674 = CCatalogProduct::CountPriceWithDiscount($_1168058661['PRICE'], $_1168058661['CURRENCY'], $_1432753308);
                    $_277498185 = $_1168058661['PRICE'] - $_1156465674;
                } else {
                    $_1156465674 = $_1168058661['PRICE'];
                    $_277498185 = 0;
                }
                $_1799584481["CATALOG_PRICE_{$_1168058661['CATALOG_GROUP_ID']}"] = $_1168058661['PRICE'];
                $_1799584481["CATALOG_PRICE_{$_1168058661['CATALOG_GROUP_ID']}_ID"] = $_1168058661['ID'];
                $_1799584481["CATALOG_PRICE_{$_1168058661['CATALOG_GROUP_ID']}_WD_ID"] = $_1168058661['ID'];
                $_1799584481["CATALOG_PRICE_{$_1168058661['CATALOG_GROUP_ID']}_PRICEID"] = $_1168058661['CATALOG_GROUP_ID'];
                $_1799584481["CATALOG_PRICE_{$_1168058661['CATALOG_GROUP_ID']}_WD_PRICEID"] = $_1168058661['CATALOG_GROUP_ID'];
                $_1799584481["CATALOG_PRICE_{$_1168058661['CATALOG_GROUP_ID']}_WD"] = $_1168058661['PRICE'];
                $_1799584481["CATALOG_PRICE_{$_1168058661['CATALOG_GROUP_ID']}_D"] = $_277498185;
                $_1799584481["CATALOG_PRICE{$_1168058661['CATALOG_GROUP_ID']}"] = $_1168058661['PRICE'];
                $_1799584481["CATALOG_PRICE_{$_1168058661['CATALOG_GROUP_ID']}_WD_CURRENCY"] = $_1168058661['CURRENCY'];
                $_1799584481["CATALOG_PRICE_{$_1168058661['CATALOG_GROUP_ID']}_CURRENCY"] = $_1168058661['CURRENCY'];
            }
            if (!isset($_1799584481["CATALOG_PRICE_{$this->_1294848254}"]) && ($this->profile['USE_AUTOPRICE'] == 'Y')) {
                if ($_2056743916 = CCatalogProduct::GetOptimalPrice($_1799584481['ID'], 1, array(2), 'N', array(), $this->profile['LID'], array())) {
                    $_872406557 = $_2056743916['PRICE']['CATALOG_GROUP_ID'];
                    $_1799584481["CATALOG_PRICE_{$this->_1294848254}"] = $_1799584481["CATALOG_PRICE_{$_872406557}"];
                    $_1799584481["CATALOG_PRICE_{$this->_1294848254}_ID"] = $_2056743916['ID'];
                    $_1799584481["CATALOG_PRICE_{$this->_1294848254}_WD_ID"] = $_2056743916['ID'];
                    $_1799584481["CATALOG_PRICE_{$this->_1294848254}_PRICEID"] = $this->_1294848254;
                    $_1799584481["CATALOG_PRICE_{$this->_1294848254}_WD_PRICEID"] = $this->_1294848254;
                    $_1799584481["CATALOG_PRICE_{$this->_1294848254}_WD"] = $_1799584481["CATALOG_PRICE_{$_872406557}"];
                    $_1799584481["CATALOG_PRICE_{$this->_1294848254}_D"] = $_1799584481["CATALOG_PRICE_{$_872406557}_D"];
                    $_1799584481["CATALOG_PRICE{$this->_1294848254}"] = $_1799584481["CATALOG_PRICE{$_872406557}"];
                    $_1799584481["CATALOG_PRICE_{$this->_1294848254}_WD_CURRENCY"] = $_1799584481["CATALOG_PRICE_{$_872406557}_CURRENCY"];
                    $_1799584481["CATALOG_PRICE_{$this->_1294848254}_CURRENCY"] = $_1799584481["CATALOG_PRICE_{$_872406557}_CURRENCY"];
                }
            }
            if (in_array('PURCHASING_PRICE', $this->_1931809273)) {
                $_1799584481['CATALOG_PURCHASING_PRICE'] = $_887539035['PURCHASING_PRICE'];
                $_1799584481['CATALOG_PURCHASING_PRICE_CURRENCY'] = $_887539035['PURCHASING_CURRENCY'];
            }
            $_626415311 = CCatalogStoreProduct::GetList(array(), array('PRODUCT_ID' => $_887539035['ID']), false, false, array());
            while ($_922104295 = $_626415311->Fetch()) {
                $_1799584481['CATALOG_STORE_AMOUNT_' . $_922104295['STORE_ID']] = $_922104295['AMOUNT'];
            }
            $_525281041 = CCatalogStoreBarCode::getList(array(), array('PRODUCT_ID' => $_887539035['ID']), false, false, array());
            if ($_351464861 = $_525281041->Fetch()) {
                $_1799584481['CATALOG_BARCODE'] = $_351464861['BARCODE'];
            }
        }
        unset($_838141040, $_887539035, $_2112464209, $_1168058661);
        return $_1799584481;
    }

    protected function GetResolveProperties(&$_1659850986, $_2141483972, $type, &$_1438955011 = "")
    {
        if (($this->_29195840 === false) || !isset($this->_508964447[$this->_29195840][$type][$_2141483972])) return false;
        $_620966258 = $this->_508964447[$this->_29195840][$type][$_2141483972];
        switch ($type) {
            case 'PROPERTIES':
                if (($_1659850986['PROPERTY_TYPE'] == 'S') && ($_1659850986['USER_TYPE'] == 'UserID')) {
                    $_1343343553 = CUser::GetByID($_1659850986['VALUE']);
                    $_209177376 = $_1343343553->Fetch();
                    if (array_key_exists($_620966258, $_209177376)) {
                        $_1659850986['VALUE'] = $_209177376[$_620966258];
                        $_1659850986['~VALUE'] = $_209177376[$_620966258];
                        $_1659850986['DISPLAY_VALUE'] = $_209177376[$_620966258];
                        $_1659850986['ORIGINAL_VALUE'] = $_209177376[$_620966258];
                    }
                    return true;
                }
                break;
        }
    }

    private function __745667146($_637677671, $_1763544516 = false, $_1799584481 = false)
    {
        if (!isset($_637677671) || (intval($_637677671) <= 0)) {
            return false;
        }
        $_1241137030 = array();
        $_809390571 = CIBlockElement::GetProperty($_1799584481['IBLOCK_ID'], $_1799584481['ID'], array(), array('ID' => $_1763544516));
        if ($_1589038159 = $_809390571->GetNext()) {
            $_1542864873 = HighloadBlockTable::getList(array('filter' => array('=ID' => $_637677671,)))->fetch();
            $_1843419062 = CUserTypeEntity::GetList(array('ID' => 'ASC'), array('ENTITY_ID' => 'HLBLOCK_' . $_637677671));
            $_962318633 = 0;
            while ($_721808997 = $_1843419062->Fetch()) {
                $_1241137030[$_721808997['FIELD_NAME']] = $_721808997;
                $_962318633++;
            }
            $_2121197456 = HighloadBlockTable::compileEntity($_1542864873);
            $_96620513 = $_2121197456->getDataClass();
            $_1349044119 = $_96620513::getList(array('filter' => array('UF_XML_ID' => $_1589038159['VALUE'])));
            while ($_2125920667 = $_1349044119->fetch()) {
                foreach ($_1241137030 as $_2145890074 => $_613924859) {
                    if ($_613924859['USER_TYPE_ID'] == 'file') {
                        $_1241137030[$_2145890074]['VALUE'] = CFile::GetPath($_2125920667[$_2145890074]);
                    } else {
                        $_1241137030[$_2145890074]['VALUE'] = $_2125920667[$_2145890074];
                    }
                }
            }
        }
        return $_1241137030;
    }

    protected function DemoCountInc()
    {
        $_243855875 = AcritExportproplusSession::GetSession($this->profile["ID"]);
        if (!isset($_243855875['EXPORTPROPLUS'][$this->profile['ID']]['DEMO_COUNT'])) $_243855875['EXPORTPROPLUS'][$this->profile['ID']]['DEMO_COUNT'] = 0;
        $_243855875['EXPORTPROPLUS'][$this->profile['ID']]['DEMO_COUNT']++;
        AcritExportproplusSession::SetSession($this->profile['ID'], $_243855875);
    }

    public function Process($_1634919591 = 1, $_1022528073 = false, $_571750383 = "xml", $_2060967116 = false, $_1683462550 = false, $_1768420642 = false, &$_547736148 = false, $_341676656 = false, $_1897180346 = 0, $_1478952812 = 0)
    {
        global $fileExportDataSize, $fileExportData, $ProcessEnd;
        $_140903121 = false;
        $this->SetProcessStart($_140903121);
        if ($_571750383 == 'csv') {
            $_916911980 = self::ProcessCSV($_1634919591, $_1022528073, $_2060967116, $_1683462550);
        } elseif ($_571750383 == 'xlsx') {
            $_916911980 = self::ProcessCSV($_1634919591, $_1022528073, $_2060967116, $_1683462550, true);
        } else {
            $_916911980 = self::ProcessXML($_1634919591, $_1022528073, $_1768420642, $_341676656, $_1897180346, $_1478952812);
        }
        $this->SetProcessEnd($_140903121);
        while (true !== $ProcessEnd) {
        }
        $_547736148 = $ProcessEnd;
        return $_916911980;
    }

    public function SetProcessStart($_2060967116)
    {
        if (false === $_2060967116) return;
    }

    public function ProcessCSV($_1634919591 = 1, $_1022528073 = false, $_2060967116 = false, $_1683462550 = false, $_3267963 = false)
    {
        global $APPLICATION;
        if (!$_2060967116 || !$_1683462550) return false;
        $_1461419195 = self::PrepareProcess($_1634919591);
        if (!is_object($_1461419195)) return false;
        $_239173557 = (intval($_1461419195->_1235249829) > 0) ? $_1461419195->_1235249829 : ceil($_1461419195->SelectedRowsCount() / $this->stepElements);
        $_243855875 = AcritExportproplusSession::GetSession($this->profile['ID']);
        $_243855875['EXPORTPROPLUS']['LOG'][$this->profile['ID']]['STEPS'] = $this->isDemo ? 1 : $_239173557;
        AcritExportproplusSession::SetSession($this->profile['ID'], $_243855875);
        if ($this->profile['TYPE'] == 'advantshop') {
            self::ProcessBasicCsv($_1461419195, $_2060967116, $_1634919591, $_239173557, $_3267963);
        } else {
            self::ProcessBasicCsv($_1461419195, $_2060967116, $_1634919591, $_239173557, $_3267963);
        }
        if (!$_1022528073) {
            echo '<div id="csv_process" style="width: 100%; text-align: center; font-size: 18px; margin: 40px 0; padding: 40px 0; border: 1px solid #ccc; border-radius: 6px; background: #f5f5f5;">', GetMessage('ACRIT_EXPORTPROPLUS_RUN_EXPORT_RUN'), '<br/>', str_replace(array('#PROFILE_ID#', '#PROFILE_NAME#'), array($this->profile['ID'], $this->profile['NAME']), GetMessage('ACRIT_EXPORTPROPLUS_RUN_STEP_PROFILE')), '<br/>', str_replace(array('#STEP#', '#COUNT#'), array($_1634919591, $_239173557), GetMessage('ACRIT_EXPORTPROPLUS_RUN_STEP_RUN')), '</div>';
        }
        if ($_1634919591 >= $_239173557) {
            return true;
        }
        return false;
    }

    public function ProcessBasicCsv($_1461419195, $_2060967116, $_1634919591, $_239173557, $_3267963 = false)
    {
        if ($_3267963 && !class_exists("XMLWriter")) {
            return false;
        }
        if (class_exists('XMLWriter')) {
            if (!class_exists('PHPExcel') && !class_exists('PHPExcel_IOFactory')) {
                require_once(__DIR__ . '/classes/general/PHPExcel.php');
                require_once(__DIR__ . '/classes/general/PHPExcel/IOFactory.php');
            }
        }
        if (!$_1461419195->SelectedRowsCount() || !$_2060967116) {
            return false;
        }
        if ($_1634919591 == 1) {
            $_242162046 = array();
        }
        if ($this->profile['TYPE'] == 'advantshop') {
            $_417050936 = 'sku_size_color_price_purchaseprice_amount';
        }
        $_1813127374 = false;
        $_1304313284 = false;
        $_277873286 = false;
        $_559483616 = false;
        if (($this->profile['EXPORT_DATA_OFFER'] == 'Y')) {
            $_1813127374 = true;
        }
        if ($this->profile['EXPORT_DATA_OFFER_WITH_SKU_DATA'] == 'Y') {
            $_1304313284 = true;
        }
        if ($this->profile['EXPORT_DATA_SKU'] == 'Y') {
            $_277873286 = true;
        }
        if ($this->profile['EXPORT_DATA_SKU_BY_OFFER'] == 'Y') {
            $_559483616 = true;
        }
        while ($_7672767 = $_1461419195->GetNextElement()) {
            $_698165198 = $this->__705054251($_7672767, false, true);
            if ($_698165198) {
                if (empty($_242162046) && ($_1634919591 == 1)) {
                    foreach ($_698165198 as $_451509742 => $_1146433095) {
                        if (($this->profile['TYPE'] == 'advantshop') && ($_451509742 == $_417050936)) {
                            $_451509742 = str_replace('_', ':', $_451509742);
                        }
                        $_242162046[] = $_451509742;
                    }
                }
                if (($_1813127374 || $_1304313284 || $_559483616) && $this->profile['TYPE'] != 'advantshop') {
                    $_1237891453[] = $_698165198;
                }
                $_1799584481 = $this->__1641660486($_7672767);
                if ($this->_1768427482 && ($this->profile['USE_SKU'] == 'Y') && ($_1304313284 || $_277873286) && ($this->_2078735835[$_1799584481['IBLOCK_ID']])) {
                    $_1487562205 = array('IBLOCK_ID' => $this->_2078735835[$_1799584481['IBLOCK_ID']]['OFFERS_IBLOCK_ID'], 'PROPERTY_' . $this->_2078735835[$_1799584481['IBLOCK_ID']]['OFFERS_PROPERTY_ID'] => $_1799584481['ID']);
                    $_1843558287 = CIBlockElement::GetList(array(), $_1487562205, false, false, array());
                    if ($this->profile['TYPE'] == 'advantshop') {
                        $_2128889270 = '';
                    }
                    while ($_522409400 = $_1843558287->GetNextElement()) {
                        $_2048629162 = $this->__705054251($_522409400, $_1799584481, true);
                        if (!$_2048629162) continue;
                        if (empty($_242162046) && ($_1634919591 == 1)) {
                            foreach ($_2048629162 as $_451509742 => $_1146433095) {
                                $_242162046[] = $_451509742;
                            }
                        }
                        if ($this->profile['TYPE'] != 'advantshop') {
                            $_1237891453[] = $_2048629162;
                        } else {
                            $_2128889270 .= ((strlen($_2128889270) > 0) ? ';' : '') . $_2048629162[$_417050936];
                        }
                        if ($this->isDemo && $this->DemoCount()) {
                            break;
                        }
                    }
                    if ($this->isDemo && $this->DemoCount()) {
                        break;
                    }
                }
                if ($this->profile['TYPE'] == 'advantshop') {
                    if ($this->profile['XMLDATA'][$_417050936]['CONVERT_DATA_REGEXP'] == 'Y') {
                        if (!empty($this->profile['XMLDATA'][$_417050936]['CONVERT_DATA'])) {
                            foreach ($this->profile['XMLDATA'][$_417050936]['CONVERT_DATA'] as $_1304710919) {
                                $_2128889270 = preg_replace($_1304710919[0], $_1304710919[1], $_2128889270);
                            }
                        }
                    } else {
                        if (!empty($this->profile['XMLDATA'][$_417050936]['CONVERT_DATA'])) {
                            foreach ($this->profile['XMLDATA'][$_417050936]['CONVERT_DATA'] as $_1304710919) {
                                $_2128889270 = str_replace($_1304710919[0], $_1304710919[1], $_2128889270);
                            }
                        }
                    }
                    $_698165198[$_417050936] = $_2128889270;
                    $_1237891453[] = $_698165198;
                }
            }
        }
        if (!$_3267963) {
            $_2017255360 = new CCSVData();
            $_2017255360->SetFieldsType('R');
            $_1233373894 = ';';
            $_2017255360->SetDelimiter($_1233373894);
        }
        $_1151979504 = array();
        if ($_1634919591 == 1) {
            $_573539039 = array();
            $_1116715160 = array();
            $_1116715160['HEADER'] = array();
            $_1116715160['ROWS'] = array();
            foreach ($_242162046 as $_1919294813) {
                if ($_1919294813 == 'ID') {
                    $_1919294813 = 'Id';
                }
                $_573539039[] = $this->ExportConvertCharset($_1919294813);
            }
            if (!$_3267963) {
                CAcritExportproplusTools::ExportArrayMultiply($_1151979504, $_573539039);
            } else {
                $_1116715160['HEADER'] = $_573539039;
                foreach ($_1116715160['HEADER'] as $_1155070418 => $_1726820895) {
                    $_1116715160['HEADER'][$_1155070418] = array('NAME' => $_1726820895, 'TYPE' => PHPExcel_Cell_DataType::TYPE_STRING2);
                }
            }
        }
        foreach ($_1237891453 as $_1043885019) {
            $_573539039 = array();
            foreach ($_1043885019 as $_1146433095) {
                if (is_array($_1146433095) && empty($_1146433095)) {
                    $_1146433095 = '';
                }
                $_573539039[] = $this->ExportConvertCharset($_1146433095);
            }
            if (!$_3267963) {
                CAcritExportproplusTools::ExportArrayMultiply($_1151979504, $_573539039);
            } else {
                CAcritExportproplusTools::ExportArrayMultiply($_1116715160['ROWS'], $_573539039);
            }
        }
        if (!$_3267963) {
            foreach ($_1151979504 as $_573539039) {
                $_2017255360->SaveFile($_2060967116, $_573539039);
            }
            $_2017255360->CloseFile();
        } else {
            if (is_array($_1116715160) && !empty($_1116715160)) {
                $_363010572 = $_SERVER['DOCUMENT_ROOT'] . $this->profile['SETUP']['URL_DATA_FILE'];
                CAcritExportproplusTools::ArrayToExcel($_363010572, $this->profile['CODE'], $_1116715160, $this->profile, $_1634919591);
            }
        }
    }

    protected function DemoCount()
    {
        $_343599766 = AcritExportproplusSession::GetAllSession($this->profile["ID"]);
        $_1045937304 = 0;
        if (!empty($_343599766)) {
            foreach ($_343599766 as $_382622158) {
                $_1045937304 += $_382622158['EXPORTPROPLUS'][$this->profile['ID']]['DEMO_COUNT'];
            }
        }
        return ($_1045937304 > $this->_1418746172);
    }

    public function ExportConvertCharset($_1639684675)
    {
        global $APPLICATION;
        $result = '';
        $_1136836731 = CAcritExportproplusTools::GetStringCharset($_1639684675);
        $result = $APPLICATION->ConvertCharset($_1639684675, $_1136836731, $this->_1330835753[$this->profile['ENCODING']]);
        return $result;
    }

    public function ProcessXML($_1634919591 = 1, $_1022528073 = false, $_1768420642 = false, $_341676656 = false, $_1897180346 = 0, $_1478952812 = 0)
    {
        $_1603433907 = CAcritExportproplusTools::GetProfileMarketCategoryType($this->profile["TYPE"]);
        if ($_1603433907 == 'CExportproplusMarketTiuDB') {
            $_1615441130 = new CExportproplusMarketTiuDB();
            $_1615441130 = $_1615441130->GetList();
            $this->_1615441130 = $_1615441130;
        } elseif ($_1603433907 == 'CExportproplusMarketPromuaDB') {
            $_1615441130 = new CExportproplusMarketPromuaDB();
            $_1615441130 = $_1615441130->GetList();
            $this->_1615441130 = $_1615441130;
        } elseif ($_1603433907 == 'CExportproplusMarketMailruDB') {
            $_1615441130 = new CExportproplusMarketMailruDB();
            $_1615441130 = $_1615441130->GetList();
            $this->_1615441130 = $_1615441130;
        }
        $_1461419195 = self::PrepareProcess($_1634919591, $_341676656);
        if (!is_object($_1461419195)) return false;
        $_239173557 = (intval($_1461419195->_1235249829) > 0) ? $_1461419195->_1235249829 : ceil($_1461419195->SelectedRowsCount() / $this->stepElements);
        $_243855875 = AcritExportproplusSession::GetSession($this->profile['ID']);
        $_243855875['EXPORTPROPLUS']['LOG'][$this->profile['ID']]['STEPS'] = $_239173557;
        AcritExportproplusSession::SetSession($this->profile['ID'], $_243855875);
        $_1813127374 = false;
        $_1304313284 = false;
        $_277873286 = false;
        $_559483616 = false;
        if (($this->profile['EXPORT_DATA_OFFER'] == 'Y')) {
            $_1813127374 = true;
        }
        if ($this->profile['EXPORT_DATA_OFFER_WITH_SKU_DATA'] == 'Y') {
            $_1304313284 = true;
        }
        if ($this->profile['EXPORT_DATA_SKU'] == 'Y') {
            $_277873286 = true;
        }
        if ($this->profile['EXPORT_DATA_SKU_BY_OFFER'] == 'Y') {
            $_559483616 = true;
        }
        if ($_1461419195->SelectedRowsCount()) {
            if (($this->profile['TYPE'] == 'vk_trade') && ($_1634919591 == 1)) {
            } elseif (($this->profile['TYPE'] == 'ok_trade') && ($_1634919591 == 1)) {
                $this->_360787538->ClearSyncData();
            } elseif (($this->profile['TYPE'] == 'instagram_trade') && ($_1634919591 == 1)) {
            }
        }
        if ($this->_2021795626) {
            $_1897180346 = 0;
        }
        while ($_485935950 = $_1461419195->GetNextElement()) {
            $_111748978 = AcritExportproplusSession::GetSession($this->profile['ID']);
            if ($_341676656) {
                if (($_111748978['EXPORTPROPLUS']['LOG'][$this->profile['ID']]['PRODUCTS_EXPORT'] >= ($_1897180346 + $this->profile['SETUP']['CRON'][$_1478952812]['STEP_EXPORT_CNT'])) || ((intval($this->profile['SETUP']['CRON'][$_1478952812]['MAXIMUM_PRODUCTS']) > 0) && ($_111748978['EXPORTPROPLUS']['LOG'][$this->profile['ID']]['PRODUCTS_EXPORT'] >= $this->profile['SETUP']['CRON'][$_1478952812]['MAXIMUM_PRODUCTS'])) || ($_1634919591 != 1)) {
                    break;
                }
            }
            if ($_1813127374 || $_1304313284 || $_559483616) {
                $_11678077 = array();
                $_1610311003 = array();
                $_1658004309 = array();
                $this->_86593573 = '';
                $_1799584481 = $this->__705054251($_485935950, false, false, $_1768420642, $_589631444);
                if (!$_1799584481) continue;
                if (CAcritExportproplusTools::isVariant($this->profile, $_982944057)) {
                    if ($this->profile['USE_IBLOCK_CATEGORY'] == 'Y') {
                        $_982944057 = $_1799584481['ITEM']['IBLOCK_ID'];
                    } elseif ($this->profile['USE_IBLOCK_PRODUCT_CATEGORY'] == 'Y') {
                        $_982944057 = $_1799584481['ITEM']['IBLOCK_PRODUCT_SECTION_ID'];
                    } else {
                        $_982944057 = $_1799584481['ITEM']['IBLOCK_SECTION_ID'];
                    }
                    if (isset($_1799584481['SKIP']) && !$_1799584481['SKIP']) {
                        $_11678077[$_1799584481['ITEM'][$_1525266428]][] = $_1799584481;
                    }
                    if (isset($_1799584481['ITEM'])) {
                        if (isset($_1799584481['ITEM']['GROUP_ITEM_ID']) && ($_1799584481['ITEM']['GROUP_ITEM_ID'] == $_1799584481['ITEM']['ID'])) {
                            $_1610311003[] = $_1799584481;
                        }
                        $_1799584481 = $_1799584481['ITEM'];
                    }
                }
            }
            if ($this->_1768427482 && ($this->profile['USE_SKU'] == 'Y') && ($_277873286 || $_559483616)) {
                if (!$_1813127374 && !$_1304313284 && !$_559483616) {
                    $_1799584481 = $_485935950->GetFields();
                }
                if (($_1799584481['ACTIVE'] == 'Y') && ($this->_2078735835[$_1799584481['IBLOCK_ID']])) {
                    if (isset($_589631444['DELAY']) && ($_589631444['DELAY'] == true)) $_589631444['DELAY_SKU'] = true;
                    $_1487562205 = array('IBLOCK_ID' => $this->_2078735835[$_1799584481['IBLOCK_ID']]['OFFERS_IBLOCK_ID'], 'PROPERTY_' . $this->_2078735835[$_1799584481['IBLOCK_ID']]['OFFERS_PROPERTY_ID'] => $_1799584481['ID']);
                    if (CAcritExportproplusTools::isVariant($this->profile, $_982944057)) {
                        $_1487562205 = array_merge($_1487562205, array('CATALOG_AVAILABLE' => 'Y'));
                    }
                    $_1843558287 = CIBlockElement::GetList(array(), $_1487562205, false, false, array());
                    $_988361769 = false;
                    while ($_522409400 = $_1843558287->GetNextElement()) {
                        $_111748978 = AcritExportproplusSession::GetSession($this->profile['ID']);
                        if ($_341676656) {
                            if (($_111748978['EXPORTPROPLUS']['LOG'][$this->profile['ID']]['PRODUCTS_EXPORT'] >= ($_1897180346 + $this->profile['SETUP']['CRON'][$_1478952812]['STEP_EXPORT_CNT'])) || ((intval($this->profile['SETUP']['CRON'][$_1478952812]['MAXIMUM_PRODUCTS']) > 0) && ($_111748978['EXPORTPROPLUS']['LOG'][$this->profile['ID']]['PRODUCTS_EXPORT'] >= $this->profile['SETUP']['CRON'][$_1478952812]['MAXIMUM_PRODUCTS'])) || ($_1634919591 != 1)) {
                                $_988361769 = true;
                                break;
                            }
                        }
                        $_374146712 = $this->__705054251($_522409400, $_1799584481, false, $_1768420642, $_589631444, $_1658004309);
                        if (CAcritExportproplusTools::isVariant($this->profile, $_982944057)) {
                            $_11678077[$_374146712['ITEM'][$_1525266428]][] = $_374146712;
                        }
                        unset($_374146712);
                        if ($this->isDemo && $this->DemoCount()) {
                            break;
                        }
                    }
                    if ($_988361769) {
                        break;
                    }
                }
            }
            if (CAcritExportproplusTools::isVariant($this->profile, $_982944057)) {
                self::ProcessVariantDataXML($_11678077, $_982944057);
            }
            if ($this->isDemo && $this->DemoCount()) {
                break;
            }
            unset($_1799584481);
            if (isset($_589631444['DELAY']) && $_589631444['DELAY'] == true) {
                $_589631444['DELAY_FLUSH'] = true;
                if (isset($_1639684675['MINIMUM_OFFER_PRICE']) && $_1639684675['MINIMUM_OFFER_PRICE'] == 'Y') {
                    $_589631444['MINIMUM_OFFER_PRICE'] = 'Y';
                }
                $this->__705054251($_485935950, false, false, $_1768420642, $_589631444, $_1658004309);
                unset($_589631444['DELAY_SKU']);
                unset($_589631444['DELAY_FLUSH']);
                if (isset($_589631444['MINIMUM_OFFER_PRICE'])) unset($_589631444['MINIMUM_OFFER_PRICE']);
            }
        }
        unset($_485935950, $_1799584481);
        if (!$_1022528073) {
            echo '<div style="width: 100%; text-align: center; font-size: 18px; margin: 40px 0; padding: 40px 0; border: 1px solid #ccc; border-radius: 6px; background: #f5f5f5;">', GetMessage('ACRIT_EXPORTPROPLUS_RUN_EXPORT_RUN'), '<br/>', str_replace(array('#PROFILE_ID#', '#PROFILE_NAME#'), array($this->profile['ID'], $this->profile['NAME']), GetMessage('ACRIT_EXPORTPROPLUS_RUN_STEP_PROFILE')), '<br/>', str_replace(array('#STEP#', '#COUNT#'), array($_1634919591, $_239173557), GetMessage('ACRIT_EXPORTPROPLUS_RUN_STEP_RUN')), '</div>';
        }
        CAcritExportproplusTools::SaveCurrencies($this->profile, $this->_1364486914);
        if ($this->isDemo && $this->DemoCount()) {
            return true;
        }
        if ($_1634919591 >= $_239173557) {
            return true;
        }
        return false;
    }

    public function ProcessVariantDataXML($_11678077, $_982944057)
    {
        if (is_array($_11678077) && !empty($_11678077)) {
            $dbEvents = GetModuleEvents("acrit.exportproplus", "OnBeforePropertiesSelect");
            $_1892215348 = array();
            while ($_257451012 = $dbEvents->Fetch()) {
                ExecuteModuleEventEx($_257451012, array(array('ID' => $this->profile['ID'], 'CODE' => $this->profile['CODE'], 'NAME' => $this->profile['NAME']), &$_1892215348));
            }
            CAcritExportproplusElement::OnBeforePropertiesSelect($_1892215348);
            $_315870870 = 0;
            foreach ($_11678077 as $_1489104411 => $_218875339) {
                $_1108326879 = $_218875339[0]['XML'];
                $_346607306 = array();
                $_902390314 = '';
                foreach ($_218875339 as $_1659850986) {
                    $_1799584481 = $_1659850986['ITEM'];
                    $_2013207294 = $_1659850986['OFFER'];
                    $_1196274309 = array();
                    foreach (array('SIZE', 'WEIGHT', 'COLOR', 'SIZEOFFER', 'WEIGHTOFFER', 'COLOROFFER') as $_867660440) {
                        if (isset($_1892215348[$_867660440])) {
                            foreach ($_1892215348[$_867660440] as $_330146368) {
                                if (!empty($_1799584481[$_330146368])) {
                                    $_1196274309[$_867660440][] = $_330146368;
                                }
                            }
                        }
                    }
                    $_476275791 = $this->profile['VARIANT']['SEX_CONST'] ? $this->profile['VARIANT']['SEX_CONST'] : $_1799584481[$this->_831285158['SEX']];
                    $_706297844 = explode('-', $this->profile['VARIANT']['CATEGORY'][$_982944057]);
                    $_522921858 = explode('-', $this->profile['VARIANT']['CATEGORY_EXT'][$_982944057]);
                    $_83577185 = $this->_831285158['SIZE'];
                    if (empty($_1799584481[$_83577185]) && count($_1196274309['SIZE'])) {
                        $_1617843728 = $_1196274309['SIZE'];
                        $_83577185 = current($_1617843728);
                    }
                    $_1264726840 = $this->_831285158['WEIGHT'];
                    if (empty($_1799584481[$_1264726840]) && count($_1196274309['WEIGHT'])) {
                        $_1617843728 = $_1196274309['WEIGHT'];
                        $_1264726840 = current($_1617843728);
                    }
                    $_1969139529 = $this->_831285158['COLOR'];
                    if (empty($_1799584481[$_1969139529]) && count($_1196274309['COLOR'])) {
                        $_1617843728 = $_1196274309['COLOR'];
                        $_1969139529 = current($_1617843728);
                    }
                    if ($_2013207294) {
                        $_476275791 = $this->profile['VARIANT']['SEX_CONST'] ? $this->profile['VARIANT']['SEX_CONST'] : $_1799584481[$this->_831285158['SEXOFFER']];
                        $_83577185 = $this->_831285158['SIZEOFFER'];
                        if (empty($_1799584481[$_83577185]) && count($_1196274309['SIZEOFFER'])) {
                            $_1617843728 = $_1196274309['SIZEOFFER'];
                            $_83577185 = current($_1617843728);
                        }
                        $_1264726840 = $this->_831285158['WEIGHTOFFER'];
                        if (empty($_1799584481[$_1264726840]) && count($_1196274309['WEIGHTOFFER'])) {
                            $_1617843728 = $_1196274309['WEIGHTOFFER'];
                            $_1264726840 = current($_1617843728);
                        }
                        $_1969139529 = $this->_831285158['COLOROFFER'];
                        if (empty($_1799584481[$_1969139529]) && count($_1196274309['COLOROFFER'])) {
                            $_1617843728 = $_1196274309['COLOROFFER'];
                            $_1969139529 = current($_1617843728);
                        }
                    }
                    $_680886076 = $_706297844[1] == 'OZ' ? $_1799584481[$_1969139529] . $_476275791 . $_1799584481[$_1264726840] : $_1799584481[$_1969139529] . $_1799584481[$_83577185] . $_476275791;
                    if ($_706297844[1] == 'OZ') {
                        if (!$_1799584481[$_1264726840] && !$_1799584481[$_83577185]) continue;
                    }
                    if (in_array($_680886076, $_346607306)) continue;
                    $_346607306[] = $_680886076;
                    $_77735784 = array();
                    if ($_1799584481[$_1969139529]) $_77735784[] = 'color';
                    if ($_706297844[1] == 'OZ') {
                        if ($_1799584481[$_83577185] || $_1799584481[$_1264726840]) $_77735784[] = 'size';
                    } else {
                        if ($_1799584481[$_83577185]) $_77735784[] = 'size';
                    }
                    if (!empty($_77735784)) {
                        $_1011312517 = implode('_and_', $_77735784);
                        $_1437642156 = "<variant type=\"$_1011312517\">" . PHP_EOL;
                        if (in_array('color', $_77735784)) $_1437642156 .= "<color>{$_1799584481[$_1969139529]}</color>" . PHP_EOL;
                        if (in_array('size', $_77735784)) {
                            if ($_706297844[1] == 'OZ') {
                                if (!$_1799584481[$_1264726840]) {
                                    $_1799584481[$_1264726840] = $_1799584481[$_83577185];
                                    $_706297844[1] = $_522921858[1];
                                } else {
                                    $_1799584481[$_1264726840] = floatval($_1799584481[$_1264726840]);
                                }
                                $_1437642156 .= "<size category=\"{$_706297844[0]}\" gender=\"{$_476275791}\" system=\"{$_706297844[1]}\">" . $_1799584481[$_1264726840] . '</size>' . PHP_EOL;
                            } else {
                                $_1437642156 .= "<size category=\"{$_706297844[0]}\" gender=\"{$_476275791}\" system=\"{$_706297844[1]}\">" . $_1799584481[$_83577185] . '</size>' . PHP_EOL;
                            }
                        }
                        $_1437642156 .= "<offerId>{$_1799584481['ID']}</offerId>";
                        $_1437642156 .= '</variant>' . PHP_EOL;
                        $_902390314 .= $_1437642156;
                        $_315870870++;
                    }
                }
                if (strlen($_902390314) > 0) {
                    $_1108326879 = str_replace('</offer>', "<variantList>$_902390314</variantList></offer>", $_1108326879);
                }
                CAcritExportproplusExport::Save($_1108326879);
                $this->_940439577->IncProductExport();
            }
            if (($_315870870 == 0) && count($_1610311003)) {
                foreach ($_1610311003 as $_1552592902) {
                    CAcritExportproplusExport::Save($_1552592902['XML']);
                    $this->_940439577->IncProductExport();
                }
            }
            unset($_11678077);
            unset($_1610311003);
        }
    }

    public static function OnBeforePropertiesSelect(&$_370869345)
    {
        foreach ($_370869345 as $_316796129 => &$_47247544) {
            if (is_array($_47247544)) {
                foreach ($_47247544 as &$_504799882) {
                    $_470119335 = explode("-", $_504799882);
                    $_1731654546 = count($_470119335);
                    if ($_1731654546 == 3) {
                        $_504799882 = 'PROPERTY_' . $_470119335[2] . '_DISPLAY_VALUE';
                    }
                }
            } else {
                $_470119335 = explode('-', $_47247544);
                $_1731654546 = count($_470119335);
                if ($_1731654546 == 3) {
                    $_47247544 = 'PROPERTY_' . $_470119335[2] . '_DISPLAY_VALUE';
                }
            }
        }
    }

    public function SetProcessEnd($_2060967116)
    {
        global $ProcessEnd;
        $ProcessEnd = true;
    }

    public function SetCronPage($_471483907)
    {
        $this->_471483907 = $_471483907;
    }
}

class CAcritExportproplusComponent
{
    private static $__components = array(
        "catalog" => "CAcritExportproplusRemarketingCatalog",
        "catalog.element" => "CAcritExportproplusRemarketingCatalogElement",
        );

    private static $__component_name = array(
        "catalog",
        "catalog.element"
    );

    private $__componentId = false;
    private $__path = false;
    private $__data = false;
    private $__siteDocRoot = false;
    private $__Class = false;

    function __construct()
    {
        $this->__siteDocRoot = \CSite::GetSiteDocRoot(SITE_ID);
    }

    public function execute()
    {
        if ($this->__path !== false) {
            global $APPLICATION;
            $__components = \PHPParser::ParseScript($APPLICATION->GetFileContent($this->__siteDocRoot . $this->__path));
            foreach ($__components as $component) {
                list($__componentNamecpace, $__componentName) = explode(':', trim($component['DATA']['COMPONENT_NAME']));
                if (!in_array($__componentName, static::$__component_name)) continue;
                $this->__componentId = trim($component['DATA']['COMPONENT_NAME']);
                if (!empty($this->__data['DATA']['PARAMS'])) $component['DATA']['PARAMS'] = array_merge_recursive($component['DATA']['PARAMS'], $this->__data['DATA']['PARAMS']);
                $Ob = $this->__initComponent($component);
                if (!$Ob) continue;
                $__component_result = call_user_func(array($this->__Class, 'execute'), $Ob);
                if (!$__component_result) continue;
                if (0 < $__component_result['params']['ELEMENT_ID']) return $__component_result;
            }
        }
        return false;
    }

    private function __initComponent($component)
    {
        list($__componentNamecpace, $__componentName) = explode(":", trim($this->__componentId));
        $class_name = static::$__components[$__componentName];
        if (!class_exists($class_name)) {
            return false;
        }
        $this->__Class = static::$__components[$__componentName];
        $obComponent = new \CBitrixComponent();
        $obComponent->initComponent($this->__componentId, $component['DATA']['TEMPLATE_NAME']);
        $obComponent->arParams = $component['DATA']['PARAMS'];
        return $obComponent;
    }

    public function setPath($path)
    {
        $this->__path = $path;
        return $this;
    }

    public function setData($data)
    {
        $this->__data = array("DATA" => array("TEMPLATE_NAME" => $data["templateName"], "PARAMS" => $data["params"]));
        return $this;
    }
}

class CAcritExportproplusGoogleTagManager
{
    function OnEndBufferContent(&$bufferContent)
    {
        if (\Bitrix\Main\Config\Option::get('acrit.exportproplus', 'disable_old_core') == 'Y') {
            return;
        }
        if (defined('ADMIN_SECTION') && (ADMIN_SECTION == true)) return;
        $DB = new CExportproplusProfileDB();
        $dbRes = $DB->GetList(array(), array('ACTIVE' => 'Y', 'USE_GOOGLETAGMANAGER' => 'Y'));
        while ($arRes = $dbRes->Fetch()) {
            $arProfile = $DB->GetByID($arRes['ID']);
            if (strlen(trim($arProfile['GOOGLETAGMANAGER_ID'])) <= 0) {
                continue;
            }
            $_1812817065 = self::__534066358($arProfile['LID']);
            if (!in_array($_SERVER['HTTP_HOST'], $_1812817065)) {
                continue;
            }
            $_1371146731 = self::__1491621891($arProfile['GOOGLETAGMANAGER_ID']);
            foreach ($_1371146731 as $_1821569122 => $_2068321914) {
                if (!self::__1571929657($_1821569122, $bufferContent)) {
                    $bufferContent = preg_replace('/(<' . $_1821569122 . '.*?>)/i', '$1' . PHP_EOL . $_2068321914, $bufferContent);
                }
            }
        }
    }

    private function __534066358($_1431630109)
    {
        $_572535359 = false;
        $_1403858051 = CSite::GetList($_72963416 = 'sort', $_142153669 = 'asc', array('ID' => $_1431630109,));
        while ($_1681050021 = $_1403858051->Fetch()) {
            $_572535359 = explode(PHP_EOL, $_1681050021['DOMAINS']);
        }
        return $_572535359;
    }

    private static function __1491621891($_92663320)
    {
        $_896295549 = array("head" => "<!-- Google Tag Manager -->
                <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
                new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
                j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
                'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
                })(window,document,'script','dataLayer','$_92663320');</script>
                <!-- End Google Tag Manager -->", "body" => '<!-- Google Tag Manager (noscript) -->
                <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=' . $_92663320 . '"
                height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
                <!-- End Google Tag Manager (noscript) -->');
        return $_896295549;
    }

    private function __1571929657($_650308927, $_1634697318)
    {
        $result = false;
        if ($_650308927 == 'head') {
            if (stripos($_1634697318, 'www.googletagmanager.com/gtm.js') !== false) {
                $result = true;
            }
        } elseif ($_650308927 == 'body') {
            if (stripos($_1634697318, 'www.googletagmanager.com/ns.html') !== false) {
                $result = true;
            }
        }
        return $result;
    }
}

class CAcritExportproplusRemarketing
{
    private static function _getJCodeType($arTypes)
    {
        $return = array();
        foreach ($arTypes as $type) {
            $remarketing_type = self::getRemarketingType($type);
            if (!$remarketing_type) continue;
            $return[] = $remarketing_type;
        }
        return array_filter($return);
    }

    function OnEndBufferContent(&$bufferContent)
    {
        if (\Bitrix\Main\Config\Option::get('acrit.exportproplus', 'disable_old_core') == 'Y') {
            return;
        }
        if (defined('ADMIN_SECTION') && (ADMIN_SECTION == true)) return;
        $_316590310 = explode('.', phpversion());
        $_1064978996 = floatval(implode('.', array($_316590310[0], $_316590310[1])));
        if ($_1064978996 < 5.4) return;
        $_1757943191 = array();
        $DB = new CExportproplusProfileDB();
        $dbRes = $DB->GetList(array(), array('ACTIVE' => 'Y', 'USE_REMARKETING' => 'Y'));
        while ($_356755374 = $dbRes->Fetch()) {
            if ($arProfile = $DB->GetByID($_356755374['ID'])) {
                $_1757943191[$arProfile['ID']] = $arProfile;
            }
        }
        if (!count($_1757943191)) return;
        $result = self::execute();
        if (!$result) return;
        if ((!isset($result['variables']['SECTION_ID']) || ($result['variables']['SECTION_ID'] <= 0))) {
            $_590491089 = CIBlockElement::GetByID($result['variables']['ELEMENT_ID']);
            if ($_485935950 = $_590491089->Fetch()) {
                $result['variables']['SECTION_ID'] = $_485935950['IBLOCK_SECTION_ID'];
                $result['params']['SECTION_ID'] = $_485935950['IBLOCK_SECTION_ID'];
            }
        }
        $arProfileCategory = array();
        foreach ($_1757943191 as $profile) {
            self::__1899268852($arProfileCategory, $profile, $result);
        }
        if (!count($arProfileCategory)) return;
        $_133396353 = self::getRemarketingTemplate($arProfileCategory, $result);
        if (strlen($_133396353) <= 0) return;
        $_363437152 = self::__836591764();
        $_697464525 = $_363437152['html_tag']['name'];
        if ($_363437152['html_tag']['position'] == 'before') {
            $bufferContent = str_replace('<' . $_697464525, $_133396353 . PHP_EOL . '<' . $_697464525, $bufferContent);
        } elseif ($_363437152['html_tag']['position'] == 'after') {
            $bufferContent = str_replace($_697464525 . '>', $_697464525 . '>' . PHP_EOL . $_133396353, $bufferContent);
        }
    }

    private static function execute()
    {
        $_1443220763 = CAcritExportproplusUrlRewrite::getInstance();
        $component = new CAcritExportproplusComponent();
        foreach ($_1443220763->getUrlRewrite() as $_11656276 => $_265020592) {
            if (($_13658018 = $_1443220763->getRuleByComponentId($_11656276)) !== false) {
                $component->setPath($_13658018['PATH']);
                $result = $component->execute();
                if ($result !== false) return $result;
            }
        }
        return false;
    }

    private static function __1899268852(&$arProfileCategory, $profile, $result)
    {
        $remarketing_type = self::getRemarketingType($profile["TYPE"]);
        if (!$remarketing_type) return false;
        $_1341799704 = array();
        if ($profile['CHECK_INCLUDE'] != 'Y') $_2099964750 = CAcritExportproplusTools::GetSectionNavChain($result['variables']['SECTION_ID']);
        foreach ($profile['CATEGORY'] as $_1754329594) {
            if ($profile['CHECK_INCLUDE'] != 'Y') {
                if (in_array($_1754329594, $_2099964750)) {
                    if (in_array($remarketing_type, $arProfileCategory)) continue;
                    $arProfileCategory[] = $remarketing_type;
                }
            } elseif ($profile['CHECK_INCLUDE'] == 'Y') {
                if ($_1754329594 == $result['variables']['SECTION_ID']) {
                    if (in_array($remarketing_type, $arProfileCategory)) continue;
                    $arProfileCategory[] = $remarketing_type;
                }
            }
        }
    }

    private static function getRemarketingType($type = null, $profile = null)
    {
        switch ($type) {
            case "google":
            case 'google_online':
                return 'google';
                break;
            case 'mailru':
            case 'mailru_clothing':
                return 'mail';
                break;
        }
        return false;
    }

    private static function getRemarketingTemplate($arProfileCategory, $result)
    {
        $return = "";
        $arTemplate = array(
            'google' => '<script type="text/javascript">
                var google_tag_params = {
                  ecomm_pagetype:\'product\',
                  ecomm_prodid:#ID#,
                };
            </script>',
            'mail' => '<script type="text/javascript">
            var _tmr = _tmr || [];
            _tmr.push({
                type: \'itemView\',
                productid:#ID#,
                pagetype:\'product\',
            });
            </script>'
        );

        $dbEvents = GetModuleEvents('acrit.exportproplus', 'OnGetRemarketingTemplate');
        while ($_257451012 = $dbEvents->Fetch()) {
            ExecuteModuleEventEx($_257451012, array(&$arTemplate));
        }
        foreach ($arProfileCategory as $type) {
            if (array_key_exists($type, $arTemplate)) $return .= str_replace(array('#ID#'), array($result['params']['ELEMENT_ID']), $arTemplate[$type]) . PHP_EOL;
        }
        return $return;
    }

    private static function __836591764()
    {
        $_363437152 = array("html_tag" => array("name" => "body", "position" => "after"));
        $dbEvents = GetModuleEvents('acrit.exportproplus', 'OnGetRemarketingSettings');
        while ($_257451012 = $dbEvents->Fetch()) {
            ExecuteModuleEventEx($_257451012, array(&$_363437152));
        }
        return $_363437152;
    }
}

class CAcritExportproplusRemarketingCatalog
{
    public static function execute(\CBitrixComponent $component)
    {
        static::__onPrepareComponentParams($component->arParams);
        $result = static::__component($component);
        return $result;
    }

    protected static function __onPrepareComponentParams(&$_1104710553)
    {
    }

    protected static function __component(&$component)
    {
        if ($component->arParams["SEF_MODE"] == "Y") $result = static::__1333554073($component); else $result = static::__823062964($component);
        if ($result !== false) {
            if ($result['componentPage'] == 'element') {
                if ((!isset($result['variables']['ELEMENT_ID']) || ($result['variables']['ELEMENT_ID'] <= 0)) && strlen($result['variables']['ELEMENT_CODE'])) {
                    $_262824078 = array('IBLOCK_ID' => $component->arParams['IBLOCK_ID'], 'IBLOCK_LID' => SITE_ID, 'IBLOCK_ACTIVE' => 'Y', 'ACTIVE_DATE' => 'Y', 'CHECK_PERMISSIONS' => 'Y', 'MIN_PERMISSION' => 'R',);
                    if ($component->arParams['SHOW_DEACTIVATED'] !== 'Y') $_262824078['ACTIVE'] = 'Y';
                    $result['variables']['ELEMENT_ID'] = \CIBlockFindTools::GetElementID((isset($result['variables']['ELEMENT_ID']) && strlen($result['variables']['ELEMENT_ID'])) ? $result['variables']['ELEMENT_ID'] : false, $result['variables']['ELEMENT_CODE'], (isset($result['variables']['SECTION_ID']) && strlen($result['variables']['SECTION_ID'])) ? $result['variables']['SECTION_ID'] : false, (isset($result['variables']['SECTION_CODE']) && strlen($result['variables']['SECTION_CODE'])) ? $result['variables']['SECTION_CODE'] : false, $_262824078);
                }
                if (!isset($result['variables']['ELEMENT_ID']) || ($result['variables']['ELEMENT_ID'] <= 0)) return false;
                foreach ($result['variables'] as $_370621247 => $_32014025) $result['params'][$_370621247] = $_32014025;
            } else $result = false;
        }
        return $result;
    }

    private static function __1333554073(&$component)
    {
        $_1389167078 = array();
        $_1135287693 = ($component->arParams['SEF_URL_TEMPLATES']['section'] ? $component->arParams['SEF_URL_TEMPLATES']['section'] : '#SECTION_ID#/');
        $_3627447 = array('sections' => '', 'section' => '#SECTION_ID#/', 'element' => '#SECTION_ID#/#ELEMENT_ID#/', 'compare' => 'compare.php?action=COMPARE', 'smart_filter' => $_1135287693 . 'filter/#SMART_FILTER_PATH#/apply/');
        $_112797755 = array('SECTION_ID', 'SECTION_CODE', 'ELEMENT_ID', 'ELEMENT_CODE', 'action',);
        $_1702320177 = new \CComponentEngine($component);
        if (\Bitrix\Main\Loader::includeModule('iblock')) {
            $_1702320177->addGreedyPart('#SECTION_CODE_PATH#');
            $_1702320177->addGreedyPart('#SMART_FILTER_PATH#');
            $_1702320177->setResolveCallback(array('\CIBlockFindTools', 'resolveComponentEngine'));
        }
        $_1296299244 = \CComponentEngine::MakeComponentUrlTemplates($_3627447, $component->arParams['SEF_URL_TEMPLATES']);
        $_1822618101 = \CComponentEngine::MakeComponentVariableAliases($_536616350, $component->arParams['VARIABLE_ALIASES']);
        $_1919784252 = Bitrix\Main\Context::getCurrent()->getRequest()->getRequestedPage();
        $_741011927 = substr($_1919784252, strlen($component->arParams['SEF_FOLDER']));
        $_387837820 = array();
        foreach ($_1296299244 as $_578032248 => $_1535056984) {
            if (self::remarketingCheckPath4Template($_1535056984, $_741011927, $_387837820)) {
                if (strpos($_1535056984, '#') !== false) {
                    $_2110796054[$_578032248] = $_387837820;
                }
            }
        }
        if (array_key_exists('element', (is_array($_2110796054) ? $_2110796054 : array()))) {
            $_541863542 = $_1702320177->guessComponentPath($component->arParams['SEF_FOLDER'], $_1296299244, $_1389167078);
            \CComponentEngine::InitComponentVariables($_541863542, $_112797755, $_1822618101, $_1389167078);
            return array('componentPage' => $_541863542, 'variables' => $_1389167078, 'params' => $component->arParams);
        }
    }

    public static function remarketingCheckPath4Template($_1535056984, $_741011927, &$_1389167078)
    {
        $_182244816 = preg_replace("'#[^#]+?#'", "([^/]+?)", $_1535056984);
        if (substr($_182244816, -1, 1) == '/') $_182244816 .= 'index\.php';
        $_340007539 = array();
        if (preg_match("'^" . $_182244816 . "$'", $_741011927, $_340007539)) {
            $_547888680 = array();
            if (preg_match_all("'#([^#]+?)#'", $_1535056984, $_547888680)) {
                for ($_2048712986 = 0, $_80957430 = count($_547888680[1]); $_2048712986 < $_80957430; $_2048712986++) $_1389167078[$_547888680[1][$_2048712986]] = $_340007539[$_2048712986 + 1];
            }
            return true;
        }
        return false;
    }

    private static function __823062964(&$component)
    {
        $_1389167078 = array();
        $_531356295 = array();
        $_112797755 = array('SECTION_ID', 'SECTION_CODE', 'ELEMENT_ID', 'ELEMENT_CODE', 'action',);
        $_1822618101 = CComponentEngine::MakeComponentVariableAliases($_531356295, $component->arParams['VARIABLE_ALIASES']);
        CComponentEngine::InitComponentVariables(false, $_112797755, $_1822618101, $_1389167078);
        $_541863542 = '';
        $_64651618 = array('COMPARE', 'DELETE_FEATURE', 'ADD_FEATURE', 'DELETE_FROM_COMPARE_RESULT', 'ADD_TO_COMPARE_RESULT', 'COMPARE_BUY', 'COMPARE_ADD2BASKET',);
        if (isset($_1389167078['action']) && in_array($_1389167078['action'], $_64651618)) $_541863542 = 'compare'; elseif (isset($_1389167078['ELEMENT_ID']) && intval($_1389167078['ELEMENT_ID']) > 0) $_541863542 = 'element';
        elseif (isset($_1389167078['ELEMENT_CODE']) && strlen($_1389167078['ELEMENT_CODE']) > 0) $_541863542 = 'element';
        elseif (isset($_1389167078['SECTION_ID']) && intval($_1389167078['SECTION_ID']) > 0) $_541863542 = 'section';
        elseif (isset($_1389167078['SECTION_CODE']) && strlen($_1389167078['SECTION_CODE']) > 0) $_541863542 = 'section';
        elseif (isset($_REQUEST['q'])) $_541863542 = 'search';
        else $_541863542 = 'sections';
        return array('componentPage' => $_541863542, 'variables' => $_1389167078, 'params' => $component->arParams);
    }
}

class CAcritExportproplusRemarketingCatalogElement
{
    public static function execute(\CBitrixComponent $component)
    {
        static::__onPrepareComponentParams($component->arParams);
        $result = static::__component($component);
        return $result;
    }

    protected static function __onPrepareComponentParams(&$_1104710553)
    {
    }

    protected static function __component(&$component)
    {
        if ($component->arParams["SEF_MODE"] == "Y") $result = static::__1333554073($component); else $result = static::__823062964($component);
        if ($result !== false) {
            if ($result['componentPage'] == 'element') {
                if ((!isset($result['variables']['ELEMENT_ID']) || ($result['variables']['ELEMENT_ID'] <= 0)) && (strlen($result['variables']['ELEMENT_CODE']) > 0)) {
                    $_262824078 = array('IBLOCK_ID' => $component->arParams['IBLOCK_ID'], 'IBLOCK_LID' => SITE_ID, 'IBLOCK_ACTIVE' => 'Y', 'ACTIVE_DATE' => 'Y', 'CHECK_PERMISSIONS' => 'Y', 'MIN_PERMISSION' => 'R',);
                    if ($component->arParams['SHOW_DEACTIVATED'] !== 'Y') $_262824078['ACTIVE'] = 'Y';
                    $result['variables']['ELEMENT_ID'] = \CIBlockFindTools::GetElementID((isset($result['variables']['ELEMENT_ID']) && strlen($result['variables']['ELEMENT_ID'])) ? $result['variables']['ELEMENT_ID'] : false, $result['variables']['ELEMENT_CODE'], (isset($result['variables']['SECTION_ID']) && strlen($result['variables']['SECTION_ID'])) ? $result['variables']['SECTION_ID'] : false, (isset($result['variables']['SECTION_CODE']) && strlen($result['variables']['SECTION_CODE'])) ? $result['variables']['SECTION_CODE'] : false, $_262824078);
                }
                if (!isset($result['variables']['ELEMENT_ID']) || ($result['variables']['ELEMENT_ID'] <= 0)) return false;
                foreach ($result['variables'] as $_370621247 => $_32014025) $result['params'][$_370621247] = $_32014025;
            } else $result = false;
        }
        return $result;
    }

    private static function __1333554073(&$component)
    {
        return false;
    }

    private static function __823062964(&$component)
    {
        $_1389167078 = array();
        $_112797755 = array('SECTION_ID', 'SECTION_CODE', 'ELEMENT_ID', 'ELEMENT_CODE', 'action',);
        $_1822618101 = array();
        CComponentEngine::InitComponentVariables(false, $_112797755, $_1822618101, $_1389167078);
        $_541863542 = '';
        $_64651618 = array('ADD_TO_COMPARE_LIST',);
        if (isset($_1389167078['action']) && in_array($_1389167078['action'], $_64651618)) $_541863542 = 'compare'; elseif (isset($_1389167078['ELEMENT_ID']) && (intval($_1389167078['ELEMENT_ID']) > 0)) $_541863542 = 'element';
        elseif (isset($_1389167078['ELEMENT_CODE']) && (strlen($_1389167078['ELEMENT_CODE']) > 0)) $_541863542 = 'element';
        else $_541863542 = false;
        if (!$_541863542) return false;
        return array('componentPage' => $_541863542, 'variables' => $_1389167078, 'params' => $component->arParams);
    }
}

class CAcritExportproplusExternApiTools
{
    const CURL_ENCTYPE_APPLICATION = "application/x-www-form-urlencoded";

    public function GetCurlFilename($_1458548068)
    {
        if (version_compare(PHP_VERSION, "5.6.0", "<")) {
            return "@" . $_1458548068;
        } else {
            return new \CURLFile($_1458548068);
        }
    }

    public function _CurlPost($_1468923083, $_379606503, $_1260020389 = "", $_226402675 = false, $_1207089515 = 120)
    {
        $_1104710553 = array();
        if (is_array($_1260020389)) {
            $_1104710553['cookie_type'] = $_1260020389[0] ?: $_1260020389['type'];
            $_1104710553['cookie_postfix'] = $_1260020389[1] ?: $_1260020389['postfix'];
            $_1104710553['cookies'] = $_1260020389['cookies'];
        } elseif (!empty($_1260020389)) {
            $_1104710553['cookie_type'] = 1;
            $_1104710553['cookie_postfix'] = $_1260020389;
        }
        $_1104710553['user_agent'] = $_226402675;
        $_1104710553['timeout'] = $_1207089515;
        return self::CurlPost($_1468923083, $_379606503, $_1104710553);
    }

    public function CurlPost($_1468923083, $_379606503, $_1104710553 = array())
    {
        if ($_1468923083 == "") return false;
        $_85935831 = (strpos($_1468923083, 'https') === 0);
        if (is_array($_1260020389)) {
            $_590551441 = $_1260020389[0];
            $_1260020389 = $_1260020389[1];
        } else $_590551441 = (empty($_1260020389) ? 0 : 1);
        $_1685438963 = '/upload/tmp/acrit.exportproplus/';
        if ($_1104710553['cookie_type'] and (is_dir($_1685438963) or mkdir($_1685438963, 484, true))) {
            if (empty($_1104710553['cookie_postfix'])) {
                $_1685438963 .= 'cookie.txt';
            } else {
                $_1685438963 .= 'cookie_' . $_1104710553['cookie_postfix'] . '.txt';
            }
        } else {
            $_1685438963 .= 'cookie.txt';
        }
        $_747955019 = curl_init($_1468923083);
        if ($_1104710553['CUSTOM_REQUEST']) {
            curl_setopt($_747955019, CURLOPT_CUSTOMREQUEST, $_1104710553['CUSTOM_REQUEST']);
        }
        curl_setopt($_747955019, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($_747955019, CURLOPT_FOLLOWLOCATION, true);
        if (!!$_1104710553['user_agent']) {
            curl_setopt($_747955019, CURLOPT_USERAGENT, $_1104710553['user_agent']);
        }
        if ($_1104710553['cookie_type'] == 1) {
            curl_setopt($_747955019, CURLOPT_COOKIEFILE, $_1685438963);
            curl_setopt($_747955019, CURLOPT_COOKIEJAR, $_1685438963);
        } elseif ($_1104710553['cookie_type'] == 2) {
            curl_setopt($_747955019, CURLOPT_COOKIEJAR, $_1685438963);
        } elseif ($_1104710553['cookie_type'] == 3) {
            curl_setopt($_747955019, CURLOPT_COOKIEFILE, $_1685438963);
        }
        if ($_85935831) {
            curl_setopt($_747955019, CURLOPT_SSL_VERIFYPEER, 0);
            curl_setopt($_747955019, CURLOPT_SSL_VERIFYHOST, 0);
        }
        if (!empty($_379606503)) {
            if (!$_1104710553['CUSTOM_REQUEST'] or ($_1104710553['CUSTOM_REQUEST'] == 'POST')) {
                curl_setopt($_747955019, CURLOPT_POST, true);
            }
            if (isset($_1104710553['enctype']) && ($_1104710553['enctype'] == self::CURL_ENCTYPE_APPLICATION)) {
                $_379606503 = http_build_query($_379606503);
                curl_setopt($_747955019, CURLOPT_HTTPHEADER, array('Content-Length: ' . strlen($_379606503)));
            }
            curl_setopt($_747955019, CURLOPT_POSTFIELDS, $_379606503);
        }
        curl_setopt($_747955019, CURLOPT_TIMEOUT, $_1104710553['timeout']);
        $_545370521 = curl_exec($_747955019);
        curl_close($_747955019);
        usleep500000;
        return $_545370521;
    }

    public function PreparePostText($_453140719, $_1927747747 = false, $_931521279 = false)
    {
        global $APPLICATION;
        $_431286954 = false;
        if (strlen($_453140719) > 0) {
            $_1927747747 = ($_1927747747) ? $_1927747747 : 'UTF-8';
            $_431286954 = strip_tags($_453140719);
            if ($_931521279) {
                $_431286954 = $APPLICATION->ConvertCharset($_431286954, $_1927747747, SITE_CHARSET);
            } else {
                $_431286954 = $APPLICATION->ConvertCharset($_431286954, SITE_CHARSET, $_1927747747);
            }
            $_431286954 = html_entity_decode($_431286954);
        }
        return $_431286954;
    }

    public function GetAccessUrl()
    {
        $_1436700053 = false;
        $_1436700053 = 'https://oauth.vk.com/authorize?client_id=' . GetMessage('ACRIT_VK_APPLICATION_ID') . '&scope=friends,wall,groups,offline,photos,video,market&redirect_uri=https://oauth.vk.com/blank.html&response_type=token&v=5.53&display=page';
        return $_1436700053;
    }
}

class CAcritExportproplusVkModel
{
    public $profile = null;
    public $_1745915131 = null;

    public function __construct($profile)
    {
        global $APPLICATION;
        $this->_1717979731 = @CModule::IncludeModule('iblock');
        $this->profile = $profile;
        $this->_1745915131 = self::GetAccessAccountData();
    }

    public function GetAccessAccountData()
    {
        $_1653488833 = array("ACCESS_TOKEN" => $this->profile["VK"]["VK_ACCESS_TOKEN"], "GROUP_PUBLISH" => $this->profile["VK"]["VK_GROUP_PUBLISH"], "USER_PUBLISH" => $this->profile["VK"]["VK_USER_PUBLISH"], "API_VERSION" => ($this->profile["SITE_PROTOCOL"] != "https") ? GetMessage("ACRIT_VK_API_HTTP_VERSION") : GetMessage('ACRIT_VK_API_HTTPS_VERSION'),);
        return $_1653488833;
    }

    public function GetAccountInfoData($arParams = false)
    {
        $_1436700053 = "https://api.vk.com/method/account.getInfo";
        $_379606503 = array();
        $_379606503['access_token'] = $this->_1745915131['ACCESS_TOKEN'];
        $_379606503['v'] = $this->_1745915131['API_VERSION'];
        if (is_array($arParams) && !empty($arParams)) {
            foreach ($arParams as $_1025055810 => $_458660427) {
                $_379606503[$_1025055810] = $_458660427;
            }
        }
        $_2091273732 = json_decode(CAcritExportproplusExternApiTools::_CurlPost($_1436700053, $_379606503, false), 1);
        return $_2091273732;
    }

    public function GetMarketCategories()
    {
        global $APPLICATION;
        $_1255633473 = 'https://api.vk.com/method/market.getCategories';
        $_379606503 = array();
        $_379606503['access_token'] = $this->_1745915131['ACCESS_TOKEN'];
        $_379606503['v'] = $this->_1745915131['API_VERSION'];
        $_379606503['count'] = 100;
        $_1710988751 = $APPLICATION->ConvertCharsetArray(json_decode(CAcritExportproplusExternApiTools::_CurlPost($_1255633473, $_379606503, false), 1), 'UTF-8', SITE_CHARSET);
        return $_1710988751;
    }

    public function GetMarketItems($arParams = false)
    {
        global $APPLICATION;
        $_1436700053 = 'https://api.vk.com/method/market.get';
        $_379606503 = array();
        $_379606503['access_token'] = $this->_1745915131['ACCESS_TOKEN'];
        $_379606503['v'] = $this->_1745915131['API_VERSION'];
        $_379606503['owner_id'] = ((intval($this->_1745915131['GROUP_PUBLISH']) > 0) ? '-' : '') . $this->_1745915131['GROUP_PUBLISH'];
        if (is_array($arParams) && !empty($arParams) && (intval($arParams['ALBUM_ID']) > 0)) {
            $_379606503['album_id'] = $arParams['ALBUM_ID'];
        }
        $_1189272564 = $APPLICATION->ConvertCharsetArray(json_decode(CAcritExportproplusExternApiTools::_CurlPost($_1436700053, $_379606503, false), 1), 'UTF-8', SITE_CHARSET);
        return $_1189272564;
    }

    public function GetMarketItemsById($_247886239, $_1547297743 = false)
    {
        $_1238479422 = false;
        if (CAcritExportproplusTools::ArrayValidate($_247886239)) {
            foreach ($_247886239 as $_1137459299 => $_899073386) {
                $_247886239[$_1137459299] = '-' . $this->_1745915131['GROUP_PUBLISH'] . '_' . $_899073386;
            }
            $_366315767 = implode(', ', $_247886239);
            $_1255633473 = 'https://api.vk.com/method/market.getById';
            $_379606503 = array();
            $_379606503['access_token'] = $this->_1745915131['ACCESS_TOKEN'];
            $_379606503['v'] = $this->_1745915131['API_VERSION'];
            $_379606503['item_ids'] = $_366315767;
            if ($_1547297743) {
                $_379606503['extended'] = 1;
            }
            $_1238479422 = json_decode(CAcritExportproplusExternApiTools::_CurlPost($_1255633473, $_379606503, false), 1);
        }
        return $_1238479422;
    }

    public function AddMarketItem($_887539035, $_477813228 = false)
    {
        $_1018740405 = false;
        if (is_array($_887539035) && !empty($_887539035)) {
            $_1047245195 = self::SaveMarketPhoto($_887539035['PHOTO'], true);
            if (is_array($_887539035['ADDITIONAL_PHOTOS']) && !empty($_887539035['ADDITIONAL_PHOTOS'])) {
                $_304648732 = self::SaveMarketPhoto($_887539035['ADDITIONAL_PHOTOS'], false);
                if (is_array($_304648732) && !empty($_304648732)) {
                    $_1568202458 = '';
                    foreach ($_304648732['response'] as $_1993508643) {
                        if ($_1568202458 == '') {
                            $_1568202458 .= $_1993508643['id'];
                        } else {
                            $_1568202458 .= ', ' . $_1993508643['id'];
                        }
                    }
                }
            }
            if ($_477813228) {
                $_738250183 = 'https://api.vk.com/method/market.edit';
            } else {
                $_738250183 = 'https://api.vk.com/method/market.add';
            }
            $_379606503 = array();
            $_379606503['access_token'] = $this->_1745915131['ACCESS_TOKEN'];
            $_379606503['v'] = $this->_1745915131['API_VERSION'];
            $_379606503['owner_id'] = ((intval($this->_1745915131['GROUP_PUBLISH']) > 0) ? '-' : '') . $this->_1745915131['GROUP_PUBLISH'];
            if ($_477813228) {
                $_379606503['item_id'] = $_887539035['ID'];
            }
            $_379606503['name'] = CAcritExportproplusExternApiTools::PreparePostText($_887539035['NAME']);
            $_379606503['description'] = CAcritExportproplusExternApiTools::PreparePostText($_887539035['URL_LABEL']) . '  ' . $this->profile['SITE_PROTOCOL'] . '://' . $this->profile['DOMAIN_NAME'] . $_887539035['URL'] . '

' . CAcritExportproplusExternApiTools::PreparePostText($_887539035['DESCRIPTION']);
            $_379606503['category_id'] = $_887539035['MARKET_CATEGORY'];
            $_379606503['price'] = $_887539035['PRICE'];
            $_379606503['deleted'] = $_887539035['IS_DELETED'];
            $_379606503['main_photo_id'] = $_1047245195['response'][0]['id'];
            if (isset($_1568202458) && ($_1568202458 != '')) {
                $_379606503['photo_ids'] = $_1568202458;
            }
            $_1018740405 = json_decode(CAcritExportproplusExternApiTools::_CurlPost($_738250183, $_379606503, false), 1);
        }
        return $_1018740405;
    }

    public function SaveMarketPhoto($_1397337972, $_508350000 = false)
    {
        $_1890170425 = false;
        if (is_array($_1397337972) && !empty($_1397337972)) {
            $_1502272078 = self::PreparePhotoToSaveOnServer($_1397337972, $_508350000);
            $_739831432 = 'https://api.vk.com/method/photos.saveMarketPhoto';
            $_379606503 = array();
            $_379606503['access_token'] = $this->_1745915131['ACCESS_TOKEN'];
            $_379606503['v'] = $this->_1745915131['API_VERSION'];
            $_379606503['group_id'] = $this->_1745915131['GROUP_PUBLISH'];
            $_379606503['server'] = $_1502272078['server'];
            $_379606503['photo'] = $_1502272078['photo'];
            $_379606503['hash'] = $_1502272078['hash'];
            if ($_508350000) {
                $_379606503['crop_data'] = $_1502272078['crop_data'];
                $_379606503['crop_hash'] = $_1502272078['crop_hash'];
            }
            $_1890170425 = json_decode(CAcritExportproplusExternApiTools::_CurlPost($_739831432, $_379606503, false), 1);
        }
        return $_1890170425;
    }

    public function PreparePhotoToSaveOnServer($_1397337972, $_508350000 = false, $_1687661643 = false, $_1065568205 = false, $_50240405 = false)
    {
        $_949254077 = false;
        if (is_array($_1397337972) && !empty($_1397337972)) {
            if ($_1065568205) {
                $_603413575 = self::GetGroupUploadServerUrl($_1065568205);
            } elseif ($_1687661643) {
                $_603413575 = self::GetMarketAlbumUploadServerUrl();
            } elseif ($_50240405) {
                $_603413575 = self::GetWallUploadServerUrl();
            } else {
                $_603413575 = self::GetMarketUploadServerUrl($_508350000);
            }
            if (is_array($_1397337972) && !empty($_1397337972)) {
                $_880503640 = array();
                if ($_1687661643) {
                    $_880503640['file'] = CAcritExportproplusExternApiTools::GetCurlFilename($_1397337972[0]);
                } else {
                    if ($_1065568205) {
                        $_100730269 = 5;
                    } elseif ($_50240405) {
                        $_100730269 = 6;
                    } else {
                        $_100730269 = 4;
                    }
                    foreach ($_1397337972 as $_1208095729 => $_1458548068) {
                        if (count($_880503640) >= $_100730269 - 1) break;
                        $_880503640['file' . (count($_880503640) + 1)] = CAcritExportproplusExternApiTools::GetCurlFilename($_1458548068);
                    }
                }
            }
            $_949254077 = json_decode(CAcritExportproplusExternApiTools::_CurlPost($_603413575, $_880503640, false), 1);
        }
        return $_949254077;
    }

    public function GetGroupUploadServerUrl($_1714541732)
    {
        $_898112218 = false;
        if (intval($_1714541732) > 0) {
            $_1255633473 = 'https://api.vk.com/method/photos.getUploadServer';
            $_379606503 = array();
            $_379606503['access_token'] = $this->_1745915131['ACCESS_TOKEN'];
            $_379606503['v'] = $this->_1745915131['API_VERSION'];
            $_379606503['group_id'] = $this->_1745915131['GROUP_PUBLISH'];
            $_379606503['album_id'] = $_1714541732;
            $_898112218 = json_decode(CAcritExportproplusExternApiTools::_CurlPost($_1255633473, $_379606503, false), 1);
        }
        return $_898112218['response']['upload_url'];
    }

    public function GetMarketAlbumUploadServerUrl()
    {
        $_1436700053 = "https://api.vk.com/method/photos.getMarketAlbumUploadServer";
        $_379606503 = array();
        $_379606503['access_token'] = $this->_1745915131['ACCESS_TOKEN'];
        $_379606503['v'] = $this->_1745915131['API_VERSION'];
        $_379606503['group_id'] = $this->_1745915131['GROUP_PUBLISH'];
        $_967107132 = json_decode(CAcritExportproplusExternApiTools::_CurlPost($_1436700053, $_379606503, false), 1);
        return $_967107132['response']['upload_url'];
    }

    public function GetWallUploadServerUrl()
    {
        $_1436700053 = "https://api.vk.com/method/photos.getWallUploadServer";
        $_379606503 = array();
        $_379606503['access_token'] = $this->_1745915131['ACCESS_TOKEN'];
        $_379606503['v'] = $this->_1745915131['API_VERSION'];
        $_379606503['group_id'] = $this->_1745915131['USER_PUBLISH'];
        $_157382579 = json_decode(CAcritExportproplusExternApiTools::_CurlPost($_1436700053, $_379606503, false), 1);
        return $_157382579['response']['upload_url'];
    }

    public function GetMarketUploadServerUrl($_508350000 = false)
    {
        $_1436700053 = "https://api.vk.com/method/photos.getMarketUploadServer";
        $_379606503 = array();
        $_379606503['access_token'] = $this->_1745915131['ACCESS_TOKEN'];
        $_379606503['v'] = $this->_1745915131['API_VERSION'];
        $_379606503['group_id'] = $this->_1745915131['GROUP_PUBLISH'];
        if ($_508350000) {
            $_379606503['main_photo'] = 1;
        }
        $_979286985 = json_decode(CAcritExportproplusExternApiTools::_CurlPost($_1436700053, $_379606503, false), 1);
        return $_979286985['response']['upload_url'];
    }

    public function DeleteMarketItem($_899073386)
    {
        $_586559802 = false;
        if (intval($_899073386) > 0) {
            $_264741645 = 'https://api.vk.com/method/market.delete';
            $_379606503 = array();
            $_379606503['access_token'] = $this->_1745915131['ACCESS_TOKEN'];
            $_379606503['v'] = $this->_1745915131['API_VERSION'];
            $_379606503['owner_id'] = ((intval($this->_1745915131['GROUP_PUBLISH']) > 0) ? '-' : '') . $this->_1745915131['GROUP_PUBLISH'];
            $_379606503['item_id'] = $_899073386;
            $_586559802 = json_decode(CAcritExportproplusExternApiTools::_CurlPost($_264741645, $_379606503, false), 1);
        }
        return $_586559802;
    }

    public function RestoreMarketItem($_899073386)
    {
        $_2091048150 = false;
        if (intval($_899073386) > 0) {
            $_1599624494 = 'https://api.vk.com/method/market.restore';
            $_379606503 = array();
            $_379606503['access_token'] = $this->_1745915131['ACCESS_TOKEN'];
            $_379606503['v'] = $this->_1745915131['API_VERSION'];
            $_379606503['owner_id'] = ((intval($this->_1745915131['GROUP_PUBLISH']) > 0) ? '-' : '') . $this->_1745915131['GROUP_PUBLISH'];
            $_379606503['item_id'] = $_899073386;
            $_2091048150 = json_decode(CAcritExportproplusExternApiTools::_CurlPost($_1599624494, $_379606503, false), 1);
        }
        return $_2091048150;
    }

    public function ReportMarketItem($_899073386, $_1693868533)
    {
        $_95173523 = false;
        $_1928664118 = array(0, 1, 2, 3, 4, 5, 6);
        if ((intval($_899073386) > 0) && in_array($_1693868533, $_1928664118)) {
            $_624731944 = 'https://api.vk.com/method/market.report';
            $_379606503 = array();
            $_379606503['access_token'] = $this->_1745915131['ACCESS_TOKEN'];
            $_379606503['v'] = $this->_1745915131['API_VERSION'];
            $_379606503['owner_id'] = ((intval($this->_1745915131['GROUP_PUBLISH']) > 0) ? '-' : '') . $this->_1745915131['GROUP_PUBLISH'];
            $_379606503['item_id'] = $_899073386;
            $_379606503['reason'] = $_1693868533;
            $_95173523 = json_decode(CAcritExportproplusExternApiTools::_CurlPost($_624731944, $_379606503, false), 1);
        }
        return $_95173523;
    }

    public function ReorderMarketItems($arParams)
    {
        $_868604444 = false;
        if (is_array($arParams) && !empty($arParams)) {
            $_1113937798 = 'https://api.vk.com/method/market.reorderItems';
            $_379606503 = array();
            $_379606503['access_token'] = $this->_1745915131['ACCESS_TOKEN'];
            $_379606503['v'] = $this->_1745915131['API_VERSION'];
            $_379606503['owner_id'] = ((intval($this->_1745915131['GROUP_PUBLISH']) > 0) ? '-' : '') . $this->_1745915131['GROUP_PUBLISH'];
            $_379606503['item_id'] = $arParams['ID'];
            if (intval($arParams['ALBUM_ID']) > 0) {
                $_379606503['album_id'] = $arParams['ALBUM_ID'];
            }
            if (intval($arParams['BEFORE_ID']) > 0) {
                $_379606503['before'] = $arParams['BEFORE_ID'];
            }
            if (intval($arParams['AFTER_ID']) > 0) {
                $_379606503['after'] = $arParams['AFTER_ID'];
            }
            $_868604444 = json_decode(CAcritExportproplusExternApiTools::_CurlPost($_1113937798, $_379606503, false), 1);
        }
        return $_868604444;
    }

    public function AddMarketItemToAlbums($arParams)
    {
        $_632882959 = false;
        if (is_array($arParams) && !empty($arParams) && (intval($arParams['ID']) > 0) && (strlen($arParams['ALBUMS']) > 0)) {
            $_738250183 = 'https://api.vk.com/method/market.addToAlbum';
            $_379606503 = array();
            $_379606503['access_token'] = $this->_1745915131['ACCESS_TOKEN'];
            $_379606503['v'] = $this->_1745915131['API_VERSION'];
            $_379606503['owner_id'] = ((intval($this->_1745915131['GROUP_PUBLISH']) > 0) ? '-' : '') . $this->_1745915131['GROUP_PUBLISH'];
            $_379606503['item_id'] = $arParams['ID'];
            $_379606503['album_ids'] = $arParams['ALBUMS'];
            $_632882959 = json_decode(CAcritExportproplusExternApiTools::_CurlPost($_738250183, $_379606503, false), 1);
        }
        return $_632882959;
    }

    public function RemoveMarketItemFromAlbums($arParams)
    {
        $_1891068344 = false;
        if (is_array($arParams) && !empty($arParams) && (intval($arParams['ID']) > 0) && (strlen($arParams['ALBUMS']) > 0)) {
            $_716333439 = 'https://api.vk.com/method/market.removeFromAlbum';
            $_379606503 = array();
            $_379606503['access_token'] = $this->_1745915131['ACCESS_TOKEN'];
            $_379606503['v'] = $this->_1745915131['API_VERSION'];
            $_379606503['owner_id'] = ((intval($this->_1745915131['GROUP_PUBLISH']) > 0) ? '-' : '') . $this->_1745915131['GROUP_PUBLISH'];
            $_379606503['item_id'] = $arParams['ID'];
            $_379606503['album_ids'] = $arParams['ALBUMS'];
            $_1891068344 = json_decode(CAcritExportproplusExternApiTools::_CurlPost($_716333439, $_379606503, false), 1);
        }
        return $_1891068344;
    }

    public function SearchMarketItems($arParams)
    {
        $_2064361132 = false;
        if (is_array($arParams) && !empty($arParams)) {
            $_1885788259 = array(0, 1, 2, 3);
            $_2060014154 = 'https://api.vk.com/method/market.search';
            $_379606503 = array();
            $_379606503['access_token'] = $this->_1745915131['ACCESS_TOKEN'];
            $_379606503['v'] = $this->_1745915131['API_VERSION'];
            $_379606503['owner_id'] = ((intval($this->_1745915131['GROUP_PUBLISH']) > 0) ? '-' : '') . $this->_1745915131['GROUP_PUBLISH'];
            if (intval($arParams['ALBUM_ID']) > 0) {
                $_379606503['album_id'] = $arParams['ALBUMS'];
            }
            if (strlen($arParams['QUERY_STRING']) > 0) {
                $_379606503['q'] = $arParams['QUERY_STRING'];
            }
            if (intval($arParams['PRICE_FROM']) > 0) {
                $_379606503['price_from'] = $arParams['PRICE_FROM'];
            }
            if (intval($arParams['PRICE_TO']) > 0) {
                $_379606503['price_to'] = $arParams['PRICE_TO'];
            }
            if (strlen($arParams['TAGS']) > 0) {
                $_379606503['tags'] = $arParams['TAGS'];
            }
            if ((intval($arParams['SORT']) > 0) && in_array($arParams['SORT'], $_1885788259)) {
                $_379606503['sort'] = $arParams['SORT'];
            }
            if (!$arParams['REV']) {
                $_379606503['rev'] = 0;
            }
            $_379606503['count'] = (intval($arParams['COUNT']) > 0) ? $arParams['COUNT'] : 100;
            if ($arParams['EXTENDED']) {
                $_379606503['extended'] = 1;
            }
            $_2064361132 = json_decode(CAcritExportproplusExternApiTools::_CurlPost($_2060014154, $_379606503, false), 1);
        }
        return $_2064361132;
    }

    public function GetMarketAlbums()
    {
        global $APPLICATION;
        $_1255633473 = 'https://api.vk.com/method/market.getAlbums';
        $_379606503 = array();
        $_379606503['access_token'] = $this->_1745915131['ACCESS_TOKEN'];
        $_379606503['v'] = $this->_1745915131['API_VERSION'];
        $_379606503['owner_id'] = ((intval($this->_1745915131['GROUP_PUBLISH']) > 0) ? '-' : '') . $this->_1745915131['GROUP_PUBLISH'];
        $_379606503['count'] = 100;
        $_2073066713 = $APPLICATION->ConvertCharsetArray(json_decode(CAcritExportproplusExternApiTools::_CurlPost($_1255633473, $_379606503, false), 1), 'UTF-8', SITE_CHARSET);
        return $_2073066713;
    }

    public function GetMarketAlbumsById($_417168712)
    {
        $_1356442790 = false;
        if (trim(strlen($_417168712)) > 0) {
            $_1255633473 = 'https://api.vk.com/method/market.getAlbumById';
            $_379606503 = array();
            $_379606503['access_token'] = $this->_1745915131['ACCESS_TOKEN'];
            $_379606503['v'] = $this->_1745915131['API_VERSION'];
            $_379606503['owner_id'] = ((intval($this->_1745915131['GROUP_PUBLISH']) > 0) ? '-' : '') . $this->_1745915131['GROUP_PUBLISH'];
            $_379606503['album_ids'] = $_417168712;
            $_1356442790 = json_decode(CAcritExportproplusExternApiTools::_CurlPost($_1255633473, $_379606503, false), 1);
        }
        return $_1356442790;
    }

    public function AddMarketAlbum($_790781857, $_263232621 = false, $_477813228 = false)
    {
        global $APPLICATION;
        $_278612349 = false;
        if (is_array($_790781857) && !empty($_790781857)) {
            if ($_477813228) {
                $_738250183 = 'https://api.vk.com/method/market.editAlbum';
            } else {
                $_738250183 = 'https://api.vk.com/method/market.addAlbum';
            }
            if (is_array($_790781857['PICTURE']) && !empty($_790781857['PICTURE'])) {
                $_1738300305 = self::SaveMarketAlbumPhoto($_790781857['PICTURE']);
            }
            $_379606503 = array();
            $_379606503['access_token'] = $this->_1745915131['ACCESS_TOKEN'];
            $_379606503['v'] = $this->_1745915131['API_VERSION'];
            $_379606503['owner_id'] = ((intval($this->_1745915131['GROUP_PUBLISH']) > 0) ? '-' : '') . $this->_1745915131['GROUP_PUBLISH'];
            if ($_477813228) {
                $_379606503['album_id'] = $_790781857['ID'];
            }
            $_379606503['title'] = CAcritExportproplusExternApiTools::PreparePostText($_790781857['NAME']);
            if (intval($_1738300305['response'][0]['id']) > 0) {
                $_379606503['photo_id'] = $_1738300305['response'][0]['id'];
            }
            if ($_263232621) {
                $_379606503['main_album'] = 1;
            }
            $_278612349 = $APPLICATION->ConvertCharsetArray(json_decode(CAcritExportproplusExternApiTools::_CurlPost($_738250183, $_379606503, false), 1), 'UTF-8', SITE_CHARSET);
        }
        return $_278612349;
    }

    public function SaveMarketAlbumPhoto($_1397337972)
    {
        $_1510793760 = false;
        if (is_array($_1397337972) && !empty($_1397337972)) {
            $_1502272078 = self::PreparePhotoToSaveOnServer($_1397337972, false, true);
            $_739831432 = 'https://api.vk.com/method/photos.saveMarketAlbumPhoto';
            $_379606503 = array();
            $_379606503['access_token'] = $this->_1745915131['ACCESS_TOKEN'];
            $_379606503['v'] = $this->_1745915131['API_VERSION'];
            $_379606503['group_id'] = $this->_1745915131['GROUP_PUBLISH'];
            $_379606503['server'] = $_1502272078['server'];
            $_379606503['photo'] = $_1502272078['photo'];
            $_379606503['hash'] = $_1502272078['hash'];
            $_1510793760 = json_decode(CAcritExportproplusExternApiTools::_CurlPost($_739831432, $_379606503, false), 1);
        }
        return $_1510793760;
    }

    public function DeleteMarketAlbum($_1714541732, $_263232621 = false)
    {
        global $APPLICATION;
        $_970468344 = false;
        if (intval($_1714541732) > 0) {
            $_264741645 = 'https://api.vk.com/method/market.deleteAlbum';
            $_379606503 = array();
            $_379606503['access_token'] = $this->_1745915131['ACCESS_TOKEN'];
            $_379606503['v'] = $this->_1745915131['API_VERSION'];
            $_379606503['owner_id'] = ((intval($this->_1745915131['GROUP_PUBLISH']) > 0) ? '-' : '') . $this->_1745915131['GROUP_PUBLISH'];
            $_379606503['album_id'] = $_1714541732;
            $_970468344 = $APPLICATION->ConvertCharsetArray(json_decode(CAcritExportproplusExternApiTools::_CurlPost($_264741645, $_379606503, false), 1), 'UTF-8', SITE_CHARSET);
        }
        return $_970468344;
    }

    public function ReorderMarketAlbums($arParams)
    {
        $_1991032056 = false;
        if (is_array($arParams) && !empty($arParams)) {
            $_1113937798 = 'https://api.vk.com/method/market.reorderAlbums';
            $_379606503 = array();
            $_379606503['access_token'] = $this->_1745915131['ACCESS_TOKEN'];
            $_379606503['v'] = $this->_1745915131['API_VERSION'];
            $_379606503['owner_id'] = ((intval($this->_1745915131['GROUP_PUBLISH']) > 0) ? '-' : '') . $this->_1745915131['GROUP_PUBLISH'];
            $_379606503['album_id'] = $arParams['ID'];
            if (intval($arParams['BEFORE_ID']) > 0) {
                $_379606503['before'] = $arParams['BEFORE_ID'];
            }
            if (intval($arParams['AFTER_ID']) > 0) {
                $_379606503['after'] = $arParams['AFTER_ID'];
            }
            $_1991032056 = json_decode(CAcritExportproplusExternApiTools::_CurlPost($_1113937798, $_379606503, false), 1);
        }
        return $_1991032056;
    }

    public function GetGroupAlbums($arParams = false)
    {
        global $APPLICATION;
        $_1255633473 = 'https://api.vk.com/method/photos.getAlbums';
        $_379606503 = array();
        $_379606503['access_token'] = $this->_1745915131['ACCESS_TOKEN'];
        $_379606503['v'] = $this->_1745915131['API_VERSION'];
        $_379606503['owner_id'] = ((intval($this->_1745915131['GROUP_PUBLISH']) > 0) ? '-' : '') . $this->_1745915131['GROUP_PUBLISH'];
        if (strlen($arParams['ALBUMS']) > 0) {
            $_379606503['album_ids'] = $arParams['ALBUMS'];
        }
        $_379606503['need_system'] = 0;
        $_379606503['need_covers'] = 1;
        $_379606503['photo_sizes'] = 1;
        $_183954103 = $APPLICATION->ConvertCharsetArray(json_decode(CAcritExportproplusExternApiTools::_CurlPost($_1255633473, $_379606503, false), 1), 'UTF-8', SITE_CHARSET);
        return $_183954103;
    }

    public function GetGroupAlbumsCount()
    {
        $_1255633473 = "https://api.vk.com/method/photos.getAlbumsCount";
        $_379606503 = array();
        $_379606503['access_token'] = $this->_1745915131['ACCESS_TOKEN'];
        $_379606503['v'] = $this->_1745915131['API_VERSION'];
        $_379606503['group_id'] = $this->_1745915131['GROUP_PUBLISH'];
        $_429611501 = json_decode(CAcritExportproplusExternApiTools::_CurlPost($_1255633473, $_379606503, false), 1);
        return $_429611501;
    }

    public function CreateGroupAlbum($arParams, $_477813228 = false)
    {
        $_600257380 = false;
        if (is_array($arParams) && !empty($arParams) && (strlen($arParams['TITLE']) > 0) && (!$_477813228 || ($_477813228 && (intval($arParams['ID']) > 0)))) {
            if ($_477813228) {
                $_129856824 = 'https://api.vk.com/method/photos.editAlbum';
            } else {
                $_129856824 = 'https://api.vk.com/method/photos.createAlbum';
            }
            $_379606503 = array();
            $_379606503['access_token'] = $this->_1745915131['ACCESS_TOKEN'];
            $_379606503['v'] = $this->_1745915131['API_VERSION'];
            if ($_477813228) {
                $_379606503['owner_id'] = ((intval($this->_1745915131['GROUP_PUBLISH']) > 0) ? '-' : '') . $this->_1745915131['GROUP_PUBLISH'];
                $_379606503['album_id'] = $arParams['ID'];
            } else {
                $_379606503['group_id'] = $this->_1745915131['GROUP_PUBLISH'];
            }
            $_379606503['title'] = CAcritExportproplusExternApiTools::PreparePostText($arParams['TITLE']);
            if (strlen($arParams['DESCRIPTION']) > 0) {
                $_379606503['description'] = CAcritExportproplusExternApiTools::PreparePostText($arParams['DESCRIPTION']);
            }
            $_379606503['upload_by_admins_only'] = 1;
            $_379606503['comments_disabled'] = 0;
            $_600257380 = json_decode(CAcritExportproplusExternApiTools::_CurlPost($_129856824, $_379606503, false), 1);
        }
        return $_600257380;
    }

    public function DeleteGroupAlbum($arParams)
    {
        $_557913179 = false;
        if (is_array($arParams) && !empty($arParams) && (intval($arParams['ID']) > 0)) {
            $_264741645 = 'https://api.vk.com/method/photos.deleteAlbum';
            $_379606503 = array();
            $_379606503['access_token'] = $this->_1745915131['ACCESS_TOKEN'];
            $_379606503['v'] = $this->_1745915131['API_VERSION'];
            $_379606503['group_id'] = $this->_1745915131['GROUP_PUBLISH'];
            $_379606503['album_id'] = $arParams['ID'];
            $_557913179 = json_decode(CAcritExportproplusExternApiTools::_CurlPost($_264741645, $_379606503, false), 1);
        }
        return $_557913179;
    }

    public function ReorderGroupAlbums($arParams)
    {
        $_463191136 = false;
        if (is_array($arParams) && !empty($arParams) && (intval($arParams['ID']) > 0)) {
            $_1113937798 = 'https://api.vk.com/method/photos.reorderAlbums';
            $_379606503 = array();
            $_379606503['access_token'] = $this->_1745915131['ACCESS_TOKEN'];
            $_379606503['v'] = $this->_1745915131['API_VERSION'];
            $_379606503['owner_id'] = ((intval($this->_1745915131['GROUP_PUBLISH']) > 0) ? '-' : '') . $this->_1745915131['GROUP_PUBLISH'];
            $_379606503['album_id'] = $arParams['ID'];
            if (intval($arParams['BEFORE_ID']) > 0) {
                $_379606503['before'] = $arParams['BEFORE_ID'];
            }
            if (intval($arParams['AFTER_ID']) > 0) {
                $_379606503['after'] = $arParams['AFTER_ID'];
            }
            $_463191136 = json_decode(CAcritExportproplusExternApiTools::_CurlPost($_1113937798, $_379606503, false), 1);
        }
        return $_463191136;
    }

    public function GetGroupPhotos($arParams)
    {
        $_1812312156 = false;
        if (is_array($arParams) && !empty($arParams) && (intval($arParams['ALBUM_ID']) > 0)) {
            $_1255633473 = 'https://api.vk.com/method/photos.get';
            $_379606503 = array();
            $_379606503['access_token'] = $this->_1745915131['ACCESS_TOKEN'];
            $_379606503['v'] = $this->_1745915131['API_VERSION'];
            $_379606503['owner_id'] = ((intval($this->_1745915131['GROUP_PUBLISH']) > 0) ? '-' : '') . $this->_1745915131['GROUP_PUBLISH'];
            $_379606503['album_id'] = $arParams['ALBUM_ID'];
            $_379606503['rev'] = 0;
            if ($arParams['EXTENDED']) {
                $_379606503['extended'] = 1;
            }
            $_379606503['photo_sizes'] = 1;
            $_379606503['count'] = 100;
            $_1812312156 = json_decode(CAcritExportproplusExternApiTools::_CurlPost($_1255633473, $_379606503, false), 1);
        }
        return $_1812312156;
    }

    public function GetGroupPhotosById($arParams)
    {
        $_947784707 = false;
        if (is_array($arParams) && !empty($arParams) && (strlen($arParams['PHOTOS']) > 0)) {
            $_1255633473 = 'https://api.vk.com/method/photos.getById';
            $_379606503 = array();
            $_379606503['access_token'] = $this->_1745915131['ACCESS_TOKEN'];
            $_379606503['v'] = $this->_1745915131['API_VERSION'];
            $_379606503['photos'] = $arParams['PHOTOS'];
            if ($arParams['EXTENDED']) {
                $_379606503['extended'] = 1;
            }
            $_379606503['photo_sizes'] = 1;
            $_947784707 = json_decode(CAcritExportproplusExternApiTools::_CurlPost($_1255633473, $_379606503, false), 1);
        }
        return $_947784707;
    }

    public function AddGroupPhoto($arParams)
    {
        $_990661420 = false;
        if (is_array($arParams) && !empty($arParams) && is_array($arParams['FILES']) && !empty($arParams['FILES']) && (strlen($arParams['ALBUM_ID']) > 0)) {
            $_739831432 = 'https://api.vk.com/method/photos.save';
            $_990661420 = array();
            foreach ($arParams['FILES'] as $_842953512) {
                $_1502272078 = self::PreparePhotoToSaveOnServer($_842953512['PHOTO'], false, false, $arParams['ALBUM_ID']);
                $_379606503 = array();
                $_379606503['access_token'] = $this->_1745915131['ACCESS_TOKEN'];
                $_379606503['v'] = $this->_1745915131['API_VERSION'];
                $_379606503['group_id'] = $this->_1745915131['GROUP_PUBLISH'];
                $_379606503['server'] = $_1502272078['server'];
                $_379606503['album_id'] = $arParams['ALBUM_ID'];
                $_379606503['photos_list'] = $_1502272078['photos_list'];
                $_379606503['hash'] = $_1502272078['hash'];
                $_379606503['caption'] = CAcritExportproplusExternApiTools::PreparePostText($arParams['URL_LABEL']) . $this->profile['SITE_PROTOCOL'] . '://' . $this->profile['DOMAIN_NAME'] . $_842953512['URL'] . '

' . CAcritExportproplusExternApiTools::PreparePostText($_842953512['DESCRIPTION']);
                $_990661420[] = json_decode(CAcritExportproplusExternApiTools::_CurlPost($_739831432, $_379606503, false), 1);
            }
        }
        return $_990661420;
    }

    public function EditGroupPhoto($arParams)
    {
        $_2043565954 = false;
        if (is_array($arParams) && !empty($arParams) && (intval($arParams['ID']) > 0)) {
            $_142408493 = 'https://api.vk.com/method/photos.edit';
            $_379606503 = array();
            $_379606503['access_token'] = $this->_1745915131['ACCESS_TOKEN'];
            $_379606503['v'] = $this->_1745915131['API_VERSION'];
            $_379606503['owner_id'] = ((intval($this->_1745915131['GROUP_PUBLISH']) > 0) ? '-' : '') . $this->_1745915131['GROUP_PUBLISH'];
            $_379606503['photo_id'] = $arParams['ID'];
            $_379606503['caption'] = CAcritExportproplusExternApiTools::PreparePostText($arParams['URL_LABEL']) . $this->profile['SITE_PROTOCOL'] . '://' . $this->profile['DOMAIN_NAME'] . $arParams['URL'] . '

' . CAcritExportproplusExternApiTools::PreparePostText($arParams['DESCRIPTION']);
            $_2043565954 = json_decode(CAcritExportproplusExternApiTools::_CurlPost($_142408493, $_379606503, false), 1);
        }
        return $_2043565954;
    }

    public function DeleteGroupPhoto($arParams)
    {
        $_884425807 = false;
        if (is_array($arParams) && !empty($arParams) && (intval($arParams['ID']) > 0)) {
            $_264741645 = 'https://api.vk.com/method/photos.delete';
            $_379606503 = array();
            $_379606503['access_token'] = $this->_1745915131['ACCESS_TOKEN'];
            $_379606503['v'] = $this->_1745915131['API_VERSION'];
            $_379606503['owner_id'] = ((intval($this->_1745915131['GROUP_PUBLISH']) > 0) ? '-' : '') . $this->_1745915131['GROUP_PUBLISH'];
            $_379606503['photo_id'] = $arParams['ID'];
            $_884425807 = json_decode(CAcritExportproplusExternApiTools::_CurlPost($_264741645, $_379606503, false), 1);
        }
        return $_884425807;
    }

    public function RestoreGroupPhoto($arParams)
    {
        $_984819152 = false;
        if (is_array($arParams) && !empty($arParams) && (intval($arParams['ID']) > 0)) {
            $_1599624494 = 'https://api.vk.com/method/photos.restore';
            $_379606503 = array();
            $_379606503['access_token'] = $this->_1745915131['ACCESS_TOKEN'];
            $_379606503['v'] = $this->_1745915131['API_VERSION'];
            $_379606503['owner_id'] = ((intval($this->_1745915131['GROUP_PUBLISH']) > 0) ? '-' : '') . $this->_1745915131['GROUP_PUBLISH'];
            $_379606503['photo_id'] = $arParams['ID'];
            $_984819152 = json_decode(CAcritExportproplusExternApiTools::_CurlPost($_1599624494, $_379606503, false), 1);
        }
        return $_984819152;
    }

    public function MakeCoverGroupPhoto($arParams)
    {
        $_1023429292 = false;
        if (is_array($arParams) && !empty($arParams) && (intval($arParams['ID']) > 0) && (intval($arParams['ALBUM_ID']) > 0)) {
            $_1546025225 = 'https://api.vk.com/method/photos.makeCover';
            $_379606503 = array();
            $_379606503['access_token'] = $this->_1745915131['ACCESS_TOKEN'];
            $_379606503['v'] = $this->_1745915131['API_VERSION'];
            $_379606503['owner_id'] = ((intval($this->_1745915131['GROUP_PUBLISH']) > 0) ? '-' : '') . $this->_1745915131['GROUP_PUBLISH'];
            $_379606503['photo_id'] = $arParams['ID'];
            $_379606503['album_id'] = $arParams['ALBUM_ID'];
            $_1023429292 = json_decode(CAcritExportproplusExternApiTools::_CurlPost($_1546025225, $_379606503, false), 1);
        }
        return $_1023429292;
    }

    public function MoveGroupPhoto($arParams)
    {
        $_1407734428 = false;
        if (is_array($arParams) && !empty($arParams) && (intval($arParams['ID']) > 0) && (intval($arParams['ALBUM_ID']) > 0)) {
            $_627343393 = 'https://api.vk.com/method/photos.move';
            $_379606503 = array();
            $_379606503['access_token'] = $this->_1745915131['ACCESS_TOKEN'];
            $_379606503['v'] = $this->_1745915131['API_VERSION'];
            $_379606503['owner_id'] = ((intval($this->_1745915131['GROUP_PUBLISH']) > 0) ? '-' : '') . $this->_1745915131['GROUP_PUBLISH'];
            $_379606503['photo_id'] = $arParams['ID'];
            $_379606503['target_album_id'] = $arParams['ALBUM_ID'];
            $_1407734428 = json_decode(CAcritExportproplusExternApiTools::_CurlPost($_627343393, $_379606503, false), 1);
        }
        return $_1407734428;
    }

    public function ReorderGroupPhotosInAlbum($arParams)
    {
        $_1882570208 = false;
        if (is_array($arParams) && !empty($arParams) && (intval($arParams['ID']) > 0)) {
            $_1113937798 = 'https://api.vk.com/method/photos.reorderPhotos';
            $_379606503 = array();
            $_379606503['access_token'] = $this->_1745915131['ACCESS_TOKEN'];
            $_379606503['v'] = $this->_1745915131['API_VERSION'];
            $_379606503['owner_id'] = ((intval($this->_1745915131['GROUP_PUBLISH']) > 0) ? '-' : '') . $this->_1745915131['GROUP_PUBLISH'];
            $_379606503['photo_id'] = $arParams['ID'];
            if (intval($arParams['BEFORE_ID']) > 0) {
                $_379606503['before'] = $arParams['BEFORE_ID'];
            }
            if (intval($arParams['AFTER_ID']) > 0) {
                $_379606503['after'] = $arParams['AFTER_ID'];
            }
            $_1882570208 = json_decode(CAcritExportproplusExternApiTools::_CurlPost($_1113937798, $_379606503, false), 1);
        }
        return $_1882570208;
    }

    public function SearchGroupPhotos($arParams)
    {
        global $APPLICATION;
        $_468740201 = false;
        if (is_array($arParams) && !empty($arParams) && (strlen($arParams['QUERY_STRING']) > 0)) {
            $_2060014154 = 'https://api.vk.com/method/photos.search';
            $_379606503 = array();
            $_379606503['access_token'] = $this->_1745915131['ACCESS_TOKEN'];
            $_379606503['v'] = $this->_1745915131['API_VERSION'];
            $_379606503['owner_id'] = ((intval($this->_1745915131['GROUP_PUBLISH']) > 0) ? '-' : '') . $this->_1745915131['GROUP_PUBLISH'];
            $_379606503['q'] = $arParams['QUERY_STRING'];
            $_379606503['sort'] = 0;
            $_468740201 = $APPLICATION->ConvertCharsetArray(json_decode(CAcritExportproplusExternApiTools::_CurlPost($_2060014154, $_379606503, false), 1), 'UTF-8', SITE_CHARSET);
        }
        return $_468740201;
    }

    public function GetWallItemsById($_247886239, $_1547297743 = false)
    {
        $_369064949 = false;
        $_85372815 = array();
        foreach ($_247886239 as $_899073386) {
            $_85372815[] = $this->_1745915131['USER_PUBLISH'] . '_' . $_899073386;
        }
        $_366315767 = implode(',', $_85372815);
        $_1255633473 = 'https://api.vk.com/method/wall.getById';
        $_379606503 = array();
        $_379606503['access_token'] = $this->_1745915131['ACCESS_TOKEN'];
        $_379606503['v'] = $this->_1745915131['API_VERSION'];
        $_379606503['posts'] = $_366315767;
        $_369064949 = json_decode(CAcritExportproplusExternApiTools::_CurlPost($_1255633473, $_379606503, false), 1);
        return $_369064949;
    }

    public function AddWallItem($_887539035, $_477813228 = false)
    {
        $_111955992 = false;
        if (is_array($_887539035) && !empty($_887539035)) {
            $_193742864 = self::SaveWallPhoto($_887539035['PHOTO']);
            if (is_array($_193742864) && !empty($_193742864)) {
                $_567299265 = array();
                foreach ($_193742864['response'] as $_1993508643) {
                    $_567299265[] = 'photo' . $this->_1745915131['USER_PUBLISH'] . '_' . $_1993508643['id'];
                }
                $_1392279748 = implode(',', $_567299265);
            }
            if ($_477813228) {
                $_738250183 = 'https://api.vk.com/method/wall.edit';
            } else {
                $_738250183 = 'https://api.vk.com/method/wall.post';
            }
            $_379606503 = array();
            $_379606503['access_token'] = $this->_1745915131['ACCESS_TOKEN'];
            $_379606503['v'] = $this->_1745915131['API_VERSION'];
            $_379606503['owner_id'] = $this->_1745915131['USER_PUBLISH'];
            $_379606503['friends_only'] = 0;
            $_379606503['from_group'] = 0;
            $_379606503['signed'] = 0;
            $_379606503['mark_as_ads'] = 0;
            if ($_477813228) {
                $_379606503['post_id'] = $_887539035['ID'];
            }
            $_379606503['message'] = CAcritExportproplusExternApiTools::PreparePostText($_887539035['URL_LABEL']) . $this->profile['SITE_PROTOCOL'] . '://' . $this->profile['DOMAIN_NAME'] . $_887539035['URL'] . '

' . CAcritExportproplusExternApiTools::PreparePostText($_887539035['DESCRIPTION']);
            $_379606503['attachments'] = $_1392279748;
            $_111955992 = json_decode(CAcritExportproplusExternApiTools::_CurlPost($_738250183, $_379606503, false), 1);
        }
        return $_111955992;
    }

    public function SaveWallPhoto($_1397337972)
    {
        $_1656004154 = false;
        if (is_array($_1397337972) && !empty($_1397337972)) {
            $_1502272078 = self::PreparePhotoToSaveOnServer($_1397337972, false, false, false, true);
            $_739831432 = 'https://api.vk.com/method/photos.saveWallPhoto';
            $_379606503 = array();
            $_379606503['access_token'] = $this->_1745915131['ACCESS_TOKEN'];
            $_379606503['v'] = $this->_1745915131['API_VERSION'];
            $_379606503['group_id'] = $this->_1745915131['USER_PUBLISH'];
            $_379606503['server'] = $_1502272078['server'];
            $_379606503['photo'] = $_1502272078['photo'];
            $_379606503['hash'] = $_1502272078['hash'];
            $_1656004154 = json_decode(CAcritExportproplusExternApiTools::_CurlPost($_739831432, $_379606503, false), 1);
        }
        return $_1656004154;
    }

    public function DeleteWallItem($_899073386)
    {
        $_1432791014 = false;
        if (intval($_899073386) > 0) {
            $_264741645 = 'https://api.vk.com/method/wall.delete';
            $_379606503 = array();
            $_379606503['access_token'] = $this->_1745915131['ACCESS_TOKEN'];
            $_379606503['v'] = $this->_1745915131['API_VERSION'];
            $_379606503['owner_id'] = $this->_1745915131['USER_PUBLISH'];
            $_379606503['post_id'] = $_899073386;
            $_1432791014 = json_decode(CAcritExportproplusExternApiTools::_CurlPost($_264741645, $_379606503, false), 1);
        }
        return $_1432791014;
    }
}

class CAcritExportproplusFb
{
    public $profile = null;
    public $_1046076681 = null;
    public $_940439577;
    public $dbRes = null;

    public function __construct($profile)
    {
        global $APPLICATION;
        require_once('classes/general/Facebook/autoload.php');
        require_once('classes/general/FacebookAds/autoload.php');
        $this->dbRes = new CExportproplusProfileDB();
        $this->_1717979731 = @CModule::IncludeModule('iblock');
        $this->profile = $profile;
        $this->_1046076681 = self::GetAccessAccountData();
        $this->_940439577 = new CAcritExportproplusLog($this->profile['ID']);
    }

    public function GetAccessAccountData()
    {
        $_1653488833 = array("PAGE_PUBLISH" => $this->profile["FB"]["FB_PAGE_PUBLISH"], "APP_ID" => $this->profile["FB"]["FB_APP_ID"], "APP_SECRET" => $this->profile["FB"]["FB_APP_SECRET"], "ACCESS_TOKEN" => $this->profile["FB"]["FB_ACCESS_TOKEN"],);
        return $_1653488833;
    }

    function CheckDataAndAccess($_421487420, $_1811205380)
    {
        $_1126599918 = false;
        try {
            $result = $_1811205380->get('/' . $this->_1046076681['PAGE_PUBLISH'] . '?fields=access_token')->getGraphObject()->asArray();
            if (isset($result['access_token'])) {
                $_1811205380->setDefaultAccessToken($result['access_token']);
                $_1126599918 = true;
            }
        } catch (Facebook\Exceptions\FacebookResponseException $_730210266) {
            $this->_940439577->AddMessage("{$_421487420['NAME']} (ID:{$_421487420['ID']}) : " . str_replace('#FB_ERROR#', 'CODE: ' . $_730210266, GetMessage('ACRIT_EXPORTPROPLUS_REQUIRED_FIELD_FB_SKIP')));
            $this->_940439577->IncProductError();
        } catch (Facebook\Exceptions\FacebookSDKException $_730210266) {
            $this->_940439577->AddMessage("{$_421487420['NAME']} (ID:{$_421487420['ID']}) : " . str_replace('#FB_ERROR#', 'CODE: ' . $_730210266, GetMessage('ACRIT_EXPORTPROPLUS_REQUIRED_FIELD_FB_SKIP')));
            $this->_940439577->IncProductError();
        }
        return $_1126599918;
    }

    function ProcessData($_421487420)
    {
        $_1389222250 = new Facebook\Facebook(array('app_id' => $this->_1046076681['APP_ID'], 'app_secret' => $this->_1046076681['APP_SECRET'], 'default_graph_version' => 'v2.8', 'default_access_token' => $this->_1046076681['ACCESS_TOKEN'],));
        $_144497832 = self::PreparePostData($_421487420);
        $_852380599 = $this->profile['FB']['FB_RELATIONS'];
        $_1404128509 = false;
        if ($this->profile['FB']['FB_RELATIONS'] != null) {
            $_1404128509 = isset($_852380599[$_421487420['ID']]) ? $_852380599[$_421487420['ID']] : false;
        }
        if ($_1404128509) {
            $_909076403 = $_421487420;
            $_909076403['ID'] = $_1404128509;
            try {
                $_683024549 = $_1389222250->post('/' . $_421487420['ID'], $_144497832)->getDecodedBody();
            } catch (Facebook\Exceptions\FacebookResponseException $_730210266) {
                $this->_940439577->AddMessage("{$_421487420['NAME']} (ID:{$_421487420['ID']}) : " . str_replace('#FB_ERROR#', 'CODE: ' . $_730210266, GetMessage('ACRIT_EXPORTPROPLUS_REQUIRED_FIELD_FB_SKIP')));
                $this->_940439577->IncProductError();
            } catch (Facebook\Exceptions\FacebookSDKException $_730210266) {
                $this->_940439577->AddMessage("{$_421487420['NAME']} (ID:{$_421487420['ID']}) : " . str_replace('#FB_ERROR#', 'CODE: ' . $_730210266, GetMessage('ACRIT_EXPORTPROPLUS_REQUIRED_FIELD_FB_SKIP')));
                $this->_940439577->IncProductError();
            }
        } else {
            if ($this->profile['FB']['FB_RELATIONS'] == null) {
                $this->profile['FB']['FB_RELATIONS'] = array();
            }
            try {
                $_683024549 = $_1389222250->post('/' . $this->_1046076681['PAGE_PUBLISH'] . '/feed', $_144497832)->getDecodedBody();
                $this->profile['FB']['FB_RELATIONS'][$_421487420['ID']] = $_683024549['id'];
                $this->dbRes->Update($this->profile['ID'], $this->profile);
            } catch (Facebook\Exceptions\FacebookResponseException $_730210266) {
                $this->_940439577->AddMessage("{$_421487420['NAME']} (ID:{$_421487420['ID']}) : " . str_replace('#FB_ERROR#', 'CODE: ' . $_730210266, GetMessage('ACRIT_EXPORTPROPLUS_REQUIRED_FIELD_FB_SKIP')));
                $this->_940439577->IncProductError();
            } catch (Facebook\Exceptions\FacebookSDKException $_730210266) {
                $this->_940439577->AddMessage("{$_421487420['NAME']} (ID:{$_421487420['ID']}) : " . str_replace('#FB_ERROR#', 'CODE: ' . $_730210266, GetMessage('ACRIT_EXPORTPROPLUS_REQUIRED_FIELD_FB_SKIP')));
                $this->_940439577->IncProductError();
            }
        }
    }

    function PreparePostData($_421487420)
    {
        global $APPLICATION;
        $_379606503 = array();
        $_379606503['access_token'] = $this->_1046076681['ACCESS_TOKEN'];
        $_379606503['message'] = $_421487420['MESSAGE'];
        $_379606503['message'] = strip_tags($_379606503['message']);
        $_379606503['message'] = $APPLICATION->ConvertCharset($_379606503['message'], SITE_CHARSET, 'UTF-8');
        $_379606503['message'] = trim(html_entity_decode($_379606503['message']));
        if (empty($_379606503['message'])) unset($_379606503['message']);
        $_379606503['link'] = $_421487420['URL'];
        $_379606503['picture'] = $_421487420['PHOTO'];
        $_379606503['name'] = $_421487420['NAME'];
        $_379606503['name'] = strip_tags($_379606503['name']);
        $_379606503['name'] = $APPLICATION->ConvertCharset($_379606503['name'], SITE_CHARSET, 'UTF-8');
        $_379606503['name'] = html_entity_decode($_379606503['name']);
        $_379606503['name'] = substr($_379606503['name'], 0, 255);
        $_379606503['description'] = $_421487420['DESCRIPTION'];
        $_379606503['description'] = strip_tags($_379606503['description']);
        $_379606503['description'] = $APPLICATION->ConvertCharset($_379606503['description'], SITE_CHARSET, 'UTF-8');
        $_379606503['description'] = html_entity_decode($_379606503['description']);
        return $_379606503;
    }
}

class CAcritExportproplusOk
{
    public $profile = null;
    public $_1120395184 = null;
    public $_940439577;
    public $dbRes = null;

    public function __construct($profile)
    {
        $this->dbRes = new CExportproplusProfileDB();
        $this->_1717979731 = @CModule::IncludeModule('iblock');
        $this->profile = $profile;
        $this->_1120395184 = self::GetAccessAccountData();
        $this->_940439577 = new CAcritExportproplusLog($this->profile['ID']);
        \OdnoklassnikiSDK::init($this->_1120395184['APP_ID'], $this->_1120395184['APP_PUBLIC_KEY'], $this->_1120395184['APP_SECRET_KEY'], $this->_1120395184['ACCESS_TOKEN']);
    }

    public function GetAccessAccountData()
    {
        $_1653488833 = array("IS_GROUP_PUBLISH" => $this->profile["OK"]["OK_IS_GROUP_PUBLISH"], "GROUP" => $this->profile["OK"]["OK_GROUP"], "APP_ID" => $this->profile["OK"]["OK_APP_ID"], "APP_PUBLIC_KEY" => $this->profile["OK"]["OK_APP_PUBLIC_KEY"], "APP_SECRET_KEY" => $this->profile["OK"]["OK_APP_SECRET_KEY"], "ACCESS_TOKEN" => $this->profile["OK"]["OK_ACCESS_TOKEN"],);
        return $_1653488833;
    }

    function AddMediatopic($_421487420)
    {
        $_1680932907 = false;
        $_144497832 = self::PreparePostData($_421487420);
        $_701030199 = (object)array('media' => array());
        $_979248904 = $_144497832['description'];
        $_701030199->_1644018627[] = (object)array('type' => 'text', 'text' => $_979248904);
        if ($this->_1120395184['IS_GROUP_PUBLISH'] == 'Y') {
            $_701030199->_1117629261 = true;
        } else {
            $_701030199->_1117629261 = false;
        }
        $_1576593594 = self::UploadPhotos($_144497832['picture']);
        if (!empty($_1576593594)) {
            $_701030199->_1644018627[] = (object)array('type' => 'photo', 'list' => $_1576593594['attach'],);
        }
        $_1009607505 = $_144497832['link'];
        if (!empty($_1009607505)) {
            $_701030199->_1644018627[] = (object)array('type' => 'link', 'url' => &$_1009607505);
            $_1703186916 = count($_701030199->_1644018627) - 1;
        }
        $_1892336024 = array('gid' => $this->_1120395184['GROUP'], 'type' => 'GROUP_THEME', 'attachment' => json_encode($_701030199));
        $_1680932907 = \OdnoklassnikiSDK::makeRequest('mediatopic.post', $_1892336024);
        if (isset($_1680932907['error_code']) && ($_1680932907['error_code'] == 5000)) {
            if (strpos($_1009607505, 'https') === 0) {
                $_1009607505 = 'http' . substr($_1009607505, strlen('https'));
            } else {
                $_1009607505 = 'https' . substr($_1009607505, strlen('http'));
            }
            $_1892336024 = array('gid' => $this->_1120395184['GROUP'], 'type' => 'GROUP_THEME', 'attachment' => json_encode($_701030199));
            $_1680932907 = \OdnoklassnikiSDK::makeRequest('mediatopic.post', $_1892336024);
            if (isset($_1680932907['error_code']) && ($_1680932907['error_code'] == 5000) && ($_1703186916 >= 0)) {
                unset($_701030199->_1644018627[$_1703186916]);
                $_1892336024 = array('gid' => $this->_1120395184['GROUP'], 'type' => 'GROUP_THEME', 'attachment' => json_encode($_701030199));
                $_1680932907 = \OdnoklassnikiSDK::makeRequest('mediatopic.post', $_1892336024);
            }
        }
        if (isset($_1680932907['error_code'])) {
            $this->_940439577->AddMessage("{$_421487420['NAME']} (ID:{$_421487420['ID']}) : " . str_replace('#OK_ERROR#', 'CODE: ' . $_1680932907['error_msg'], GetMessage('ACRIT_EXPORTPROPLUS_REQUIRED_FIELD_OK_SKIP')));
            $this->_940439577->IncProductError();
        }
        return $_1680932907;
    }

    function PreparePostData($_421487420)
    {
        global $APPLICATION;
        $_379606503 = array();
        $_379606503['access_token'] = $this->_1120395184['ACCESS_TOKEN'];
        $_379606503['link'] = $_421487420['URL'];
        $_379606503['picture'] = $_421487420['PHOTO'];
        $_379606503['name'] = CAcritExportproplusExternApiTools::PreparePostText($_421487420['NAME'], 'UTF-8');
        $_379606503['description'] = CAcritExportproplusExternApiTools::PreparePostText($_421487420['DESCRIPTION'], 'UTF-8');
        $_379606503['description_market'] = CAcritExportproplusExternApiTools::PreparePostText($_421487420['DESCRIPTION_MARKET'], 'UTF-8');
        $_379606503['price'] = CAcritExportproplusExternApiTools::PreparePostText($_421487420['PRICE'], 'UTF-8');
        $_379606503['currency'] = CAcritExportproplusExternApiTools::PreparePostText($_421487420['CURRENCY'], 'UTF-8');
        return $_379606503;
    }

    function UploadPhotos($_1292708158, $_1977694378 = false)
    {
        $_567299265 = array();
        $_781749914 = array('gid' => $this->_1120395184['GROUP'], 'count' => count($_1292708158),);
        if (intval($_1977694378) > 0) {
            $_781749914['aid'] = intval($_1977694378);
        }
        $_203114691 = \OdnoklassnikiSDK::makeRequest('photosV2.getUploadUrl', $_781749914);
        if (!isset($_203114691['error_code'])) {
            $_664551201 = array();
            foreach ($_1292708158 as $_1392445933 => $_805262176) {
                $_664551201['pic' . $_1392445933] = CAcritExportproplusExternApiTools::GetCurlFilename($_805262176);
            }
            $_1966182546 = json_decode(CAcritExportproplusExternApiTools::_CurlPost($_203114691['upload_url'], $_664551201));
            if (isset($_1966182546->_1696974501)) {
                $_567299265['fullinfo'] = $_1966182546->_1696974501;
                $_567299265['attach'] = array();
                foreach ($_1966182546->_1696974501 as $_1320456319 => $_1438955011) {
                    $_567299265['attach'][] = (object)array('id' => $_1438955011->_1992316439);
                }
            }
        }
        return $_567299265;
    }

    function DeleteMediaTopicById($_138792169)
    {
        $_697577572 = false;
        $_1062111222 = self::GetMediaTopicById($_138792169);
        if (!isset($_1062111222['error_code'])) {
            $_1892336024 = array('delete_id' => $_1062111222['media_topics'][0]['delete_id']);
            $_697577572 = \OdnoklassnikiSDK::makeRequest('mediatopic.deleteTopic', $_1892336024);
            if (isset($_697577572['error_code'])) {
                $this->_940439577->AddMessage("{$_421487420['NAME']} (ID:{$_421487420['ID']}) : " . str_replace('#OK_ERROR#', 'CODE: ' . $_697577572['error_msg'], GetMessage('ACRIT_EXPORTPROPLUS_REQUIRED_FIELD_OK_SKIP')));
                $this->_940439577->IncProductError();
            }
        }
        return $_697577572;
    }

    function GetMediaTopicById($_138792169)
    {
        $_1606303299 = false;
        $_1892336024 = array('topic_ids' => $_138792169, 'fields' => 'media_topic.*');
        $_1606303299 = \OdnoklassnikiSDK::makeRequest('mediatopic.getByIds', $_1892336024);
        if (isset($_1606303299['error_code'])) {
            $this->_940439577->AddMessage("{$_421487420['NAME']} (ID:{$_421487420['ID']}) : " . str_replace('#OK_ERROR#', 'CODE: ' . $_1606303299['error_msg'], GetMessage('ACRIT_EXPORTPROPLUS_REQUIRED_FIELD_OK_SKIP')));
            $this->_940439577->IncProductError();
        }
        return $_1606303299;
    }

    function DeleteMediaTopic($_1572082177)
    {
        $_85688229 = false;
        $_1892336024 = array('delete_id' => $_1572082177);
        $_85688229 = \OdnoklassnikiSDK::makeRequest('mediatopic.deleteTopic', $_1892336024);
        if (isset($_85688229['error_code'])) {
            $this->_940439577->AddMessage("{$_421487420['NAME']} (ID:{$_421487420['ID']}) : " . str_replace('#OK_ERROR#', 'CODE: ' . $_85688229['error_msg'], GetMessage('ACRIT_EXPORTPROPLUS_REQUIRED_FIELD_OK_SKIP')));
            $this->_940439577->IncProductError();
        }
        return $_85688229;
    }

    function DeleteMediaTopics()
    {
        $_85688229 = false;
        $_919350178 = self::GetTopics();
        foreach ($_919350178 as $_1572082177) {
            $_1892336024 = array('delete_id' => $_1572082177);
            $_85688229 = \OdnoklassnikiSDK::makeRequest('mediatopic.deleteTopic', $_1892336024);
        }
        return $_85688229;
    }

    function GetTopics()
    {
        $_904753509 = array();
        $_217247529 = self::GetTopicsPart();
        $_1490286822 = $_217247529['media_topics'];
        while (count($_217247529['media_topics'])) {
            $_217247529 = self::GetTopicsPart($_217247529['anchor']);
            if (count($_217247529['media_topics'])) {
                $_1490286822 = array_merge($_1490286822, $_217247529['media_topics']);
            }
        }
        foreach ($_1490286822 as $_641893968) {
            $_904753509[] = $_641893968['delete_id'];
        }
        return $_904753509;
    }

    function GetTopicsPart($_1236181728 = false)
    {
        $_1817996396 = false;
        $_1892336024 = array('gid' => $this->_1120395184['GROUP'],);
        if ($_1236181728) {
            $_1892336024['anchor'] = $_1236181728;
        }
        $_1817996396 = \OdnoklassnikiSDK::makeRequest('mediatopic.getTopics', $_1892336024);
        return $_1817996396;
    }

    function GetAlbums()
    {
        $_318813199 = false;
        $_1892336024 = array('gid' => $this->_1120395184['GROUP']);
        $_863904913 = \OdnoklassnikiSDK::makeRequest('photos.getAlbums', $_1892336024);
        if (is_array($_863904913) && !empty($_863904913)) {
            foreach ($_863904913['albums'] as $_790781857) {
                $_318813199[] = $_790781857['aid'];
            }
        }
        return $_318813199;
    }

    function CreateAlbum($_421487420)
    {
        $_1933377560 = false;
        $_1892336024 = array('gid' => $this->_1120395184['GROUP'], 'title' => CAcritExportproplusExternApiTools::PreparePostText($_421487420['NAME'], 'UTF-8'));
        $_1933377560 = \OdnoklassnikiSDK::makeRequest('photos.createAlbum', $_1892336024);
        if (isset($_1933377560['error_code'])) {
            $this->_940439577->AddMessage("{$_421487420['NAME']} (ID:{$_421487420['ID']}) : " . str_replace('#OK_ERROR#', 'CODE: ' . $_1933377560['error_msg'], GetMessage('ACRIT_EXPORTPROPLUS_REQUIRED_FIELD_OK_SKIP')));
            $this->_940439577->IncProductError();
        }
        return $_1933377560;
    }

    function DeleteAlbum($_421487420)
    {
        $_624484612 = false;
        $_1892336024 = array('gid' => $this->_1120395184['GROUP'], 'aid' => $_421487420['ID']);
        $_624484612 = \OdnoklassnikiSDK::makeRequest('photos.deleteAlbum', $_1892336024);
        if (isset($_624484612['error_code'])) {
            $this->_940439577->AddMessage("{$_421487420['NAME']} (ID:{$_421487420['ID']}) : " . str_replace('#OK_ERROR#', 'CODE: ' . $_624484612['error_msg'], GetMessage('ACRIT_EXPORTPROPLUS_REQUIRED_FIELD_OK_SKIP')));
            $this->_940439577->IncProductError();
        }
        return $_624484612;
    }

    function GetPhotos($_421487420)
    {
        $_1292708158 = array();
        $_974913721 = self::GetPhotosPage($_421487420);
        $_988521091 = $_974913721['photos'];
        while (count($_974913721['photos'])) {
            $_974913721 = self::GetTopicsPart($_974913721['anchor']);
            if (count($_974913721['photos'])) {
                $_988521091 = array_merge($_988521091, $_974913721['photos']);
            }
        }
        foreach ($_988521091 as $_381507178) {
            $_1292708158[] = $_381507178['id'];
        }
        return $_1292708158;
    }

    function GetPhotosPage($_421487420)
    {
        $_267682812 = false;
        $_1892336024 = array('gid' => $this->_1120395184['GROUP'], 'aid' => $_421487420['ID']);
        if ($_421487420['anchor']) {
            $_1892336024['anchor'] = $_421487420['anchor'];
        }
        $_267682812 = \OdnoklassnikiSDK::makeRequest('photos.getPhotos', $_1892336024);
        return $_267682812;
    }

    function UploadPhotosToAlbum($_421487420)
    {
        $_1181927738 = array();
        $_1576593594 = self::UploadPhotos($_421487420['PHOTO'], $_421487420['AID']);
        foreach ($_1576593594['fullinfo'] as $_1673257645 => $_1068716115) {
            $_28148544 = (array)$_1068716115;
            $_1181927738 = self::PhotosCommit(array('ID' => $_1673257645, 'TOKEN' => $_28148544['token'], 'DESCRIPTION' => $_421487420['DESCRIPTION']));
        }
        return $_1181927738;
    }

    function PhotosCommit($_421487420)
    {
        $_82116745 = false;
        $_1892336024 = array('photo_id' => $_421487420['ID'], 'token' => $_421487420['TOKEN'], 'comment' => CAcritExportproplusExternApiTools::PreparePostText($_421487420['DESCRIPTION'], 'UTF-8'));
        $_82116745 = \OdnoklassnikiSDK::makeRequest('photosV2.commit', $_1892336024);
        return $_82116745;
    }

    function AddMarketItem($_421487420, $_477813228 = false)
    {
        $_1939043974 = false;
        $_144497832 = self::PreparePostData($_421487420);
        $_416325036 = (object)array('media' => array());
        $_416325036->_1644018627[] = (object)array('type' => 'text', 'text' => $_144497832['name']);
        $_416325036->_1644018627[] = (object)array('type' => 'text', 'text' => $_144497832['description_market']);
        $_1576593594 = self::UploadPhotos($_144497832['picture']);
        if (!empty($_1576593594)) {
            $_416325036->_1644018627[] = (object)array('type' => 'photo', 'list' => $_1576593594['attach'],);
        }
        $_416325036->_1644018627[] = (object)array('type' => 'product', 'price' => $_144497832['price'], 'currency' => $_144497832['currency']);
        $_1892336024 = array('attachment' => json_encode($_416325036), 'gid' => $this->_1120395184['GROUP'], 'type' => 'GROUP_PRODUCT',);
        if (is_array($_421487420['CATALOGS']) && !empty($_421487420['CATALOGS'])) {
            $_1892336024['catalog_ids'] = implode(',', $_421487420['CATALOGS']);
        }
        if ($_477813228) {
            $_1892336024['product_id'] = $_421487420['ID'];
            $_1939043974 = \OdnoklassnikiSDK::makeRequest('market.edit', $_1892336024);
        } else {
            $_1939043974 = \OdnoklassnikiSDK::makeRequest('market.add', $_1892336024);
        }
        if (isset($_1939043974['error_code'])) {
            $this->_940439577->AddMessage("{$_421487420['NAME']} (ID:{$_421487420['ID']}) : " . str_replace('#OK_ERROR#', 'CODE: ' . $_1939043974['error_msg'], GetMessage('ACRIT_EXPORTPROPLUS_REQUIRED_FIELD_OK_SKIP')));
            $this->_940439577->IncProductError();
        }
        return $_1939043974;
    }

    function DeleteAllMarketItems()
    {
        $_806920492 = false;
        $_1712583162 = self::GetMarketItems();
        if (is_array($_1712583162) && !empty($_1712583162)) {
            foreach ($_1712583162 as $_1468334516) {
                $_806920492 = self::DeleteMarketItem($_1468334516);
            }
        }
        return $_806920492;
    }

    function GetMarketItems()
    {
        $_1712583162 = array();
        $_1753590848 = self::GetMarketItemsPart();
        $_1129373224 = $_1753590848['short_products'];
        while (count($_1753590848['short_products'])) {
            $_1753590848 = self::GetMarketItemsPart($_1753590848['anchor']);
            if (count($_1753590848['short_products'])) {
                $_1129373224 = array_merge($_1129373224, $_1753590848['short_products']);
            }
        }
        foreach ($_1129373224 as $_1611283156) {
            $_1712583162[] = $_1611283156['id'];
        }
        return $_1712583162;
    }

    function GetMarketItemsPart($_1236181728 = false)
    {
        $_432373876 = false;
        $_1892336024 = array('gid' => $this->_1120395184['GROUP'], 'tab' => 'PRODUCTS', 'count' => 10,);
        if ($_1236181728) {
            $_1892336024['anchor'] = $_1236181728;
        }
        $_432373876 = \OdnoklassnikiSDK::makeRequest('market.getProducts', $_1892336024);
        return $_432373876;
    }

    function DeleteMarketItem($_1468334516)
    {
        $_586559802 = false;
        $_1892336024 = array('product_id' => $_1468334516);
        $_586559802 = \OdnoklassnikiSDK::makeRequest('market.delete', $_1892336024);
        if (isset($_586559802['error_code'])) {
            $this->_940439577->AddMessage("(ID:{$_1468334516}) : " . str_replace('#OK_ERROR#', 'CODE: ' . $_586559802['error_msg'], GetMessage('ACRIT_EXPORTPROPLUS_REQUIRED_FIELD_OK_SKIP')));
            $this->_940439577->IncProductError();
        }
        return $_586559802;
    }

    function GetMarketItemsByCatalog($_421129207)
    {
        $_1712583162 = array();
        $_1753590848 = self::GetMarketItemsByCatalogPart();
        $_1129373224 = $_1753590848['short_products'];
        while (count($_1753590848['short_products'])) {
            $_1753590848 = self::GetMarketItemsByCatalogPart($_421129207, $_1753590848['anchor']);
            if (count($_1753590848['short_products'])) {
                $_1129373224 = array_merge($_1129373224, $_1753590848['short_products']);
            }
        }
        foreach ($_1129373224 as $_1611283156) {
            $_1712583162[] = $_1611283156['id'];
        }
        return $_1712583162;
    }

    function GetMarketItemsByCatalogPart($_421129207, $_1236181728 = false)
    {
        $_1521915501 = false;
        $_1892336024 = array('gid' => $this->_1120395184['GROUP'], 'catalog_id' => $_421129207, 'count' => 10,);
        if ($_1236181728) {
            $_1892336024['anchor'] = $_1236181728;
        }
        $_1521915501 = \OdnoklassnikiSDK::makeRequest('market.getByCatalog', $_1892336024);
        return $_1521915501;
    }

    function AddMarketCatalog($_421487420, $_477813228 = false)
    {
        $_292098795 = false;
        $_1576593594 = self::UploadPhotos($_421487420['PHOTO']);
        $_538866776 = (array)$_1576593594['attach'][0];
        $_1892336024 = array('gid' => $this->_1120395184['GROUP'], 'name' => CAcritExportproplusExternApiTools::PreparePostText($_421487420['NAME'], 'UTF-8'), 'photo_id' => $_538866776['id'],);
        if ($_477813228) {
            $_1892336024['catalog_id'] = $_421487420['ID'];
            $_292098795 = \OdnoklassnikiSDK::makeRequest('market.editCatalog', $_1892336024);
        } else {
            $_292098795 = \OdnoklassnikiSDK::makeRequest('market.addCatalog', $_1892336024);
        }
        if (isset($_292098795['error_code'])) {
            $this->_940439577->AddMessage("{$_421487420['NAME']} (ID:{$_421487420['ID']}) : " . str_replace('#OK_ERROR#', 'CODE: ' . $_292098795['error_msg'], GetMessage('ACRIT_EXPORTPROPLUS_REQUIRED_FIELD_OK_SKIP')));
            $this->_940439577->IncProductError();
        }
        return $_292098795;
    }

    function DeleteAllMarketCatalogs()
    {
        $_2107405033 = false;
        $_405984642 = self::GetMarketCatalogsByGroup();
        if (is_array($_405984642) && !empty($_405984642)) {
            foreach ($_405984642 as $_1927656670) {
                $_2107405033 = self::DeleteMarketCatalog($_1927656670);
            }
        }
        return $_2107405033;
    }

    function GetMarketCatalogsByGroup()
    {
        $_405984642 = array();
        $_637323415 = self::GetMarketCatalogsByGroupPart();
        $_1589961069 = $_637323415['catalogs'];
        while (count($_637323415['catalogs'])) {
            $_637323415 = self::GetMarketCatalogsByGroupPart($_637323415['anchor']);
            if (count($_637323415['catalogs'])) {
                $_1589961069 = array_merge($_1589961069, $_637323415['catalogs']);
            }
        }
        foreach ($_1589961069 as $_607850459) {
            $_405984642[] = $_607850459['id'];
        }
        return $_405984642;
    }

    function GetMarketCatalogsByGroupPart($_1236181728 = false)
    {
        $_575396045 = false;
        $_1892336024 = array('gid' => $this->_1120395184['GROUP'], 'count' => 10, 'fields' => 'id');
        if ($_1236181728) {
            $_1892336024['anchor'] = $_1236181728;
        }
        $_575396045 = \OdnoklassnikiSDK::makeRequest('market.getCatalogsByGroup', $_1892336024);
        return $_575396045;
    }

    function DeleteMarketCatalog($_1927656670, $_1453040935 = false)
    {
        $_577061498 = false;
        $_1892336024 = array('gid' => $this->_1120395184['GROUP'], 'catalog_id' => $_1927656670,);
        if ($_1453040935) {
            $_1892336024['delete_products'] = true;
        }
        $_577061498 = \OdnoklassnikiSDK::makeRequest('market.deleteCatalog', $_1892336024);
        if (isset($_577061498['error_code'])) {
            $this->_940439577->AddMessage("(ID:{$_1927656670}) : " . str_replace('#OK_ERROR#', 'CODE: ' . $_577061498['error_msg'], GetMessage('ACRIT_EXPORTPROPLUS_REQUIRED_FIELD_OK_SKIP')));
            $this->_940439577->IncProductError();
        }
        return $_577061498;
    }

    function SetMarketItemCatalogsList($_421487420)
    {
        $_1317318422 = false;
        $_1892336024 = array('gid' => $this->_1120395184['GROUP'], 'product_id' => $_421487420['ID'],);
        if (isset($_421487420['CATALOGS']) && (strlen(trim($_421487420['CATALOGS'])) > 0)) {
            $_1892336024['catalog_ids'] = $_421487420['CATALOGS'];
        }
        $_1317318422 = \OdnoklassnikiSDK::makeRequest('market.updateCatalogsList', $_1892336024);
        return $_1317318422;
    }
}

class CAcritExportproplusInstagram
{
    public $profile = null;
    public $_1730079280 = null;
    public $_685758188 = null;
    public $_27821683 = null;
    public $_940439577;
    public $dbRes = null;

    public function __construct($profile)
    {
        $this->dbRes = new CExportproplusProfileDB();
        $this->_1717979731 = @CModule::IncludeModule('iblock');
        $this->profile = $profile;
        $this->_1730079280 = self::GetAccessAccountData();
        $this->_685758188 = self::GenerateGuid();
        $this->_27821683 = 'android-' . $this->_685758188;
        $this->_940439577 = new CAcritExportproplusLog($this->profile['ID']);
    }

    public function GetAccessAccountData()
    {
        $_1653488833 = array("LOGIN" => $this->profile["INSTAGRAM"]["INSTAGRAM_LOGIN"], "PASSWORD" => $this->profile["INSTAGRAM"]["INSTAGRAM_PASSWORD"],);
        return $_1653488833;
    }

    public function GenerateGuid()
    {
        return sprintf("%04x%04x-%04x-%04x-%04x-%04x%04x%04x", mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(16384, 20479), mt_rand(32768, 49151), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535));
    }

    public function AddPhoto($_421487420)
    {
        $_1548575078 = false;
        $_632876101 = is_array($_421487420['PHOTO']) && !empty($_421487420['PHOTO']);
        if (((strlen($_421487420['PHOTO']) > 0) || $_632876101) && (strlen($_421487420['DESCRIPTION']) > 0) && self::Login()) {
            if ($_632876101) {
                $_303541024 = array();
                foreach ($_421487420['PHOTO'] as $_1819348880) {
                    $_1819348880 = self::GetSquareImage($_1819348880);
                    $data = self::GetPostData($_1819348880);
                    $_303541024[] = self::ApiMethod('media/upload/', $data, 3);
                }
                $_1913374605 = array();
                if (is_array($_303541024) && !empty($_303541024)) {
                    foreach ($_303541024 as $_1964409291) {
                        if (empty($_1964409291)) {
                            $_1436318387 = 'Empty response received from the server while trying to post the image';
                        } else {
                            $_2137625708 = @json_decode($_1964409291, true);
                            if (empty($_2137625708)) {
                                $_1436318387 = 'Could not decode the response';
                            } else {
                                $_479845416 = $_2137625708['status'];
                                if ($_479845416 != 'ok') {
                                    $_1436318387 = "Status isn't okay";
                                } else {
                                    $_1913374605[] = $_2137625708['media_id'];
                                }
                            }
                        }
                    }
                }
                if (is_array($_1913374605) && !empty($_1913374605)) {
                    $_421487420['DESCRIPTION'] = strip_tags($_421487420['DESCRIPTION']);
                    $_1155109198 = CAcritExportproplusTools::GetStringCharset($_421487420['DESCRIPTION']);
                    if ($_1155109198 == 'cp1251') {
                        $_421487420['DESCRIPTION'] = $GLOBALS['APPLICATION']->ConvertCharset($_421487420['DESCRIPTION'], 'windows-1251', 'UTF-8');
                    }
                    $data = (object)array('device_id' => $this->_27821683, 'guid' => $this->_685758188, 'media_id' => $_1913374605[0], 'caption' => html_entity_decode(trim($_421487420['DESCRIPTION'])), 'device_timestamp' => time(), 'source_type' => '5', 'filter_type' => '0', 'extra' => '{}', 'Content-Type' => 'application/x-www-form-urlencoded; charset=UTF-8',);
                    $data = json_encode($data);
                    $_471527411 = self::GenerateSignature($data);
                    $_327967743 = 'signed_body=' . $_471527411 . '.' . urlencode($data) . '&ig_sig_key_version=4';
                    $_1548575078 = self::ApiMethod('media/configure/', $_327967743, 3);
                }
            } else {
                $_421487420['PHOTO'] = self::GetSquareImage($_421487420['PHOTO']);
                $data = self::GetPostData($_421487420['PHOTO']);
                $_1964409291 = self::ApiMethod('media/upload/', $data, 3);
                if (empty($_1964409291)) {
                    $_1436318387 = 'Empty response received from the server while trying to post the image';
                } else {
                    $_2137625708 = @json_decode($_1964409291, true);
                    if (empty($_2137625708)) {
                        $_1436318387 = 'Could not decode the response';
                    } else {
                        $_479845416 = $_2137625708['status'];
                        if ($_479845416 != 'ok') {
                            $_1436318387 = "Status isn't okay";
                        } else {
                            $_1772650701 = $_2137625708['media_id'];
                            $_421487420['DESCRIPTION'] = strip_tags($_421487420['DESCRIPTION']);
                            $_1155109198 = CAcritExportproplusTools::GetStringCharset($_421487420['DESCRIPTION']);
                            if ($_1155109198 == 'cp1251') {
                                $_421487420['DESCRIPTION'] = $GLOBALS['APPLICATION']->ConvertCharset($_421487420['DESCRIPTION'], 'windows-1251', 'UTF-8');
                            }
                            $data = (object)array('device_id' => $this->_27821683, 'guid' => $this->_685758188, 'media_id' => $_1772650701, 'caption' => html_entity_decode(trim($_421487420['DESCRIPTION'])), 'device_timestamp' => time(), 'source_type' => '5', 'filter_type' => '0', 'extra' => '{}', 'Content-Type' => 'application/x-www-form-urlencoded; charset=UTF-8',);
                            $data = json_encode($data);
                            $_471527411 = self::GenerateSignature($data);
                            $_327967743 = 'signed_body=' . $_471527411 . '.' . urlencode($data) . '&ig_sig_key_version=4';
                            $_1548575078 = self::ApiMethod('media/configure/', $_327967743, 3);
                        }
                    }
                }
            }
        }
        return $_1548575078;
    }

    public function Login()
    {
        $_555782255 = true;
        $data = ( object )array('device_id' => $this->_27821683, 'guid' => $this->_685758188, 'username' => $this->_1730079280['LOGIN'], 'password' => $this->_1730079280['PASSWORD'], 'Content-Type' => 'application/x-www-form-urlencoded; charset=UTF-8',);
        $data = json_encode($data);
        $_471527411 = self::GenerateSignature($data);
        $data = 'signed_body=' . $_471527411 . '.' . urlencode($data) . '&ig_sig_key_version=4';
        $_1492428343 = self::ApiMethod('accounts/login/', $data, 2);
        if (strpos($_1492428343, 'Sorry, an error occurred while processing this request.')) {
            $_1436318387 = "Request failed, there's a chance that this proxy/ip is blocked";
            $_555782255 = false;
        } else {
            if (empty($_1492428343)) {
                $_1436318387 = 'Empty response received from the server while trying to login';
                $_555782255 = false;
            } else {
                $_319973595 = @json_decode($_1492428343, true);
                if (empty($_319973595)) {
                    $_1436318387 = 'Could not decode the response';
                    $_555782255 = false;
                }
            }
        }
        return $_555782255;
    }

    function GenerateSignature($data)
    {
        return hash_hmac('sha256', $data, 'b4a23f5e39b5929e0666ac5de94c89d1618a2916');
    }

    public function ApiMethod($_1604926397, $data, $_1156711538)
    {
        $return = false;
        if ($_1604926397 != '') {
            $_1468923083 = 'https://instagram.com/api/v1/' . $_1604926397;
            $return = self::_curl_post($_1468923083, $data, array($_1156711538, 'instagram'), self::GenerateUserAgent());
        }
        return $return;
    }

    function _curl_post($_1468923083, $_185069423, $_2101356360 = "", $_227984032 = false, $_1207089515 = 120)
    {
        $_1104710553 = array();
        if (is_array($_2101356360)) {
            $_1104710553['cookie_type'] = $_2101356360[0] ?: $_2101356360['type'];
            $_1104710553['cookie_postfix'] = $_2101356360[1] ?: $_2101356360['postfix'];
            $_1104710553['cookies'] = $_2101356360['cookies'];
        } elseif (!empty($_2101356360)) {
            $_1104710553['cookie_type'] = 1;
            $_1104710553['cookie_postfix'] = $_2101356360;
        }
        $_1104710553['user_agent'] = $_227984032;
        $_1104710553['timeout'] = $_1207089515;
        return self::curl_post($_1468923083, $_185069423, $_1104710553);
    }

    function curl_post($_1468923083, $_185069423, $_1104710553 = array())
    {
        if ($_1468923083 == '') {
            return false;
        }
        $_432578689 = strpos($_1468923083, 'https') === 0;
        if (is_array($_2101356360)) {
            $_373495925 = $_2101356360[0];
            $_2101356360 = $_2101356360[1];
        } else {
            $_373495925 = (empty($_2101356360) ? 0 : 1);
        }
        $_1213592343 = $_SERVER['DOCUMENT_ROOT'] . '/upload/acrit.exportproplus/';
        if ($_1104710553['cookie_type'] and (is_dir($_1213592343) or mkdir($_1213592343, 484, true))) {
            if (empty($_1104710553['cookie_postfix'])) {
                $_1213592343 .= 'cookies.txt';
            } else {
                $_1213592343 .= 'cookies_' . $_1104710553['cookie_postfix'] . '.txt';
            }
        } else {
            $_1213592343 .= 'cookies.txt';
        }
        $_747955019 = curl_init($_1468923083);
        if ($_1104710553['CUSTOM_REQUEST']) {
            curl_setopt($_747955019, CURLOPT_CUSTOMREQUEST, $_1104710553['CUSTOM_REQUEST']);
        }
        curl_setopt($_747955019, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($_747955019, CURLOPT_FOLLOWLOCATION, true);
        if (!!$_1104710553['user_agent']) {
            curl_setopt($_747955019, CURLOPT_USERAGENT, $_1104710553['user_agent']);
        }
        if ($_1104710553['cookie_type'] == 1) {
            curl_setopt($_747955019, CURLOPT_COOKIEFILE, $_1213592343);
            curl_setopt($_747955019, CURLOPT_COOKIEJAR, $_1213592343);
        } elseif ($_1104710553['cookie_type'] == 2) {
            curl_setopt($_747955019, CURLOPT_COOKIEJAR, $_1213592343);
        } elseif ($_1104710553['cookie_type'] == 3) {
            curl_setopt($_747955019, CURLOPT_COOKIEFILE, $_1213592343);
        }
        curl_setopt($_747955019, CURLOPT_COOKIEFILE, $_1213592343);
        if ($_432578689) {
            curl_setopt($_747955019, CURLOPT_SSL_VERIFYPEER, 0);
            curl_setopt($_747955019, CURLOPT_SSL_VERIFYHOST, 0);
        }
        if (!empty($_185069423)) {
            if (!$_1104710553['CUSTOM_REQUEST'] or $_1104710553['CUSTOM_REQUEST'] == 'POST') curl_setopt($_747955019, CURLOPT_POST, true);
            if (isset($_1104710553['enctype']) && $_1104710553['enctype'] == CURL_ENCTYPE_APPLICATION) {
                $_185069423 = http_build_query($_185069423);
                curl_setopt($_747955019, CURLOPT_HTTPHEADER, array('Content-Length: ' . strlen($_185069423)));
            }
            curl_setopt($_747955019, CURLOPT_POSTFIELDS, $_185069423);
        }
        curl_setopt($_747955019, CURLOPT_TIMEOUT, $_1104710553['timeout']);
        $_545370521 = curl_exec($_747955019);
        curl_close($_747955019);
        return $_545370521;
    }

    public function GenerateUserAgent()
    {
        $_996610565 = array("720x1280", "320x480", "480x800", "1024x768", "1280x720", "768x1024", "480x320");
        $_677037493 = array('GT-N7000', 'SM-N9000', 'GT-I9220', 'GT-I9100');
        $_1468970454 = array('120', '160', '320', '240');
        $_2110582110 = $_677037493[array_rand($_677037493)];
        $_1095035488 = $_1468970454[array_rand($_1468970454)];
        $_545370521 = $_996610565[array_rand($_996610565)];
        return 'Instagram 4.' . mt_rand(1, 2) . '.' . mt_rand(0, 2) . ' Android (' . mt_rand(10, 11) . '/' . mt_rand(1, 3) . '.' . mt_rand(3, 5) . '.' . mt_rand(0, 5) . '; ' . $_1095035488 . '; ' . $_545370521 . '; samsung; ' . $_2110582110 . '; ' . $_2110582110 . '; smdkc210; en_US)';
    }

    function GetSquareImage($_1541629110)
    {
        if (empty($_1541629110)) {
            return '';
        }
        list($_158562207, $_475265965, $_1823271951) = getimagesize($_1541629110);
        if ($_158562207 == $_475265965) {
            return $_1541629110;
        }
        $_920926723 = array('', 'gif', 'jpeg', 'png');
        $_1637617362 = $_920926723[$_1823271951];
        if ($_1637617362) {
            $_1240359204 = 'imagecreatefrom' . $_1637617362;
            $_703889604 = $_1240359204($_1541629110);
        } else {
            return '';
        }
        $_1462485727 = min($_158562207, $_475265965);
        $_532462871 = 0;
        if ($_1462485727 != $_158562207) {
            $_532462871 = $_158562207 / 2 - $_1462485727 / 2;
        }
        $_844345300 = imagecreatetruecolor($_1462485727, $_1462485727);
        imagecopy($_844345300, $_703889604, 0, 0, $_532462871, 0, $_1462485727, $_1462485727);
        $_1218758811 = self::GetImagePathTmp();
        if ($type == 2) {
            if (imagejpeg($_844345300, $_1218758811, 100)) {
                return $_1218758811;
            }
        } else {
            $_1240359204 = 'image' . $_1637617362;
            if ($_1240359204($_844345300, $_1218758811)) {
                return $_1218758811;
            }
        }
        return '';
    }

    function GetImagePathTmp()
    {
        return $_SERVER['DOCUMENT_ROOT'] . '/upload/tmp/acrit.exportproplus.instagram.image.tmp.jpg';
    }

    function GetPostData($_2120721791)
    {
        if (!$_2120721791) {
            echo "The image doesn't exist " . $_2120721791;
        } else {
            $_185069423 = array('device_timestamp' => time(), 'photo' => CAcritExportproplusExternApiTools::GetCurlFilename($_2120721791));
            return $_185069423;
        }
    }

    public function UpdatePhoto($_421487420)
    {
        $_2005030324 = false;
        global $APPLICATION;
        if ((intval($_421487420['POST_ID']) > 0) && (strlen($_421487420['DESCRIPTION']) > 0) && self::Login()) {
            $_421487420['DESCRIPTION'] = strip_tags($_421487420['DESCRIPTION']);
            $_1155109198 = CAcritExportproplusTools::GetStringCharset($_421487420['DESCRIPTION']);
            if ($_1155109198 == 'cp1251') {
                $_421487420['DESCRIPTION'] = $APPLICATION->ConvertCharset($_421487420['DESCRIPTION'], 'windows-1251', 'UTF-8');
            }
            $data = ( object )array('device_id' => $this->_27821683, 'guid' => $this->_685758188, 'caption_text' => html_entity_decode(trim($_421487420['DESCRIPTION'])), 'device_timestamp' => time(), 'Content-Type' => 'application/x-www-form-urlencoded; charset=UTF-8',);
            $data = json_encode($data);
            $_471527411 = self::GenerateSignature($data);
            $data = 'signed_body=' . $_471527411 . '.' . urlencode($data) . '&ig_sig_key_version=4';
            $_2005030324 = self::ApiMethod('media/' . $_421487420['POST_ID'] . '/edit_media/', $data, 3);
        }
        return $_2005030324;
    }

    public function DeletePhoto($_421487420)
    {
        $_761849752 = false;
        if ((intval($_421487420['POST_ID']) > 0) && self::Login()) {
            $data = ( object )array('device_id' => $this->_27821683, 'guid' => $this->_685758188, 'media_id' => $_421487420['POST_ID'], 'device_timestamp' => time(), 'Content-Type' => 'application/x-www-form-urlencoded; charset=UTF-8',);
            $data = json_encode($data);
            $_471527411 = self::GenerateSignature($data);
            $data = 'signed_body=' . $_471527411 . '.' . urlencode($data) . '&ig_sig_key_version=4';
            $_761849752 = self::ApiMethod('media/' . $_421487420['POST_ID'] . '/delete/?media_type=1', $data, 3);
        }
        return $_761849752;
    }
}

?>