<?php
include('conf_brand.php');


        if(!session_id()) 
        { 
            session_start(); 
        } 


        if (!empty($_POST)) {
          
            $data_final = $_POST;
            
            $_SESSION= array();
            unset($_SESSION );
            // session_destroy();
        }

        $data_final['insurance'] = $data_final['type_insurance'];

        if(isset($mediacodes)){

            foreach ($mediacodes as $value) {
                if ($value['insurance'] ==  $data_final['insurance'] ) {
                    $data_final['lead']['media_code'] = $value['media_code'];
                }
            }
        }


        $url_rater = 'https://api.confielms.com/api/new/webform/v1';
        //$url_rater = 'https://dev.confielms.com/api/new/webform/v1';
        
        //$lms = $data_final['url_rater'];
        $lms = $url_rater;

        $handle = curl_init($lms);                

        $data_final['lead_basic']['ip'] = $_SERVER['REMOTE_ADDR'];
        if (empty($data_final['lead']['zipcode'])) {
            header('location: /oops/?error=2');
            die;
        }

        $_SESSION['Lead_valid'] = null;
        $data_final['return_json'] = '1';
        $data_final['client']['communications_consent'] = '4a';


        $post = $data_final;

        // $_REQUEST['debug_pre_send'] = 1;

        if (isset($_REQUEST['debug_pre_send']) && $_REQUEST['debug_pre_send'] == '1') {
            echo '<pre>'; var_dump( $post ); echo '</pre>'; die;/***HERE***/ 
        }
        curl_setopt($handle, CURLOPT_POST, true);
        curl_setopt($handle, CURLOPT_POSTFIELDS, http_build_query($post));
        curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
        $r = curl_exec($handle);  
        $response = json_decode($r,true);

        unset($_SESSION['Lead_valid']);

        if (isset($_REQUEST['debug']) && $_REQUEST['debug'] == '1') {
            echo '<pre>'; var_dump( $response,$data_final ); echo '</pre>'; die;/***HERE***/ 
        }

        // var_dump($response);die;
        $thanks_redirect = 'location: /thanks';
        $error_redirect = 'location: /oops';
        
        if (isset($response['success']) && $response['success']) {
            
            header($thanks_redirect);            

        }else {
            header($error_redirect );
        }
       
