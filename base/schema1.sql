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
   id_panier SERIAL,
   id_produit INTEGER NOT NULL,
   quantite INTEGER NOT NULL,
   id_commande INTEGER NOT NULL,
   FOREIGN KEY(id_commande) REFERENCES Commande(id_commande),
   PRIMARY KEY(id_panier)
);

CREATE TABLE vente(
   id_vente SERIAL,
   livraison BOOLEAN NOT NULL,
   date_vente DATE NOT NULL,
   prixTotal NUMERIC(16,2)  NOT NULL,
   id_commande INTEGER NOT NULL,
   FOREIGN KEY(id_commande) REFERENCES Commande(id_commande),
   PRIMARY KEY(id_vente)
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
   MatierPremier INTEGER NOT NULL,
   PRIMARY KEY(id_prixMatierePremier),
   FOREIGN KEY(MatierPremier) REFERENCES MatierePremier(id_matierepremier)
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
   MatierePremier INTEGER NOT NULL,
   PRIMARY KEY(id_stockMatierPremier),
   FOREIGN KEY(MatierePremier) REFERENCES MatierePremier(id_matierepremier)
);

CREATE TABLE Production (
    id_production SERIAL PRIMARY KEY,
    MatierePremier INT,
    QuantiteProduit INT,
    DateProduction DATE,
    FOREIGN KEY (MatierePremier) REFERENCES MatierePremier(id_matierepremier)
);
alter table production add column quantitebrut integer;


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
   prix NUMERIC(16,2) NOT NULL,
   libelle VARCHAR(255)  NOT NULL,
   id_employe INTEGER NOT NULL,
   PRIMARY KEY(id_paiement_employe),
   FOREIGN KEY(id_employe) REFERENCES Employe(id_employe)
);


CREATE TABLE Collects(
   Id_Collects SERIAL,
   DateCollect DATE NOT NULL,
   qtt NUMERIC(15,2)   NOT NULL,
   id_employe INTEGER NOT NULL,
   Id_MatierePremier INTEGER NOT NULL,
   PRIMARY KEY(Id_Collects),
   FOREIGN KEY(id_employe) REFERENCES Employe(id_employe),
   FOREIGN KEY(Id_MatierePremier) REFERENCES MatierePremier(id_matierepremier)
);

CREATE TABLE PanierProduit(
   id_produit INTEGER,
   id_panier INTEGER,
   PRIMARY KEY(id_produit, id_panier),
   FOREIGN KEY(id_panier) REFERENCES Panier(id_panier),
   FOREIGN KEY(id_produit) REFERENCES Produit(id_produit)
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

insert into Genre(description) values 
('Homme'),
('Femme');

insert into TypeProfil(libelle) values 
('Admin');


-- Création de la table pcg
CREATE TABLE pcg (
    id_pcg SERIAL PRIMARY KEY,
    intitule VARCHAR(255),
    nom VARCHAR(255)
);

-- Création de la table sub_comptes
CREATE TABLE sub_comptes (
    id_sub_comptes SERIAL PRIMARY KEY,
    intitule VARCHAR(255),
    description TEXT,
    idpcg INT,
    FOREIGN KEY (idpcg) REFERENCES pcg(id_pcg)
);

-- Création de la table modeDepaiement
CREATE TABLE modeDepaiement (
    id_ModePaiment SERIAL PRIMARY KEY,
    nom VARCHAR(255) NOT NULL,
    descriptions VARCHAR(255)
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

