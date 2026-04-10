#include<stdio.h>

int addition(int operande1, int operande2){
	return operande1 + operande2;
}

int soustraction(int operande1, int operande2){
	return operande1 - operande2;
}

int produit(int operande1, int operande2){
	return operande1 * operande2;
}

int division(int operande1, int operande2){
	return operande1 / operande2;
}

int main(){
	int a,b;
	
	printf("Entrer deux entiers :\n");
	scanf("%d%d",&a,&b);
	
	printf("La somme de %d et %d est : %d\n", a, b, addition(a,b));
	printf("La différence de %d et %d est : %d\n", a, b, soustraction(a,b));
	printf("Le produit de %d par %d est : %d\n", a, b, produit(a,b));
	printf("La division de %d a par %d a pour quotient : %d\n", a, b, division(a,b));
	
	return 0;
}
