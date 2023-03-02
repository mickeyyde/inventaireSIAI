projet un peu guez que j'ai fait en stage a l'arrache pour passer le tps

TABLES BDD PGSQL:

create table marque(
id SERIAL PRIMARY KEY,
nom VARCHAR(255) UNIQUE NOT NULL
);

create table materiel(
id SERIAL PRIMARY KEY,
marque VARCHAR(255) NOT NULL references marque(nom) ON DELETE CASCADE,
reference VARCHAR(255) UNIQUE NOT NULL,
type VARCHAR(255) NOT NULL,
designation VARCHAR(255),
commentaire VARCHAR(255),
img VARCHAR(255)
);

CREATE TABLE proprietaire(
id SERIAL PRIMARY KEY,
nom VARCHAR(255) NOT NULL,
prenom VARCHAR(255) NOT NULL,
mail VARCHAR(255) UNIQUE NOT NULL
);

CREATE TABLE stock(
id SERIAL PRIMARY KEY,
nom VARCHAR(255) NOT NULL,
ref_proprietaire INT NOT NULL references proprietaire(id) ON DELETE CASCADE
);

CREATE TABLE quantite(
ref_materiel INT NOT NULL references materiel(id) ON DELETE CASCADE,
ref_stock INT NOT NULL references stock(id) ON DELETE CASCADE,
qte_ne INT NOT NULL CHECK (qte_ne >= 0),
qte_eo INT NOT NULL CHECK (qte_eo >= 0),
qte_se INT NOT NULL CHECK (qte_se >= 0),
commentaire VARCHAR(255),
PRIMARY KEY (ref_materiel, ref_stock)
);

CREATE TABLE log (
id SERIAL PRIMARY KEY,
date TIMESTAMPTZ NOT NULL,
action VARCHAR(255) NOT NULL,
auteur INT NOT NULL references proprietaire(id) ON DELETE CASCADE,
ref_stock INT NOT NULL references stock(id) ON DELETE CASCADE,
detail VARCHAR(255)
);
