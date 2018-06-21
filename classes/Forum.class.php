<?php

class Forum extends Base {
    function __contruct(){
        parent::__contruct();
    }


    // Add tags

    public function addTags($array){
        if(!isset($array['tagTitle']) || trim($array['tagTitle']) == ''){
            Message::addMessage("Please add Tag Title.", ERR);
        } else if(!isset($array['tagDescription']) || trim($array['tagDescription']) == ''){
            Message::addMessage("Please add Tag Decscription.", ERR);
        } else if(!isset($array['tagColor']) || trim($array['tagColor']) == ''){
            Message::addMessage("Please choose Tag Color.", ERR);
        } else {

        // Take action to create/edit
        $fieldArray = array(
            'tagColor' => trim($array['tagColor']),
            'tagTitle' => trim($array['tagTitle']),
            'tagDescription' => trim($array['tagDescription']),
            'isDispaly' => trim($array['isDispaly']),
            'createdOn' => date('Y-m-d H:i:s')
        );
                $update = false;
                if(!$update){ // Create new
                    $fieldArray['createdBy'] = ((int)User::loggedInUserId() > 0 ? User::loggedInUserId() : 0);
                    $fieldArray['updatedOn'] = date('Y-m-d H:i:s');
                   $this->query("INSERT INTO `tblTags` SET " . $this->prepareFieldsForInsertOrUpdate($fieldArray));
                   Message::addMessage("Tag inserted successfully", SUCCS);
            }
        }
    }

    public function updateTags($array){
        // if(!isset($array['tagTitle']) || trim($array['tagTitle']) == ''){
        //     Message::addMessage("Please add Tag Title.", ERR);
        // } else if(!isset($array['tagDescription']) || trim($array['tagDescription']) == ''){
        //     Message::addMessage("Please add Tag Decscription.", ERR);
        // } else if(!isset($array['tagColor']) || trim($array['tagColor']) == ''){
        //     Message::addMessage("Please choose Tag Color.", ERR);
        // } else {

        // Take action to create/edit
        $fieldArray = array(
            'tagColor' => trim($array['tagColor']),
            'tagTitle' => trim($array['tagTitle']),
            'tagDescription' => trim($array['tagDescription']),
            'isDispaly' => trim($array['isDispaly'])
            //'createdOn' => date('Y-m-d H:i:s')
        );
                $update = false;
                if(!$update){ // Create new
                    $fieldArray['updatedBy'] = ((int)User::loggedInUserId() > 0 ? User::loggedInUserId() : 0);
                    $fieldArray['updatedOn'] = date('Y-m-d H:i:s');
                   $this->query("UPDATE `tblTags` SET " . $this->prepareFieldsForInsertOrUpdate($fieldArray) . " WHERE `id`= '" . $array['id'] . "'");
                   Message::addMessage("Tag updated successfully", SUCCS);
            }
       //}
            return true;
    }



    //  public function addForumtopic($array){
    //     if(!isset($array['tagTitle']) || trim($array['tagTitle']) == ''){
    //         Message::addMessage("Please add Tag Title.", ERR);
    //     } else if(!isset($array['tagDescription']) || trim($array['tagDescription']) == ''){
    //         Message::addMessage("Please add Tag Decscription.", ERR);
    //     } else if(!isset($array['tagColor']) || trim($array['tagColor']) == ''){
    //         Message::addMessage("Please choose Tag Color.", ERR);
    //     } else {

    //     // Take action to create/edit
    //     $fieldArray = array(
    //         'tagColor' => trim($array['tagColor']),
    //         'tagTitle' => trim($array['tagTitle']),
    //         'tagDescription' => trim($array['tagDescription']),
    //         'createdOn' => date('Y-m-d H:i:s')
    //     );
    //             $update = false;
    //             if(!$update){ // Create new
    //                 $fieldArray['createdBy'] = ((int)User::loggedInUserId() > 0 ? User::loggedInUserId() : 0);
    //                 $fieldArray['updatedOn'] = date('Y-m-d H:i:s');
    //                $this->query("INSERT INTO `tblTags` SET " . $this->prepareFieldsForInsertOrUpdate($fieldArray));
    //                Message::addMessage("Tag inserted successfully", SUCCS);
    //         }
    //     }
    // }

