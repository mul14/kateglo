<?php
namespace kateglo\application\daos;
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
use kateglo\application\daos\interfaces;
use kateglo\application\daos\exceptions;
use kateglo\application\models;
use kateglo\application\utilities;
/**
 *
 *
 * @package kateglo\application\daos
 * @license <http://www.gnu.org/licenses/old-licenses/gpl-2.0.html> GPL 2.0
 * @link http://code.google.com/p/kateglo/
 * @since
 * @version 0.0
 * @author  Arthur Purnama <arthur@purnama.de>
 * @copyright Copyright (c) 2009 Kateglo (http://code.google.com/p/kateglo/)
 */
class Misspelled implements interfaces\Misspelled {
	
	public static $CLASS_NAME = __CLASS__;

	/**
	 * 
	 * @var kateglo\application\utilities\interfaces\DataAccess
	 */
	private $dataAccess;
		
	/**
	 *
	 * @param kateglo\application\utilities\interfaces\DataAccess $dataAccess
	 * @return void
	 * 
	 * @Inject
	 */
	public function setDataAccess(utilities\interfaces\DataAccess $dataAccess){
		$this->dataAccess = $dataAccess;
	}
	
	/**
	 *
	 * @param int $limit
	 * @return kateglo\application\utilities\collections\ArrayCollection
	 */
	public function getRandom($limit = 5){
		
		$randomIdResult = $this->dataAccess->getConnection()->query("SELECT lemma_id FROM misspelled ORDER BY RAND() LIMIT ".$limit." ");
		$idArray = array();
		foreach($randomIdResult as $idResult){
			$idArray[] = $idResult['lemma_id'];
		}
				
		$sql = "SELECT m FROM ".models\Misspelled::CLASS_NAME." m WHERE m.id IN ('".implode("','", $idArray)."')";
		
		$query = $this->dataAccess->getEntityManager()->createQuery($sql);		
		$result = $query->getResult();
		if(count($result) > 0){
			return $result;
		}else{
			throw new exceptions\DomainResultEmptyException();
		}

	}	

}
?>