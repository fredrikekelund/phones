# Telefonnummer
Fredrik Ekelund, 2015

Den här webbapplikationen avgör vilken teleoperatör som har billigast taxa för
ett telefonnummer baserat på dess landsprefix (ex. 46). Back-enden är skriven i
PHP och front-enden i HTML, SASS och JavaScript. Både front- och back-enden är
enhetstestade.

## Back-end

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
