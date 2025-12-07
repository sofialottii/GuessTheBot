# Guess The Bot

[![en](https://img.shields.io/badge/lang-en-red.svg)](README.md)
[![it](https://img.shields.io/badge/lang-it-green.svg)](README.it.md)

*Read this in [English](README.md).*

## Descrizione del Progetto

Progetto sviluppato per la tesi di laurea, consiste in una web app interattiva il cui scopo è analizzare la capacità degli utenti di distinguere tra descrizioni testuali generate da un essere umano e quelle generate da un Large Language Model (LLM).

L'applicazione presenta all'utente una serie di infografiche, ognuna accompagnata da una descrizione. L'utente deve quindi indovinare l'origine del testo e, facoltativamente, fornire una motivazione per la sua scelta o consigli per migliorare l'esperienza dell'applicazione. I risultati vengono raccolti per calcolare un punteggio e stilare una classifica dei partecipanti.

È possibile accedere all'area riservata, che permette di modificare l'esperienza di gioco a 360°.

| Username | Password |
| :--- | :--- |
| admin1 | password1 |
| admin2 | password2 |
| admin3 | password3 |

## Tecnologie Utilizzate

* **Frontend**: HTML, CSS, Bootstrap, JavaScript
* **Backend**: PHP
* **Database**: MySQL
* **Server Stack**: Apache

## Setup Locale

Ecco i passaggi da seguire per eseguire l'app in locale:

1.  **Clona la Repository**
    ```bash
    git clone [https://github.com/sofialottii/GuessTheBot.git]
    ```
2.  **Sposta la Repository**<br>
    Il progetto clonato deve essere spostato all'interno di questo percorso: C:\xampp\htdocs.

3.  **Crea il Database**<br>
    Aprire http://localhost/phpmyadmin/index.php?route=/ (phpMyAdmin), premere su "SQL". Copiare e incollare nell'apposita area il contenuto di db/GuessTheBotDatabase.SQL e subito dopo fare la stessa con db/inserisciDati.SQL

4.  **Avvia l'Applicazione**<br>
    Da un browser, andare all'indirizzo `http://localhost/GuessTheBot`.

## Screenshots

<p align="center">
  <b>Home</b><br>
  <img src="screenshots/home.png" width="800">
</p>

<p align="center">
  <b>Game Loop</b><br>
  <img src="screenshots/gameloop.png" width="800">
</p>

<p align="center">
  <b>Gestione Eventi</b><br>
  <img src="screenshots/events.png" width="800">
</p>

<p align="center">
  <b>Dettaglio Infografiche</b><br>
  <img src="screenshots/statsImage.png" width="800">
</p>

## Autore

* **Irene Sofia Lotti** - Ingegneria e Scienze Informatiche, UniBO