    public function addForumtopic($array, $file){
        if(!isset($array['topicTags']) || is_array($array['topicTags']) == ''){
            Message::addMessage("Please select tag to describe your post category.", ERR);
        } else if(!isset($array['topicTitle']) || trim($array['topicTitle']) == ''){
            Message::addMessage("Please add title to your post.", ERR);
        } else if(!isset($array['topicDescription']) || trim($array['topicDescription']) == ''){
            Message::addMessage("Please add some content to your post.", ERR);
        } else {

            $imagetype = array(image_type_to_mime_type(IMAGETYPE_GIF), image_type_to_mime_type(IMAGETYPE_JPEG),
                image_type_to_mime_type(IMAGETYPE_PNG), image_type_to_mime_type(IMAGETYPE_BMP));
            $error_msg = "";

            $run = 'true';
            $imageUploadERROR = FALSE;
            $FOLDER = "images/forum/topic/";
            $files = $file["topicFiles"];

            $filePath = array();
            for ($i = 0; $i < count($files["name"]); $i++) {
                if ($files["name"][$i] <> "" && $files["error"][$i] == 0) {
                    // uploaded file is OK
                    if (in_array($files["type"][$i], $imagetype)) {
                        // get the extention of the file
                        $file_extention = @strtolower(@end(@explode(".", $files["name"][$i])));
                        // Setting an unique name for the file
                        $file_name = date("Ymd") . '_' . rand(10000, 990000) . '.' . $file_extention;
                        if (move_uploaded_file($files["tmp_name"][$i], $FOLDER . $file_name) === FALSE) {
                            Message::addMessage("Error while uploading the file", ERR);
                        } else {
                           // Message::addMessage("File uploaded successfully with name: " . $file_name, SUCCS);
                            $filePath[$i] = $FOLDER.$file_name;
                        }
                    } else {
                        //$error_msg = "File is not a valid image type.";
                        Message::addMessage("File is not a valid image type.", ERR);
                        $run = 'false';
                    }
                }
                if ($imageUploadERROR) {
                    // if upload error break the loop and display the error
                    break;
                }
            }
            // if ($imageUploadERROR === FALSE) {
            //     Message::addMessage($error_msg, ERR);
            // } else {
            //      Message::addMessage("All file is uploaded successfully", SUCCS);
            // }

        

           $fieldArray = array(
            'topicUniqueId' => uniqid(),
            'topicTags' => json_encode($array['topicTags']),
            'topicDescription' => trim($array['topicDescription']),
            'topicTitle' => trim($array['topicTitle']),
            'createdOn' => date('Y-m-d H:i:s'),
            'updatedBy' => ((int)User::loggedInUserId() > 0 ? User::loggedInUserId() : 0),
        ); 


            if($filePath != ''){
                $filePath = json_encode($filePath);
                $fieldArray['topicFiles'] = $filePath;
            }
            //print_r($fieldArray);die();
           $update = false;
            if(!$update){ // Create new
                $fieldArray['createdBy'] = ((int)User::loggedInUserId() > 0 ? User::loggedInUserId() : 0);
                $fieldArray['updatedOn'] = date('Y-m-d H:i:s');
           // echo "INSERT INTO `tblForumTopics` SET " . $this->prepareFieldsForInsertOrUpdate($fieldArray);die();
                $this->query("INSERT INTO `tblForumTopics` SET " . $this->prepareFieldsForInsertOrUpdate($fieldArray));
            }
            Message::addMessage("Your Topic is posted successfully!!!", SUCCS);
            return true;
       // }
        }
    }


