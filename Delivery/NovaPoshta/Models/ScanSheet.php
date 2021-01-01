<?php

    namespace App\Delivery\NovaPoshta\Models;

    abstract class ScanSheet extends \Delivery\NovaPoshta\API\NovaPoshtaApiPrint
    {
        /**
         * @var string
         */
        protected $model = 'ScanSheet';

        /**
         * @var string
         */
        protected $printMethod = 'printScanSheet';

        /**
         * Добавить экспресс-накладные в реестр.
         *
         * @param array         $docRefs            Массив идентификаторов документов.
         * @param array|null    $registerData       Может содержать следующие пары ключ-значение:
         *                                          'ref'   => 'Идентификатор реестра, если требуется добавить документы в существующий реестр',
         *                                          'date'  => 'Дата, если требуется создать реестр на определенную дату'
         *
         * @return array|null
         *
         * @throws \Exception
         */
        public function insertDocuments($docRefs, $registerData = null)
        {
            if (!is_array($docRefs)) {
                return $this->prepare([
                    'success' => false,
                    'data' => [],
                    'errors' => ['There are only invalid DocumentRefs'],
                    'warnings' => [],
                    'info' => []
                ]);
            }

            $data = [
                'DocumentRefs' => $docRefs
            ];
            if (!empty($registerData)) {
                $keys = [
                    'registerRef'   => [
                        'cur'   => 'ref',
                        'np'    => 'Ref',
                    ],
                    'registerDate'  => [
                        'cur'   => 'date',
                        'np'    => 'Date'
                    ]
                ];

                foreach ($keys as $key) {
                    if (array_key_exists($key['cur'], $registerData)) {
                        $data[$key['np']] = $registerData[$key['cur']];
                    }
                }
            }

            return $this->request($this->getModel(), 'insertDocuments', $data);
        }

        /**
         * Получить информацию по одному реестру.
         *
         * @param string        $ref                Идентификатор реестра.
         * @param null|string   $counterpartyRef    Идентификатор контрагента.
         *
         * @return array|null
         */
        public function getScanSheet($ref, $counterpartyRef = null)
        {
            $data = [
                'Ref' => $ref
            ];
            if (!empty($counterpartyRef)) {
                $data['CounterpartyRef'] = $counterpartyRef;
            }

            return $this->request($this->getModel(), 'getScanSheet', $data);
        }

        /**
         * Получить список реестров.
         *
         * @return array|null
         */
        protected function getScanSheetList()
        {
            return $this->request($this->getModel(), 'getScanSheetList');
        }

        /**
         * Удалить (расформировать) реестры отправлений.
         *
         * @param   array       $refs Массив идентификаторов реестров.
         *
         * @return  array|null
         *
         * @throws  \Exception
         */
        protected function deleteScanSheet($refs)
        {
            if (!is_array($refs)) {
                return $this->prepare([
                    'success' => false,
                    'data' => [],
                    'errors' => ['There are only invalid ScanSheetRefs'],
                    'warnings' => [],
                    'info' => []
                ]);
            }

            return $this->request($this->getModel(), 'deleteScanSheet', [
                'ScanSheetRefs' => $refs
            ]);
        }

        /**
         * Удалить экспресс-накладные из реестра.
         *
         * @param   string      $ref        Идентификатор реестра.
         * @param   array       $docRefs    Массив идентификаторов документов, которые необходимо удалить.
         *
         * @return array|null
         *
         * @throws \Exception
         */
        public function removeDocuments($ref, $docRefs)
        {
            return $this->request($this->getModel(), 'removeDocuments', [
                'Ref'           => $ref,
                'DocumentRefs'  => $docRefs,
            ]);
        }

        /**
         * @param   string      $method     Called method of NovaPoshta API
         * @param   string      $ref        ScanSheet ID or number
         * @param   string      $type       (pdf|html|html_link|pdf_link)
         * @return  string
         */
        protected function printGetLink($method, $ref, $type)
        {
            $ref = is_array($ref) ? implode(',', $ref) : (string)$ref;
            return "https://my.novaposhta.ua/scanSheet/$method/refs[]/$ref/type/".str_replace('_link', '', $type)."/apiKey/{$this->getKey()}";
        }

        /**
         * @param   string  $method     Called method of NovaPoshta API
         * @param   array   $ref        Array of ScanSheet ID or number
         * @param   string  $type       (pdf|html|html_link|pdf_link)
         *
         * @return  array|null
         */
        protected function printGetData($method, $ref, $type)
        {
            return $this->request($this->getModel(), $method, ['Ref' => $ref, 'Type' => $type]);
        }
    }
