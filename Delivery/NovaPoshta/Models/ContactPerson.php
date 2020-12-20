<?php

    namespace Delivery\NovaPoshta\Models;


    abstract class ContactPerson extends \Delivery\NovaPoshta\API\NovaPoshtaApi implements \Delivery\NovaPoshta\API\NovaPoshtaApiSUD
    {
        protected $model = 'ContactPerson';

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
         * Delete method of current model
         *
         * @param string $ref Counterparty Contact ID
         *
         * @return array
         */
        public function delete($ref)
        {
            return $this->request($this->getModel(), 'delete', [
                'Ref' => $ref
            ]);
        }
    }