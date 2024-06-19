CREATE TABLE Client(
   id_client SERIAL,
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
   date_vente DATE NOT NULL,
   prixTotal NUMERIC(16,2)  NOT NULL,
   id_commande INTEGER NOT NULL,
   FOREIGN KEY(id_commande) REFERENCES Commande(id),
   PRIMARY KEY(id)
);

INSERT INTO Client (id, nomglobal, email, adresse) VALUES
(1,'Société Malgache de Construction', 'contact@societemalgache.mg', 'Lot IVG 36 Rue Rainitsarovy, Antananarivo, Madagascar');
INSERT INTO Client (id, nomglobal, email, adresse) VALUES
(2,'MadaTech Solutions', 'info@madatech.mg', 'Lot 10B Route de la Digue, Tananarive, Madagascar');
INSERT INTO Client (id, nomglobal, email, adresse) VALUES
(3,'Transports Malgaches', 'support@transports-mg.mg', 'Rue Dr Joseph Raseta, Antananarivo, Madagascar');
INSERT INTO Client (id, nomglobal, email, adresse) VALUES
(4,'Bionex Madagascar', 'contact@bionex.mg', 'Rue Andrianary Ratianarivo, Antananarivo, Madagascar');
INSERT INTO Client (id, nomglobal, email, adresse) VALUES
(5,'Énergies Nouvelles Madagascar', 'info@energiesnouve-mg.mg', 'Lot AB 87, Analamahitsy, Antananarivo, Madagascar');

INSERT INTO Commande (id, datecommande, id_client) VALUES
(1,'2024-06-10 14:30:00', 1);
INSERT INTO Commande (id, datecommande, id_client) VALUES
(2,'2024-06-11 09:15:00', 2);
INSERT INTO Commande (id, datecommande, id_client) VALUES
(3,'2024-06-12 16:45:00', 3);
INSERT INTO Commande (id, datecommande, id_client) VALUES
(4,'2024-06-13 11:00:00', 4);
INSERT INTO Commande (id, datecommande, id_client) VALUES
(5,'2024-06-14 08:20:00', 5);