$(document).ready(function(){
	$('.js-edit, .js-save').on('click', function(){
  	var $form = $(this).closest('form');
  	$form.toggleClass('is-readonly is-editing');
    var isReadonly  = $form.hasClass('is-readonly');
    $form.find('input,textarea').prop('disabled', isReadonly);
  });
});



$(function () {
	$('#btnSave').on('click', function (event) {
		alert();
		event.preventDefault();
	});

});



//populateContacts();

 // function populateContacts(){
//	contacts.forEach(contact => createContactCard(contact));
// }

// function PopulateList()
// {

//   // Create a request variable and assign a new XMLHttpRequest object to it.
//   var xhr = new XMLHttpRequest();
//   var url = "api/getAllContact.php";

//   // Sending and receiving data in JSON format using POST method
//   xhr.open("POST", url, true);
//   xhr.setRequestHeader("Content-Type", "application/json");
//   xhr.onload = function () {
//       if (xhr.readyState === 4 && xhr.status === 200) {
//           var json = JSON.parse(xhr.responseText);
//           if(json.status != 0)
//             {
//                 alert(json.message);
//                 return;
//             }
//           if(json.contacts)
//           {
//             var contacts = json.contacts;
//             contacts.forEach( function (obj)
//             {
//               CreateAccordion(obj.contact_id, obj.name, obj.phone,
//                 obj.address, obj.email, obj.website);
//             }
//             );
//             createCookie("jwt", json.jwt);
//             createCookie("expireAt", json.expireAt);
//           }
//           else
//           {
//             alert(json.message);
//           }
//       }
//       else {
//         console.log('error')
//       }
//   };
//   var data = JSON.stringify({"jwt": readCookie("jwt")});
//   xhr.send(data);
// }

// function saveCookie()
// {
// 	var minutes = 20;
// 	var date = new Date();
// 	date.setTime(date.getTime()+(minutes*60*1000));	
// 	document.cookie = "firstName=" + firstName + ",lastName=" + lastName + ",userId=" + userId + ";expires=" + date.toGMTString();
// }

// function readCookie()
// {
// 	userId = -1;
// 	var data = document.cookie;
// 	var splits = data.split(",");
// 	for(var i = 0; i < splits.length; i++) 
// 	{
// 		var thisOne = splits[i].trim();
// 		var tokens = thisOne.split("=");
// 		if( tokens[0] == "firstName" )
// 		{
// 			firstName = tokens[1];
// 		}
// 		else if( tokens[0] == "lastName" )
// 		{
// 			lastName = tokens[1];
// 		}
// 		else if( tokens[0] == "userId" )
// 		{
// 			userId = parseInt( tokens[1].trim() );
// 		}
// 	}
	
// 	if( userId < 0 )
// 	{
// 		window.location.href = "index.html";
// 	}
// 	else
// 	{
// 		document.getElementById("userName").innerHTML = "Logged in as " + firstName + " " + lastName;
// 	}
// }

// function getCookieData(){
// 	userId = -1;
// 	var data = document.cookie;
// 	var splits = data.split(",");
// 	for(var i = 0; i < splits.length; i++) 
// 	{
// 		var thisOne = splits[i].trim();
// 		var tokens = thisOne.split("=");
// 		if( tokens[0] == "firstName" )
// 		{
// 			firstName = tokens[1];
// 		}
// 		else if( tokens[0] == "lastName" )
// 		{
// 			lastName = tokens[1];
// 		}
// 		else if( tokens[0] == "userId" )
// 		{
// 			userId = parseInt( tokens[1].trim() );
// 		}
// 	}
	
// 	return userId;
// }

