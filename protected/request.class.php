<?php

class Request
{
    /**
     * Base Url
     *
     * @var string
     */
    protected $_portal  = 'main.php';
    protected $_baseUrl = '';

    /**
     * ��l��
     *
     */
    public function __construct()
    {
        $this->_init();
    }

    /**
     * ��l�� BaseUrl
     *
     * �Ҧp��e�����ε{���ؿ��W�٬� project �A
     * �Ӻ��}�� http://localhost/project �ɡA
     * ���� BaseUrl �N�O project
     *
     * �]�m BaseUrl �D�n���ت��O���F�����ε{���i�H���N�h��
     *
     */
    protected function _init()
    {
        $this->_baseUrl = rtrim(str_replace( $this->_portal, '', $_SERVER['SCRIPT_NAME']), '/');
    }

    // ====================================================================================================

    /**
     * �]�w BaseUrl
     * �p�G�{���۰ʨ��o�� BaseUrl �����T�ɡA�i�H�� setBaseUrl �]�w
     */
    public function setBaseUrl($baseUrl)
    {
        $this->_baseUrl = (string) $baseUrl;
    }

    /**
     * ���o BaseUrl
     * @return string
     */
    public function getBaseUrl()
    {
        return $this->_baseUrl;
    }

    // ====================================================================================================

    /**
     * �O�_�� GET �n�D
     * @return bool
     */
    public function isGet()
    {
        return (bool) ('GET' == $_SERVER['REQUEST_METHOD']);
    }

    /**
     * �O�_�� POST �n�D
     * @return bool
     */
    public function isPost()
    {
        return (bool) ('POST' == $_SERVER['REQUEST_METHOD']);
    }

    /**
     * �O�_�� AJAX �n�D (XmlHttpReqeust)
     * @return bool
     */
    public function isAjax()
    {
        $server = $this->getServerInfo();
        if( isset( $server["HTTP_X_REQUESTED_WITH"] )) {
            return (bool) (strtolower( $server["HTTP_X_REQUESTED_WITH"] ) == 'xmlhttprequest'); 
        }
        else {
            return false ;
        }
    }

    // ====================================================================================================

    /**
     * ���o POST ��
     *
     * @param string $key
     * @param bool $stripTags �]�� false �ɷ|�^�ǭ�l�� POST �ȡA���|�� html tag �h��
     * @return string
     */
    public function getPost($key, $stripTags = true)
    {
        return isset($_POST[$key]) ? ($stripTags ? strip_tags(trim($_POST[$key])) : trim($_POST[$key])) : null;
    }

    /**
     * ���o GET ��
     *
     * @param string $key
     * @param bool $stripTags �]�� false �ɷ|�^�ǭ�l�� GET �ȡA���|�� html tag �h��
     * @return string
     */
    public function getQuery($key, $stripTags = true)
    {
        return isset($_GET[$key]) ? ($stripTags ? strip_tags(trim($_GET[$key])) : trim($_GET[$key])) : null;
    }

    /**
     * ���o COOKIE ��
     *
     * @param string $key
     * @param bool $stripTags �]�� false �ɷ|�^�ǭ�l�� POST �ȡA���|�� html tag �h��
     * @return string
     */
    public function getCookie($key)
    {
        return isset($_COOKIE[$key]) ? trim($_COOKIE[$key]) : null;
    }


    /**
     * ���o SERVER ��
     *
     * @param string $key
     * @param bool $stripTags �]�� false �ɷ|�^�ǭ�l�� POST �ȡA���|�� html tag �h��
     * @return string
     */
    public function getServerInfo()
    {
        return $_SERVER;
    }


}