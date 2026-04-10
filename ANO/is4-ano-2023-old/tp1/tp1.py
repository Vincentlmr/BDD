#!/usr/bin/env python3
# -*- coding: utf-8 -*-
"""
Created on Fri Nov 17 16:13:07 2023

@author: vlemeur
"""


import scipy.linalg as nla
import matplotlib.pyplot as plt
import autograd as ag
import autograd.numpy as np


print("1 MOINDRES CARRES LINEAIRES")
print("")

alpha, beta, gamma, mu = 0.5, -2, 1, 7

def f(x):
    return (alpha*(x**3))+(beta*(x)**2)+(gamma*x)+mu

m = 4

Tx = np.array ([-1.1, 0.17, 1.22, -.5, 2.02, 1.81])
p = Tx.shape[0]
Ty_sur_la_courbe = np.array ([f(x) for x in Tx])
perturbations = 0.5*np.array ([-1.3, 2.7, -5, 0, 1.4, 6])
Ty_experimentaux = Ty_sur_la_courbe + perturbations

print("Question 1.")
print("")

erreur_initiale = np.linalg.norm(Ty_sur_la_courbe - Ty_experimentaux, 2)

print("Erreur initiale :", erreur_initiale)

xplot = np.linspace(-1.2, 2.1, 100)
yplot = f(xplot)

# Courbe initiale
plt.plot(xplot, yplot , color="green", label='Courbe initiale')

# Tracer les points expérimentaux en bleu
plt.scatter(Tx, Ty_experimentaux, color='blue', label='Points expérimentaux')



#Système d'équation Ax=b

b=Ty_experimentaux
A=np.array([[x**3,x**2,x,1] for x in Tx], dtype=np.float64)

print("")
#Factorisation QR réduite de A

Q1,R1=nla.qr(A, mode='economic')
Q1Tb=np.dot(np.transpose(Q1),b)

x_optimal= nla.solve_triangular(R1,Q1Tb, lower=False)
print("x_ptimal :", x_optimal)

print("")

alpha2, beta2, gamma2, mu2 =x_optimal

print("On retrouve donc les valeurs:")
print("alpha :",alpha2,"beta :", beta2,"gamma :", gamma2,"mu :", mu2)

def f2(x):
    return (alpha2*(x**3))+(beta2*(x)**2)+(gamma2*x)+mu2

Ty_sur_la_courbe2 = np.array ([f2(x) for x in Tx])

erreur_minimale = np.linalg.norm(Ty_sur_la_courbe2 - Ty_experimentaux,2)
print("")

print("l'erreur minimale est de :",erreur_minimale)

print("erreur_minimale < erreur_initiale =", erreur_minimale<erreur_initiale)

# Courbe optimale
yplot2=np.array([f2(x)for x in xplot])
plt.plot(xplot, yplot2 , color="orange", label='Courbe optimale')

#affichage de la courbe
plt.xlabel('Valeurs de x')
plt.ylabel('Valeurs de Ty')
plt.legend()

plt.show()

print("")
print("")

print("2 METHODE DE NEWTON EN UNE VARIABLE")
print("")
print("Question 2.")
print("")
print("Premiers termes d'une suite (un) qui tende vers racine cude de 2 :")

def f3(x):
    return x**3-2

def f3prime(x):
    return 3*x

u=2

for n in range(0,6):
    print('u[%d] ='% n ,u)
    u=u-f3(u)/f3prime(u)

print("")
print("Question 3.")
print("")

def f2prime(x):
    return 3*alpha2*x**2+2*beta2*x+gamma2

def f2seconde(x):
    return 6*alpha2*x+2*beta2

u=0.8

print("Premier termes de la suite qui calcule le minimum local de la cubique optimale obtenue dans la section précédente:")
for n in range(0,6):
    print('u[%d] ='% n ,u)
    u=u-f2prime(u)/f2seconde(u)
    
print("")
print("Question 4.")
print("")

autof2prime=ag.grad(f2)
autof2seconde=ag.hessian(f2)

u=0.8
print("Premier termes de la suite en utilisant Autograd:")
for n in range(0, 6):
    print('u[%d] =' % n, u)
    u = u - autof2prime(u) / autof2seconde(u)


