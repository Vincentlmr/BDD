#include <stdlib.h>
#include <stdio.h>
#include <unistd.h>

 
int main(int argc, char *argv[]) {
    int cr1, cr2;
   

    

    
 
    cr1=fork();

 
    if(cr1 <0){
        perror("Erreur creation PID fils");
        exit(1);
    }
 
    if(cr1 == 0){
        printf("lancement du programme somme\n");
        if (execlp("./somme","somme",argv[1],argv[2], NULL) <0) {
            perror("echec execlp");
            exit(1);
        }else{
            printf("%d",getpid());
        }
        
        
    }
    else{cr2=fork();
        if(cr2 <0){
            perror("Erreur creation PID fils 2");
            exit(1);
        }
        if(cr2 == 0){
            
            printf("lancement du programme produit\n");
            if (execlp("./produit","produit",argv[1],argv[2], NULL) <0) {
                perror("echec execlp");
                exit(1);
            }else{
                printf("%d",getpid());
            }
            
            
        }else{ 
            int pid1,pid2;
            
            if ( (pid1 = wait(NULL)) <0) {
                perror ("erreur exécution de wait");
                exit(1) ;
            }
            printf("%d \n",pid1);
            
            if ( (pid2 = wait(NULL)) <0) {
                perror ("erreur exécution de wait");
                exit(1) ;
            }
            printf("%d \n",pid2);
            
        }
    }
 

 
    return 0;
}
