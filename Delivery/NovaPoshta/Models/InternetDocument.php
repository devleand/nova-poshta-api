<?php

    namespace Delivery\NovaPoshta\Models;


    abstract class InternetDocument extends \Delivery\NovaPoshta\API\NovaPoshtaApi implements \Delivery\NovaPoshta\API\NovaPoshtaAPIGet, \Delivery\NovaPoshta\API\NovaPoshtaApiSUD, \Delivery\NovaPoshta\API\NovaPoshtaApiPrint
    {
        protected $model = 'InternetDocument';

        /**
         * @inheritDoc
         */
        public function save($params)
        {
            return $this->request($this->getModel(), 'save', $params);
        }

        /**
         * @inheritDoc
         */
        public function update($params)
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
        public function delete($refs)
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
         * printDocument method of current model.
         *
         * @param array|string $refs        Array of Documents IDs
         * @param string       $type        (pdf|html|html_link|pdf_link)
         *
         * @return mixed
         */
        public function _print($refs, $type)
        {
            $refs = [$refs];
            // If needs link
            if ('html_link' == $type || 'pdf_link' == $type) {
                return $this->printGetLink('printDocument', $refs, $type);
            }
            // If needs data
            return $this->request($this->getModel(), 'printDocument', ['DocumentRefs' => $refs, 'Type' => $type]);
        }
    }