<?php
 session_start();
if ($_SESSION["userName"]!="admin"){
?>
<script>  
   history.back();
</script>
<?php

}
?>
<a href="../index.php">메인으로</a>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

</head>

<body>
 

    <form method="get">모두체크 물건게시판
    <input type='checkbox'  value='모두체크' onclick='selectAllObject(this)' /> <b>
	    <table>

        <th>체크</th>
        <th>번호 </th>
        <th>제목</th>
        <th>내용</th>
        <th>가격</th>
        <th>이미지</th>
        <th>카테고리</th>
        <th>구매or판매</th>
        <th>작성자번호</th>
        <th>날짜</th>
        <th>판매여부</th>
		<th>조회수</th>
        <?php 
 require("db_connect.php");
 
 $board_numLines = 10; // 리스트 한 페이지에 나올 행의 수 (글의 수)
 $board_numLinks = 4; // 한 페이지에 표시할 페이지 링크 갯수
 
 $page = empty($_REQUEST["page"]) ? 1 : $_REQUEST["page"];
 $start = ($page - 1) * $board_numLines;
 
    $query = $db->query("select * from board_object as B left join file as F on F.f_num = B.object_num GROUP by object_num limit $start, $board_numLines");
	
    while ($row = $query->fetch()) {
 						$photoArr = explode(",",$row['object_img']);
						 ?>
   <tr>
					<td ><input type="checkbox" name="board_object[]" value="<?=$row[0]?>"></td>
 
                    <td onclick="location.href='../item.php?object_num=<?=$row['object_num']?>'" class="item_name"><?=$row[0]?></td>
                 
                    <td class="item_name"><?=$row[1]?></td>
                    <td class="item_name"><?=$row[2]?></td>
                    <td class="item_price"><?=number_format($row[3])?> 원</td>
                    <td class="item_name"> <img style="width:50px" src='<?= $row[f_img]?"../files/$row[member_num]/$row[f_img]" : "../image/null.png"?>' /></td>
                    <td class="item_name"><?=$row[5]?></td>
                    <td class="item_name"><?=$row[6]?></td>
                    <td class="item_name"><?=$row[7]?></td>
                    <td class="item_name"><?=$row[8]?></td>
                    <td class="item_name"><?=$row[9]?></td>
                    <td class="item_name"><?=$row[10]?></td>
 
   </tr>
        <?php    
    }  
?>
    </table>

        <input type="submit" value="삭제" formaction="deleate.php">

    </form>
    <?php    
    $firstLink = floor(($page - 1) / $board_numLinks) * $board_numLinks + 1;
    $lastLink = $firstLink + $board_numLinks - 1;
    
    $board_numRecords = $db->query("select count(*) from board_object ")->fetchColumn();
    $board_numPages = ceil($board_numRecords / $board_numLines);
    if ($lastLink > $board_numPages) {
        $lastLink = $board_numPages;
    }
?>

<div style="text-align:center;padding: 11px;">
<?php    
    if ($firstLink > 1) {
?>
        <a href="list.php?page=<?=$firstLink - $board_numLinks?>">이전</a>
<?php    
    }
    
    for ($i = $firstLink; $i <= $lastLink; $i++) {
?>    
        <a href="list.php?page=<?=$i?>"><?=($i == $page) ? "<u>$i</u>" : $i?></a>
<?php
    }
    
    if ($lastLink < $board_numPages) {
?>
        <a href="list.php?page=<?=$firstLink + $board_numLinks?>">다음</a>
<?php
    }
?>       
</div> 

    <br>
    <br>
	
<table>
        <th>체크</th>
        <th>번호 </th>
        <th>작성자번호</th>
        <th>물건번호</th>
        <th>제목</th>
        <th>내용</th>
		<th>날짜</th>
		<th>카테고리</th>
		<th>조회수</th>
    <form method="post" action="deleate.php">모두체크 학생게시판
    <input type='checkbox'  value='모두체크' onclick='selectAllStudent(this)' /> <b>

        <?php 
    $query = $db->query("select * from board_student");
	
    while ($row = $query->fetch()) {

						 ?>

        <tr>
					<td> <input type="checkbox" name="board_student[]" value="<?=$row[0]?>"></td>
                    <td  onclick="location.href='../board_view.php?board_num=<?=$row['board_num']?>'" class="item_name"><?=$row[0]?> </td>
                    <td class="item_name"><?=$row[1]?> </td>
                    <td class="item_name"><?=$row[2]?> </td>
                    <td class="item_name"><?=$row[3]?> </td>
                    <td class="item_name"><?=$row[4]?> </td>
                    <td class="item_name"><?=$row[5]?> </td>
                    <td class="item_name"><?=$row[6]?> </td>
                    <td class="item_name"><?=$row[7]?> </td>
		</tr>
        <?php    
    }
?>
</table>
        <input type="submit" value="삭제">
    </form>
    <br>
    <br>

    <form method="get">모두체크 회원정보
        <input type='checkbox'  value='모두체크' onclick='selectAllmember(this)' /> <b>
            <table>

                <th>체크</th>
                <th>별명 </th>
                <th>번호</th>
                <th>email</th>
                <th>pw</th>
                <th>member_img</th>
                <th>regist_date</th>
                <th>대학번호</th>
                <th>신고 횟수</th>
                <th>secession</th>
                <?php 
    $query = $db->query("select * from member order by member_num");
	
    while ($row = $query->fetch()) {

						 ?>


                <tr>
                    <td><input class="a" type="checkbox" name="member[]" value="<?=$row[0]?>"></td>
                    <td><input name="nickname[]" value="<?=$row[2]?>" /></input> </td>
                    <td onclick="location.href='myList.php?member_num=<?=$row['member_num']?>'" class="item_name"><?=$row[0]?></td>
            

                    <td class="item_name"><?=$row[3]?> </td>
					<td class="item_name"><?=$row[1]?> </td>
                    <td class="item_name"><?=$row[4]?> </td>
                    <td class="item_name"><?=$row[5]?> </td>
                    <td class="item_name"><?=$row[6]?> </td>
                    <td class="item_name"><?=$row[7]?> </td>
                    <td class="item_name"><?=$row[8]?> </td>
                    <td class="item_name"><?=$row[9]?> </td>
                </tr>


                <?php    
    }
