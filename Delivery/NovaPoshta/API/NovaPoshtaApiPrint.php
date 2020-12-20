<?php

    namespace Delivery\NovaPoshta\API;


    interface NovaPoshtaApiPrint
    {
        /**
         * print method of current object.
         *
         * @param array|string $refs
         * @param string       $type
         *
         * @return array
         */
        public function _print($refs, $type);
    }