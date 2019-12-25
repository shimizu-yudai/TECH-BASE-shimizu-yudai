<html>
<head>
<body>
<form method="2post" action="mission_3-5-2.php" >
<div>
<?php
		$dsn="TECH-BASE-shimizu-yudai";
		$user="shimizu-yudai";
		$password="cmt72635";
 //編集元のテキストを、投稿フォームに表示させる
 //2.編集フォームで処理を分岐させる
if(isset($_POST["hensyuuNO"])){
		//3.ファイルを一行ずつ読み込み、配列関数に代入する
			$filename="mission_3-5.txt";
			$fp=fopen($filename,"r");
			while(!feof($fp)){
				$txt=fgets($fp);
			}
			fclose($fp);
		//3. ファイルを開き、先ほどの配列の要素数（＝行数）だけループさせる
			//foreach ((array)$fp as $num){
				
				$content=file($filename);
				foreach($content as $line2){
				//4.ループ処理内：区切り文字＜＞で分割して、投稿番号を取得 
				$data=explode("<>",$line2);
				//5.ループ処理内：投稿番号と編集対象番号を比較。
				//イコールの場合はその投稿の「名前」と「コメント」を取得
						if($_POST["hensyuu"]==$data[0]){
						//6.既存の投稿フォームに、上記で取得した「名前」と「コメント」の
						//内容が既に入っている状態で表示させる
							$edit_num=$_POST["edit_num"];
							$edit_num=$data[0];$name=$data[1];$comment=$data[2];$pass=$data[4]; }
					}
					}else{

					}
																			
      
    
 	  

?>
【投稿フォーム】<br />
<input type="text"  name="name" placeholder="名前" 
	value="<?php if(!empty($name)){echo $name; }else{}?>"><br />
<input type="text"  name="comment" placeholder="コメント" 
	value="<?php if(!empty($comment)){echo $comment; }else{}?>" ><br />
<input type="password" name="pass"size="30" minlength="5" pattern="[a-zA-Z0-9]+" 
 title="パスワードは5文字以上の半角英数字で入力してください" placeholder="パスワード" 
    value="<?php if(!empty($pass)){echo $pass; }else{}?>" >
<input type="hidden" name="edit_num" 
	value="<?php if(!empty($edit_num)) {echo $edit_num;
					}else{}
	?>">
	
	


<input type="submit" name="submit1" value="送信する"/><br />

<form action="" method="POST" ><br /><br />

【削除フォーム】<br />
<input type="text"  name="deleteNo" placeholder="削除対象番号"><br/>
<input type="password" name="deletepass" placeholder="パスワード"><br/>

<input type="submit"name="delete" value="削除"/><br/><br/>


【編集フォーム】<br />
<input type="text" name="hensyuu" placeholder="編集対象番号"><br/>
<input type="password" name="hensyupass" placeholder="パスワード"><br/>

<input type="submit" name="hensyuuNO" value="編集"><br/><br/>

-------------------------------------------------------------<br/>
【投稿一覧】

</div>
</form>

<?php

//新規投稿と編集

