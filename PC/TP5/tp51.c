#include <stdio.h>
#include <stdlib.h>
#include <pthread.h>
#include <unistd.h>

#define NBOP 10
#define MAX 1000
#define RETRAIT 0
#define AJOUT 1


int solde=MAX;

pthread_mutex_t mutex ;

struct operationVar{
    int num;
    int op;
    int mont;
};

void *operation (void *arg) {
    int numero,oper,montant;
    numero=((struct operationVar*)arg)->num;
    oper=((struct operationVar*)arg)->op;
    montant=((struct operationVar*)arg)->mont;
    
    free((struct operationVar*)arg);
    
    printf("operation n° %d, op=%d, montant=%d\n",numero, oper, montant);
    
    
    if (oper == RETRAIT) {
        pthread_mutex_lock(&mutex);
        if (solde>=montant){
            solde -= montant;
            pthread_mutex_unlock(&mutex);
            printf("nouveau solde après retrait : %d\n\n",solde);
        }
        else{
            pthread_mutex_unlock(&mutex);
            printf("solde %d insuffisant pour effectuer un retrait de %d\n\n", solde, montant);
        }
    }
    else {
        pthread_mutex_lock(&mutex);
        solde += montant;
        pthread_mutex_unlock(&mutex);
        printf("nouveau solde après ajout : %d\n\n",solde);
    }
    return NULL;
}

int main(){
    int i;
    
    struct operationVar *varOperation;
    
    pthread_mutex_init(&mutex, NULL);
	
	pthread_t tid;
    
	pthread_attr_t attr;
	pthread_attr_init(&attr);
	pthread_attr_setdetachstate(&attr, PTHREAD_CREATE_DETACHED);
    

    srand(time(NULL));
    for (i=1; i<=NBOP; i++) {
        varOperation = (struct operationVar*)malloc(sizeof(struct operationVar));
        varOperation->num=i;
        varOperation->op=rand()%2;
        varOperation->mont=rand()%MAX;
        pthread_create(&tid,&attr,operation, (void*)varOperation);
    }
    
    pthread_exit(NULL);
    return 0;
}