?>
            </table>
            <input type="submit" value="삭제" formaction="deleate.php">
			 <input type="submit" value="닉네임수정" formaction="update.php">
            
    </form>
 
    <br>
    <br>
    <form method="get">모두체크 신고처리 목록
    <input type='checkbox'value='모두체크' onclick='selectAllaeported(this)' /> <b>

    <table>

        <th>체크</th>
        <th>번호 </th>
        <th>제목</th>
        <th>신고된사람 닉네임</th>
        <th>신고자번호</th>
        <th>물건번호</th>
        <th>학생공간번호</th>
        <th>내용</th>
        <th>날짜</th>
        <th>카테고리</th>
        <th>체크여부</th>
        <?php 
    $query = $db->query("select * from board_reports where report_check=0");
	
    while ($row = $query->fetch()) {

						 ?>


    
		 <tr>
		  <td><input type="checkbox" name="board_reportss[]" value="<?=$row[0]?>"></td>
           
         
				
                    <td class="item_name"><?=$row[0]?> </td>
                    <td class="item_name"><?=$row[1]?> </td>
					<td onclick="location.href='myList.php?nickname=<?=$row[2]?>'" class="item_name"><?=$row[2]?></td>
                    <td onclick="location.href='myList.php?member_num=<?=$row[3]?>'" class="item_name"><?=$row[3]?></td>
                    <td  onclick="location.href='item.php?bid=object&object_num=<?=$row['4']?>'" class="item_name"><?=$row[4]?> </td>
					<td  onclick="location.href='board_view.php?bid=student&board_num=<?=$row['5']?>'" class="item_name"><?=$row[5]?> </td>
                    <td class="item_name"><?=$row[6]?> </td>
                    <td class="item_name"><?=$row[7]?> </td>
                    <td class="item_name"><?=$row[8]?> </td>
                    <td class="item_name"><?=$row[9]?> </td>

	  </tr>
          
	<?php
		  
    }
?>
    </table>
 
            <input  type="submit"  value="신고 접수" formaction="report.php"></input>
        </form>



<form method="get">모두체크 신고된 사람들
    <input type='checkbox'value='모두체크' onclick='selectAllReported(this)' /> <b>

    <table>

        <th>체크</th>
        <th>번호 </th>
        <th>제목</th>
        <th>신고된사람 닉네임</th>
        <th>신고자번호</th>
        <th>물건번호</th>
        <th>학생공간번호</th>
        <th>내용</th>
        <th>날짜</th>
        <th>카테고리</th>
        <th>체크여부</th>
        <?php 
    $query = $db->query("select * from board_reports where report_check=1");
	
    while ($row = $query->fetch()) {

						 ?>


    
		 <tr>
		  <td><input type="checkbox" name="board_reports2[]" value="<?=$row[0]?>"></td>
           
         
				
                    <td class="item_name"><?=$row[0]?> </td>
                    <td class="item_name"><?=$row[1]?> </td>
					<td onclick="location.href='myList.php?nickname=<?=$row[2]?>'" class="item_name"><?=$row[2]?></td>
                    <td onclick="location.href='myList.php?member_num=<?=$row[3]?>'" class="item_name"><?=$row[3]?></td>
                    <td  onclick="location.href='item.php?bid=object&object_num=<?=$row['4']?>'" class="item_name"><?=$row[4]?> </td>
					<td  onclick="location.href='board_view.php?bid=student&board_num=<?=$row['5']?>'" class="item_name"><?=$row[5]?> </td>
                    <td class="item_name"><?=$row[6]?> </td>
                    <td class="item_name"><?=$row[7]?> </td>
                    <td class="item_name"><?=$row[8]?> </td>
                    <td class="item_name"><?=$row[9]?> </td>

	  </tr>
          
	<?php
		  
    }
?>
    </table>
            <input type="submit" value="삭제" formaction="deleate.php">
</form>
</body>

</html>

<script>
        function selectAllObject(selectAll) {
            const checkboxes = document.getElementsByName('board_object[]');

            checkboxes.forEach((checkbox) => {
                checkbox.checked = selectAll.checked;
            })
        }
       
        function selectAllStudent(selectAll) {
            const checkboxes = document.getElementsByName('board_student[]');

            checkboxes.forEach((checkbox) => {
                checkbox.checked = selectAll.checked;
            })
        }
        function selectAllmember(selectAll) {
            const checkboxes = document.getElementsByName('member[]');

            checkboxes.forEach((checkbox) => {
                checkbox.checked = selectAll.checked;
            })
        }
        function selectAllaeported(selectAll) {
            const checkboxes = document.getElementsByName('board_reportss[]');

            checkboxes.forEach((checkbox) => {
                checkbox.checked = selectAll.checked;
            })
        } 
        function selectAllReported(selectAll) {
            const checkboxes = document.getElementsByName('board_reports2[]');

            checkboxes.forEach((checkbox) => {
                checkbox.checked = selectAll.checked;
            })
        }     
      
    </script>