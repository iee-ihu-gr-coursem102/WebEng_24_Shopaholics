function logout(){window.location.assign("logout.php");}

function user_profile(user){
		
	const u_p = document.getElementById("user_profile");
	const u_p_btn = document.createElement("button");
	
	const xhttp = new XMLHttpRequest();
  	xhttp.open("GET", "api/user_profiles.php?",true);
	xhttp.send();
	xhttp.onload = function() {
	console.log(this.responseText);
	var obj = JSON.parse(this.responseText);
	obj.forEach(obj=>{
	var	name = obj.Name;
	var	surname = obj.Surname;
	var	email = obj.email;
		u_p_btn.innerText="Καλώς ήρθες "+name+" "+surname;
		u_p.append(u_p_btn);
	});
	}
}

//Add New List
function addNewProduct(list_id, item_id, order_id, item, quantity, measuring_unit, completed){
	
	const orderNumber = document.getElementsByClassName("count_"+list_id).length;
	var del_temp='';
	if (!item_id){item_id = orderNumber+1;};
	if (!order_id){order_id = orderNumber+1;};
	
	if (orderNumber <10) {

	const tbody1 = document.createElement("tbody");
	const div1 = document.createElement("div");
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
	select_option[b]=new Option(a,b);
	select_button.appendChild(select_option[b]);
	});
	select_button.setAttribute("rows", "1");
	select_button.setAttribute("name", "m_u_"+list_id);
	select_button.setAttribute("id", "m_u_"+item_id);
	select_button.onchange = function(){save_list_changes(list_id)};
	select_button.appendChild(select_option);
	
	div1.setAttribute("id", "row_"+list_id+"_"+order_id);
	div1.setAttribute("draggable", "true");
	div1.setAttribute("ondragstart", "start()");
	div1.setAttribute("ondragover", "dragover()");
	div1.setAttribute("ondrop", "drop("+item_id+")");
	div1.setAttribute("class", "count_"+list_id);
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
	
	div1.appendChild(hiddenInput);
	div1.appendChild(grabber);
	
	div1.appendChild(td1);
	td1.appendChild(textArea1);
	
	div1.appendChild(td2);
	td2.appendChild(textArea2);

	div1.appendChild(td4);
	td4.appendChild(textArea3);
	
	div1.appendChild(td5);
	td5.appendChild(select_button);

	div1.appendChild(td6);
	td6.appendChild(checkBox);

	div1.appendChild(td7);
	// td7.appendChild(addline);
	td7.appendChild(delline);

	document.getElementById("Collapse_List_"+list_id).appendChild(div1
	);
	
	const selected_unit = document.getElementById("m_u_"+item_id);
	selected_unit.value = measuring_unit;
	
	//save_list_changes(list_id);

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
		reNumberItems(list_id);
	}
	
	}catch(error){
	error.message;
	alert("Ούπς! Κάτι πήγε στραβά!\nΟι αλλαγές στη λίστα σας ΔΕΝ αποθηκεύθηκαν!");
	}
	//alert("Οι αλλαγές στη λίστα σας αποθηκεύθηκαν.");
	}
}
	


function reNumberItems(list_id){
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
	//alert("Οι αλλαγές στη λίστα σας αποθηκεύθηκαν.");
}catch(error){
	error.message;
	alert("Ούπς! Κάτι πήγε στραβά!\nΟι αλλαγές στη λίστα σας ΔΕΝ αποθηκεύθηκαν!");
	}
}

function reNumberLists(list_id){
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
	//alert("Οι αλλαγές στη λίστα σας αποθηκεύθηκαν.");
}catch(error){
	error.message;
	alert("Ούπς! Κάτι πήγε στραβά!\nΟι αλλαγές στη λίστα σας ΔΕΝ αποθηκεύθηκαν!");
	}
}	

