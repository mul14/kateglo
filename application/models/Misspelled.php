<?php
namespace kateglo\application\models;
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
 * @package kateglo\application\models
 * @license <http://www.gnu.org/licenses/old-licenses/gpl-2.0.html> GPL 2.0
 * @link http://code.google.com/p/kateglo/
 * @since $LastChangedDate$
 * @version $LastChangedRevision$
 * @author  Arthur Purnama <arthur@purnama.de>
 * @copyright Copyright (c) 2009 Kateglo (http://code.google.com/p/kateglo/)
 *
 * @Entity
 * @Table(name="misspelled")
 */
class Misspelled {

    const CLASS_NAME = __CLASS__;

    /**
     * @var int
     * @Id
     * @Column(type="integer", name="misspelled_id")
     * @GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     *
     * Enter description here ...
     * @var int
     * @Version
     * @Column(type="integer", name="misspelled_version")
     */
    private $version;

    /**
     * @var kateglo\application\models\Meaning
     * @ManyToOne(targetEntity="kateglo\application\models\Meaning")
     * @JoinColumn(name="misspelled_meaning_id", referencedColumnName="meaning_id")
     */
    private $meaning;

    /**
     * @var kateglo\application\models\Meaning
     * @OneToOne(targetEntity="kateglo\application\models\Meaning", inversedBy="spelled")
     * @JoinColumn(name="misspelled_misspelled_id", referencedColumnName="meaning_id")
     */
    private $misspelled;

    /**
     * @var Doctrine\Common\Collections\ArrayCollection
     * @ManyToMany(targetEntity="kateglo\application\models\Definition", mappedBy="misspelleds", cascade={"all"})
     */
    private $definitions;

    public function __construct() {
        $this->definitions = new ArrayCollection ();
    }

    /**
     * @return the $id
     */
    public function getId() {
        return $this->id;
    }

    /**
     * @return the $version
     */
    public function getVersion() {
        return $this->version;
    }

    /**
     * @param int $version
     */
    public function setVersion($version) {
        $this->version = $version;
    }

    /**
     * @return \kateglo\application\models\Meaning
     */
    public function getMeaning() {
        return $this->meaning;
    }

    /**
     * @param kateglo\application\models\Meaning $meaning
     * @return void
     */
    public function setMeaning(Meaning $meaning) {
        $this->meaning = $meaning;
    }

    /**
     *
     * @return void
     */
    public function removeMeaning() {
        if ($this->meaning !== null) {
            /*@var $entry kateglo\application\models\Meaning */
            $meaning = $this->meaning;
            $this->meaning = null;
            $meaning->removeMisspelled($this);
        }
    }

    /**
     *
     * @return \kateglo\application\models\Meaning
     */
    public function getMisspelled() {
        return $this->misspelled;
    }

    /**
     *
     * Enter description here ...
     * @param kateglo\application\models\Meaning $meaning
     * @return void
     */
    public function setMisspelled(Meaning $meaning) {
        if ($this->misspelled !== $meaning) {
            $this->misspelled = $meaning;
            $meaning->setSpelled($this);
        }
    }

    /**
     *
     * @param kateglo\application\models\Definition $definition
     * @return void
     */
    public function addDefinition(Definition $definition) {
        if (!$this->definitions->contains($definition)) {
            $this->definitions [] = $definition;
            $definition->addMisspelled($this);
        }
    }

    /**
     *
     * @param kateglo\application\models\Definition $definition
     * @return source
     */
    public function removeDefinition(Definition $definition) {
        /*@var $removed kateglo\application\models\Definition */
        $removed = $this->definitions->removeElement($definition);
        if ($removed !== null) {
            $removed->removeMisspelled($this);
        }
    }

    /**
     *
     * @return Doctrine\Common\Collections\ArrayCollection
     */
    public function getDefinitions() {
        return $this->definitions;
    }

    /**
     * @return array
     */
    public function toArray() {
        $array['id'] = $this->id;
        $array['version'] = $this->version;
        $array['meaning']['id'] = ($this->getMisspelled() instanceof Meaning) ? $this->getMisspelled()->getId() : null;
        $array['meaning']['version'] = ($this->getMisspelled() instanceof Meaning) ? $this->getMisspelled()->getVersion() : null;
        $array['meaning']['entry']['id'] = ($this->getMisspelled() instanceof Meaning) ? $this->getMisspelled()->getEntry()->getId() : null;
        $array['meaning']['entry']['version'] = ($this->getMisspelled() instanceof Meaning) ? $this->getMisspelled()->getEntry()->getVersion() : null;
        $array['meaning']['entry']['entry'] = ($this->getMisspelled() instanceof Meaning) ? $this->getMisspelled()->getEntry()->getEntry() : null;

        return $array;
    }
}

?>