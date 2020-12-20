<?php

    namespace Delivery\NovaPoshta\Models;


    abstract class Counterparty extends \Delivery\NovaPoshta\API\NovaPoshtaApi implements \Delivery\NovaPoshta\API\NovaPoshtaAPIGet, \Delivery\NovaPoshta\API\NovaPoshtaApiSUD
    {
        /**
         * @inheritDoc
         */
        protected $model = 'Counterparty';

        /**
         * @inheritDoc
         */
        public function save($params)
        {
            return $this->request($this->getModel(), 'save', $params);
        }

        /**
         * @inheritDoc
         */
        public function update($params)
        {
            return $this->request($this->getModel(), 'update', $params);
        }

        /**
         * @inheritDoc
         */
        public function delete($params)
        {
            return $this->request($this->getModel(), 'delete', $params);
        }
    }