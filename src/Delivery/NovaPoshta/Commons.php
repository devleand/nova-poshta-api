<?php

    namespace Delivery\NovaPoshta;


    class Commons extends Models\Common
    {

        public function getCargoTypes()
        {
            return $this->request($this->getModel(), 'getCargoTypes');
        }

        public function getBackwardDeliveryCargoTypes()
        {
            return $this->request($this->getModel(), 'getBackwardDeliveryCargoTypes');
        }

        public function getTypesOfPayers()
        {
            return $this->request($this->getModel(), 'getTypesOfPayers');
        }

        public function getTypesOfPayersForRedelivery()
        {
            return $this->request($this->getModel(), 'getTypesOfPayersForRedelivery');
        }

        public function getCargoDescriptionList($params = null)
        {
            return $this->request($this->getModel(), 'getCargoDescriptionList', $params);
        }

        public function getServiceTypes()
        {
            return $this->request($this->getModel(), 'getServiceTypes');
        }

        public function getTypesOfCounterparties()
        {
            return $this->request($this->getModel(), 'getTypesOfCounterparties');
        }

        public function getPaymentForms()
        {
            return $this->request($this->getModel(), 'getPaymentForms');
        }

        public function getOwnershipFormsList()
        {
            return $this->request($this->getModel(), 'getOwnershipFormsList');
        }
    }
