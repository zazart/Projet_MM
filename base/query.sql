-- Check login 
SELECT Profil.id, Profil.email Profil.mot_de_passe, Profil.id_personnel, TypeProfil.libelle
FROM Profil JOIN TypeProfil ON Profil.type_profil = TypeProfil.id
WHERE Profil.email = ?;