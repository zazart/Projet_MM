CREATE TABLE Genre(
   id SERIAL,
   description VARCHAR(50)  NOT NULL,
   PRIMARY KEY(id)
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
   id_poste SERIAL,
   nom VARCHAR(255)  NOT NULL,
   montant_salaire NUMERIC(16,2),
   duree_travail TIME NOT NULL,
   PRIMARY KEY(id_poste)
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
   id SERIAL,
   nom VARCHAR(255)  NOT NULL,
   contact VARCHAR(255)  NOT NULL,
   adresse VARCHAR(255)  NOT NULL,
   dateDebuche DATE NOT NULL,
   id_1 INTEGER NOT NULL,
   PRIMARY KEY(id),
   UNIQUE(id_1),
   FOREIGN KEY(id_1) REFERENCES Genre(id)
);

CREATE TABLE SalaireCollecteur(
   id SERIAL,
   prix NUMERIC(16,2)  ,
   dates DATE,
   id_1 INTEGER NOT NULL,
   PRIMARY KEY(id),
   UNIQUE(id_1),
   FOREIGN KEY(id_1) REFERENCES Collecteur(id)
);

CREATE TABLE PaymentCollecteur(
   id MONEY,
   datePayments DATE NOT NULL,
   prix NUMERIC(16,2)   NOT NULL,
   id_1 INTEGER NOT NULL,
   PRIMARY KEY(id),
   UNIQUE(id_1),
   FOREIGN KEY(id_1) REFERENCES Collecteur(id)
);

CREATE TABLE Collects(
   id SERIAL,
   DateCollect DATE NOT NULL,
   matierPremier INTEGER NOT NULL,
   qtt NUMERIC(15,2)   NOT NULL,
   id_1 INTEGER NOT NULL,
   id_2 INTEGER NOT NULL,
   PRIMARY KEY(id),
   FOREIGN KEY(id_1) REFERENCES Collecteur(id),
   FOREIGN KEY(id_2) REFERENCES MatierPremier(id)
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

CREATE TABLE Employe(
   id_employe SERIAL,
   embauche DATE NOT NULL,
   debauche DATE DEFAULT NULL,
   nom VARCHAR(255)  NOT NULL,
   email VARCHAR(255)  NOT NULL,
   telephone VARCHAR(50)  NOT NULL,
   adresse VARCHAR(255)  NOT NULL,
   id_genre INTEGER NOT NULL,
   id_poste INTEGER NOT NULL,
   PRIMARY KEY(id_employe),
   FOREIGN KEY(id_genre) REFERENCES Genre(id),
   FOREIGN KEY(id_poste) REFERENCES Poste(id_poste)
);

CREATE TABLE Presence (
   id_presence SERIAL PRIMARY KEY,
   id_employe INTEGER NOT NULL,
   date DATE NOT NULL,
   heure_arrivee TIME NOT NULL,
   heure_depart TIME NOT NULL,
   FOREIGN KEY (id_employe) REFERENCES Employe(id_employe)
);

CREATE OR REPLACE VIEW V_ProductiviteParJour AS
SELECT Presence.id_employe, Presence.date, 
       EXTRACT(HOUR FROM (LEAST(Presence.heure_depart, '23:59:59'::TIME) - GREATEST(Presence.heure_arrivee, '00:00:00'::TIME))) AS heures_reelles,
       EXTRACT(HOUR FROM Poste.duree_travail) AS heures_theoriques,
       EXTRACT(HOUR FROM (LEAST(Presence.heure_depart, '23:59:59'::TIME) - GREATEST(Presence.heure_arrivee, '00:00:00'::TIME))) / EXTRACT(HOUR FROM Poste.duree_travail) AS productivite_jour
FROM Presence 
JOIN Employe ON Presence.id_employe = Employe.id_employe
JOIN Poste ON Employe.id_poste = Poste.id_poste;

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
