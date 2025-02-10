<?php
/*
\Web\Session
*/
namespace Web;

class Session
{
    //-----TIMER
    const TIMER                 = 'TIMER';
    //-----MODULE
    const MODULE_CONFIG         = 'MODULE_CONFIG';
    //-----WEB_CONFIG
    const SYSTEM_CONFIG         = 'SYSTEM_CONFIG';
    //-----WEB_CONFIG
    const WEB_CONFIG            = 'WEB_CONFIG';
    const WEB_COMPONENT         = 'WEB_COMPONENT';
    const WEB_PLUGINS           = 'WEB_PLUGINS';
    const WEB_PAGE_ITEM         = 'WEB_PAGE_ITEM';
    //-----CAPTCHA
    const CAPTCHA               = 'CAPTCHA';
    //-----LANG
    const TRANSLATE             = 'TRANSLATE';
    //-----CURRENCY
    const CURRENCY              = 'CURRENCY';
    //-----USER
    const USER                  = 'USER';
    const USER_ROLE             = 'USER_ROLE';
    const USER_STATUS           = 'USER_STATUS';
    const USER_REGISTER         = 'USER_REGISTER';
    const USER_AUTO_LOGIN       = 'USER_AUTO_LOGIN';
    //-----AUTH
    const AUTH                  = 'AUTH'; // auth, auth_register
    //-----DB
    const DB_ADAPTER            = 'DB_ADAPTER';
    const DB_PREFIX             = 'DB_PREFIX';
    //-----TIME
    const TIMEZONE              = 'TIMEZONE';
    //-----IP LOCATION
    const IP_LOCATION           = 'IP_LOCATION';
    const IP_LOCATION_ROW       = 'IP_LOCATION_ROW';
    //-----LOCALE
    const LOCALE                = 'LOCALE';
    const LOCALE_OPTIONS        = 'LOCALE_OPTIONS';
    //-----LANG
    const TRANSLATION           = 'TRANSLATION'; //OBJECT
    const LANGUAGE              = 'LANGUAGE';
    const LANGUAGE_WORD         = 'LANGUAGE_WORD'; //GLOBAL + MODULE
    const LANGUAGE_WORD_GLOBAL  = 'LANGUAGE_WORD_GLOBAL'; //GLOBAL
    const LANGUAGE_WORD_MODULE  = 'LANGUAGE_WORD_MODULE'; //MODULE
    //-----ROLE
    const ROLE                  = 'ROLE';
    //-----TEMPLATES
    const TEMPLATES             = 'TEMPLATES';
    //-----THEME
    const THEME                 = 'THEME';
    //-----THEME - BACKGROUND
    const THEME_BG              = 'THEME_BG';
    //-----THEME - CSS - BOOTSTRAP...etc
    const THEME_CSS             = 'THEME_CSS';
    
    //-------------------------TEMP
    //-----BREADCRUMB
    const BREADCRUMB            = 'BREADCRUMB';    
    const BREADCRUMB_PAGE       = 'BREADCRUMB_PAGE';    
    
    //-----ALERT
    const XS_ALERT               = 'XS_ALERT';
    const XS_ALERT_INFO          = 'XS_ALERT_INFO';
    const XS_ALERT_SUCCESS       = 'XS_ALERT_SUCCESS';
    const XS_ALERT_ERROR         = 'XS_ALERT_ERROR';
    const XS_ALERT_WARNING       = 'XS_ALERT_WARNING';
    const XS_ALERT_EXCEPTION     = 'XS_ALERT_EXCEPTION';
    
    //-----MODAL
    const MODAL               = 'MODAL';
    const MODAL_INFO          = 'MODAL_INFO';
    const MODAL_SUCCESS       = 'MODAL_SUCCESS';
    const MODAL_ERROR         = 'MODAL_ERROR';
    const MODAL_WARNING       = 'MODAL_WARNING';
    const MODAL_EXCEPTION     = 'MODAL_EXCEPTION';
    const MODAL_TARGET        = 'MODAL_TARGET';
    const MODAL_TARGET_MESSAGE = 'MODAL_TARGET_MESSAGE';
    
