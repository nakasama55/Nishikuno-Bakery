<?php //▼▼ 既存ページヘ埋め込み時はまるっとコピペ下さい （この行も含みページ最上部に）※.phpでかつUTF-8のページのみ可▼▼
//※このページに対して既存のページのhtmlを記述する形でももちろんOKです。
//----------------------------------------------------------------------
// トップページ表示用ページ
// 設定ファイルの読み込みとページ独自設定
//----------------------------------------------------------------------
include_once("./pkobo_news/admin/include/config.php");//（必要に応じてパスは適宜変更下さい）
$img_updir = './pkobo_news/upload';//画像保存パス（必要に応じてパスは適宜変更下さい）

@rssGen();//RSS配信用（このファイルのURLに「?feed=rss2」とパラメータを追加すればRSSフィードが表示されます）※不要な場合削除OK

/* ▽オプション設定▽ */

//表示件数
$config['dspNum'] = 10;

//本文の抜粋を表示するかどうか（0=しない、1=する）
$commentDsp = 1;

//本文を抜粋表示する場合の表示文字数 （単位はバイト。全角文字は「2バイト」で1文字となります。また末尾の文字「...」も含みます）
//※htmlタグは削除されます「0」にすれば全文をhtmlもそのままで表示します。（レイアウトに問題が出る可能性があるのでオススメしません）
$commentNum = 200;

//サムネイルを表示するか（0=しない、1=する）※アップファイルの1枚目が画像の場合のみ有効
$dspThumbNail = 1;

//表示するカテゴリを指定（指定なし（空）の場合は全件表示 ※デフォルト）
//このページで特定カテゴリのみ表示したい場合、0からの番号を指定下さい。 （1番目が0，2番目が1になるので注意）
//要するに複数のカテゴリがある場合でそれぞれ別々のファイルで表示したい場合用です
//このファイルを複製すればOKです（カテゴリごとにデザインを変えたい場合など）
//例　$category = '1'; ※この場合カテゴリ番号「1」（設定ファイルでの2番目）の記事のみが表示されます
$category = '';
//またはURLのパラメータでも指定可能です。番号ルールは↑と同じです。例　URLに ?cat=0 や ?cat=1 を追加するだけです
//1ファイルでパラメータを変えるだけでそれぞれのカテゴリを表示できるので便利です。（全カテゴリでデザインは共通で良い場合）

//----------------------------------------------------------------------
// 設定ファイルの読み込みとページ独自設定
//----------------------------------------------------------------------
//▲▲ コピペここまで ▲▲（この行も含む）?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ja" lang="ja">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>トップページの新着情報、お知らせ</title>
<meta http-equiv="Content-Style-Type" content="text/css" />
<meta name="Keywords" content="" />
<meta name="Description" content="" />
<meta http-equiv="Content-Script-Type" content="text/javascript" />

<!--▼▼CSSとポップアップ用JS。トップページ埋め込み時　要コピペ（head部分）▼▼-->
<style type="text/css">
/* CSSは必要最低限しか指定してませんのでお好みで（もちろん外部化OK） */

/* clearfix */
.clearfix:after { content:"."; display:block; clear:both; height:0; visibility:hidden; }
.clearfix { display:inline-block; }

/* for macIE \*/
* html .clearfix { height:1%; }
.clearfix { display:block; }

ul#newsList{
	margin:0 0 15px;
	padding:0;
	font-family:"Kiwi Maru", "Yu Gothic", 游ゴシック, YuGothic, 游ゴシック体,"メイリオ", Meiryo, Osaka, "ＭＳ Ｐゴシック", "MS PGothic", sans-serif;
}
ul#newsList li{
	color:#3d3d3d;
	font-size:1em;  /*16px*/
	margin:0;
	padding:5px 0;
	margin-bottom:3px;
	/*border-bottom:1px dotted #ccc;*/
	line-height:120%;
	list-style-type:none;
}
a{color:#3d3d3d;text-decoration:underline;}
a:hover{color:#0d559c;text-decoration:none;}

.catName{
	display:inline-block;
	padding:3px 0.63%;  /*5px*/
	/*border:1px solid #3d3d3d;*/
	/*border-radius:6px;*/
	font-size:0.813em;  /*13px*/
	line-height:100%;
	margin:0 0.25%;  /*2px*/
	color: #fff;
	background:#0d559c;
	font-weight: 500;
}
.newMark{
	display:inline-block;
	border:1px solid #f0ff00;
	padding:1px 0.5%;  /*4px*/
	font-size:0.813em;  /*13px*/
	line-height:100%;
	background:#f0ff00;
	color:#1d1d1d;
	box-shadow:0px 1px 0px #7d8500;
	border-radius:3px;
	font-weight: 500;
	/*font-style:italic;*/
}
.comment{
	display:block;
	padding:3px 0;
	float:left;
	overflow:hidden;
	width:500px;/* 本文部分の幅。ここは特に設置ページ合わせて変更下さい */
}
.thumbNailWrap{
	display:block;
	width:110px;
	float:left;
	height:80px;
	overflow:hidden;
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


</style>

<script type="text/javascript">
<!--
function openwin(url) {//詳細ページ用ポップアップ。ウインドウの幅、高さなど自由に編集できます（ポップアップで開く場合のみコピペ下さい）
 wn = window.open(url, 'win','width=680,height=550,status=no,location=no,scrollbars=yes,directories=no,menubar=no,resizable=no,toolbar=no');wn.focus();
}
-->
</script>
<!--▲▲CSSとポップアップ用JS。トップページ埋め込み時　要コピペ（head部分）▲▲-->

</head>
<body>

<!--▼▼トップページ埋め込み時はここから以下をコピーして任意の場所に貼り付けてください（html部は編集可）▼▼-->
<div id="newsWrap">
<ul id="newsList">

<?php if(!$copyright){echo $warningMesse;exit;}else{$getFormatDataArr = getLines2DspData($file_path,$img_updir,$config,'',$category);foreach($getFormatDataArr as $key => $data){?>

<li id="postID_<?php echo $data['id'];?>" class="cat-<?php echo $data['categoryNum'];?> clearfix">
<span class="up_ymd"><?php echo $data['up_ymd'];//日付表示?></span>
<?php if(!empty($data['category'])) echo '<span class="catName">'.$data['category'].'</span>';//カテゴリ名表示?>
<span class="title"><?php echo $data['title'];//タイトル表示?></span>
<?php if($data['newmark'] == 1) echo ' <span class="newMark">New!</span>';//New表示。タグ変更可（表示期間は設定ファイルで）?>
</li>

<?php } ?>
</ul>
</div>
<?php echo $copyright;}//著作権表記削除不可?>

<!--▲▲トップページ埋め込み時　コピーここまで▲▲-->

</body>
</html>