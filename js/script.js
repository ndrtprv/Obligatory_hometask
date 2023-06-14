var lnk = document.getElementById("dr");
var mUl = document.getElementById("myUl");
var flag = 0;

function clickMen() {
	if (flag === 0) {
		flag = 1;
		lnk.classList.add("show");
		lnk.setAttribute("aria-expanded", "true");
		mUl.classList.add("show");
		mUl.setAttribute("data-bs-popper", "static");
	} else {
		flag = 0;
		lnk.classList.remove("show");
		lnk.setAttribute("aria-expanded", "false");
		mUl.classList.remove("show");
		mUl.removeAttribute("data-bs-popper");
	}
}

function clickLogin() {
	var url = 'log_in.php';
	
	location.href = url;
}