    //-----BTN
    const BTN               = 'BTN';
    const BTN_INFO          = 'BTN_INFO';
    const BTN_SUCCESS       = 'BTN_SUCCESS';
    const BTN_ERROR         = 'BTN_ERROR';
    const BTN_WARNING       = 'BTN_WARNING';
    const BTN_EXCEPTION     = 'BTN_EXCEPTION';
    const BTN_TARGET        = 'BTN_TARGET';
    const BTN_TARGET_TRIGGER = 'BTN_TARGET_TRIGGER';
    
    //-----ALERT
    const ALERT               = 'ALERT';
    const ALERT_INFO          = 'ALERT_INFO';
    const ALERT_SUCCESS       = 'ALERT_SUCCESS';
    const ALERT_ERROR         = 'ALERT_ERROR';
    const ALERT_WARNING       = 'ALERT_WARNING';
    const ALERT_EXCEPTION     = 'ALERT_EXCEPTION';
    
    //-----ALERT2
    const ALERT2               = 'ALERT2';
    const ALERT2_INFO          = 'ALERT2_INFO';
    const ALERT2_SUCCESS       = 'ALERT2_SUCCESS';
    const ALERT2_ERROR         = 'ALERT2_ERROR';
    const ALERT2_WARNING       = 'ALERT2_WARNING';
    const ALERT2_EXCEPTION     = 'ALERT2_EXCEPTION';
    
    //-----MESSAGE
    const MESSAGE               = 'MESSAGE';
    const MESSAGE_INFO          = 'MESSAGE_INFO';
    const MESSAGE_SUCCESS       = 'MESSAGE_SUCCESS';
    const MESSAGE_ERROR         = 'MESSAGE_ERROR';
    const MESSAGE_WARNING       = 'MESSAGE_WARNING';
    const MESSAGE_EXCEPTION     = 'MESSAGE_EXCEPTION';
    
    //-----DIALOG
    const DIALOG                = 'DIALOG';
    const DIALOG_INFO           = 'DIALOG_INFO';
    const DIALOG_SUCCESS        = 'DIALOG_SUCCESS';
    const DIALOG_ERROR          = 'DIALOG_ERROR';
    const DIALOG_WARNING        = 'DIALOG_WARNING';
    
    //-----SCOPE
    const SCOPE_PAGE            = 'SCOPE_PAGE';
    const SCOPE_APPLICATION     = 'SCOPE_APPLICATION';
    
    //-----TOKEN
    const TOKEN                 = 'TOKEN';
    
    //-----TOKEN
    const TOKEN_API             = 'TOKEN_API';
    
    //-----ROUTE
    const ROUTE_BACK            = 'ROUTE_BACK';
    const ROUTE_HISTORY         = 'ROUTE_HISTORY';
    
    //-----URL BACK
    const CLICK_LOGIN_BTN = 'CLICK_LOGIN_BTN';
    const CLICK_OAUTH_LOGIN_BTN = 'CLICK_OAUTH_LOGIN_BTN';
    
    //-----URL BACK
    const URL_BACK              = 'URL_BACK';
    
    //-----ADMIN 
    const ADMIN                 = 'ADMIN';
    const ADMIN_USER            = 'ADMIN_USER';
    
    //-----SCHOOL 
    const SCHOOL                 = 'SCHOOL';
    
    //-----WEB 
    const WEB                 = 'WEB';
    const WEB_ID              = 'WEB_ID';
    const WEB_DOMAIN          = 'WEB_DOMAIN';
    const WEB_HOST            = 'WEB_HOST';
    const WEB_USER            = 'WEB_USER';
    const WEB_PLAN            = 'WEB_PLAN';
    const WEB_COMPANY         = 'WEB_COMPANY';
    
    //-----DATA
    const DATA_DOMAIN            = 'DATA_DOMAIN';
    
    //-----CUSTOMER 
    const CUSTOMER               = 'CUSTOMER';
    
    //-----BOTTOM_LINK 
    const BOTTOM_LINK                 = 'BOTTOM_LINK';
    const BOTTOM_COMMENTS             = 'BOTTOM_COMMENTS';
    const BOTTOM_TEACHERS             = 'BOTTOM_TEACHERS';
    
    //-----STUDENT 
    const STUDENT_FIELD             = 'STUDENT_FIELD';
    
    //-----NAV 
    const NAV_AFTER_OAUTH_LOGIN     = 'NAV_AFTER_OAUTH_LOGIN';
    const NAV_AFTER_PAYMENT_FOR_COURSE     = 'NAV_AFTER_PAYMENT_FOR_COURSE';
    
