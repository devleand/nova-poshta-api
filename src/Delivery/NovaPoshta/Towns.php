<?php

    namespace Delivery\NovaPoshta;

    class Towns extends Models\AddressGeneral implements \Delivery\NovaPoshta\API\NovaPoshtaApiGet
    {
        /**
         * @inheritDoc
         */
        public function get($isUsePageCounter = false)
        {
            return $this
                ->setMethod('getSettlements')
                ->getPage($isUsePageCounter);
        }
    }
