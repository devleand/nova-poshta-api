<?php

    namespace Delivery\NovaPoshta;

    class Towns extends Models\AddressGeneral
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