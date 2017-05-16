<?php
//initilize the page
session_start();
require_once("inc/init.php");
$page = $_SESSION["at_page"];
?>
<!-- ==========================CONTENT STARTS HERE ========================== -->
<!-- possible classes: minified, no-right-panel, fixed-ribbon, fixed-header, fixed-width-->
<div id="main" role="main">
	<!-- MAIN CONTENT -->
    <div id="content" class="container">

        <div class="row">

            <div class="col-xs-12 col-sm-12 col-md-5 col-lg-4">
                <div class="well no-padding">
                    <form action="<?php echo APP_URL; ?>" id="login-form" class="smart-form client-form">
                        <header>
                                Sign In
                        </header>

                        <fieldset>

                            <section>
                                <label class="label">E-mail</label>
                                <label class="input"> <i class="icon-append fa fa-user"></i>
                                        <input type="text" name="loUser" id="loUser">
                                        <input type="hidden" name="loPage" id="loPage" value="<?php echo $page?>">
                                        <b class="tooltip tooltip-top-right"><i class="fa fa-user txt-color-teal"></i> Please enter email address/username</b></label>
                            </section>
                            <section>
                                <label class="label">Password</label>
                                <label class="input"> <i class="icon-append fa fa-lock"></i>
                                        <input type="password" name="loPassword" id="loPassword">
                                        <b class="tooltip tooltip-top-right"><i class="fa fa-lock txt-color-teal"></i> Enter your password</b> </label>
                                <div class="note">
                                        <a href="<?php echo APP_URL; ?>/forgotpassword.php">Forgot password?</a>
                                </div>
                            </section>
                            <section>
                                <label class="checkbox">
                                        <input type="checkbox" name="remember" checked="">
                                        <i></i>Stay signed in</label>
                            </section>
                        </fieldset>
                        <footer>
                            <button type="button" id="btnLogin" class="btn btn-primary">
                                    Sign in
                            </button>
                        </footer>
                    </form>

                </div>

            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $("#btnLogin").click(checkLogin);
    function checkLogin(){
        //alert("aaa");
        $.ajax({
            type: 'GET', url: 'getAmphur.php', contentType: "application/json", dataType: 'text', 
            data: { 'flagPage':"login" }, 
            success: function (data) {
                var page = '<?php echo $_SESSION["at_page"]; ?>';
                //alert('bbbbb'+data+page);
                var json_obj = $.parseJSON(data);
                for (var i in json_obj){
                    //$("#reRecDoc").val(json_obj[i].doc);
                    //alert('page '+page);
                    $( "form" ).submit();
                    window.location.assign('#'+page);
                }
            }
        });
    }
</script>