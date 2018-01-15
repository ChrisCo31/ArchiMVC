<?php

namespace OpenClassrooms\Blog\Model;
require_once("model/Manager.php");

class CommentManager extends Manager
{
    public function getComments($postId)
    {
        $db = $this->dbConnect();
        $comments = $db->prepare('SELECT id, author, comment, DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%imin%ss\') AS comment_date_fr FROM comments WHERE post_id = ? ORDER BY comment_date DESC');
        $comments->execute(array($postId));

        return $comments;
    }

    public function postComment($postId, $author, $comment)
    {
        $db = $this->dbConnect();
        $comments = $db->prepare('INSERT INTO comments(post_id, author, comment, comment_date) VALUES(?, ?, ?, NOW())');
        $affectedLines = $comments->execute(array($postId, $author, $comment));

        return $affectedLines;
    }

     public function getOneComment($id)
    {
        $db = $this->dbConnect();
        $comment = $db->prepare('SELECT author, comment, DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%imin%ss\') AS comment_date_fr FROM comments WHERE id = ?');
        $comment->execute(array($id));

        return $comment;
    }

      public function update()
    {
          $db = $this->dbConnect();
         $query = $bdd->prepare ("UPDATE comments SET author =:author, comment =:comment WHERE id =:id LIMIT 1");
         $query ->bindValue(':titre', $article->getTitre(), PDO::PARAM_STR);
         $query ->bindValue(':text', $article->getText(), PDO::PARAM_STR);
         $query ->bindValue(':id', $article->getId_article(), PDO::PARAM_INT);
         return $query ->execute();
    }
}