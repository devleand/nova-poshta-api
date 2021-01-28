<?php

    namespace App\Delivery\NovaPoshta\Models;

    abstract class TrackingDocument extends \Delivery\NovaPoshta\API\NovaPoshtaApi
    {
        /**
         * @inheritDoc
         */
        protected $model = 'TrackingDocument';

        /**
         * Tracking.
         *
         * @param   array[]       $docs     Array of Documents
         * @return  array|null
         */
        public function getStatusDocuments($docs)
        {
            return $this->request($this->getModel(), 'getStatusDocuments', [
                'Documents' => $docs
            ]);
        }
    }
