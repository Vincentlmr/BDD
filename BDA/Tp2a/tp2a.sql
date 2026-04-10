DROP table if exists stats;


create table stats(
    Id integer PRIMARY KEY,
    Prenom varchar(30),
    Score int
    );

insert into stats (Id, Prenom, Score) values (1,'Wendie',9), (2,'Selma',8) ,(3,'Delphine',10);


select distinct pid,oid,relation, datname,mode,regclass(relation) as table from pg_database natural join pg_locks where datname='bda_tp2a_vlemeur';
