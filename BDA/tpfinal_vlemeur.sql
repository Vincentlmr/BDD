/*4*/

/* FONCTION */

/*4.1.1*/
create or replace function nb_voiture(text)
    returns int as $$
    declare nb int;
    begin
    select count(voiture.id) into nb from voiture join marque on voiture.ref_marque=marque.id where marque.nom=$1;
    return nb;
    end;$$
    language 'plpgsql';

/* test: select nb_voiture('Renault'); on obtient bien 2

/*4.1.2*/

create or replace function get_nom_pays(int)
    returns text as $$
    declare list text; voit record;i int;
    begin
    i := 1;
    for voit in select voiture.nom as nm ,marque.pays as pays from voiture join marque on voiture.ref_marque=marque.id where voiture.id=$1
    loop
        if i=1 then
            list := voit.nm;
            list := list || '(' || voit.pays || ')';
        end if;
        i := i+1;
    end loop;
    return list;
    end;$$
language 'plpgsql';

/* test : select get_nom_pays(1); retourne bien Clio(France)*/

/* 4.2.1 */
    
create or replace procedure show_marque_small(id int)
    as $$ 
    declare name text; pays text;
    begin
    select marque.nom into name from marque where marque.id=$1;
    select marque.pays into pays from marque where marque.id=$1;
        raise notice ' % [%]',name,pays;
        end;$$
language 'plpgsql';

/* test call show_marque_small(2); le resulatat est bien Volvo [Suede]*/


/*4.2.2*/

create or replace procedure show_marque(id int)
    as $$
    declare list text; voit record;i int;
    begin
    i := 1;
    for voit in select voiture.nom as nom,marque.nom as name, marque.pays as pays from voiture join marque on voiture.ref_marque=marque.id where marque.id=$1
    loop
        if i=1 then
            list := 'Marque : '|| voit.name || '[' || voit.pays || ']' || ' Voiture : ' ||voit.nom;
        else
            list := list || ',' || voit.nom;
        end if;
        i := i+1;
    end loop;
    raise notice '%',list;
    end;$$
language 'plpgsql';

/* test : call show_marque(2); on obtient alors Marque : Volvo[Suede] Voiture : XC90,XC60,S60,V90*/



/*4.3*/

create or replace function maj_marque()
    returns trigger as $$
    begin  
        raise notice 'nationalité %', new.pays;
    end;$$
language 'plpgsql';
        
        
create trigger maj_marque
    after insert
    on marque for each row
    execute procedure maj_marque();
    
/* test : insert into marque values (4,'BMW','Allemagne'); ça nous renvoie nationalité allemagne */
