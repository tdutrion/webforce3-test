<?php

namespace Model;

use W\Model\Model;

class ArticleModel extends Model
{
    public function getColumns()
    {
        return [
            'id',
            'title',
            'content',
            'date_add',
            'author',
        ];
    }

    public function getTotalRecords()
    {
        $sth = $this->dbh->prepare("SELECT count(id) FROM {$this->table}");
        $sth->execute();

        return $sth->fetchColumn();
    }
}
