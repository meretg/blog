+<!DOCTYPE HTML>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="keywords" content="htmlcss bootstrap, multi level menu, submenu, treeview nav menu examples" />
<meta name="description" content="Bootstrap 5 navbar multilevel treeview examples for any type of project, Bootstrap 5" />

<title>Demo - products and category</title>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>


<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"crossorigin="anonymous">
</script>


<style type="text/css">

/* ============ desktop view ============ */
@media all and (min-width: 992px) {

	.dropdown-menu li{
		position: relative;
	}
	.dropdown-menu .submenu{
		display: none;
		position: absolute;
		left:100%; top:-7px;
	}
	.dropdown-menu .submenu-left{
		right:100%; left:auto;
	}

	.dropdown-menu > li:hover{ background-color: #0d6efd }
	.dropdown-menu > li:hover > .submenu{
		display: block;
	}
}
/* ============ desktop view .end// ============ */

/* ============ small devices ============ */
@media (max-width: 991px) {

.dropdown-menu .dropdown-menu{
		margin-left:0.7rem; margin-right:0.7rem; margin-bottom: .5rem;
}

}
/* ============ small devices .end// ============ */

</style>


<script type="text/javascript">
//	window.addEventListener("resize", function() {
//		"use strict"; window.location.reload();
//	});


	document.addEventListener("DOMContentLoaded", function(){


    	/////// Prevent closing from click inside dropdown
		document.querySelectorAll('.dropdown-menu').forEach(function(element){
			element.addEventListener('click', function (e) {
			  e.stopPropagation();
			});
		})



		// make it as accordion for smaller screens
		if (window.innerWidth < 992) {

			// close all inner dropdowns when parent is closed
			document.querySelectorAll('.navbar .dropdown').forEach(function(everydropdown){
				everydropdown.addEventListener('hidden.bs.dropdown', function () {
					// after dropdown is hidden, then find all submenus
					  this.querySelectorAll('.submenu').forEach(function(everysubmenu){
					  	// hide every submenu as well
					  	everysubmenu.style.display = 'none';
					  });
				})
			});

			document.querySelectorAll('.dropdown-menu a').forEach(function(element){
				element.addEventListener('click', function (e) {
				  	let nextEl = this.nextElementSibling;
				  	if(nextEl && nextEl.classList.contains('submenu')) {
				  		// prevent opening link if link needs to open dropdown
				  		e.preventDefault();
				  		console.log(nextEl);
				  		if(nextEl.style.display == 'block'){
				  			nextEl.style.display = 'none';
				  		} else {
				  			nextEl.style.display = 'block';
				  		}

				  	}
				});
			})
		}
		// end if innerWidth

	});
	// DOMContentLoaded  end


</script>

</head>
<body>

<header class="section-header py-4">
<div class="container">
</div>
</header> <!-- section-header.// -->



<div class="container">

<!-- ============= COMPONENT ============== -->
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
 <div class="container-fluid">
 	 <!-- <a class="navbar-brand" href="#">Brand</a>
  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#main_nav"  aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button> -->
  <div class="collapse navbar-collapse" id="main_nav">

	<ul class="navbar-nav">
		<li class="nav-item dropdown">
			<a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">  Treeview menu  </a>
		    <ul id="cat" class="dropdown-menu">
					<input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">

					<!-- @ foreach ($categories as $category) -->
					@foreach ($categories as $key => $category)

						<li id="cat{{$category->id}}"><a class="dropdown-item" name="cat" id="{{$category->id}}"> {{$category->name}} </a>
						</li>
					@endforeach


		    </ul>
		</li>
	</ul>


  </div> <!-- navbar-collapse.// -->
 </div> <!-- container-fluid.// -->
</nav>

<!-- ============= COMPONENT END// ============== -->



</div><!-- container //  -->

</body>
</html>

<script>
$("#cat").on("click", ".dropdown-item", function(event){
	var cat_id=this.id
	console.log($("#subcat"+this.id).attr("class"))



	$.ajax({
		url: "{{ URL::to('getproduct') }}",
		type: "post",
		dataType: 'json',
		data: {"_token":$('#_token').val(),
		"cat_id":cat_id,


		},
		success: function(response)
		{
console.log(response)
if(response.status=="success"){
console.log($('.dropdown-item').html())
var li1 = document.getElementById("cat"+cat_id);

var ul = document.createElement('ul');

ul.setAttribute("class", "submenu dropdown-menu");
// ul.setAttribute("id", "subcat"+cat_id);
// ul.setAttribute("id", "subcat");



// ul.setAttribute("id", "subcat");

for(x=0;x<response.Products.length;x++){
	var name = response.Products[x].name;
	var li = document.createElement('li');
	var a = document.createElement('a');
	li.setAttribute("id",response.Products[x].id);
	li.setAttribute("id", "pro_id"+response.Products[x].id);

	a.setAttribute("onclick", "test("+response.Products[x].id+")");


a.setAttribute("class", "dropdown-item");
li.appendChild(a);

	a.appendChild(document.createTextNode(name));
	ul.appendChild(li);

}

	 li1.appendChild(ul);
	 console.log(li1)

}


	 }



		});


    // console.log('clicked',this.id);
});
function test(pro_id){
	console.log('test')
	$.ajax({
		url: "{{ URL::to('getsubproduct') }}",
		type: "post",
		dataType: 'json',
		data: {"_token":$('#_token').val(),
		"pro_id":pro_id,


		},
		success: function(response)
		{
console.log(response)
if(response.status=="success"){
console.log($('.dropdown-item').html())
var li1 = document.getElementById("pro_id"+pro_id);

var ul = document.createElement('ul');

ul.setAttribute("class", "submenu dropdown-menu");
// ul.setAttribute("id", "subcat"+cat_id);
// ul.setAttribute("id", "subcat");



// ul.setAttribute("id", "subcat");

for(x=0;x<response.Subproducts.length;x++){
	var name = response.Subproducts[x].name;
	var li = document.createElement('li');
	var a = document.createElement('a');
	li.setAttribute("id",response.Subproducts[x].id);
	// a.setAttribute("onclick", "test("+response.Subproducts[x].id+")");

a.setAttribute("class", "dropdown-item");
li.appendChild(a);

	a.appendChild(document.createTextNode(name));
	ul.appendChild(li);

}

	 li1.appendChild(ul);
	 console.log(li1)

}


	 }



		});
}


</script>
