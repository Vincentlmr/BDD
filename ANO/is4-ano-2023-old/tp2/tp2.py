#!/bin/python3


from mpl_toolkits.mplot3d import axes3d
import matplotlib.pyplot as plt

import autograd as ag
import autograd.numpy as np

def f (a,b):
    return a**3*b - 3*a**2*(b - 1) + b**2 - 1

def g (a,b):
    return a**2*b**2 - 2

def Jac (a,b) :
    return np.array ([[3*a**2*b-6*a*(b-1), a**3-3*a**2+2*b], [2*a*b**2,2*a**2*b]], dtype=np.float64)


# Question 1

# Calculés avec Maple
abscisses = [-1.896238074, -0.4638513741, 1.568995999]
ordonnees = [0.6844390650, -0.8460057970, -0.4658228710]

a_min, a_max = -3, 3
b_min, b_max = -3, 3

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

#for i in range (len(abscisses)) :
#    ax.scatter (abscisses[i], ordonnees[i], f(abscisses[i], ordonnees[i]), color='black')

#########################################################
# 2ème sous-graphe

#ax = fig.add_subplot(1, 2, 2, projection='3d')

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

#for i in range (len(abscisses)) :
#    ax.scatter (abscisses[i], ordonnees[i], g(abscisses[i], ordonnees[i]), color='black')

# plt.savefig ("../deux-variables-graphe.png")

plt.show()

###################################Question_2############################################



print()
print("On cherche les points d'intersection des courbes de niveau ")
print("Graphiquement on constate 2 racines :")
print('r1','=',np.array([-0.8, 2]), 'et','r2','=', np.array([-2.9,0.5]))


###################################Question_3############################################
print()
print("Calcul des 0 avec Newton")

def F (a,b) :

    return np.array ( [f(a,b),g(a,b)])

def Jac_F (a,b):
    return Jac(a,b)


print()
print(' Pour la 1ere racine :')
a1=-0.8
b1=2

u1 = np.array([a1, b1], dtype=np.float64)

for n in range (8):
    print('u[%d] =' % n, u1)
    h=np.linalg.solve(- Jac_F(u1[0],u1[1]),F(u1[0],u1[1]))
    u1 = u1+h
    
    
print()
print(' Pour la 2nd racine :')

a2=-2.9
b2=0.5

u2 = np.array([a2, b2], dtype=np.float64)
    
for n in range (8):
    print('u[%d] =' % n, u2)
    h=np.linalg.solve(- Jac_F(u2[0],u2[1]),F(u2[0],u2[1]))
    u2 = u2+h

print()
print("On à donc les racines précise:")
print("r1", "=", u2, "et" , "r2", "=", u1)

###################################Question_4############################################

print()
print("Calcul des 0 avec Newton avec autograd")


def F2 (u) :
    a = u[0]
    b = u[1]
    return np.array ( [f(a,b),g(a,b)])

u1=np.array([-0.8,2], dtype=np.float64)
print()
print(' Pour la 1ere racine :')


for n in range (8):
    print('u[%d] =' % n, u1)
    h=np.linalg.solve(- ag.jacobian(F2)(u1),F2(u1))
    u1 = u1+h


    
print()
print(' Pour la 2nd racine :')
u2=np.array([-2.9,0.5], dtype=np.float64)

    
for n in range (8):
    print('u[%d] =' % n, u2)
    h=np.linalg.solve(- ag.jacobian(F2)(u2),F2(u2))
    u2 = u2+h

print()
print("On à donc les racines précise avec autograd :")
print("r1", "=", u2, "et" , "r2", "=", u1)


print()
print("On retrouve bien la même chose")


###################################Question_5############################################

def F3(u) :
    a = u[0]
    b = u[1]
    # Pour f(a,b)
    t1 = a ** 2
    t2 = b ** 2
    t3 = (a*b - 3*b + 3)*t1 + t2 - 1
    # Pour g(a,b)
    t1 = a ** 2
    t2 = b ** 2
    t4 = t1 * t2 - 2
    # Résultat
    return np.array ([t3, t4])

def Jac_F3(u):
    a, b = u[0], u[1]
    
    # Partielle de f(a,b) par rapport à a et b
    
    dt1_da=2*a
    dt1_db=0
    
    dt2_da=0 
    dt2_db=2*b 
    
    dt3_da=(b)*dt1_da+dt2_da
    dt3_db=(a-3)*dt1_db+dt2_db
    
    # Partielle de g(a,b) par rapport à a et b
    
    dt1_da=2*a
    dt1_db=0
    
    dt2_da=0 
    dt2_db=2*b 
    
    dt4_da=dt1_da*dt2_da
    dt4_db=dt1_db*dt2_db
    # Partielle de f(a,b) par rapport à a et b

    return np.array([[dt3_da, dt3_db],[dt4_da, dt4_db]], dtype=np.float64)

u1=np.array([-0.8,2], dtype=np.float64)
u2=np.array([-2.9,0.5], dtype=np.float64)
print()
print("Calcul des 0 avec Newton  avec la methode forward")

print()
print(' Pour la 1ere racine :')

for n in range(8):
    print('u[%d] =' % n, u1)
    h = np.linalg.solve(-Jac_F3(u1), F2(u1))
    u1 = u1 + h

print()
print(' Pour la 2nd racine :')

for n in range(8):
    print('u[%d] =' % n, u2)
    h = np.linalg.solve(-Jac_F3(u2), F2(u2))
    u2 = u2 + h

print()
print("On a donc les racines précises avec la méthode Forward :")
print("r1", "=", u2, "et", "r2", "=", u1)


    
