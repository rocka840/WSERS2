create or replace database wsers2;
use wsers2;

CREATE TABLE PPL (
    ID_PERSON int NOT NULL AUTO_INCREMENT,

    LastName varchar(50),
    FirstName varchar(50),
    Age int,

    UserName varchar(20) NOT NULL UNIQUE,
    Psw varchar(100) NOT NULL,
    primary key (ID_PERSON)
);