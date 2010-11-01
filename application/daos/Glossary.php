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
class Glossary implements interfaces\Glossary{
	
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
	 * @return int
	 */
	public function getTotalCount(){
		$query = $this->dataAccess->getEntityManager()->createQuery("SELECT COUNT(g.id) FROM ".models\Glossary::CLASS_NAME." g ");        
		$result = $query->getSingleResult();
		
		if(! ( is_numeric($result[1]) )){var_dump($result); die();
			throw new exceptions\DomainResultEmptyException();
		}
        
        return $result[1];
	}

}
?>