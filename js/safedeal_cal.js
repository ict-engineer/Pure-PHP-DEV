function doTotalsCalc(form)
{
i=0;
Importo = 0;
ImportoMerce = 0;
ImportoSpedizione = 0;
 
CostoBancario = 0;
 
pos=0;
com ="";
s = "";
 
 
if (form.amount.value == '') { form.amount.value =0;}
if (form.shippingfee.value == '') { form.shippingfee.value =0;}
 
 
s = form.shippingfee.value;
i=0;
l =  "";
while (i < s.length) {
if (s.charAt(i) != '.')  
{
if (s.charAt(i) == ',')  
    {
    l= l + "." ;
    }
    else
	{       
   l= l + s.charAt(i);
   }
}
i++;	
 
}
ImportoSpedizione =l;
 
 
i=0;
s = form.amount.value;
l =  "";
while (i < s.length) {
if (s.charAt(i) != '.')  
{
if (s.charAt(i) == ',')  
    {
    l= l + "." ;
    }
    else
	{       
   l= l + s.charAt(i);
   }
}
i++;	
 
}
ImportoMerce = l;
 
 
Importo  =  eval(ImportoMerce ) +  eval(ImportoSpedizione );
 
pos =  form.VALUTA.selectedIndex;
if (pos>-1) {
   com=form.VALUTA.options[pos].value;  	   
   if (com == 'EUR') {
   
 
      pos=2;
      if (pos>-1) {
           com=form.paymentby.value;   
           if (com == 'C') {
                   if  (Importo <= 5000 ) 
                       {
                          form.rezult.value =  Math.round(Importo  * 3.8  ) / 100;
                       }
                   if  ((Importo > 5000 ) && (Importo  <= 25000 ))
                       {
                          form.rezult.value =  Math.round(Importo  * 3.5 ) / 100;
                       }
                   if  (form.rezult.value < 8 ) 
                       {
                          form.rezult.value =  8;
                       }                       
                   if (Importo  >= 5000 ) 
                      {
                          form.rezult.value = 0;
                          alert ("The credit card cannot be used for such large amounts");
                      }
                 } else
                 {
                   if  (Importo <= 5000 ) 
                       {
                          form.rezult.value =  Math.round(Importo  * 2) / 100;
                       }
                   if  ((Importo > 5000 ) && (Importo  <= 25000  ))
                       {
                          form.rezult.value =  Math.round(Importo  * 1.5) / 100;
                       }
                   if  ((Importo > 25000  ) && (Importo  <= 250000))
                       {
                          form.rezult.value =  Math.round(Importo  * 1) / 100;
                       }                       
                   if  ((Importo > 250000 ) && (Importo  <= 500000  ))
                       {
                          form.rezult.value =  Math.round(Importo  * 0.85) / 100;
                       }                       
 
                   if  (Importo > 500000  ) 
                       {
                          form.rezult.value =  Math.round(Importo  * 0.65 ) / 100;
                       }                                              
                   if  (form.rezult.value < 4) 
                       {
                          form.rezult.value =  4;
                       }                       
                 }                 
   	        }   	    
   	   }   	   
   
    if (com == 'USD') {
      pos=  1;
      if (pos>-1) {
           com=form.paymentby.value;   
           if (com == 'C') {
                   if  (Importo <= 5000  ) 
                       {
                          form.rezult.value =  Math.round(Importo  * 3.8  ) / 100;
                       }
                   if  ((Importo > 5000 ) && (Importo  <= 25000 ))
                       {
                          form.rezult.value =  Math.round(Importo  * 3.5 ) / 100;
                       }
                   if  (form.rezult.value < 8 ) 
                       {
                          form.rezult.value =  8;
                       }                       
                   if (Importo  >= 5000 ) 
                      {
                          form.rezult.value = 0;
                          alert ("The credit card cannot be used for such large amounts");
                      }
                 } else
                 {
                   if  (Importo <= 5000 ) 
                       {
                          form.rezult.value =  Math.round(Importo  * 2) / 100;
                       }
                   if  ((Importo > 5000 ) && (Importo  <= 25000  ))
                       {
                          form.rezult.value =  Math.round(Importo  * 1.5) / 100;
                       }
                   if  ((Importo > 25000  ) && (Importo  <= 250000))
                       {
                          form.rezult.value =  Math.round(Importo  * 1) / 100;
                       }                       
                   if  ((Importo > 250000 ) && (Importo  <= 500000  ))
                       {
                          form.rezult.value =  Math.round(Importo  * 0.85) / 100;
                       }                       
 
                   if  (Importo > 500000  ) 
                       {
                          form.rezult.value =  Math.round(Importo  * 0.65 ) / 100;
                       }                                              
                   if  (form.rezult.value < 4) 
                       {
                          form.rezult.value =  4;
                       }                       
                       
                   form.rezult.value = form.rezult.value;
                 }                 
   	        }   	    
   	   }   	   
   }  
 
   if (com == 'GBP') {   
 
      pos=  1;
      if (pos>-1) {
           com=form.paymentby.value;   
           if (com == 'C') {
                   if  (Importo <= 3500 ) 
                       {
                          form.rezult.value =  Math.round(Importo  * 3.8  ) / 100;
                       }
                   if  ((Importo > 3500 ) && (Importo  <= 17000 ))
                       {
                          form.rezult.value =  Math.round(Importo  * 3.5 ) / 100;
                       }
                   if  (form.rezult.value < 5.5 ) 
                       {
                          form.rezult.value =  5.5;
                       }                       
                   if (Importo  >= 5000 ) 
                      {
                          form.rezult.value = 0;
                          alert ("The credit card cannot be used for such large amounts");
                      }
                 } else
                 {
                   if  (Importo <= 3500 ) 
                       {
                          form.rezult.value =  Math.round(Importo  * 2) / 100;
                       }
                   if  ((Importo > 3500 ) && (Importo  <= 17000  ))
                       {
                          form.rezult.value =  Math.round(Importo  * 1.5) / 100;
                       }
                   if  ((Importo > 17000  ) && (Importo  <= 176000))
                       {
                          form.rezult.value =  Math.round(Importo  * 1) / 100;
                       }                       
                   if  ((Importo > 176000 ) && (Importo  <= 352000  ))
                       {
                          form.rezult.value =  Math.round(Importo  * 0.85) / 100;
                       }                       
 
                   if  (Importo > 352000  ) 
                       {
                          form.rezult.value =  Math.round(Importo  * 0.65 ) / 100;
                       }                                              
                   if  (form.rezult.value < 2.75) 
                       {
                          form.rezult.value =  2.75;
                       }                       
                 }                 
   	        }   	    
   	   }   	
} 