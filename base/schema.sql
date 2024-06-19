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
   id_produit INTEGER NOT NULL,
   quantite INTEGER NOT NULL,
   id_commande INTEGER NOT NULL,
   FOREIGN KEY(id_commande) REFERENCES Commande(id),
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
   date_vente DATE NOT NULL,
   prixTotal NUMERIC(16,2)  NOT NULL,
   id_commande INTEGER NOT NULL,
   FOREIGN KEY(id_commande) REFERENCES Commande(id),
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
   Id_MatierPremier INTEGER NOT NULL,
   PRIMARY KEY(id),
   FOREIGN KEY(Id_MatierPremier) REFERENCES MatierPremier(id)
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
   Id_MatierPremier INTEGER NOT NULL,
   PRIMARY KEY(id),
   FOREIGN KEY(Id_MatierPremier) REFERENCES MatierPremier(id)
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
   PRIMARY KEY(id_poste)
);

CREATE TABLE Salaire(
   id_salaire SERIAL,
   id_poste INTEGER NOT NULL,
   date_debut DATE NOT NULL,
   montant_salaire NUMERIC(16,2),
   PRIMARY KEY(id_salaire),
   FOREIGN KEY(id_poste) REFERENCES Poste(id_poste)
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


CREATE TABLE Collects(
   Id_Collects SERIAL,
   DateCollect DATE NOT NULL,
   qtt NUMERIC(15,2)   NOT NULL,
   id_employe INTEGER NOT NULL,
   Id_MatierPremier INTEGER NOT NULL,
   PRIMARY KEY(Id_Collects),
   FOREIGN KEY(id_employe) REFERENCES Employe(id_employe),
   FOREIGN KEY(Id_MatierPremier) REFERENCES MatierPremier(Id_MatierPremier)
);

CREATE TABLE Commande(
   id SERIAL,
   datecommande TIMESTAMP NOT NULL,
   id_client INTEGER NOT NULL,
   PRIMARY KEY(id),
   FOREIGN KEY(id_client) REFERENCES Client(id)
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
   FOREIGN KEY(id_genre) REFERENCES Genre(Id_Genre),
   FOREIGN KEY(id_poste) REFERENCES Poste(id_poste)
);

CREATE TABLE paiementEmploye(
   id_paiement_employe SERIAL,
   dates DATE NOT NULL,
   prix NUMERIC(16,2)   NOT NULL,
   libelle VARCHAR(255)  NOT NULL,
   id_employe INTEGER NOT NULL,
   PRIMARY KEY(id_paiement_employe),
   FOREIGN KEY(id_employe) REFERENCES Employe(id_employe)
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

CREATE TABLE TypeProfil(
   id SERIAL PRIMARY KEY,
   libelle VARCHAR(255) NOT NULL
);

CREATE TABLE Profil(
   id SERIAL PRIMARY KEY,
   email VARCHAR(255) NOT NULL,
   mot_de_passe VARCHAR(255) NOT NULL,
   id_personnel int REFERENCES Employe(id_employe),
   type_profil int REFERENCES TypeProfil(id)
);

insert into Genre(description) values 
('Homme'),
('Femme');

insert into TypeProfil(libelle) values 
('Admin'),
('Collecteur'),
('Responsable Matieres premieres'),
('Transformation'),
('Responsable production'),
('Personnel'),
('Responsable vente'),
('Responsable depense'),
('Responsable transformation');