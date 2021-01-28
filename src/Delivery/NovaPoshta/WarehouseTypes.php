<?php

    namespace Delivery\NovaPoshta;

    class WarehouseTypes extends Models\AddressGeneral implements \Delivery\NovaPoshta\API\NovaPoshtaApiGet
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
