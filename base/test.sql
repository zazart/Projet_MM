INSERT INTO Genre (description) VALUES ('Homme');
INSERT INTO Genre (description) VALUES ('Femme');

INSERT INTO MatierePremier ( Nom ) VALUES('Ricin');
INSERT INTO MatierePremier ( Nom ) VALUES('Jojoba');
INSERT INTO MatierePremier ( Nom ) VALUES('Figue de Barbarie');
INSERT INTO MatierePremier ( Nom ) VALUES('Jatropha');

INSERT INTO  Source ( lieu ) VALUES('Tsihombe');
INSERT INTO  Source ( lieu ) VALUES('Amboasary');
INSERT INTO  Source ( lieu ) VALUES('Anakao');


INSERT INTO PrixMatierePremier ( prix,datePrix,MatierPremier ) VALUES(2000,'2023-08-01',1);
INSERT INTO PrixMatierePremier ( prix,datePrix,MatierPremier ) VALUES(6000,'2023-08-01',2);
INSERT INTO PrixMatierePremier ( prix,datePrix,MatierPremier ) VALUES(2000,'2023-08-01',3);
INSERT INTO PrixMatierePremier ( prix,datePrix,MatierPremier ) VALUES(250,'2023-08-01',4);


INSERT INTO SourceMatierePremier ( datePrelevement,MatierPremier,Source ) VALUES('2023-08-10',1,1);
INSERT INTO SourceMatierePremier ( datePrelevement,MatierPremier,Source ) VALUES('2023-08-10',2,2);
INSERT INTO SourceMatierePremier ( datePrelevement,MatierPremier,Source ) VALUES('2023-08-10',3,1);
INSERT INTO SourceMatierePremier ( datePrelevement,MatierPremier,Source ) VALUES('2023-08-10',4,3);


INSERT INTO Poste (nom, montant_salaire) VALUES ('Ingénieur', 1000000.00);
INSERT INTO Poste (nom, montant_salaire) VALUES ('Responsable stock', 500000.00);
INSERT INTO Poste (nom, montant_salaire) VALUES ('Comptable', 1000000.00);
INSERT INTO Poste (nom, montant_salaire) VALUES ('Responsable Communication', 500000.00);
INSERT INTO Poste (nom, montant_salaire) VALUES ('Mpitatitra entana', 250000.00);
INSERT INTO Poste (nom, montant_salaire) VALUES ('Sécurité', 3500000.00);
INSERT INTO Poste (nom, montant_salaire) VALUES ('Collecteur', 500000.00);


