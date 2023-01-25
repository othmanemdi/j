CREATE TABLE
    produits (
        id int,
        reference varchar(255),
        designation varchar(255),
        quantite int,
        prix decimal,
        ancien_prix decimal
    );

ALTER TABLE produits CHANGE id id int(11) NOT NULL AUTO_INCREMENT;

INSERT INTO
    produits (
        reference,
        designation,
        quantite,
        prix,
        ancien_prix
    )
VALUES (
        'R-1',
        'Iphone 13 Pro Max Blue',
        2,
        13000.00,
        13500.00
    );

INSERT INTO
    produits (
        reference,
        designation,
        quantite,
        prix,
        ancien_prix
    )
VALUES (
        'R-2',
        'Iphone 14 Pro Max Gold',
        1,
        18000.00,
        18500.00
    ), (
        'R-3',
        'Imac Orange',
        2,
        24000.00,
        24500.00
    );

UPDATE produits SET prix = 24000 where id = 3;

DELETE FROM produits WHERE id = 3;

INSERT INTO
    `couleurs` (`id`, `nom`, `date_created`)
VALUES (
        NULL,
        'Blue',
        current_timestamp()
    ), (
        NULL,
        'Black',
        current_timestamp()
    ), (
        NULL,
        'Geen',
        current_timestamp()
    );

mysql -u root;

show databases;

show tables;

show columns from products;

CREATE TABLE
    produits (
        id INT NOT NULL AUTO_INCREMENT,
        reference VARCHAR(255) NULL DEFAULT NULL,
        designation VARCHAR(255) NULL DEFAULT NULL,
        quantite INT NOT NULL DEFAULT '0',
        prix DECIMAL(9, 2) NOT NULL DEFAULT '0',
        ancien_prix DECIMAL(9, 2) NOT NULL DEFAULT '0',
        PRIMARY KEY (id)
    );

SELECT
    p.*,
    c.nom AS categorie_nom,
    cl.nom AS couleur_nom
FROM produits p
    INNER JOIN categories c ON c.id = p.categorie_id
    INNER JOIN couleurs cl ON cl.id = p.couleur_id;

SELECT
    p.*,
    c.nom AS categorie_nom,
    cl.nom AS couleur_nom
FROM produits p
    LEFT JOIN categories c ON c.id = p.categorie_id
    LEFT JOIN couleurs cl ON cl.id = p.couleur_id;

SELECT
    p.*,
    c.nom AS categorie_nom,
    cl.nom AS couleur_nom
FROM produits p
    LEFT JOIN categories c ON c.id = p.categorie_id
    LEFT JOIN couleurs cl ON cl.id = p.couleur_id;