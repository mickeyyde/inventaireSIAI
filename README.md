Site Web répertoriant les stocks du grenier du SIAI.

Tables BDD:

CREATE TABLE marque(
id_marque SERIAL PRIMARY KEY,
nom_marque VARCHAR(30) UNIQUE NOT NULL
);

CREATE TABLE materiel(
id_materiel SERIAL PRIMARY KEY,
designation VARCHAR(255),
ref_marque VARCHAR(255) NOT NULL references marque(nom_marque),
reference VARCHAR(30) UNIQUE NOT NULL,
qte INT NOT NULL,
caracteristique VARCHAR(255),
commentaire VARCHAR(255),
img VARCHAR(255)
);