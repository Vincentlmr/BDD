#include <stdio.h>
#include <stdlib.h>
#include <pthread.h>
#define MAX 	10

int tab[MAX];
int nb=0;       //cumul des valeurs anormales (sup ou inf aux seuils)

pthread_mutex_t mutex ;

void lire() {
	int i;
	printf("saisir %d entiers\n", MAX);
	for (i=0; i<MAX ; i++) scanf("%d", &tab[i]);
}
void affiche(){
	int i;
	printf("entiers saisis :");
	for (i=0; i<MAX ; i++) printf("%d ",tab [i]);
	printf("\n");
}
void *moyenne(void *arg){
	int i, moy=tab[0];
	for (i=1; i<MAX; i++) moy = moy + tab[i];
	printf("moyenne des entiers = %f\n", (float)moy/MAX);
    return NULL;
}
void *supSeuil(void *arg){
	int i,seuil;
    seuil= *((int*)arg);
    
    free(arg);
    
	for (i=0; i<MAX; i++){ 
        
        if (tab[i]>seuil){
            pthread_mutex_lock(&mutex);
            nb++;
            pthread_mutex_unlock(&mutex);
        }
        
    }
	printf("fin de fonction supSeuil : nb = %d\n", nb);
    
    return NULL;
}
void *infSeuil(void *arg){
	int i,seuil;
    
    seuil= *((int*)arg);
    free(arg);
    
	for (i=0; i<MAX; i++){
        
        if (tab[i]<seuil){
            pthread_mutex_lock(&mutex);
            nb++;
            pthread_mutex_unlock(&mutex);
        }
        
    }
	printf("fin de fonction infSeuil : nb = %d\n", nb);
    
    return NULL;
    
}

void minMax(int *min, int *max) {
	int i;
	*min=tab[0];
	*max=tab[0];
	for (i=1; i<MAX; i++) {
	    if (tab[i]<*min) *min=tab[i];
	    else if (tab[i]>*max) *max=tab[i];
	}
}

int main(){
    
    
    
	int  min, max;
    int* seuilInf= (int*)malloc(sizeof(int));
    int* seuilSup= (int*)malloc(sizeof(int));
	lire();
	affiche();
	printf("saisir les seuils sup et inf : ");
	scanf("%d%d", seuilSup, seuilInf);
	
    pthread_mutex_init(&mutex, NULL);
    
	pthread_t tid1,tid2,tid3;
	pthread_attr_t attr;
	pthread_attr_init(&attr);
	pthread_attr_setdetachstate(&attr, PTHREAD_CREATE_DETACHED);
	pthread_create(&tid1,&attr,moyenne, NULL);
    pthread_create(&tid2,&attr,supSeuil, (void*)seuilSup);
    pthread_create(&tid3,&attr,infSeuil, (void*)seuilInf);
	
	
	minMax(&min, &max);
	printf("min = %d, max = %d\n", min, max);
	
	pthread_exit(NULL);
	
	return(0);
}
