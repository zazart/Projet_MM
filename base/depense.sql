
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
    WITH expenses AS (
        SELECT
            d.dateDepense AS transaction_date,
            s.intitule AS account_number,
            s.description::varchar AS libelle,
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
    ), sales AS (
        SELECT
            v.date_vente AS transaction_date,
            '701' AS account_number,
            'Vente' AS libelle,
            0 AS debit,
            v.prixTotal AS credit
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
        '64' AS account_number,
        'Charges Personnelles' AS libelle,
        0 AS debit,
        (SELECT SUM(prix) FROM paiementEmploye WHERE EXTRACT(MONTH FROM dates) = month AND EXTRACT(YEAR FROM dates) = year) AS credit;
END;
$$ LANGUAGE plpgsql;


-- To use the function:
SELECT * FROM generate_journal(6, 2024);




CREATE OR REPLACE FUNCTION generate_grand_livre(month INT, year INT)
RETURNS TABLE (
    account_number VARCHAR,
    libelle VARCHAR,
    total_debit NUMERIC,
    total_credit NUMERIC
) AS $$
BEGIN
    RETURN QUERY
    WITH transactions AS (
        SELECT
            s.intitule AS account_number,
            s.description::varchar AS libelle,
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
        SELECT
            '701' AS account_number,
            'Vente' AS libelle,
            0 AS debit,
            v.prixTotal AS credit
        FROM
            vente v
        WHERE
            EXTRACT(MONTH FROM v.date_vente) = month
            AND EXTRACT(YEAR FROM v.date_vente) = year
        UNION ALL
        SELECT
            '64' AS account_number,
            'Charges Personnelles' AS libelle,
            0 AS debit,
            (SELECT SUM(prix) FROM paiementEmploye WHERE EXTRACT(MONTH FROM dates) = month AND EXTRACT(YEAR FROM dates) = year) AS credit
    )
    SELECT
        transactions.account_number,
        transactions.libelle,
        SUM(transactions.debit) AS total_debit,
        SUM(transactions.credit) AS total_credit
    FROM transactions
    GROUP BY transactions.account_number, transactions.libelle;
END;
$$ LANGUAGE plpgsql;


SELECT * FROM generate_grand_livre(6, 2024);
