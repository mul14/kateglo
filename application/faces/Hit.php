<?php
namespace kateglo\application\faces;
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
 * @package kateglo\application\faces
 * @license <http://www.gnu.org/licenses/old-licenses/gpl-2.0.html> GPL 2.0
 * @link http://code.google.com/p/kateglo/
 * @since $LastChangedDate$
 * @version $LastChangedRevision$
 * @author  Arthur Purnama <arthur@purnama.de>
 * @copyright Copyright (c) 2009 Kateglo (http://code.google.com/p/kateglo/)
 */
class Hit {

    /**
     *
     * Enter description here ...
     * @var string
     */
    const COUNT = 'numFound';

    /**
     *
     * Enter description here ...
     * @var string
     */
    const START = 'start';

    /**
     *
     * Enter description here ...
     * @var string
     */
    const TIME = 'QTime';

    /**
     *
     * Enter description here ...
     * @var string
     */
    const DOCUMENTS = 'documents';

    /**
     * Enter description here ...
     * @var int
     */
    private $count;

    /**
     * Enter description here ...
     * @var int
     */
    private $start;

    /**
     * Enter description here ...
     * @var int
     */
    private $time;

    /**
     * Enter description here ...
     * @var Doctrine\Common\Collections\ArrayCollection
     */
    private $documents;

    /**
     * Enter description here ...
     * @var \kateglo\application\faces\Facet
     */
    private $facet;

    /**
     * Enter description here ...
     * @var \kateglo\application\faces\Spellcheck
     */
    private $spellcheck;

    /**
     * @return int
     */
    public function getCount() {
        return $this->count;
    }

    /**
     * @param int $count
     */
    public function setCount($count) {
        $this->count = $count;
    }

    /**
     * @return int
     */
    public function getStart() {
        return $this->start;
    }

    /**
     * @param int $start
     */
    public function setStart($start) {
        $this->start = $start;
    }

    /**
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function getDocuments() {
        return $this->documents;
    }

    /**
     * @param \Doctrine\Common\Collections\ArrayCollection $documents
     */
    public function setDocuments(ArrayCollection $documents) {
        $this->documents = $documents;
    }

    /**
     * @param \kateglo\application\faces\Facet $facet
     * @return void
     */
    public function setFacet($facet) {
        $this->facet = $facet;
    }

    /**
     * @return \kateglo\application\faces\Facet
     */
    public function getFacet() {
        return $this->facet;
    }

    /**
     * @param int $time
     * @return void
     */
    public function setTime($time) {
        $this->time = $time;
    }

    /**
     * @return int
     */
    public function getTime() {
        return $this->time;
    }

    /**
     * @param int $time
     * @return void
     */
    public function getTimeInSeconds() {
        return number_format($this->time/1000, 3, ',', '.' );
    }

    /**
     * @param \kateglo\application\faces\Spellcheck $spellcheck
     * @return void
     */
    public function setSpellcheck($spellcheck) {
        $this->spellcheck = $spellcheck;
    }

    /**
     * @return \kateglo\application\faces\Spellcheck
     */
    public function getSpellcheck() {
        return $this->spellcheck;
    }


}

?>