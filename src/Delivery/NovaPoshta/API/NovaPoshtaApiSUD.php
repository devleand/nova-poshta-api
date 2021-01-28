<?php

    namespace Delivery\NovaPoshta\API;


    interface NovaPoshtaApiSUD
    {
        /**
         * Save method of current model
         *
         * @param mixed $params
         *
         * @return array
         */
        public function save($params);

        /**
         * Update method of current model
         *
         * @param mixed $params
         *
         * @return array
         */
        public function update($params);

        /**
         * Delete method of current model
         *
         * @param mixed $params
         *
         * @return array
         */
        public function delete($params);
    }