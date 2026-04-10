#include <stdlib.h>
#include <stdio.h>
#include <unistd.h>
 
int main (void){
    int cr1, cr2;
 
    cr1=fork();

 
    if(cr1 <0){
        perror("Erreur creation PID fils");
        exit(1);
    }
 
    if(cr1 == 0){
        sleep(2);
        printf("fils1: PID: %d PPID: %d\n",getpid(), getppid());
        
    }
    else{cr2=fork();
        if(cr2 <0){
            perror("Erreur creation PID fils 2");
            exit(1);
        }
        if(cr2 == 0){
            sleep(4);
            printf("fils2: PID: %d PPID: %d\n",getpid(), getppid());
        }else{ 
            printf("père: PID: %d\n", getpid());
            int pid1,pid2;
            if ( (pid1 = wait(NULL)) <0) {
                perror ("erreur exécution de wait");
                exit(1) ;
            } 
            if ( (pid2 = wait(NULL)) <0) {
                perror ("erreur exécution de wait");
                exit(1) ;
            } 
        }
    }
 

 
    return 0;
}
