<?php

    namespace Delivery\NovaPoshta\Models;

    abstract class InternetDocument extends \Delivery\NovaPoshta\API\NovaPoshtaApiPrint
    {
        /**
         * @var string
         */
        protected $model = 'InternetDocument';

        /**
         * @var string
         */
        protected $printMethod = 'printDocument';

        /**
         * @param   bool        $isUsePageCounter
         *
         * @return  array|null
         */
        protected function getDocumentList($isUsePageCounter = false)
        {
            $this->setMethod('getDocumentList');
            $params = $this->getParams();
            if (is_array($params)) {
                if ($params['GetFullList'] == 0) {
                    return $this->getPage($isUsePageCounter);
                }
            }
            return $this->execute();
        }

        /**
         * Get document info by ID.
         *
         * @param string $ref Document ID
         *
         * @return array
         */
        protected function getDocument($ref)
        {
            return $this->request($this->getModel(), 'getDocument', [
                'Ref' => $ref,
            ]);
        }

        /**
         * Save method of current model
         *
         * @param array $params
         *
         * @return array|null
         */
        protected function save($params)
        {
            return $this->request($this->getModel(), 'save', $params);
        }

        /**
         * Update method of current model
         *
         * @param array $params
         *
         * @return array|null
         */
        protected function update($params)
        {
            return $this->request($this->getModel(), 'update', $params);
        }

        /**
         * Delete method of current model
         *
         * @param array $refs Array of Documents IDs
         *
         * @return array
         */
        protected function delete($refs)
        {
            if (!is_array($refs)) {
                return $this->prepare([
                        'success' => false,
                        'data' => [],
                        'errors' => ['There are only invalid DocumentRefs'],
                        'warnings' => [],
                        'info' => []
                    ]);
            }
            return $this->request($this->getModel(), 'delete', [
                'DocumentRefs' => $refs
            ]);
        }

        /**
         * Get only link on internet document for printing.
         *
         * @param string       $method       Called method of NovaPoshta API
         * @param array|string $documentRefs Array of Documents IDs
         * @param string       $type         (pdf|html|html_link|pdf_link)
         *
         * @return string
         */
        protected function printGetLink($method, $documentRefs, $type)
        {
            $key = $this->getKey();
            $orders = is_array($documentRefs) ? implode(',', $documentRefs) : (string) $documentRefs;
            $type = str_replace('_link', '', $type);

            return "https://my.novaposhta.ua/orders/$method/orders[]/$orders/type/$type/apiKey/$key";
        }

        /**
         * Get only data for printing.
         *
         * @param   string  $method    Called method of NovaPoshta API
         * @param   array   $refs      Array of Documents IDs
         * @param   string  $type      (pdf|html|html_link|pdf_link)
         *
         * @return  array|null
         */
        protected function printGetData($method, $refs, $type)
        {
            return $this->request($this->getModel(), $method, ['DocumentRefs' => $refs, 'Type' => $type]);
        }

        /**
         * printMarkings method of current model.
         *
         * @param array|string $refs        Array of Documents IDs
         * @param string       $type        (pdf|new_pdf|new_html|old_html|html_link|pdf_link)
         *
         * @return mixed
         */
        protected function printMarkings($refs, $type)
        {
            // If needs link
            if ('html_link' == $type || 'pdf_link' == $type) {
                return $this->printGetLink('printMarkings', $refs, $type);
            }
            // If needs data
            return $this->printGetData('printMarkings', [ $refs ], $type);
        }
    }
