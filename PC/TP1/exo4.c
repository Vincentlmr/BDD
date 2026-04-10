#include <stdio.h>
#include <unistd.h>
#include <sys/wait.h>
#include <stdlib.h>

int main(){
    pid_t cr1;
    pid_t cr2;
    
    if ( (cr1=fork()) < 0) {
        perror("erreur exécution de fork");
        exit(1);
    }
    
    if (cr1 == 0) {
        //Fils 1
        sleep(2);
        printf("dans le premier fils \n");
        printf("PID fils n°1 : %d\n", getpid());
        printf("PPID fils n°1 : %d\n", getppid());
        sleep(4);
    }
    else {
        //Père
        pid_t pid;
        printf("dans le père \n");
        printf("PID père : %d\n", getpid());
        printf("PPID père : %d\n", getppid());
        
          //Création new son
        if ( (cr2=fork()) < 0) {
            perror("erreur exécution de fork");
            exit(1);
        }
        if (cr2 == 0) {
            sleep(4);
            printf("dans le second fils \n");
            printf("PID fils n°2 : %d\n", getpid());
            printf("PPID fils n°2 : %d\n", getppid());
            sleep(2);
        }
        else{
            if ( (pid = wait(NULL)) <0) {
                perror ("erreur exécution de wait");
                exit(1) ;
        }
            printf("fin proc père, pid du fils mort = %d\n", pid);
            if ( (pid = wait(NULL)) <0) {
                perror ("erreur exécution de wait");
                exit(1) ;
            }
            printf("fin proc père, pid du fils mort = %d\n", pid);
        }
    }
    
    return 0 ;
}
