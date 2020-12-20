<?php

    namespace Delivery\NovaPoshta;


    class CommonGenerals extends Models\CommonGeneral
    {
        public function getMessageCodeText()
        {
            $this->request($this->getModel(), 'getMessageCodeText');
        }
    }