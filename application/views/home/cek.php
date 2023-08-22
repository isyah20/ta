<html>
<head>
<title>HTTP Referer example</title>
<script language="javascript" type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
</head>
<body>
<div class="result">
    <?php
    if ($tender !== null) {
        foreach($tender as $item) :
            ?>
            <p><?=$item['id_tender']?></p>
            <?php
        endforeach;
    } else {
        ?>
        <p>Gaada</p>
        <?php
    }
    ?>
</div>
<script type="text/javascript">
    $(document).ready(function () {            
        $.ajax({
            url: 'http://localhost/procurement-platform/api/tender/',
            type: "GET",
            contentType:'application/json',
            dataType:"json",
            success: function (data) { 
                console.log(data['data']);
                send(data['data']);
            }
        }); 
        
        function send(recive){
            var recive = JSON.stringify(recive);
            $.ajax({
                type: 'POST',
                url: 'http://localhost/procurement-platform/home/index/',
                data: 'data='+recive,
                dataType: "x-www-form-urlencoded",
                success: function (data) { 
                    $('.result').html(data)
                    console.log('success');
                }
            });
        }
    });
</script>

</body>