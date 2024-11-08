<?php
require_once("scarlet_vars.php");

class Scarlet extends scarletVars
{
    private $path = "";
    private $view = "";

    private $file_structure = "structure";
    private $structure = array();
    private $extension = ".php";

    private $html = "";

    public $local_templates = "templates/";
    public $path_refs = "";

    public $pwd_context = 5;

    public $vars_extra_html;

    public $fb_token = "";
    public $fb_pixel_id = "";

    public $fb_auth_file = __DIR__ . "/../auth-fb-pixel.php";

    function __construct($path, $view, $vars_template = "", $vars_pages = "", $pwd = 0, $custom_event = null)
    {
        $this->path = $path;
        $this->path_refs = $this->path;
        $this->view = $view;
        if ($pwd) {
            $this->pwd_context = $pwd;
        }

        //Dependencias de variables Scarlet
        //$this->scarletVars();
        parent::__construct();
        $this->templates_vars = $vars_template;
        //var_dump($vars_pages);
        $this->setPageVars($vars_pages);
        //die;
        $file = fopen($this->path . "/" . $this->file_structure . "-" . $this->view . ".conf", "r");

        if (!empty($file)) {
            while (!feof($file)) {
                $value = str_replace("\r\n", "", fgets($file));
                $value = str_replace("\n", "", $value);

                $this->structure[] = $value;
            }
        } else {
            die('No found');
        }
        //-star valid
        //verificar si el archivo global de pixel y troken existe -. /lp/auth-fb-pixel.php
        $fb_pixel_file = "";
        //var_dump($this->fb_auth_file);
        /**
         * FB-PIXEL
         */

        if (file_exists($this->fb_auth_file)):
            include($this->fb_auth_file);
            include(__DIR__ . '/../php-class-fb-pixel/FacebookService.php');
            if (defined("FB_TOKEN") && defined("FB_PIXEL_ID")):
                $facebookService = new FacebookService(FB_TOKEN, FB_PIXEL_ID);
                //var_dump($facebookService);
                if (defined("ACTIVE_LOG")) {
                    var_dump($facebookService);
                    echo "<hr>";
                }
                switch ($this->view):
                    case 'index':
                        try {
                            $user_data = @$facebookService->userData();
                            //var_dump($user_data);
                            @($facebookService->pageViewEvent($user_data, null));
                        } catch (exception $e) {
                            if (defined("ACTIVE_LOG")) {
                                var_dump($this->view);
                                echo "<hr>";
                                var_dump($e->getMessage());
                                echo "<hr>";
                            }
                        }

                        break;
                    case 'thanks':
                        try {
                            $custom_data = null; //add custom data
                            @$facebookService->leadEvent($user_data, $custom_data);
                        } catch (exception $e) {
                            if (defined("ACTIVE_LOG")) {
                                var_dump($this->view);
                                echo "<hr>";
                                var_dump($e->getMessage());
                                echo "<hr>";
                            }
                        }
                        break;
                endswitch;
                if (defined("ACTIVE_LOG")) {
                    var_dump($this->view);
                    echo "<hr>";
                    var_dump($result);
                    echo "<hr>";
                }
            endif;
        else:
            //echo "FILE NOT FOUND";
        endif;
        if (defined("ACTIVE_DIE")) {
            die;
        }

        //si existe (hacer include de la clase del fb pixel
        // include('../php-class-fb-pixel/FacebookService.php')
        // if( token && pixelid exists)
        //hacer in swith con el view: index(pageview) thanks (lead) o usar el custom event doned se inicia la clase
        //$facebookService = new FacebookService($token, $pixelId);
        //@($facebookService->pageViewEvent($userData, $customData)); ($userdata, $custom data ) Fase 1 == vacios.
        //-end valid


        //
        // while(!feof($file)) {
        // 	$value=str_replace("\r\n","",fgets($file));
        // 	$value=str_replace("\n","",$value);

        // 	$this->structure[]= $value;
        // }
        //var_dump($this->structure);
    }

