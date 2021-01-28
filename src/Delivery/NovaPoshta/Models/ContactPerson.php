<?php

    namespace Delivery\NovaPoshta\Models;

    abstract class ContactPerson extends \Delivery\NovaPoshta\API\NovaPoshtaApi
    {
        protected $model = 'ContactPerson';

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
         * @param string $ref Counterparty Contact ID
         *
         * @return array
         */
        protected function delete($ref)
        {
            return $this->request($this->getModel(), 'delete', [
                'Ref' => $ref
            ]);
        }
    }