function createContactCard(firstName, lastName){
	let cardContainer = document.getElementById("card-container");
	
	let card = document.createElement("div");
  	card.className = "card";
  	cardContainer.appendChild(card);

	let cardBody = document.createElement("div");
  	cardBody.className = "card-body";
  	card.appendChild(cardBody);
	
	let left = document.createElement("div");
	left.innerHTML = firstName + lastName;
	cardBody.appendChild(left);

	let img = document.createElement("img");
	img.src = "images/icon.png";
	img.style.width = "30px";
	img.style.margin = "20px";
	left.insertAdjacentElement('afterbegin', img);

	let span = document.createElement("span");
	cardBody.appendChild(span);

	let dots = document.createElement("div");
	dots.className = "dropdown";
	span.appendChild(dots);

	let anchor = document.createElement("a");
	anchor.id = "imageDropdown";
	anchor.setAttribute("data-toggle", "dropdown" );
	anchor.addEventListener('click', getContactID);
	dots.appendChild(anchor);

	let imgDot = document.createElement("img");
	imgDot.src = "images/ellipsis.png";
	imgDot.style.width = "30px";
	imgDot.style.cursor = "pointer";
	anchor.appendChild(imgDot);

	let dropdownlist = document.createElement("ul");
	dropdownlist.className = "dropdown-menu";
	dropdownlist.setAttribute("role", "menu" );
	dropdownlist.setAttribute("aria-labelledby", "imageDropdown" );
	dots.appendChild(dropdownlist);

	let list1 = document.createElement("li");
	list1.setAttribute("data-toggle", "modal" );
	list1.setAttribute("data-target", "#editContact" );
	list1.setAttribute("role", "presentation" );
	dropdownlist.appendChild(list1);

	let item1 = document.createElement("a");
	item1.className = "ml-3";
	item1.setAttribute("role", "menuitem" );
	item1.setAttribute("tabindex", "-1" );
	item1.innerText = "Edit";
	item1.addEventListener('click', addID);
	item1.style.cursor = "pointer";
	list1.appendChild(item1);

	let list2 = document.createElement("li");
	list2.setAttribute("data-toggle", "modal" );
	list2.setAttribute("data-target", "#deleteContact" );
	list2.setAttribute("role", "presentation" );
	dropdownlist.appendChild(list2);

	let item2 = document.createElement("a");
	item2.className = "ml-3";
	item2.setAttribute("role", "menuitem" );
	item2.setAttribute("tabindex", "-1" );
	item2.innerText = "Delete";
	item2.style.color = "red";
	item2.style.cursor = "pointer";
	list2.appendChild(item2);

}

function SearchContactCard(firstName, lastName, ID){
	let cardContainer = document.getElementById("ContactList");
	
	let card = document.createElement("div");
  	card.className = "card";
  	cardContainer.appendChild(card);

	let cardBody = document.createElement("div");
  	cardBody.className = "card-body";
  	card.appendChild(cardBody);
	
	let left = document.createElement("div");
	left.innerHTML = firstName +  " " + lastName;
	cardBody.appendChild(left);

	let img = document.createElement("img");
	img.src = "images/icon.png";
	img.style.width = "30px";
	img.style.margin = "20px";
	left.insertAdjacentElement('afterbegin', img);

	let span = document.createElement("span");
	cardBody.appendChild(span);

	let dots = document.createElement("div");
	dots.className = "dropdown";
	
	let IDHolder = document.createElement("p");
	IDHolder.innerText = ID;
	IDHolder.className = "contactIDselect";

	dots.appendChild(IDHolder)
	span.appendChild(dots);

	// IDHolder.appendChild(dots);

	let anchor = document.createElement("a");
	anchor.id = "imageDropdown";
	anchor.setAttribute("data-toggle", "dropdown" );
	anchor.addEventListener('click', getContactID);
	dots.appendChild(anchor);

	let imgDot = document.createElement("img");
	imgDot.src = "images/ellipsis.png";
	imgDot.style.width = "30px";
	imgDot.style.cursor = "pointer";
	anchor.appendChild(imgDot);

	let dropdownlist = document.createElement("ul");
	dropdownlist.className = "dropdown-menu";
	dropdownlist.setAttribute("role", "menu" );
	dropdownlist.setAttribute("aria-labelledby", "imageDropdown" );
	dots.appendChild(dropdownlist);

	let list1 = document.createElement("li");
	list1.setAttribute("data-toggle", "modal" );
	list1.setAttribute("data-target", "#editContact" );
	list1.setAttribute("role", "presentation" );
	dropdownlist.appendChild(list1);

	let item1 = document.createElement("a");
	item1.className = "ml-3";
	item1.setAttribute("role", "menuitem" );
	item1.setAttribute("tabindex", "-1" );
	item1.innerText = "Edit";
	item1.addEventListener('click', addID);
	item1.style.cursor = "pointer";
	list1.appendChild(item1);

	let list2 = document.createElement("li");
	list2.setAttribute("data-toggle", "modal" );
	list2.setAttribute("data-target", "#deleteContact" );
	list2.setAttribute("role", "presentation" );
	dropdownlist.appendChild(list2);

	let item2 = document.createElement("a");
	item2.className = "ml-3";
	item2.setAttribute("role", "menuitem" );
	item2.setAttribute("tabindex", "-1" );
	item2.innerText = "Delete";
	item2.style.color = "red";
	item2.style.cursor = "pointer";
	list2.appendChild(item2);

}

const CurrenctContact = {
	contactID:0
};

let test;
let doof;

function getContactID() {
	test = document.getElementsByClassName("dropdown show");
}

function addID() {
	doof = test[0].getElementsByClassName("contactIDselect");
	CurrenctContact.contactID = doof[0].innerText;
}


