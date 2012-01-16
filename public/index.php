<?php

/** Set Time Zone to where the server is */
date_default_timezone_set ( "Europe/Berlin" );

/** Define application environment for the application.ini */
defined ( 'APPLICATION_ENV' ) || define ( 'APPLICATION_ENV', (getenv ( 'APPLICATION_ENV' ) ? getenv ( 'APPLICATION_ENV' ) : //'linuxDevelopment'
'windowsDevelopment') ); //'macDevelopment'
//'production'


/**
 *
 * Define the path of the Kateglo
 * Default: www/kateglo/
 *
 * @var string
 */
defined ( 'KATEGLO_ROOT' ) || define ( 'KATEGLO_ROOT', realpath ( dirname ( __FILE__ ) . DIRECTORY_SEPARATOR . '..' ) );

/**
 *
 * Define the path of the Kateglo
 * Default: www/
 *
 */
$wwwRoot = realpath ( KATEGLO_ROOT . DIRECTORY_SEPARATOR . '..' );

/**
 * Define path to application directory
 * Default: www/kateglo/application
 */
defined ( 'APPLICATION_PATH' ) || define ( 'APPLICATION_PATH', realpath ( KATEGLO_ROOT . DIRECTORY_SEPARATOR . 'application' ) );

/**
 * Define where to find the ini file
 * Default: www/kateglo/application/configs/application.ini
 */
defined ( 'CONFIGS_PATH' ) || define ( 'CONFIGS_PATH', APPLICATION_PATH . DIRECTORY_SEPARATOR . 'configs' . DIRECTORY_SEPARATOR . 'application.ini' );

/**
 *
 * Define Custom Libraries. Sometimes Extending the original ones.
 * Default: www/kateglo/library
 *
 * @var string
 */
$libraryPath = realpath ( KATEGLO_ROOT . DIRECTORY_SEPARATOR . 'library' );

/** ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ */
/** +++ BEGIN : Initiate Doctrine Object Relational Mapper +++ */

/**
 *
 * Define Doctrine Object Relational Mapper Library Path
 * Default: www/doctrine
 *
 * @var string
 */
$doctrinePath = realpath ( $wwwRoot . DIRECTORY_SEPARATOR . 'doctrine' );

/** Import Doctrine Class Loader */
require_once $doctrinePath . DIRECTORY_SEPARATOR . 'Doctrine' . DIRECTORY_SEPARATOR . 'Common' . DIRECTORY_SEPARATOR . 'ClassLoader.php';

/**
 *
 * Register autoloader for Doctrine
 *
 * @var Doctrine\Common\ClassLoader
 */
$doctrineLoader = new Doctrine\Common\ClassLoader ( 'Doctrine', realpath ( $doctrinePath ) );
$doctrineLoader->register ();

/**
 *
 * Register autoloader for Kateglo
 *
 * @var Doctrine\Common\ClassLoader
 */
$kategloLoader = new Doctrine\Common\ClassLoader ( 'kateglo', realpath ( $wwwRoot ) );
$kategloLoader->register ();

/** +++ End : Initiate Doctrine Object Relational Mapper +++ */
/** ++++++++++++++++++++++++++++++++++++++++++++++++++++++++ */

/** ++++++++++++++++++++++++++++++++++++++++++++++++++++++ */
/** +++ BEGIN : Initiate Stubbles Inversion of Control +++ */

/**
 *
 * Define Stubbles Library Path.
 * Default : www/stubbles/
 *
 * @var string
 */
$stubblesPath = realpath ( $wwwRoot . DIRECTORY_SEPARATOR . 'stubbles' );

/**
 *
 * Define Stubbles Cache Directory.
 * Default : www/kateglo/cache/stubbles
 *
 * @var string
 */
$stubblesCache = realpath ( KATEGLO_ROOT . DIRECTORY_SEPARATOR . 'cache' . DIRECTORY_SEPARATOR . 'stubbles' );

