<?php

    namespace Delivery\NovaPoshta\Models;


    abstract class Address extends \Delivery\NovaPoshta\API\NovaPoshtaApi implements \Delivery\NovaPoshta\API\NovaPoshtaAPIGet
    {
        /**
         * @inheritDoc
         */
        protected $model = 'Address';
    }