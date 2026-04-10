#include <stdio.h>
#define TAILLE_MAX 30

void affichage(FILE* fic,int n){
    char nom[TAILLE_MAX];
    for(int i=0;i<n;i++){
        fscanf(fic,"%s",nom);
        printf("%s\n",nom);
    }
}


int main(){
    FILE* fic;
    int n;
    fic=fopen("echauffement.txt","r");
    printf("Saisir un nombre de personnes\n");
    scanf("%d",&n);
    if(fic!=NULL){
        affichage(fic,n);
        fclose(fic);
    }
    return 0;
}
    
