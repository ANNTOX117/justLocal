<!DOCTYPE html>
<html <?=isset($lang)?"lang=\"$lang\"":false?>>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="JustLocal">
    <meta name="keywords" content="justLocal">

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css"> -->
    <link rel="stylesheet" href="<?=base_url('assets/css/all.min.css')?>">
    <link rel="stylesheet" href="<?=base_url('assets/css/bootstrap.min.css')?>">
    <link rel="stylesheet" href="<?=base_url('assets/css/owl.carousel.min.css')?>">
    <link rel="stylesheet" href="<?=base_url('assets/css/general.css')?>">
    <?php
        if (isset($css) && !empty($css)) {
            foreach ($css as $file) {
                echo $file;
            }
        }
    ?>
    <title><?=($NAME_SYSTEM ?? "justLocal");?></title>
    <style>
        .liked_company_offer{
            /* color: tomato; */
            display: block !important;
        }
        .header__search {
            align-items: center;
        }
        .header__search input {
            height: 30px;
            border-radius: 5px 0 0 5px;
            outline: 0 !important;
            box-shadow: none !important;
        }
        .header__search button {
            height: 30px;
            padding: 5px 15px;
            display: flex;
            justify-content: center;
            align-items: center;
            border-radius: 0 5px 5px 0;
            color: white;
            background-color: #33a4dc;
            border: #33a4dc;
        }
        .porto-info-list {
            list-style: none;
        }
        .porto-info-list i{ 
            color: #8abe23;
            font-size: 30px;
        }
        
    </style>
</head>
<?php
    $uri = service('uri');
    $segment1 = $uri->getSegment(1);
    try {
        $segment2 = $uri->getSegment(2);
    } catch (\Throwable $th) {
        //throw $th;
    }
    switch ($segment1) {
        case '':
            echo '<body>';
        break;
        case 'bedrijven':
            echo $segment2===""?'<body>':'<body class="bg--interior">';
        break;
        case 'about_us':
            echo '<body>';
        break;
        case 'over_ons':
            echo '<body>';
        break;
        case 'contact':
            echo '<body>';
        break;
        case 'company':
            echo '<body>';
        break;
        case 'admin':
            echo '<body>';
        break;
        case 'provinces':
            echo '<body>';
        break;
        case 'register':
            echo '<body>';
        break;
        case 'aanbiedingen':
            echo $uri->getSegment(2)?'<body class="bg--interior">':'<body>';
        break;
        case 'favorite':
            echo '<body class="bg--interior">';
        break;
        case 'favoriete':
            echo '<body class="bg--interior">';
        break;
        default:
            echo '<body class="bg--interior">';
        break;
    }
?>
    <?php echo $header??false?>
    <main>
        <?php echo $main??false?>
        <?php //echo $reviews_justLocal??false?>
        <?php echo $newsletter??false?>
    </main>
    <?php echo $footer??false?>
<script src="<?= base_url('assets/jquery/jquery-3.6.4.min.js') ?>"></script>
<!-- <script src="<?//= base_url('assets/bootstrap/js/bootstrap.min.js') ?>"></script>
<script src="<?//= base_url('assets/own_carousel/js/owl.carousel.min.js') ?>"></script>
<script src="<?//= base_url('assets/ownsite/js/general/app.js') ?>"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script> -->
  <script src="<?= base_url('assets/js/bootstrap.bundle.js')?>"></script>
  <script src="<?= base_url('assets/js/owl.carousel.min.js')?>"></script>
  <script src="<?= base_url('assets/js/app.js')?>"></script>
<script>
    $(document).ready(function() {
        $('#newsletter_form').on('submit', function(event) {
            event.preventDefault();
            var email = $('#email_newsletter').val();
            let formData = {
                email: email
            };
            $.ajax({
                url: 'newsletter-register',
                type: 'POST',
                data: formData,
                success: function(response) {
                    switch (response.status) {
                        case 200:
                            alert_user("Thanks","You are gonna recive the news","success");
                            break;
                        case 400:
                            alert_user("Error","It was no possible to insert the information","error");
                        break;
                        case 500:
                            if(response.msg.code === 1062) alert_user("Error","The email has yet added","error");
                        break;
                    
                        default:
                            break;
                    }
                    $('#email_newsletter').val('');
                },
                error: function(xhr, status, error) {
                    console.error('Form submission failed',error);
                }
            });
        });
    });
    function alert_user(title,text,type="success") {
        switch (type) {
            case "success":
                Swal.fire(
                title,
                text,
                'success'
                );
                break;
            case "error":
                Swal.fire({
                icon: 'error',
                title,
                text,
                });
                break;
            default:
                Swal.fire(text);
                break;
        }
     }
</script>
<?php
    if (isset($js) && !empty($js)) {
        foreach ($js as $file) {
            echo $file;
        }
    }
?>
</body>
</html>