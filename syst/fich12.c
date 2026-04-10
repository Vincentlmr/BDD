#include <stdio.h>
#define TAILLE_MAX 30

void add_info(FILE* fic){
    char nom[TAILLE_MAX];
    char prenom[TAILLE_MAX];
    double moy;
    printf("Prenom de l'élève\n");
    scanf("%s",prenom);
    printf("Nom de l'élève\n");
    scanf("%s",nom);
    printf("Moyenne de l'élève\n");
    scanf("%lf",&moy);
    fprintf(fic,"%s \t %s \t %lf\n",nom,prenom,moy);
}


void affichage(FILE* fic, int n){
    char nom[TAILLE_MAX];
    char prenom[TAILLE_MAX];
    double moy;
    for(int i=0;i<n;i++){
        fscanf(fic,"%s %s %lf",nom,prenom,&moy);
        printf("%s %s %lf\n",nom,prenom,moy);
    }
}
    
double moy_classe(FILE* fic,int n){
    double moy;
    double som=0;
    for(int i=0;i<n;i++){
        fscanf(fic,"%*s %*s %lf",&moy);
        som=som+moy;
    }
    return som/n;
    
}
int main(){
    FILE* fic;
    int n;
    fic=fopen("base.txt","w");
    printf("Saisir le nombre d'élève à rentrer\n");
    scanf("%d",&n);
     if(fic!=NULL){
         for(int i=0;i<n;i++){
            add_info(fic);
         }
         
        fclose(fic);
    }
    fic=fopen("base.txt","r");
    if(fic!=NULL){
        affichage(fic,n);
    }
    fclose(fic);
    fic=fopen("base.txt","r");
    if(fic!=NULL){
        printf("%lf\n",moy_classe(fic,n));
    }
    fclose(fic);
        
    return 0;
}
    