INSERT INTO Employe (embauche, debauche, nom, email, telephone, adresse, id_genre, id_poste) VALUES 
('2023-08-01', NULL, 'Rivo Randrianarivelo', 'rivo.randrianarivelo@gmail.com', '0345678901', '123 Rue Principal, Toliara', 1, 1),
('2023-08-01', NULL, 'Ando Rakotomalala', 'ando.rakotomalala@gmail.com', '0324567890', '505 Rue Anosy, Androy', 1, 1),
('2023-08-01', NULL, 'Niaina Rakotobe', 'niaina.rakotobe@gmail.com', '0324567890', '123 Rue Principal, Toliara', 1, 1),
('2023-08-01', NULL, 'Andry Rakotomalala', 'andry.rakotomalala@gmail.com', '0324567890', '505 Rue Anosy, Androy', 1, 1),
('2023-08-01', NULL, 'Hanta Andrianasolo', 'hanta.andrianasolo@gmail.com', '0341234568', '456 Rue Sud, Taolagnaro', 2, 2),
('2023-08-01', NULL, 'Tiana Razafindrabe', 'tiana.razafindrabe@gmail.com', '0338765432', '789 Rue Centre, Betroka', 2, 2),
('2023-08-01', NULL, 'Mamy Rabe', 'mamy.rabe@gmail.com', '0328765432', '101 Rue Ouest, Ambovombe', 1, 3),
('2023-08-01', NULL, 'Fara Rakotondrazaka', 'fara.rakotondrazaka@gmail.com', '0331234567', '202 Rue Nord, Amboasary', 2, 4),
('2023-08-01', NULL, 'Lova Raharison', 'lova.raharison@gmail.com', '0345678902', '303 Rue Est, Bekily', 1, 4),
('2023-08-01', NULL, 'Hery Rakoto', 'hery.rakoto@gmail.com', '0347654321', '404 Rue Antanimena, Manakara', 1, 5),
('2023-08-01', NULL, 'Jean Jacques', 'jean@gmail.com', '0321234569', '456 Rue Sud, Taolagnaro', 1, 5),
('2023-08-01', NULL, 'Tom Rasoanaivo', 'tom.rasoanaivo@gmail.com', '0342345677', '456 Rue Sud, Taolagnaro', 1, 5),
('2023-08-01', NULL, 'Chris Randrianaivo', 'chris@gmail.com', '0342345656', '456 Rue Sud, Taolagnaro', 1, 5),
('2023-08-01', NULL, 'Rabe Rasoanaivo', 'rabe.rasoanaivo@gmail.com', '0342345612', '456 Rue Sud, Taolagnaro', 1, 5),
('2023-08-01', NULL, 'Naivo Randrianary', 'naivo.randrianary@gmail.com', '0342345648', '456 Rue Sud, Taolagnaro', 1, 5),
('2023-08-01', NULL, 'Toky Randria', 'toky.randria@gmail.com', '0321234570', '456 Rue Sud, Taolagnaro', 1, 5),
('2023-08-01', NULL, 'Tojo Rasoanaivo', 'tojo.rasoanaivo@gmail.com', '0321234575', '456 Rue Sud, Taolagnaro', 1, 5),
('2023-08-01', NULL, 'Axel Rasoanaivo', 'axel.rasoanaivo@gmail.com', '0321234561', '456 Rue Sud, Taolagnaro', 1, 5),
('2023-08-01', NULL, 'Tsiory Randrianasolo', 'tsiory.randrianasolo@gmail.com', '0321234567', '303 Rue Est, Taolagnaro', 1, 5),
('2023-08-01', NULL, 'Vonjy Rasoanaivo', 'vonjy.rasoanaivo@gmail.com', '0321234566', '456 Rue Sud, Taolagnaro', 1, 5),
('2023-08-01', NULL, 'Tahina Ravo', 'tahina.ravo@gmail.com', '0342345678', '606 Rue Ankarana, Taolagnaro', 1, 6),
('2023-08-01', NULL, 'Rina Rakoto', 'rina.rakoto@gmail.com', '0341234568', '101 Rue Ouest, Taolagnaro', 1, 6),
('2023-08-01', NULL, 'Jean Rakotoarisoa', 'jean.rakotoarisoa@gmail.com', '0341234567', '123 Rue Principal, Taolagnaro', 1, 6),
('2023-08-01', NULL, 'Zara Rakotoarisoa', 'zara.rakotoarisoa@gmail.com', '0341234567', '123 Rue Principal, Taolagnaro', 1, 6),
('2023-08-01', NULL, 'Arisoa Rabe', 'arisoa.rabe@gmail.com', '0323456789', '707 Rue Ranomafana, Taolagnaro', 1, 6);


INSERT INTO Employe (embauche, debauche, nom, email, telephone, adresse, id_genre, id_poste) VALUES 
('2023-08-01', NULL, 'Bob Rasoanaivo', 'bob.rasoanaivo@gmail.com', '0338765432', '456 Rue Sud, Tsihombe', 1, 7),
('2023-08-01', NULL, 'Henintsoa Randrianarivelo', 'henintsoa.randrianarivelo@gmail.com', '0328765432', '789 Rue Centre, Amboasary', 2, 7),
('2023-08-01', NULL, 'Nirina Raharison', 'nirina.raharison@gmail.com', '0332345678', '202 Rue Nord, Tsihombe', 1, 7),
('2023-08-01', NULL, 'Voahirana Rabe', 'voahirana.rabe@gmail.com', '0343456589', '404 Rue Antanimena, Amboasary', 2, 7),
('2023-08-01', NULL, 'Tojo Randrianarisoa', 'tojo.randrianarisoa@gmail.com', '0345658901', '606 Rue Ankarana, Tsihombe', 1, 7),
('2023-08-01', NULL, 'Noro Ravelomanana', 'noro.ravelomanana@gmail.com', '0326589012', '505 Rue Ranomafana, Amboasary', 2, 7);