/**
 *
 * Define Stubbles Class Loader File.
 * Default : www/stubbles/src/main/php/net/stubbles/stubClassLoader.php
 *
 * @var string
 */
$stubblesClassLoader = realpath ( $stubblesPath . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR . 'main' . DIRECTORY_SEPARATOR . 'php' . DIRECTORY_SEPARATOR . 'net' . DIRECTORY_SEPARATOR . 'stubbles' . DIRECTORY_SEPARATOR . 'stubClassLoader.php' );

/** Import Stubbles Bootstrap File */
require_once $stubblesPath . DIRECTORY_SEPARATOR . 'bootstrap.php';

/** Override Stubbles original bootstrap */
require_once $libraryPath . DIRECTORY_SEPARATOR . 'Stubbles' . DIRECTORY_SEPARATOR . 'bootstrap.php';

/**
 *
 * Define Stubbles Pathes
 *
 * @var array
 */
$stubblesPathes = array ("project" => KATEGLO_ROOT, "cache" => $stubblesCache );

/**
 * Instantiate autoloader for Stubbles
 * Using the Class that override the original init() method.
 */
kateglo\library\Stubbles\stubBootstrap::init ( $stubblesPathes, $stubblesClassLoader );

/**
 * Load the Stubbles Inversion of Control
 * IoC ready to use.
 */
\stubClassLoader::load ( 'net::stubbles::ioc::stubBinder' );

/**
 * Load the Stubbles Reflection
 * Reflection ready to use.
 */
\stubClassLoader::load('net::stubbles::reflection::reflection');

/** +++ END : Initiate Stubbles Inversion of Control +++ */
/** ++++++++++++++++++++++++++++++++++++++++++++++++++++ */

/** +++++++++++++++++++++++++++++++++++++++++++++++ */
/** +++ BEGIN : Initiate PHPTal Template Engine +++ */

/**
 *
 * Define Tal Template Engine Library Path
 * Default: www/phptal/classes
 *
 * @var string
 */
$talPath = realpath ( $wwwRoot . DIRECTORY_SEPARATOR . 'phptal' . DIRECTORY_SEPARATOR . 'classes' );
set_include_path ( $talPath );
/** Import PHPTal Template Engine Loader */
require_once $talPath . DIRECTORY_SEPARATOR . 'PHPTAL.php';

/** +++ END : Initiate PHPTal Template Engine +++ */
/** +++++++++++++++++++++++++++++++++++++++++++++ */
set_include_path ( realpath ( $wwwRoot . DIRECTORY_SEPARATOR . 'phpsolr' ) );
require_once ('Apache/Solr/Service.php');
/** +++++++++++++++++++++++++++++++++++++++ */
/** +++ BEGIN : Initiate Zend Framework +++ */

/**
 *
 * Define Zend Framework Library Path
 * Default: www/ZendFramework/library
 *
 * @var string
 */
$zfPath = realpath ( $wwwRoot . DIRECTORY_SEPARATOR . 'ZendFramework' . DIRECTORY_SEPARATOR . 'library' );

/** Ensure libraries is on include_path */
set_include_path ( implode ( PATH_SEPARATOR, array (realpath ( $zfPath ), realpath ( $libraryPath ), get_include_path (), $doctrinePath ) ) );

/** Import Zend Framework Loader */
require_once 'Zend' . DIRECTORY_SEPARATOR . 'Application.php';

/**
 *
 * Initiate Framework
 *
 * @var Zend_Application
 */
$application = new Zend_Application ( APPLICATION_ENV, CONFIGS_PATH );

use kateglo\application\utilities\Injector;

/**
 * 
 * Get Log Service from Dependency Injector
 * @var Zend_Log
 */
$logService = Injector::getInstance ( 'Zend_Log' );

try {
	//run kateglo
	$application->bootstrap ()->run ();

} catch ( Exception $e ) {
	//catch anything in log files
	$logService->log ( $e->getTraceAsString (), Zend_Log::ERR );
}

/** +++ END : Initiate Zend Framework +++ */
/** +++++++++++++++++++++++++++++++++++++ */
?>