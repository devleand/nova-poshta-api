<?php

    namespace Delivery\NovaPoshta;

    class Areas extends Models\Address implements \Delivery\NovaPoshta\API\NovaPoshtaApiGet
    {
        /**
         * @inheritDoc
         */
        public function get($isUsePageCounter = false)
        {
            return $this
                ->setMethod('getAreas')
                ->execute();
        }
    }
