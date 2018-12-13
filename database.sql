CREATE TABLE user (
    id int NOT NULL AUTO_INCREMENT,
    name varchar(255),
    surename varchar(255),
    email varchar(255),
    PRIMARY KEY (id)

);

CREATE TABLE director (
    id int NOT NULL AUTO_INCREMENT,
    name varchar(255),
    surename varchar(255),
     PRIMARY KEY (id)

);

create table favs(
    user_id int not null,
    director_id int not null,
    primary key(user_id,director_id),
    foreign key (user_id) references user (id) on delete cascade,
    foreign key (director_id) references director (id) on delete cascade
);

INSERT INTO user (name, surename, email) VALUES ('Henrique', 'Feitosa', 'hfeitosa@xpto.com');

INSERT INTO director (name, surename) VALUES ('Donal', 'Duck');