    //-----GLOBAL_SETTING 
    const GLOBAL_SETTING             = 'GLOBAL_SETTING';
    
    
    public static $prefix = 'MEMOO_';
    public static $di = null;
    
    public static function init($di, $options=array())
    {
        //INIT DI
        self::$di = $di;

        //INIT PREFIX
        if(isset($options['prefix'])){
            self::$prefix = $options['prefix'];
        }
    }

    /*
    
    產生NAMESPACE用途的SESSION物件, 方便分隔各類SESSION資料
    This component helps to separate session data into “namespaces”. Working by this way you can easily create groups
    of session variables into the application
    
    */
    public static function factory($session_key=null)
    {
        $session_key = self::buildSessionKey($session_key);
        // _test($_SESSION[$session_key]);
        // if(empty($_SESSION[$session_key])){
        //     $_SESSION[$session_key] = new stdClass();
        // }
        $session = &$_SESSION[$session_key]??null;
        return $session;
    }
    
    /*
    
    TEMPLATES
    
    */
    public static function setTemplates($arg0=null, $arg1=null)
    {
        $session = self::_setData(self::TEMPLATES, $arg0, $arg1);
        return $session;
    }
    public static function getTemplates($key=null)
    {
        return self::_getData(self::TEMPLATES, $key);
    }
    
    /*
    
    第三方登入完後導頁
    
    */
    public static function setNavAfterOAuthLogin($arg0=null, $arg1=null)
    {
        $session = self::_setData(self::NAV_AFTER_OAUTH_LOGIN, $arg0, $arg1);
        return $session;
    }
    public static function getNavAfterOAuthLogin($key=null)
    {
        return self::_getData(self::NAV_AFTER_OAUTH_LOGIN, $key);
    }
    public static function clearNavAfterOAuthLogin()
    {
        return self::_clearData(self::NAV_AFTER_OAUTH_LOGIN);
    }
    
    /*
    NOUSE
    課程結帳完後導頁
    
    */
    public static function setNavAfterPaymentForCourse($arg0=null, $arg1=null)
    {
        $session = self::_setData(self::NAV_AFTER_PAYMENT_FOR_COURSE, $arg0, $arg1);
        return $session;
    }
    public static function getNavAfterPaymentForCourse($key=null)
    {
        return self::_getData(self::NAV_AFTER_PAYMENT_FOR_COURSE, $key);
    }
    public static function clearNavAfterPaymentForCourse()
    {
        return self::_clearData(self::NAV_AFTER_PAYMENT_FOR_COURSE);
    }
    public static function triggerNavAfterPaymentForCourse()
    {
        $url = self::getNavAfterPaymentForCourse();
        if($url){
            self::clearNavAfterPaymentForCourse();
            header("Location:{$url}");
        }
    }
    
    /*
    
    BOTTOM_LINK
    
    */
    public static function setBottomLink($arg0=null, $arg1=null)
    {
        $session = self::_setData(self::BOTTOM_LINK, $arg0, $arg1);
        return $session;
    }
    public static function getBottomLink($key=null)
    {
        return self::_getData(self::BOTTOM_LINK, $key);
    }
    public static function clearBottomLink()
    {
        return self::_clearData(self::BOTTOM_LINK);
    }
    
    /*
    
    BOTTOM_COMMENTS
    
    */
    public static function setBottomComments($arg0=null, $arg1=null)
    {
        $session = self::_setData(self::BOTTOM_COMMENTS, $arg0, $arg1);
        return $session;
    }
    public static function getBottomComments($key=null)
    {
        return self::_getData(self::BOTTOM_COMMENTS, $key);
    }
    public static function clearBottomComments()
    {
        return self::_clearData(self::BOTTOM_COMMENTS);
    }
    
    /*
    
    BOTTOM_TEACHERS
    
    */
    public static function setBottomTeachers($arg0=null, $arg1=null)
    {
        $session = self::_setData(self::BOTTOM_TEACHERS, $arg0, $arg1);
        return $session;
    }
    public static function getBottomTeachers($key=null)
    {
        return self::_getData(self::BOTTOM_TEACHERS, $key);
    }
    public static function clearBottomTeachers()
    {
        return self::_clearData(self::BOTTOM_TEACHERS);
    }
    