-- Insertion des paiements pour fin août 2023
INSERT INTO paiementEmploye (dates, prix, libelle, id_employe) VALUES 
('2023-08-31', 500000.00, 'Salaire août 2023', 26),
('2023-08-31', 500000.00, 'Salaire août 2023', 27),
('2023-08-31', 500000.00, 'Salaire août 2023', 28),
('2023-08-31', 500000.00, 'Salaire août 2023', 29),
('2023-08-31', 500000.00, 'Salaire août 2023', 30),
('2023-08-31', 500000.00, 'Salaire août 2023', 31);

-- Insertion des paiements pour fin septembre 2023
INSERT INTO paiementEmploye (dates, prix, libelle, id_employe) VALUES 
('2023-09-30', 500000.00, 'Salaire septembre 2023', 26),
('2023-09-30', 500000.00, 'Salaire septembre 2023', 27),
('2023-09-30', 500000.00, 'Salaire septembre 2023', 28),
('2023-09-30', 500000.00, 'Salaire septembre 2023', 29),
('2023-09-30', 500000.00, 'Salaire septembre 2023', 30),
('2023-09-30', 500000.00, 'Salaire septembre 2023', 31);

-- Insertion des paiements pour fin octobre 2023
INSERT INTO paiementEmploye (dates, prix, libelle, id_employe) VALUES 
('2023-10-31', 500000.00, 'Salaire octobre 2023', 26),
('2023-10-31', 500000.00, 'Salaire octobre 2023', 27),
('2023-10-31', 500000.00, 'Salaire octobre 2023', 28),
('2023-10-31', 500000.00, 'Salaire octobre 2023', 29),
('2023-10-31', 500000.00, 'Salaire octobre 2023', 30),
('2023-10-31', 500000.00, 'Salaire octobre 2023', 31);


insert into TypeProfil(libelle) values 
('Admin');

insert into Profil(email, mot_de_passe, id_personnel, type_profil) values 
('rivo.randrianarivelo@gmail.com', 'admin', 1, 1);


-- Insertion des données pour la table modeDepaiement
INSERT INTO modeDepaiement (nom, descriptions) VALUES
('Espèces', 'Paiement en espèces'),
('Virement bancaire', 'Paiement par virement bancaire'),
('Carte de crédit', 'Paiement par carte de crédit'),
('Chèque', 'Paiement par chèque');


/*Insertion machine*/
insert into machine(nom_machine,fonction,date_achat) values('Presse à huile à froid','Matériel laboratoire','2022-06-15');
insert into machine(nom_machine,fonction,date_achat) values('Centrifugeuse','Matériel laboratoire','2022-08-03');
insert into machine(nom_machine,fonction,date_achat) values('Extracteur','Matériel laboratoire','2022-08-05');

/*Insertion statut machine fréquence 3 mois*/
/*Etat Presse à huile à froid*/
insert into stat_machine(id_machine,date_verification,statut,descri) values('1','2022-06-15','10','Etat neuf');
insert into stat_machine(id_machine,date_verification,statut,descri) values('1','2022-09-10','9','Tsara tsara ihany');
insert into stat_machine(id_machine,date_verification,statut,descri) values('1','2022-12-09','9','Tsara');
insert into stat_machine(id_machine,date_verification,statut,descri) values('1','2023-03-16','9','Tsara tsara ihany');
insert into stat_machine(id_machine,date_verification,statut,descri) values('1','2023-06-09','9','Tsara');
insert into stat_machine(id_machine,date_verification,statut,descri) values('1','2023-09-21','7','Tsara tsara ihany');
insert into stat_machine(id_machine,date_verification,statut,descri) values('1','2023-12-03','7','Tsara');
insert into stat_machine(id_machine,date_verification,statut,descri) values('1','2024-03-14','5','Tsara tsara ihany');
insert into stat_machine(id_machine,date_verification,statut,descri) values('1','2024-06-20','8','Tsara');

