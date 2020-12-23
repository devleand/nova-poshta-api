<?php

    namespace Delivery\NovaPoshta;


    class Warehouses extends Models\AddressGeneral implements \Delivery\NovaPoshta\API\NovaPoshtaAPIGet
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
