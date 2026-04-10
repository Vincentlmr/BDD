#!/usr/bin/env python3
# -*- coding: utf-8 -*-
"""
Created on Tue Oct 11 13:50:38 2022

@author: vlemeur
"""

import matplotlib.pyplot as plt
import numpy as np
from numpy.polynomial.polynomial import polyval

def eval_naive(x,A):
    n=A.shape[0]
    a=0
    for i in range(0,n):
        a+=A[i]*x**i
    return a

def eval_Horner(x,A):
    n=len(A)-1
    y=A[n]
    for i in range(n-1,-1,-1):
        y=y*x+A[i]
    return y

'''# On affecte à abscisses et ordonnees les coordonnées de 4 points
abscisses = np.array([2,7,3,1])
ordonnees = np.array([7,45,12,2])

plt.scatter(abscisses, ordonnees, color='blue', label='points expérimentaux')

# Définition de f
def f(x) :
    return(0.5*x+3.1)*x-1.05
# Les 50 points équidistants entre 0 et 8 s’obtiennent avec la fonction linspace de numpy

xplot = np.linspace (0, 8, 50)
yplot = np.array ([f(x) for x in xplot])
plt.plot (xplot, yplot, color='orange', label='graphe de f')



plt.legend ()
plt.show ()'''



'''A= np.array([-40,82,-35,-19,12], dtype=np.float64)


xplot= np.linspace(-2.5,2,50)
yplot= np.array([polyval(x,A) for x in xplot])
                
plt.plot(xplot,yplot,color='red', label='graphe de A(x)')

plt.axhline(y=0, xmin=-3, xmax=2)

plt.show()'''