<?php

/**
 * CBlockedCritics short summary.
 *
 * CBlockedCritics description.
 *
 * @version 1.0
 * @author Daniel
 */
class CBlockedCritic
{
    private $CriticId;
    public function getCriticId(){return $this->CriticId;}
    private function setCriticId($_id){$this->CriticId = $_id;}
    private $MemberId;
    public function getMemberId(){return $this->MemberId;}
    private function setMemberId($_id){$this->MemberId = $_id;}
    private $Comments;
    public function getComments(){return $this->Comments;}
    public function setComments($_comments){$this->Comments=$_comments;}

    function __construct($_criticId, $_memberId, $_comments)
    {
        $this->CriticId = $_criticId;
        $this->MemberId = $_memberId;
        $this->Comments = $_comments;
    }

    public function GetData($_criticId, $_memberId)
    {
        include($_SERVER['DOCUMENT_ROOT'].'/dbcon.php');

        $db = new PDO($dns, $username, $password, $options);
        $rs =  $db->prepare("select * from `blocked_critics_junction` where Critics_ID = :CriticId and Member_ID = :MemberId;");
        $rs->bindValue(':CriticId', $_criticId);
        $rs->bindValue(':MemberId', $_memberId);
        $rs->execute();
        $row = $rs->fetch();

        $this->CriticId = $row['Critics_ID'];
        $this->MemberId = $row['Member_ID'];
        $this->Comments = $row['Blocked Critics Junction Comments'];

        $rs->closeCursor();
        $db=null;
    }

    public function Insert()
    {
        include($_SERVER['DOCUMENT_ROOT'].'/dbcon.php');

        $db = new PDO($dns, $username, $password, $options);
        $rs = $db->prepare("insert into `blocked_critics_junction` values (:CriticId, :MemberId, :Comments);");
        $rs->bindValue(':CriticId', $this->CriticId);
        $rs->bindValue(':MemberId', $this->MemberId);
        $rs->bindValue(':Comments', $this->Comments);
        $rs->execute();

        $db=null;
    }

    public function Update()
    {
        include($_SERVER['DOCUMENT_ROOT'].'/dbcon.php');

        $db = new PDO($dns, $username, $password, $options);
        $rs = $db->prepare("update `blocked_critics_junction`
                            set `Blocked Critics Junction Comments` = :Comments
                            where Critics_ID = :CriticId and Member_ID = :MemberId;");

        $rs->bindValue(':CriticId', $this->CriticId);
        $rs->bindValue(':MemberId', $this->MemberId);
        $rs->bindValue(':Comments', $this->Comments);
        $Check=$rs->execute();

        $db=null;
    }

    public function Delete()
    {
        include($_SERVER['DOCUMENT_ROOT'].'/dbcon.php');

        $db = new PDO($dns, $username, $password, $options);
        $rs = $db->prepare("delete from `blocked_critics_junction` where Critics_ID = :Critic_ID and Member_ID = :MemberId;");

        $rs->bindValue(':CriticId', $this->CriticId);
        $rs->bindValue(':MemberId', $this->MemberId);
        $rs->execute();

        $db = null;
    }
}

class CBlockedCriticList
{
    var $BlockedCritics;

    public function Add(CBlockedCritic $blockedCritic)
    {
        $this->BlockedCritics[]= $blockedCritic;
    }

    public function Remove(CBlockedCritic $blockedCritic)
    {
        if (($key=array_search($blockedCritic, $this->BlockedCritics))!==false)
        {
        	$this->RemoveAt($key);
        }
    }

    public function RemoveAt($key)
    {
        array_splice($this->BlockedCritics, $key, 1);
    }

    public function GetData()
    {
        include($_SERVER['DOCUMENT_ROOT'].'/dbcon.php');

        $db = new PDO($dns, $username, $password, $options);
        $rs=$db->prepare("select * from `blocked_critics_junction`");
        $rs->execute();
        $row = $rs->fetch();
        while($row != null)
        {
            $blockedCritic = new CBlockedCritic($row[0], $row['Member_ID'], $row['Blocked Critics Junction Comments']);

            $this->Add($blockedCritic);
            $row = $rs->fetch();
        }

        $rs->closeCursor();
        $db = null;
    }

    public function GetDataByMemberId($_memberId)
    {
        include($_SERVER['DOCUMENT_ROOT'].'/dbcon.php');

        $db = new PDO($dns, $username, $password, $options);
        $rs=$db->prepare("select * from `blocked_critics_junction` where Member_ID = :MemberId");
        $rs->bindValue(':MemberId', $_memberId);
        $rs->execute();
        $row = $rs->fetch();
        while($row != null)
        {
            $blockedCritic = new CBlockedCritic($row['Critics_ID'], $row['Member_ID'], $row['Blocked Critics Junction Comments']);

            $this->Add($blockedCritic);
            $row = $rs->fetch();
        }

        $rs->closeCursor();
        $db = null;
    }

    public function GetDataByCriticId($_criticId)
    {
        include($_SERVER['DOCUMENT_ROOT'].'/dbcon.php');

        $db = new PDO($dns, $username, $password, $options);
        $rs=$db->prepare("select * from `blocked_critics_junction` where Critic_ID = :CriticId");
        $rs->bindValue(':CriticId', $_criticId);
        $rs->execute();
        $row = $rs->fetch();
        while($row != null)
        {
            $blockedCritic = new CBlockedCritic($row['Critics_ID'], $row['Member_ID'], $row['Blocked Critics Junction Comments']);

            $this->Add($blockedCritic);
            $row = $rs->fetch();
        }

        $rs->closeCursor();
        $db = null;
    }
}