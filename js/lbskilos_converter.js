function calc(val,factor,putin) {
	if (val == "")
	{
	   val = "0"
	}
	evalstr = "document.convert_frm."+putin+ ".value = "
	evalstr = evalstr + val + "/" + factor
	document.convert_frm.ckgrams.value=Math.round((eval(evalstr))*100)/100
}

function calc2(val,factor,putin) {
	if (val == "")
	{
	   val = "0"
	}
	evalstr = "document.convert_frm."+putin+ ".value = "
	evalstr = evalstr + val + "*" + factor
	document.convert_frm.ckpounds.value=Math.round((eval(evalstr))*100)/100
}