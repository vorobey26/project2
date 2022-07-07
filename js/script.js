function load(url) {
  parent.content.location.href= url;
}

function show_or_hide(id)
{
	var el = document.getElementById(id);
    if (el.style.display == 'none')
    {
    	el.style.display = 'block';
    }
	else
	{
		el.style.display = 'none';
	}
}

function f1()
{
	var sel_obj=document.getElementById('sel_cli');
	var inp_obj=document.getElementById('id_cli');
	inp_obj.value=sel_obj.value;
}

function f2()
{
	var sel_obj=document.getElementById('sel_tur');
	var inp_obj=document.getElementById('id_tur');
	inp_obj.value=sel_obj.value;
}

function go(page)
{
	var val_page = page.value;
	document.getElementById('page1').style.display=(val_page==1) ? "" : "none";
	document.getElementById('page2').style.display=(val_page==2) ? "" : "none";
	document.getElementById('page3').style.display=(val_page==3) ? "" : "none";
}
function ajaxFunction(){
	var ajaxRequest;  // The variable that makes Ajax possible!
	
	try{
		// Opera 8.0+, Firefox, Safari
		ajaxRequest = new XMLHttpRequest();
	} catch (e){
		// Internet Explorer Browsers
		try{
			ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
		} catch (e) {
			try{
				ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
			} catch (e){
				// Something went wrong
				alert("Your browser broke!");
				return false;
			}
		}
	}
	// Create a function that will receive data sent from the server
	ajaxRequest.onreadystatechange = function(){
		if(ajaxRequest.readyState == 4){
			var ajaxDisplay = document.getElementById('ajaxDiv');
			ajaxDisplay.innerHTML = ajaxRequest.responseText;
		}
	}
	var search = document.getElementById('id_cli').value;
	var queryString = "?search=" + search;
	ajaxRequest.open("GET", "search_dep_active.php" + queryString, true);
	ajaxRequest.send(null); 
}

function ajaxFunction1(){
	var ajaxRequest;  // The variable that makes Ajax possible!
	
	try{
		// Opera 8.0+, Firefox, Safari
		ajaxRequest = new XMLHttpRequest();
	} catch (e){
		// Internet Explorer Browsers
		try{
			ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
		} catch (e) {
			try{
				ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
			} catch (e){
				// Something went wrong
				alert("Your browser broke!");
				return false;
			}
		}
	}
	// Create a function that will receive data sent from the server
	ajaxRequest.onreadystatechange = function(){
		if(ajaxRequest.readyState == 4){
			var ajaxDisplay = document.getElementById('ajaxDiv1');
			ajaxDisplay.innerHTML = ajaxRequest.responseText;
		}
	}
	var search = document.getElementById('id_tur').value;
	var queryString = "?search=" + search;
	ajaxRequest.open("GET", "search_cat_active.php" + queryString, true);
	ajaxRequest.send(null); 
}

function ajaxFunction2(){
	var ajaxRequest;  // The variable that makes Ajax possible!
	
	try{
		// Opera 8.0+, Firefox, Safari
		ajaxRequest = new XMLHttpRequest();
	} catch (e){
		// Internet Explorer Browsers
		try{
			ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
		} catch (e) {
			try{
				ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
			} catch (e){
				// Something went wrong
				alert("Your browser broke!");
				return false;
			}
		}
	}
	// Create a function that will receive data sent from the server
	ajaxRequest.onreadystatechange = function(){
		if(ajaxRequest.readyState == 4){
			var ajaxDisplay = document.getElementById('ajaxDiv2');
			ajaxDisplay.innerHTML = ajaxRequest.responseText;
		}
	}
	var tag = document.getElementById('tag').value;
	var queryString = "?tag=" + tag;
	ajaxRequest.open("GET", "search_name_active.php" + queryString, true);
	ajaxRequest.send(null); 
}
	