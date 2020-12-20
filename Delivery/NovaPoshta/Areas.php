<?php

    namespace Delivery\NovaPoshta;

    class Areas extends Models\Address
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