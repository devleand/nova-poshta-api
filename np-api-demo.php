<?php
    namespace Delivery\NovaPoshta;

    spl_autoload_register();

    $key = "API key";

    /*
    $Warehouses = new Warehouses($key);
    $Warehouses->setParams([
        'SettlementRef' => 'e718a680-4b33-11e4-ab6d-005056801329',
        'Limit' => 1000
    ]);

    var_dump($Warehouses->get(true)['data'][0]);
    echo "<br><br>";
    var_dump($Warehouses->get(true)['data'][0]);
    echo "<br><br>";
    var_dump($Warehouses->get(true));
    echo "<br><br>";
    */

    /*
    $Counterparties = new Counterparties($key);
    $Counterparties->setParams([
        'CounterpartyProperty' => 'Sender'
    ]);
    var_dump($Counterparties->getContactPersons([
        'Ref'   => $Counterparties->get()['data'][0]['Ref'],
        'Page'  => 1
    ]));
    */

    /*
    $InternetDocuments = new InternetDocuments($key);
    $InternetDocuments->setParams([
        'DateTimeFrom' => "21.06.2020",
        'DateTimeTo' => "21.12.2020",
        'GetFullList' => 0
    ]);
    var_dump($InternetDocuments->get(true));
    */