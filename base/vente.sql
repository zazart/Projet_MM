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

CREATE TABLE vente(
   id SERIAL,
   livraison BOOLEAN NOT NULL,
   date_vente DATE NOT NULL,
   prixTotal NUMERIC(16,2)  NOT NULL,
   id_commande INTEGER NOT NULL,
   FOREIGN KEY(id_commande) REFERENCES Commande(id),
   PRIMARY KEY(id)
);


SELECT 
   vente.id_vente,
   SUM(vente.prixtotal) AS prixtotal,
   date_part('year', vente.date_vente) AS year_vente,
   date_part('month', vente.date_vente) AS month_vente,
   produit.id_produit,
   produit.nom_produit,
   coalesce(SUM(panier.quantite),0) AS quantite 
FROM
   vente 
JOIN 
   panier ON vente.id_commande=panier.id_commande 
JOIN
   commande ON panier.id_commande = commande.id_commande  
RIGHT JOIN
   produit ON panier.id_produit=produit.id_produit 
WHERE 
   date_part('year', vente.date_vente) > $year 
GROUP BY 
   vente.id_vente,date_part('year',vente.date_vente),date_part('month', vente.date_vente),produit.id_produit,produit.nom_produit 
ORDER BY date_part('year', vente.date_vente) asc, date_part('month', vente.date_vente) asc


SELECT 
   vente.id_vente,
   SUM(vente.prixtotal) AS prixtotal,
   date_part('year', vente.date_vente) AS year_vente,
   date_part('month', vente.date_vente) AS month_vente,
   produit.id_produit,
   produit.nom_produit,
   coalesce(SUM(panier.quantite),0) AS quantite 
FROM
   vente 
JOIN 
   panier ON vente.id_commande=panier.id_commande 
JOIN
   commande ON panier.id_commande = commande.id_commande  
RIGHT JOIN
   produit ON panier.id_produit=produit.id_produit 
WHERE 
   date_part('year', vente.date_vente) < $year 
GROUP BY 
   vente.id_vente,date_part('year',vente.date_vente),date_part('month', vente.date_vente),produit.id_produit,produit.nom_produit


-- Insert clients
INSERT INTO Client (nomGlobal, email, adresse) VALUES
('Essential Oils Ltd', 'contact@essentialoils.eu', '123 Aroma Street, Paris, France'),
('Aroma Therapy Inc.', 'info@aromatherapy.co.uk', '456 Relax Lane, London, UK'),
('Natural Scents GmbH', 'sales@naturalscents.de', '789 Essence Blvd, Berlin, Germany'),
('Oils and More', 'support@oilsandmore.es', '1011 Fragrance Ave, Madrid, Spain'),
('Scents of Nature', 'hello@scentsofnature.it', '202 Essence Road, Rome, Italy'),
('Pure Essence Co.', 'info@pureessence.nl', '303 Pure St, Amsterdam, Netherlands'),
('Fragrant Oils AB', 'contact@fragrantoils.se', '404 Aroma Way, Stockholm, Sweden'),
('Essential Aroma', 'sales@essentialaroma.pt', '505 Scent Blvd, Lisbon, Portugal'),
('Aromatics SA', 'info@aromatics.be', '606 Perfume Ave, Brussels, Belgium'),
('Natural Oils', 'support@naturaloils.ie', '707 Scent Street, Dublin, Ireland');


-- Insert commandes
INSERT INTO Commande (datecommande, id_client) VALUES
('2022-01-15 10:15:00', 1),
('2022-02-18 11:30:00', 2),
('2022-03-21 12:45:00', 3),
('2022-04-24 14:00:00', 4),
('2022-05-27 09:30:00', 5),
('2022-06-30 15:45:00', 6),
('2022-07-03 10:00:00', 7),
('2022-08-06 11:15:00', 8),
('2022-09-09 12:30:00', 9),
('2022-10-12 13:45:00', 10),
('2022-11-15 14:00:00', 1),
('2022-12-18 15:15:00', 2),
('2023-01-21 16:30:00', 3),
('2023-02-24 17:45:00', 4),
('2023-03-27 18:00:00', 5),
('2023-04-30 09:15:00', 6),
('2023-05-03 10:30:00', 7),
('2023-06-06 11:45:00', 8),
('2023-07-09 12:00:00', 9),
('2023-08-12 13:15:00', 10),
('2023-09-15 14:30:00', 1),
('2023-10-18 15:45:00', 2),
('2023-11-21 16:00:00', 3),
('2023-12-24 17:15:00', 4),
('2024-01-27 18:30:00', 5),
('2024-02-29 09:45:00', 6),
('2024-03-03 10:00:00', 7),
('2024-04-06 11:15:00', 8),
('2024-05-09 12:30:00', 9),
('2024-05-29 13:45:00', 10);


-- Insert panier items
INSERT INTO Panier (id_produit, quantite, id_commande) VALUES
(1, 50, 1),
(2, 30, 2),
(3, 20, 3),
(4, 40, 4),
(1, 60, 5),
(2, 35, 6),
(3, 25, 7),
(4, 45, 8),
(1, 55, 9),
(2, 32, 10),
(3, 28, 11),
(4, 42, 12),
(1, 50, 13),
(2, 30, 14),
(3, 20, 15),
(4, 40, 16),
(1, 60, 17),
(2, 35, 18),
(3, 25, 19),
(4, 45, 20),
(1, 55, 21),
(2, 32, 22),
(3, 28, 23),
(4, 42, 24),
(1, 50, 25),
(2, 30, 26),
(3, 20, 27),
(4, 40, 28),
(1, 60, 29),
(2, 35, 30);



-- Insert ventes with updated prices in Ariary
INSERT INTO Vente (livraison, date_vente, prixTotal, id_commande) VALUES
(TRUE, '2022-01-16', 1500000.00, 1),
(FALSE, '2022-02-19', 900000.00, 2),
(TRUE, '2022-03-22', 600000.00, 3),
(FALSE, '2022-04-25', 1200000.00, 4),
(TRUE, '2022-05-28', 1800000.00, 5),
(FALSE, '2022-07-01', 1050000.00, 6),
(TRUE, '2022-07-04', 750000.00, 7),
(FALSE, '2022-08-07', 1350000.00, 8),
(TRUE, '2022-09-10', 1650000.00, 9),
(FALSE, '2022-10-13', 960000.00, 10),
(TRUE, '2022-11-16', 840000.00, 11),
(FALSE, '2022-12-19', 1260000.00, 12),
(TRUE, '2023-01-22', 1500000.00, 13),
(FALSE, '2023-02-25', 900000.00, 14),
(TRUE, '2023-03-28', 600000.00, 15),
(FALSE, '2023-05-01', 1200000.00, 16),
(TRUE, '2023-05-04', 1800000.00, 17),
(FALSE, '2023-06-07', 1050000.00, 18),
(TRUE, '2023-07-10', 750000.00, 19),
(FALSE, '2023-08-13', 1350000.00, 20),
(TRUE, '2023-09-16', 1650000.00, 21),
(FALSE, '2023-10-19', 960000.00, 22),
(TRUE, '2023-11-22', 840000.00, 23),
(FALSE, '2023-12-25', 1260000.00, 24),
(TRUE, '2024-01-28', 1500000.00, 25),
(FALSE, '2024-02-29', 900000.00, 26),
(TRUE, '2024-03-04', 600000.00, 27),
(FALSE, '2024-04-07', 1200000.00, 28),
(TRUE, '2024-05-10', 1800000.00, 29),
(FALSE, '2024-05-29', 1050000.00, 30);
