<?php

    namespace Delivery\NovaPoshta\API;

    abstract class NovaPoshtaApiPrint extends \Delivery\NovaPoshta\API\NovaPoshtaApi
    {
        /**
         * Name method of current model for print.
         *
         * @var string
         */
        protected $printMethod;

        /**
         * @return string
         */
        protected function getPrintMethod()
        {
            return $this->printMethod;
        }

        /**
         * Print method of current model.
         *
         * @param   string          $refs       Array of Documents IDs
         * @param   string          $type       (pdf|html|html_link|pdf_link)
         * @param   string|null     $method     API method
         *
         * @return  mixed
         */
        protected function printGet($refs, $type, $method = null)
        {
            if (is_null($method)) {
                $method = $this->getPrintMethod();
            }
            // If needs link
            if (strripos($type, '_link') !== false) {
                return $this->printGetLink($method, $refs, $type);
            }
            // If needs data
            return $this->printGetData($method, [ $refs ], $type);
        }

        /**
         * Get only link for printing.
         *
         * @param   string    $method     Called method of NovaPoshta API
         * @param   string    $refs       Array of Documents IDs
         * @param   string    $type       (html_link|pdf_link)
         *
         * @return  string
         */
        abstract protected function printGetLink($method, $refs, $type);

        /**
         * Get only data for printing.
         *
         * @param   string  $method    Called method of NovaPoshta API
         * @param   array   $refs      Array of Documents IDs
         * @param   string  $type      (pdf|html)
         *
         * @return  mixed
         */
        abstract protected function printGetData($method, $refs, $type);
    }