function findList(list){

let listNumber = list.id;
if(list.id.includes("Collapse_Button_")){
	list_id = listNumber.split(listNumber.slice(0,16))[1];
// }else{
// if (event.target.parentNode.parentNode.parentNode.id.includes("Collapse_List_")){
	 // listNumber = event.target.parentNode.parentNode.parentNode.id;
// }else{
	 // listNumber = event.target.parentNode.parentNode.id;
// }
	// list_id = listNumber.split(listNumber.slice(0,14))[1];
return list_id;
}	
}
//Add New List Colapsable
function addNewListColapse(title, list_id){

	const listNumber = $("div[class*='ListCount']").length;
	var new_list_id;
	
	if(!list_id){
	list_id= "temp_"+listNumber;
	}
	if(!title){
	title = prompt("Δώστε όνομα νέας λίστας: ","Νέα Λίστα");
		if (!title || title.trim().length === 0){
			alert("Η δημιουργία νέας λίστας ακυρώθηκε!\nΔοκιμάστε ξανά.");
			return 0;
		}else{
		create_new_list(title, list_id);
		}
	}

	if (listNumber <10000) {//remove before production!

	const list = document.createElement("div");
	const button = document.createElement("button");
	const newItem = document.createElement("a");
	const new_div = document.createElement("div");
	const new_tr = document.createElement("tr");
	//const new_td = document.createElement("td");

	list.setAttribute("id", "Collapse_List_"+list_id);
	list.setAttribute("class", "collapse ListCount modal-content");
	list.setAttribute("style", "width: 700px;");

	button.setAttribute("id", "Collapse_Button_"+list_id);
	button.setAttribute("class", "btn btn-primary");
	button.setAttribute("data-toggle", "collapse");
	button.setAttribute("data-target", "#Collapse_List_"+list_id);
	button.setAttribute("style", "width: 160px; height: 140px;");
	// button.setAttribute("draggable", "true");
	// button.setAttribute("ondragstart", "start()");
	// button.setAttribute("ondragover", "dragover()");
	
	newItem.setAttribute("id", "Add_Btn_"+list_id);
	newItem.setAttribute("class","fa fa-plus");
	newItem.setAttribute("style","font-size: 2em; color: blue;");
	newItem.setAttribute("onclick","addNewProduct("+list_id+",'','','','','',0)");
	
	new_div.setAttribute("id", "div_"+(listNumber+1));
	new_div.setAttribute("class", "button-container");
	
	new_tr.setAttribute("id", "Collapse_tr_"+list_id);
	new_tr.setAttribute("draggable", "true");
	new_tr.setAttribute("ondragstart", "start()");
	new_tr.setAttribute("ondragover", "dragover()");
	new_tr.setAttribute("ondrop", "dropList()");
	
	new_tr.appendChild(button);
	new_tr.appendChild(list);
	//new_tr.appendChild(new_td);
	
	document.getElementById("listoflists_collapsable").appendChild(new_tr);
	document.getElementById("Collapse_Button_"+list_id).textContent=title;
	document.getElementById("Collapse_List_"+list_id).appendChild(newItem);

}else{
alert("Δεν μπορείτε να προσθέσετε άλλη λίστα!");
}
}

function fetch_user_lists(user_id, active){
	
	const xhttp = new XMLHttpRequest();
  	xhttp.open("GET", "api/fetch_lists.php?user_lists="+user_id+"&active_list="+active,true);
	xhttp.send();
	xhttp.onload = function() {
	var obj = JSON.parse(this.responseText);
	obj.forEach(function(a){
	const par = document.createElement("p");
	addNewListColapse(a.title, a.list_id);
	fetch_list_products(a.list_id);
	});
	}	
}

