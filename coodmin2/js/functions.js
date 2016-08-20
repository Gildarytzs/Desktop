var count = 0;
var know = 0;

function validateInput(id, num) {
	var input = document.getElementById(id).value;
	var div = document.getElementById("alert" + num);
	var progress = document.getElementById("progress");
	var inputButton = document.getElementById("buttonFinal");
	
	if(id == "type") {
		if (input != "...") {
			if (div.className == "form-group" || div.className == "form-group danger") {
				div.className = "form-group success";  // seul qui marche 
				count += 12;
				progress.style.width = count + "%";
				progress.setAttribute("aria-valuenow", count);
				progress.innerHTML = count + "%";
			}
		} else {
			if (div.className == "form-group" || div.className == "form-group danger") div.className = "form-group danger";
			else {
				div.className = "form-group danger";
				count -= 12;
				progress.style.width = count + "%";
				progress.setAttribute("aria-valuenow", count);
				progress.innerHTML = count + "%";
			}
		}
	} else if (id == "surname") {
		if (input.length > 2) {
			if (div.className == "form-group" || div.className == "form-group danger") {
				div.className = "form-group success";
				count += 11;
				progress.style.width = count + "%";
				progress.setAttribute("aria-valuenow", count);
				progress.innerHTML = count + "%";
			}
		} else {
			if (div.className == "form-group" || div.className == "form-group danger") div.className = "form-group danger";
			else {
				div.className = "form-group danger";
				count -= 11;
				progress.style.width = count + "%";
				progress.setAttribute("aria-valuenow", count);
				progress.innerHTML = count + "%";
			}
		}
	} else if (id == "name") {
		if (input.length > 2) {
			if (div.className == "form-group" || div.className == "form-group danger") {
				div.className = "form-group success";
				count += 11;
				progress.style.width = count + "%";
				progress.setAttribute("aria-valuenow", count);
				progress.innerHTML = count + "%";
			}
		} else {
			if (div.className == "form-group" || div.className == "form-group danger") div.className = "form-group danger";
			else {
				if (div.className == "form-group" || div.className == "form-group danger") div.className = "form-group danger";
				else {
					div.className = "form-group danger";
					count -= 11;
					progress.style.width = count + "%";
					progress.setAttribute("aria-valuenow", count);
					progress.innerHTML = count + "%";
				}
			}
		}
	} else if (id == "pseudo") {
		if (input.length > 2) {
			if (div.className == "form-group" || div.className == "form-group danger") {
				div.className = "form-group success";
				count += 11;
				progress.style.width = count + "%";
				progress.setAttribute("aria-valuenow", count);
				progress.innerHTML = count + "%";
			}
		} else {
			if (div.className == "form-group" || div.className == "form-group danger") div.className = "form-group danger";
			else {
				if (div.className == "form-group" || div.className == "form-group danger") div.className = "form-group danger";
				else {
					div.className = "form-group danger";
					count -= 11;
					progress.style.width = count + "%";
					progress.setAttribute("aria-valuenow", count);
					progress.innerHTML = count + "%";
				}
			}
		}
	} else if (id == "email") {
		var reggex = new RegExp("[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?");
		
		if (reggex.test(input)) {
			if (div.className == "form-group" || div.className == "form-group danger") {
				div.className = "form-group success";
				count += 11;
				progress.style.width = count + "%";
				progress.setAttribute("aria-valuenow", count);
				progress.innerHTML = count + "%";
			}
		} else {
			if (div.className == "form-group" || div.className == "form-group danger") div.className = "form-group danger";
			else {
				div.className = "form-group danger";
				count -= 11;
				progress.style.width = count + "%";
				progress.setAttribute("aria-valuenow", count);
				progress.innerHTML = count + "%";
			}
		}
	} else if (id == "tel") {
		var reggex = new RegExp("0[1-9]([.-_ ]?[0-9]{2}){4}");
		
		if (reggex.test(input)) {
			if (div.className == "form-group" || div.className == "form-group danger") {
				div.className = "form-group success";
				count += 11;
				progress.style.width = count + "%";
				progress.setAttribute("aria-valuenow", count);
				progress.innerHTML = count + "%";
			}
		} else {
			if (div.className == "form-group" || div.className == "form-group danger") div.className = "form-group danger";
			else {
				div.className = "form-group danger";
				count -= 11;
				progress.style.width = count + "%";
				progress.setAttribute("aria-valuenow", count);
				progress.innerHTML = count + "%";
			}
		}
	} else if (id == "password") {
		if (input.length > 8 && input.length < 12) {
			if (div.className == "form-group" || div.className == "form-group danger") {
				div.className = "form-group success";
				count += 11;
				progress.style.width = count + "%";
				progress.setAttribute("aria-valuenow", count);
				progress.innerHTML = count + "%";
			}
		} else {
			if (div.className == "form-group" || div.className == "form-group danger") div.className = "form-group danger";
			else {
				div.className = "form-group danger";
				count -= 11;
				progress.style.width = count + "%";
				progress.setAttribute("aria-valuenow", count);
				progress.innerHTML = count + "%";
			}
		}
	} else if (id == "passwordVerif") {
		var inputPassword = document.getElementById("password").value;
		
		if ((inputPassword == input) && (input.length > 8 && input.length < 12)) {
			if (div.className == "form-group" || div.className == "form-group danger") {
				div.className = "form-group success";
				count += 11;
				progress.style.width = count + "%";
				progress.setAttribute("aria-valuenow", count);
				progress.innerHTML = count + "%";
			}
		} else {
			if (div.className == "form-group" || div.className == "form-group danger") div.className = "form-group danger";
			else {
				div.className = "form-group danger";
				count -= 11;
				progress.style.width = count + "%";
				progress.setAttribute("aria-valuenow", count);
				progress.innerHTML = count + "%";
			}
		}
	} else if (id == "cgu") {
		var inputBis = document.getElementById(id);
		
		if (input == "on") {
			if (inputBis.getAttribute("class") == "check") {
				count -= 11;
				inputBis.removeAttribute("class");
			} else {
				count += 11;
				inputBis.setAttribute("class", "check");
			}
			progress.style.width = count + "%";
			progress.setAttribute("aria-valuenow", count);
			progress.innerHTML = count + "%";
		}
	} else if (id == "title") {
		if (input.length > 2) {
			if (div.className == "form-group" || div.className == "form-group danger") {
				div.className = "form-group success";
				count += 15;
				progress.style.width = count + "%";
				progress.setAttribute("aria-valuenow", count);
				progress.innerHTML = count + "%";
			}
		} else {
			if (div.className == "form-group" || div.className == "form-group danger") div.className = "form-group danger";
			else {
				div.className = "form-group danger";
				count -= 15;
				progress.style.width = count + "%";
				progress.setAttribute("aria-valuenow", count);
				progress.innerHTML = count + "%";
			}
		}
	} else if (id == "descriptive") {
		if (input.length > 2) {
			if (div.className == "form-group" || div.className == "form-group danger") {
				div.className = "form-group success";
				count += 15;
				progress.style.width = count + "%";
				progress.setAttribute("aria-valuenow", count);
				progress.innerHTML = count + "%";
			}
		} else {
			if (div.className == "form-group" || div.className == "form-group danger") div.className = "form-group danger";
			else {
				div.className = "form-group danger";
				count -= 15;
				progress.style.width = count + "%";
				progress.setAttribute("aria-valuenow", count);
				progress.innerHTML = count + "%";
			}
		}
	} else if (id == "estimated-price") {
		if (input > 0) {
			if (div.className == "form-group" || div.className == "form-group danger") {
				div.className = "form-group success";
				count += 20;
				progress.style.width = count + "%";
				progress.setAttribute("aria-valuenow", count);
				progress.innerHTML = count + "%";
			}
		} else {
			if (div.className == "form-group" || div.className == "form-group danger") div.className = "form-group danger";
			else {
				div.className = "form-group danger";
				count -= 20;
				progress.style.width = count + "%";
				progress.setAttribute("aria-valuenow", count);
				progress.innerHTML = count + "%";
			}
		}
	} else if (id == "mini-price") {
		if (input > 0) {
			if (div.className == "form-group" || div.className == "form-group danger") {
				div.className = "form-group success";
				count += 20;
				progress.style.width = count + "%";
				progress.setAttribute("aria-valuenow", count);
				progress.innerHTML = count + "%";
			}
		} else {
			if (div.className == "form-group" || div.className == "form-group danger") div.className = "form-group danger";
			else {
				div.className = "form-group danger";
				count -= 20;
				progress.style.width = count + "%";
				progress.setAttribute("aria-valuenow", count);
				progress.innerHTML = count + "%";
			}
		}
	} else if (id == "date") {
        var inputDateD = document.getElementById("date-d").value;
        var inputDateH = document.getElementById("date-h").value;
        var inputDateM = document.getElementById("date-m").value;
		if (((inputDateD > 0 && inputDateD < 61) || (inputDateH > 0 && inputDateH < 25) || (inputDateM > 0 && inputDateM < 61))) {
            if (know == 0) count += 15;
            know = 1;
            progress.style.width = count + "%";
            progress.setAttribute("aria-valuenow", count);
            progress.innerHTML = count + "%";
		} else {
            if (know == 1) count -= 15;
            know = 0;
            progress.style.width = count + "%";
            progress.setAttribute("aria-valuenow", count);
            progress.innerHTML = count + "%";
		}
	} else if (id == "category") {
		if (input != "...") {
			if (div.className == "form-group" || div.className == "form-group danger") {
				div.className = "form-group success";
				count += 15;
				progress.style.width = count + "%";
				progress.setAttribute("aria-valuenow", count);
				progress.innerHTML = count + "%";
			}
		} else {
			if (div.className == "form-group" || div.className == "form-group danger") div.className = "form-group danger";
			else {
				div.className = "form-group danger";
				count -= 15;
				progress.style.width = count + "%";
				progress.setAttribute("aria-valuenow", count);
				progress.innerHTML = count + "%";
			}
		}
	}
	if (count == 100) {
		progress.setAttribute("class", "progress-bar progress-bar-success progress-bar-striped active");
		inputButton.removeAttribute("disabled");
	} else {
		progress.setAttribute("class", "progress-bar progress-bar-warning progress-bar-striped active");
		inputButton.setAttribute("disabled", true);
	}
}

function count() {
    var counter = document.getElementById("counter");
    console.log(counter);
}