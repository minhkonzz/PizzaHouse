<?php 
   class UploadController extends Controller {
      public function uploadImage(Request $req, array $params = []) {
         try {
            $allowed_formats = array('jpeg', 'png', 'gif');
            $max_size = 2 * 1024 * 1024; // 2MB
            $response = [];
            if (isset($_FILES['file']) && $_FILES['file']['error'] === 0) {
               $image_info = getimagesize($_FILES['file']['tmp_name']);
               $image_size = $_FILES['file']['size'];
               $image_format = strtolower(pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION));
               if (!in_array($image_format, $allowed_formats)) $response = ["success" => 0, "message" => "Định dạng không hỗ trợ"]; 
               else if ($image_size > $max_size) $response = ["success" => 0, "message" => "Kích thước ảnh vượt quá giới hạn cho phép"]; 
               else if ($image_info === false) $response = ["success" => 0, "message" => "Tệp ảnh không hợp lệ!"];
               else $response = ["success" => $_FILES['file']['name'], "message" => "upload thanh cong"]; 
            }
            return (new Response($response))->withJson();
         } catch (InternalErrorException $e) {
            return (new Response([], $e->getCode(), $e->getMessage()))->withJson();
         }
      }
   }
?>