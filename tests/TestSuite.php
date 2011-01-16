<?php
namespace kateglo\tests;
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

use kateglo\tests\application\daos;

require_once 'bootstrap.php';

use kateglo\tests\application\utilities;
use kateglo\tests\application\services;
use kateglo\tests\application\helpers;
/**
 *
 *
 * @package kateglo\application\configs
 * @license <http://www.gnu.org/licenses/old-licenses/gpl-2.0.html> GPL 2.0
 * @link http://code.google.com/p/kateglo/
 * @since
 * @version 0.0
 * @author  Arthur Purnama <arthur@purnama.de>
 * @copyright Copyright (c) 2009 Kateglo (http://code.google.com/p/kateglo/)
 */
class TestSuite extends \PHPUnit_Framework_TestSuite {

	/**
	 *
	 * @return void
	 */
	protected function setUp()
	{

	}

	/**
	 *
	 * @return void
	 */
	protected function tearDown()
	{

	}

	public static function suite(){
		$suite = new TestSuite();
		$suite->addTestSuite(helpers\AuthenticationAdapterTest::CLASS_NAME);
		$suite->addTestSuite(services\AuthenticationTest::CLASS_NAME);
		$suite->addTestSuite(utilities\DataAccessTest::CLASS_NAME);
		$suite->addTestSuite(daos\UserTest::CLASS_NAME);
		$suite->addTestSuite(utilities\LogServiceTest::CLASS_NAME);
		
		return $suite;
	}

}
?>