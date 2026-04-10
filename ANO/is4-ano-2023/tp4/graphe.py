#!/bin/python3

import autograd as ag
import autograd.numpy as np
from mpl_toolkits.mplot3d import axes3d
import matplotlib.pyplot as plt

def f (a,b):
    return a**3 + 2*a**2 - 2*a*b + b**2 + a*b**3 - 2*b + 5

def nabla_f (a,b) :
    return np.array ([b**3 + 3*a**2 + 4*a - 2*b, 
                      3*a*b**2 - 2*a + 2*b - 2], dtype=np.float64)

def c (a,b) :
    return a**2 + b**2 - 1/2

def nabla_c(a,b):
    return np.array([a**2,b**2],dtype=np.float64)

fig = plt.figure(figsize = (20,20))
ax = plt.axes(projection='3d')

ax.set_xlabel('$a$', labelpad=20)
ax.set_ylabel('$b$', labelpad=20)
ax.set_zlabel('$f(a,b)$', labelpad=20)

# Bien garder les deux intervalles de même longueur pour
# que les vecteurs orthogonaux soient visuellement orthogonaux
aplot = np.arange (-.8, 1.2, 0.05)
bplot = np.arange (-.8, 1.2, 0.05)

# Le graphe de f
A, B = np.meshgrid (aplot, bplot)
Z = f(A,B)
Z = np.clip (Z, 3, 12)

# Pour éviter que le tracé (futur) de la contrainte perturbe le tracé du graphe de f
zmin = np.amin (Z)
zmax = np.amax (Z)
ax.set_zlim3d (zmin,  zmax)

# Le graphe et 30 courbes de niveau
ax.plot_surface(A, B, Z, cmap="spring_r", lw=0.5, rstride=1, cstride=1, alpha=0.5)
ax.contour(A, B, Z, 30, colors="k", linestyles="dotted")

# Le minimim local de f sans tenir compte de la contrainte
zero = np.array ([0.2255014396, 0.9318083312])
ax.scatter ([zero[0]], [zero[1]], [f(zero[0],zero[1])], color='black')

# Le graphe de la contrainte défini comme une courbe de niveau dans le plan horizontal
Z = c(A,B)
C = ax.contour(A, B, Z, [0])

# On retire cette courbe de niveau du graphique final


# On trace la courbe 3D des points du graphe de f qui satisfont la contrainte
for ii, seg in enumerate(C.allsegs[0]) :
    z = f (seg[:,0],seg[:,1])
    z = np.clip (z, zmin, zmax)
    ax.plot (seg[:,0], seg[:,1], z, color='green')



for b in [0.68,-0.5]:
    a=np.sqrt(.5-b**2)
    grad_c = nabla_c (a, b)
    coeff_c = .35 / np.linalg.norm(grad_c,2)
    grad_c = coeff_c * grad_c
# L'origine de la flèche est placée en (a, b, f(a,b))
    ax.quiver (a, b, c(a,b), grad_c[0], grad_c[1], 0, color='red')

    grad_f = nabla_f (a, b)
    coeff_f = .25 / np.linalg.norm(grad_f,2)
    grad_f = coeff_f * grad_f
# L'origine de la flèche est placée en (a, b, f(a,b))
    ax.quiver (a, b, f(a,b), grad_f[0], grad_f[1], 0, color='blue')

plt.show ()

