<?php


define( 'FILENAME', './message.txt');


date_default_timezone_set('Asia/Tokyo');


$now_date = null;
$data = null;
$file_handle = null;
$split_data = null;
$message = array();
$message_array = array();
$success_message = null;
$error_message = array();
$clean = array();


if( !empty($_POST['btn_submit']) ) {
	

	if( empty($_POST['view_name']) ) {
		$error_message[] = 'タイトルを入力してください。';
	} else {
		$clean['view_name'] = htmlspecialchars( $_POST['view_name'], ENT_QUOTES);
	}
	

	if( empty($_POST['message']) ) {
		$error_message[] = '本文を入力してください。';
	} else {
		$clean['message'] = htmlspecialchars( $_POST['message'], ENT_QUOTES);
		$clean['message'] = preg_replace( '/\\r\\n|\\n|\\r/', '<br>', $clean['message']);
	}

	if( empty($error_message) ) {

		if( $file_handle = fopen( FILENAME, "a") ) {
	
		    
			$now_date = date("Y-m-d H:i:s");
		
		
			$data = "'".$clean['view_name']."','".$clean['message']."','".$now_date."'\n";
		
		
			fwrite( $file_handle, $data);
		
			
			fclose( $file_handle);
	
			$success_message = '作品を投稿しました。目が疲れたら休んでくださいね。';
        }

        }
	}
	


if( $file_handle = fopen( FILENAME,'r') ) {
    while( $data = fgets($file_handle) ){

		$split_data = preg_split( '/\'/', $data);

		$message = array(
			'view_name' => $split_data[1],
			'message' => $split_data[3],
			'post_date' => $split_data[5]
		);
		array_unshift( $message_array, $message);
	}
    
    
    fclose( $file_handle);
}

?>


<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">
    <title>LISUR</title>
    <link href='https://fonts.googleapis.com/css?family=Lato' rel='stylesheet' type='text/css'>
    <link href="css/style.css" rel="stylesheet" type="text/css" media="all">

    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:site" content="@CubeY_1120" />
    <meta property="og:url" content="http://lisur.hacklife.work" />
    <meta property="og:title" content="LISUR" />
    <meta property="og:description" content="創作する。そこから生まれるものがある。"/>
    <meta property="og:image" content="http://lisur.hacklife.work/dist/images/ogp.png" />
</head>

<body>
<div id="wrap">
    <header id="global-head">
        <img src="dist/images/logo.png">
    </header>

    <div id="nav-toggle">
        <div>
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>

    <aside id="sidebar">
        <nav id="global-nav">
            <ul>
            <li><a href="index.php">作品を読む</a></li>
            <li><a href="main.php">執筆する</a></li>
            </ul>
        </nav>
    </aside>

    <main id="main">
        <div id="main-in">
            <div id="main-visual">
                <h2>作品を執筆する</h2>
            </div>

            <section class="inner">
                <section>
                    <div class='foo foo--inside'>


                        <?php if( !empty($success_message) ): ?>
                        <p class="success_message"><?php echo $success_message; ?></p>
                        <?php endif; ?>
                        <?php if( !empty($error_message) ): ?>
                        <ul class="error_message">
                            <?php foreach( $error_message as $value ): ?>
                            <li>・<?php echo $value; ?></li>
                            <?php endforeach; ?>
                        </ul>
                        <?php endif; ?>
                        <form method="post">
                            <div>
                                <label for="view_name">タイトル</label>
                                <input id="view_name" type="text" name="view_name" value="">

                            </div>
                            <div>
                                <label for="message">本文</label>
                                <textarea id="message" name="message"></textarea>
                            </div>
                            <input type="submit" name="btn_submit" value="作品を投稿する">
                        </form>


                    </div>
                </section>
            </section>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.3/jquery.min.js"></script>
<script type="text/javascript" src="dist/main.js"></script>

</div>
</body>



</html>
