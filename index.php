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
    <meta property="og:description" content="LISURでもっとシンプルに交じろう。"/>
    <meta property="og:image" content="http://lisur.hacklife.work/dist/images/ogp.png" />


</head>

<body>

    <header id="global-head">
        <h1 id="brand-logo">L I S U R</h1>
        <p>BETA</p>
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
                <li><a href="index.php">Home</a></li>
                <li><a href="main.php">Post</a></li>
            </ul>
        </nav>
    </aside>

    <main id="main">
        <div id="main-in">
        <div id="main-visual">
            <h2>Home</h2>
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


                        <section>
                            <?php if( !empty($message_array) ){ ?>
                            <?php foreach( $message_array as $value ){ ?>
                            <article>
                                <div class="info">
                                    <h2><?php echo $value['view_name']; ?></h2>
                                    <time><?php echo date('Y年m月d日 H:i', strtotime($value['post_date'])); ?></time>
                                </div>
                                <p><?php echo $value['message']; ?></p>
                            </article>
                            <?php } ?>
                            <?php } ?>
                        </section>

                    </div>
                </section>
            </section>

        </div><!-- /#main-in -->
    </main>

    <div id="overlay"></div>



    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.3/jquery.min.js"></script>
    <script type="text/javascript" src="dist/main.js"></script>

</body>

</html>
