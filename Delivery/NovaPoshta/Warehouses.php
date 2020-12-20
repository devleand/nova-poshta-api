<?php

    namespace Delivery\NovaPoshta;


    class Warehouses extends Models\AddressGeneral
    {
        /**
         * @inheritDoc
         */
        public function get($isUsePageCounter = false)
        {
            return $this
                ->setMethod('getWarehouses')
                ->getPage($isUsePageCounter);
        }
    }