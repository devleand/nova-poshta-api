<?php

    namespace Delivery\NovaPoshta\API;

    interface NovaPoshtaApiGet
    {
        /**
         * Get data of current model.
         *
         * @param bool $isUsePageCounter
         *
         * @return array
         */
        public function get($isUsePageCounter = false);
    }