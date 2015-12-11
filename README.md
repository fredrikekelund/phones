# Telefonnummer
Fredrik Ekelund, 2015

Den här webbapplikationen avgör vilken teleoperatör som har billigast taxa för
ett telefonnummer baserat på dess landsprefix (ex. 46). Back-enden är skriven i
PHP och front-enden i HTML, SASS och JavaScript. Både front- och back-enden är
enhetstestade.

## Starta applikationen
Applikationen körs med fördel med hjälp av PHP:s inbyggda webbserver. Öppna en
terminal och kör `php -S localhost:8000`. Nu kan du öppna
[localhost:8000](http://localhost:8000) i webbläsaren.

## Back-end
Back-enden är skriven i PHP och fungerar som ett enkelt REST-API (byggt på
[Slim 2.6](http://www.slimframework.com/)) som klienten kan kalla på med
GET-anrop. För att installera dependencies, hämta först
[Composer](https://getcomposer.org/), kör sedan `composer install` i `./api`.

## Front-end
Jag har använt mig av [npm](https://www.npmjs.com/) för att hantera dependencies
och specificerat ett par build-skript i `package.json`. Kör `npm run build` för
att bygga JavaScript- och CSS-filerna. För att bygga gränssnittet har jag använt
mig av [knockout.js](http://knockoutjs.com/) - ett enkelt MVVM-bibliotek - och
[Bootstrap](http://getbootstrap.com/) - ett populärt CSS-ramverk.

### Tester
För att köra testerna behöver [node](https://nodejs.org/en/) vara installerat.
När det är gjort, installera alla dependencies genom att köra `npm install`
i `./client`. För att sedan köra testerna, kör `npm test` i samma mapp.
