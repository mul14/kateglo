<?php
namespace kateglo\application\providers;
/*
 *  $Id$
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
use Doctrine\DBAL\DriverManager;
use kateglo\application\utilities\interfaces\Configs;
/**
 *
 *
 * @package kateglo\application\utilities
 * @license <http://www.gnu.org/licenses/old-licenses/gpl-2.0.html> GPL 2.0
 * @link http://code.google.com/p/kateglo/
 * @since $LastChangedDate$
 * @version $LastChangedRevision$
 * @author  Arthur Purnama <arthur@purnama.de>
 * @copyright Copyright (c) 2009 Kateglo (http://code.google.com/p/kateglo/)
 *
 */
class Connection extends \stubBaseObject implements \stubInjectionProvider {
	
	public static $CLASS_NAME = __CLASS__;
	
	private $configs;
	
	/**
	 * 
	 * Enter description here ...
	 * @param kateglo\application\utilities\interfaces\Configs $configs
	 * 
	 * @Inject
	 */
	public function setConfigs(Configs $configs) {
		$this->configs = $configs;
	}
	
	/**
	 * (non-PHPdoc)
	 * @see stubInjectionProvider::get()
	 */
	public function get($name = NULL) {
		$params = array ("driver" => $this->configs->get ()->database->adapter, "host" => $this->configs->get ()->database->host, "port" => $this->configs->get ()->database->port, "dbname" => $this->configs->get ()->database->name, "user" => $this->configs->get ()->database->username, "password" => $this->configs->get ()->database->password );
		$connection = DriverManager::getConnection ( $params, null );
		$connection->setCharset ( $this->configs->get ()->database->charset );
		$connection->connect();
		return $connection;
	}
}

?>