    public function updateForumtopic($array, $file){
        // if(!isset($array['topicTags']) || is_array($array['topicTags']) == ''){
        //     Message::addMessage("Please select tag to describe your post category.", ERR);
        // } else if(!isset($array['topicTitle']) || trim($array['topicTitle']) == ''){
        //     Message::addMessage("Please add title to your post.", ERR);
        // } else if(!isset($array['topicDescription']) || trim($array['topicDescription']) == ''){
        //     Message::addMessage("Please add some content to your post.", ERR);
        // } else {

            $imagetype = array(image_type_to_mime_type(IMAGETYPE_GIF), image_type_to_mime_type(IMAGETYPE_JPEG),
                image_type_to_mime_type(IMAGETYPE_PNG), image_type_to_mime_type(IMAGETYPE_BMP));
            $error_msg = "";

            $run = 'true';
            $imageUploadERROR = FALSE;
            $FOLDER = "images/forum/topic/";
            $files = $file["topicFiles"];

            //if(!$file["topicFiles"]){

                $filePath = array();
                for ($i = 0; $i < count($files["name"]); $i++) {
                    if ($files["name"][$i] <> "" && $files["error"][$i] == 0) {
                        // uploaded file is OK
                        if (in_array($files["type"][$i], $imagetype)) {
                            // get the extention of the file
                            $file_extention = @strtolower(@end(@explode(".", $files["name"][$i])));
                            // Setting an unique name for the file
                            $file_name = date("Ymd") . '_' . rand(10000, 990000) . '.' . $file_extention;
                            if (move_uploaded_file($files["tmp_name"][$i], $FOLDER . $file_name) === FALSE) {
                                Message::addMessage("Error while uploading the file", ERR);
                            } else {
                               // Message::addMessage("File uploaded successfully with name: " . $file_name, SUCCS);
                                $filePath[$i] = $FOLDER.$file_name;
                            }
                        } else {
                            //$error_msg = "File is not a valid image type.";
                            Message::addMessage("File is not a valid image type.", ERR);
                            $run = 'false';
                        }
                    }
                    if ($imageUploadERROR) {
                        // if upload error break the loop and display the error
                        break;
                    }
                }
            
            

        

           $fieldArray = array(
            'topicTags' => json_encode($array['topicTags']),
            'topicDescription' => trim($array['topicDescription']),
            'topicTitle' => trim($array['topicTitle']),
            //'createdOn' => date('Y-m-d H:i:s'),
            'updatedBy' => ((int)User::loggedInUserId() > 0 ? User::loggedInUserId() : 0),
        );
           if(isset($array['prevFile']) || !is_array($array['prevFile']) == ''){
               $filePath = array_merge($filePath,$array['prevFile']);
               //print_r($filePath);
               $filePath = json_encode($filePath);
                    $fieldArray['topicFiles'] = $filePath;
           }else{

                if($filePath != ''){
                    $filePath = json_encode($filePath);
                    $fieldArray['topicFiles'] = $filePath;
                }
            }

           $update = false;
            if(!$update){ // Create new
                $fieldArray['updatedOn'] = date('Y-m-d H:i:s');
            //echo "UPDATE `tblForumTopics` SET " . $this->prepareFieldsForInsertOrUpdate($fieldArray) . " WHERE `id`= '" . $array['id'] . "'";die();
                
                $this->query("UPDATE `tblForumTopics` SET " . $this->prepareFieldsForInsertOrUpdate($fieldArray) . " WHERE `id`= '" . $array['id'] . "'");
            }
            Message::addMessage("Post is updated successfully!!!", SUCCS);
            return true;
       // }
        //}
    }



    // topic response insrt

    public function addForumtopicResponse($array, $file){
        if(!isset($array['topicResponseIndex']) || trim($array['topicResponseIndex']) == ''){
            Message::addMessage("Something went wrong please try again later.", ERR);
        } else if(!isset($array['topicParentId']) || trim($array['topicParentId']) == ''){
            Message::addMessage("Something went wrong please try again.", ERR);
        } else if(!isset($array['topicResponseDescription']) || trim($array['topicResponseDescription']) == ''){
            Message::addMessage("Please add some content to your post.", ERR);
        } else {

            $imagetype = array(image_type_to_mime_type(IMAGETYPE_GIF), image_type_to_mime_type(IMAGETYPE_JPEG),
                image_type_to_mime_type(IMAGETYPE_PNG), image_type_to_mime_type(IMAGETYPE_BMP));
            $error_msg = "";

            $run = 'true';
            $imageUploadERROR = FALSE;
            $FOLDER = "images/forum/topic/";
            $files = $file["topicResponseFiles"];

            $filePath = array();
            for ($i = 0; $i < count($files["name"]); $i++) {
                if ($files["name"][$i] <> "" && $files["error"][$i] == 0) {
                    // uploaded file is OK
                    if (in_array($files["type"][$i], $imagetype)) {
                        // get the extention of the file
                        $file_extention = @strtolower(@end(@explode(".", $files["name"][$i])));
                        // Setting an unique name for the file
                        $file_name = date("Ymd") . '_' . rand(10000, 990000) . '.' . $file_extention;
                        if (move_uploaded_file($files["tmp_name"][$i], $FOLDER . $file_name) === FALSE) {
                            Message::addMessage("Error while uploading the file", ERR);
                        } else {
                           // Message::addMessage("File uploaded successfully with name: " . $file_name, SUCCS);
                            $filePath[$i] = $FOLDER.$file_name;
                        }
                    } else {
                        //$error_msg = "File is not a valid image type.";
                        Message::addMessage("File is not a valid image type.", ERR);
                        $run = 'false';
                    }
                }
                if ($imageUploadERROR) {
                    // if upload error break the loop and display the error
                    break;
                }
            }
            // if ($imageUploadERROR === FALSE) {
            //     Message::addMessage($error_msg, ERR);
            // } else {
            //      Message::addMessage("All file is uploaded successfully", SUCCS);
            // }

        

           $fieldArray = array(
            'topicResponseUniqueId' => uniqid(),
            'topicParentId' => trim($array['topicParentId']),
            'topicResponseDescription' => trim($array['topicResponseDescription']),
            'topicResponseIndex' => trim($array['topicResponseIndex']),
            'createdOn' => date('Y-m-d H:i:s'),
            'updatedBy' => ((int)User::loggedInUserId() > 0 ? User::loggedInUserId() : 0),
        ); 


            if($filePath != ''){
                $filePath = json_encode($filePath);
                $fieldArray['topicResponseFiles'] = $filePath;
            }
            //print_r($fieldArray);die();
           $update = false;
            if(!$update){ // Create new
                $fieldArray['createdBy'] = ((int)User::loggedInUserId() > 0 ? User::loggedInUserId() : 0);
                $fieldArray['updatedOn'] = date('Y-m-d H:i:s');
           // echo "INSERT INTO `tblForumTopics` SET " . $this->prepareFieldsForInsertOrUpdate($fieldArray);die();
                $this->query("INSERT INTO `tblForumTopicsResponse` SET " . $this->prepareFieldsForInsertOrUpdate($fieldArray));
            }
            Message::addMessage("Your Comment is posted successfully!!!", SUCCS);
            return true;
       // }
        }
    }

