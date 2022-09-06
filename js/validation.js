// JavaScript Document

//JavaScript Validation for Registration page==============
function validate_register(){
	var formname=document.frm_register;
	var emailExp = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/;
	if(formname.email.value==''){
		document.getElementById("lbl_email").innerHTML="<font color='red'>This field is required.</font>";
		formname.email.focus();
		return false;
	}else {
		document.getElementById('lbl_email').innerHTML="";
	}
	if(!(formname.email.value).match(emailExp))
	{
		document.getElementById("lbl_email").innerHTML="<font color='red'>Enter valid email.</font>";
		formname.email.focus()
		return false;
	}else{
		document.getElementById("lbl_email").innerHTML='';
	}
	if(formname.password.value==''){
		document.getElementById("lbl_password").innerHTML="<font color='red'>This field is required.</font>";
		formname.password.focus();
		return false;
	}else {
		document.getElementById('lbl_password').innerHTML="";
	}
	if(formname.password.value.length<6){
		document.getElementById("lbl_password").innerHTML="<font color='red'>Password must be 6 charecter long.</font>";
		formname.password.focus();
		return false;
	}else {
		document.getElementById('lbl_password').innerHTML="";
	}
	if(formname.re_pwd.value==''){
		document.getElementById("lbl_re_pwd").innerHTML="<font color='red'>This field is required.</font>";
		formname.re_pwd.focus();
		return false;
	}else {
		document.getElementById('lbl_re_pwd').innerHTML="";
	}
	if(formname.re_pwd.value!=formname.password.value){
		document.getElementById("lbl_re_pwd").innerHTML="<font color='red'>Password doesn't match.</font>";
		formname.re_pwd.focus();
		return false;
	}else {
		document.getElementById('lbl_re_pwd').innerHTML="";
	}
	/*if(formname.identification.value==''){
		document.getElementById("lbl_identification").innerHTML="<font color='red'>This field is required.</font>";
		formname.identification.focus();
		return false;
	}else {
		document.getElementById('lbl_identification').innerHTML="";
	}*/
	if(formname.name.value==''){
		document.getElementById("lbl_name").innerHTML="<font color='red'>This field is required.</font>";
		formname.name.focus();
		return false;
	}else {
		document.getElementById('lbl_name').innerHTML="";
	}
	if(formname.surname.value==''){
		document.getElementById("lbl_surname").innerHTML="<font color='red'>This field is required.</font>";
		formname.surname.focus();
		return false;
	}else {
		document.getElementById('lbl_surname').innerHTML="";
	}
	/*if(formname.company.value==''){
		document.getElementById("lbl_company").innerHTML="<font color='red'>This field is required.</font>";
		formname.company.focus();
		return false;
	}else {
		document.getElementById('lbl_company').innerHTML="";
	}*/
	if(formname.country_residence.value==''){
		document.getElementById("lbl_counry_residence").innerHTML="<font color='red'>This field is required.</font>";
		formname.country_residence.focus();
		return false;
	}else {
		document.getElementById('lbl_counry_residence').innerHTML="";
	}
	/*if(formname.payment_opt.value==''){
		document.getElementById("lbl_payment_opt").innerHTML="<font color='red'>This field is required.</font>";
		formname.payment_opt.focus();
		return false;
	}else {
		document.getElementById('lbl_payment_opt').innerHTML="";
	}*/
	if(formname.month.value==''){
		document.getElementById("lbl_month").innerHTML="<font color='red'>This field is required.</font>";
		formname.month.focus();
		return false;
	}else {
		document.getElementById('lbl_month').innerHTML="";
	}
	if(formname.day.value==''){
		document.getElementById("lbl_day").innerHTML="<font color='red'>This field is required.</font>";
		formname.day.focus();
		return false;
	}else {
		document.getElementById('lbl_day').innerHTML="";
	}
	if(formname.year.value=='' || formname.year.value=='19'){
		document.getElementById("lbl_year").innerHTML="<font color='red'>This field is required.</font>";
		formname.year.focus();
		return false;
	}else {
		document.getElementById('lbl_year').innerHTML="";
	}
	if(formname.address1.value==''){
		document.getElementById("lbl_address1").innerHTML="<font color='red'>This field is required.</font>";
		formname.address1.focus();
		return false;
	}else {
		document.getElementById('lbl_address1').innerHTML="";
	}
	/*if(formname.address2.value==''){
		document.getElementById("lbl_address2").innerHTML="<font color='red'>This field is required.</font>";
		formname.address2.focus();
		return false;
	}else {
		document.getElementById('lbl_address2').innerHTML="";
	}*/
	if(formname.city.value==''){
		document.getElementById("lbl_city").innerHTML="<font color='red'>This field is required.</font>";
		formname.city.focus();
		return false;
	}else {
		document.getElementById('lbl_city').innerHTML="";
	}
	if(formname.region.value==''){
		document.getElementById("lbl_region").innerHTML="<font color='red'>This field is required.</font>";
		formname.region.focus();
		return false;
	}else {
		document.getElementById('lbl_region').innerHTML="";
	}
	if(formname.country.value==''){
		document.getElementById("lbl_country").innerHTML="<font color='red'>This field is required.</font>";
		formname.country.focus();
		return false;
	}else {
		document.getElementById('lbl_country').innerHTML="";
	}
	if(formname.postcode.value==''){
		document.getElementById("lbl_postcode").innerHTML="<font color='red'>This field is required.</font>";
		formname.postcode.focus();
		return false;
	}else {
		document.getElementById('lbl_postcode').innerHTML="";
	}
	if(formname.phone.value==''){
		document.getElementById("lbl_phone").innerHTML="<font color='red'>This field is required.</font>";
		formname.phone.focus();
		return false;
	}else {
		document.getElementById('lbl_phone').innerHTML="";
	}
	/*if(formname.fax.value==''){
		document.getElementById("lbl_fax").innerHTML="<font color='red'>This field is required.</font>";
		formname.fax.focus();
		return false;
	}else {
		document.getElementById('lbl_fax').innerHTML="";
	}*/
	if(formname.chk.checked==false){
		document.getElementById("lbl_chk").innerHTML="<font color='red'>This field is required.</font>";
		formname.chk.focus();
		return false;
	}else {
		document.getElementById('lbl_chk').innerHTML="";
		return true;
	}

}
//JavaScript Validation for Registration page==============


