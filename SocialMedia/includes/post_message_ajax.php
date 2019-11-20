<?php

    require("dbh.inc.php");
    //post message
    if(isset($_POST['message'])){
        $message = mysqli_real_escape_string($conn, $_POST['message']);
        $conversation_id = mysqli_real_escape_string($conn, $_POST['conversation_id']);
        $user_form = mysqli_real_escape_string($conn, $_POST['user_form']);
        $user_to = mysqli_real_escape_string($conn, $_POST['user_to']);
 
        //decrypt the conversation_id,user_from,user_to
        $conversation_id = base64_decode($conversation_id);
        $user_form = base64_decode($user_form);
        $user_to = base64_decode($user_to);
        
        
        
            $sql = "insert into messages(conversation_id, user_from, user_to, message) "
                    . "values (?,?,?,?)";
            $stmt = mysqli_stmt_init($conn);
            //echo "--".$conversation_id."--".$user_form."--".$user_to."--".$message."--";
            if (!mysqli_stmt_prepare($stmt, $sql))
            {
                echo "Error";
            }
            else
            {
                mysqli_stmt_bind_param($stmt, "ssss", $conversation_id, $user_form,
                       $user_to, $message);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_store_result($stmt);
                
                echo "Posted";
            }
    }
    else
    {
        echo "error";
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
  xhttp.open("POST", "demo_post2.asp", true);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhttp.send($message&$userto&$userfrom);
}
</script>
</html>