<?php
include "../database.php";
include "../class.php";

if(isset($_GET["key"])){
    $postdata = file_get_contents("php://input");
    if(isset($postdata)){
        $request = json_decode($postdata);

        if(!empty($request->user_id))
        {
            $user_id = $request->user_id;

            $user = new User();
            if(!empty($request->user_token)){
                $user_token = $request->user_token;
                echo json_encode($user->getUser($user_id,null,$user_token,null), JSON_UNESCAPED_UNICODE);
            }
            else if(!empty($request->admin_token) && !empty($admin_id = $request->admin_id)){
                $admin_token = $request->admin_token;
                $admin_id = $request->admin_id;
                echo json_encode($user->getUser($user_id,$admin_id,null,$admin_token), JSON_UNESCAPED_UNICODE);
            }
        }

    }
    else{
        echo '{"sonuc" : "hatalı"}';
    }
}

?>