//JavaScript Validation for Add Transaction page===========
function validate_transaction(){
	
	var formname=document.add_transaction_frm;
	var emailExp = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/;
		
	if(formname.otherparty_email.value==''){
		document.getElementById("lbl_otherparty_email").innerHTML="<font color='red'>This field is required.</font>";
		formname.otherparty_email.focus();
		return false;
	}else {
		document.getElementById('lbl_otherparty_email').innerHTML="";
	}
	if(!(formname.otherparty_email.value).match(emailExp))
	{
		document.getElementById("lbl_otherparty_email").innerHTML="<font color='red'>Enter valid email.</font>";
		formname.otherparty_email.focus()
		return false;
	}else{
		document.getElementById("lbl_otherparty_email").innerHTML='';
	}
	
	if(formname.transaction_originate.value==''){
		document.getElementById("lbl_transaction_originate").innerHTML="<font color='red'>This field is required.</font>";
		formname.transaction_originate.focus();
		return false;
	}else {
		document.getElementById('lbl_transaction_originate').innerHTML="";
	}
	
	if(formname.brief_descr.value==''){
		document.getElementById("lbl_brief_descr").innerHTML="<font color='red'>This field is required.</font>";
		formname.brief_descr.focus();
		return false;
	}else {
		document.getElementById('lbl_brief_descr').innerHTML="";
	}
	
	if(formname.inspection_period.value==''){
		document.getElementById("lbl_inspection_period").innerHTML="<font color='red'>This field is required.</font>";
		formname.inspection_period.focus();
		return false;
	}else {
		document.getElementById('lbl_inspection_period').innerHTML="";
	}
	
	if(formname.postage_packing_cost.value==''){
		document.getElementById("lbl_postage_packing_cost").innerHTML="<font color='red'>This field is required.</font>";
		formname.postage_packing_cost.focus();
		return false;
	}else {
		document.getElementById('lbl_postage_packing_cost').innerHTML="";
	}

}
//JavaScript Validation for Add Transaction page===========


