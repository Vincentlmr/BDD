#include <stdlib.h>
#include <stdio.h>
#include <unistd.h>
 
int main(int argc, char *argv[]) {
    int cr1, cr2;
    
    int n1, n2;
    n1 = atoi(argv[1]); /* la fonction atoi convertit une chaîne de caractères en entier */
    n2 = atoi(argv[2]);
 
    cr1=fork();

 
    if(cr1 <0){
        perror("Erreur creation PID fils");
        exit(1);
    }
 
    if(cr1 == 0){
        system ("gcc -o somme somme.c")
        system ("./somme %d,%d",n1,n2);
        
    }
    else{cr2=fork();
        if(cr2 <0){
            perror("Erreur creation PID fils 2");
            exit(1);
        }
        if(cr2 == 0){
            
            system ("gcc -o produit produit.c");
            system ("./produit %d,%d",n1,n2);
            
            
        }else{ 
            int pid1,pid2;
            if ( (pid1 = wait(NULL)) <0) {
                perror ("erreur exécution de wait");
                exit(1) ;
            }else{
                printf(" prout effectué\n ");
            }
            if ( (pid2 = wait(NULL)) <0) {
                perror ("erreur exécution de wait\n");
                exit(1) ;
            }else{
                printf(" Produit effectué\n ");
            }
        }
    }
 

 
    return 0;
}