$filename="mission_3-5.txt";
if(isset($_POST["submit1"])){
if(!empty($_POST["name"])){
	if(!empty($_POST["comment"])){
	if(!empty($_POST["pass"])){
	//編集と新規投稿を分ける　編集内容が問題ない場合：
	if(!empty($_POST["edit_num"])){
		//投稿番号と編集対象番号を比較して、
		$filename="mission_3-5.txt";
			$fp=fopen($filename,"r");
			fclose($fp);
		//ファイルを開き、先ほどの配列の要素数（＝行数）だけループさせる
			//1.テキストファイル を読み込む
				$content=file($filename);
				//2.wモードで開いて中身を空にする
				$fp=fopen("mission_3-5.txt","w");
				//3.手順1で読み込んだ配列をループする
				foreach($content as $line2){
				
				//等しい場合は、ファイルに書き込む内容を送信内容に差し替える
				//ファイルの内容を保存して//すべて消す		
					$data=explode("<>",$line2);
					//投稿番号と編集番号が一致していたら、新規投稿と同じようにフォームから受け取った内容を書き込む
					$hensyu_pass=$_POST["pass"];
					if($hensyu_pass==$data[4]){
						$edit_num=$_POST["edit_num"];
						if($edit_num==$data[0]){					
							//番号が一致したら書き込み、
							fwrite($fp,$data[0]."<>".$_POST["name"]."<>".$_POST["comment"]."<>".date("Y-m-d H:i:s").
								"<>".$_POST["pass"]."<>");
					    	fwrite($fp,"\n");
							
					 	}else{//一致しなければ元の内容を書き込む
						fwrite($fp,$data[0]."<>".$data[1]."<>".$data[2]."<>".$data[3]."<>".$data[4]."<>");
						fwrite($fp,"\n");
						}	
					}else{fwrite($fp,$data[0]."<>".$data[1]."<>".$data[2]."<>".$data[3]."<>".$data[4]."<>");
						fwrite($fp,"\n");
					}					
				}fclose($fp);
	}else{$fp=fopen("mission_3-5.txt","r");
		fclose($fp);
		$filename="mission_3-5.txt";
	//ファイルを開き、先ほどの配列の要素数（＝行数）だけループさせる
		//1.テキストファイル を読み込む
		$content=count(file($filename));
		if($content!=0){//ファイルの行数から初回投稿か判断、2回目以降の投稿の時は最後の投稿番号から取得する
			$content=file($filename);
			$end=$content[count($content)-1];//最後の投稿を添え字で指定する　添え字は0から始まるので、count関数で導出した行数から-1している
			$last_contents=explode("<>",$end);
			$last_num=$last_contents[0];
			$num=$last_num+1;
		}else{//初回投稿の時は１を代入する
			$num=1;
		}
		$fp=fopen($filename,'a');
		fwrite($fp,$num."<>".$_POST["name"]."<>".$_POST["comment"]."<>".date("Y-m-d H:i:s")."<>".$_POST["pass"]."<>" );
		fwrite($fp,"\n");
		fclose($fp);}
	}else{ }
	}else{ }
}else{ }
}else{	
}
?>

<?php
//テキストファイルの読み込み
$fp=fopen("mission_3-5.txt","r");
while($line=fgets($fp)){
 $line2=explode("<>",$line);
 print_r($line2[0]."".$line2[1]."".$line2[2]."".$line2[3]);
 print_r("<br>");
}
fclose($fp);

?>

<?php
//1削除機能の追加
	if (isset($_POST["delete"])){
		//2
		if(!empty($_POST["deletepass"])){
			$filename="mission_3-5.txt";
			//3
			$fp=fopen($filename,"r");
			fclose($fp);
			//4
				$content=file($filename);
				//5wモードで開いて中身を空にする
				$fp=fopen("mission_3-5.txt","w");
				//6
				foreach($content as $line2){
					//7
					$data=explode("<>",$line2);
					$deletenumber=$_POST["deleteNo"];
					//8 削除指定番号と存在番号の比較
					if($deletenumber==$data[0]){
						$delete_pass=$_POST["deletepass"];
						//9パスワードが一致するかしないか
						if($delete_pass==$data[4]){ echo"削除しました";
							//10パスワードが一致しないので書き込み
							}else{fwrite($fp,$data[0]."<>".$data[1]."<>".$data[2]."<>".$data[3]."<>".$data[4]."<>");	
								  fwrite($fp,"\n");
									}//11指定番号が存在しないので書き込み？
									}else{fwrite($fp,$data[0]."<>".$data[1]."<>".$data[2]."<>".$data[3]."<>".$data[4]."<>");
										  fwrite($fp,"\n");
									}
				//12wモードを閉じる	
					}fclose($fp);
		}else{
		}					
}else{
}

?>


</table>
</body>
</html>


