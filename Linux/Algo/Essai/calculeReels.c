#include<stdio.h>

float addition(float operande1, float operande2){
	return operande1 + operande2;
}

float soustraction(float operande1, float operande2){
	return operande1 - operande2;
}

float produit(float operande1, float operande2){
	return operande1 * operande2;
}

float division(float operande1, float operande2){
	return operande1 / operande2;
}

float main(){
	float a,b;
	
	prfloatf("Entrer deux flotants:\n");
	scanf("%f%f",&a,&b);
	
	prfloatf("La somme de %f et %f est : %f\n", a, b, addition(a,b));
	prfloatf("La différence de %f et %f est : %f\n", a, b, soustraction(a,b));
	prfloatf("Le produit de %f par %f est : %f\n", a, b, produit(a,b));
	prfloatf("La division de %f a par %f a pour quotient : %f\n", a, b, division(a,b));
	
	return 0;
}