    function generate()
    {
        #if ((strpos($_SERVER['HTTP_HOST'], 'www.') === false) && $_SERVER['SERVER_NAME'] != 'websites.confiedev.com' && $_SERVER['SERVER_NAME'] != 'lp.segurossinbarreras.com') {
        #    header('Location: https://www.' . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]);
        #    exit();
        #}

        // if (empty($_SERVER['HTTPS']) || $_SERVER['HTTPS'] === "off") {
        // 	$location = 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        // 	header('HTTP/1.1 301 Moved Permanently');
        // 	header('Location: ' . $location);
        // 	exit;
        // }
        //var_dump($this->structure);

        $this->createStructure();
    }

    private function createStructure()
    {
        $html = "";
        foreach ($this->structure as $s) {

            //echo $files;
            $type = explode("->", $s);
            switch ($type[0]) {
                case 'h':
                    $this->addHtml($type[1]);
                    break;

                case 'f':
                    $this->addFile($type[1]);
                    if ($type[1] == 'scripts') {
                        $this->addFile(__DIR__ . '/scripts-glid', true);
                    }
                    break;
            }

        }
    }

    public function getInfo()
    {
        //var_dump($this->templats_vars);
        echo "<div style=\"padding:10px; margin:10px;position:fixed; right:0; top:0;background-color:lightyellow;border:1px solid red;\">";
        foreach ($this->templates_vars as $var => $v) {
            if ($v) {
                echo "<b>" . $var . "</b> = " . $v . "<br>";
            }
        }
        echo "</div>";
    }

    private function addFile($file, $direct_path = false)
    {
        $ext = str_replace(" ", "", $this->extension);
        $file_template = $file . $ext;
        if (file_exists($this->local_templates . $file_template)) {
            $f = $this->local_templates . $file_template;
        } else if (!$direct_path) {
            $f = $this->path . $file_template;
        } else {
            $f = $file_template;
        }
        $html = file_get_contents($f, FILE_USE_INCLUDE_PATH);
        $html = $this->formatRefs($html);

        echo $html;
    }

    public function formatRefs($html)
    {
        //html

        $html = str_replace("href=\"images/", "href=\"" . $this->path_refs . "images/", $html);
        $html = str_replace("href=\"css/", "href=\"" . $this->path_refs . "css/", $html);
        $html = str_replace("src=\"images/", "src=\"" . $this->path_refs . "images/", $html);
        $html = str_replace("srcset=\"images/", "srcset=\"" . $this->path_refs . "images/", $html);
        $html = str_replace("src=\"js/", "src=\"" . $this->path_refs . "js/", $html);
        $html = str_replace("content=\"images/", "content=\"" . $this->path_refs . "images/", $html);
        $html = str_replace("href=\"fonts/", "href=\"" . $this->path_refs . "fonts/", $html);
        $html = str_replace("url('images", "url('" . $this->path_refs . "images/", $html);
        $html = str_replace(", images/", ", " . $this->path_refs . "images/", $html);
        $html = str_replace('poster="images/', 'poster="' . $this->path_refs . "images/", $html);
        $html = str_replace("(../fonts/", "(" . $this->path_refs . "fonts/", $html);
        //css
        $html = str_replace("url(images/", "url(" . $this->path_refs . "images/", $html);
        $html = str_replace("url(fonts/", "url(" . $this->path_refs . "fonts/", $html);
        //vars

        // year 
        $html = str_replace('<span id="footerYear">2020</span>', '<span id="footerYear">2022</span>', $html);
        $html = str_replace('<span id="footerYear">2021</span>', '<span id="footerYear">2022</span>', $html);

        $html = str_replace('{footer-main-year}', date('Y'), $html);

        // Template
        $template = str_replace("../", "", $this->path);
        $template = str_replace("TEMPLATESN", "", $template);
        $template = str_replace("html", "", $template);
        $template = str_replace("/", "", $template);

        $html = str_replace("</form>", '{google_params}<input type="hidden" name="template" value="' . $template . '">' . "</form>", $html);

        if ($this->view == 'amp-index') {
            $html = str_replace("</form>", '<input type="hidden" name="url_rater" value="{url-rater}">' . "</form>", $html);
        }

        $html = $this->setVars($html);

        #$html = str_replace("{TCPA:general-tcpa}","asd", $html);
        $html = $this->set_TCPA($html);

        return $html;
    }

