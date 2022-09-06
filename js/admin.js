function allowupload(){ 
//alert("hello");
	if(frm.showphoto[1].checked) { 
		document.frm.sri.disabled=false; 
	} else { 
		document.frm.sri.disabled=true;  
		if(frm.showphoto[3].checked){ 
			$('#currentloctab').show('slow'); 
		} else  { 
			$('#currentloctab').hide('slow'); 
		}
	}
}

function allowuploadvir(){ if(frm.showvir.checked) { document.frm.vir.disabled=false; } else { document.frm.vir.disabled=true; } }

function allowuploadbol(){ if(frm.showbol.checked) { document.frm.bol.disabled=false; } else { document.frm.bol.disabled=true; } }

function allowuploadinvoice(){ if(frm.showinvoice.checked) { document.frm.invoice.disabled=false; } else { document.frm.invoice.disabled=true; } }

function allowuploadpof(){ if(frm.showpof.checked) { document.frm.pof.disabled=false; } else { document.frm.pof.disabled=true; } }



function getimagename (imgplm){
var valueimage = document.getElementById(imgplm).src;
var splited = valueimage.split("/");
valueimage = splited[splited.length-1];
return valueimage;
}


function showpackagestatusandroute(){
valueimage=getimagename("packagestatusandroutebtn");
if(valueimage=="plus-sign.png"){
$('#packagestatusplm').show('slow');
document.getElementById('packagestatusandroutebtn').src="images/minus-sign.png";
document.frm.packagestatusandroute.value=1;
} else { 
$('#packagestatusplm').hide('slow');
document.getElementById('packagestatusandroutebtn').src="images/plus-sign.png";
document.frm.packagestatusandroute.value=0;
}
}



function showdocumentstab(){
valueimage=getimagename("documentstabbtn");
if(valueimage=="plus-sign.png"){
$('#documentstabplm').show('slow');
document.getElementById('documentstabbtn').src="images/minus-sign.png";
document.frm.documentstab.value=1;
} else { 
$('#documentstabplm').hide('slow');
document.getElementById('documentstabbtn').src="images/plus-sign.png";
document.frm.documentstab.value=0;
}
}


function showtrackinginfo(){
valueimage=getimagename("trackinginfobtn");
if(valueimage=="plus-sign.png"){
$('#trackinginfoplm').show('slow');
document.getElementById('trackinginfobtn').src="images/minus-sign.png";
document.frm.trackinginfo.value=1;
} else { 
$('#trackinginfoplm').hide('slow');
document.getElementById('trackinginfobtn').src="images/plus-sign.png";
document.frm.trackinginfo.value=0;
}
}

function setfields(a1,a2,b1,b2,c1,c2){
if(a1=="1"){ $('#virphotoshow').show('slow'); } else {  $('#virphotoshow').hide('slow'); }
if(a2=="1"){ $('#virformshow').show('slow'); $('#virbtn').hide('slow'); } else { $('#virformshow').hide('slow'); $('#virbtn').show('slow'); }
if(b1=="1"){ $('#bolphotoshow').show('slow'); } else { $('#bolphotoshow').hide('slow'); }
if(b2=="1"){ $('#bolformshow').show('slow'); $('#bolbtn').hide('slow'); } else { $('#bolformshow').hide('slow'); $('#bolbtn').show('slow');}
if(c1=="1"){ $('#invoicephotoshow').show('slow'); } else { $('#invoicephotoshow').hide('slow'); }
if(c2=="1"){ $('#invoiceformshow').show('slow');  $('#invbtn').hide('slow'); } else { $('#invoiceformshow').hide('slow'); $('#invbtn').show('slow');}

}

function showgreedyfields(){
$('#greedybtn').hide('slow');
$('#greedytablet1').show('slow');
$('#greedytablet2').show('slow');
$('#greedytablet3').show('slow');
}

               
function handleEnter (field, event) {
	var keyCode = event.keyCode ? event.keyCode : event.which ? event.which : event.charCode;
	if (keyCode == 13) {
		var i;
		for (i = 0; i < field.form.elements.length; i++)
			if (field == field.form.elements[i])
				break;
		i = (i + 1) % field.form.elements.length;
		field.form.elements[i].focus();
		return false;
	} 
	else
	return true;
}      

function pause(numberMillis) 
{
	var now = new Date();
	var exitTime = now.getTime() + numberMillis;
	while (true) 
	{
		now = new Date();
		if (now.getTime() > exitTime)
		return;
	}
}

function checkCR(evt) {

	var evt  = (evt) ? evt : ((event) ? event : null);
	var node = (evt.target) ? evt.target : ((evt.srcElement) ? evt.srcElement : null);
	if ((evt.keyCode == 13) && (node.type=="text")) {return false;}
}
document.onkeypress = checkCR;


function generatenr(form){
	
	if(form.trackingnumber.value==""){
		tn = Math.floor(Math.random()*1000000000000);
		if((form.fromcountry) && (form.fromcity)){
			tb=form.fromcountry.value[0] + form.fromcity.value[0];
		
		} else {
			tb=Math.floor(Math.random()*10); 
		}
		
		if((form.tocountry) && (form.tocountry)){
			te=form.tocountry.value[0] + form.tocity.value[0];
		} else { 
			te=Math.floor(Math.random()*10); 
		}
		newtracknr = tb + tn + te;
		//alert(newtracknr);
		
	} else{
		var newtracknr = '';
		for(i=0;i < form.trackingnumber.value.length;i++){
			if(!isNaN(form.trackingnumber.value[i])) {
				piece=Math.floor(Math.random()*10);
			} else { 
				piece=form.trackingnumber.value[i];
			}
			newtracknr = newtracknr + piece;
		}
	}

	if(strstr(form.alltrackingnumbers.value, "&" + newtracknr + "&")){
		alert("Ar trebui sa joci la loto, pentru ca ai nimerit un numar deja existent (" + newtracknr +").");
		generatenr(form);
	} else {
		form.trackingnumber.value = newtracknr;
	}
	form.trackingnumber.style.backgroundColor='#aca8d5';
}

function strstr (haystack, needle, bool) {
    var pos = 0;
 
    haystack += '';
    pos = haystack.indexOf(needle);
    if (pos == -1) {
        return false;
    } else {
        if (bool) {
            return haystack.substr(0, pos);
        } else {
            return haystack.slice(pos);
        }
    }
}