function fetch_list_products(list_id){
	
	const xhttp = new XMLHttpRequest();
  	xhttp.open("GET", "api/fetch_lists.php?list_items="+list_id,true);
	xhttp.send();
	xhttp.onload = function() {

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

function create_new_list(title, list_id, icon){
	
	var list_order_id = document.getElementsByClassName("ListCount").length;
	
	var creation_date = new Date().toISOString().split('T')[0];
	
	var data = new FormData();
	
	data.append("list_id",list_id);
	data.append("title",title);
	data.append("category",1);
	data.append("icon","");
	data.append("active",1);	
	data.append("creation_date",creation_date);	
	data.append("list_order_id",list_order_id);
	
	const xhttp = new XMLHttpRequest();
  	xhttp.open("POST", "api/create_lists.php?",true);
	xhttp.send(data);
	xhttp.onload = function() {
		console.log(this.responseText);
	var obj = JSON.parse(this.responseText);
		if (obj.last_inserted_id!=null){			
	var temp1 = document.getElementById("Collapse_tr_"+list_id);		
		temp1.id = "Collapse_tr_"+obj.last_inserted_id;
		temp1.setAttribute("order_id",list_order_id);
	var temp2 = document.getElementById("Collapse_Button_"+list_id);		
		temp2.id = "Collapse_Button_"+obj.last_inserted_id;
		temp2.setAttribute ("data-target", "#Collapse_List_"+obj.last_inserted_id);
	var temp3 = document.getElementById("Collapse_List_"+list_id);		
		temp3.id = "Collapse_List_"+obj.last_inserted_id;
	var temp4 = document.getElementById("Add_Btn_"+list_id);		
		temp4.id = "Add_Btn_"+obj.last_inserted_id;	
		temp4.setAttribute("onclick","addNewProduct("+obj.last_inserted_id+",'','','','','',0)");
		list_id = obj.last_inserted_id;	
		}
	save_list_changes(list_id);
	}
}

function select_lists(){
	
	//const checkBox = document.createElement("input");

	var all_lists = Array.from(document.getElementById("listoflists_collapsable").children);
	
	all_lists.forEach((list)=>{ 
	
	var chk = document.getElementById(list.lastChild.id);
	list_id = list.firstChild.id.split(list.firstChild.id.slice(0,16))[1];
	
	if(!chk.classList.contains("btn")){
	const btn1 = document.createElement("button");
	const btn2 = document.createElement("button");
	const btn3 = document.createElement("button");
	const btn4 = document.createElement("button");
	
	//list.classList.add ("close-btn");
	list.setAttribute("style", "display:flex");
	list.setAttribute("style", "flex-direction:column; align-items:flex-start");

	list.append(btn1);
	list.append(btn2);
	list.append(btn3);
	list.append(btn4);
	
	btn1.setAttribute("id", "btn1_"+list.id);
	btn1.setAttribute("class","btn fa fa-edit");
	btn1.setAttribute("style","width:40px;");
	btn1.setAttribute("onclick","edit_list("+list_id+")");
	
	btn2.setAttribute("id", "btn2_"+list.id);
	btn2.setAttribute("class","btn fa fa-share");
	btn2.setAttribute("style","width:40px;");
	btn2.setAttribute("onclick","share_list("+list_id+")");
	
	btn3.setAttribute("id", "btn3_"+list.id);
	btn3.setAttribute("class","btn close-badge");
	btn3.setAttribute("style","width:40px;");
	btn3.setAttribute("onclick","delete_list("+list_id+")");
	btn3.innerText="X";
	
	btn4.setAttribute("id", "btn4_"+list.id);
	btn4.setAttribute("class","btn fa fa-archive");
	btn4.setAttribute("style","width:40px;");
	btn4.setAttribute("onclick","archive_list("+list_id+")");

	
	}else{
		list.lastChild.remove();
		list.lastChild.remove();
		list.lastChild.remove();
		list.lastChild.remove();
	//alert(list.id);
	}
	// checkBox.setAttribute("name", "selected_"+list.id);
	// checkBox.setAttribute("type", "reset");
	// checkBox.setAttribute("class","fa fa-times");
	
	//list.append(checkBox);
	
		// checkBox.onclick = function(){save_list_changes(list_id)};
		// if (completed==0){checkBox.checked=false;}
		// else{checkBox.checked=true;};
	});
	
}

function edit_list(list_id){
		
	var temp1 = document.getElementById("Collapse_Button_"+list_id);
	
	title = prompt("Δώστε το όνομα λίστας: ",temp1.innerText);
		if (!title || title.trim().length === 0){
			alert("Η μετονομασία της λίστας ακυρώθηκε!\nΔοκιμάστε ξανά.");
			return 0;
		}else{
	var data = new FormData();	
		
	data.append("list_id",list_id);
	data.append("update_title",title);
	
const xhttp = new XMLHttpRequest();
  	xhttp.open("POST", "api/edit_lists.php?",true);
	xhttp.send(data);
	xhttp.onload = function() {
		console.log(this.responseText);
	//	if (!error){			
		temp1.innerText = title;
	//}
	}
}
}

function delete_list(list_id){
	
	var title = document.getElementById("Collapse_Button_"+list_id).innerText;
	var data = new FormData();
	if (confirm("Θέλετε να σίγουρα να σβήσετε την λίστα: '"+title+"' ?")){
	data.append("list_id",list_id);
	
	const xhttp = new XMLHttpRequest();
  	xhttp.open("POST", "api/delete_lists.php?",true);
	xhttp.send(data);
	xhttp.onload = function() {
	console.log(this.responseText);
	}
	document.getElementById("Collapse_tr_"+list_id).remove();
	}else{
		alert("Η ενέργεια ακυρώθηκε.");
	}
}

function share_list(list_id){
	
	var user_email = prompt("Δώστε το e-mail του χρήστη που θέλετε να έχει πρόσβαση στη λίστα σας: ","Διαμοιρασμός Λίστας");
	if (!user_email || user_email.trim().length === 0){
			alert("Ο διαμοιρασμός της λίστας ακυρώθηκε!\nΔοκιμάστε ξανά.");
			return 0;
		}else{
		
	var data = new FormData();
	
	data.append("list_id",list_id);
	data.append("user_email",user_email);
	
	const xhttp = new XMLHttpRequest();
  	xhttp.open("POST", "api/share_lists.php?",true);
	xhttp.send(data);
	xhttp.onload = function() {
	console.log(this.responseText);
	//var obj = JSON.parse(this.responseText);
	//save_list_changes(list_id);
	}
	}
}

function archive_list(list_id){
		
	var data = new FormData();	
		
	data.append("list_id",list_id);
	data.append("archive_list",0);
	
	const xhttp = new XMLHttpRequest();
  	xhttp.open("POST", "api/archive_lists.php?",true);
	xhttp.send(data);
	xhttp.onload = function() {
		console.log(this.responseText);
	}
}

//Fancy Reordering
var row;
var base_list;
var listNumber;
var temp_btn_order;

function start(){
  row = event.target;
  
  row.setAttribute("draggable", "true");
  
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
  
if (e.target.id.includes("Collapse_tr_")){
	if(child.indexOf(e.target.parentNode)>child.indexOf(row)){
		e.target.parentNode.after(row);
		}else{
		e.target.parentNode.before(row);
	}
}
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
	//reNumberItems(event.target.parentNode.id);
	}
}

function drop(){
alert("true");
list_id=findList(event.target);

	var temp_btn_order = document.querySelectorAll('[id*="Collapse_Button_"]');
	temp_btn_order.forEach((a,b)=>{
	console.log(b);
	});
	if (base_list!=list_id){
		
	const elment_array = document.getElementById("Collapse_List_"+list_id).getElementsByClassName("count_"+base_list);
	const elment_array2 = document.getElementById("Collapse_List_"+list_id).getElementsByClassName("order_id_"+base_list);

		elment_array[0].classList.add("count_"+list_id);
		elment_array[0].classList.remove("count_"+base_list);
		
		elment_array2[0].classList.add("order_id_"+list_id);
		elment_array2[0].classList.remove("order_id_"+base_list);		
	}
	reNumberItems(list_id);
	reNumberItems(base_list);
}

function dropList(){

const curr_lists = Array.from(document.getElementById("listoflists_collapsable").children);

curr_lists.forEach((list,order)=>{
	
	list.setAttribute("order_id",order);
	list_id=findList(event.target);
	
	list_order_id = document.getElementById("Collapse_tr_"+list_id).getAttribute("order_id");
	
	var data = new FormData();
	
	data.append("list_id",list_id);
	data.append("update_list_order_id",list_order_id);
	
	const xhttp = new XMLHttpRequest();
  	xhttp.open("POST", "api/edit_lists.php?",true);
	xhttp.send(data);
	xhttp.onload = function() {
	
	}
	});
}