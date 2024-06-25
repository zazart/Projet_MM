-- Requête pour trouver le stock actuel par produit
SELECT 
    p.nom_produit,
    SUM(quantiteentrant - quantitesortant) AS stock_actuel,
	MAX(datestockproduit) AS datederniereproduction
FROM 
    stockproduit as sp
JOIN 
	produit as p
ON sp.id_produit = p.id_produit
GROUP BY 
    p.nom_produit;