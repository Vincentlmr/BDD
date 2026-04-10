#include <stdlib.h>
#include <stdio.h>
#include <unistd.h>
 
int main (void){
    int cr;
    char nom_fich[100];
    
    printf("Entrez le nom du fichier : ");
    scanf("%s", nom_fich);
        
    cr=fork();

 
    if(cr <0){
        perror("Erreur creation PID fils");
        exit(1);
    }
 
    if(cr == 0){
        printf("lancement de la commande wc\n");
        if (execlp("wc","wc", "-l",nom_fich, NULL) == -1) {
            perror("echec execlp");
            exit(1);
        }
        
    }else{ 
        int pid1;
        
        
        
        if ( (pid1 = wait(NULL)) <0) {
            perror ("erreur exécution de wait");
            exit(1) ;
        } 
    } 

 
    return 0;
}
