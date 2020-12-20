<?php

    namespace Delivery\NovaPoshta;


    class InternetDocuments extends Models\InternetDocument
    {

        /**
         * @inheritDoc
         */
        public function get($isUsePageCounter = false)
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
        public function getDocument($ref)
        {
            return $this->request($this->getModel(), 'getDocument', [
                'Ref' => $ref,
            ]);
        }

        /**
         * printMarkings method of current model.
         *
         * @param array|string $refs        Array of Documents IDs
         * @param string       $type        (pdf|new_pdf|new_html|old_html|html_link|pdf_link)
         *
         * @return mixed
         */
        public function printMarkings($refs, $type)
        {
            $refs = [$refs];
            // If needs link
            if ('html_link' == $type || 'pdf_link' == $type) {
                return $this->printGetLink('printMarkings', $refs, $type);
            }
            // If needs data
            return $this->request($this->getModel(), 'printMarkings', ['DocumentRefs' => $refs, 'Type' => $type]);
        }
    }