    /*
    
    STUDENT_FIELD
    
    */
    public static function setStudentField($arg0=null, $arg1=null)
    {
        $session = self::_setData(self::STUDENT_FIELD, $arg0, $arg1);
        return $session;
    }
    public static function getStudentField($key=null)
    {
        return self::_getData(self::STUDENT_FIELD, $key);
    }
    public static function clearStudentField()
    {
        return self::_clearData(self::STUDENT_FIELD);
    }
    
    /*
    
    THEME
    
    */
    public static function setTheme($arg0=null, $arg1=null)
    {
        $session = self::_setData(self::THEME, $arg0, $arg1);
        return $session;
    }
    public static function getTheme($key=null)
    {
        return self::_getData(self::THEME, $key);
    }
    
    /*
    
    LANGUAGE
    
    */
    public static function setTranslation($arg0=null, $arg1=null)
    {
        $session = self::_setData(self::TRANSLATION, $arg0, $arg1);
        return $session;
    }
    public static function getTranslation($key=null)
    {
        return self::_getData(self::TRANSLATION, $key);
    }
    public static function setLanguage($arg0=null, $arg1=null)
    {
        $session = self::_setData(self::LANGUAGE, $arg0, $arg1);
        return $session;
    }
    public static function getLanguage($key=null)
    {
        return self::_getData(self::LANGUAGE, $key);
    }
    public static function setLanguageWord($arg0=null, $arg1=null)
    {
        $session = self::_setData(self::LANGUAGE_WORD, $arg0, $arg1);
        return $session;
    }
    public static function getLanguageWord($key=null)
    {
        return self::_getData(self::LANGUAGE_WORD, $key);
    }
    public static function setLanguageWordForGlobal($arg0=null, $arg1=null)
    {
        $session = self::_setData(self::LANGUAGE_WORD_GLOBAL, $arg0, $arg1);
        return $session;
    }
    public static function getLanguageWordForGlobal($key=null)
    {
        return self::_getData(self::LANGUAGE_WORD_GLOBAL, $key);
    }
    public static function setLanguageWordForModule($moduleName='', $arg0=null, $arg1=null)
    {
        $session = self::_setData(self::LANGUAGE_WORD_MODULE.$moduleName, $arg0, $arg1);
        return $session;
    }
    public static function getLanguageWordForModule($moduleName='', $key=null)
    {
        return self::_getData(self::LANGUAGE_WORD_MODULE.$moduleName, $key);
    }
    /*
    
    LOCALE
    
    */
    public static function setLocaleOptions($arg0=null, $arg1=null)
    {
        $session = self::_setData(self::LOCALE_OPTIONS, $arg0, $arg1);
        return $session;
    }
    public static function getLocaleOptions($key = '')
    {
        return self::_getData(self::LOCALE_OPTIONS, $key);
    }
    public static function setLocale($arg0=null, $arg1=null)
    {
        $session = self::_setData(self::LOCALE, $arg0, $arg1);
        return $session;
    }
    public static function getLocale($key=null)
    {
        return self::_getData(self::LOCALE, $key);
    }
    public static function setCurrency($arg0=null, $arg1=null)
    {
        $session = self::_setData(self::CURRENCY, $arg0, $arg1);
        return $session;
    }
    public static function getCurrency($key=null)
    {
        return self::_getData(self::CURRENCY, $key);
    }
    public static function setIpLocationRow($arg0=null, $arg1=null)
    {
        $session = self::_setData(self::IP_LOCATION_ROW, $arg0, $arg1);
        return $session;
    }
    public static function getIpLocationRow($key=null)
    {
        return self::_getData(self::IP_LOCATION_ROW, $key);
    }
    public static function setIpLocation($arg0=null, $arg1=null)
    {
        $session = self::_setData(self::IP_LOCATION, $arg0, $arg1);
        return $session;
    }
    public static function getIpLocation($key=null)
    {
        return self::_getData(self::IP_LOCATION, $key);
    }
    
    /*
    
    SYSTEM CONFIG
    
    */
    public static function getSystemConfig($key=null)
    {
        $session = self::factory(self::SYSTEM_CONFIG);
        return self::_get($session, $key);
    }

