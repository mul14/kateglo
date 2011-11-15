<?php
namespace kateglo\application\models\front;
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

/**
 *
 *
 * @package kateglo\application\models\front
 * @license <http://www.gnu.org/licenses/old-licenses/gpl-2.0.html> GPL 2.0
 * @link http://code.google.com/p/kateglo/
 * @since $LastChangedDate$
 * @version $LastChangedRevision$
 * @author  Arthur Purnama <arthur@purnama.de>
 * @copyright Copyright (c) 2009 Kateglo (http://code.google.com/p/kateglo/)
 */
class Facet
{
    /**
     * Enter description here ...
     * @var string
     */
    private $uri;

    /**
     * Enter description here ...
     * @var string
     */
    private $typeValue;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     */
    private $filters;

    /**
     * Enter description here ...
     * @var string
     */
    private $typeUri;

    /**
     * Enter description here ...
     * @var string
     */
    private $classValue;

    /**
     * Enter description here ...
     * @var string
     */
    private $classUri;

    /**
     * Enter description here ...
     * @var string
     */
    private $disciplineValue;

    /**
     * Enter description here ...
     * @var string
     */
    private $disciplineUri;

    /**
     * Enter description here ...
     * @var string
     */
    private $sourceValue;

    /**
     * Enter description here ...
     * @var string
     */
    private $sourceUri;

    /**
     * @param string $classUri
     */
    public function setClassUri($classUri) {
        $this->classUri = $classUri;
    }

    /**
     * @return string
     */
    public function getClassUri() {
        return $this->classUri;
    }

    /**
     * @param string $classValue
     */
    public function setClassValue($classValue) {
        $this->classValue = $classValue;
    }

    /**
     * @return string
     */
    public function getClassValue() {
        return $this->classValue;
    }

    /**
     * @param string $disciplineUri
     */
    public function setDisciplineUri($disciplineUri) {
        $this->disciplineUri = $disciplineUri;
    }

    /**
     * @return string
     */
    public function getDisciplineUri() {
        return $this->disciplineUri;
    }

    /**
     * @param string $disciplineValue
     */
    public function setDisciplineValue($disciplineValue) {
        $this->disciplineValue = $disciplineValue;
    }

    /**
     * @return string
     */
    public function getDisciplineValue() {
        return $this->disciplineValue;
    }

    /**
     * @param string $sourceUri
     */
    public function setSourceUri($sourceUri) {
        $this->sourceUri = $sourceUri;
    }

    /**
     * @return string
     */
    public function getSourceUri() {
        return $this->sourceUri;
    }

    /**
     * @param string $sourceValue
     */
    public function setSourceValue($sourceValue) {
        $this->sourceValue = $sourceValue;
    }

    /**
     * @return string
     */
    public function getSourceValue() {
        return $this->sourceValue;
    }

    /**
     * @param string $typeUri
     */
    public function setTypeUri($typeUri) {
        $this->typeUri = $typeUri;
    }

    /**
     * @return string
     */
    public function getTypeUri() {
        return $this->typeUri;
    }

    /**
     * @param string $typeValue
     */
    public function setTypeValue($typeValue) {
        $this->typeValue = $typeValue;
    }

    /**
     * @return string
     */
    public function getTypeValue() {
        return $this->typeValue;
    }

    /**
     * @param string $uri
     */
    public function setUri($uri) {
        $this->uri = $uri;
    }

    /**
     * @return string
     */
    public function getUri() {
        return $this->uri;
    }

    /**
     * @param \Doctrine\Common\Collections\ArrayCollection $filters
     */
    public function setFilters($filters) {
        $this->filters = $filters;
    }

    /**
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function getFilters() {
        return $this->filters;
    }
}

?>