# Boolfolio Back-End API

## Descrizione
Boolfolio è un’applicazione per la gestione e visualizzazione di un portfolio di progetti. Il back-end è sviluppato con **Laravel 10** e fornisce un'API RESTful per la gestione dei progetti, che possono essere visualizzati, aggiunti, modificati e cancellati. Il back-end interagisce con il front-end sviluppato in Vue.

Questo repository contiene il back-end del progetto. Il front-end è disponibile [qui](https://github.com/ginevrabotrugno/vite-boolfolio).

## Stack Tecnologico
- **Laravel 10**: Framework PHP per sviluppare l'API RESTful.
- **Breeze**: Per la gestione dell'autenticazione degli utenti nel back-end.
- **MySQL**: Database per memorizzare i dati dei progetti (configurabile tramite `.env`).
- **Laravel Eloquent ORM**: Per interagire con il database in modo semplice ed efficace.

## Funzionalità Principali
- **Gestione progetti**: Crea, leggi, aggiorna ed elimina progetti attraverso le API.
- **Autenticazione**: Breeze è utilizzato per gestire l'autenticazione degli utenti, fornendo una semplice registrazione, login e gestione delle sessioni.
- **Filtraggio e ricerca**: Fornisce endpoint per cercare e filtrare i progetti.
- **Risposte JSON**: Tutte le risposte dell'API sono in formato JSON, adatte per essere consumate dal front-end.

## Link Utili
- **Front-End Vue Repository**: [Boolfolio Front-End](https://github.com/ginevrabotrugno/vite-boolfolio)


