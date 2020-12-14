<?php
namespace app\models;
use app\core\DbModel;
class Search_engine extends DbModel {
      public function __construct {
            $this->load->mobile_shop();
      }
      public function getProduct() {
            $getProduct = $this->input->GET('test', TRUE);
            $data = $this->db->query("SELECT * FROM  products WHERE product_name LIKE '%$q%' ");
            return $data->result();
      }
}
?>