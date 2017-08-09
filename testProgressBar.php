<!doctype html>
<?php require_once("inc/init.php"); ?>
<html>
<head>
    <title>Test Flush</title>
    <meta charset="utf-8">
    
<body>
<h1>Hello</h1>
<div id="progress">0%</div>
<button type="button" id="btnSave" class="btn btn-primary">บันทึกข้อมูล</button>
<p>
</p>
<script type="text/javascript">
    $('btnSave').click(function() {
        alert("vvvvvv");
    });
    $('h1').click(function() {
        alert("aaaaa");
        $.ajax({
                xhr: function() {

                        var xhr = new window.XMLHttpRequest();
                        xhr.addEventListener("progress", function(e){
                            console.log(e.currentTarget.response);
                            $("#progress").html(e.currentTarget.response);
                        });
                    return xhr;

                }
                , type: 'post'
                , cache: false
                , url: "testFlush.php"
        });

    });

</script>
</body>