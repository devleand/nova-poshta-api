<?php

    namespace Delivery\NovaPoshta\API;


    interface NovaPoshtaAPIGet
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