library(dplyr)
library(ggplot2)

library(readr)
EN1 <- read_csv("log-stat/TP0/EN1.csv")
View(EN1)

library(readr)
EN2 <- read_csv("log-stat/TP0/EN2.csv")
View(EN2)

str(EN1)
ncol(EN1)
nrow(EN1)
dim(EN1)

summary(EN1)

EN3<- merge(EN1,EN2,by="numero_etablissement")
EN3<- inner_join(EN1,EN2,by="numero_etablissement")

EN4<- cbind(EN1,EN2)
EN4[6]<- NULL

colnames(EN4)
?rename
EN4<- EN4%>%rename(TERMINALESG=effectif_total_garcons)
EN4<- EN4%>%rename(TERMINALESF=effectif_total_filles)

maselection<- EN4%>%select(TERMINALESG)

monfiltre<- EN4%>%filter(TERMINALESG>=72)
monfiltre2<- EN4%>%filter(TERMINALESG>=72,TERMINALESF<=36)

EN4<- EN4%>%arrange(TERMINALESG)
EN4<- EN4%>%arrange(desc(TERMINALESG))

EN4<- EN4%>%mutate(PRCT=TERMINALESG/effectif_total_en_terminale_generale*100)

monresultat<- EN4%>%group_by(academie)%>% 
  summarise(MOYENNE=mean(`0613_mathematiques_garcons`,na.rm=T))

