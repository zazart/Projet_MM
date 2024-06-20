-- Insertions de test
INSERT INTO Genre(description) VALUES
('Homme'),
('Femme');

INSERT INTO Bonus(dateDebut, amount) VALUES
('2024-01-01', 100.00),
('2024-02-01', 200.00);

INSERT INTO Client(nomGlobal, email, adresse) VALUES
('Client A', 'clientA@example.com', '123 Rue Principale'),
('Client B', 'clientB@example.com', '456 Avenue Secondaire');

INSERT INTO Commande(datecommande, id_client) VALUES
('2024-03-01 10:00:00', 1),
('2024-03-02 11:30:00', 2);

INSERT INTO Panier(id_produit, quantite, id_commande) VALUES
(1, 2, 1),
(2, 1, 2);

INSERT INTO vente(livraison, date_vente, prixTotal, id_commande) VALUES
(false, '2024-03-03', 300.00, 1),
(true, '2024-03-04', 400.00, 2);

INSERT INTO MatierePremier(Nom) VALUES
('Farine'),
('Sucre');

INSERT INTO PrixMatierePremier(prix, datePrix, MatierPremier) VALUES
(20.00, '2024-01-01', 1),
(25.00, '2024-02-01', 2);

INSERT INTO Source(lieu) VALUES
('Paris'),
('Lyon');

INSERT INTO StockMatierPremier(dates, in_qtt, out_qtt, MatierePremier) VALUES
('2024-01-01', 100, 50, 1),
('2024-02-01', 150, 75, 2);

INSERT INTO Production(MatierePremier, QuantiteProduit, DateProduction) VALUES
(1, 500, '2024-03-01'),
(2, 600, '2024-03-02');

INSERT INTO machine(nom_machine, fonction, date_achat) VALUES
('Machine A', 'Couture', '2023-12-01'),
('Machine B', 'Confection', '2023-11-01');

INSERT INTO stat_machine(id_machine, date_verification, statut, descri) VALUES
(1, '2024-01-01', 1, 'En bon état'),
(2, '2024-02-01', 0, 'Neuf');

INSERT INTO ModePaiement(intitule) VALUES
('Espèces'),
('Chèque');

INSERT INTO Produit(nom_produit, prix_unitaire) VALUES
('T-shirt', 15.99),
('Jeans', 29.99);

INSERT INTO StockProduit(DateStockProduit, QuantiteEntrant, QuantiteSortant, id_Produit) VALUES
('2024-01-01', 100, 50, 1),
('2024-02-01', 150, 75, 2);

INSERT INTO SourceMatierePremier(datePrelevement, MatierPremier, Source) VALUES
('2024-01-01', 1, 1),
('2024-02-01', 2, 2);

INSERT INTO Poste(nom, montant_salaire) VALUES
('Couturier', 2500.00),
('Confectionneur', 3000.00);

INSERT INTO Salaire(id_poste, date_debut, montant_salaire) VALUES
(1, '2024-01-01', 2500.00),
(2, '2024-02-01', 3000.00);

INSERT INTO Employe(embauche, debauche, nom, email, telephone, adresse, id_genre, id_poste) VALUES
('2023-01-01', NULL, 'Jean Dupont', 'jean.dupont@example.com', '0600000000', '123 Rue Principale', 1, 1),
('2023-02-01', NULL, 'Marie Curie', 'marie.curie@example.com', '0600000001', '456 Avenue Secondaire', 2, 2);

INSERT INTO paiementEmploye(dates, prix, libelle, id_employe) VALUES
('2024-01-01', 500.00, 'Salaire Janvier', 1),
('2024-02-01', 600.00, 'Salaire Février', 2);


INSERT INTO paiementEmploye(dates, prix, libelle, id_employe) VALUES
('2024-06-01', 500.00, 'Salaire Janvier', 1),
('2024-06-01', 600.00, 'Salaire Février', 2);



INSERT INTO Collects(DateCollect, qtt, id_employe, Id_MatierePremier) VALUES
('2024-01-01', 100.00, 1, 1),
('2024-02-01', 120.00, 2, 2);

INSERT INTO PanierProduit(id_produit, id_panier) VALUES
(1, 1),
(2, 2);

INSERT INTO TypeProfil(libelle) VALUES
('Administrateur'),
('Utilisateur');


-- Insert sample data into Client table
INSERT INTO Client (nomGlobal, email, adresse) VALUES
('John Doe', 'john.doe@example.com', '123 Main St'),
('Jane Smith', 'jane.smith@example.com', '456 Maple Ave'),
('Acme Corporation', 'contact@acmecorp.com', '789 Oak Blvd');

-- Insert sample data into Commande table
INSERT INTO Commande (datecommande, id_client) VALUES
('2024-06-01 10:00:00', 1),
('2024-06-10 14:30:00', 2),
('2024-06-15 09:15:00', 3),
('2024-06-18 11:45:00', 1);
-- Insert sample data into modeDepaiement table
INSERT INTO modeDepaiement (nom, descriptions) VALUES
('Cash', 'Payment made using cash'),
('Credit Card', 'Payment made using a credit card'),
('Bank Transfer', 'Payment made through bank transfer'),
('Cheque', 'Payment made using a cheque');

-- Insert sample data into Depense table
INSERT INTO Depense (description, montant, dateDepense, justificatif, id_ModePaiment, id_sub_comptes) VALUES
('Achat de matières premières', 1500.00, '2024-06-10', NULL, 1, 1),
('Fournitures de bureau', 300.00, '2024-06-15', NULL, 2, 2),
('Emballages', 500.00, '2024-06-20', NULL, 3, 3);

-- Insert sample data into Depense table
INSERT INTO Depense (description, montant, dateDepense, justificatif, id_ModePaiment, id_sub_comptes) VALUES
('Achat de matières premières', 1600.00, '2024-06-11', NULL, 1, 1),
('Fournitures de bureau', 120.00, '2024-06-13', NULL, 2, 2),
('Emballages', 501.00, '2024-06-10', NULL, 3, 3);

-- Insert sample data into Vente table
INSERT INTO Vente (livraison, date_vente, prixTotal, id_commande) VALUES
(TRUE, '2024-06-05', 2500.00, 1),
(FALSE, '2024-06-18', 1500.00, 2);