    public static function setSystemConfig($arg0=null, $arg1=null)
    {
        $session = self::factory(self::SYSTEM_CONFIG);
        $session = self::_set($session, $arg0, $arg1);
        return true;
    }
    
    /*
    
    WEB CONFIG
    
    */
    public static function getWebConfig($key=null)
    {
        $session = self::factory(self::WEB_CONFIG);
        return self::_get($session, $key);
    }

    public static function setWebConfig($arg0=null, $arg1=null)
    {
        $session = self::factory(self::WEB_CONFIG);
        $session = self::_set($session, $arg0, $arg1);
        return true;
    }

    /*
    
    TOKEN
    
    */
    public static function setToken($arg0=null, $arg1=null)
    {
        $session = self::_setData(self::TOKEN, $arg0, $arg1);
        return $session;
    }
    public static function getToken($key = '')
    {
        return self::_getData(self::TOKEN, $key);
    }
    public static function clearToken()
    {
        return self::_clearData(self::TOKEN);
    }
    public static function factoryNewToken()
    {
        self::clearToken();
        $data = md5(uniqid().microtime(true));
        self::setToken($data);
        return $data;
    }
    
    /*
    
    登入後自動跳轉的URL
    
    */
    public static function setClickLoginBtn($arg0=null, $arg1=null)
    {
        $session = self::_setData(self::CLICK_LOGIN_BTN, $arg0, $arg1);
        return $session;
    }
    public static function getClickLoginBtn($key = '')
    {
        $session = self::_getData(self::CLICK_LOGIN_BTN, $key);
        return $session;
    }
    public static function clearClickLoginBtn()
    {
        return self::_clearData(self::CLICK_LOGIN_BTN);
    }
    
    /*
    
    登入後自動跳轉的URL
    
    */
    public static function setClickOAuthLoginBtn($arg0=null, $arg1=null)
    {
        $session = self::_setData(self::CLICK_OAUTH_LOGIN_BTN, $arg0, $arg1);
        return $session;
    }
    public static function getClickOAuthLoginBtn($key = '')
    {
        $session = self::_getData(self::CLICK_OAUTH_LOGIN_BTN, $key);
        return $session;
    }
    public static function clearClickOAuthLoginBtn()
    {
        return self::_clearData(self::CLICK_OAUTH_LOGIN_BTN);
    }
    
    /*
    
    ROUTE_BACK
    
    */
    public static function setUrlBack($arg0=null, $arg1=null)
    {
        $session = self::_setData(self::URL_BACK, $arg0, $arg1);
        return $session;
    }
    public static function getUrlBack($key = '')
    {
        $session = self::_getData(self::URL_BACK, $key);
        return $session;
    }
    public static function clearUrlBack()
    {
        return self::_clearData(self::URL_BACK);
    }
    
    /*
    
    ROUTE_BACK
    
    */
    public static function setRouteBack($arg0=null, $arg1=null)
    {
        $session = self::factory(self::ROUTE_BACK);
        $session = self::_set($session, $arg0, $arg1);
        return true;
    }
    public static function getRouteBack($key = '')
    {
        $session = self::factory(self::ROUTE_BACK);
        return self::_get($session, $key);
    }
    public static function clearRouteBack()
    {
        return self::_clearData(self::ROUTE_BACK);
    }

    /*
    
    ROUTE_HISTORY
    
    */
    public static function setRouteHistory($arg0=null, $arg1=null)
    {
        $session = self::_setData(self::ROUTE_HISTORY, $arg0, $arg1);
        return $session;
    }
    public static function getRouteHistory($key = '')
    {
        return self::_getData(self::ROUTE_HISTORY, $key);
    }
    public static function clearRouteHistory()
    {
        return self::_clearData(self::ROUTE_HISTORY);
    }


    
    /*
    
    SCOPE PAGE
    
    */
    public static function setScopePage($arg0=null, $arg1=null)
    {
        $session = self::_set(self::SCOPE_PAGE, $arg0, $arg1);
        return $session;
    }
    public static function getScopePage($key = '')
    {
        return self::_get(self::SCOPE_PAGE, $key);
    }
    public static function clearScopePage()
    {
        return self::_clearData(self::SCOPE_PAGE);
    }

