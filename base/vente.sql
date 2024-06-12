CREATE TABLE vente(
   id SERIAL,
   livraison BOOLEAN NOT NULL,
   prixTotal NUMERIC(16,2)   NOT NULL,
   id_commande INTEGER NOT NULL,
   FOREIGN KEY(id_commande) REFERENCES Commande(id)
   PRIMARY KEY(id)
);

CREATE TABLE Client(
   id SERIAL,
   nomGlobal VARCHAR(255)  NOT NULL,
   email VARCHAR(255) ,
   adresse VARCHAR(255) ,
   PRIMARY KEY(id)
);

CREATE TABLE Panier(
   id SERIAL,
   idProduit INTEGER NOT NULL,
   quantite INTEGER NOT NULL,
   id_commande INTEGER NOT NULL,
   FOREIGN KEY(id_commande) REFERENCES Commande(id),
   PRIMARY KEY(id)
);

CREATE TABLE Commande(
   id SERIAL,
   dateCommande TIMESTAMP NOT NULL,
   id_client INTEGER NOT NULL,
   PRIMARY KEY(id),
   FOREIGN KEY(id_client) REFERENCES Client(id)
);

CREATE TABLE Produit(
   id SERIAL,
   nom VARCHAR(255)  NOT NULL,
   prixunitaire NUMERIC(16,2)   NOT NULL,
   id_stock INTEGER NOT NULL,
   PRIMARY KEY(id),
   FOREIGN KEY(id_stock) REFERENCES StockProduit(id)
);