#Exercice 1

x <-rnorm(1000)

f <-function(x){
  return(2*x/(3-2*x))
}

y<- sapply(x,f)
hist(y,50, freq =F)

f2 <- function(x){
  return(1/(1+x)^2)
}

curve(f2, add=T)

#Exercice 2 -> tp?

#Exercice 3

f3 <-function(x){return(exp(x))}

x <- runif(0,1)
y <- runif(0,(exp(1)/(exp(1)-1)))

while(i<x){
  if(f(x)>=y){}
  else{}
}