    /*
    
    @params $expire = 3600
    */
    public static function isTimerExpired($expire = '')
    {
        if($expire == ''){
            $expire = C('OPTIONS')['expire'];
        }
        $is = ((time() - session('session_start_time')) > (int)$expire);
        return $is;
    }
    public static function setTimer($arg0=null, $arg1=null)
    {
        // SET TO DI 
        // if(is_array($arg0)){
        //     $di = \Web\DI::getDefault();
        //     $di->set('auth', $arg0);
        // }
        return self::_setData(self::TIMER, $arg0, $arg1);
    }
    public static function getTimer($key = '')
    {
        return self::_getData(self::TIMER, $key);
    }
    public static function clearTimer()
    {
        return self::_clearData(self::TIMER);
    }

    /*
    
    USER
    
    */
    public static function setAuthData($arg0=null, $arg1=null)
    {
        // SET TO DI 
        // if(is_array($arg0)){
        //     $di = \Web\DI::getDefault();
        //     $di->set('auth', $arg0);
        // }
        return self::_setData(self::AUTH, $arg0, $arg1);
    }
    public static function getAuthData($key = '')
    {
        return self::_getData(self::AUTH, $key);
    }
    public static function clearAuthData()
    {
        return self::_clearData(self::AUTH);
    }

    /*
    
    CUSTOMER
    
    */
    public static function setCustomer($arg0=null, $arg1=null)
    {
        return self::_setData(self::CUSTOMER, $arg0, $arg1);
    }

    public static function getCustomer($key = '')
    {
        return self::_getData(self::CUSTOMER, $key);
    }
    
    public static function clearCustomer()
    {
        return self::_clearData(self::CUSTOMER);
    }

    /*
    
    SCHOOL
    
    */
    public static function setSchoolData($arg0=null, $arg1=null)
    {
        if(is_object($arg0)){ $arg0 = $arg0->toArray(); }
        return self::_setData(self::SCHOOL, $arg0, $arg1);
    }

    public static function getSchoolData($key = '')
    {
        return self::_getData(self::SCHOOL, $key);
    }
    
    public static function clearSchoolData()
    {
        return self::_clearData(self::SCHOOL);
    }

    /*
    
    WEB
    
    */
    public static function setWebData($arg0=null, $arg1=null)
    {
        if(is_object($arg0)){ $arg0 = $arg0->toArray(); }
        return self::_setData(self::WEB, $arg0, $arg1);
    }

    public static function getWebData($key = '')
    {
        return self::_getData(self::WEB, $key);
    }
    
    public static function clearWebData()
    {
        return self::_clearData(self::WEB);
    }
    
    public static function setWebId($arg0=null, $arg1=null)
    {
        return self::_setData(self::WEB_ID, $arg0, $arg1);
    }

    public static function getWebId($key = '')
    {
        return self::_getData(self::WEB_ID, $key);
    }
    
    public static function clearWebId()
    {
        return self::_clearData(self::WEB_ID);
    }
    
    /*
    @data
    */
    public static function setWebDomain($arg0=null, $arg1=null)
    {
        return self::_setData(self::WEB_DOMAIN, $arg0, $arg1);
    }
    public static function getWebDomain($key = '')
    {
        return self::_getData(self::WEB_DOMAIN, $key);
    }
    public static function clearWebDomain()
    {
        return self::_clearData(self::WEB_DOMAIN);
    }
    /*
    @data
        array / dataDomain
    */
    public static function setDataDomain($arg0=null, $arg1=null)
    {
        return self::_setData(self::DATA_DOMAIN, $arg0, $arg1);
    }
    public static function getDataDomain($key = '')
    {
        return self::_getData(self::DATA_DOMAIN, $key);
    }
    public static function clearDataDomain()
    {
        return self::_clearData(self::DATA_DOMAIN);
    }
    /*
    @data
        //wakeydev.eletang.com.tw
    */
    public static function setAdminUser($arg0=null, $arg1=null)
    {
        return self::_setData(self::ADMIN_USER, $arg0, $arg1);
    }
    public static function getAdminUser($key = '')
    {
        return self::_getData(self::ADMIN_USER, $key);
    }
    public static function clearAdminUser()
    {
        return self::_clearData(self::ADMIN_USER);
    }
    