//JavaScript Validation for Contact Us page================
function validate(){
	
var formname=document.contact_frm;
	var emailExp = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/;
	if(formname.name.value==''){
		document.getElementById("lbl_name").innerHTML="<font color='red'>This field is required.</font>";
		formname.name.focus();
		return false;
	}else {
		document.getElementById('lbl_name').innerHTML="";
	}
	
	if(formname.email.value==''){
		document.getElementById("lbl_email").innerHTML="<font color='red'>This field is required.</font>";
		formname.email.focus();
		return false;
	}else {
		document.getElementById('lbl_email').innerHTML="";
	}
	if(!(formname.email.value).match(emailExp))
	{
		document.getElementById("lbl_email").innerHTML="<font color='red'>Enter valid email.</font>";
		formname.email.focus()
		return false;
	}else{
		document.getElementById("lbl_email").innerHTML='';
	}
	if(formname.phone.value==''){
		document.getElementById("lbl_phone").innerHTML="<font color='red'>This field is required.</font>";
		formname.phone.focus();
		return false;
	}else {
		document.getElementById('lbl_phone').innerHTML="";
	}
	if(formname.message.value==''){
		document.getElementById("lbl_message").innerHTML="<font color='red'>This field is required.</font>";
		formname.message.focus();
		return false;
	}else {
		document.getElementById('lbl_message').innerHTML="";
	}

}
//JavaScript Validation for Contact Us page================


function PhoneNo(evt)
  {
	 var charCode = (evt.which) ? evt.which : event.keyCode
	 if ((charCode >= 97 && charCode <=122) || ((charCode >= 65 && charCode <=90)))
	 {
		return false;	
	 }
	 else
	 {
		return true;
		
	 }
 }
function PhoneNo1(evt,val)
  {
	 var charCode = (evt.which) ? evt.which : event.keyCode
	 if ((charCode >= 97 && charCode <=122) || ((charCode >= 65 && charCode <=90)))
	 {
		return false;	
	 }
	 else
	 {
		//return true;
		checklength(val);
	 }
 }
function checklength(val){
	if(val.length>=4){
		document.getElementById("year").value=val.substring(0,3);
	}else{
		document.getElementById("year").value=val;
	}
}

//JavaScript Validation for Login page=====================
function validate_login(){
	var formname=document.frm_login;
	var emailExp = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/;
	if(formname.email.value==''){
		document.getElementById("lbl_email").innerHTML="<font color='red'>This field is required.</font>";
		formname.email.focus();
		return false;
	}else {
		document.getElementById('lbl_email').innerHTML="";
	}
	if(!(formname.email.value).match(emailExp))
	{
		document.getElementById("lbl_email").innerHTML="<font color='red'>Enter valid email.</font>";
		formname.email.focus()
		return false;
	}else{
		document.getElementById("lbl_email").innerHTML='';
	}
	if(formname.password.value==''){
		document.getElementById("lbl_password").innerHTML="<font color='red'>This field is required.</font>";
		formname.password.focus();
		return false;
	}else {
		document.getElementById('lbl_password').innerHTML="";
	}
}
//JavaScript Validation for Login page=====================


