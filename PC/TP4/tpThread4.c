#include <stdio.h>
#include <stdlib.h>
#include <pthread.h>
#define MAX 	10

int tab[MAX];
int nb=0;       //cumul des valeurs anormales (sup ou inf aux seuils)

pthread_mutex_t mutex ;

struct bornes{
    int *min;
    int *max;
};

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
    seuil= *(int*)arg;
	for (i=0; i<MAX; i++){ 
        if (tab[i]>seuil){
            pthread_mutex_lock(&mutex);
            nb++;
            pthread_mutex_unlock(&mutex);
        }
    }
    return NULL;
}
void *infSeuil(void *arg){
	int i,seuil;
    seuil= *(int*)arg;
	for (i=0; i<MAX; i++){
        if (tab[i]<seuil){
            pthread_mutex_lock(&mutex);
            nb++;
            pthread_mutex_unlock(&mutex);
        }
    }
    return NULL;
}
void *minMax(void *arg) {
	int i;
    int *m = ((struct bornes*)arg)->min;
    int *M = ((struct bornes*)arg)->max;
	*m=tab[0];
	*M=tab[0];
	for (i=1; i<MAX; i++) {
	    if (tab[i]<*m) *m=tab[i];
	    else if (tab[i]>*M) *M=tab[i];
	}
	return NULL;
}

int main(){
    
    
	int  min, max, seuilInf,seuilSup;
    
    struct bornes borneMinMax;
    borneMinMax.min = &min;
    borneMinMax.max = &max;
    
    
	lire();
	affiche();
	printf("saisir les seuils sup et inf : ");
	scanf("%d%d", &seuilSup, &seuilInf);
    
    pthread_mutex_init(&mutex, NULL);
	
	pthread_t tid1,tid2,tid3,tid4;
    
	pthread_attr_t attr;
	pthread_attr_init(&attr);
	pthread_attr_setdetachstate(&attr, PTHREAD_CREATE_DETACHED);
    
	pthread_create(&tid1,&attr,moyenne, NULL);
    pthread_create(&tid2,NULL,supSeuil, (void*)&seuilSup);
    pthread_create(&tid3,NULL,infSeuil, (void*)&seuilInf);
    pthread_create(&tid4,NULL,minMax, (void*)&borneMinMax);
	
	
	pthread_join(tid4, NULL);
	printf("min = %d, max = %d\n", min, max);
    
    pthread_join(tid2, NULL);
    pthread_join(tid3, NULL);
    
    printf("fin du tread principal: nb = %d\n", nb);
	
	pthread_exit(NULL);
	
	return(0);
}
