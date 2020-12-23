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
         * @param   string    $refs   Array of Documents IDs
         * @param   string    $type   (pdf|html|html_link|pdf_link)
         *
         * @return  mixed
         */
        protected function printGet($refs, $type)
        {
            // If needs link
            if ('html_link' == $type || 'pdf_link' == $type) {
                return $this->printGetLink($this->getPrintMethod(), $refs, $type);
            }
            // If needs data
            return $this->printGetData($this->getPrintMethod(), [ $refs ], $type);
        }

        /**
         * Get only link for printing.
         *
         * @param   string    $method     Called method of NovaPoshta API
         * @param   string    $refs       Array of Documents IDs
         * @param   string    $type       (pdf|html|html_link|pdf_link)
         *
         * @return  string
         */
        abstract protected function printGetLink($method, $refs, $type);

        /**
         * Get only data for printing.
         *
         * @param   string  $method    Called method of NovaPoshta API
         * @param   array   $refs      Array of Documents IDs
         * @param   string  $type      (pdf|html|html_link|pdf_link)
         *
         * @return  mixed
         */
        abstract protected function printGetData($method, $refs, $type);
    }
