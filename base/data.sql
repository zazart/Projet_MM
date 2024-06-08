
drop table genre;
drop table bonus;
drop table collecteur ;
drop table collects ;
drop table matierpremier ;
drop table paiementcollecteur ;



insert  into genre values
(1, 'Femme'),
(2, 'Homme');

select  * from bonus;

select  * from collecteur;

select  * from collects;
select  * from matierpremier ;


select * from matierpremier m ;
select  * from collects;

select  sa.*, c.nom from salairecollecteur sa
join Collecteur c on c.id_collecteur  = sa.id_collecteur ;

select  c.id_collects, c.datecollect as dates,c.qtt ,c.id_collecteur, col.nom as collecteur, c.id_matierpremier , mp.nom as matiere 
from collects c
join matierpremier mp on mp.id_matierpremier = c.id_matierpremier
join collecteur col on c.id_collecteur = col.id_collecteur ;

select  *  from salairecollecteur ;

select  * from paiementcollecteur ;
sele 
