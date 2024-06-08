CREATE OR REPLACE FUNCTION get_last_bonus()
RETURNS TABLE (
    amount NUMERIC(18,2)
) AS $$
BEGIN
    RETURN QUERY
    SELECT  b.amount
    FROM Bonus b
    WHERE b.id = (SELECT MAX(id) FROM Bonus);
END;
$$ LANGUAGE plpgsql;

CREATE OR REPLACE FUNCTION get_last_salary(collecteur INT)
RETURNS TABLE (
    prix NUMERIC(18,2)
) AS $$
BEGIN
    RETURN QUERY
    SELECT sa.prix
    FROM salairecollecteur sa
    WHERE sa.id_salairecollecteur = (SELECT MAX(id_salairecollecteur) FROM salairecollecteur WHERE id_collecteur = collecteur);
END;
$$ LANGUAGE plpgsql;

CREATE OR REPLACE FUNCTION get_sum_collect(collecteur INT, annee INT)
RETURNS TABLE(qtt NUMERIC(18,2)) 
AS $$
BEGIN
    RETURN QUERY 
    SELECT SUM(c.qtt)
    FROM collects c
    WHERE c.id_collecteur = collecteur AND EXTRACT(YEAR FROM c.datecollect) = annee;
END;
$$ LANGUAGE plpgsql;



select  * from get_last_salary (2);
select  * from get_last_bonus() ;
select  * from get_sum_collect (2,2010);
SELECT *
    FROM collects c
    WHERE c.id_collecteur = 2 AND EXTRACT(YEAR FROM c.datecollect) = 2010;