/*Etat Cetrifugeuse*/
insert into stat_machine(id_machine,date_verification,statut,descri) values('2','2022-08-03','9','Etat neuf');
insert into stat_machine(id_machine,date_verification,statut,descri) values('2','2022-09-10','9','Tsara tsara ihany');
insert into stat_machine(id_machine,date_verification,statut,descri) values('2','2022-12-09','9','Tsara');
insert into stat_machine(id_machine,date_verification,statut,descri) values('2','2023-03-16','9','Tsara tsara ihany');
insert into stat_machine(id_machine,date_verification,statut,descri) values('2','2023-06-09','9','Tsara');
insert into stat_machine(id_machine,date_verification,statut,descri) values('2','2023-09-21','8','Tsara tsara ihany');
insert into stat_machine(id_machine,date_verification,statut,descri) values('2','2023-12-03','8','Tsara');
insert into stat_machine(id_machine,date_verification,statut,descri) values('2','2024-03-14','7','Tsara tsara ihany');
insert into stat_machine(id_machine,date_verification,statut,descri) values('2','2024-06-20','7','Tsara');

/*Etat Extracteur*/
insert into stat_machine(id_machine,date_verification,statut,descri) values('3','2022-08-05','10','Etat neuf');
insert into stat_machine(id_machine,date_verification,statut,descri) values('3','2022-09-10','10','Tsara tsara ihany');
insert into stat_machine(id_machine,date_verification,statut,descri) values('3','2022-12-09','10','Tsara');
insert into stat_machine(id_machine,date_verification,statut,descri) values('3','2023-03-16','9','Tsara tsara ihany');
insert into stat_machine(id_machine,date_verification,statut,descri) values('3','2023-06-09','9','Tsara');
insert into stat_machine(id_machine,date_verification,statut,descri) values('3','2023-09-21','8','Tsara tsara ihany');
insert into stat_machine(id_machine,date_verification,statut,descri) values('3','2023-12-03','7','Tsara');
insert into stat_machine(id_machine,date_verification,statut,descri) values('3','2024-03-14','7','Tsara tsara ihany');
insert into stat_machine(id_machine,date_verification,statut,descri) values('3','2024-06-20','7','Tsara');

/*Insertion production*/
/*Production Huile de Ricin*/
-- insert into production(matierepremier,quantiteproduit,dateproduction) values('1','220','2023-08-05');
-- insert into production(matierepremier,quantiteproduit,dateproduction) values('1','240','2023-10-03');
-- insert into production(matierepremier,quantiteproduit,dateproduction) values('1','300','2024-01-15');

-- /*Production Huile de Jojoba*/
-- insert into production(matierepremier,quantiteproduit,dateproduction) values('2','300','2023-08-05');
-- insert into production(matierepremier,quantiteproduit,dateproduction) values('2','340','2023-10-03');
-- insert into production(matierepremier,quantiteproduit,dateproduction) values('2','404','2024-01-15');

-- /*Production Huile de Figue de Barbarie*/
-- insert into production(matierepremier,quantiteproduit,dateproduction) values('3','3','2023-08-05');
-- insert into production(matierepremier,quantiteproduit,dateproduction) values('3','3','2023-10-03');
-- insert into production(matierepremier,quantiteproduit,dateproduction) values('3','3','2024-01-15');




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


