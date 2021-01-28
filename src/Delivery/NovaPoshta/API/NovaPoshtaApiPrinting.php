<?php

    namespace Delivery\NovaPoshta\API;


    interface NovaPoshtaApiPrinting
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
