<?php
namespace kateglo\application\models\solr;
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
use Doctrine\Common\Collections\ArrayCollection;
/**
 *
 *
 * @package kateglo\application\models\solr
 * @license <http://www.gnu.org/licenses/old-licenses/gpl-2.0.html> GPL 2.0
 * @link http://code.google.com/p/kateglo/
 * @since $LastChangedDate$
 * @version $LastChangedRevision$
 * @author  Arthur Purnama <arthur@purnama.de>
 * @copyright Copyright (c) 2009 Kateglo (http://code.google.com/p/kateglo/)
 */
class Equivalent
{

    /**
     * Enter description here ...
     * @var string
     */
    private $foreign;

    /**
     * Enter description here ...
     * @var string
     */
    private $language;

    /**
     * Enter description here ...
     * @var \Doctrine\Common\Collections\ArrayCollection
     */
    private $disciplines;

    /**
     * @return array
     */
    public function toArray() {
        return $this->processArray(get_object_vars($this));
    }

    /**
     * @param array $array
     * @return array
     */
    private function processArray($array) {
        foreach ($array as $key => $value) {
            if (is_object($value)) {
                if ($value instanceof ArrayCollection) {
                    $array[$key] = $this->processArray($value->toArray());
                } else {
                    $array[$key] = $value->toArray();
                }
            }
            else if (is_array($value)) {
                $array[$key] = $this->processArray($value);
            }
        }
        // If the property isn't an object or array, leave it untouched
        return $array;
    }

    /**
     * @return string
     */
    public function __toString() {
        return json_encode($this->toArray());
    }

    /**
     * @return the $foreign
     */
    public function getForeign() {
        return $this->foreign;
    }

    /**
     * @param string $foreign
     */
    public function setForeign($foreign) {
        $this->foreign = $foreign;
    }

    /**
     * @return string
     */
    public function getLanguage() {
        return $this->language;
    }

    /**
     * @param string $entry
     */
    public function setLanguage($language) {
        $this->language = $language;
    }

    /**
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function getDisciplines() {
        return $this->disciplines;
    }

    /**
     * @param \Doctrine\Common\Collections\ArrayCollection $disciplines
     */
    public function setDisciplines($disciplines) {
        $this->disciplines = $disciplines;
    }

}

?>