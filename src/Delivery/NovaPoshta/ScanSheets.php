<?php

    namespace App\Delivery\NovaPoshta;

    use Delivery\NovaPoshta\API\NovaPoshtaApiGet;
    use Delivery\NovaPoshta\API\NovaPoshtaApiPrinting;
    use Delivery\NovaPoshta\API\NovaPoshtaApiSUD;

    class ScanSheets extends Models\ScanSheet implements NovaPoshtaApiGet, NovaPoshtaApiSUD, NovaPoshtaApiPrinting
    {

        /**
         * @inheritDoc
         */
        public function get($isUsePageCounter = false)
        {
            $this->getScanSheetList();
        }

        /**
         * Создать новый реестр.
         *
         * @param array         $params     Возможные пары ключ-значение:
         *                                  'docRefs'   => [ Массив идентификаторов документов ]
         *                                  'date'      => 'Дата, если требуется создать реестр на определенную дату'
         *
         * @return array|null
         *
         * @throws \Exception
         */
        public function save($params)
        {
            $registerData = array_key_exists('date', $params) ? [
                'date' => $params['date']
            ] : null;
            return $this->insertDocuments($params['docRefs'], $registerData);
        }

        /**
         * Редактировать реестр.
         *
         * @param array         $params     Обязательные пары ключ-значение:
         *                                      'ref' => 'Идентификатор реестра'
         *                                  Возможные пары ключ-значение:
         *                                      'docsAdd' => [ Массив идентификаторов документов, которые требуется добавить в реестр  ]
         *                                      'docsDel' => [ Массив идентификаторов документов, которые требуется удалить из реестра ]
         *
         * @return array
         *
         * @throws \Exception
         */
        public function update($params)
        {
            $ref = $params['ref'];
            $data = [];

            $key = 'docsAdd';
            if (array_key_exists($key, $params)) {
                $data[$key] = $this->insertDocuments($params[$key], [
                    'ref' => $ref
                ]);
            }
            $key = 'docsDel';
            if (array_key_exists($key, $params)) {
                $data[$key] = $this->removeDocuments($ref, $params[$key]);
            }

            return $data;
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
        public function delete($refs)
        {
            return $this->deleteScanSheet($refs);
        }

        /**
         * @inheritDoc
         */
        public function _print($ref, $type)
        {
            return $this->printGet($ref, $type);
        }
    }
