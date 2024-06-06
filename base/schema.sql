CREATE TABLE Genre(
   Id_Genre SERIAL,
   description VARCHAR(50)  NOT NULL,
   PRIMARY KEY(Id_Genre)
);

CREATE TABLE Bonus(
   id SERIAL,
   dateDebut DATE NOT NULL,
   amount NUMERIC(18,2)   NOT NULL,
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
   PRIMARY KEY(id)
);

CREATE TABLE StockProduit(
   id SERIAL,
   datestock DATE NOT NULL,
   inQuantite INTEGER NOT NULL,
   outQuantite INTEGER NOT NULL,
   PRIMARY KEY(id)
);

CREATE TABLE vente(
   id SERIAL,
   livraison BOOLEAN NOT NULL,
   prixTotal NUMERIC(16,2)   NOT NULL,
   PRIMARY KEY(id)
);

CREATE TABLE MatierPremier(
   id SERIAL,
   Nom VARCHAR(255)  NOT NULL,
   PRIMARY KEY(id)
);

CREATE TABLE PrixMatierePremier(
   id SERIAL,
   prix NUMERIC(16,2)   NOT NULL,
   datePrix DATE,
   id_1 INTEGER NOT NULL,
   PRIMARY KEY(id),
   FOREIGN KEY(id_1) REFERENCES MatierPremier(id)
);

CREATE TABLE Source(
   id SERIAL,
   lieu VARCHAR(255)  NOT NULL,
   PRIMARY KEY(id)
);

CREATE TABLE StockMatierPremier(
   id SERIAL,
   dates DATE,
   in_qtt INTEGER NOT NULL,
   out_qtt INTEGER NOT NULL,
   id_1 INTEGER NOT NULL,
   PRIMARY KEY(id),
   FOREIGN KEY(id_1) REFERENCES MatierPremier(id)
);

CREATE TABLE Production(
   id SERIAL,
   quantite INTEGER NOT NULL,
   dateProduction DATE NOT NULL,
   id_1 INTEGER NOT NULL,
   PRIMARY KEY(id),
   FOREIGN KEY(id_1) REFERENCES StockMatierPremier(id)
);

CREATE TABLE Machine(
   id SERIAL,
   nom VARCHAR(255)  NOT NULL,
   fonction VARCHAR(255)  NOT NULL,
   dateAchat DATE NOT NULL,
   PRIMARY KEY(id)
);

CREATE TABLE StatMachine(
   id SERIAL,
   dateVerification DATE NOT NULL,
   state INTEGER NOT NULL,
   description VARCHAR(255) ,
   id_1 INTEGER NOT NULL,
   PRIMARY KEY(id),
   FOREIGN KEY(id_1) REFERENCES Machine(id)
);

CREATE TABLE Poste(
   id SERIAL,
   nom VARCHAR(255)  NOT NULL,
   workDurrationDay TIME NOT NULL,
   PRIMARY KEY(id)
);

CREATE TABLE Salaire(
   id SERIAL,
   dateDebut DATE NOT NULL,
   prix NUMERIC(16,2)   NOT NULL,
   id_1 INTEGER NOT NULL,
   PRIMARY KEY(id),
   FOREIGN KEY(id_1) REFERENCES Poste(id)
);

CREATE TABLE TypeDepense(
   id INTEGER,
   intitule VARCHAR(255)  NOT NULL,
   PRIMARY KEY(id)
);

CREATE TABLE PCG(
   compte INTEGER,
   nom VARCHAR(255)  NOT NULL,
   PRIMARY KEY(compte)
);

CREATE TABLE ModePaiement(
   id SERIAL,
   intitule VARCHAR(255)  NOT NULL,
   PRIMARY KEY(id)
);

CREATE TABLE Collecteur(
   Id_Collecteur SERIAL,
   nom VARCHAR(255)  NOT NULL,
   contact VARCHAR(255)  NOT NULL,
   adresse VARCHAR(255)  NOT NULL,
   dateDebuche DATE NOT NULL,
   Id_Genre INTEGER NOT NULL,
   PRIMARY KEY(Id_Collecteur),
   FOREIGN KEY(Id_Genre) REFERENCES Genre(Id_Genre)
);