    public function updateForumtopicResponse($array, $file){

            $imagetype = array(image_type_to_mime_type(IMAGETYPE_GIF), image_type_to_mime_type(IMAGETYPE_JPEG),
                image_type_to_mime_type(IMAGETYPE_PNG), image_type_to_mime_type(IMAGETYPE_BMP));
            $error_msg = "";

            $run = 'true';
            $imageUploadERROR = FALSE;
            $FOLDER = "images/forum/topic/";
            $files = $file["topicFiles"];

            $filePath = array();
            for ($i = 0; $i < count($files["name"]); $i++) {
                if ($files["name"][$i] <> "" && $files["error"][$i] == 0) {
                    // uploaded file is OK
                    if (in_array($files["type"][$i], $imagetype)) {
                        // get the extention of the file
                        $file_extention = @strtolower(@end(@explode(".", $files["name"][$i])));
                        // Setting an unique name for the file
                        $file_name = date("Ymd") . '_' . rand(10000, 990000) . '.' . $file_extention;
                        if (move_uploaded_file($files["tmp_name"][$i], $FOLDER . $file_name) === FALSE) {
                            Message::addMessage("Error while uploading the file", ERR);
                        } else {
                           // Message::addMessage("File uploaded successfully with name: " . $file_name, SUCCS);
                            $filePath[$i] = $FOLDER.$file_name;
                        }
                    } else {
                        //$error_msg = "File is not a valid image type.";
                        Message::addMessage("File is not a valid image type.", ERR);
                        $run = 'false';
                    }
                }
                if ($imageUploadERROR) {
                    // if upload error break the loop and display the error
                    break;
                }
            }
            
            
        

           $fieldArray = array(
            'topicResponseDescription' => trim($array['topicDescription']),
            'updatedBy' => ((int)User::loggedInUserId() > 0 ? User::loggedInUserId() : 0),
        ); 
                if(isset($array['prevFile']) || !is_array($array['prevFile']) == ''){
                   $filePath = array_merge($filePath,$array['prevFile']);
                   //print_r($filePath);
                   $filePath = json_encode($filePath);
                        $fieldArray['topicResponseFiles'] = $filePath;
               }else{

                    if($filePath != ''){
                        $filePath = json_encode($filePath);
                        $fieldArray['topicResponseFiles'] = $filePath;
                    }
                }


           $update = false;
            if(!$update){ // Create new
                $fieldArray['updatedOn'] = date('Y-m-d H:i:s');
            //echo "UPDATE `tblForumTopicsResponse` SET " . $this->prepareFieldsForInsertOrUpdate($fieldArray) . " WHERE `id`= '" . $array['id'] . "'";die();
                
                $this->query("UPDATE `tblForumTopicsResponse` SET " . $this->prepareFieldsForInsertOrUpdate($fieldArray) . " WHERE `id`= '" . $array['id'] . "'");
            }
            Message::addMessage("Post is updated successfully, please go back to see changes !!!", SUCCS);
       // }
        //}
            return true;
    }

    





    function __destruct(){
        parent::__destruct();
    }
}