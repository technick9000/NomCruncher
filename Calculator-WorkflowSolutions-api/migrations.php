<?php



/* Include ALL important Packages */

use Controllers\SiteController;
use Controllers\ExecController;

require_once './__autoloader.php';


//var_dump(phpinfo()); 7.4.9

$app = new Application(getcwd());

$app->db->applyMigration();