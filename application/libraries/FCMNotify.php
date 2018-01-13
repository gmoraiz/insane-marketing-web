<?php
    class FCMNotify{
        
        public function send($tokenFcm, $title, $body, $type = null){
            $notification = array(
                "title"     => $title,
                "body"      => $body,
                "sound"     => 'default',
            );

            $data = array(
                "type" => $type,
                "date" => date('d/m/Y H:i')
            );

            $fields = array(
            	'to' 	       => $tokenFcm,
            	'notification' => $notification,
                'data'         => $data
            );
            $headers = array(
            	'Authorization: key='.FIREBASE_KEY,
            	'Content-Type: application/json'
            );
            
            $ch = curl_init();
            curl_setopt($ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
            curl_setopt($ch,CURLOPT_POST, true );
            curl_setopt($ch,CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch,CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch,CURLOPT_POSTFIELDS, json_encode($fields));
            $result = curl_exec($ch );
            curl_close( $ch );
            echo 'result: ' . $result;
        }
    }
?>