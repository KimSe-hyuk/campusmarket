

/*세션가져오기*/
//let loginState = window.sessionStorage.getItem("userName");


/*지원 연결*/
function reportCheck(loginState){
	if(loginState==''){  //로그인 상태X
	  location.replace("/campusmarket/member/login_main.php");
	}
	else{ //로그인 상태O
	   location.replace("/campusmarket/report_list.php");
	}
}

/*물건올리기*/
function objectCheck(loginState){
	if(loginState==''){  //로그인 상태X
	  location.replace("/campusmarket/member/login_main.php");
	}
	else{ //로그인 상태O
	   location.replace("/campusmarket/write1.php");
	}
}

/*채팅*/
function chattingCheck(loginState){
	if(loginState==''){  //로그인 상태X
	  location.replace("/campusmarket/member/login_main.php");
	}
	else{ //로그인 상태O
	   location.replace("/campusmarket/chat/chat.php");
	}
}

function profileDisplay() {
	var asd = document.getElementById("userDiv");
	if (asd.style.display == 'none') {
		asd.style.display = 'block';
	} else {
		asd.style.display = 'none';
	}
}
