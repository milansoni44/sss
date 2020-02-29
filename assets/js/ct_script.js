if( typeof current_page !== "undefined" )
{
	window[current_page+'_script']();
}

var $loading = $("#loading");
//var $loading = $("#loading").show();

$alert_success = $("#alert_success, #alert_failure").click(function()
{
	$(this).fadeOut();
});
setTimeout(function()
{
	$alert_success.fadeOut('slow');
}, 5000);

function htmlentities(str)
{
	return $("<div>").text(str).html();
}

function html_entity_decode(str)
{
	return $("<div>").html(str).text();
}

function valid_email(email)
{
	var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
	return regex.test(email);
}

//$(".number_only").on('keydown', function(e)
$(document).on('keydown', ".number_only", function(e)
{
	-1!==$.inArray(e.keyCode,[46,8,9,27,13,110,190])||/65|67|86|88/.test(e.keyCode)&&(!0===e.ctrlKey||!0===e.metaKey)||35<=e.keyCode&&40>=e.keyCode||(e.shiftKey||48>e.keyCode||57<e.keyCode)&&(96>e.keyCode||105<e.keyCode)&&e.preventDefault()
});

function login_page_script()
{

}

function add_user_page_script()
{
    
}

function list_user_page_script()
{

}

function add_invoice_page_script()
{

}

function list_invoice_page_script()
{

}
function add_privilege_points_page_script()
{

}

function list_privilege_points_page_script()
{

}

function add_settings_page_script()
{

}

function list_settings_page_script()
{

}


$("table").find("thead").find("tr").find("th").css({
	"text-align": "center",
    "vertical-align": "middle"
});
