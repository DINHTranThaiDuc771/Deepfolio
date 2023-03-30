drop table if exists utilisateur;
drop table if exists message;
drop table if exists portfolio;
drop table if exists page;

create table utilisateur (
  nomUtilisateur varchar(30) primary key,
  mdphash varchar(30) not null,
  hashkey varchar(30) not null,
  nomUtilisateur varchar(30),
  prenomUtilisateur varchar(30),
  age int,
  ville varchar(30),
  universite varchar(30),
  mailUtilisateur varchar(30),
);

create table message (
  mailMessage varchar(30) primary key,
  nomEnvoyeur varchar(30),
  prenomEnvoyeur varchar(30),
  objet varchar(30) not null,
  text text not null,
);


create table portfolio (
    nomUtilisateur varchar(30) references utilisateur(nomUtilisateur),
    idPorfolio int not null,
    nomPortfolio varchar(30) not null,
    accesible boolean,
    primary key(nomUtilisateur, idPortfolio)
);

create table page (
    nomUtilisateur varchar(30) references portfolio(nomUtilisateur),
    idPortfolio int references portfolio(idPortfolio),
    idPage int not null,
    jsonPage json not null,
    primary key(nomUtilisateur, idPortfolio, idPage)
);
