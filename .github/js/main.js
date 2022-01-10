function show_hide_password(target){
	var input = document.getElementById('password-input');
	if (input.getAttribute('type') == 'password') {
		target.classList.add('view');
		input.setAttribute('type', 'text');
	} else {
		target.classList.remove('view');
		input.setAttribute('type', 'password');
	}
	return false;
}

function copyElementText(id){
    var text = document.getElementById(id).innerText;
    var elem = document.createElement("textarea");
    document.body.appendChild(elem);
    elem.value = text;
    elem.select();
    document.execCommand("copy");
    document.body.removeChild(elem)
}

async function verUser() {


}


/*async function addUser() {
    const username = document.getElementById(elementid: 'username').value,
        password = document.getElementById(elementid: 'password').value;

    let formData = new FormData();
    formData.append( name: 'username', username);
    formData.append( name: 'password', password);

    const res = await fetch(input: 'http://lightfire.duckdns.org/login', init:{
        method: 'POST',
        body: formData
    });

    const data = await res.json();

}*/

