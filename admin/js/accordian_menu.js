// JavaScript Document

$(document).ready(function(){
	
	$('.accordionButton').click(function(){		
		$('.accordionButton').removeClass('on');
		$('.accordionContent').slideUp('normal');
		if($(this).next().is(':hidden')==true){
			$(this).addClass('on');
			$(this).next().slideDown('normal');
		}
	});
		
	$('.accordionButton').mouseover(function() {
		$(this).addClass('over');
		}).mouseout(function() {
		$(this).removeClass('over');										
	});		
	$('.accordionContent').hide();
	//alert("here");

});