-- Août 2023
INSERT INTO Depense (description, montant, dateDepense, justificatif, id_ModePaiment, id_sub_comptes) VALUES
('Achats de matériel informatique', 500000.00, '2023-08-05', NULL, 1, 6),  -- 605: Achat de matériel; équipement et travaux
('Loyer bureau', 1200000.00, '2023-08-15', NULL, 2, 10),  -- 6132: Locations immobilières
('Frais de déplacement', 200000.00, '2023-08-20', NULL, 3, 35),  -- 6251: Voyages et déplacements
('Entretien et réparations', 250000.00, '2023-08-10', NULL, 2, 13),  -- 615: Entretien et réparations
('Frais de télécommunications', 150000.00, '2023-08-25', NULL, 4, 26),  -- 626: Frais postaux et de télécommunications
('Cadeaux à la clientèle', 300000.00, '2023-08-18', NULL, 3, 29),  -- 6234: Cadeaux à la clientèle
('Services de sous-traitance', 350000.00, '2023-08-12', NULL, 1, 7),  -- 611: Sous-traitance générale
('Impôts sur les bénéfices', 800000.00, '2023-08-28', NULL, 2, 81),  -- 695: Impôts sur les bénéfices
('Frais bancaires', 100000.00, '2023-08-07', NULL, 1, 44),  -- 628: Divers
('Assurance locative', 200000.00, '2023-08-02', NULL, 2, 62);  -- 672: Compte à la disposition des entités pour enregistrer; en cours d’exercice; les charges sur exercices antérieurs

-- Septembre 2023
INSERT INTO Depense (description, montant, dateDepense, justificatif, id_ModePaiment, id_sub_comptes) VALUES
('Fournitures de bureau', 300000.00, '2023-09-05', NULL, 2, 2),  -- 6022: Fournitures consommables
('Loyer bureau', 1200000.00, '2023-09-15', NULL, 2, 10),  -- 6132: Locations immobilières
('Frais de formation', 500000.00, '2023-09-25', NULL, 4, 16),  -- 617: Etudes et recherches
('Publicité et marketing', 400000.00, '2023-09-10', NULL, 1, 31),  -- 6237: Publications
('Frais juridiques', 150000.00, '2023-09-20', NULL, 3, 25),  -- 6712: Pénalités; amendes fiscales et pénales
('Dépenses de voyage', 250000.00, '2023-09-08', NULL, 2, 35),  -- 6251: Voyages et déplacements
('Honoraires de consultant', 600000.00, '2023-09-12', NULL, 2, 24),  -- 6226: Honoraires
('Entretien des installations', 200000.00, '2023-09-18', NULL, 1, 14),  -- 615: Entretien et réparations
('Abonnements périodiques', 100000.00, '2023-09-22', NULL, 1, 38),  -- 618: Divers (pourboires; dons courants)
('Frais de recyclage', 180000.00, '2023-09-27', NULL, 1, 63);  -- 658: Charges diverses de gestion courante

-- Octobre 2023
INSERT INTO Depense (description, montant, dateDepense, justificatif, id_ModePaiment, id_sub_comptes) VALUES
('Emballages', 200000.00, '2023-10-05', NULL, 3, 3),  -- 6026: Emballages
('Loyer bureau', 1200000.00, '2023-10-15', NULL, 2, 10),  -- 6132: Locations immobilières
('Publicité et marketing', 300000.00, '2023-10-20', NULL, 1, 31),  -- 6237: Publications
('Frais de transport', 250000.00, '2023-10-10', NULL, 4, 34),  -- 6242: Transports sur ventes
('Frais de gestion', 180000.00, '2023-10-08', NULL, 1, 41),  -- 628: Divers
('Honoraires d avocat', 500000.00, '2023-10-14', NULL, 3, 24),  -- 6226: Honoraires
('Assurances professionnelles', 300000.00, '2023-10-18', NULL, 4, 15),  -- 616: Primes d’assurances
('Dépenses de formation', 150000.00, '2023-10-22', NULL, 1, 16),  -- 617: Etudes et recherches
('Frais de comptabilité', 200000.00, '2023-10-28', NULL, 2, 23),  -- 6226: Honoraires
('Frais d entretien', 120000.00, '2023-10-25', NULL, 1, 14);  -- 615: Entretien et réparations

