README FOR SQL
ALL QUERY FOR CREATE BDD ISIFORMA MYSQL

_/_/_/_/_/_/_/_/_/   CREATE main table training organization  _/_/_/_/_/_/_/_/_/

CREATE TABLE IF NOT EXISTS isiforma_training_organization(
            `id` int(10) NOT NULL AUTO_INCREMENT PRIMARY KEY,
            `name` varchar (25) NOT NULL,
            `adress` varchar (25) NOT NULL,
            `cp` varchar(15) NOT NULL,
            `city` varchar (100) NOT NULL,
            `tel` varchar (10) NOT NULL,
            `email` varchar (40) NOT NULL,
            `num_activity` varchar (40) NOT NULL,
            `rcs` varchar (30) NOT NULL,
            `siret` varchar(14) NOT NULL,
            `share_capital` varchar(10) NOT NULL
            );

_/_/_/_/_/_/_/_/_/  Create table category for training category  _/_/_/_/_/_/_/_/_/

CREATE TABLE IF NOT EXISTS isiforma_category(
            `id` int(10) NOT NULL AUTO_INCREMENT PRIMARY KEY,
            `name` varchar (25) NOT NULL,
            `category_parent_id` int(10) NULL,
            CONSTRAINT FK_CATEGORY_ID_CATEGORY_ID FOREIGN KEY isiforma_category(category_parent_id) REFERENCES isiforma_category(id)
            );

             INSERT INTO isiforma_category(
                         `id`,
                         `name`)
                           VALUES ('1','Category Default');

_/_/_/_/_/_/_/_/_/  Create table modality  _/_/_/_/_/_/_/_/_/

CREATE TABLE isiforma_modality (
                `id` int(10) NOT NULL AUTO_INCREMENT PRIMARY KEY,
                `name` varchar (25) NOT NULL
                );

_/_/_/_/_/_/_/_/_/  Create table required level _/_/_/_/_/_/_/_/_/

CREATE TABLE IF NOT EXISTS isiforma_required_level (
                `id` int(10) NOT NULL AUTO_INCREMENT PRIMARY KEY,
                `name` varchar (25) NOT NULL
                );

_/_/_/_/_/_/_/_/_/ Create table for type training _/_/_/_/_/_/_/_/_/

CREATE TABLE IF NOT EXISTS isiforma_type (
            `id` int(10) NOT NULL AUTO_INCREMENT PRIMARY KEY,
            `name` varchar (25) NOT NULL);

_/_/_/_/_/_/_/_/_/ Create table audience for audience training _/_/_/_/_/_/_/_/_/

CREATE TABLE IF NOT EXISTS isiforma_audience (
                `id` int(10) NOT NULL AUTO_INCREMENT PRIMARY KEY,
                `name` varchar (25) NOT NULL
                );

_/_/_/_/_/_/_/_/_/ Create table funding for training _/_/_/_/_/_/_/_/_/

CREATE TABLE IF NOT EXISTS isiforma_funding (
                `id` int(5) NOT NULL AUTO_INCREMENT PRIMARY KEY,
                `name` varchar (25) NOT NULL
                );

_/_/_/_/_/_/_/_/_/ Create table training _/_/_/_/_/_/_/_/_/

CREATE TABLE IF NOT EXISTS isiforma_training (
                `id` int(5) NOT NULL AUTO_INCREMENT PRIMARY KEY,
                `name` varchar (25) NOT NULL,
                `price` float (10) NOT NULL,
                `time` time(3) NOT NULL,
                `certification` text NOT NULL,
                `training_organization_id` int(5) NOT NULL
                );

_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/  INSERT ON SQL FOR TEST DIRECT WITH PHP MY ADMIN _/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/
_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/
_/_/_/_/_/_/_/_/_/ Insert Organization.

INSERT INTO training_organization (`id`,`name`, `adress`, `cp`, `city`, `tel`, `email`, `num_activity`, `rcs`, `siret`, `share_capital`)
        VALUES  ('0','Test Organization','Rue de la Rue','75000','Paris','0202020202','test@gmail.com','1245124512','Paris RCS 400','12451245786532','5000');


_/_/_/_/_/_/_/_/_/ Insert Audience.
ID for audience is AUTO_INCREMENT

INSERT INTO `isiforma_audience`(`name`) VALUES ('Development'),('Graphist'),('Architect'),('Webmaster');

_/_/_/_/_/_/_/_/_/ Insert Category.
CATEGORY DEFAULT ID 1. CREATE ACTIVATION PLUGIN.
ID AUTO INCREMENT

INSERT INTO `isiforma_category`(`name`, `category_parent_id`) VALUES ('Informatique','1');
INSERT INTO `isiforma_category`(`name`, `category_parent_id`) VALUES ('Development', '2');
INSERT INTO `isiforma_category`(`name`, `category_parent_id`) VALUES ('PHP', '3');
INSERT INTO `isiforma_category`(`name`, `category_parent_id`) VALUES ('Angular', '3');
INSERT INTO `isiforma_category`(`name`, `category_parent_id`) VALUES ('Symfony', '3');

_/_/_/_/_/_/_/_/_/ Insert Funding.
ID AUTO INCREMENT
INSERT INTO `isiforma_funding`(`name`) VALUES ('OPCO'), ('Pole Emploi'), ('CPF');

_/_/_/_/_/_/_/_/_/ Insert Modality
ID AUTO INCREMENT
INSERT INTO `isiforma_modality`(`name`) VALUES ('Présentiel'), ('A distance'), ('Hybride');

_/_/_/_/_/_/_/_/_/ Insert Required Level.
ID AUTO INCREMENT
INSERT INTO `isiforma_required_level`(`name`) VALUES ('Débutant'), ('Intermédiaire'), ('Expert');

_/_/_/_/_/_/_/_/_/ Type Training.
ID AUTO INCREMENT

INSERT INTO `isiforma_type`(`name`) VALUES ('Inter'), ('Intra'), ('Sur Mesure');
