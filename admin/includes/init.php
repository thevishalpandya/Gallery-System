<?php

defined("DS") ? null : define("DS",DIRECTORY_SEPARATOR);

defined("SITE_ROOT") ? null : define("SITE_ROOT","D:".DS."php".DS."htdocs".DS."Gallery");

defined("INCLUDES_PATH") ? null : define("INCLUDES_PATH",SITE_ROOT.DS."admin".DS."includes");

require_once(INCLUDES_PATH.DS."function.php");
require_once(INCLUDES_PATH.DS."config.php");
require_once(INCLUDES_PATH.DS."database.php");
require_once(INCLUDES_PATH.DS."db_object.php");
require_once(INCLUDES_PATH.DS."user.php");
require_once(INCLUDES_PATH.DS."comment.php");
require_once(INCLUDES_PATH.DS."photo.php");
require_once(INCLUDES_PATH.DS."session.php");
require_once(INCLUDES_PATH.DS."paginate.php");
error_reporting(E_ALL & ~E_WARNING & ~E_NOTICE);
//error_reporting = E_ALL & ~E_WARNING  & ~E_NOTICE & ~E_STRICT & ~E_DEPRECATED

?>