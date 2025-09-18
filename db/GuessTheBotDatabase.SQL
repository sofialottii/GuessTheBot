-- interamente scritto da Irene Sofia Lotti
-- crediti: Irene Sofia Lotti
-- Data: 11-09-2025
-- Descrizione:
-- Questo file contiene la creazione del database Guess The Bot, che include le tabelle per le note, i progetti e le attività.

-- Eliminiamo il database se esiste già
DROP DATABASE IF EXISTS GuessTheBot;

-- Creiamo il database Bullet Journal
CREATE DATABASE GuessTheBot;

-- Selezioniamo il database appena creato
USE GuessTheBot;

-- Creiamo le tabelle

CREATE TABLE USERS (
    UserID INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    Name VARCHAR(100) NOT NULL,
    Creation_timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE INFOGRAPHICS(
    InfographicID INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    Title VARCHAR(150) NOT NULL,
    ImagePath VARCHAR(200) NOT NULL,
    HumanText TEXT,
    LlmText TEXT
);

CREATE TABLE ANSWERS(
    AnswerID INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    InfographicID INT NOT NULL,
    UserID INT NOT NULL,
    TextShown ENUM('human', 'llm') NOT NULL,
    UserChoice ENUM('human', 'llm') NOT NULL,
    IsCorrect CHAR(1) DEFAULT 'N',
    Motivation TEXT NULL,
    AnsweredAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    FOREIGN KEY (InfographicID) REFERENCES INFOGRAPHICS(InfographicID),
    FOREIGN KEY (UserID) REFERENCES USERS(UserID)
);

CREATE TABLE ADMIN(
    Username VARCHAR(50) NOT NULL PRIMARY KEY,
    Password VARCHAR(255) NOT NULL
);



