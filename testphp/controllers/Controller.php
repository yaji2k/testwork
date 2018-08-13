<?php
namespace controllers;

use models\Index;

class Controller
{

    public function indexAction()
    {
        if (isset($_GET['group'])) {
            $group = $_GET['group'];
        } else {
            $group = 0;
        }
        $model = new Index();
        $groups = $model->getGroupList($group);
        $products = $model->getProductList($group);
        $this->render(['groups' => $groups, 'products' => $products]);
    }

    public function render($result = [])
    {
        ob_start();
        $array = $result;
        require './views/index.php';
        echo ob_get_clean();
    }
    public function migrateTable() {
        $model = new Index();
        $model->migrate();
    }
}
