CREATE database IF NOT EXISTS dnd5eItemManager;

CREATE USER IF NOT EXISTS 'bot'@'localhost' IDENTIFIED BY 'bot';
GRANT ALL PRIVILEGES ON dnd5eItemManager.* TO 'bot'@'localhost';


CREATE TABLE IF NOT EXISTS  dnd5eItemManager.Campaigns (
    CampaignsID INTEGER NOT NULL AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    description VARCHAR(255)
);

CREATE TABLE IF NOT EXISTS dnd5eItemManager.Saves (
    SavesID INTEGER NOT NULL AUTO_INCREMENT PRIMARY KEY,
    CampaignsID INTEGER NOT NULL,
    timestamp TIMESTAMP,#todo look up how to timestamp a insert statment
    Json longtext NOT NULL,
    description VARCHAR(255),
    FOREIGN KEY (CampaignsID) REFERENCES dnd5eItemManager.Campaigns(CampaignsID)
);


