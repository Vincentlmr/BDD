#!/bin/python3

import numpy as np
from mpl_toolkits.mplot3d import axes3d
import matplotlib.pyplot as plt

def f (a,b):
    return a**2 + 2*a*b - 1

def g (a,b):
    return a**2*b**2 - b - 1

def Jac (a,b) :
    return np.array ([[2*a+2*b, 2*a], [2*a*b**2, 2*a**2*b-1]], dtype=np.float64)

# Calculés avec Maple
abscisses = [-1.896238074, -0.4638513741, 1.568995999]
ordonnees = [0.6844390650, -0.8460057970, -0.4658228710]

a_min, a_max = -2, 1.7
b_min, b_max = -1.5, 0.8

fig = plt.figure(figsize = (20,10))
ax = fig.add_subplot(1, 2, 1, projection='3d')

ax.set_xlabel('$a$', labelpad=20)
ax.set_ylabel('$b$', labelpad=20)
ax.set_zlabel('$f(a,b)$', labelpad=20)

aplot = np.arange (a_min, a_max, 0.1)
bplot = np.arange (b_min, b_max, 0.1)

A, B = np.meshgrid (aplot, bplot)
Z = f(A,B)

ax.plot_surface(A, B, Z, cmap="spring_r", lw=0.5, rstride=1, cstride=1, alpha=0.5)
ax.contour(A, B, Z, 10, colors="k", linestyles="dashed")
ax.contour(A, B, Z, 0, colors="blue",  levels=np.array([0], dtype=np.float64), linestyles="solid")

for i in range (len(abscisses)) :
    ax.scatter (abscisses[i], ordonnees[i], f(abscisses[i], ordonnees[i]), color='black')

#########################################################
# 2ème sous-graphe

ax = fig.add_subplot(1, 2, 2, projection='3d')

ax.set_xlabel('$a$', labelpad=20)
ax.set_ylabel('$b$', labelpad=20)
ax.set_zlabel('$g(a,b)$', labelpad=20)

aplot = np.arange (a_min, a_max, 0.1)
bplot = np.arange (b_min, b_max, 0.1)

A, B = np.meshgrid (aplot, bplot)
Z = g(A,B)

ax.plot_surface(A, B, Z, cmap="autumn_r", lw=0.5, rstride=1, cstride=1, alpha=0.5)
ax.contour(A, B, Z, 10, colors="k", linestyles="dashed")
ax.contour(A, B, Z, 0, colors="green",  levels=np.array([0], dtype=np.float64), linestyles="solid")

for i in range (len(abscisses)) :
    ax.scatter (abscisses[i], ordonnees[i], g(abscisses[i], ordonnees[i]), color='black')

# plt.savefig ("../deux-variables-graphe.png")

plt.show()


