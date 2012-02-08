jQuery.noConflict();
// when the DOM is ready
jQuery(document).ready(function($)  {
	$('#loader').removeClass('loading'); //so the loading animation does not appear when the page first appears.
$("#projects a").click(function (event) {
// 	$(this).hide();
$("#main_image img").hide();
var the_large_image = this.href;
// var height = the_large_image.height();
$('#loader').addClass('loading');
 var img = new Image();
  
  // wrap our new image in jQuery, then:
  $(img)
    // once the image has loaded, execute this code
    .load(function () {
      $(this).hide();
      $('#loader').removeClass('loading').append(this);
      $(this).fadeIn();
    })
    .error(function () {
    })
    .attr('src', the_large_image);
	var sometitle = $(this).find('img').attr('title');
	// alert(sometitle);
	$("#image_title").html(sometitle);
	event.preventDefault();
	// console.log($(img));
	// 	console.log(the_large_image);
	// console.log(height);
});
	
});