function calc_right(val,factor,putin) {
        if (val == "") {
                val = "0"
        }
        evalstr = "document.convert_rightfrm."+putin+ ".value = "
        evalstr = evalstr + val + "/" + factor

        document.convert_rightfrm.ckgrams_right.value=Math.round((eval(evalstr))*100)/100

}

function calc2_right(val,factor,putin) {
        if (val == "") {
                val = "0"
        }
        evalstr = "document.convert_rightfrm."+putin+ ".value = "
        evalstr = evalstr + val + "*" + factor

        document.convert_rightfrm.ckpounds_right.value=Math.round((eval(evalstr))*100)/100
}