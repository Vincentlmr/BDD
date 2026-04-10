x<-c(-7,84,19)
y<-c(x,1,3)
z<-c(1:10,x,y)

M<-diag(1:8)
N<-diag(rep(1,10))

#Exercice 1

vec<-(4:13)
sum(vec)
mean(vec)
median(vec)
var(vec)
sd(vec)
max(vec)
min(vec)
length(vec)
pmax(vec)
which.max(vec)
which.min(vec)
cumsum(vec)
cumprod(vec)

#Exercice 2

sum(1/(c(1:1000))^2)
sum(1/(c(1:100))^2)
sum(1/(c(1:10))^2)
#la valeur théorique de cette série est pi²/2

X<-(c(1:10))^2
mean(X)
var(X)


#EXERCICE 3

A=rbind(c(3,2,1),c(2,3,1),c(1,2,3))
B=c(5,1,7)

solve(A,B)


#Exercice 4
n<-1000

f <- function(x){
  return(max(sin(10*(-pi+x*2*(pi/n))),0))
}
sum(sapply(c(1:n),f)*2*pi/n)
#la valeur exacte est de 2 

#Exercice 5

f2 <- function(n){
  return(exp(-pi)*(pi^n)/(factorial(n)))
}
f2(5)

poisson_proba <- function(pi){
  for (i in 1:n){
    proba=sum(f2(i))
  }
  return(1-proba)
}

poisson_proba(1)

#exercice 6

p<- 1/pi

f3<-function(n){
  return(p*(1-p)^(n-1))
}


geometrique_proba <- function(pi){
  for (i in 1:n){
    proba=sum(f3(i))
  }
  return(1-proba)
}

geometrique_proba(3)

#Exercice 7

comb <- function(n,p){
  return((factorial(n))/(factorial(p)*factorial(n-p)))
}

f4<- function(n){
    return(comb(8,p)*p^n*(1-p)^(8-n))
  }
binomial_proba <- function(pi){
  for (i in 1:n){
    proba=sum(f4(i))
  }
  return(1-proba)
}

binomial_proba(3)

#Exercice 8

#1
x<-rnorm(1000)

#2
h<-hist(x,freq = F)

#3
y<-dnorm(x)

h<-hist(x,freq= F)


#Exercice



f5 <-function(n){
  j<-1
  
  for(i in 0 : n-1){j<-((365-i)/365)}
  
  return(1-j)
  
}

f5(233)