    /*
    @data
    */
    public static function setWebCompany($arg0=null, $arg1=null)
    {
        return self::_setData(self::WEB_COMPANY, $arg0, $arg1);
    }
    public static function getWebCompany($key = '')
    {
        return self::_getData(self::WEB_COMPANY, $key);
    }
    public static function clearWebCompany()
    {
        return self::_clearData(self::WEB_COMPANY);
    }
    
    /*
    @data
        //wakeydev.eletang.com.tw
    */
    public static function setWebUser($arg0=null, $arg1=null)
    {
        return self::_setData(self::WEB_USER, $arg0, $arg1);
    }
    public static function getWebUser($key = '')
    {
        return self::_getData(self::WEB_USER, $key);
    }
    public static function clearWebUser()
    {
        return self::_clearData(self::WEB_USER);
    }
    
    /*
    @data
    */
    public static function setWebPlan($arg0=null, $arg1=null)
    {
        return self::_setData(self::WEB_PLAN, $arg0, $arg1);
    }
    public static function getWebPlan($key = '')
    {
        return self::_getData(self::WEB_PLAN, $key);
    }
    public static function clearWebPlan()
    {
        return self::_clearData(self::WEB_PLAN);
    }
    
    /*
    @data
        //wakeydev.eletang.com.tw
    */
    public static function setWebHost($arg0=null, $arg1=null)
    {
        return self::_setData(self::WEB_HOST, $arg0, $arg1);
    }
    public static function getWebHost($key = '')
    {
        return self::_getData(self::WEB_HOST, $key);
    }
    public static function clearWebHost()
    {
        return self::_clearData(self::WEB_HOST);
    }

    /*
    
    USER
    
    */
    public static function setUserData($arg0=null, $arg1=null)
    {
        // $session = self::factory(self::USER);
        // $session = self::_set($session, $arg0, $arg1);
        // _test($session);
        // _test(self::getUserData());

        // // SET TO DI 
        // if(is_array($arg0)){
        //     $di = \\Web\DI::getDefault();
        //     $di->set('user', $arg0);
            
        //     //set cookies
        //     $config = $di->get('config');
        //     $login_with_cookie = $config['application']['system']['login_with_cookie'];
        //     if($login_with_cookie['enable']){
        //         \\Web\Cookie::setUserData($arg0, $login_with_cookie['time']);
        //     }
        // }

        return self::_setData(self::USER, $arg0, $arg1);
    }

    public static function getUserData($key = '')
    {
        $data = self::_getData(self::USER, $key);
        // if(empty($data)){
        //     $data = \\Web\Cookie::getUserData();
        // }
        return $data;
    }
    
    public static function clearUserData()
    {
        // \\Web\Cookie::clearUserData();
        return self::_clearData(self::USER);
    }

    /*
    
    GlobalSetting
    
    */
    public static function setGlobalSettingData($arg0=null, $arg1=null)
    {
        return self::_setData(self::GLOBAL_SETTING, $arg0, $arg1);
    }

    public static function getGlobalSettingData($key = '')
    {
        $data = self::_getData(self::GLOBAL_SETTING, $key);
        return $data;
    }
    
    public static function clearGlobalSettingData()
    {
        return self::_clearData(self::GLOBAL_SETTING);
    }
    
    /*
    
    USER REGISTER
    
    */
    public static function setUserRegister($arg0=null, $arg1=null)
    {
        $session = self::_setData(self::USER_REGISTER, $arg0, $arg1);
        return $session;
    }
    public static function getUserRegister($key = '')
    {
        return self::_getData(self::USER_REGISTER, $key);
    }
    public static function clearUserRegister()
    {
        return self::_clearData(self::USER_REGISTER);
    }

    
    /*
    
    USER AUTO LOGIN
    
    */
    public static function setUserAutoLogin($arg0=null, $arg1=null)
    {
        $session = self::factory(self::USER_AUTO_LOGIN);
        $session = self::_set($session, $arg0, $arg1);
        return true;
    }
    public static function getUserAutoLogin($key = '')
    {
        $session = self::factory(self::USER_AUTO_LOGIN);
        return self::_get($session, $key);
    }
    public static function clearUserAutoLogin()
    {
        return self::_clearData(self::USER_AUTO_LOGIN);
    }
    
