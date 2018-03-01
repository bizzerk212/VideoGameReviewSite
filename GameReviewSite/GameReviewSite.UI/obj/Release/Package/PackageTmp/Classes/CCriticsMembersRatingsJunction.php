<?php

/**
 * CCriticsMembersRatingsJunction short summary.
 *
 * CCriticsMembersRatingsJunction description.
 *
 * @version 1.0
 * @author Daniel
 */
class CCriticsMembersRatingsJunction
{
    private $CriticId;
    public function getCriticId(){return $this->CriticId;}
    private function setCriticId($_id){$this->CriticId = $_id;}
    private $MemberId;
    public function getMemberId(){return $this->MemberId;}
    private function setMemberId($_id){$this->MemberId = $_id;}
    private $Rating;
    public function getRating(){return $this->Rating;}
    public function setRating($_rating){$this->Rating=$_rating;}

    function __construct($_criticId, $_memberId, $_rating)
    {
        $this->CriticId = $_criticId;
        $this->MemberId = $_memberId;
        $this->Rating = $_rating;
    }

    public function GetData($_criticId, $_memberId)
    {
        include($_SERVER['DOCUMENT_ROOT'].'/dbcon.php');

        $db = new PDO($dns, $username, $password, $options);
        $rs =  $db->prepare("select * from `critics/members rating junction` where critics_id = :CriticId and member_id = :MemberId;");
        $rs->bindValue(':CriticId', $_criticId);
        $rs->bindValue(':MemberId', $_memberId);
        $rs->execute();
        $row = $rs->fetch();

        $this->CriticId = $row['Critics_ID'];
        $this->MemberId = $row['Member_ID'];
        $this->Rating = $row['Rating'];

        $rs->closeCursor();
        $db=null;
    }

    public function Insert()
    {
        include($_SERVER['DOCUMENT_ROOT'].'/dbcon.php');

        $db = new PDO($dns, $username, $password, $options);
        $rs = $db->prepare("insert into `critics/members rating junction` values (:CriticId, :MemberId, :Rating);");
        $rs->bindValue(':CriticId', $this->CriticId);
        $rs->bindValue(':MemberId', $this->MemberId);
        $rs->bindValue(':Rating', $this->Rating);
        $rs->execute();

        $db=null;
    }

    public function Update()
    {
        include($_SERVER['DOCUMENT_ROOT'].'/dbcon.php');

        $db = new PDO($dns, $username, $password, $options);
        $rs = $db->prepare("update `critics/members rating junction`
                            set Rating = :Rating
                            where Critic_ID = :CriticId and Member_ID = :MemberId");

        $rs->bindValue(':CriticId', $this->CritcId);
        $rs->bindValue(':MemberId', $this->MemberId);
        $rs->bindValue(':Rating', $this->Rating);
        $rs->execute();

        $db=null;
    }

    public function Delete()
    {
        include($_SERVER['DOCUMENT_ROOT'].'/dbcon.php');

        $db = new PDO($dns, $username, $password, $options);
        $rs = $db->prepare("delete from `critics/members rating junction` where Critic_ID = :Critic_ID and Member_ID = :MemberId;");

        $rs->bindValue(':CriticId', $this->CriticId);
        $rs->bindValue(':MemberId', $this->MemberId);
        $rs->execute();

        $db = null;
    }
}

class CCriticsMembersRatingsJunctionList
{
    public $CriticMemberRatings;

    public function Add(CCriticsMembersRatingsJunction $CriticMemberRating)
    {
        $this->CriticMemberRatings[]= $CriticMemberRating;
    }

    public function Remove(CCriticsMembersRatingsJunction $CriticMemberRating)
    {
        if (($key=array_search($CriticMemberRating, $this->CriticMemberRatings))!==false)
        {
        	$this->RemoveAt($key);
        }
    }

    public function RemoveAt($key)
    {
        array_splice($this->CriticMemberRatings, $key, 1);
    }

    public function GetData()
    {
        include($_SERVER['DOCUMENT_ROOT'].'/dbcon.php');

        $db = new PDO($dns, $username, $password, $options);
        $rs=$db->prepare("select * from `critics/members rating junction`");
        $rs->execute();
        $row = $rs->fetch();
        while($row != null)
        {
            $CriticMemberRating = new CCriticsMembersRatingsJunction($row['Critics_ID'], $row['Member_ID'], $row['Rating']);

            $this->Add($CriticMemberRating);
            $row = $rs->fetch();
        }

        $rs->closeCursor();
        $db = null;
    }

    public function GetDataByCriticId($_criticId)
    {
        include($_SERVER['DOCUMENT_ROOT'].'/dbcon.php');

        $db = new PDO($dns, $username, $password, $options);
        $rs=$db->prepare("select * from `critics/members rating junction` where Critic_ID = :CriticId");
        $rs->bindValue(':CriticId', $_criticId);
        $rs->execute();
        $row = $rs->fetch();
        while($row != null)
        {
            $CriticMemberRating = new CCriticsMembersRatingsJunction($row['Critic_ID'], $row['Member_ID'], $row['Rating']);

            $this->Add($CriticMemberRating);
            $row = $rs->fetch();
        }

        $rs->closeCursor();
        $db = null;
    }

    public function GetDataByMemberId($_memberId)
    {
        include($_SERVER['DOCUMENT_ROOT'].'/dbcon.php');

        $db = new PDO($dns, $username, $password, $options);
        $rs=$db->prepare("select * from `critics/members rating junction` where Member_ID = :MemberId");
        $rs->bindValue(':MemberId', $_memberId);
        $rs->execute();
        $row = $rs->fetch();
        while($row != null)
        {
            $CriticMemberRating = new CCriticsMembersRatingsJunction($row['Critic_ID'], $row['Member_ID'], $row['Rating']);

            $this->Add($CriticMemberRating);
            $row = $rs->fetch();
        }

        $rs->closeCursor();
        $db = null;
    }
}