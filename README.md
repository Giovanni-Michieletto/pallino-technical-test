# Test tecnico

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
