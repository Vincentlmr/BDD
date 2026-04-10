

    II)
        create or replace function affiche_affectation(nemp text)
            returns int
        as $$
            declare lst text; pourc record;i int;
            begin
                i:=1;
                for pourc in select pourcent from affectation where affectation.nemp='$1'
                loop
                    if not found then
                        raise exception 'numéro % existe pas',affectation.nemp;
                    end if;
                    if i=1 then
                        lst := pourc.pourcent;
                    else
                        lst := lst || ',' || pourc.pourcent;
                    end if;
                    i := i +1;                        
                end loop;
                return lst;
                end;
            $$
            language 'plpgsql';
            
            create or replace function affiche_affectation(nemp text)
            returns text
        as $$
            declare pourc record;nom text;prenom text;temps int;
            begin
                select prenomemp into prenom from employe where employe.nemp='$1';
                select nomemp into nom from employe  where employe.nemp='$1';
                select temps into temps from employe  where employe.nemp='$1';
                raise notice 'employé %',nemp;
                raise notice '% %',nom,prenom;
                raise notice 'travail à %',temps;
                for pourc in select pourcent from affectation where affectation.nemp='$1'
                loop
                     if not found then
                    raise exception 'employé numéro % existe pas',nemp;
                end if;
                    raise notice '%',pourc;
                    
                end loop;
                end;
            $$
            language 'plpgsql';
