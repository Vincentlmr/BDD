#!/usr/bin/env python3
# -*- coding: utf-8 -*-
"""
Created on Fri Oct 21 16:16:20 2022

@author: vlemeur
"""

import matplotlib.pyplot as plt
import numpy as np
import math
x=np.float64()

#-------------------------Fonctionf------------------------------------------#
def f(x):
    return(2/((x/2-1/2)**2+1)+4*x**3*(50*x-121))


#---------------------Fonction_trapèze----------------------------------------#


def trapeze(f,a,b,n,):
    h=(b-a)/n
    S=(0.5*(f(a)+f(b)))
    for i in range(1,n):
        x=a+i*h
        y=f(x)
        S+=y
        
    return S*h
        
print(trapeze(f,1,3,25355))

erreur = math.pi - trapeze(f,1,3,25355);
nb_decimales_exactes= -math.log10(abs(erreur))
print(erreur)
print(nb_decimales_exactes)



#----------------------------------------------------------------------------#

xplot = np.array ([k for k in range (2,13)])
yplot = np.empty (xplot.shape[0], dtype=np.float64)

for i in range (0,xplot.shape[0]) :
    n = 2**xplot[i]
    yplot[i] = - math.log2 (abs(trapeze(f,1,3,n)-math.pi))
    
    
droite_regression_lineaire = np.polynomial.polynomial.polyfit(xplot, yplot, 1)
pente = droite_regression_lineaire[1]
pente = np.around (pente, 2)


plt.xlabel ("logarithme en base 2 du nombre de pas")
plt.ylabel ("nombre de bits exacts")
plt.scatter (xplot, yplot,label="méthode des trapèzes: pente = " + str(pente),color="blue")
plt.plot(xplot, yplot)
plt.legend ()
plt.show ()




#-----------------------------------------------------------------------------#

def simpson(f,a,b,n):
    h=(b-a)/n
    S=f(a)+f(b)
    for i in range(1,n,2):
        x=a+i*h
        y=f(x)
        S+=4*y
        
    for i in range(2,n-1,2):
        x=a+i*h
        y=f(x)
        S+=2*y
    return((h/3)*S)
    
print(simpson(f,1,3,25345454554555))
    