<?php

require_once dirname(__FILE__)."/core/Config.class.php";
$conf = new core\Config();
require_once dirname(__FILE__)."/config.php";

function &getConf(){ global $conf; return $conf; }

require_once dirname(__FILE__)."/core/Messages.class.php";
$messages = new core\Messages();

function &getMessages(){ global $messages; return $messages; }
 
$smarty = null;
function &getSmarty(){
    global $smarty;
    if(!isset($smarty)){
        include_once getConf()->root_path."/lib/smarty/libs/Smarty.class.php";
        $smarty = new Smarty();
		$smarty->assign('conf', getConf());
        $smarty->assign('messages', getMessages());

        $smarty->setTemplateDir(array(
            'ichi' => getConf()->root_path."/app/view",
            'ni' => getConf()->root_path."/app/view/templates"
        ));
    }
    return $smarty;
}

require_once getConf()->root_path."/core/ClassLoader.class.php";
$classLoader = new core\ClassLoader();
function &getLoader(){
    global $classLoader;
    return $classLoader;
}


require_once getConf()->root_path."/core/Router.class.php";
$router = new core\Router();
function &getRouter(){
    global $router;
    return $router;
}

require_once getConf()->root_path.'/core/functions.php';

session_start();
$conf->roles = isset($_SESSION['_roles']) ? unserialize($_SESSION['_roles']) : array();

$router->setAction(getFromRequest('action'));