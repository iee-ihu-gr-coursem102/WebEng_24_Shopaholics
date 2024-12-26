function logout(){window.location.assign("logout.php");}

//Add New List
function addNewProduct(list_id, item_id, order_id, item, quantity, measuring_unit, completed){
	const orderNumber = document.getElementsByClassName("count_"+list_id).length;
	//alert(orderNumber+1);
	var del_temp='';
	//if (!item_id){item_id = orderNumber+1;};
	if (!order_id){order_id = orderNumber+1;};
	
	if (orderNumber <10) {

	const tbody1 = document.createElement("tbody");
	const tr1 = document.createElement("tr");
	const td1 = document.createElement("td");
	const td2 = document.createElement("td");
	const td3 = document.createElement("td");
	const td4 = document.createElement("td");
	const td5 = document.createElement("td");
	const td6 = document.createElement("td");
	const td7 = document.createElement("td");
	const hiddenInput = document.createElement("input");
	const input3 = document.createElement("input");
	const input4 = document.createElement("input");
	const input5 = document.createElement("input");
	const delline = document.createElement("a");
	const group = document.createElement("td");
	const grabber = document.createElement("td");
	const addline = document.createElement("a");
	const textArea1 = document.createElement("textarea");
	const textArea2 = document.createElement("textarea");		
	const textArea3 = document.createElement("textarea");
	const textArea4 = document.createElement("textarea");
	const checkBox = document.createElement("input");
	const select_button = document.createElement("select");
	const measuring_units = ['gr','kg','ml','lit','cm','m','mins','hours','φέτες','τμχ','πακέτα','συσκευασίες','τενεκές φρικασέ'];
	const select_option = document.createElement("option");
	measuring_units.forEach((a,b)=>{
	select_option[b]=new Option(a);
	select_button.appendChild(select_option[b]);
	});
	select_button.setAttribute("rows", "1");
	select_button.setAttribute("name", "m_u_"+list_id);
	select_button.onchange = function(){save_list_changes(list_id)};
	select_button.appendChild(select_option);
	
	tr1.setAttribute("id", "row_"+list_id+"_"+order_id);
	tr1.setAttribute("draggable", "true");
	tr1.setAttribute("ondragstart", "start()");
	tr1.setAttribute("ondragover", "dragover()");
	tr1.setAttribute("ondrop", "drop("+item_id+")");
	tr1.setAttribute("class", "count_"+list_id);
	grabber.setAttribute("width", "10%");
	grabber.setAttribute("class","drag-handler");

	hiddenInput.setAttribute("id", item_id);
	hiddenInput.setAttribute("class", "items_id");
	hiddenInput.setAttribute("type", "hidden");
	if (!item_id){hiddenInput.id = "temp_"+order_id;}
	else{hiddenInput.id = item_id;}

	td1.setAttribute("style", "text-align:center;")
	td1.setAttribute("width", "5%");
	textArea1.setAttribute("class", "order_id_"+list_id);
	textArea1.setAttribute("draggable", "false");
	textArea1.setAttribute("maxlength", "3");
	textArea1.setAttribute("rows", "1");
	textArea1.oninput = function(){this.value = this.value.replace(/\n/g,'');}
	if (!order_id){textArea1.value = orderNumber+1;}else{textArea1.value = order_id;}

	//textArea1.oninput = function(){if (!this.value==""&(isNaN(this.value) || this.value < 1 || this.value > 8)) { alert("Επιτρέπονται μόνο μονοψήφιοι αριθμοί από το 1 έως το 8");
	//this.value = ""}}
	//textArea1.onchange = function(){noSameNumbers()};
	
	td2.setAttribute("width", "50%");	
	textArea2.setAttribute("name", "item_"+list_id);
	textArea2.setAttribute("rows", "1");
	textArea2.onchange = function(){save_list_changes(list_id)};
	textArea2.oninput = function(){this.value = this.value.replace(/\n/g,'');}
	textArea2.value = item;	
		
	td3.setAttribute("width", "5%");
	textArea3.setAttribute("draggable", "false");
	textArea3.setAttribute("name", "quantity_"+list_id);
	textArea3.setAttribute("style", "text-align:center;")
	textArea3.setAttribute("maxlength", "12");
	textArea3.setAttribute("rows", "1");
	textArea3.onchange = function(){save_list_changes(list_id)};
	textArea3.oninput = function(){this.value = this.value.replace(/\n/g,'');}
	textArea3.value = quantity;
	
	td4.setAttribute("width", "20%");
	textArea4.setAttribute("draggable", "false");
	textArea4.setAttribute("style", "text-align:center;")
	textArea4.setAttribute("maxlength", "12");
	textArea4.setAttribute("rows", "1");
	textArea4.onchange = function(){save_product_changes(list_id)};
	textArea4.value = measuring_unit;	

	td5.setAttribute("width", "5%");
	td5.setAttribute("style", "padding: 0 0 0 10");
	checkBox.setAttribute("name", "completed_"+list_id);
	checkBox.setAttribute("type", "checkbox");
	checkBox.onclick = function(){save_list_changes(list_id)};
	if (completed==0){checkBox.checked=false;}
	else{checkBox.checked=true;};

	td6.setAttribute("width", "5%");
	td6.setAttribute("style", "padding: 0 0 0 10");
	td6.setAttribute("class", "del_temp");
	delline.setAttribute("class","fa fa-times");
	delline.setAttribute("style","font-size: 2.1em; color: lightcoral;");
	if (!item_id){delline_id = "temp_"+order_id;}
	else{delline_id = item_id;}
	delline.setAttribute("onclick","deleteItem("+delline_id+", "+list_id+")");

	// td7.setAttribute("width", "5%");
	// td7.setAttribute("style", "padding: 0 0 0 20");
	// addline.setAttribute("class","fa fa-plus");
	// addline.setAttribute("style","font-size: 2.1em");
	// addline.setAttribute("onclick", "addNewProduct("+list_id+",'',"+order_id+",'','','',0)");

	// tbody1.appendChild(tr1);
	tr1.appendChild(hiddenInput);
	tr1.appendChild(grabber);
	
	tr1.appendChild(td1);
	td1.appendChild(textArea1);
	
	tr1.appendChild(td2);
	td2.appendChild(textArea2);

	tr1.appendChild(td4);
	td4.appendChild(textArea3);
	
	tr1.appendChild(td5);
	td5.appendChild(select_button);

	tr1.appendChild(td6);
	td6.appendChild(checkBox);

	tr1.appendChild(td7);
	// td7.appendChild(addline);
	td7.appendChild(delline);

	document.getElementById("Collapse_List_"+list_id).appendChild(tr1
	);
	save_list_changes(list_id);

}else{
alert("Δεν μπορείτε να προσθέσετε άλλο αντικείμενο!");
}
}

