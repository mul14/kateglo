<?php
namespace kateglo\proxies {
    /**
     * THIS CLASS WAS GENERATED BY THE DOCTRINE ORM. DO NOT EDIT THIS FILE.
     */
    class kategloapplicationmodelsLexicalProxy extends \kateglo\application\models\Lexical implements \Doctrine\ORM\Proxy\Proxy {
        private $_entityPersister;
        private $_identifier;
        private $_loaded = false;
        public function __construct($entityPersister, $identifier) {
            $this->_entityPersister = $entityPersister;
            $this->_identifier = $identifier;
            parent::__construct();
        }
        private function _load() {
            if ( ! $this->_loaded) {
                $this->_entityPersister->load($this->_identifier, $this);
                unset($this->_entityPersister);
                unset($this->_identifier);
                $this->_loaded = true;
            }
        }
        public function __isInitialized__() { return $this->_loaded; }

        
        public function getId() {
            $this->_load();
            return parent::getId();
        }

        public function setLexical($lexical) {
            $this->_load();
            return parent::setLexical($lexical);
        }

        public function getLexical() {
            $this->_load();
            return parent::getLexical();
        }

        public function setAbbreviation($abbreviation) {
            $this->_load();
            return parent::setAbbreviation($abbreviation);
        }

        public function getAbbreviation() {
            $this->_load();
            return parent::getAbbreviation();
        }

        public function getDefinitions() {
            $this->_load();
            return parent::getDefinitions();
        }

        public function addDefinition(\kateglo\application\models\Definition $definition) {
            $this->_load();
            return parent::addDefinition($definition);
        }

        public function removeDefinition(\kateglo\application\models\Definition $definition) {
            $this->_load();
            return parent::removeDefinition($definition);
        }


        public function __sleep() {
            if (!$this->_loaded) {
                throw new \RuntimeException("Not fully loaded proxy can not be serialized.");
            }
            return array('id', 'lexical', 'abbreviation', 'definitions');
        }
    }
}