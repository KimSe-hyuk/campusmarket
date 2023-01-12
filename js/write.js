let img_count = 0;
let uploaded_img_count = 0;
let filesArr = new Array();
let html = new Array();

/*추가된 파일 요소 생성*/
function fileUploadCheck(value) {
			 filesArr = new Array();
			 html = new Array();
        const target = document.getElementsByName('img_upload[]');
				img_count = target.length;
        $.each(target[0].files, function(index, file){
			if(img_count+uploaded_img_count > 4) {
				alert("이미지 파일은 최대 4개까지 등록할 수 있습니다.");
				//document.getElementById('file_upload').value="";
				return;
			}
					$('.fileList').empty();
            const fileName = file.name;
						html[img_count] = '<span class="img_file" id="'+img_count+'">' // class="img_file"
            html[img_count]  += '<img src="'+URL.createObjectURL(file)+'" name="imgs">' //미리보기 이미지
            //html[img_count]  += '<a href="#" id="removeImg" onclick="deleteImg()">╳</a>'; //이미지 삭제 버튼
						html[img_count]  += '</span>'

            const fileEx = fileName.slice(fileName.lastIndexOf(".") + 1).toLowerCase(); //파일 이름에서 확장자 부분만 가져오기
            if(fileEx != "jpg" && fileEx != "png" &&  fileEx != "gif" &&  fileEx != "bmp"){
                alert("파일은 (jpg, png, gif, bmp) 형식만 등록 가능합니다.");
                //resetFile();
                return false;
            }
			filesArr.push(html);
      $('.fileList').html(html); // fileList 클래스 태그 안에 위에서 입력한 html 생성
			img_count++; // 추가된 파일 갯수 +1
        });
    };


/*선택된 파일 삭제*/
		function deleteImg(){
			const flist = document.querySelectorAll(".fileList > span"); //.fileList에 있는 span 요소들 가져오기
			let files = $('#file_upload')[0].files;	//사용자가 입력한 파일을 변수에 할당
			console.log(files);
			let fileArray = Array.from(files);	//변수에 할당된 파일을 배열로 변환(FileList -> Array)
			console.log(fileArray);
			flist.forEach((el, index) => { // 가져온 요소들로 반복문을 통해 인덱스 가져옴
				el.onclick = () => { // 해당 인덱스의 요소가 클릭되면
					console.log(fileArray);
					html.splice(index, 1);
					fileArray.splice(index, 1);	//해당하는 index의 파일을 배열에서 제거
					$('.fileList').html(html); // 제거한걸 다시 .fileList에 적용시킴
				}
			});
			img_count--; // 추가된 파일 갯수 -1
			if(img_count <= 0){
				img_count = 0;
			}
		}


	function boardUpdateImg(value) {
			uploaded_img_count = value;
			console.log(uploaded_img_count);
	}

function UpdateDeleteImg(index){
	const flist = document.querySelectorAll(".upload_fileList > span"); //.upload_fileList에 있는 span 요소들 가져오기
	console.log(flist);
	let files = $('.img_file')[0];	//사용자가 입력한 파일을 변수에 할당
	console.log(files);
	let fileArray = Array.from(flist);	//변수에 할당된 파일을 배열로 변환(FileList -> Array)
	console.log(fileArray);
	$('#'+index+'').remove();
	uploaded_img_count--; // 추가된 파일 갯수 -1
	if(img_count <= 0){
		uploaded_img_count = 0;
	}
}


/*게시물 삭제 할 것인지*/
function board_delete_click(b_num) {
	if (!confirm('해당 게시물을 삭제 하시겠습니까?')){
		event.preventDefault();
	}else{
		console.log('item_delete.php?object_num='+b_num+'');
		location.href='item_delete.php?object_num='+b_num+'';
	}
}



/*item_slider.js*/
/*게시물 상세보기부분 슬라이드*/
	const board = document.querySelector('#board_img_wrap');
	const slide = document.querySelector('.slides');
	const boardImgs = document.querySelectorAll('.view_img');
	let currentIndex = 0; // 현재 슬라이드 화면 인덱스

	const buttonLeft = document.querySelector('#left_btn');
	const buttonRight = document.querySelector('#right_btn');
	const slideImgs = document.querySelectorAll('.slide_imgs');


/*이미지 슬라이드*/
function boardImgChange(){
	if (board) {
		boardImgs.forEach((boardImgs) => {
		  boardImgs.style.width = `${board.clientWidth}px`; // inner의 width를 모두 outer의 width로 만들기
		})

		slide.style.width = `${board.clientWidth * boardImgs.length}px`; // innerList의 width를 inner의 width * inner의 개수로 만들기

		/*
		  버튼에 이벤트 등록하기
		*/

		buttonLeft.addEventListener('click', () => {
		  currentIndex--;
		  currentIndex = currentIndex < 0 ? 0 : currentIndex; // index값이 0보다 작아질 경우 0으로 변경
		  slide.style.marginLeft = `-${board.clientWidth * currentIndex}px`; // index만큼 margin을 주어 옆으로 밀기
		  clearInterval(interval); // 기존 동작되던 interval 제거
		  interval = getInterval(); // 새로운 interval 등록
		});

		buttonRight.addEventListener('click', () => {
		  currentIndex++;
		  currentIndex = currentIndex >= boardImgs.length ? boardImgs.length - 1 : currentIndex; // index값이 inner의 총 개수보다 많아질 경우 마지막 인덱스값으로 변경
		  slide.style.marginLeft = `-${board.clientWidth * currentIndex}px`; // index만큼 margin을 주어 옆으로 밀기
		  clearInterval(interval); // 기존 동작되던 interval 제거
		  interval = getInterval(); // 새로운 interval 등록
		});

			function click_img(index){
				slideImgs[index].addEventListener('click', () => {
					currentIndex = index;
					slide.style.marginLeft = `-${board.clientWidth * currentIndex}px`;
					clearInterval(interval); // 기존 동작되던 interval 제거
					interval = getInterval(); // 새로운 interval 등록
				});
			}

		for (var i=0; i<slideImgs.length; i++) {
			click_img(i);
		}
	}
}
/*
	주기적으로 화면 넘기기
*/
const getInterval = () => {
	if (board) {
	  return setInterval(() => {
		currentIndex++;
		currentIndex = currentIndex >= boardImgs.length ? 0 : currentIndex;
		slide.style.marginLeft = `-${board.clientWidth * currentIndex}px`;
	}, 4000);
	}
}
