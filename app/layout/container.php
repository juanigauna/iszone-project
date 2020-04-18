<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#575fcf">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo $n['page_title'] ?></title>
    <link href="https://fonts.googleapis.com/css?family=Fira+Sans&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Quicksand" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?php echo $n['site_url'] ?>/app/resources/css/all.css?v=<?php echo time() ?>">
    <link rel="stylesheet" href="<?php echo $n['site_url'] ?>/app/resources/css/main.css?v=<?php echo time() ?>">
    <script type="text/javascript" src="<?php echo $n['site_url'] ?>/app/resources/js/functions.js?v=<?php echo time() ?>"></script>
    <?php if ($n['logged_in'] == true) { ?>
         <script type="text/javascript">
            function get_profile_pic() {
                return "<?php echo get_profile_pic($id); ?>";
            }
        </script>
    <?php } ?>
	<script type="text/javascript">
		function site_url() {
			return "<?php echo $n['site_url'] ?>/app/requests.php";
		}
        function siteurl() {
            return "<?php echo $n['site_url'] ?>";
        }
	</script>
</head>
<body <?php if ($link == "welcome" || $link == "new-account" || $link == "recover-password") { ?> style="background: #575fcf" <?php } ?>>
    <div id="content-modals">
        <?php include 'app/layout/header/menu.php' ?>
        <?php include 'app/layout/modals/menu-locations.php' ?>
    </div>
    <div id="header">
        <?php include 'app/layout/header/content.php' ?>
    </div>
    <div class="m-b-6" id="content">
        <?php include 'app/layout/'.$n['page_content'].'.php'; ?>
    </div>
    <div class="mx-5 m-b-5" id="footer_copyright">
        <p class="text <?php if ($link == "welcome" || $link == "new-account" || $link == "recover-password") { ?> white-color <?php } ?>"><i class="far fa-copyright"></i> Copyright <a class="text-bold<?php if ($link == "welcome" || $link == "new-account" || $link == "recover-password") { ?> white-color <?php } ?>" href="<?php echo $n['site_url'] ?>"><?php echo $n['site_title'] ?></a> <?php echo date('Y') ?></p>
    </div>
</body>
<?php if ($n['logged_in'] == true) { ?>
    <script type="text/javascript" src="<?php echo $n['site_url'] ?>/app/resources/js/data.js?v=<?php echo time() ?>"></script>
<?php } ?>
<script type="text/javascript" src="<?php echo $n['site_url'] ?>/app/resources/js/scripts.js?v=<?php echo time() ?>"></script>
</html>