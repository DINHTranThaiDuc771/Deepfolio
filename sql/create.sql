drop table if exists utilisateur cascade;
drop table if exists message;
drop table if exists page;
drop table if exists portfolio;

create table utilisateur (
  nomUtilisateur varchar(30) primary key,
  mdphash textl not null,
  nom varchar(30),
  prenom varchar(30),
  age int,
  ville varchar(30),
  universite varchar(30),
  mailUtilisateur varchar(30)
);

create table message (
  mailMessage varchar(30),
  nomUtilisateur varchar(30) references utilisateur(nomUtilisateur),
  nomEnvoyeur varchar(30),
  prenom varchar(30),
  objet varchar(30) not null,
  message text not null,
  primary key(mailMessage, nomUtilisateur)
);

create table portfolio (
    nomUtilisateur varchar(30) references utilisateur(nomUtilisateur),
    idPortfolio serial not null,
    nomPortfolio varchar(30) not null,
    accesible boolean,
    primary key(nomUtilisateur, idPortfolio)
);

create table page (
    nomUtilisateur varchar(30),
    idPortfolio int,
    idPage serial not null,
    jsonPage json not null,
    type varchar(30) not null,
    foreign key (nomUtilisateur, idPortfolio) references portfolio(nomUtilisateur, idPortfolio),
    primary key(nomUtilisateur, idPortfolio, idPage)
);