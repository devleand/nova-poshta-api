<?php

    namespace Delivery\NovaPoshta;

    class WarehouseTypes extends Models\AddressGeneral
    {
        /**
         * @inheritDoc
         */
        public function get($isUsePageCounter = false)
        {
            return $this
                ->setMethod('getWarehouseTypes')
                ->execute();
        }
    }