  
var btn = document.querySelector('button');


btn.onclick = function(){
        continu = 1;
        bon =1;
        let randomNumber=0;
        let pari=0;
    
        let ini = prompt('Selectionner un solde initial',50);
        ini=parseInt(ini);
        alert('Vous avez un solde de '+ ini);
     while ((ini != 0) && continu==1){  
        bon=1;
        randomNumber = Math.floor(Math.random() * 20) + 1;
        pari = prompt('Selectionner un montant à parier',ini);
        pari=parseInt(pari);
        while(bon==1){
            if(pari > ini){
                bon=0;
                alert('Vous avez parié un montant supérieur à ' +ini);
            }else{
                alert('Vous avez parié '+ pari);
                
                let nbr = prompt('Choisir un nombre entre 1 et 20',20);
                nbr=parseInt(nbr);
                if(nbr<21){
                    if((nbr<randomNumber)||( nbr-randomNumber > 5)){
                        alert('Vous avez perdu le nombre aléatoire était:'+randomNumber);
                        ini=ini-pari;
                    }else{
                        alert('Vous avez gagné le nombre aléatoire était:'+randomNumber);
                        ini+= pari*2;
                    }
                    let continuer= prompt('Voulez vous continuer? Votre solde est de '+ ini,'OUI');
                    
                    if((continuer=='NON')||(continuer==null)){
                        alert('Merci d avoir jouer');
                        continu=0;
                        bon=0;
                    }
                    else{
                        continu=1;
                        bon=0;
                    }
                }else{
                    alert('Vous avez parié un nombre supérieur à 20');
                    bon=0;
                }
            }
        }
    }
    
    
}



