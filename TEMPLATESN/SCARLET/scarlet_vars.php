<?php
session_start();

class scarletVars
{
    public $protocol;
    private $pwd;
    public $url_home;
    public $url_error = "error/";
    public $url_thanks = "thanks/";
    public $templates_vars = array();
    private $onlyOnestart = 1;

    public function __construct($pages = "")
    {
        $this->setProtocol();
        $this->setPwd();
        $this->setUrlHome();
        $this->setUrlThanks();
        $this->setUrlError();
    }

    public function setProtocol()
    {
        if (isset($_SERVER['HTTPS'])) {
            $protocol = ($_SERVER['HTTPS'] && $_SERVER['HTTPS'] != "off") ? "https" : "http";
        } else {
            $protocol = 'http';
        }
        $this->protocol = $protocol . "://";
    }

    public function setPwd()
    {
        $url = str_replace("//", "/", $_SERVER['REQUEST_URI']); //returns the current URL
        $parts = explode('/', $url);
        //var_dump($parts);
        $dir = $_SERVER['SERVER_NAME'];
        for ($i = 0; $i < count($parts) - 1; $i++) {
            $dir .= $parts[$i] . "/";
        }
        $dir = str_replace("//", "/", $dir);
        $this->pwd = $this->protocol . $dir;
        $this->pwd;
    }

    public function setUrlHome()
    {
        //echo $this->pwd;
        $pwd = explode("/", $this->pwd);
        //var_dump($pwd);
        $new_pwd = "https://";
        //echo count($pwd);
        //$this->pwd_context=count($pwd)-1;
        //echo $this->pwd_context;
        $new_pwdf = "";
        for ($n = 2; $n < $this->pwd_context; $n++) {
            $new_pwdf .= $pwd[$n] . "/";
        }
        $new_pwdf = str_replace("//", "/", $new_pwdf);
        //echo "<hr>".$new_pwd.$new_pwdf;
        $this->url_home = $new_pwd . $new_pwdf;
    }

    public function setUrlError($error = "")
    {
        if (!$error) {
            $error = $this->url_error;
        }
        //echo $this->pwd."---";
        $this->url_error = $this->pwd . $error;
    }

    public function setUrlThanks($thanks = "")
    {
        if (!$thanks) {
            $thanks = $this->url_thanks;
        }
        $this->url_thanks = $this->pwd . $thanks;
    }

    public function setPageVars($var = array())
    {
        //var_dump($var);
        if (isset($var["url-thanks"])) {
            $this->setUrlThanks($var["url-thanks"]);
        }
        if (isset($var["url-error"])) {
            $this->setUrlError($var["url-error"]);
        }
    }


