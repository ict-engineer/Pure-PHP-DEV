i=0
c=0
l = "Stringa"
s = "Stringa"
str = "Stringa"
Origine = "Stringa"
Lung = 0;
Max = 0;
k=0
function doTotalsCalc(form) 
{
i=0;
pos=0;
s =form.amount.value;


   pos=  form.currency.selectedIndex;
   if (pos>-1) {
     com=form.currency.options[pos].value;
     if (com == 'LI') 
        {
       	 Lung =s.indexOf(",");  
       	 if (Lung > 0) {
       	   s = "0";
       	   form.amount.value = "0";
       	   }
     	 }
     }

l = ""

while (i < s.length) {
if (s.charAt(i) != ',')  
	{
	if (s.charAt(i) == ',')  
	    {
	    l= l + "," ;
	    }
	    else
		{       
	   l= l + s.charAt(i);
	   }
	}
i++;	

}

form.amount.value = l;

if (eval(l) > 0 ) 
       {                      
       l = (eval(l) * eval(form.quantity.value));			
       form.total.value = l;		
       
       i=0
       s = form.total.value  ;
       l = "";
       while (i < s.length) {
		if (s.charAt(i) == ',')  
			{
			 l= l + ",";
		
			}
			else
			{
	   	    l= l + s.charAt(i);	
		   }
		 
		i++;	
		}	
		form.total.value = l;		
      }
    else	 
     form.total.value = 0;


i=0;
s=  form.total.value ;
Origine = s;
Lung =s.indexOf(",");

if (Lung < 1) {
   Lung = s.length ;
}

l="";
while (i < Lung  ) {
k = Math.round((Lung  - i) / 3) * 3
if (k == (Lung  - i)) {
     if (i > 0) l =l + ",";
     }
     
l = l + s.charAt(i);
i++;
}
form.total.value =l;


if (Lung < Origine.length) 	
 { 
  i = Lung;  
  
  while ((i < Origine.length) && ((i - Lung) < 3)) 	
   {    
    l = l + Origine.charAt(i)
    i =i + 1 
   }
}

form.total.value =l;


       i=0
       s = form.amount.value  ;
       l = "";
       while (i < s.length) {
		if (s.charAt(i) == ',')  
			{
			 l= l + ",";
		
			}
			else
			{
	   	    l= l + s.charAt(i);	
		   }
		 
		i++;	
		}	
		form.amount.value = l;


i=0;
s=  form.amount.value ;


Origine = s;
Lung =s.indexOf(",");

if (Lung < 1) {
   Lung = s.length ;
}


l="";
while (i < Lung  ) {
k = Math.round((Lung  - i) / 3) * 3
if (k == (Lung  - i)) {
     if (i > 0) l =l + ",";
     }
     
l = l + s.charAt(i);
i++;
}
form.amount.value =l;


if (Lung < Origine.length) 	
 { 
  i = Lung;  
  
  while ((i < Origine.length) && ((i - Lung) < 3)) 	
   {    
    l = l + Origine.charAt(i)
    i =i + 1 
   }
}

form.amount.value =l;

}


function SpeseSpedizione(form)
{
i=0
Lung = 0;
s =form.postage_packing_cost.value;

   pos=  form.currency.selectedIndex;
   if (pos>-1) {
     com=form.currency.options[pos].value;
     if (com == 'LI') 
        {
       	 Lung =s.indexOf(",");  
       	 if (Lung > 0) {
       	   s = "0";
       	   form.postage_packing_cost.value= "0";
       	   }
     	 }
     }


Origine  = s;
Lung =s.indexOf(",");

if (Lung < 1) {
   Lung = s.length ;
 }



l = "";

while (i < Lung ) {
if (s.charAt(i) != '.')  
	{
	l= l + s.charAt(i)
	}
i++;	

}

form.postage_packing_cost.value = l;



i = 0
s =  form.postage_packing_cost.value ;
l = "";
k = 0;
while (i < s.length  ) {
k = Math.round((s.length - i) / 3) * 3
if (k == (s.length - i)) {
     if (i > 0) l =l + ".";
     }
     
l = l + s.charAt(i);
i++;
}


if (Lung < Origine.length) 	
 { 
  i = Lung;  
  
  while ((i < Origine.length) && ((i - Lung) < 3)) 	
   {    
    l = l + Origine.charAt(i)
    i =i + 1 
   }
}

form.postage_packing_cost.value=l;

}