#!/bin/python3

import math
import numpy as np
from mpl_toolkits.mplot3d import axes3d
import matplotlib.pyplot as plt

def f (a,b) :
    return a**3 + 2*a**2 - 2*a*b + b**2 + a - 2*b + 2

def nabla_f (a,b) :
    return np.array ([3*a**2+4*a-2*b+1, -2*a+2*b-2])

def c (a,b) : 
    return a**2 + b**2 - 1

def nabla_c (a, b) :
    return np.array ([2*a, 2*b])

# Tracé de z = f(a,b)
fig = plt.figure(figsize = (20,20))
ax = plt.axes(projection='3d')

ax.set_xlabel('$a$', labelpad=20)
ax.set_ylabel('$b$', labelpad=20)
ax.set_zlabel('$f(a,b)$', labelpad=20)

xplot = np.arange (-1, 2, 0.05)
yplot = np.arange (-1, 2, 0.05)

zlb = 0
zub = 8

X, Y = np.meshgrid (xplot, yplot)
Z = f(X,Y)
Z = np.clip (Z, zlb, zub)

ax.plot_surface(X, Y, Z, cmap="spring_r", lw=0.5, rstride=1, cstride=1, alpha=0.5)
ax.contour(X, Y, Z, 10, colors="k", linestyles="dotted")

ax.scatter (1/3, 4/3, f(1/3, 4/3), color='black')

# Tracé de la contrainte

def c (a,b) :
    return a**2 + b**2 - 1

# Pour éviter que le tracé de la contrainte perturbe le tracé du graphe de f
zmin = np.amin (Z)
zmax = np.amax (Z)
ax.set_zlim3d (zmin, zmax)

# On définit le graphe de la contrainte comme une courbe de niveau
# dans le plan horizontal
Z = c(X,Y)
C = ax.contour(X, Y, Z, [0])
# On trace la courbe 3D des points du graphe de f qui satisfont la contrainte
for ii, seg in enumerate(C.allsegs[0]) :
    z = f (seg[:,0],seg[:,1])
    z = np.clip (z, zmin, zmax)
    ax.plot (seg[:,0], seg[:,1], z, color='green')

def Lagrangien (a,b,lmbda) :
    return f(a,b) + lmbda*c(a,b)

def nabla_Lagrangien (a,b,lmbda) :
    return np.array ([2*lmbda*a+3*a**2+4*a-2*b+1, 
                      2*lmbda*b-2*a+2*b-2, 
                      a**2+b**2-1])

def Hessian_Lagrangien (a,b,lmbda) :
    return np.array ([[2*lmbda+6*a+4,        -2, 2*a], 
                      [           -2, 2*lmbda+2, 2*b], 
                      [          2*a,       2*b, 0]])

# Le minimum local - calcul
# print ('------------------ Newton ------------------')
# Celle-ci converge vers un autre point stationnaire
u = np.array ([-1.7, 1.7, 0])
# Celle-ci converge vers le minimum local
u = np.array ([0.4, 1.5, 0])
for i in range (6) :
    a, b, lmbda = u
    z = Lagrangien (a, b, lmbda)
#     print ('u[%d] =' % i, u, 'f(u[%d]) =' % i, z)
    H = Hessian_Lagrangien(a,b,lmbda)
    g = nabla_Lagrangien(a,b,lmbda)
    h = np.linalg.solve (- H, g)
    u = u + h
    grad_f = nabla_f (a,b)
    grad_c = nabla_c (a,b)
    grad_f = (1/np.linalg.norm(grad_f,2)) * grad_f
    grad_c = (1/np.linalg.norm(grad_c,2)) * grad_c
#     print ('    nabla f normalisé =', grad_f)
#     print ('    nabla c normalisé =', grad_c)
#     print ('    valeur de la contrainte =', c(a,b))

# Le minimum local - tracé
# u[5] = [0.19227751 0.98134059 0.21494771] f(u[5]) = 3.896296136640436
print ('u[%d] =' % i, u, 'f(u[%d]) =' % i, z)
ax.scatter (a, b, f(a,b), color='blue')
ax.scatter (a, b, 0, color='blue')
ax.quiver (a, b, 0, 0, 0, f(a,b), color='black', linestyle='dotted', arrow_length_ratio=0)

# Différents gradients
gamma = .3
grad_f = nabla_f (a,b)
grad_c = nabla_c (a,b)
grad_f = (1.25*gamma/np.linalg.norm(grad_f,2)) * grad_f
grad_c = (gamma/np.linalg.norm(grad_c,2)) * grad_c

ax.quiver (a, b, 0, -grad_f[0], -grad_f[1], 0, color='blue')
ax.quiver (a, b, 0, grad_c[0], grad_c[1], 0, color='red')

n = 6
for i in range (n) :
    theta = np.pi / 5 + (i + 1) * 2*np.pi / (n - 1)
    a = np.cos (theta)
    b = np.sin (theta)
    grad_f = nabla_f (a,b)
    grad_c = nabla_c (a,b)
    grad_f = (1.25*gamma/np.linalg.norm(grad_f,2)) * grad_f
    grad_c = (gamma/np.linalg.norm(grad_c,2)) * grad_c
    ax.quiver (a, b, 0, -grad_f[0], -grad_f[1], 0, color='blue')
    ax.quiver (a, b, 0, grad_c[0], grad_c[1], 0, color='red')

plt.show ()