function deleteItem(item_id, list_id){

	if(confirm("Θέλετε σίγουρα να διαγράψετε αυτό το αντικείμενο?")){
	
	try{
	var data = new FormData();	
	data.append("item_id",item_id);
	const xhttp = new XMLHttpRequest();
  	xhttp.open("POST", "api/delete.php",true);
	xhttp.send(data);
	xhttp.onload = function() {
		console.log(this.responseText);
		document.getElementById(item_id).parentNode.remove();
		reNumberingList(list_id);
	}
	
	}catch(error){
	error.message;
	alert("Ούπς! Κάτι πήγε στραβά!\nΟι αλλαγές στη λίστα σας ΔΕΝ αποθηκεύθηκαν!");
	}
	//alert("Οι αλλαγές στη λίστα σας αποθηκεύθηκαν.");
	}
}
	
//Fancy Reordering
var row;
var base_list;
var listNumber;

function start(){
  row = event.target;
  var chk = row.parentNode.id;
  var chk2 = row.parentNode.parentNode.id;
  
	if (chk.includes("Collapse_List_")){
	 base_list = chk.split(chk.slice(0,14))[1];
		}else{
	 base_list = chk2.split(chk.slice(0,14))[1];
	}
}

function dragover(){
  var e = event;
  e.preventDefault();
  var chk = e.target.parentNode.parentNode.parentNode.id;
  let child = Array.from(e.target.parentNode.parentNode.children);

if (chk.includes("Collapse_List_")){
	if(child.indexOf(e.target.parentNode.parentNode)>child.indexOf(row)){
		e.target.parentNode.parentNode.after(row);
		}else{
		e.target.parentNode.parentNode.before(row);
	}
}else{
	if(child.indexOf(e.target.parentNode)>child.indexOf(row)){
		e.target.parentNode.after(row);
		}else{
		e.target.parentNode.before(row);
	}
	//reNumberingList(event.target.parentNode.id);
	}
}

