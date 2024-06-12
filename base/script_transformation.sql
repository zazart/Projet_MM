create database mm;

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

CREATE TABLE MatierePremier (
    id_MatierePremier SERIAL PRIMARY KEY,
    Nom_MatierePremier VARCHAR(255) NOT NULL
);

CREATE TABLE PrixMatierePremier (
    id_PrixMatierePremier SERIAL PRIMARY KEY,
    MatierPremier INT NOT NULL,
    Prix DECIMAL(16,2) NOT NULL,
    DatePrix DATE NOT NULL,
    FOREIGN KEY (MatierPremier) REFERENCES MatierePremier(id_MatierePremier)
);

CREATE TABLE Source (
    id_Source SERIAL PRIMARY KEY,
    Lieu VARCHAR(255) NOT NULL
);

CREATE TABLE SourceMatierePremier (
    id SERIAL PRIMARY KEY,
    MatierePremier INT NOT NULL,
    DatePrelevement DATE NOT NULL,
    Source INT NOT NULL,
    FOREIGN KEY (MatierePremier) REFERENCES MatierePremier(id_MatierePremier),
    FOREIGN KEY (Source) REFERENCES Source(id_Source)
);

CREATE TABLE StockMatierPremier (
    id_StockMatierPremier SERIAL PRIMARY KEY,
    MatierePremier INT NOT NULL,
    Dates DATE NOT NULL,
    QuantiteEntrant INT NOT NULL,
    QuantiteSortant INT NOT NULL,
    FOREIGN KEY (MatierePremier) REFERENCES MatierePremier(id_MatierePremier)
);

CREATE TABLE Production (
    id SERIAL PRIMARY KEY,
    StockMatierPremier INT NOT NULL,
    Quantite INT NOT NULL,
    DateProduction DATE NOT NULL,
    Nom VARCHAR(255),
    FOREIGN KEY (StockMatierPremier) REFERENCES StockMatierPremier(id_StockMatierPremier)
);

CREATE TABLE Produit(
    id_Produit SERIAL PRIMARY KEY,
    nom_produit VARCHAR(255),
    prix_unitaire DECIMAL(16,2)
);

CREATE TABLE StockProduit(
    id_StockProduit SERIAL PRIMARY KEY,
    DateStockProduit DATE,
    QuantiteEntrant int,
    QantiteSortant int,
    id_Produit int,
    FOREIGN KEY(id_Produit) REFERENCES Produit(id_Produit) 
);



insert into stat_machhine(id_machine,date_verification,statut,descri) values('2','2024-06-09','9','Tsara');
insert into stat_machhine(id_machine,date_verification,statut,descri) values('2','2024-06-10','7','Tsara tsara ihany');

insert into stat_machhine(id_machine,date_verification,statut,descri) values('3','2024-06-09','9','Tsara');
insert into stat_machhine(id_machine,date_verification,statut,descri) values('3','2024-06-10','7','Tsara tsara ihany');

select * from machine;
select * from machine where date_achat <= '2024-10-10';
select * from machine where date_achat >= '2024-10-10';