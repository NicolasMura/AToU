function retrieve()
{

	var parameters = location.search.substring(1).split("&");
	var temp = parameters[0].split("=");
	mail = unescape(temp[1]);

	temp = parameters[1].split("=");
	sex = unescape(temp[1]);

	temp = parameters[2].split("=");
	city = unescape(temp[1]);

	var data =  document.getElementById("data");

	data.innerHTML = "Email: " + mail + "<brr";
	data.innerHTML += "Genre: " + sex + "<br>";
	data.innerHTML += "City: " + city + "<br>";

}

retrieve();