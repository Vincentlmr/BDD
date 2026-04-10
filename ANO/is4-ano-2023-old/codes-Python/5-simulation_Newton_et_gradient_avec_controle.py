#!/bin/python3
  
import numpy as np

def f (a,b):
    return a**3 + 2*a**2 - 2*a*b + b**2 + a - 2*b + 5

def nabla_f (a,b) :
    return np.array ([3*a**2+4*a-2*b+1, -2*a+2*b-2], dtype=np.float64)

def H_f (a,b) :
    return np.array ([[6*a+4, -2], [-2, 2]], dtype=np.float64)

# Algorithme de contrôle du pas
def backtracking_line_search (u, alpha0, h) :
    rho = .5
    c = .5
    alpha = alpha0
    a = u[0]
    b = u[1]
    D_h = np.dot (nabla_f (a,b), h)
    while f(a + alpha*h[0], b + alpha*h[1]) > f(a,b) + c * alpha * D_h :
        alpha *= rho
    return alpha

print ('------------------ Newton ------------------')
a0 = -1/5
b0 = 1
u = np.array ([a0,b0], dtype=np.float64)
for i in range (6) :
    a, b = u
    z = f(a,b)
    H_f_u = H_f (a,b)
    nabla_f_u = nabla_f (a,b)
    h = np.linalg.solve (- H_f_u, nabla_f_u)
    alpha = backtracking_line_search (u, 1., h)
    print ('u[%d] =' % i, u, 'f(u[%d]) =' % i, z, 'alpha =', alpha)
    u = u + alpha*h

print ('------------------ Gradient ------------------')
u = np.array ([a0,b0], dtype=np.float64)
for i in range (6) :
    a, b = u
    z = f(a,b)
    h = - nabla_f (a,b)
    da = h[0]
    db = h[1]
    dz = - np.dot (h, h)
    gamma = np.sqrt (da**2 + db**2 + dz**2) * 10
    alpha = backtracking_line_search (u, .75, h)
    print ('u[%d] =' % i, u, 'f(u[%d]) =' % i, z, 'alpha =', alpha)
    u = u + alpha*h

