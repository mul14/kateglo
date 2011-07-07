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
use kateglo\application\services\interfaces\StaticData;
/**
 *
 *
 *
 * @license <http://www.gnu.org/licenses/old-licenses/gpl-2.0.html> GPL 2.0
 * @link http://code.google.com/p/kateglo/
 * @since $LastChangedDate$
 * @version $LastChangedRevision$
 * @author  Arthur Purnama <arthur@purnama.de>
 * @copyright Copyright (c) 2009 Kateglo (http://code.google.com/p/kateglo/)
 */
class CpanelController extends Zend_Controller_Action_Stubbles {

	/**
	 *
	 * Enter description here ...
	 * @var \kateglo\application\services\interfaces\StaticData;
	 */
	private $staticData;

	/**
	 *
	 * Enter description here ...
	 * @param kateglo\application\services\interfaces\StaticData $staticData
	 *
	 * @Inject
	 */
	public function setStaticData(StaticData $staticData) {
		$this->staticData = $staticData;
	}

	/**
	 * (non-PHPdoc)
	 * @see Zend_Controller_Action::init()
	 */
	public function init() {
		parent::init();
	}

	/**
	 * @return void
	 * @Get
	 * @Path('/')
	 * @Produces('text/html')
	 */
	public function indexHtml() {

	}

	/**
	 * @return void
	 * @Get
	 * @Path('/static')
	 * @Produces('application/json')
	 */
	public function staticJson() {
		try {
			$cacheId = __METHOD__ ;
			if (!$this->evaluatePreCondition($cacheId)) {
				$this->content = $this->staticData->getStaticDataAsArray();
			}
			$this->responseBuilder($cacheId);
		} catch (Apache_Solr_Exception $e) {
			$this->getResponse()->setHttpResponseCode(400);
			$this->content = array('error' => 'query error');
		}
		$this->_helper->json($this->content);
	}
}

?>