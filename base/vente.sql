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

