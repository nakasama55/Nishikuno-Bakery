<?php //▼▼ 既存ページヘ埋め込み時はまるっとコピペ下さい （この行も含みページ最上部に）※.phpでかつUTF-8のページのみ可▼▼
//※逆にこのページに対して既存のページのhtmlを記述する形でももちろんOKです。
//----------------------------------------------------------------------
// 詳細ページ（ポップアップと兼用）
// 設定ファイルの読み込みとページ独自設定
//----------------------------------------------------------------------
include_once("./pkobo_news/admin/include/config.php");//（必要に応じてパスは適宜変更下さい）
$img_updir = './pkobo_news/upload';//画像保存パス（必要に応じてパスは適宜変更下さい）

$id = (!empty($_GET['id'])) ? h($_GET['id']) : exit('パラメータがありません');
$getFormatDataArr = getLines2DspData($file_path,$img_updir,$config,$id);
$dataArr = (!empty($getFormatDataArr)) ? $getFormatDataArr : exit('データが存在しません');
//----------------------------------------------------------------------
// 設定ファイルの読み込みとページ独自設定
//----------------------------------------------------------------------
//▲▲ コピペここまで ▲▲（この行も含む）?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ja" lang="ja">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo h(strip_tags($dataArr['title']));//タイトルを表示（必要に応じてコピペ下さい）?>｜詳細ページ</title>
<meta http-equiv="Content-Style-Type" content="text/css" />
<meta name="Keywords" content="" />
<meta name="Description" content="<?php echo h(strip_tags($dataArr['title']));//タイトルを表示（必要に応じてコピペ下さい）?>" />
<meta http-equiv="Content-Script-Type" content="text/javascript" />

<!--▼▼CSS。既存ページヘの埋め込み時はコピペ下さい（head部分に）▼▼-->
<style type="text/css">
/* CSSは必要最低限しか指定してませんのでお好みで（もちろん外部化OK） */
body{
	font-family:"Kiwi Maru", "Yu Gothic", 游ゴシック, YuGothic, 游ゴシック体,"メイリオ", Meiryo, Osaka, "ＭＳ Ｐゴシック", "MS PGothic", sans-serif;
	font-size:16px;
	color:#3d3d3d;
}

/*中里フォント追記*/
@font-face {
    font-family: "Kiwi Maru";
    src: url(../font/KiwiMaru-Medium.ttf)
    format("truetype");
}

@font-face {
    font-family: "Prestige Elite Std";
    src: url(../font/prestige.ttf)
    format("truetype");
}

h2{
	font-size:18px;
	color:#0d559c;
	margin:10px 0px 10px 0;
	font-weight:normal;
	text-align:center;
	/*border:1px solid #3D79B6;*/
	border-bottom:2px solid #0d559c;
	padding:5px 10px;
	/*text-shadow:1px 1px 0px #fff;*/
	
	filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#ffffff', endColorstr='#ffffff',GradientType=0 ); /* IE6-9 */
}

/*中さん追記 ここから*/

h6 {
    color: #3d3d3d;
    font-size: 0.75em;  /*12px*/
    text-align: center;
    margin-bottom: 30px;
    font-weight: 400;
}

h6 strong {
    font-family: "Prestige Elite Std";
    color: #0d559c;
    font-size: 2.5em;  /*40px*/
}

/*中さん追記 ここまで*/

#up_ymd{
	text-align:right;
	font-size:13px;
	margin:5px 10px;
}
.detailUpfile{
	margin:5px 0 35px;
	text-align:center;
}
.backORcloseBtn{
	text-align:center;
	line-height:100%;
	margin-top:15px;
}
.backORcloseBtn a{
	display:inline-block;
	padding:4px 0.938em;  /*15px*/
	border:1px solid #0d559c;
	color:#0d559c;
	/*border-radius:6px;*/
	text-decoration:none;
	font-size:1.125em;  /*18px*/
}
.detailUpfile img{
	max-width:100%;
	height:auto;
}
.pNav{
	font-size:11px;	
}
</style>
<!--▲▲CSS。既存ページヘの埋め込み時　コピペここまで（head部分に）▲▲-->

</head>
<body>
<h6><strong>News</strong><br>西久保ベーカリーからのおしらせ</h6>
<!--▼▼埋め込み時はここから以下をコピーして任意の場所に貼り付けてください（html部は自由に編集可）▼▼-->

<?php if(!$copyright){echo $warningMesse;exit;}else{ ?>

<?php if($config['popupFlag'] == 0){ //ポップアップ表示の場合は表示しない?>
<div class="pNav"><a href="./">トップページ</a> &gt; <a href="news.php">お知らせ一覧</a> &gt; <?php echo h(strip_tags($dataArr['title']));?></div><!-- パンくずナビ（必要に応じて変更、削除下さい） -->
<?php } ?>
<h2><?php echo h(strip_tags($dataArr['title']));?></h2>
<div id="up_ymd"><?php echo h($dataArr['up_ymd']);?></div>
<div id="detail">
<?php
for($i=0;$i<=$maxCommentCount;$i++){
	if(!empty($dataArr['comment'][$i]) || !empty($dataArr['upfile_path'][$i])){
		
		//アップファイル表示用のタグをセット。 画像の場合はimgタグ、その他の場合はファイルにリンクする（タグ部分は自由に変更可）
		$upfileTag = '';//初期化
		if(!empty($dataArr['upfile_path'][$i])){
			if($dataArr['file_type'][$i] == 'img'){
				$upfileTag = '<img src="'.$dataArr['upfile_path'][$i].'?'.uniqid().'" />';//画像の場合のタグ
			}else{
				$linkText = (isset($extensionListText[$dataArr['extension'][$i]])) ? $extensionListText[$dataArr['extension'][$i]] : 'アップファイル（'.$dataArr['extension'][$i].'）';//リンクテキストをセット
				$upfileTag = '<a href="'.$dataArr['upfile_path'][$i].'" target="_blank">'.$linkText.'</a>';//画像以外の場合のタグ
			}
			$upfileTag = '<div class="detailUpfile">'.$upfileTag.'</div>';
		}
?>
<div class="detailText"><?php echo (!empty($dataArr['comment'][$i])) ? $dataArr['comment'][$i] : '';?></div>
<?php echo $upfileTag;?>
<?php 
	}
}
?>
</div>
<div class="backORcloseBtn"><?php echo ($config['popupFlag'] == 1) ? '<a href="javascript:window.close()">× 閉じる</a>' : '<a href="javascript:history.back()">&lt;&lt;戻る</a>';//CLOSEボタン、または戻るボタン?></div>
<?php echo $copyright;}//著作権表記削除不可?>

<!--▲▲埋め込み時　コピーここまで▲▲-->

</body>
</html>