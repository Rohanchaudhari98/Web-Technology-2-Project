<?php
    session_start();
    require("dbh.inc.php");
    if(isset($_GET['c_id'])){
        $conversation_id = base64_decode($_GET['c_id']);
        
        $q = mysqli_query($conn, "SELECT * FROM messages WHERE conversation_id = ".$conversation_id);
        
        if(mysqli_num_rows($q) > 0){
            while ($m = mysqli_fetch_assoc($q)) {
                //format the message and display it to the user
                $user_form = $m['user_from'];
                $user_to = $m['user_to'];
                $message = $m['message'];
 
                //get name and image of $user_form from `user` table
                $user = mysqli_query($conn, "SELECT uidUsers, userImg FROM users WHERE idUsers = '$user_form'");
                $user_fetch = mysqli_fetch_assoc($user);
                $user_form_username = $user_fetch['uidUsers'];
                $user_form_img = $user_fetch['userImg'];
 
                //display the message
                if ($user_form_username === $_SESSION['userUid']) 
                {
                    echo '<div class="outgoing_msg">
                            <div class="sent_msg">
                              <p>'.$message.'</p>
                            </div>
                          </div>';
                }
                else 
                {
                    echo '<div class="incoming_msg">
                            <div class="incoming_msg_img"> <img class="chat_people_inbox_img" src="uploads/'.$user_form_img.'"> </div>
                             <div class="received_msg">
                                <div class="received_withd_msg">
                                 <p>'.$message.'</p>
                                     <br>
                                </div>
                             </div>
                           </div>';
                }
                
 
            }
        }else{
            echo "<div class='text-center'>
                    <br>
                    <img src='img/empty.png' style='width:500px;'>
                </div>";
        }
    }
    
    
//     $address = '0.0.0.0';
//     $port = 6000;
    
//     $server = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
    
//     socket_set_option($server, SOL_SOCKET, SO_REUSEADDR, 1);
    
//     socket_bind($server, $address, $port);
    
//     socket_listen($server);
    
//     $client = socket_accept($server);
    
//     $request = socket_read($client, 6000);
//     preg_match('#Sec-WebSocket-Key: (.*)\r\n#', $request, $matches);
//     $key = base64_encode(pack(
//     'H*',
//     sha1($matches[1] . '258EAFA5-E914-47DA-95CA-C5AB0DC85B11')
//     ));
//     $headers = "HTTP/1.1 101 Switching Protocols\r\n";
//     $headers .= "Upgrade: websocket\r\n";
//     $headers .= "Connection: Upgrade\r\n";
//     $headers .= "Sec-WebSocket-Version: 13\r\n";
//     $headers .= "Sec-WebSocket-Accept: $key\r\n\r\n";
//     socket_write($client, $headers, strlen($headers));
//     while($rcvd=socket_read($client,4096)){
//         $data=unmask($rcvd);
//         $rev=strrev($data);
//         $resp = chr(129) . chr(strlen($rev)) . $rev;
//         socket_write($client, $resp, strlen($resp));
//         }
//     // Send  messages into WebSocket in a loop.
    
    
//     function unmask($text) {
//     $length = ord($text[1]) & 127;
//     if($length == 126) {
//         $masks = substr($text, 4, 4);
//         $data = substr($text, 8);
//     }
//     elseif($length == 127) {
//         $masks = substr($text, 10, 4);
//         $data = substr($text, 14);
//     }
//     else {
//         $masks = substr($text, 2, 4);
//         $data = substr($text, 6);
//     }
//     $text = "";
//     for ($i = 0; $i < strlen($data); ++$i) {
//         $text .= $data[$i] ^ $masks[$i%4];
//     }
//     return $text;
// }
 
?>
<html>
<script>
function loadDoc() {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("inbox_chat").innerHTML = this.responseText;
    }
  };
  xhttp.open("POST", "demo_get2.asp", true);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhttp.send($message&$userto&$userfrom);
}
</script>
</html>