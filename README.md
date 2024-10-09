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

Per questo progetto era inoltre conveniente dato che permette di salavare il database in un unico file senza avere la necessità di appoggiarsi ad una base di dati esterna.

### Gestione dei dati importati

Durante l'importazione dei dati si è deciso di non far coinciere gli id identificativi delle offer e dei shop con gli id del database locale ma di salvare tali id in campi appositi come ext_shop_id e ext_offer_id.

Tale meccanismo permette infatti di poter gestire in modo separato il database locale e matenendo comunque un rifirimento all'id originale della fonte.

---
---

## API

Sono presenti tre set principali di api chiamabili esternamente