    // Function to get the client IP address
    public function get_client_ip()
    {
        $ipaddress = '';
        if (getenv('HTTP_CLIENT_IP'))
            $ipaddress = getenv('HTTP_CLIENT_IP');
        else if (getenv('HTTP_X_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
        else if (getenv('HTTP_X_FORWARDED'))
            $ipaddress = getenv('HTTP_X_FORWARDED');
        else if (getenv('HTTP_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_FORWARDED_FOR');
        else if (getenv('HTTP_FORWARDED'))
            $ipaddress = getenv('HTTP_FORWARDED');
        else if (getenv('REMOTE_ADDR'))
            $ipaddress = getenv('REMOTE_ADDR');
        else
            $ipaddress = rand(0, 10000);
        return $ipaddress;
    }

    public function setVars($html)
    {
        $_SESSION['Lead_valid'] = true;
        $html = str_replace("{url-home}", $this->url_home, $html);
        $html = str_replace("{url-error}", $this->url_error, $html);
        $html = str_replace("{url-thanks}", $this->url_thanks, $html);
        $html = str_replace("{ip-lp}", self::get_client_ip(), $html);

        // $html=str_replace("{values_extras}", self::GetValuesPath(), $html);
        // $html=str_replace('/controller/processor.php', self::GetValuesPath(), $html);


        $html = $this->setScarletVars($html);
        $html = $this->setTemplateVars($html);

        return $html;
    }

    public function GetValuesPath()
    {
        if (false) {
            $utm_prodtype = (!empty($_REQUEST['utm_ProdType'])) ? $_REQUEST['utm_ProdType'] : $_REQUEST['utm_prodtype'];
            $utm_lang = (!empty($_REQUEST['utm_Lang'])) ? $_REQUEST['utm_Lang'] : $_REQUEST['utm_lang'];

            $gclid = (!empty($_REQUEST['gclid'])) ? $_REQUEST['gclid'] : $_REQUEST['msclkid'];

            try {
                if (!empty($_REQUEST['utm_conversionTime'])) {
                    $date = new DateTime($_REQUEST['utm_conversionTime']);
                    $utm_conversionTime = $date->format('Y-m-d H:i:s');
                } else {
                    $utm_conversionTime = null;
                }
            } catch (Exception $e) {
                $utm_conversionTime = (isset($_REQUEST['utm_conversionTime'])) ? $_REQUEST['utm_conversionTime'] : '';
            }

            $utm_source = (isset($_REQUEST['utm_source'])) ? $_REQUEST['utm_source'] : null;
            $utm_medium = (isset($_REQUEST['utm_medium'])) ? $_REQUEST['utm_medium'] : null;
            $utm_campaign = (isset($_REQUEST['utm_campaign'])) ? $_REQUEST['utm_campaign'] : null;
            $utm_content = (isset($_REQUEST['utm_content'])) ? $_REQUEST['utm_content'] : null;
            $stt = (isset($_REQUEST['st-t'])) ? $_REQUEST['st-t'] : null;
            $vtk = (isset($_REQUEST['vt-k'])) ? $_REQUEST['vt-k'] : null;
            $vtmt = (isset($_REQUEST['vt-mt'])) ? $_REQUEST['vt-mt'] : null;
            $vtn = (isset($_REQUEST['vt-n'])) ? $_REQUEST['vt-n'] : null;
            $vtap = (isset($_REQUEST['vt-ap'])) ? $_REQUEST['vt-ap'] : null;
            $vtd = (isset($_REQUEST['vt-d'])) ? $_REQUEST['vt-d'] : null;
            $vtdm = (isset($_REQUEST['vt-dm'])) ? $_REQUEST['vt-dm'] : null;
            $gclid = $gclid;
            $utm_brandid = (isset($_REQUEST['utm_brandid'])) ? $_REQUEST['utm_brandid'] : null;
            $utm_prodtype = $utm_prodtype;
            $utm_lang = $utm_lang;
            $utm_geo = (isset($_REQUEST['utm_geo'])) ? $_REQUEST['utm_geo'] : null;
            $utm_ConversionName = (isset($_REQUEST['utm_ConversionName'])) ? $_REQUEST['utm_ConversionName'] : null;
            $utm_ConversionValue = (isset($_REQUEST['utm_ConversionValue'])) ? $_REQUEST['utm_ConversionValue'] : null;
            $utm_ConversionCurrency = (isset($_REQUEST['utm_ConversionCurrency'])) ? $_REQUEST['utm_ConversionCurrency'] : null;
            $utm_conversionTime = $utm_conversionTime; //is date time
            $brandstatecategory = (isset($_REQUEST['brand-state-category'])) ? $_REQUEST['brand-state-category'] : null;


            $vars = array(
                "utm_source" => $utm_source,
                "utm_medium" => $utm_medium,
                "utm_campaign" => $utm_campaign,
                "utm_content" => $utm_content,
                "st-t" => $stt,
                "vt-k" => $vtk,
                "vt-mt" => $vtmt,
                "vt-n" => $vtn,
                "vt-ap" => $vtap,
                "vt-d" => $vtd,
                "vt-dm" => $vtdm,
                "gclid" => $gclid,
                "utm_brandid" => $utm_brandid,
                "utm_prodtype" => $utm_prodtype,
                "utm_lang" => $utm_lang,
                "utm_geo" => $utm_geo,
                "utm_ConversionName" => $utm_ConversionName,
                "utm_ConversionValue" => $utm_ConversionValue,
                "utm_ConversionCurrency" => $utm_ConversionCurrency,
                "utm_conversionTime" => $utm_conversionTime, //is date time
                "brand-state-category" => $brandstatecategory,
                "session_type" => "paid-ads",
            );

            $_SESSION["UTM_DATA"]=$vars;
        }

        $vars = $_REQUEST;

        $google_params = '' . "\n";
        foreach ($vars as $key => $value) {
            if (!empty($value)) {
                $_SESSION["UTM_DATA"][$key]=$value;
                $google_params .= '<input  type="hidden" value="' . $value . '" name="' . $key . '"/>' . "\n";
                $_SESSION["UTM_DATA"]["session_type"]="paid-ads";
            }
        }
        $anexo_url = "?1=1";
        foreach ($vars as $key => $value) {
            if (!empty($value)) {
                $anexo_url .= '&' . $key . '=' . $value;
            }
        }

        // Adjuntar siempre los parámetros pasados por get
        $this->templates_vars['url-rater'] .= $anexo_url;
        $this->templates_vars['google_params'] = $google_params;

    }

    public function setScarletVars($replace)
    {
        $replace = str_replace("[PWDSITE]", $this->url_home, $replace);
        return $replace;
    }

    public function setTemplateVars($html)
    {
        if ($this->onlyOnestart == 1) {
            self::GetValuesPath();
            $this->onlyOnestart = 2;
        }
        $vars = $this->templates_vars;
        foreach ($vars as $var => $v) {
            $find = "{" . $var . "}";
            $html = str_replace($find, $v, $html);
        }

        return $html;
        //die;
    }
}
