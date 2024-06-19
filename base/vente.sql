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
SELECT vente.id_vente,SUM(vente.prixtotal) AS prixtotal, date_part('year', vente.date_vente) as year_vente, date_part('month', vente.date_vente) as month_vente,produit.id_produit,produit.nom_produit, SUM(panier.quantite) as quantite FROM vente JOIN panier ON vente.id_commande=panier.id_commande JOIN commande ON panier.id_commande = commande.id_commande JOIN produit ON panier.id_produit=produit.id_produit WHERE date_part('year', vente.date_vente) < 2023  GROUP BY vente.id_vente,date_part('year',vente.date_vente),date_part('month', vente.date_vente),produit.id_produit,produit.nom_produit;

INSERT INTO Client (nomglobal, email, adresse) VALUES
('Société Malgache de Construction', 'contact@societemalgache.mg', 'Lot IVG 36 Rue Rainitsarovy, Antananarivo, Madagascar');
INSERT INTO Client (nomglobal, email, adresse) VALUES
('MadaTech Solutions', 'info@madatech.mg', 'Lot 10B Route de la Digue, Tananarive, Madagascar');
INSERT INTO Client (nomglobal, email, adresse) VALUES
('Transports Malgaches', 'support@transports-mg.mg', 'Rue Dr Joseph Raseta, Antananarivo, Madagascar');
INSERT INTO Client (nomglobal, email, adresse) VALUES
('Bionex Madagascar', 'contact@bionex.mg', 'Rue Andrianary Ratianarivo, Antananarivo, Madagascar');
INSERT INTO Client (nomglobal, email, adresse) VALUES
('Energies Nouvelles Madagascar', 'info@energiesnouve-mg.mg', 'Lot AB 87, Analamahitsy, Antananarivo, Madagascar');

INSERT INTO Commande (datecommande, id_client) VALUES
('2023-12-10 14:30:00', 1);
INSERT INTO Commande (datecommande, id_client) VALUES
('2023-12-11 09:15:00', 2);
INSERT INTO Commande (datecommande, id_client) VALUES
('2023-11-12 16:45:00', 3);
INSERT INTO Commande (datecommande, id_client) VALUES
('2023-11-13 11:00:00', 4);
INSERT INTO Commande (datecommande, id_client) VALUES
('2023-10-14 08:20:00', 5);


INSERT INTO Produit(nom_produit, prix_unitaire) VALUES
('Mm menaka 1', 10000);
INSERT INTO Produit(nom_produit, prix_unitaire) VALUES
('Mm menaka 2', 13000);
INSERT INTO Produit(nom_produit, prix_unitaire) VALUES
('Mm menaka 3', 14000);
INSERT INTO Produit(nom_produit, prix_unitaire) VALUES
('Mm menaka 4', 15000);
INSERT INTO Produit(nom_produit, prix_unitaire) VALUES
('Mm menaka 5', 16000);