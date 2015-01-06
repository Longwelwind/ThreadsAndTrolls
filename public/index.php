<?php

require_once(__DIR__ . "/../vendor/autoload.php");

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

use Klein\Klein;

$config = include(__DIR__ . "/../config.php");

if ($config["debug"]) {
    ini_set('display_errors',1);
    ini_set('display_startup_errors',1);
    error_reporting(-1);
}

/*
 * Database related stuff
 */

$dbConfig = Setup::createAnnotationMetadataConfiguration(array(__DIR__ . "/../src/Entity/"), $config["debug"]);
$entityManager = EntityManager::create($config['database'], $dbConfig);

\ThreadsAndTrolls\Database::setEntityManager($entityManager);

/*
 * Router setup
 */

$klein = new Klein();

include(__DIR__ . "/../src/routes.php");

/*
 * We launch the router
 */

$entityManager->flush();
$klein->dispatch();
