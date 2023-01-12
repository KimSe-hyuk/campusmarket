<a href="list.php">홈짱닷컴</a>
<?php 
 require("db_connect.php");
 
 $member_num = $_REQUEST["member_num"];
    $query = $db->query("select * from member where member_num=$member_num");
	
    while ($row = $query->fetch()) {

						 ?>	



					 <ul>
							<li class="item_content">
								<span class="item_name"><?=$row[0]?></span>
								<span class="item_name"><?=$row[1]?></span>
								<span class="item_name"><?=$row[2]?></span>
								<span class="item_name"><?=$row[3]?></span>
								<span class="item_name"><?=$row[4]?></span>
								<span class="item_name"><?=$row[5]?></span>
								<span class="item_name"><?=$row[6]?></span>
								<span class="item_name"><?=$row[7]?></span>
								<span class="item_name"><?=$row[8]?></span>
								<span class="item_name"><?=$row[9]?></span>

							</li>
						</ul>
<?php    
    }
?>
