
CREATE OR REPLACE FUNCTION get_sum_prix_paiements(mois INT, annee INT)
RETURNS NUMERIC AS $$
DECLARE
    total_prix NUMERIC;
BEGIN
    SELECT SUM(prix) INTO total_prix
    FROM paiementEmploye
    WHERE EXTRACT(MONTH FROM dates) = mois AND EXTRACT(YEAR FROM dates) = annee;

    RETURN total_prix;
END;
$$ LANGUAGE plpgsql;

CREATE OR REPLACE FUNCTION get_modified_client_id(p_id_commande INT) 
RETURNS VARCHAR AS $$
DECLARE
    client_id INT;
    client_name VARCHAR(255); -- Adjusted to VARCHAR(255) for client name
    modified_client_id VARCHAR(255); -- Adjusted to VARCHAR(255) for modified_client_id
BEGIN
    -- Check if the p_id_commande parameter is null
    IF p_id_commande IS NULL THEN
        RETURN '400';
    END IF;

    -- Get the client ID and name from the Commande and Client tables
    SELECT c.id_client, cl.nomGlobal INTO client_id, client_name
    FROM Commande c
    JOIN Client cl ON c.id_client = cl.id_client
    WHERE c.id_commande = p_id_commande;

    -- If client ID is found, format the string accordingly
    IF client_id IS NOT NULL THEN
        modified_client_id := '40' || client_id::TEXT || ' ' || client_name;
    ELSE
        modified_client_id := '400';
    END IF;

    RETURN modified_client_id;
END;
$$ LANGUAGE plpgsql;

CREATE OR REPLACE FUNCTION generate_journal(month INT, year INT)
RETURNS TABLE (
    transaction_date DATE,
    account_number VARCHAR,
    libelle VARCHAR,
    debit NUMERIC,
    credit NUMERIC,
    tiers VARCHAR
) AS $$
BEGIN
    RETURN QUERY
    WITH expenses AS (
        SELECT
            d.dateDepense AS transaction_date,
            s.intitule AS account_number,
            s.description::VARCHAR AS libelle,
            CASE
                WHEN s.intitule LIKE '6%' THEN d.montant
                ELSE 0
            END AS debit,
            CASE
                WHEN s.intitule LIKE '6%' THEN 0
                ELSE d.montant
            END AS credit,
            '0'::VARCHAR AS tiers -- Placeholder value for expenses
        FROM
            Depense d
        JOIN
            sub_comptes s ON d.id_sub_comptes = s.id_sub_comptes
        WHERE
            EXTRACT(MONTH FROM d.dateDepense) = month
            AND EXTRACT(YEAR FROM d.dateDepense) = year
    ), sales AS (
        SELECT
            v.date_vente AS transaction_date,
            '701'::VARCHAR AS account_number,
            'Vente'::VARCHAR AS libelle,
            0 AS debit,
            v.prixTotal AS credit,
            get_modified_client_id(v.id_commande) AS tiers
        FROM
            vente v
        WHERE
            EXTRACT(MONTH FROM v.date_vente) = month
            AND EXTRACT(YEAR FROM v.date_vente) = year
    )
    SELECT * FROM expenses
    UNION ALL
    SELECT * FROM sales
    UNION ALL
    SELECT
        make_date(year, month, 01) AS transaction_date,
        '64'::VARCHAR AS account_number,
        'Charges Personnelles'::VARCHAR AS libelle,
        0 AS debit,
        (SELECT COALESCE(SUM(prix), 0) FROM paiementEmploye WHERE EXTRACT(MONTH FROM dates) = month AND EXTRACT(YEAR FROM dates) = year) AS credit,
        '0'::VARCHAR AS tiers -- Placeholder value for Charges Personnelles
    ;
END;
$$ LANGUAGE plpgsql;

SELECT * FROM generate_journal(6, 2024);


