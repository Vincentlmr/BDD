



III)
    1)select max(Idbus) from bus;
    
    2)create or replace function next_bus_id() 
        returns int as $$ 
            select max(Idbus)+1 from bus; $$ 
        language 'sql';

    
    3) create or replace function next_bus_id() 
        returns int as $$ 
            declare id int;
                begin  select max(Idbus)+1 into id from bus;
                return id; 
                end; 
        $$ 
        language 'plpgsql';
        
    4) create or replace function nb_stations(int) 
        returns int as $$
            declare nb int;
                begin select count(Idstation) into nb from station natural join passe where Idbus=$1 ;
                return nb;
                end;
        $$
        language 'plpgsql';
        
    5) create or replace function liste_bus(int)
        returns text as $$
            declare lst text; bubus record;i int;
            begin
            i :=1;
                for bubus in select Nombus from bus natural join passe where Idstation=$1
                loop
                    if i=1 then
                        lst := bubus.Nombus;
                    else
                        lst := lst || ',' || bubus.Nombus;
                    end if;
                    i := i +1;                        
                end loop;
                return lst;
                end;
            $$
            language 'plpgsql';
            
IV)
    1)create or replace procedure ajouter_bus(nom text, id int)
        as $$
            begin
                insert into bus values(id,nom);
            end;
        $$
        language 'plpgsql';
    
    2)create or replace procedure ajouter_bus(nom text)
        as $$
        declare maxx int;
            begin
            select max(Idbus)+1 into maxx from bus;
                insert into bus values(maxx,nom);
            end;
        $$
        language 'plpgsql';
        
    3) create or replace procedure ajouter_bus(nom text)
        as $$
        declare maxx int;
            begin
                perform Nombus from bus where Nombus=nom;
                if not found then 
                    select max(Idbus)+1 into maxx from bus;
                    insert into bus values(maxx,nom);
                else
                    raise exception 'nom % existe déja',nom;
                end if;
                
            end;
        $$
        language 'plpgsql';
        
V)   1) create trigger maj_bus
            after update or insert 
            on bus for each row
            execute procedure maj_bus();

            
        create or replace function maj_bus()
        returns trigger as
        $$
            begin
                select length(new.nombus) as nb;
                raise notice 'le bus s appelle : % et à % caractères',new.nombus,nb;
            end;
        $$
        language 'plpgsql';
    
