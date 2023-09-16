<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Massier Chat Application</title>
        <meta name="description" content="Massier Chat Application" />
        <link rel="stylesheet" href="chatdesign.css" />
    </head>
    <body>
        <div id="wrapper">
            <div id="menu">
                <p class="welcome">Welcome, <b><?php echo $_SESSION["login_info"]["name"]; ?></b></p>
            </div>
            <div id="chatbox">
            <?php
            if(file_exists("log.html") && filesize("log.html") > 0){
                $contents = file_get_contents("log.html");          
                echo $contents;
            }
            ?>
            </div>
            <form id="chatpost" method="post" action="chatpost.php">
                <input name="usermsg" type="text" id="usermsg" />
                <button type="submit" id="submitmsg">Send</button>
            </form>
        </div>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script type="text/javascript">
            // jQuery Document 
            $(document).ready(function () {
                // $("#submitmsg").click(function (e) {
                    document.getElementById("submitmsg").addEventListener('click',function(e){
                  
                    
                    e.preventDefault();
                    var clientmsg = $("#usermsg").val();
                    $.post("chatpost.php", { usermsg: clientmsg });
                    $("#usermsg").val("");
                });
                function loadLog() {
                    var oldscrollHeight = $("#chatbox")[0].scrollHeight - 20; //Scroll height before the request 
                    $.ajax({
                        url: "log.html",
                        cache: false,
                        success: function (html) {
                            $("#chatbox").html(html); //Insert chat log into the #chatbox div 
                            //Auto-scroll 
                            var newscrollHeight = $("#chatbox")[0].scrollHeight - 20; //Scroll height after the request 
                            if(newscrollHeight > oldscrollHeight){
                                $("#chatbox").animate({ scrollTop: newscrollHeight }, 'normal'); //Autoscroll to bottom of div 
                            }	
                        }
                    });
                }
                setInterval (loadLog, 2500);
            });
        </script>
    </body>
</html>
<?php
// }
?>