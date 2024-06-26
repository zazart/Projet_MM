CREATE TABLE Genre(
   Id_Genre SERIAL,
   description VARCHAR(50)  NOT NULL,
   PRIMARY KEY(Id_Genre)
);

CREATE TABLE Bonus(
   id_bonus SERIAL,
   dateDebut DATE NOT NULL,
   amount NUMERIC(18,2)   NOT NULL,
   PRIMARY KEY(id_bonus)
);

CREATE TABLE Client(
   id_client SERIAL,
   nomGlobal VARCHAR(255)  NOT NULL,
   email VARCHAR(255) ,
   adresse VARCHAR(255) ,
   PRIMARY KEY(id_client)
);

CREATE TABLE Commande(
   id_commande SERIAL,
   datecommande TIMESTAMP NOT NULL,
   id_client INTEGER NOT NULL,
   PRIMARY KEY(id_commande),
   FOREIGN KEY(id_client) REFERENCES Client(id_client)
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
   id_vente SERIAL,
   livraison BOOLEAN NOT NULL,
   date_vente DATE NOT NULL,
   prixTotal NUMERIC(16,2)  NOT NULL,
   id_commande INTEGER NOT NULL,
   FOREIGN KEY(id_commande) REFERENCES Commande(id),
   PRIMARY KEY(id)
);

CREATE TABLE MatierePremier(
   id_matierepremier SERIAL,
   Nom VARCHAR(255)  NOT NULL,
   PRIMARY KEY(id_matierepremier)
);

CREATE TABLE PrixMatierePremier(
   id_prixMatierePremier SERIAL,
   prix NUMERIC(16,2)   NOT NULL,
   datePrix DATE,
   Id_MatierPremier INTEGER NOT NULL,
   PRIMARY KEY(id),
   FOREIGN KEY(Id_MatierPremier) REFERENCES MatierPremier(id)
);

CREATE TABLE Source(
   id_source SERIAL,
   lieu VARCHAR(255)  NOT NULL,
   PRIMARY KEY(id_source)
);

CREATE TABLE StockMatierPremier(
   id_stockMatierPremier SERIAL,
   dates DATE,
   in_qtt INTEGER NOT NULL,
   out_qtt INTEGER NOT NULL,
   Id_MatierPremier INTEGER NOT NULL,
   PRIMARY KEY(id),
   FOREIGN KEY(Id_MatierPremier) REFERENCES MatierPremier(id)
);

CREATE TABLE Production (
    id_production SERIAL PRIMARY KEY,
    MatierePremier INT,
    QuantiteProduit INT,
    DateProduction DATE,
    FOREIGN KEY (MatierePremier) REFERENCES MatierePremier(id_matierepremier)
);


create table machine(
    id_machine serial primary key,
    nom_machine varchar(255),
    fonction varchar(255),
    date_achat date
);

create table stat_machine(
    id_stat serial primary key,
    id_machine int,
    date_verification date,
    statut int,
    descri varchar(255),
    foreign key(id_machine) references machine(id_machine)
);


CREATE TABLE ModePaiement(
   id_modePaiement SERIAL,
   intitule VARCHAR(255)  NOT NULL,
   PRIMARY KEY(id_modePaiement)
);

CREATE TABLE Produit(
    id_produit SERIAL PRIMARY KEY,
    nom_produit VARCHAR(255),
    prix_unitaire DECIMAL(16,2)
);

CREATE TABLE StockProduit(
    id_StockProduit SERIAL PRIMARY KEY,
    DateStockProduit DATE,
    QuantiteEntrant int,
    QuantiteSortant int,
    id_Produit int,
    FOREIGN KEY(id_Produit) REFERENCES Produit(id_Produit) 
);


CREATE TABLE SourceMatierePremier(
   id_SourceMatierePremier SERIAL,
   datePrelevement DATE NOT NULL,
   MatierPremier INTEGER NOT NULL,
   Source INTEGER NOT NULL,
   PRIMARY KEY(id_SourceMatierePremier),
   FOREIGN KEY(MatierPremier) REFERENCES MatierePremier(id_matierepremier),
   FOREIGN KEY(Source) REFERENCES Source(id_source)
);

CREATE TABLE Poste(
   id_poste SERIAL,
   id_poste SERIAL,
   nom VARCHAR(255)  NOT NULL,
   montant_salaire NUMERIC(16,2),
   PRIMARY KEY(id_poste)
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
   id_salaire SERIAL,
   id_poste INTEGER NOT NULL,
   date_debut DATE NOT NULL,
   montant_salaire NUMERIC(16,2),
   PRIMARY KEY(id_salaire),
   FOREIGN KEY(id_poste) REFERENCES Poste(id_poste)
);


CREATE TABLE Employe(
   id_employe SERIAL,
   embauche DATE NOT NULL,
   debauche DATE DEFAULT NULL,
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

CREATE TABLE TypeProfil(
   id_typeProfil SERIAL PRIMARY KEY,
   libelle VARCHAR(255) NOT NULL
);

CREATE TABLE Profil(
   id_profil SERIAL PRIMARY KEY,
   email VARCHAR(255) NOT NULL,
   mot_de_passe VARCHAR(255) NOT NULL,
   id_personnel int REFERENCES Employe(id_employe),
   type_profil int REFERENCES TypeProfil(id_typeProfil)
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


-- Création de la table Depense
CREATE TABLE Depense(
   id_Depense SERIAL PRIMARY KEY,
   description VARCHAR(255) NOT NULL,
   montant NUMERIC(16,2) NOT NULL,
   dateDepense DATE NOT NULL,
   justificatif BYTEA,
   id_ModePaiment INTEGER NOT NULL,
   id_sub_comptes INTEGER NOT NULL,
   FOREIGN KEY (id_ModePaiment) REFERENCES modeDepaiement(id_ModePaiment),
   FOREIGN KEY (id_sub_comptes) REFERENCES sub_comptes(id_sub_comptes)
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