function drop(){

list_id=findList(event.target);

	if (base_list!=list_id){
		
	const elment_array = document.getElementById("Collapse_List_"+list_id).getElementsByClassName("count_"+base_list);
	const elment_array2 = document.getElementById("Collapse_List_"+list_id).getElementsByClassName("order_id_"+base_list);

		elment_array[0].classList.add("count_"+list_id);
		elment_array[0].classList.remove("count_"+base_list);
		
		elment_array2[0].classList.add("order_id_"+list_id);
		elment_array2[0].classList.remove("order_id_"+base_list);		
	}
	reNumberingList(list_id);
	reNumberingList(base_list);
}

function reNumberingList(list_id){
try{
if(!list_id){list_id=findList(event.target);};
const rows = Array.from(document.getElementsByClassName("order_id_"+list_id));
for (var i = 0; i<rows.length; i++){
		try{
		rows[i].value = i+1;
			}catch{
		}
	}
	save_list_changes(list_id);
	alert("Οι αλλαγές στη λίστα σας αποθηκεύθηκαν.");
}catch(error){
	error.message;
	alert("Ούπς! Κάτι πήγε στραβά!\nΟι αλλαγές στη λίστα σας ΔΕΝ αποθηκεύθηκαν!");
	}
}	

function findList(list){
let listNumber;
if (event.target.parentNode.parentNode.parentNode.id.includes("Collapse_List_")){
	 listNumber = event.target.parentNode.parentNode.parentNode.id;
}else{
	 listNumber = event.target.parentNode.parentNode.id;
}
	list_id = listNumber.split(listNumber.slice(0,14))[1];
return list_id;
}	

//Add New List Colapsable
function addNewListColapse(Title, list_id){

	const listNumber = $("div[class*='ListCount']").length;
	if(!list_id){
	list_id=listNumber+1;
	}
	if(!Title){
	Title = prompt("Δώστε όνομα νέας λίστας: ","Νέα Λίστα");
	if (!Title || Title.trim().length === 0){
	alert("Η δημιουργία νέας λίστας ακυρώθηκε!\nΔοκιμάστε ξανά.");
	return 0;
	}
	}
	// alert(Title +", "+ list_id);
	// return 0;
	if (listNumber <48) {

	const list = document.createElement("div");
	const button = document.createElement("button");
	const newItem = document.createElement("a");
	const new_div = document.createElement("div");
	const new_tr = document.createElement("tr");
	const new_td = document.createElement("td");

	list.setAttribute("id", "Collapse_List_"+list_id);
	list.setAttribute("class", "collapse ListCount modal-content");
	list.setAttribute("style", "width: 800px;");

	button.setAttribute("id", "Collapse_Button_"+list_id);
	button.setAttribute("class", "btn btn-primary");
	button.setAttribute("data-toggle", "collapse");
	button.setAttribute("data-target", "#Collapse_List_"+list_id);
	button.setAttribute("width", "100px");
	button.setAttribute("draggable", "true");
	button.setAttribute("ondragstart", "start()");
	button.setAttribute("ondragover", "dragover()");
	
	newItem.setAttribute("class","fa fa-plus");
	newItem.setAttribute("style","font-size: 2em; color: blue;");
	newItem.setAttribute("onclick","addNewProduct("+list_id+",'','','','','',0)");
	
	new_div.setAttribute("id", "div_"+(listNumber+1));
	new_div.setAttribute("class", "product-container");
	
	new_td.appendChild(button);
	new_td.appendChild(list);
	new_tr.appendChild(new_td);
	
	document.getElementById("listoflists_collapsable").appendChild(new_tr);
	document.getElementById("Collapse_Button_"+list_id).textContent=Title;
	document.getElementById("Collapse_List_"+list_id).appendChild(newItem);
	
	//create_new_list(item_id);

}else{
alert("Δεν μπορείτε να προσθέσετε άλλη λίστα!");
}
}

