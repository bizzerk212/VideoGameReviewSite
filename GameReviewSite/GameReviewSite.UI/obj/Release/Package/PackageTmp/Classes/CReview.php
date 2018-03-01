<?php

/**
 * CReview short summary.
 *
 * CReview description.
 *
 * @version 1.0
 * @author Daniel
 */
class CReview
{
    private $Id;
    private function setId($_id) {   $this->Id = $_id;   }
    public function getId() {  return $this->Id; }
    private $CriticId;
    public function setCriticId($_criticId) {   $this->CriticId = $_criticId;   }
    public function getCriticId() {  return $this->CriticId; }
    private $VideoGameId;
    public function setVideoGameId($_videoGameId) {   $this->VideoGameId = $_videoGameId;   }
    public function getVideoGameId() {  return $this->VideoGameId; }
    private $IsProfessional;
    public function setIsProfessional($_isProfessional) {   $this->IsProfessional = $_isProfessional;   }
    public function getIsProfessional() {  return (bool)$this->IsProfessional; }
    private $Content;
    public function setContent($_content) {   $this->Content = $_content;   }
    public function getContent() {  return $this->Content; }
    private $Comments;
    public function setComents($_comments) {   $this->Comments = $_comments;   }
    public function getComents() {  return $this->Comments; }

    function __construct($_id, $_criticId, $_videoGameId, $_isProfessional, $_content, $_comments)
    {
        $this->Id = $_id;
        $this->CriticId = $_criticId;
        $this->VideoGameId = $_videoGameId;
        $this->IsProfessional = $_isProfessional;
        $this->Content = $_content;
        $this->Comments = $_comments;
    }


    public function GetData($_id)
    {
        include($_SERVER['DOCUMENT_ROOT'].'/dbcon.php');

        $db = new PDO($dns, $username, $password, $options);
        $rs = $db->prepare("select * from `reviews` where Review_ID = :ID;");
        $rs->bindValue(':ID', $_id);
        $rs->execute();
        $row = $rs->fetch();

        $this->Id = $row['Review_ID'];
        $this->CriticId = $row['Critics_ID'];
        $this->VideoGameId = $row['Video_Game_ID'];
        $this->IsProfessional=$row['IsProfessional'];
        $this->Content = $row['Review_Content'];
        $this->Comments = $row['Review_Comments'];

        $rs->closeCursor();
        $db = null;
    }

    public function GetDataByForeignKeys($_criticid, $_videogameid)
    {
        include($_SERVER['DOCUMENT_ROOT'].'/dbcon.php');

        $db = new PDO($dns, $username, $password, $options);
        $rs = $db->prepare("select * from `reviews` where Critics_ID = :CriticsID AND Video_Game_ID = :VideoGameID;");
        $rs->bindValue(':CriticsID', $_criticid);
        $rs->bindValue(':VideoGameID', $_videogameid);
        $rs->execute();
        $row = $rs->fetch();

        $this->Id = $row['Review_ID'];
        $this->CriticId = $row['Critics_ID'];
        $this->VideoGameId = $row['Video_Game_ID'];
        $this->Content = $row['Review_Content'];
        $this->Comments = $row['Review_Comments'];

        $rs->closeCursor();
        $db = null;
    }

    public function Insert()
    {
        include($_SERVER['DOCUMENT_ROOT'].'/dbcon.php');

        $db = new PDO($dns, $username, $password, $options);
        $rs = $db->prepare("insert into `Reviews` values (null, :CriticId, :VideoGameId, :IsProfessional, :Content, :Comments);");
        $rs->bindValue(':CriticId', $this->CriticId);
        $rs->bindValue(':VideoGameId', $this->VideoGameId);
        $rs->bindValue(':IsProfessional', (int)$this->IsProfessional);
        $rs->bindValue(':Content', $this->Content);
        $rs->bindValue(':Comments', $this->Comments);
        $rs->execute();

        $db = null;
    }

    public function Update()
    {
        include($_SERVER['DOCUMENT_ROOT'].'/dbcon.php');

        $db = new PDO($dns, $username, $password, $options);
        $rs = $db->prepare("update `Reviews`
                            set Critics_ID=:CriticId, Video_Game_ID=:VideoGameId, IsProfessional = :IsProfessional, Review_Content = :Content, Review_Comments = :Comments where Review_ID = :ID;");

        $rs->bindValue(':ID', $this->Id);
        $rs->bindValue(':CriticId', $this->CriticId);
        $rs->bindValue(':VideoGameId', $this->VideoGameId);
        $rs->bindValue(':IsProfessional', $this->IsProfessional);
        $rs->bindValue(':Content', $this->Content);
        $rs->bindValue(':Comments', $this->Comments);
        $rs->execute();

        $db = null;
    }

    public function Delete()
    {
        include($_SERVER['DOCUMENT_ROOT'].'/dbcon.php');

        $db = new PDO($dns, $username, $password, $options);
        $rs = $db->prepare("delete from `Reviews` where Video_Game_ID = :ID;");
        $rs->bindValue(':ID', $this->Id);
        $rs->execute();

        $db = null;
    }
}

class CReviewList
{
    var $reviews = array();

    public function Add(CReview $review)
    {
        $this->reviews[] = $review;
    }

    public function Remove(CReview $review)
    {
        if(($key = array_search($review, $this->reviews)) !== false) {
            $this->RemoveAt($key);
        }
    }

    public function RemoveAt(int $key)
    {
        array_splice($this->reviews, $key, 1);
    }

    public function GetData()
    {
        include($_SERVER['DOCUMENT_ROOT'].'/dbcon.php');

        $db = new PDO($dns, $username, $password, $options);
        $rs = $db->prepare("select * from `Reviews`;");
        $rs->execute();
        $row = $rs->fetch();
        while($row != null)
        {
            $review = new CReview($row['Review_ID'], $row['Critics_ID'], $row['Video_Game_ID'], $row['IsProfessional'], $row['Review_Content'], $row['Review_Comments']);

            $this->Add($review);
            $row = $rs->fetch();
        }

        $rs->closeCursor();
        $db = null;
    }

    public function GetDataByVideoGameId($videoGameId)
    {
        include($_SERVER['DOCUMENT_ROOT'].'/dbcon.php');

        $db = new PDO($dns, $username, $password, $options);
        $rs = $db->prepare("select * from `Reviews` where Video_Game_ID = :ID;");
        $rs->bindValue(':ID', $videoGameId);
        $rs->execute();
        $row = $rs->fetch();
        while($row != null)
        {
            $review = new CReview($row['Review_ID'], $row['Critics_ID'], $row['Video_Game_ID'], $row['IsProfessional'],$row['Review_Content'], $row['Review_Comments']);

            $this->Add($review);
            $row = $rs->fetch();
        }

        $rs->closeCursor();
        $db = null;
    }
}