-- Novembre 2023
INSERT INTO Depense (description, montant, dateDepense, justificatif, id_ModePaiment, id_sub_comptes) VALUES
('Entretien et réparations', 250000.00, '2023-11-05', NULL, 2, 13),  -- 615: Entretien et réparations
('Loyer bureau', 1200000.00, '2023-11-15', NULL, 2, 10),  -- 6132: Locations immobilières
('Cadeaux à la clientèle', 200000.00, '2023-11-25', NULL, 3, 29),  -- 6234: Cadeaux à la clientèle
('Frais de télécommunications', 200000.00, '2023-11-05', NULL, 3, 39),  -- 626: Frais postaux et de télécommunications
('Impôts sur le revenu', 300000.00, '2023-11-15', NULL, 4, 51),  -- 6352: Taxes sur le chiffre d’affaires non récupérable
('Droits d enregistrement', 400000.00, '2023-11-25', NULL, 1, 51),  -- 6354: Droits d’enregistrement et de timbres
('Pénalités de retard' , 600000.00, '2023-11-05', NULL, 2, 71),  -- 6712: Pénalités; amendes fiscales et pénales
('Frais de représentation', 800000.00, '2023-11-15', NULL, 3, 25),  -- 6237: Publications
('Frais de transport', 900000.00, '2023-11-25', NULL, 4, 34),  -- 6242: Transports sur ventes
('Frais de publicité', 100000.00, '2023-11-05', NULL, 1, 31);  -- 6237: Publications

