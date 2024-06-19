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

-- Insert sample data into Vente table
INSERT INTO Vente (livraison, date_vente, prixTotal, id_commande) VALUES
(TRUE, '2024-06-05', 2500.00, 1),
(FALSE, '2024-06-18', 1500.00, 2);



-- Vue journal (mois, year)

-- Drop the existing function if it exists
DROP FUNCTION IF EXISTS generate_journal(INT, INT);

-- Create the function with the correct return type
CREATE OR REPLACE FUNCTION generate_journal(month INT, year INT)
RETURNS TABLE (
    transaction_date DATE,
    account_number VARCHAR,
    libelle VARCHAR,
    debit NUMERIC,
    credit NUMERIC
) AS $$
BEGIN
    RETURN QUERY
    -- Selecting expenses
    SELECT
        d.dateDepense AS transaction_date,
        s.intitule AS account_number,
        s.description AS libelle,
        CASE
            WHEN s.intitule LIKE '6%' THEN d.montant
            ELSE 0
        END AS debit,
        CASE
            WHEN s.intitule LIKE '6%' THEN 0
            ELSE d.montant
        END AS credit
    FROM
        Depense d
    JOIN
        sub_comptes s ON d.id_sub_comptes = s.id_sub_comptes
    WHERE
        EXTRACT(MONTH FROM d.dateDepense) = month
        AND EXTRACT(YEAR FROM d.dateDepense) = year

    UNION ALL

    -- Selecting sales
    SELECT
        v.date_vente AS transaction_date,
        '701' AS account_number,  -- Assuming '701' is for sales account
        'Vente' AS libelle,
        0 AS debit,
        v.prixTotal AS credit
    FROM
        Vente v
    WHERE
        EXTRACT(MONTH FROM v.date_vente) = month
        AND EXTRACT(YEAR FROM v.date_vente) = year;

END;
$$ LANGUAGE plpgsql;

-- To use the function:
SELECT * FROM generate_journal(6, 2024);




--Vue grand livre 

date
journal numero
Libelle
debit
credit
solde cumule