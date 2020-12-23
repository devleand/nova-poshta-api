<?php

    namespace Delivery\NovaPoshta\Models;


    abstract class Counterparty extends \Delivery\NovaPoshta\API\NovaPoshtaApi
    {
        /**
         * @inheritDoc
         */
        protected $model = 'Counterparty';

        /**
         * @param bool $isUsePageCounter
         *
         * @return array|null
         */
        protected function getCounterparties($isUsePageCounter = false)
        {
            return $this
                ->setMethod('getCounterparties')
                ->getPage($isUsePageCounter);
        }

        /**
         * getCounterpartyContactPersons method of model Counterparty.
         *
         * @param array $params
         *
         * @return array
         */
        protected function getCounterpartyContactPersons($params)
        {
            return $this->request($this->getModel(), 'getCounterpartyContactPersons', $params);
        }

        /**
         * getCounterpartyOptions method of model Counterparty.
         *
         * @param string $ref Counterparty ref
         *
         * @return array
         */
        protected function getCounterpartyOptions($ref)
        {
            return $this->request($this->getModel(), 'getCounterpartyOptions', ['Ref' => $ref]);
        }

        /**
         * getCounterpartyAddresses method of model Counterparty.
         *
         * @param string $ref  Counterparty ref
         * @param int    $page
         *
         * @return array
         */
        protected function getCounterpartyAddresses($ref, $page = 1)
        {
            return $this->request($this->getModel(), 'getCounterpartyAddresses', ['Ref' => $ref, 'Page' => $page]);
        }

        /**
         * Save method of current model
         *
         * @param array $params
         *
         * @return array|null
         */
        protected function save($params)
        {
            return $this->request($this->getModel(), 'save', $params);
        }

        /**
         * Update method of current model
         *
         * @param array $params
         *
         * @return array|null
         */
        protected function update($params)
        {
            return $this->request($this->getModel(), 'update', $params);
        }

        /**
         * Delete method of current model
         *
         * @param array $params
         *
         * @return array|null
         */
        protected function delete($params)
        {
            return $this->request($this->getModel(), 'delete', $params);
        }
    }