//JavaScript Validation for My Account page================
function validate_my_account(){
	
	var formname=document.frm_account;
	var emailExp = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/;
	if(formname.email.value==''){
		document.getElementById("lbl_email").innerHTML="<font color='red'>This field is required.</font>";
		formname.email.focus();
		return false;
	}else {
		document.getElementById('lbl_email').innerHTML="";
	}
	if(!(formname.email.value).match(emailExp))
	{
		document.getElementById("lbl_email").innerHTML="<font color='red'>Enter valid email.</font>";
		formname.email.focus()
		return false;
	}else{
		document.getElementById("lbl_email").innerHTML='';
	}
	
	if(formname.name.value==''){
		document.getElementById("lbl_name").innerHTML="<font color='red'>This field is required.</font>";
		formname.name.focus();
		return false;
	}else {
		document.getElementById('lbl_name').innerHTML="";
	}
	if(formname.surname.value==''){
		document.getElementById("lbl_surname").innerHTML="<font color='red'>This field is required.</font>";
		formname.surname.focus();
		return false;
	}else {
		document.getElementById('lbl_surname').innerHTML="";
	}
	
	if(formname.counry_residence.value==''){
		document.getElementById("lbl_counry_residence").innerHTML="<font color='red'>This field is required.</font>";
		formname.counry_residence.focus();
		return false;
	}else {
		document.getElementById('lbl_counry_residence').innerHTML="";
	}
	
	if(formname.month.value==''){
		document.getElementById("lbl_month").innerHTML="<font color='red'>This field is required.</font>";
		formname.month.focus();
		return false;
	}else {
		document.getElementById('lbl_month').innerHTML="";
	}
	if(formname.day.value==''){
		document.getElementById("lbl_day").innerHTML="<font color='red'>This field is required.</font>";
		formname.day.focus();
		return false;
	}else {
		document.getElementById('lbl_day').innerHTML="";
	}
	if(formname.year.value==''){
		document.getElementById("lbl_year").innerHTML="<font color='red'>This field is required.</font>";
		formname.year.focus();
		return false;
	}else {
		document.getElementById('lbl_year').innerHTML="";
	}
	if(formname.address1.value==''){
		document.getElementById("lbl_address1").innerHTML="<font color='red'>This field is required.</font>";
		formname.address1.focus();
		return false;
	}else {
		document.getElementById('lbl_address1').innerHTML="";
	}
	
	if(formname.city.value==''){
		document.getElementById("lbl_city").innerHTML="<font color='red'>This field is required.</font>";
		formname.city.focus();
		return false;
	}else {
		document.getElementById('lbl_city').innerHTML="";
	}
	if(formname.region.value==''){
		document.getElementById("lbl_region").innerHTML="<font color='red'>This field is required.</font>";
		formname.region.focus();
		return false;
	}else {
		document.getElementById('lbl_region').innerHTML="";
	}
	if(formname.country.value==''){
		document.getElementById("lbl_country").innerHTML="<font color='red'>This field is required.</font>";
		formname.country.focus();
		return false;
	}else {
		document.getElementById('lbl_country').innerHTML="";
	}
	if(formname.postcode.value==''){
		document.getElementById("lbl_postcode").innerHTML="<font color='red'>This field is required.</font>";
		formname.postcode.focus();
		return false;
	}else {
		document.getElementById('lbl_postcode').innerHTML="";
	}
	if(formname.phone.value==''){
		document.getElementById("lbl_phone").innerHTML="<font color='red'>This field is required.</font>";
		formname.phone.focus();
		return false;
	}else {
		document.getElementById('lbl_phone').innerHTML="";
	}
	
	


}
//JavaScript Validation for My Account page================


//JavaScript Validation for Change Password page===========
function validate_change_password(){
	var formname=document.frm_pwd;
	if(formname.old_pwd.value==''){
		document.getElementById("lbl_old_pwd").innerHTML="<font color='red'>This field is required.</font>";
		formname.old_pwd.focus();
		return false;
	}else {
		document.getElementById('lbl_old_pwd').innerHTML="";
	}
	if(formname.new_pwd.value==''){
		document.getElementById("lbl_new_pwd").innerHTML="<font color='red'>This field is required.</font>";
		formname.new_pwd.focus();
		return false;
	}else {
		document.getElementById('lbl_new_pwd').innerHTML="";
	}
	if(formname.new_pwd.value.length<6){
		document.getElementById("lbl_new_pwd").innerHTML="<font color='red'>Password must be 6 charecter long.</font>";
		formname.new_pwd.focus();
		return false;
	}else {
		document.getElementById('lbl_new_pwd').innerHTML="";
	}
	if(formname.retype_pwd.value==''){
		document.getElementById("lbl_re_pwd").innerHTML="<font color='red'>This field is required.</font>";
		formname.retype_pwd.focus();
		return false;
	}else {
		document.getElementById('lbl_re_pwd').innerHTML="";
	}
	if(formname.retype_pwd.value!=formname.new_pwd.value){
		document.getElementById("lbl_re_pwd").innerHTML="<font color='red'>Password doesn't match.</font>";
		formname.retype_pwd.focus();
		return false;
	}else {
		document.getElementById('lbl_re_pwd').innerHTML="";
	}
}
//JavaScript Validation for Change Password page===========


