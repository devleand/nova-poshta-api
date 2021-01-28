<?php

    namespace Delivery\NovaPoshta\API;

    abstract class NovaPoshtaApi {

        protected $requestLastData;

        /**
         * Key for API NovaPoshta.
         *
         * @var string
         *
         * @see https://my.novaposhta.ua/settings/index#apikeys
         */
        protected $key;

        /**
         * @var bool Throw exceptions when in response is error
         */
        protected $throwErrors = false;

        /**
         * @var string Language of response
         */
        protected $language = 'ru';

        /**
         * @var string Connection type (curl | file_get_contents)
         */
        protected $connectionType = 'curl';

        /**
         * @var string Set current model
         */
        protected $model;

        /**
         * @var string Set "main" method of current model
         */
        protected $method;

        /**
         * @var array Set params of current method of current model
         */
        protected $params;

        /**
         * @var integer Page counter for current get method for current model
         */
        protected $pageCounter = 1;

        /**
         * Default constructor.
         *
         * @param string $key            NovaPoshta API key
         * @param string $language       Default Language
         * @param bool   $throwErrors    Throw request errors as Exceptions
         * @param string $connectionType Connection type (curl | file_get_contents)
         *
         * @return $this
         */
        public function __construct($key, $language = 'ru', $throwErrors = false, $connectionType = 'curl')
        {
            $this->throwErrors = $throwErrors;
            return $this
                ->setKey($key)
                ->setLanguage($language)
                ->setConnectionType($connectionType);
        }

        protected function setRequestLastData($data)
        {
            $this->requestLastData = $data;
            return $this;
        }

        public function getRequestLastData()
        {
            return $this->requestLastData;
        }

        /**
         * Setter for key property.
         *
         * @param string $key NovaPoshta API key
         *
         * @return $this
         */
        final protected function setKey($key)
        {
            $this->key = $key;
            return $this;
        }

        /**
         * Setter for language property.
         *
         * @param string $language
         *
         * @return $this
         */
        final protected function setLanguage($language)
        {
            $this->language = $language;
            return $this;
        }

        /**
         * Setter for $connectionType property.
         *
         * @param string $connectionType Connection type (curl | file_get_contents)
         *
         * @return $this
         */
        final protected function setConnectionType($connectionType)
        {
            $this->connectionType = $connectionType;
            return $this;
        }

        /**
         * Setter for $method property.
         *
         * @param string $method
         *
         * @return $this
         */
        final protected function setMethod($method)
        {
            $this->method = $method;
            return $this;
        }

        /**
         * Set params of current method property.
         *
         * @param array $params
         *
         * @return mixed
         */
        final public function setParams($params)
        {
            $this->params = $params;
            return $this;
        }

        /**
         * Getter for key property.
         *
         * @return string
         */
        final public function getKey()
        {
            return $this->key;
        }

        /**
         * Getter for language property.
         *
         * @return string
         */
        final public function getLanguage()
        {
            return $this->language;
        }

        /**
         * Getter for $connectionType property.
         *
         * @return string
         */
        final public function getConnectionType()
        {
            return $this->connectionType;
        }

        /**
         * Getter for $model property.
         *
         * @return string
         */
        final public function getModel()
        {
            return $this->model;
        }

        /**
         * Getter for $method property.
         *
         * @return string
         */
        final public function getMethod()
        {
            return $this->method;
        }

        /**
         * Getter for $params property.
         *
         * @return array
         */
        final public function getParams()
        {
            return $this->params;
        }

        /**
         * Prepare data before return it.
         *
         * @param json $data
         *
         * @return array
         */
        final protected function prepare($data)
        {
            $data = is_array($data) ? $data : json_decode($data, true);

            if (is_null($data)) {
                return null;
            }

            // If error exists, throw Exception
            if ($this->throwErrors && $data['errors']) {
                throw new \Exception(is_array($data['errors']) ? implode("\n", $data['errors']) : $data['errors']);
            }

            return $data;
        }

        /**
         * Make request to NovaPoshta API.
         *
         * @param string $model  Model name
         * @param string $method Method name
         * @param array  $params Required params
         */
        final protected function request($model, $method, $params = null)
        {
            // Get required URL
            $url = 'https://api.novaposhta.ua/v2.0/json/';

            $data = [
                'apiKey' => $this->getKey(),
                'modelName' => $model,
                'calledMethod' => $method,
                'language' => $this->getLanguage(),
                'methodProperties' => $params,
            ];
            $this->setRequestLastData($data);
            // Convert data to neccessary format
            $post = json_encode($data);

            if ('curl' == $this->getConnectionType()) {
                $ch = curl_init($url);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
                curl_setopt($ch, CURLOPT_HEADER, false);
                curl_setopt($ch, CURLOPT_POST, true);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
                $result = curl_exec($ch);
                curl_close($ch);
            } else {
                $result = file_get_contents($url, false, stream_context_create([
                    'http' => [
                        'method' => 'POST',
                        'header' => "Content-type: application/json;\r\n",
                        'content' => $post,
                    ],
                ]));
            }

            return $this->prepare($result);
        }

        /**
         * Execute request to NovaPoshta API.
         *
         * @return array
         */
        final protected function execute()
        {
            return $this->request($this->getModel(), $this->getMethod(), $this->getParams());
        }

        /**
         * Reset page counter.
         *
         * @return $this
         */
        final public function pageCounterReset()
        {
            $this->pageCounter = 1;
            return $this;
        }

        /**
         * Get $pageCounter and increment $pageCounter.
         *
         * @return integer
         */
        final protected function pageCounter()
        {
            $pageCounter = $this->pageCounter;
            $this->pageCounter++;
            return $pageCounter;
        }

        /**
         * Get data of current model usage page counter.
         *
         * @param bool $isUsePageCounter
         *
         * @return array
         */
        protected function getPage($isUsePageCounter = false)
        {
            if ($isUsePageCounter) {
                $new_params = $this->getParams();
                $page_counter = $this->pageCounter();
                if (is_array($new_params)) {
                    $new_params['Page'] = $page_counter;
                } else {
                    $new_params = [
                        'Page' => $page_counter
                    ];
                }

                $this->setParams($new_params);
            }

            return $this->execute();
        }
    }
