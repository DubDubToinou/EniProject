
README FOR SQL
ALL QUERY FOR CREATE BDD ISIFORMA MYSQL


//CREATE main table training organization

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
            `siret` varcahar(14) NOT NULL,
            `share_capital` varchar(10) NOT NULL
            )

//create table category for training category

CREATE TABLE IF NOT EXISTS isiforma_category(
            `id` int(10) NOT NULL AUTO_INCREMENT PRIMARY KEY,
            `name` varchar (25) NOT NULL
            )

             //INSERT FOR 1 CATEGORY DEFAULT

             INSERT INTO isiforma_category(
                         `id`,
                         `name`)
                           VALUES ('1','Category Default'
                           )";

//create table modality

CREATE TABLE isiforma_modality (
                `id` int(10) NOT NULL AUTO_INCREMENT PRIMARY KEY,
                `name` varchar (25) NOT NULL
                );

//create table required level

CREATE TABLE IF NOT EXISTS isiforma_required_level (
                `id` int(10) NOT NULL AUTO_INCREMENT PRIMARY KEY,
                `name` varchar (25) NOT NULL
                );

//create table for type training

CREATE TABLE IF NOT EXISTS isiforma_type (
            `id` int(10) NOT NULL AUTO_INCREMENT PRIMARY KEY,
            `name` varchar (25) NOT NULL)

//create table audience for audience training

CREATE TABLE IF NOT EXISTS isiforma_audience (
                `id` int(10) NOT NULL AUTO_INCREMENT PRIMARY KEY,
                `name` varchar (25) NOT NULL
                );

//create table funding for training

CREATE TABLE IF NOT EXISTS isiforma_funding (
                `id` int(5) NOT NULL AUTO_INCREMENT PRIMARY KEY,
                `name` varchar (25) NOT NULL
                );

//create table training

CREATE TABLE IF NOT EXISTS isiforma_training (
                `id` int(5) NOT NULL AUTO_INCREMENT PRIMARY KEY,
                `name` varchar (25) NOT NULL,
                `price` float (10) NOT NULL,
                `time` time(3) NOT NULL,
                `certification` text NOT NULL,
                `training_organization_id` int(5) NOT NULL
                )

//create table relation training with audience

CREATE TABLE IF NOT EXISTS isiforma_rel_training_audience(
        `id` int(10) NOT NULL AUTO_INCREMENT PRIMARY KEY,
        `audience_id` int (10) NOT NULL,
        `training_id` int (10) NOT NULL,
        CONSTRAINT FK_TAG_ID_TRAINIG_ID FOREIGN KEY $table_name_rel_training_audience(tags_id) REFERENCES $table_name_isi_audience(id),
        CONSTRAINT FK_TRAINING_ID_TAG_ID FOREIGN KEY $table_name_rel_training_audience(training_id) REFERENCES $table_name_isi_training(id)

)


//create table relation training with modality

CREATE TABLE IF NOT EXISTS isiforma_rel_training_modality(
        `id` int(10) NOT NULL AUTO_INCREMENT PRIMARY KEY,
        `modality_id` int (10) NOT NULL,
        `training_id` int (10) NOT NULL,
        CONSTRAINT FK_MODALITY_ID_TRAINIG_ID FOREIGN KEY $table_name_rel_training_modality(modality_id) REFERENCES $table_name_modality(id),
        CONSTRAINT FK_TRAINING_ID_MODALITY_ID FOREIGN KEY $table_name_rel_training_modality(training_id) REFERENCES $table_name_training(id)
)

//Create table relation training with funding

CREATE TABLE IF NOT EXISTS isiforma_rel_training_funding (
            `id` int(10) NOT NULL AUTO_INCREMENT PRIMARY KEY,
            `funding_id` int(10) NOT NULL,
            `training_id` int(10) NOT NULL,
            CONSTRAINT FK_FUNDING_ID_TRAINING_ID FOREIGN KEY $table_name_rel_training_funding(funding_id) REFERENCES $table_name_funding(id),
            CONSTRAINT FK_TRAINING_ID_FUNDING_ID FOREIGN KEY $table_name_rel_training_funding(training_id) REFERENCES $table_name_training(id)
            )

//create table relation training with type

CREATE TABLE IF NOT EXISTS isiforma_rel_training_type (
            `id` int(10) NOT NULL AUTO_INCREMENT PRIMARY KEY,
            `type_id` int(10) NOT NULL,
            `training_id` int(10) NOT NULL,
            CONSTRAINT FK_TYPE_ID_TRAINING_ID FOREIGN KEY $table_name_rel_training_type(type_id) REFERENCES $table_name_type(id),
            CONSTRAINT FK_TRAINING_ID_TYPE_ID FOREIGN KEY $table_name_rel_training_type(training_id) REFERENCES $table_name_training(id)
    )

//create table relation training with level required

CREATE TABLE IF NOT EXISTS isiforma_rel_training_level (
            `id` int(10) NOT NULL AUTO_INCREMENT PRIMARY KEY,
            `level_id` int(10) NOT NULL,
            `training_id` int(10) NOT NULL,
            CONSTRAINT FK_LEVEL_ID_TRAINING_ID FOREIGN KEY $table_name_rel_training_level(level_id) REFERENCES $table_name_required_level(id),
            CONSTRAINT FK_TRAINING_ID_LEVEL_ID FOREIGN KEY $table_name_rel_training_level(training_id) REFERENCES $table_name_training(id)
    )

//create table relation training with category

CREATE TABLE IF NOT EXISTS $table_name_isi_rel_training_category (
            `id` int(10) NOT NULL AUTO_INCREMENT PRIMARY KEY,
            `category_id` int(10) NOT NULL,
            `training_id` int(10) NOT NULL,
            CONSTRAINT FK_CATEGORY_ID_TRAINING_ID FOREIGN KEY $table_name_isi_rel_training_category(category_id) REFERENCES $table_name_isi_category(id),
            CONSTRAINT FK_TRAINING_ID_LEVEL_ID FOREIGN KEY $table_name_isi_rel_training_category(training_id) REFERENCES $table_name_isi_training(id)
    )

//create table place
CREATE TABLE IF NOT EXISTS isiforma_place (
                `id` int(10) NOT NULL AUTO_INCREMENT PRIMARY KEY,
                `name` varchar (25) NOT NULL,
                `adress` varchar(30) NOT NULL,
                `cp` varchar(5) NOT NULL,
                `city` varchar(30) NOT NULL,
                `training_id` int(10) NOT NULL,
                CONSTRAINT FK_PLACE_ID_TRAINING_ID FOREIGN KEY $table_name_isi_place(training_id) REFERENCES $table_name_isi_training(id)
        )

//create table room
CREATE TABLE IF NOT EXISTS isiforma_room (
            `id` int(10) NOT NULL AUTO_INCREMENT PRIMARY KEY,
            `name` varchar (25) NOT NULL,
            `capacity` int(4) NOT NULL,
            `place_id` int(10) NOT NULL,
            CONSTRAINT FK_ROOM_ID_PLACE_ID FOREIGN KEY $table_name_isi_room(place_id) REFERENCES $table_name_isi_place(id)
    )

//create table equipement
CREATE TABLE IF NOT EXISTS isiforma_equipement (
            `id` int(10) NOT NULL AUTO_INCREMENT PRIMARY KEY,
            `name` varchar (20) NOT NULL,
            `room_id` int (10) NOT NULL,
            CONSTRAINT FK_EQUIPEMENT_ID_ROOM_ID FOREIGN KEY $table_name_isi_equipement(room_id) REFERENCES $table_name_isi_room(id)
    )