    /*
    
    TOKEN API
    
    */
    public static function setTokenApi($arg0=null, $arg1=null)
    {
        $session = self::_setData(self::TOKEN_API, $arg0, $arg1);
        return $session;
    }
    public static function getTokenApi($key = '')
    {
        return self::_getData(self::TOKEN_API, $key);
    }
    public static function clearTokenApi()
    {
        return self::_clearData(self::TOKEN_API);
    }
    public static function factoryNewTokenApi()
    {
        self::clearTokenApi();
        $data = md5(uniqid().microtime(true));
        self::setTokenApi($data);
        return $data;
    }
    
    /*
    
    Role
    
    */
    public static function setRole($arg0=null, $arg1=null)
    {
        $session = self::factory(self::ROLE);
        $session = self::_set($session, $arg0, $arg1);
        return true;
    }
    public static function getRole($key = '')
    {
        $session = self::factory(self::ROLE);
        return self::_get($session, $key);
    }
    public static function clearRole()
    {
        return self::_clearData(self::ROLE);
    }

    public static function _set(&$session, $arg0=null, $arg1=null)
    {
        if(is_object($arg0)){
            $session->object = $arg0;
            // _print($session->object);
            // _test($session->object);
        }else if(isset($arg1) && is_string($arg0)){
            if(!(isset($session->data))){ $session->data = array(); }
            $_data = [];
            $_data[$arg0] = $arg1;
            $session->data = array_merge($session->data, $_data);
        }else if(is_array($arg0) && !(isset($arg1))){
            $session->data = $arg0;
        }
        return $session;
    }


    public static function _get(&$session, $key=null)
    {
        // $session->data = array();
        // _test($session);
        if(isset($session)){
            // _print($session);
            // if($session->has('object')){
            if(is_object($session)){
                // _test($session->object);
                // $data = $session->object;
                if(empty($key)){ return $session; }else{ return $data->$key; }
            // }else if($session->has('data')){
            }else if(is_array($session)){
                // $data = $session->data;
                if(empty($key)){ return $data; }else{ return $data[$key]; }
            }else{
                self::_initSession($session);
                return '';
            }
        }else{
            self::_initSession($session);
            return '';
        }
    }

    public static function _initSession($session)
    {
        $session = array();
        return $session;
    }
    
    /*
    
    DEFAULT PROCESS
    
    */
    public static function buildSessionKey($session_key = 'XXX')
    {
        if(empty($session_key)){ return false; }
        $host = $_SERVER['HTTP_HOST'] . '__';
        $session_key = $host.$session_key;
        return $session_key;
    }
    public static function _setData($session_key = 'XXX', $arg0=null, $arg1=null)
    {
        // _test($arg0);
        // _print($session_key);
        // _print($arg0);
        // _print($arg1);
        if(empty($session_key)){ return false; }
        if(is_array($arg0)){
            $session_key = self::buildSessionKey($session_key);
            $_SESSION[$session_key] = $arg0;
        }else if(
            is_string($arg0)
            && !(empty($arg0))
            && !(empty($arg1))
        ){
            $session_key = self::buildSessionKey($session_key);
            $_SESSION[$session_key][$arg0] = $arg1;
        }else if(
            is_string($arg0)
            && !(empty($arg0))
            && empty($arg1)
        ){
            $session_key = self::buildSessionKey($session_key);
            $_SESSION[$session_key] = $arg0;
            // _print($session_key);
            // _print($_SESSION[$session_key]);
        }
        return $_SESSION[$session_key]??null;
    }
    public static function _getData($session_key = 'XXX', $key = '')
    {
        if(empty($session_key)){ return false; }
        // _test($key);
        // _test('test');
        // $session = self::factory(self::USER);
        // return self::_get($session, $key);
        if(empty($key)){
            $session_key = self::buildSessionKey($session_key);
            return $_SESSION[$session_key]??null;
        }else{
            $session_key = self::buildSessionKey($session_key);
            return $_SESSION[$session_key][$key]??null;
        }
    }
    public static function _clearData($session_key = 'XXX')
    {
        if(empty($session_key)){ return false; }
        // $session = self::factory(self::USER);
        // return self::_clearData(self::USER_AUTO_LOGIN);
        $session_key = self::buildSessionKey($session_key);
        $_SESSION[$session_key] = null;
        return true;
    }

    public static function destroy()
    {
        $_SESSION = null;
        return true;
    }
}