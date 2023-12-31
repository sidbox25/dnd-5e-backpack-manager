CREATE database IF NOT EXISTS dnd5eItemManager;

CREATE TABLE IF NOT EXISTS dnd5eItemManager.Campaign (
    campaignID INTEGER NOT NULL AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    description VARCHAR(255)
);

CREATE TABLE IF NOT EXISTS  dnd5eItemManager.Character (
    characterID INTEGER NOT NULL AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    strength SMALLINT NOT NULL,
    description VARCHAR(255)
);

CREATE TABLE IF NOT EXISTS dnd5eItemManager.Bag (
    bagID INTEGER NOT NULL AUTO_INCREMENT PRIMARY KEY ,
    name VARCHAR(255) NOT NULL,
    description VARCHAR(255)
);

CREATE TABLE IF NOT EXISTS dnd5eItemManager.Item (
    itemID INTEGER NOT NULL AUTO_INCREMENT PRIMARY KEY ,
    name VARCHAR(255) NOT NULL,
    value FLOAT NOT NULL,
    description VARCHAR(255)
);

CREATE TABLE IF NOT EXISTS dnd5eItemManager.Campaign_Character (
    campaignID INTEGER,
    characterID INTEGER,
    FOREIGN KEY (campaignID) REFERENCES dnd5eItemManager.Campaign(campaignID),
    FOREIGN KEY (characterID) REFERENCES dnd5eItemManager.Character(characterID)
);

CREATE TABLE IF NOT EXISTS dnd5eItemManager.Character_Bag (
    characterID INTEGER,
    bagID INTEGER,
    FOREIGN KEY (characterID) REFERENCES dnd5eItemManager.Character(characterID),
    FOREIGN KEY (bagID) REFERENCES dnd5eItemManager.Bag(bagID)
);

CREATE TABLE IF NOT EXISTS dnd5eItemManager.Bag_Item (
    bagID INTEGER,
    itemID INTEGER,
    FOREIGN KEY (bagID) REFERENCES dnd5eItemManager.Bag(bagID),
    FOREIGN KEY (itemID) REFERENCES dnd5eItemManager.Item(itemID)
);
