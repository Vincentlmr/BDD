#include <stdio.h>
#include <unistd.h>
#include <stdlib.h>
#include <sys/wait.h>
int main(){
	int fils1, fils2, pid;
	int elt, S;
	int tube[2];
	
	if ( pipe(tube) < 0) {
		perror("erreur ouverture pipe");
		exit(1);
	}
	
	printf("Seuil d'affichage : ");
	scanf("%d", &S);
	
	if ( (fils1=fork()) < 0) {
		perror("erreur exécution de fork");
		exit(1);
	}
	if (fils1 == 0) {
		if(close(tube[0])<0) exit(1);//fils1 ne lit pas
		printf("Veuillez saisir une liste d'entiers terminant par 0 : ");
		scanf("%d", &elt);
		while(elt != 0){
			if(elt%2 == 0){
				if(write(tube[1], &elt, sizeof(int)) < 0) exit(1);
			}
			scanf("%d", &elt);
		}
		printf("\n");
		if(close(tube[1])<0) exit(1);//fils1 n'écrit plus

		if ( (fils2=fork()) < 0) {
			perror("erreur exécution de fork");
			exit(1);
		}
		if (fils2 == 0) {
			if(close(tube[1])<0) exit(1);//fils2 n'écrit pas

			while(read(tube[0], &elt, sizeof(int)) > 0){
				if (elt >= S){
					printf("%d ", elt);
				}
			}
			printf("\n");
			if(close(tube[0])<0) exit(1);//fils2 ne lit plus
			
		}else {
			if(close(tube[0])<0) exit(1);//Le père ne lit pas
			if(close(tube[1])<0) exit(1);//Le père n'écrit pas
		
			if ( (pid = wait(NULL)) <0) {
				perror ("erreur exécution de wait");
				exit(1) ;
			}
			if ( (pid = wait(NULL)) <0) {
				perror ("erreur exécution de wait");
				exit(1) ;
			}
			printf("Fin de l'éxécution");
		}
	}
	
}
