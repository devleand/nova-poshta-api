<?php

    namespace Delivery\NovaPoshta\Models;


    abstract class Address extends \Delivery\NovaPoshta\API\NovaPoshtaApi
    {
        /**
         * @inheritDoc
         */
        protected $model = 'Address';
    }
