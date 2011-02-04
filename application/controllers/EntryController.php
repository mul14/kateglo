<?php
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
use Doctrine\Common\Cache\Cache;
use kateglo\application\helpers\RouteParameter;
use kateglo\application\faces\interfaces\Search;
use kateglo\application\services\interfaces\Entry;
/**
 *
 *
 * @package kateglo\application\controllers
 * @license <http://www.gnu.org/licenses/old-licenses/gpl-2.0.html> GPL 2.0
 * @link http://code.google.com/p/kateglo/
 * @since $LastChangedDate$
 * @version $LastChangedRevision$
 * @author  Arthur Purnama <arthur@purnama.de>
 * @copyright Copyright (c) 2009 Kateglo (http://code.google.com/p/kateglo/)
 */
class EntryController extends Zend_Controller_Action_Stubbles {
	
	/**
	 * 
	 * Enter description here ...
	 * @var kateglo\application\services\interfaces\Entry;
	 */
	private $entry;
	
	/**
	 * 
	 * Enter description here ...
	 * @var kateglo\application\faces\interfaces\Search;
	 */
	private $search;
	
	/**
	 * 
	 * Enter description here ...
	 * @var Doctrine\Common\Cache\Cache
	 */
	private $cache;
	
	/**
	 * 
	 * Enter description here ...
	 * @param kateglo\application\services\interfaces\Entry $entry
	 * 
	 * @Inject
	 */
	public function setEntry(Entry $entry) {
		$this->entry = $entry;
	}
	
	/**
	 * 
	 * Enter description here ...
	 * @param kateglo\application\faces\interfaces\Search $entry
	 * 
	 * @Inject
	 */
	public function setSearch(Search $search) {
		$this->search = $search;
	}
	
	/**
	 * 
	 * Enter description here ...
	 * @param Doctrine\Common\Cache\Cache $cache
	 * 
	 * @Inject
	 */
	public function setCache(Cache $cache) {
		$this->cache = $cache;
	}
	
	public function indexAction() {
		$this->_helper->viewRenderer->setNoRender ();
		if ($this->_request->isGet ()) {
			$text = urldecode ( $this->_request->getParam ( RouteParameter::TEXT ) );
			if ($text !== '') {
				if ($this->cache->contains ( $text )) {
					$content = $this->cache->fetch($text);
				} else {
					$this->view->appPath = APPLICATION_PATH;
					$this->view->search = $this->search;
					$this->view->formAction = '/kamus';
					$this->view->search->setFieldValue ( $text );					
					$this->view->entry = $this->entry->getEntry ( $text );					
					$content = $this->_helper->viewRenderer->view->render ( $this->_helper->viewRenderer->getViewScript () );
					$this->cache->save($text, $content, 0);
				}
				$this->getResponse()->appendBody($content);
			} else {
				header ( 'location: ' . $this->_request->getBaseUrl () );
			}
		} else {
			header ( 'location: ' . $this->_request->getBaseUrl () );
		}
	}
}
?>