function fetch_user_lists(user_id, active){
	
	const xhttp = new XMLHttpRequest();
  	xhttp.open("GET", "api/fetch_lists.php?user_lists="+user_id+"&active_list="+active,true);
	xhttp.send();
	xhttp.onload = function() {
	// const div1 = document.getElementById("listoflists");
	// div1.innerHTML = this.responseText
	var obj = JSON.parse(this.responseText);
	obj.forEach(function(a){
	const par = document.createElement("p");
	addNewListColapse(a.Title, a.list_id);
	fetch_list_products(a.list_id);
	});
	}	
}

function fetch_list_products(list_id){
	
	const xhttp = new XMLHttpRequest();
  	xhttp.open("GET", "api/fetch_lists.php?list_items="+list_id,true);
	xhttp.send();
	xhttp.onload = function() {
	//const div1 = document.getElementById("listoflists");
	//div1.innerHTML = this.responseText
	var obj = JSON.parse(this.responseText);
	var existingObjects = Array.from(document.getElementById("Collapse_List_"+list_id).getElementsByClassName("items_id"));
	obj.forEach(function(a,b){
	if (existingObjects.length==0){
	addNewProduct(list_id, a.item_id, a.order_id, a.item, a.quantity, a.measuring_unit, a.completed);
	}else{
		if(existingObjects[b].id != a.item_id){
	addNewProduct(list_id, a.item_id, a.order_id, a.item, a.quantity, a.measuring_unit, a.completed);	
	}
	}
	});
	}
	
}

function save_list_changes(list_id){
	
	var list_items = document.getElementsByClassName("count_"+list_id).length;
	var item_id = Array.from(document.getElementById("Collapse_List_"+list_id).getElementsByClassName("items_id"));
	var order_id = document.getElementById("order_id_"+list_id);
	var item = Array.from(document.getElementsByName("item_"+list_id));
	var quantity = Array.from(document.getElementsByName("quantity_"+list_id));
	var measuring_unit = Array.from(document.getElementsByName("m_u_"+list_id));
	var completed = Array.from(document.getElementsByName("completed_"+list_id));

	var data = new FormData();
	try {
	// if (imerominia=="" || imerominia=="0000-00-00") {
		// data.append("imerominia",NULL);
	// }else{
		// data.append("imerominia",imerominia);
	// }
for (i=0;i<list_items;i++){
	data.append("item_id",item_id[i].id);
	data.append("list_id",list_id);
	data.append("order_id",i+1);
	data.append("item",item[i].value);
	data.append("quantity",quantity[i].value);
	data.append("measuring_unit",measuring_unit[i].value);
	if(completed[i].checked){competed_val=1;}else{competed_val=0;}
	data.append("completed",competed_val);
	
	const xhttp = new XMLHttpRequest();
  	xhttp.open("POST", "api/update_lists.php",true);
	xhttp.send(data);
	xhttp.onload = function() {
		console.log(this.responseText);
		var obj = JSON.parse(this.responseText);

	if (obj.last_inserted_id != null){
			
		var item_ids = Array.from(document.getElementById("Collapse_List_"+list_id).getElementsByClassName("items_id"));
			var del_ids = Array.from(document.getElementById("Collapse_List_"+list_id).getElementsByClassName("fa fa-times"));
			
		item_ids.forEach((a,b)=>{
			if(a.id.includes("temp_")){
			a.id=obj.last_inserted_id;

			del_ids[b].setAttribute("onclick", "deleteItem("+a.id+", "+list_id+")");
			}
			});	
		}	
	}
}	
	}catch(error){
	error.message;
	alert("Ούπς! Κάτι πήγε στραβά!\nΟι αλλαγές στη λίστα σας ΔΕΝ αποθηκεύθηκαν!");
	}
}

function create_new_list(list_id){
	
	var data = new FormData();
	//data.append("user_id",user_id);
	
	data.append("user_id",10);
	data.append("new_list",true);
	data.append("list_order_id",4);
	data.append("Title","NewList");
	data.append("completed",0);	
	data.append("creation_date","2024-12-26");	
	
const xhttp = new XMLHttpRequest();
  	xhttp.open("POST", "api/create_lists.php?",true);
	xhttp.send(data);
	xhttp.onload = function() {
	// const div1 = document.getElementById("listoflists");
	// div1.innerHTML = this.responseText
	var obj = JSON.parse(this.responseText);
	// obj.forEach(function(a){
	// const par = document.createElement("p");
	// addNewListColapse(a.Title, a.list_id);
	// fetch_list_products(a.list_id);
	save_list_changes(list_id);
	//});
	}
}