CREATE TABLE SalaireCollecteur(
   Id_SalaireCollecteur SERIAL,
   prix NUMERIC(16,2)  ,
   dates DATE,
   Id_Collecteur INTEGER NOT NULL,
   PRIMARY KEY(Id_SalaireCollecteur),
   FOREIGN KEY(Id_Collecteur) REFERENCES Collecteur(Id_Collecteur)
);

CREATE TABLE PaymentCollecteur(
   Id_PaymentCollecteur SERIAL,
   datePayments DATE NOT NULL,
   prix NUMERIC(16,2)   NOT NULL,
   Id_Collecteur INTEGER NOT NULL,
   PRIMARY KEY(Id_PaymentCollecteur),
   FOREIGN KEY(Id_Collecteur) REFERENCES Collecteur(Id_Collecteur)
);

CREATE TABLE Collects(
   Id_Collects SERIAL,
   DateCollect DATE NOT NULL,
   matierPremier INTEGER NOT NULL,
   qtt NUMERIC(15,2)   NOT NULL,
   Id_Collecteur INTEGER NOT NULL,
   id INTEGER NOT NULL,
   PRIMARY KEY(Id_Collects),
   FOREIGN KEY(Id_Collecteur) REFERENCES Collecteur(Id_Collecteur),
   FOREIGN KEY(id) REFERENCES MatierPremier(id)
);

CREATE TABLE Commande(
   id SERIAL,
   dateCommande TIMESTAMP NOT NULL,
   id_1 INTEGER NOT NULL,
   id_2 INTEGER NOT NULL,
   id_3 INTEGER NOT NULL,
   PRIMARY KEY(id),
   FOREIGN KEY(id_1) REFERENCES Client(id),
   FOREIGN KEY(id_2) REFERENCES Panier(id),
   FOREIGN KEY(id_3) REFERENCES vente(id)
);

CREATE TABLE Produit(
   id SERIAL,
   nom VARCHAR(255)  NOT NULL,
   prixunitaire NUMERIC(16,2)   NOT NULL,
   id_1 INTEGER NOT NULL,
   PRIMARY KEY(id),
   FOREIGN KEY(id_1) REFERENCES StockProduit(id)
);

CREATE TABLE SourceMatierePremier(
   id SERIAL,
   datePrelevement DATE NOT NULL,
   id_1 INTEGER NOT NULL,
   id_2 INTEGER NOT NULL,
   PRIMARY KEY(id),
   FOREIGN KEY(id_1) REFERENCES Source(id),
   FOREIGN KEY(id_2) REFERENCES MatierPremier(id)
);

CREATE TABLE Employees(
   id SERIAL,
   debuche DATE NOT NULL,
   email VARCHAR(255)  NOT NULL,
   numPhone VARCHAR(50)  NOT NULL,
   addresse VARCHAR(255)  NOT NULL,
   Id_Genre INTEGER NOT NULL,
   id_1 INTEGER NOT NULL,
   PRIMARY KEY(id),
   FOREIGN KEY(Id_Genre) REFERENCES Genre(Id_Genre),
   FOREIGN KEY(id_1) REFERENCES Poste(id)
);

CREATE TABLE Depense(
   id SERIAL,
   description VARCHAR(255)  NOT NULL,
   montant NUMERIC(16,2)   NOT NULL,
   dateDepense DATE NOT NULL,
   justification VARCHAR(255)  NOT NULL,
   id_1 INTEGER NOT NULL,
   id_2 INTEGER NOT NULL,
   PRIMARY KEY(id),
   FOREIGN KEY(id_1) REFERENCES ModePaiement(id),
   FOREIGN KEY(id_2) REFERENCES TypeDepense(id)
);

CREATE TABLE PanierProduit(
   id INTEGER,
   id_1 INTEGER,
   PRIMARY KEY(id, id_1),
   FOREIGN KEY(id) REFERENCES Panier(id),
   FOREIGN KEY(id_1) REFERENCES Produit(id)
);
