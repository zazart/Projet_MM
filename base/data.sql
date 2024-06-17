
drop table genre;
drop table bonus;
drop table collecteur ;
drop table collects ;
drop table matierpremier ;
drop table paiementcollecteur ;
drop table salairecollecteur ;

select  * from employe where id_poste = 7;

select  * from employe;
select  * from poste;

select  * from employe e join poste p on p.id_poste = e.id_poste  where p.nom = 'Collecteur' ;
select  * from employe e ;

insert  into genre values
(1, 'Femme'),
(2, 'Homme');

select  * from bonus;

select  * from collecteur;

select  * from collects;
select  * from matierpremier ;


select * from matierpremier m ;
select  * from collects;
select  * from 

select  p.montant_salaire as prix from poste  p join employe e on e.id_poste  = p.id_poste;

select  * from paiementemploye ;


select  sa.*, c.nom from salairecollecteur sa
join Collecteur c on c.id_collecteur  = sa.id_collecteur ;

select  c.id_collects, c.datecollect as dates,c.qtt ,c.id_collecteur, e.nom as collecteur, c.id_matierpremier , mp.nom as matiere 
from collects c
join matierpremier mp on mp.id_matierpremier = c.id_matierpremier
join employe e on c.id_collecteur = e.id_employe ;

select  *  from salairecollecteur ;

select  * from paiementcollecteur ;
sele 
