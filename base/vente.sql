CREATE TABLE Client(
   id SERIAL,
   nomGlobal VARCHAR(255)  NOT NULL,
   email VARCHAR(255) ,
   adresse VARCHAR(255) ,
   PRIMARY KEY(id)
);

CREATE TABLE Commande(
   id SERIAL,
   datecommande TIMESTAMP NOT NULL,
   id_client INTEGER NOT NULL,
   PRIMARY KEY(id),
   FOREIGN KEY(id_client) REFERENCES Client(id)
);

CREATE TABLE Panier(
   id SERIAL,
   id_produit INTEGER NOT NULL,
   quantite INTEGER NOT NULL,
   id_commande INTEGER NOT NULL,
   FOREIGN KEY(id_commande) REFERENCES Commande(id),
   PRIMARY KEY(id)
);

CREATE TABLE Produit(
   id SERIAL,
   nom VARCHAR(255)  NOT NULL,
   prixunitaire NUMERIC(16,2)   NOT NULL,
   id_stock INTEGER NOT NULL,
   PRIMARY KEY(id),
   FOREIGN KEY(id_stock) REFERENCES StockProduit(id)
);

CREATE TABLE vente(
   id SERIAL,
   livraison BOOLEAN NOT NULL,
   prixTotal NUMERIC(16,2)   NOT NULL,
   id_commande INTEGER NOT NULL,
   FOREIGN KEY(id_commande) REFERENCES Commande(id),
   PRIMARY KEY(id)
);

INSERT INTO Client (nomglobal, email, adresse) VALUES
('Société Malgache de Construction', 'contact@societemalgache.mg', 'Lot IVG 36 Rue Rainitsarovy, Antananarivo, Madagascar'),
('MadaTech Solutions', 'info@madatech.mg', 'Lot 10B Route de la Digue, Tananarive, Madagascar'),
('Transports Malgaches', 'support@transports-mg.mg', 'Rue Dr Joseph Raseta, Antananarivo, Madagascar'),
('Bionex Madagascar', 'contact@bionex.mg', 'Rue Andrianary Ratianarivo, Antananarivo, Madagascar'),
('Énergies Nouvelles Madagascar', 'info@energiesnouve-mg.mg', 'Lot AB 87, Analamahitsy, Antananarivo, Madagascar');
