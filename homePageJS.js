$(document).ready(function(){
	$('.js-edit, .js-save').on('click', function(){
  	var $form = $(this).closest('form');
  	$form.toggleClass('is-readonly is-editing');
    var isReadonly  = $form.hasClass('is-readonly');
    $form.find('input,textarea').prop('disabled', isReadonly);
  });
});

const contacts = [
	{
		name: "Lezette",
	},
	{
		name: "Trevor",
	}
]

populateContacts();

function populateContacts(){
	contacts.forEach(contact => createContactCard(contact));
}

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




function createContactCard(contact){
	let cardContainer = document.getElementById("card-container");
	
	let card = document.createElement("div");
  	card.className = "card";
  	cardContainer.appendChild(card);

	let img = document.createElement("img");
	img.src = "images/icon.png";
	img.style.width = "30px";
	img.style.margin = "20px";
	card.appendChild(img);

	let cardBody = document.createElement("span");
	cardBody.innerHTML = contact.name;
  	cardBody.className = "card-body";
  	card.appendChild(cardBody);
	
	let imgDot = document.createElement("img");
	imgDot.src = "images/ellipsis.png";
	imgDot.style.width = "30px";
	imgDot.style.cssFloat = "right";
	cardBody.appendChild(imgDot);



	// let cardContainer = document.getElementById("card-container");
	
	// let card = document.createElement("div");
  	// card.className = "card";
  	// cardContainer.appendChild(card);

	// let img = document.createElement("img");
	// img.src = "images/icon.png";
	// img.style.width = "30px";
	// img.style.margin = "20px";
	// let para = document.createElement("P");
	// para.innerText = contact.name;
	
	// img.appendChild(para);
	// card.appendChild(img);

	


	
	
	


}
