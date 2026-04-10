/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Classes/Main.java to edit this template
 */

/**
 *
 * @author vlemeur
 * 
 * 
 */

package is4 ;
import java.util.ArrayList ;

public class CompteurBean extends javax.swing.JLabel {
    private int compteur = 0 ;
    private int valeurM;
    private ArrayList<ValeurListener> listeners ;
    
    public CompteurBean() { 
        super("compteur:0");
        this.listeners = new ArrayList<ValeurListener>();
        this.valeurM = 4;
    }
    
    public void setValeurMax(int valeur){ 
        this.valeurM = valeur; 
    }
    
    public int getValeurMax(){ return valeurM ; }
    
    public void raz() { compteur = 0;}
    
    public void incr() {
        if(compteur==valeurM){
            raz();
            notifyListeners();
            
        }else{
            compteur++ ;
            
        }
        this.setText("compteur: "+compteur);
    }
    
    synchronized 
    public void addValeurListener(ValeurListener l) { 
        listeners.add(l) ;
    }
    
    synchronized 
    public void removeValeurListener(ValeurListener l){
        listeners.remove(l);
    }
    
    private void notifyListeners() {
        ValeurEvent ve = new ValeurEvent(this) ;
        ArrayList<ValeurListener> lv =null;
        
        synchronized(this){
            lv = (ArrayList<ValeurListener>) listeners.clone();
        }
        for(ValeurListener l : lv) l.blabla(ve);    
            
    }
    
    
}
