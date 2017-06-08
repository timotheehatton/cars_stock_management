if (document.querySelector( '.content--add' )) {
	var add_product_btn = document.querySelector( '.content--add--btn' );
	var add_product = document.querySelector( '.content--add' );
	add_product_btn.addEventListener( 'click', function( e )
	{
		add_product.classList.toggle("content--add--active");
	});
}

if (document.getElementById("files")) {
	document.getElementById("files").onchange = function () {
	    var reader = new FileReader();

	    reader.onload = function (e) {
	        document.getElementById("image").src = e.target.result;
	    };
	    reader.readAsDataURL(this.files[0]);
	};
}

if (document.querySelector( '.alert' )) {
	var alert_btn = document.querySelector( '.alert--btn' );
	var alert     = document.querySelector( '.alert' );
	alert_btn.addEventListener( 'click', function( e )
	{
		alert.classList.toggle("close");
	});
}
