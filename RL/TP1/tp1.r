runif(1)
rexp(1)
x=rnorm(100)

hist(x)

x=rnorm(1000000)
hist(x, breaks=seq(-6,6,0.1))

set.seed(04042023)

# creation de vecteur:
x=c(2,3)

x= rep(0,10)
print (x)

x=rep(c(0,1), c(10,10))
print(x)

x=rep(c(0,1),10)
print(x)

x=seq(1,10,2)
print(x)

x=c(2,3,"A")
print(x)
######################################################################
#############################/*TP1*/##################################
#####################################################################

#Question 1
  
set.seed(1234)

#Question 2
x=rnorm(100,3,1)

summary(x)
hist(x)
#Question 3 
s2e=c(0.1,0.5,2,6)

e1=rnorm(100,0,sqrt(s2e[1]))
e2=rnorm(100,0,sqrt(s2e[2]))
e3=rnorm(100,0,sqrt(s2e[3]))
e4=rnorm(100,0,sqrt(s2e[4]))

y1=1+2*x+e1
y2=1+2*x+e2
y3=1+2*x+e3
y4=1+2*x+e4

plot(x,y1,main = paste("variance bruit =",s2e[1]))
plot(x,y2)
plot(x,y3)
plot(x,y4)

par(mfrow = c(2,2))

title("Evolution nuage de points", outer=TRUE, line=-1)

dev.off()

apply(y,2,function(z){plot(x,z)})


estim_lin=function(x,y){
  beta1ch= sum((x-mean(x))*(y-mean(y)))/sum(x-mean(x)^2)
  beta0ch= mean(y) - beta1ch*mean(x)
  sigma2_e = (1/(length(x)-2))*sum((y-beta0ch-beta1ch*x)^2)


return(list(beta0 = beta0ch, beta1 =beta1ch, s2e=sigma2_e))
}

res=estim_lin(x,y1)
res$beta0
m1=lm(y1~x)
m1$coefficients

d1=data.frame(Y=y1, X=x)
str(d1)
names(d1)
m1=lm(Y~X, data=d1)

dev.off()
plot(d1$X,d1$Y)
abline(m1,col="red",lwd=3,lty=2)

d4=data.frame(Y=y4, X=x)
str(d4)
names(d4)
m4=lm(Y~X, data=d4)

dev.off()
plot(d4$X,d4$Y)
abline(m4,col="red",lwd=3,lty=2)

cbind(d4$Y, m4$fitted.values, m4$residuals)
plot(x,m4$residuals)
aux =summary(m4)
str(aux)
aux$sigma

cor(d1$X, d1$Y)

cor(d4$X, d4$Y)


cov(d1$X, d1$Y) / (sqrt(d1$X) * sqrt(d1$Y))

xnew = c(2.5, 3.5, 4.5)
dnew = data.frame(X=xnew)

#Predictions avec le modèle 3 : 
pred1 =predict(m1, dnew, interval = "confidence")
print(pred1)

matplot(xnew, pred1, col = c("black", "blue", "red"), type="b", pch=16)

legend("topleft", c("valeur prédite", "borne inf (95%)", "borne sup (95%)"), col=c("black", "blue", "blue"), pch=c(16,16,16))

matplot(d1$X, predict(m1, interval="confidence"), col = c("red", "blue", "green"), type="p", pch=16)

legend("topleft", c("valeur prédite", "borne inf (95%)", "borne sup (95%)"), col=c("red", "blue", "green"), pch=c(16,16,16))