-- Décembre 2023
INSERT INTO Depense (description, montant, dateDepense, justificatif, id_ModePaiment, id_sub_comptes) VALUES
('Frais de télécommunications', 200000.00, '2023-12-05', NULL, 3, 39),  -- 626: Frais postaux et de télécommunications
('Loyer bureau', 1200000.00, '2023-12-15', NULL, 2, 10),  -- 6132: Locations immobilières
('Impôts sur les bénéfices', 3000000.00, '2023-12-20', NULL, 2, 81),  -- 695: Impôts sur les bénéfices
('Cadeaux à la clientèle', 300000.00, '2023-12-05', NULL, 3, 29),  -- 6234: Cadeaux à la clientèle
('Frais de publicité', 200000.00, '2023-12-15', NULL, 1, 31),  -- 6237: Publications
('Frais de transport', 400000.00, '2023-12-20', NULL, 4, 34),  -- 6242: Transports sur ventes
('Dépenses d amortissement', 800000.00, '2023-12-05', NULL, 2, 6),  -- 606: Amortissements
('Frais de gestion', 700000.00, '2023-12-15', NULL, 1, 41),  -- 628: Divers
('Frais d entretien', 200000.00, '2023-12-20', NULL, 2, 14),  -- 615: Entretien et réparations
('Abonnements périodiques', 300000.00, '2023-12-05', NULL, 1, 38);  -- 618: Divers (pourboires; dons courants


-- Janvier 2024
INSERT INTO Depense (description, montant, dateDepense, justificatif, id_ModePaiment, id_sub_comptes) VALUES
('Achats de matériel informatique', 500000.00, '2024-01-05', NULL, 1, 6),  -- 605: Achat de matériel; équipement et travaux
('Loyer bureau', 1200000.00, '2024-01-15', NULL, 2, 10),  -- 6132: Locations immobilières
('Frais de déplacement', 200000.00, '2024-01-20', NULL, 3, 35),  -- 6251: Voyages et déplacements
('Entretien et réparations', 250000.00, '2024-01-10', NULL, 2, 13),  -- 615: Entretien et réparations
('Frais de télécommunications', 150000.00, '2024-01-25', NULL, 4, 26),  -- 626: Frais postaux et de télécommunications
('Cadeaux à la clientèle', 300000.00, '2024-01-18', NULL, 3, 29),  -- 6234: Cadeaux à la clientèle
('Services de sous-traitance', 350000.00, '2024-01-12', NULL, 1, 7),  -- 611: Sous-traitance générale
('Impôts sur les bénéfices', 800000.00, '2024-01-28', NULL, 2, 81),  -- 695: Impôts sur les bénéfices
('Frais bancaires', 100000.00, '2024-01-07', NULL, 1, 44),  -- 628: Divers
('Assurance locative', 200000.00, '2024-01-02', NULL, 2, 62);  -- 672: Compte à la disposition des entités pour enregistrer; en cours d’exercice; les charges sur exercices antérieurs

-- Février 2024
INSERT INTO Depense (description, montant, dateDepense, justificatif, id_ModePaiment, id_sub_comptes) VALUES
('Fournitures de bureau', 300000.00, '2024-02-05', NULL, 2, 2),  -- 6022: Fournitures consommables
('Loyer bureau', 1200000.00, '2024-02-15', NULL, 2, 10),  -- 6132: Locations immobilières
('Frais de formation', 500000.00, '2024-02-25', NULL, 4, 16),  -- 617: Etudes et recherches
('Publicité et marketing', 400000.00, '2024-02-10', NULL, 1, 31),  -- 6237: Publications
('Frais juridiques', 150000.00, '2024-02-20', NULL, 3, 25),  -- 6712: Pénalités; amendes fiscales et pénales
('Dépenses de voyage', 250000.00, '2024-02-08', NULL, 2, 35),  -- 6251: Voyages et déplacements
('Honoraires de consultant', 600000.00, '2024-02-12', NULL, 2, 24),  -- 6226: Honoraires
('Entretien des installations', 200000.00, '2024-02-18', NULL, 1, 14),  -- 615: Entretien et réparations
('Abonnements périodiques', 100000.00, '2024-02-22', NULL, 1, 38),  -- 618: Divers (pourboires; dons courants)
('Frais de recyclage', 180000.00, '2024-02-27', NULL, 1, 63);  -- 658: Charges diverses de gestion courante

-- Mars 2024
INSERT INTO Depense (description, montant, dateDepense, justificatif, id_ModePaiment, id_sub_comptes) VALUES
('Emballages', 200000.00, '2024-03-05', NULL, 3, 3),  -- 6026: Emballages
('Loyer bureau', 1200000.00, '2024-03-15', NULL, 2, 10),  -- 6132: Locations immobilières
('Publicité et marketing', 300000.00, '2024-03-20', NULL, 1, 31),  -- 6237: Publications
('Frais de transport', 250000.00, '2024-03-10', NULL, 4, 34),  -- 6242: Transports sur ventes
('Frais de gestion', 180000.00, '2024-03-08', NULL, 1, 41),  -- 628: Divers
('Honoraires d avocat', 500000.00, '2024-03-14', NULL, 3, 24),  -- 6226: Honoraires
('Assurances professionnelles', 300000.00, '2024-03-18', NULL, 4, 15),  -- 616: Primes d’assurances
('Dépenses de formation', 150000.00, '2024-03-22', NULL, 1, 16),  -- 617: Etudes et recherches
('Frais de comptabilité', 200000.00, '2024-03-28', NULL, 2, 23),  -- 6226: Honoraires
('Frais d entretien', 120000.00, '2024-03-25', NULL, 1, 14);  -- 615: Entretien et réparations

-- Avril 2024
INSERT INTO Depense (description, montant, dateDepense, justificatif, id_ModePaiment, id_sub_comptes) VALUES
('Entretien et réparations', 250000.00, '2024-04-05', NULL, 2, 13),  -- 615: Entretien et réparations
('Loyer bureau', 1200000.00, '2024-04-15', NULL, 2, 10),  -- 6132: Locations immobilières
('Cadeaux à la clientèle', 200000.00, '2024-04-25', NULL, 3, 29),  -- 6234: Cadeaux à la clientèle
('Frais de télécommunications', 200000.00, '2024-04-05', NULL, 3, 39),  -- 626: Frais postaux et de télécommunications
('Impôts sur le revenu', 300000.00, '2024-04-15', NULL, 4, 51),  -- 6352: Taxes sur le chiffre d’affaires non récupérable
('Droits d enregistrement', 400000.00, '2024-04-25', NULL, 1, 51),  -- 6354: Droits d’enregistrement et de timbres
('Pénalités de retard' , 600000.00, '2024-04-05', NULL, 2, 71),  -- 6712: Pénalités; amendes fiscales et pénales
('Frais de représentation', 800000.00, '2024-04-15', NULL, 3, 25),  -- 6237: Publications
('Frais de transport', 900000.00, '2024-04-25', NULL, 4, 34),  -- 6242: Transports sur ventes
('Frais de publicité', 100000.00, '2024-04-05', NULL, 1, 31);  -- 6237: Publications

-- Mai 2024
INSERT INTO Depense (description, montant, dateDepense, justificatif, id_ModePaiment, id_sub_comptes) VALUES
('Frais de télécommunications', 200000.00, '2024-05-05', NULL, 3, 39),  -- 626: Frais postaux et de télécommunications
('Loyer bureau', 1200000.00, '2024-05-15', NULL, 2, 10),  -- 6132: Locations immobilières
('Impôts sur les bénéfices', 3000000.00, '2024-05-20', NULL, 2, 81),  -- 695: Impôts sur les bénéfices
('Cadeaux à la clientèle', 300000.00, '2024-05-10', NULL, 3, 29),  -- 6234: Cadeaux à la clientèle
('Frais de représentation', 500000.00, '2024-05-25', NULL, 1, 25),  -- 6237: Publications
('Frais de gestion', 400000.00, '2024-05-05', NULL, 1, 41),  -- 628: Divers
('Assurances professionnelles', 300000.00, '2024-05-15', NULL, 4, 15),  -- 616: Primes d’assurances
('Dépenses d amortissement', 1000000.00, '2024-05-20', NULL, 2, 6),  -- 606: Amortissements
('Frais bancaires', 150000.00, '2024-05-10', NULL, 1, 44),  -- 628: Divers
('Frais d entretien', 180000.00, '2024-05-25', NULL, 1, 14);  -- 615: Entretien et réparations

-- Juin 2024
INSERT INTO Depense (description, montant, dateDepense, justificatif, id_ModePaiment, id_sub_comptes) VALUES
('Achats de matériel informatique', 600000.00, '2024-06-05', NULL, 1, 6),  -- 605: Achat de matériel; équipement et travaux
('Loyer bureau', 1200000.00, '2024-06-15', NULL, 2, 10),  -- 6132: Locations immobilières
('Frais de déplacement', 200000.00, '2024-06-20', NULL, 3, 35),  -- 6251: Voyages et déplacements
('Entretien et réparations', 250000.00, '2024-06-10', NULL, 2, 13),  -- 615: Entretien et réparations
('Frais de télécommunications', 150000.00, '2024-06-25', NULL, 4, 26),  -- 626: Frais postaux et de télécommunications
('Cadeaux à la clientèle', 300000.00, '2024-06-18', NULL, 3, 29),  -- 6234: Cadeaux à la clientèle
('Services de sous-traitance', 350000.00, '2024-06-12', NULL, 1, 7),  -- 611: Sous-traitance générale
('Impôts sur les bénéfices', 800000.00, '2024-06-28', NULL, 2, 81),  -- 695: Impôts sur les bénéfices
('Frais bancaires', 100000.00, '2024-06-07', NULL, 1, 44),  -- 628: Divers
('Assurance locative', 200000.00, '2024-06-02', NULL, 2, 62);  -- 672: Compte à la disposition des entités pour enregistrer; en cours d’exercice; les charges sur exercices antérieurs



-- Machine
INSERT INTO Depense (description, montant, dateDepense, id_ModePaiment, id_sub_comptes) VALUES
('Achat de Presse à huile à froid', 2500000.00, '2022-06-15', 1, 6),  -- 605: Achat de matériel; équipement et travaux
('Achat de Centrifugeuse', 1750000.00, '2022-08-03', 2, 6),  -- 605: Achat de matériel; équipement et travaux
('Achat d Extracteur', 2000000.00, '2022-08-05', 3, 6);  -- 605: Achat de matériel; équipement et travaux