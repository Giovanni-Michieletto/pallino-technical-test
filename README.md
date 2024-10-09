# Manuale d'uso

## Requisiti

## Descrizione

Sviluppare un sistema in PHP (sulla piattaforma che si preferisce) che, salvi le informazioni fornite dalle fonti sotto descritte su una base dati e metta a disposizione le API sotto riportate.

## Fonti dati

- API per gli shop: <https://test.pallinolabs.it/api/v1/shops.json>
- CSV per gli shop: <https://test.pallinolabs.it/shops.csv>
- API per le offerte: <https://test.pallinolabs.it/api/v1/offers.json>

## Api da produrre

- **/api/v1/offers/{shopID} [GET]**: restituisce le offerte dello shop ordinate in modo crescente per prezzo
- **/api/v1/offers/{countryCode} [GET]**: ritorna le offerte presenti nel paese selezionato e con esse anche gli shop in cui trovare il prodotto.

Si lascia al candidato la gestione di eventuali decisioni da prendere per i punti non specificati (test, ottimizzazioni varie, ecc ) ed una breve documentazione per avviare il progetto e rendere operative le API.

**Scadenza**: venerdì 11/10/2024

---
---

## Considerazioni

### Base di dati

È stato deciso di usare SQLite dato che permette di creare e gestire un piccolo database in maniera molto veloce.

Per questo progetto era inoltre conveniente dato che permette di salvare il database in un unico file senza avere la necessità di appoggiarsi ad una base di dati esterna.

### Gestione dei dati importati

Durante l'importazione dei dati si è deciso di non far coinciere gli id identificativi delle offer e dei shop con gli id del database locale ma di salvare tali id in campi appositi come ext_shop_id e ext_offer_id.

Tale meccanismo permette infatti di poter gestire in modo separato il database locale matenendo comunque un riferimento all'id originale della fonte.

---
---

## API

È possibile visualizzare la documentazione api secondo tre modalità :

- [UI viewer for your documentation](http://127.0.0.1:8000/docs/api)
- [Open API document in JSON format describing your API.](http://127.0.0.1:8000/docs/api.json)
- [Json file](./api_documentation.json)

Per i primi due link è necessario prima lanciare un server locale

## Avvio del progetto

1. Scaricare il repository
2. Lanciare il comando `composer install`
3. Rinominare `.env.example` in `.env`
4. Lanciare il comando `php artisan migrate`
5. Lanciare il comando `php artisan db:seed --class=Database\Seeders\DatabaseSeeder`
6. Scaricare i dati secondo una delle seguenti modalità
    1. Lanciare i comandi `php artisan app:api --cmd=sync_shops`, `php artisan app:api --cmd=sync_offers`, `php artisan queue:works --stop-when-empty`
    2. Lanciare il comando `php artisan schedule:work`
    3. Lanciare il comando `php artisan queue:works` e il comando `php artisan serve`, poi chiamare le api di autenticazione e sincronizzazione
7. Lanciare il comando `php artisan serve` se non fatto in precedenza
8. Ora è possibile autenticarsi, se non fatto in precedenza, ed effettuare le chiamate api


