<?php

    namespace Delivery\NovaPoshta;


    class Counterparties extends Models\Counterparty
    {
        /**
         * @inheritDoc
         */
        public function get($isUsePageCounter = false)
        {
            return $this
                ->setMethod('getCounterparties')
                ->getPage($isUsePageCounter);
        }

        /**
         * getCounterpartyContactPersons() function of model Counterparty.
         *
         * @param string $ref Counterparty ref
         *
         * @return array
         */
        public function getContactPersons($params)
        {
            return $this->request($this->getModel(), 'getCounterpartyContactPersons', $params);
        }

        /**
         * getCounterpartyOptions() function of model Counterparty.
         *
         * @param string $ref Counterparty ref
         *
         * @return array
         */
        public function getCounterpartyOptions($ref)
        {
            return $this->request($this->getModel(), 'getCounterpartyOptions', ['Ref' => $ref]);
        }

        /**
         * getCounterpartyAddresses() function of model Counterparty.
         *
         * @param string $ref  Counterparty ref
         * @param int    $page
         *
         * @return array
         */
        public function getCounterpartyAddresses($ref, $page = 1)
        {
            return $this->request($this->getModel(), 'getCounterpartyAddresses', ['Ref' => $ref, 'Page' => $page]);
        }
    }