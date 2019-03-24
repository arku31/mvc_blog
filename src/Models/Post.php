<?php

namespace App\Models;

class Post extends AbstractModel
{
    protected $table = 'posts';

    protected $id;
    protected $title;
    protected $pictureUrl;
    protected $content;
    protected $user_id;

    /**
     * @param int $page
     * @param int $limit
     * @return array
     */
    public function byPage(int $page, int $limit)
    {
        $offset = abs($limit - ($page * $limit));
        $query = 'SELECT * from '.$this->getTableName() . ' LIMIT '.$limit.'; OFFSET '.$offset;
        return $this->db->fetch($query);
    }

    /**
     * @param string $title
     * @param string $picture_url
     * @param string $content
     * @param int $userId
     * @return int
     */
    public function create(string $title, string $picture_url, string $content, int $userId)
    {
        return $this->db->insert([
            'title' => $title,
            'picture_url' => $picture_url,
            'content' => $content,
            'user_id' => $userId
        ], $this->getTableName());
    }

    /**
     * @param $postId
     * @param $userId
     * @return bool
     */
    public function belongsTo($postId, $userId)
    {
        $query = 'SELECT count(*) as count FROM '.$this->getTableName(). ' WHERE id = :id AND user_id = :user_id LIMIT 1';
        return boolval($this->db->fetchOne($query, ['id' => $postId, 'user_id' => $userId])['count']);
    }

    /**
     * @param $postId
     * @return bool
     */
    public function deleteById($postId)
    {
        $query = 'DELETE FROM '.$this->getTableName(). ' WHERE id = :id LIMIT 1';
        return $this->db->execute($query, ['id' => $postId]);
    }

    /**
     * @param $postId
     * @param string $title
     * @param string $picture_url
     * @param string $content
     */
    public function update($postId, string $title, string $picture_url, string $content)
    {
        //should update
    }
}