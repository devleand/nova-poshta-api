<?php

    namespace Delivery\NovaPoshta;


    class CounterpartyContactPersons extends Models\ContactPerson implements \Delivery\NovaPoshta\API\NovaPoshtaApiSUD
    {
        /**
         * @inheritDoc
         */
        public function save($params)
        {
            return parent::save($params); // TODO: Change the autogenerated stub
        }

        /**
         * @inheritDoc
         */
        public function update($params)
        {
            return parent::update($params); // TODO: Change the autogenerated stub
        }

        /**
         * @inheritDoc
         */
        public function delete($ref)
        {
            return parent::delete($ref); // TODO: Change the autogenerated stub
        }
    }