function addContact()
{	
	var userID = getCookieData();

	var newFirst = document.getElementById("first").value;
	var newLast = document.getElementById("last").value;
	var newCompany = document.getElementById("company").value;
	var newPhone = document.getElementById("phone").value;
	var newEmail = document.getElementById("email").value;
	var newAddress = document.getElementById("address").value;

	document.getElementById("contactAddResult").innerHTML = "";

	var tmp = {"FirstName":newFirst,"LastName":newLast,"PhoneNumber":newPhone,"Email":newEmail,"Address":newAddress,"Company":newCompany,"UserID":userID};
	var jsonPayload = JSON.stringify( tmp );

	var url = 'php/addContact.php';
	
	var xhr = new XMLHttpRequest();
	xhr.open("POST", url, true);
	xhr.setRequestHeader("Content-type", "application/json; charset=UTF-8");
	try
	{
		xhr.onreadystatechange = function() 
		{
			if (this.readyState == 4 && this.status == 200) 
			{
				document.getElementById("contactAddResult").innerHTML = "Contact has been added!";
			}
		};
		xhr.send(jsonPayload);
	}
	catch(err)
	{
		document.getElementById("contactAddResult").innerHTML = err.message;
	}
	
}

function searchContact()
{
	var userData = getCookieData();
	userId = userData;

	var srch = document.getElementById("SearchBar").value;
	document.getElementById("searchResult").innerHTML = "";
	
	var contactList = "";

	var tmp = {"search":srch,"UserID":userId};
	var jsonPayload = JSON.stringify( tmp );

	var url = 'php/searchContact.php';
	
	var xhr = new XMLHttpRequest();
	xhr.open("POST", url, true);
	xhr.setRequestHeader("Content-type", "application/json; charset=UTF-8");
	try
	{
		xhr.onreadystatechange = function() 
		{
			if (this.readyState == 4 && this.status == 200) 
			{
				document.getElementById("searchResult").innerHTML = "Contacts has been retrieved";
				var jsonObject = JSON.parse( xhr.responseText );

                let ContactList = document.getElementById("ContactList");
                ContactList.innerHTML = "";

				let searchHeader = document.getElementById("searchHeader");
				searchHeader.innerHTML = "Searched Contacts";
				
				jsonObject.results.forEach(contact => SearchContactCard(contact.FirstName, contact.LastName, contact.ID));
			}
		};
		xhr.send(jsonPayload);
	}
	catch(err)
	{
		document.getElementById("searchResult").innerHTML = err.message;
	}
	
}



function EditContact()
{	
	let contactID = CurrenctContact.contactID
	
	var newFirst = document.getElementById("editFirst").value;
	var newLast = document.getElementById("editLast").value;
	var newEmail = document.getElementById("editEmail").value;
	var newCompany = document.getElementById("editCompany").value;
	var newPhone = document.getElementById("editPhone").value;
	var newAddress = document.getElementById("editAddress").value;

	document.getElementById("contactEditResult").innerHTML = "";

	var tmp = {FirstName:newFirst,LastName:newLast,PhoneNumber:newPhone,Email:newEmail,Address:newAddress,Company:newCompany,ID:contactID};
	var jsonPayload = JSON.stringify( tmp );

	var url = 'php/edit.php';
	
	var xhr = new XMLHttpRequest();
	xhr.open("POST", url, true);
	xhr.setRequestHeader("Content-type", "application/json; charset=UTF-8");
	try
	{
		xhr.onreadystatechange = function() 
		{
			if (this.readyState == 4 && this.status == 200) 
			{
				document.getElementById("contactEditResult").innerHTML = "Contact has been edited!";
			}
		};
		xhr.send(jsonPayload);
	}
	catch(err)
	{
		document.getElementById("contactEditResult").innerHTML = "bad edit";
	}
	
}

function deleteContact()
{	
	let contactID = CurrenctContact.contactID;

	var tmp = {ID:contactID};
	var jsonPayload = JSON.stringify( tmp );

    document.getElementById("deleteContactResult").innerHTML = "";

	var url = 'php/delete.php';
	
	var xhr = new XMLHttpRequest();
	xhr.open("POST", url, true);
	xhr.setRequestHeader("Content-type", "application/json; charset=UTF-8");
	try
	{
		xhr.onreadystatechange = function() 
		{
			if (this.readyState == 4 && this.status == 200) 
			{
				document.getElementById("deleteContactResult").innerHTML = "Contact has been deleted!";
			}
		};
		xhr.send(jsonPayload);
	}
	catch(err)
	{
		document.getElementById("deleteContactResult").innerHTML = "bad delete";
	}
	
}
