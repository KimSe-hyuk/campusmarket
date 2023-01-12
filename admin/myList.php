<a href="list.php">돌아가기</a>

    <form method="get">
 <table>

                <th>체크</th>
                <th>별명 </th>
                <th>번호</th>
                <th>pw</th>
                <th>email</th>
                <th>member_img</th>
                <th>regist_date</th>
                <th>대학번호</th>
                <th>신고 횟수</th>
                <th>secession</th>
<?php 
 require("db_connect.php");
 $nickname=empty($_REQUEST["nickname"]) ? "" : $_REQUEST["nickname"];
 if( $nickname!=""){
    $query = $db->query("select * from member where nickname='$nickname'");
    if ($row = $query->fetch()) {
        $member_num    = $row['member_num'];
    }
    
 }else{
    $member_num=empty($_REQUEST["member_num"]) ? "" : $_REQUEST["member_num"];
 
 }


    $query = $db->query("select * from member where member_num=$member_num");
	
    while ($row = $query->fetch()) {

						 ?>	



				  <tr>
                    <td><input type="checkbox" name="member[]" value="<?=$row[0]?>" checked></td>
                    <td><input name='nick' class="item_name" value="<?=$row[2]?>" /></input> </td>
                    <td class="item_name"><?=$row[0]?></td>
                    <td class="item_name"><?=$row[1]?> </td>
                    <td class="item_name"><?=$row[3]?> </td>
                    <td class="item_name"><?=$row[4]?> </td>
                    <td class="item_name"><?=$row[5]?> </td>
                    <td class="item_name"><?=$row[6]?> </td>
                    <td><input name='report'  class="item_name" value="<?=$row[7]?>" /> </td>
                    <td><input name='secion'  class="item_name" value="<?=$row[8]?>" /> </td>
                </tr>
<?php    
    }
?>
</table>
   <input type="submit" value="삭제" formaction="deleate.php">
    <input type="submit" value="수정" formaction="update.php">
   </form>
<br>
<br>
    <form method="get">
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
 
    $query = $db->query("select * from board_object as B left join file as F on F.f_num = B.object_num  where member_num=$member_num GROUP by object_num");
	
    while ($row = $query->fetch()) {
 						$photoArr = explode(",",$row['object_img']);
						 ?>
   <tr>
					<td ><input type="checkbox" name="board_object[]" value="<?=$row[0]?>"></td>
 
                    <td onclick="location.href='item.php?object_num=<?=$row['object_num']?>'" class="item_name"><?=$row[0]?></td>
                    <td class="item_price"><?=number_format($row[3])?> 원</td>
                    <td class="item_name"><?=$row[1]?></td>
                    <td class="item_name"><?=$row[2]?></td>
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
    <br>
    <br>
	    <table>

        <th>번호</th>
        <th>판매자번호 </th>
        <th>구매자 번호</th>
        <th>물건번호</th>
        <th>날짜</th>
<?php

    $query = $db->query("select * from chatroom where seller_num=$member_num or buyer_num=$member_num");

    while ($row = $query->fetch()) {
		
						 ?>	
			 
			 <tr>
								<td onclick="location.href='myList.php?member_num=<?=$member_num?>&chatroom=<?=$row[chatroom_id]?>'"class="item_name"><?=$row[0]?></td></a>
								<td class="item_name"><?=$row[1]?></td>
								<td class="item_name"><?=$row[2]?></td>
								<td class="item_name"><?=$row[3]?></td>
								<td class="item_name"><?=$row[4]?></td>
			 </tr>
<?php    
    }
?>
    </table>
 
<br>
<br>
 

 	    <table>

        <th>번호</th>
        <th>날짜 </th>
        <th>채팅방번호</th>
        <th>내용</th>
        <th>닉네임</th>
		   <th>유저 이미지</th>
		 <th>물건제목</th>
		 <th>물건 이미지</th>
<?php
	$chatroom_id = empty($_REQUEST["chatroom"]) ? 0 : $_REQUEST["chatroom"];
    $query = $db->query("select * from (((chatroomessge left join member on chatroomessge.memberId=member.member_num)left join chatroom on chatroomessge.chatRoomId = chatroom.chatroom_id) 
    left join board_object on chatroom.object_num= board_object.object_num ) left join file as F on F.f_num =board_object.object_num
    where   chatRoomId like '$chatroom_id%' ");
	
    while ($row = $query->fetch()) {	$photoArr = explode(",",$row['object_img']);
						 ?>	
 <tr>
								<td class="item_name"><?=$row[id]?></td>
								<td class="item_name"><?=$row[regDate]?></td>
								<td class="item_name"><?=$row[chatRoomId]?></td>
								<td class="item_name"><?=$row[body]?></td>
								<td class="item_name"><?=$row[nickname]?></td>	
								<td><img style="width:50px" src='/campusmarket/user_img/<?=$row[member_img]?>' /></td>
								<td class="item_name"><?=$row[object_name]?></td>	
								<td class="item_name"> <img style="width:50px" src='<?= $row[f_img]?"../files/$row[member_num]/$row[f_img]" : "../image/null.png"?>' /></td>
		 </tr>
<?php    
    }
?>
    </table>
 