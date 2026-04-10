#include <stdlib.h>
#include <stdio.h>
#include <unistd.h>
 
int main (){
    int fils1, fils2;
    int pid1, pid2;
    int ent;
    int S=7;
    int tube[2];
    
    if(pipe(tube)<0){
        perror("erreur ouverture pipe"); 
        exit(1);
    }
    
   
    
    fils1=fork();
    
    if(fils1<0){
        perror("erreur fork du fils1");
        exit(1);
    }
    
    if(fils1==0){
        if (close(tube[1]) <0) exit(1);
        printf("Donner une suite d'entiers qui se terminant par 0: \n");
        
        scanf("%d",&ent);
        while(ent != 0){
            if(ent%2==0){
                write(tube[1], &ent,sizeof(ent));
            }
            scanf("%d",&ent);
        }
        
        if (close(tube[1]) <0) exit(1);
    }else{fils2=fork();
        if(fils2<0){
            perror("erreur fork du fils2");
            exit(1);
        }
        if(fils2==0){
            if (close(tube[1]) <0) exit(1);
                
            while(read(tube[0],&ent,sizeof(ent))>0){
                if(ent>=S){
                    printf("%d",ent);
                    printf("\n");
                }
            }
            if (close(tube[1]) <0) exit(1);
        }else{
            printf("père\n");
            if (close(tube[1]) <0) exit(1);
               
            if (close(tube[1]) <0) exit(1);
               
            if ( (pid1 = wait(NULL)) <0) {
                perror ("erreur exécution de wait");
                exit(1) ;
            } 
            if ( (pid2 = wait(NULL)) <0) {
                perror ("erreur exécution de wait");
                exit(1) ;
            } 
                
            printf("Fin");
        }
    }
    return 0;
}
