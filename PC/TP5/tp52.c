#include <stdio.h>
#include <stdlib.h>
#include <pthread.h>
#include <unistd.h>


int main (){
    int fils1, fils2;
    int pid1, pid2;
    int ent;
    int tube1[2];
    int tube2[2];
    
    if(pipe(tube1)<0){
        perror("erreur ouverture pipe"); 
        exit(1);
    }
    if(pipe(tube2)<0){
        perror("erreur ouverture pipe"); 
        exit(1);
    }
    
    fils1=fork();
    
    if(fils1<0){
        perror("erreur fork du fils1");
        exit(1);
    }
    
    if(fils1==0){
        if (close(tube1[1]) <0) exit(1);

        read(tube2[0],&ent,sizeof(ent);
        if(ent>=0 && ent<50){
            write(tube1[1], &ent,sizeof(ent));
        }
        
        
        if (close(tube1[1]) <0) exit(1);
    }else{fils2=fork();
        if(fils2<0){
            perror("erreur fork du fils2");
            exit(1);
        }
        if(fils2==0){
            if (close(tube2[1]) <0) exit(1);
            
            
            read(tube2[0],&ent,sizeof(ent);
            if(ent>49){
                write(tube2[1], &ent,sizeof(ent));
            }
            
            if (close(tube[1]) <0) exit(1);
        }else{
            printf("père\n");
            if (close(tube1[1]) <0) exit(1);
               
            if (close(tube2[1]) <0) exit(1);
            
            
            pthread_mutex_init(&mutex, NULL);
	
            pthread_t tid1 , tid2;
            
            pthread_attr_t attr;
            pthread_attr_init(&attr);
            pthread_attr_setdetachstate(&attr, PTHREAD_CREATE_DETACHED);
            
            pthread_create(&tid1,&attr,lirePipe, NULL);
            pthread_create(&tid2,&attr,lirePipe, NULL);
               
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
    
    pthread_exit(NULL);
    return 0;
}
