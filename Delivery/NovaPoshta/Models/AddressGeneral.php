<?php

    namespace Delivery\NovaPoshta\Models;


    abstract class AddressGeneral extends \Delivery\NovaPoshta\API\NovaPoshtaApi implements \Delivery\NovaPoshta\API\NovaPoshtaAPIGet
    {
        /**
         * @inheritDoc
         */
        protected $model = 'AddressGeneral';
    }