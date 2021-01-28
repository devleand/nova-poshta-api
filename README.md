# Nova Poshta API 2.0

[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)

Библиотека классов для работы с API 2.0 службы доставки Новая Почта

# Подготовка
## Получение ключа API
Для использования API необходимо:
* зарегистрироваться на сайте [Новой Почты](http://novaposhta.ua)
* На [странице настроек](https://my.novaposhta.ua/settings/index#apikeys) в личном кабинете сгенерировать ключ для работы с API

# Установка

## git

``` bash
$ git clone https://github.com/devleand/nova-poshta-api
```

## composer

``` bash
$ composer require devleand/nova-poshta-api
```

# Использование

## Структура классов

### Конструктор

Каждый класс API наследуется от базового класса NovaPoshtaApi.
Конструкторы классов идентичны и нследуются от данного базового класса. 
Принимают 1 обязательный и 3 не обязательных параметра:

``` php
/**
 * Default constructor.
 *
 * @param string $key            NovaPoshta API key
 * @param string $language       Default Language
 * @param bool   $throwErrors    Throw request errors as Exceptions
 * @param string $connectionType Connection type (curl | file_get_contents)
 */
public function __construct($key, $language = 'ru', $throwErrors = false, $connectionType = 'curl')
{
    ...
```

### Интерфейсы

Объекты, реализующие интерфейс NovaPoshtaApiPrint могут быть получены в печатной форме.
Объекты, реализующие интерфейс NovaPoshtaApiSUD могут добавляться/изменяться/удаляться.
Объекты, реализующие интерфейс NovaPoshtaApiGet могут быть получены постранично с помощью
соответствующего метода (см. ниже "Пагинация").

### Модели

Каждый конкретный класс соответствует определенной абстрактной модели API Новой Почты.

## Пагинация

Вместо того, чтобы явно указывать номер желаемой страницы при обращении к API с помощью классов, 
реализующих интерфейс NovaPoshtaAPIGet, есть возможность использования счетчика путем передачи значения 
true в качестве единственного параметра для метода get():

``` php
/**
 * Get data of current model.
 *
 * @param bool $isUsePageCounter
 *
 * @return array
 */
public function get($isUsePageCounter = false);
```

Счетчик будет увеличиваться после каждого вызова данного метода. Когда данные кончаться, Вы получите
пустой массив данных. Сбросить счетчик можно путем вызова метода pageCounterReset().

## Примеры

### Warehouses

``` php
namespace Delivery\NovaPoshta;

$Warehouses = new Warehouses("ВАШ_КЛЮЧ");
$Warehouses->setParams([
    'SettlementRef' => 'e718a680-4b33-11e4-ab6d-005056801329',
    'Limit' => 1000,
    'Page' => 1
]);
    
print_r($Warehouses->get());
```

аналогично с использование счетчика:

``` php
namespace Delivery\NovaPoshta;

$Warehouses = new Warehouses("ВАШ_КЛЮЧ");
$Warehouses->setParams([
    'SettlementRef' => 'e718a680-4b33-11e4-ab6d-005056801329',
    'Limit' => 1000,
]);
    
print_r($Warehouses->get(true));
```

### Counterparties

``` php
namespace Delivery\NovaPoshta;

$Counterparties = new Counterparties("ВАШ_КЛЮЧ");
$Counterparties->setParams([
    'CounterpartyProperty' => 'Sender'
]);
print_r($Counterparties->getContactPersons([
    'Ref'   => $Counterparties->get()['data'][0]['Ref'],
    'Page'  => 1
]));
```

### InternetDocuments

#### GET

``` php
$InternetDocuments = new InternetDocuments("ВАШ_КЛЮЧ");
$InternetDocuments->setParams([
    'DateTimeFrom' => "21.06.2020",
    'DateTimeTo' => "21.12.2020",
    'GetFullList' => 0
]);
print_r($InternetDocuments->get(true));
```

# License

The MIT License (MIT). Please see [License File](https://github.com/dnoegel/php-xdg-base-dir/blob/master/LICENSE) for more information.