
#---------------------------------TP2-----------------------------------------#

library(readxl)
debitmetrie <- read_excel("IS3/S6/RL/TP2/debitmetrie.xls")
View(debitmetrie)

str(debitmetrie)
summary(debitmetrie)

#1----------------------------------
summary(debitmetrie$fig)
summary(debitmetrie$fid)
summary(debitmetrie$fpg)
summary(debitmetrie$fpd)
summary(debitmetrie$tpg)
summary(debitmetrie$tpd)
summary(debitmetrie$carg)
summary(debitmetrie$card)

#2----------------------------------

cor(debitmetrie$resul,debitmetrie$fig, use="pairwise.complete.obs")
cor(debitmetrie$resul,debitmetrie$fid, use="pairwise.complete.obs")
cor(debitmetrie$resul,debitmetrie$fpg, use="pairwise.complete.obs")
cor(debitmetrie$resul,debitmetrie$fpd, use="pairwise.complete.obs")
cor(debitmetrie$resul,debitmetrie$tpg, use="pairwise.complete.obs")
cor(debitmetrie$resul,debitmetrie$tpd, use="pairwise.complete.obs")
cor(debitmetrie$resul,debitmetrie$card, use="pairwise.complete.obs")
cor(debitmetrie$resul,debitmetrie$carg, use="pairwise.complete.obs")

plot(debitmetrie$resul, debitmetrie$fig)
plot(debitmetrie$resul, debitmetrie$fid)
plot(debitmetrie$resul, debitmetrie$fpg)
plot(debitmetrie$resul, debitmetrie$fpd)
plot(debitmetrie$resul, debitmetrie$tpg)
plot(debitmetrie$resul, debitmetrie$tpd)
plot(debitmetrie$resul, debitmetrie$card)
plot(debitmetrie$resul, debitmetrie$carg)

par(mfrow = c(4,4))

dev.off()

#3---------------------------------

d1=data.frame(debitmetrie$resul,debitmetrie$card)
str(d1)
names(d1)
m1=lm(debitmetrie$resul~debitmetrie$card, data=d1)

residuals(m1)
coef(m1)

summary(m1)

plot(m1)


shapiro.test(m1$residuals)

qqnorm(m1$residuals)
qqline(m1$residuals)

bptest(m1)
dwtest(m1)

lm.influence(m1)
influence.measures(m1)

press = function(mod)
{
  return(sum((residuals(mod)/(1-lm.influence(mod)$hat))^2))  
}


print(press(m1))

#4---------------------------------

# eliminer les individus ayant une donnée manquante
d_na = na.omit(debitmetrie)
View(d_na)
X = as.matrix(cbind(rep(1, nrow(d_na)), d_na[, 2:9]))
Y = as.vector(d_na$resul)

print(X)
print(Y)

beta = solve(t(X)%*%X)%*%t(X)%*%Y
print(beta)