//JavaScript Validation for Forgot Password page===========
function validate_forgot_password(){
	
	var formname=document.frm_forgot;
	var emailExp = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/;
	if(formname.email.value==''){
		document.getElementById("lbl_email").innerHTML="<font color='red'>This field is required.</font>";
		formname.email.focus();
		return false;
	}else {
		document.getElementById('lbl_email').innerHTML="";
	}
	if(!(formname.email.value).match(emailExp))
	{
		document.getElementById("lbl_email").innerHTML="<font color='red'>Enter valid email.</font>";
		formname.email.focus()
		return false;
	}else{
		document.getElementById("lbl_email").innerHTML='';
	}

	if(formname.name.value==''){
		document.getElementById("lbl_name").innerHTML="<font color='red'>This field is required.</font>";
		formname.name.focus();
		return false;
	}else {
		document.getElementById('lbl_name').innerHTML="";
	}
	if(formname.surname.value==''){
		document.getElementById("lbl_surname").innerHTML="<font color='red'>This field is required.</font>";
		formname.surname.focus();
		return false;
	}else {
		document.getElementById('lbl_surname').innerHTML="";
	}
	
	if(formname.month.value==''){
		document.getElementById("lbl_month").innerHTML="<font color='red'>This field is required.</font>";
		formname.month.focus();
		return false;
	}else {
		document.getElementById('lbl_month').innerHTML="";
	}
	if(formname.day.value==''){
		document.getElementById("lbl_day").innerHTML="<font color='red'>This field is required.</font>";
		formname.day.focus();
		return false;
	}else {
		document.getElementById('lbl_day').innerHTML="";
	}
	if(formname.year.value=='' || formname.year.value=='19'){
		document.getElementById("lbl_year").innerHTML="<font color='red'>This field is required.</font>";
		formname.year.focus();
		return false;
	}else {
		document.getElementById('lbl_year').innerHTML="";
	}

}
//JavaScript Validation for Forgot Password page===========


//JavaScript Validation for Forgot Change Password page====
function validate_forgot_change_password(){
	var formname=document.frm_forgot_pwd;
	
	if(formname.new_pwd.value==''){
		document.getElementById("lbl_new_pwd").innerHTML="<font color='red'>This field is required.</font>";
		formname.new_pwd.focus();
		return false;
	}else {
		document.getElementById('lbl_new_pwd').innerHTML="";
	}
	if(formname.new_pwd.value.length<6){
		document.getElementById("lbl_new_pwd").innerHTML="<font color='red'>Password must be 6 charecter long.</font>";
		formname.new_pwd.focus();
		return false;
	}else {
		document.getElementById('lbl_new_pwd').innerHTML="";
	}
	if(formname.retype_pwd.value==''){
		document.getElementById("lbl_re_pwd").innerHTML="<font color='red'>This field is required.</font>";
		formname.retype_pwd.focus();
		return false;
	}else {
		document.getElementById('lbl_re_pwd').innerHTML="";
	}
	if(formname.retype_pwd.value!=formname.new_pwd.value){
		document.getElementById("lbl_re_pwd").innerHTML="<font color='red'>Password doesn't match.</font>";
		formname.retype_pwd.focus();
		return false;
	}else {
		document.getElementById('lbl_re_pwd').innerHTML="";
	}
}
//JavaScript Validation for Forgot Change Password page====