    private function set_TCPA($html)
    {
        if (strpos($html, "{tcpa:")) {

            $htmlModified = preg_replace_callback(
                '/\{tcpa:(.*?)\}/',
                // patrón para buscar {{tcpa:...}}
                function ($matches) {
                    $slug = $matches[1]; // Por ejemplo, "general-tcpa"
                    if (file_exists($_SERVER['DOCUMENT_ROOT'] . '/tcpa/lps/' . $slug . '.html')) {
                        $replacementHtml = file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/tcpa/lps/' . $slug . '.html');
                        return $replacementHtml ?: '';
                    } else {
                        return '';
                    }
                },
                $html
            );

            #echo $htmlModified;
            #die;
            $html = $htmlModified;

        }
        return $html;
    }

    private function addHtml($params)
    {
        $v = explode("|", $params);

        $type = $v[0];
        $extra = "";
        if (isset($v[1])) {
            $extra = $this->formatRefs($v[1]);
        }


        switch ($type) {
            case "openhtml":
                $this->codeOpenHtml($extra);
                break;
            case "openbody":
                $this->codeOpenBody($extra);
                break;
            case "opensection":
                $this->codeOpenSection($extra);
                break;
            case "closesection":
                $this->codeCloseSection();
                break;
            case "closehtml":
                $this->codeCloseHtml();
                break;
            case "openhead":
                $this->codeOpenHead();
                break;
            case "closehead":
                $this->codeCloseHead();
                break;
            case 'openmain':
                $this->codeOpenMain($extra);
                break;
            case 'closemain':
                $this->codeCloseMain();
                break;
            case 'opendiv':
                $this->codeOpenDiv($extra);
                break;
            case 'closediv':
                $this->codeCloseDiv();
                break;
            case 'openarticle':
                $this->codeOpenArticle($extra);
                break;
            case 'closearticle':
                $this->codeCloseArticle();
                break;
        }
    }

    public function codeOpenHtml($extra = "")
    {
        $html = "<!DOCTYPE html>\r\n";
        if (empty($extra)) {
            $html .= "<html lang=\"en\">\r\n";
        } else {
            $html .= "<html $extra >\r\n";
        }

        echo $html;
    }

    public function codeOpenBody($extra = "")
    {
        $html = "<body";
        if ($extra) {
            $html .= " " . $extra;
        }

        if (isset($this->vars_extra_html['openbody'])) {
            $html .= " " . $this->vars_extra_html['openbody'];
        }

        $html .= ">\r\n";

        echo $html;
    }

    public function codeOpenSection($extra)
    {
        $html = "<section";
        if ($extra) {
            $html .= " " . $extra;
        }
        $html .= ">\r\n";

        echo $html;
    }

    public function codeCloseSection()
    {
        $html = "</section>\r\n";

        echo $html;
    }

    public function codeOpenMain($extra)
    {
        $html = "<main";
        if (isset($extra)) {
            $html .= " " . $extra;
        }
        $html .= ">\r\n";

        echo $html;
    }

    public function codeCloseMain()
    {
        $html = "</main>\r\n";

        echo $html;
    }

    public function codeOpenDiv($extra)
    {
        $html = "<div";
        if ($extra) {
            $html .= " " . $extra;
        }
        $html .= ">\r\n";

        echo $html;
    }

    public function codeCloseDiv()
    {
        $html = "</div>\r\n";

        echo $html;
    }

    public function codeOpenArticle($extra)
    {
        $html = "<article";
        if ($extra) {
            $html .= " " . $extra;
        }
        $html .= ">\r\n";

        echo $html;
    }

    public function codeCloseArticle()
    {
        $html = "</article>\r\n";

        echo $html;
    }

    public function codeCloseHtml()
    {
        $html = "</body>\r\n";
        $html .= "</html>";

        echo $html;
    }

    public function codeOpenHead()
    {
        $html = "<head>\r\n";

        echo $html;
    }

    public function codeCloseHead()
    {
        $html = "</head>";

        echo $html;
    }

    public function varsExtraHtml($vars_extra_html)
    {
        if (is_array($vars_extra_html)) {
            $this->vars_extra_html = $vars_extra_html;
        }
    }

}