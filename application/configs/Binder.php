<?php
namespace kateglo\application\configs;
require_once 'Doctrine/Common/Cache/ApcCache.php';
require_once 'Zend/Log.php';
require_once 'Zend/Config.php';
/*
 *  $Id: Binder.php 300 2011-03-31 18:00:36Z arthur.purnama $
 *
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS
 * "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT
 * LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR
 * A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT
 * OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL,
 * SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT
 * LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE,
 * DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY
 * THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT
 * (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE
 * OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 *
 * This software consists of voluntary contributions made by many individuals
 * and is licensed under the GPL 2.0. For more information, see
 * <http://code.google.com/p/kateglo/>.
 */
use kateglo\application\providers\EntityManager;
use kateglo\application\providers\Connection;
use kateglo\application\providers\Solr;
use kateglo\application\providers\Config;
use kateglo\application\providers\Log;
use Doctrine\Common\Cache\ApcCache;
use kateglo\application\daos;
use kateglo\application\services;
use kateglo\application\utilities;
use kateglo\application\faces;
/**
 *
 *
 * @package kateglo\application\configs
 * @license <http://www.gnu.org/licenses/old-licenses/gpl-2.0.html> GPL 2.0
 * @link http://code.google.com/p/kateglo/
 * @since $LastChangedDate: 2011-03-31 20:00:36 +0200 (Do, 31 Mrz 2011) $
 * @version $LastChangedRevision: 300 $
 * @author  Arthur Purnama <arthur@purnama.de>
 * @copyright Copyright (c) 2009 Kateglo (http://code.google.com/p/kateglo/)
 */
class Binder {
	
	public static function bind(\stubBinder $container) {
				
		$container->bind ( 'Zend_Log' )->toProviderClass ( Log::$CLASS_NAME );
		$container->bind ( 'Zend_Config' )->toProviderClass ( Config::$CLASS_NAME );
		$container->bind ( 'Apache_Solr_Service' )->toProviderClass ( Solr::$CLASS_NAME );
		$container->bind ( 'Doctrine\DBAL\Driver\Connection' )->toProviderClass ( Connection::$CLASS_NAME );
		$container->bind ( 'Doctrine\ORM\EntityManager' )->toProviderClass ( EntityManager::$CLASS_NAME );
		$container->bind ( 'Doctrine\Common\Cache\Cache' )->to ( 'Doctrine\Common\Cache\ApcCache' );
		$container->bind ( daos\interfaces\Entry::INTERFACE_NAME )->to ( daos\Entry::$CLASS_NAME );
		$container->bind ( daos\interfaces\User::INTERFACE_NAME )->to ( daos\User::$CLASS_NAME );
		$container->bind ( services\interfaces\Entry::INTERFACE_NAME )->to ( services\Entry::$CLASS_NAME );
		$container->bind ( services\interfaces\Pagination::INTERFACE_NAME )->to ( services\Pagination::$CLASS_NAME );
		$container->bind ( utilities\interfaces\KBBI::INTERFACE_NAME )->to ( utilities\KBBI::$CLASS_NAME );
		$container->bind ( utilities\interfaces\CURL::INTERFACE_NAME )->to ( utilities\CURL::$CLASS_NAME );
        $container->bind ( 'PHPTAL_Filter' )->to ( utilities\TalTidy::$CLASS_NAME );
		$container->bind ( faces\interfaces\Search::INTERFACE_NAME )->to ( faces\Search::$CLASS_NAME );
	}
}
?>