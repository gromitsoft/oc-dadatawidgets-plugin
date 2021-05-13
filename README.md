## DadataWidgets plugin
Плагин интеграции подсказок сервиса Dadata в OctoberCMS v.2

## Установка

```
composer require gromit/oc-dadatawidgets-plugin
```

## Настройка

Для использования плагина, необходимо получить токен сервиса Dadata.
Получить токен можно бесплатно - необходимо зарегистрироваться на сайте https://dadata.ru/ и скопировать его в профиле.

Полученный токен (он же АПИ КЛЮЧ) вставляем в настройки плагина через
**Настройки -> Dadata Widgets**

## Использование

В конфиге формы указываем тип поля **dadataSuggestions**, тип подсказки **suggestion** и привязку данных к полям формы.

**Пример конфига поля:**
```yaml
name:
    label: Название компании
    type: dadataSuggestions
    suggestion: company
```

##Маппер
В конфиге поля можно указать соответствие данных, получаемых из сервиса Dadata, и полей формы, куда эти данные вставить.
```yaml
map:
    имя поля1: значение из ответа Dadata
    имя поля2: значение из ответа Dadata
    ...
    имя поляN: значение из ответа Dadata
```
Структура возвращаемых данных сервиса Dadata зависит от типа подсказки:

|Тип подсказки|Описание ответа |
|----------|-------------|
| suggestion:&nbsp;**company** |https://dadata.ru/api/suggest/party/#response |
| suggestion:&nbsp;**bank** |https://dadata.ru/api/suggest/bank/#response |
| suggestion:&nbsp;**address** |https://dadata.ru/api/suggest/address/#response |
| suggestion:&nbsp;**email** |https://dadata.ru/api/suggest/email/#response |
| suggestion:&nbsp;**fio** |https://dadata.ru/api/suggest/name/#response |

Соответственно в маппере используем описанные выше структуры данных.

##Примеры

Небольшие примеры использования виджета для разных ситуаций

## Поиск контрагента и заполнение нужных полей
```yaml
fields:
    name:
        label: Название компании
        type: dadataSuggestions
        suggestion: company
        map:
            name: value
            inn: data.inn
            kpp: data.kpp
            ogrn: data.ogrn
    inn:
        label: ИНН
    kpp:
        label: КПП
    ogrn:
        label: ОГРН
```
##Поиск банка
```yaml
fields:
    bank:
        label: Банк
        type: dadataSuggestions
        suggestion: bank
        map:
            bank: value
            bic: data.bic
            cs: data.correspondent_account
    bic:
        label: БИК
    cs:
        label: К/С
```

##Ввод адреса и его последующий разбор
```yaml
fields:
    address:
        label: Адрес
        type: dadataSuggestions
        suggestion: address
        map:
            address: value
            country: data.country
            city: data.city
            lat: data.geo_lat
            lon: data.geo_lon

    country:
        label: Страна
    city:
        label: Город
    lat:
        label: Координаты (широта)
    lon:
        label: Координаты (долгота)
```
##Помощь при вводе email-адреса и его разбор
```yaml
fields:
    email:
        label: Email
        type: dadataSuggestions
        suggestion: email
        map:
            email: value
            local: data.local
            domain: data.domain
    local:
        label: Локальное (до собачки)
    domain:
        label: Домен
```

##Помощь при вводе ФИО и разбор
```yaml
fields:
    fio:
        label: ФИО
        type: dadataSuggestions
        suggestion: fio
        map:
            fio: value
            surname: data.surname
            name: data.name
            patronymic: data.patronymic
            gender: data.gender
    surname:
        label: Фамилия
    name:
        label: Имя
    patronymic:
        label: Отчетство
    gender:
        label: Пол
```
