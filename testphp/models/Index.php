<?php
namespace models;

class Index
{

    public $baseModel;

    public function __construct()
    {
        $this->baseModel = new BaseModel();
    }

    public function getGroupList($group)
    {
        $query = $this->baseModel->select('groups', 'id_parent', $group);
        if ($query) {
            foreach ($query as &$value) {
                $value['count'] = $this->getCountProduct($value['id']);
            }
        }
        return $query;
    }

    public function getProductList($group)
    {
        $sql = "SELECT products.name FROM products "
            . "JOIN group2product USING(id_group) WHERE group2product.id = ?";
        return $this->baseModel->query($sql, [$group]);
    }

    public function getCountProduct($group)
    {
        $sql = "SELECT products.name FROM products "
            . "JOIN group2product USING(id_group) WHERE group2product.id = ?";
        return $this->baseModel->count($sql, [$group]);
    }

    // Создает и заполняет данными таблицу 'group2product'
    public function migrate()
    {
        $create = "CREATE TABLE `group2product` "
            . "(`id` int(11) NOT NULL,`id_group` int(11) NOT NULL) "
            . "ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";
        $insert = "INSERT INTO `group2product` (`id`, `id_group`) VALUES
        (3, 6),(6, 6),(1, 5),(3, 5),(5, 5),(1, 6),(1, 3),(3, 3),(1, 1),(2, 2),
        (1, 4),(4, 4),(1, 7),(4, 7),(7, 7),(1, 8),(4, 8),(8, 8),(2, 9),(9, 9),
        (2, 10),(10, 10),(0, 1),(0, 2),(0, 3),(0, 4),(0, 5),(0, 6),(0, 7),(0, 8),
        (0, 9),(0, 10)";
        $this->baseModel->execute($create);
        $this->baseModel->execute($insert);
    }
}
