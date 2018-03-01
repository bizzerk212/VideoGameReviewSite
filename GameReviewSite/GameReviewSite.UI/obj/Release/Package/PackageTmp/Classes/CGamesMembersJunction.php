<?php

/**
 * CGamesMembersJunction short summary.
 *
 * CGamesMembersJunction description.
 *
 * @version 1.0
 * @author Lee
 */
class CGamesMembersJunction
{
    private $VideoGameId;
    public function getVideoGameId(){return $this->VideoGameId;}
    private function setVideoGameId($videogameId){$this->VideoGameId=$videogameId;}
    private $MemberId;
    public function getMemberId(){return $this->MemberId;}
    public function setMemberId($memberid){$this->MemberId=$memberid;}
    private $GMJComments;
    public function getComments(){return $this->GMJComments;}
    public function setComments($comments){$this->GMJComments=$comments;}


    function __construct($_vid, $_memberid, $_comments)
    {
        $this->VideoGameId=$_vid;
        $this->MemberId=$_memberid;
        $this->GMJComments=$_comments;
    }

    public function GetData($_videogameId, $_memberId)
    {
        include($_SERVER['DOCUMENT_ROOT'].'/dbcon.php');

        $db = new PDO($dns, $username, $password, $options);
        $rs = $db->prepare("select * from `video games/members junction table` where Video_Game_ID = :VideoGameId && Member_ID = :MemberId");
        $rs->bindValue(':VideoGameId', $_videogameId);
        $rs->bindValue(':MemberId', $_memberId);
        $rs->execute();
        $row=$rs->fetch();

        $this->VideoGameId=$row['Video_Game_ID'];
        $this->MemberId=$row['Member_ID'];
        $this->GMJComments=$row['Junction Comments'];

        $rs->closeCursor();
        $db=null;
    }

    public function Insert()
    {
        include($_SERVER['DOCUMENT_ROOT'].'/dbcon.php');

        $db = new PDO($dns, $username, $password, $options);
        $rs = $db->prepare("insert into `video games/members junction table` values (:VideoGameId, :MemberId, :Comments);");
        $rs->bindValue(':VideoGameId', $this->VideoGameId);
        $rs->bindValue(':MemberId', $this->MemberId);
        $rs->bindValue(':Comments', $this->GMJComments);
        $rs->execute();

        $db=null;
    }

    public function Update()
    {
        include($_SERVER['DOCUMENT_ROOT'].'/dbcon.php');

        $db = new PDO($dns, $username, $password, $options);
        $rs=$db->prepare("update `video games/members junction table`
                            set `Junction Comments` = :Comments
                            where Video_Game_Id=:VID AND Member_ID=:MID");


        $rs->bindValue(':VID', $this->VideoGameId);
        $rs->bindValue(':MID', $this->MemberId);
        $rs->bindValue(':Comments', $this->GMJComments);
        $rs->execute();

        $db=null;
    }

    public function Delete()
    {
        include($_SERVER['DOCUMENT_ROOT'].'/dbcon.php');

        $db = new PDO($dns, $usernme, $password, $options);
        $rs= $db->prepare("delete from `video games/members junction table` where Member_ID = :MID AND Video_Game_ID =:VID");
        $rs->bindValue(':MID', $this->MemberId);
        $rs->bindValue(':VID', $this->VideoGameId);
        $rs->execute();

        $db=null;
    }

}

class CGamesMembersJunctionList
{
    var $GameMembers;

    public function Add(CGamesMembersJunction $GMJ)
    {
        $this->GameMembers[] = $GMJ;
    }

    public function Remove(CGamesMembersJunction $GMJ)
    {
        if (($key=array_search($GMJ, $this->GameMembers))!==false)
        {
        	$this->RemoveAt($key);
        }
    }

    public function RemoveAt($key)
    {
        array_splice($this->GameMembers, $key, 1);
    }

    public function GetDataWithMemberId($_memberid)
    {
        include($_SERVER['DOCUMENT_ROOT'].'/dbcon.php');

        $db = new PDO($dns, $username, $password, $options);
        $rs=$db->prepare("select * from `video games/members junction table` where Member_ID = :memberid");
        $rs->bindValue(':memberid', _memberid);
        $rs->execute();
        $row=$rs->fetch();
        while ($row!=null)
        {
        	$Match = new CGamesMembersJunction($row['Video_Game_ID'], $row['Member_ID'], $row['Junction Comments']);

            $this->Add($Match);
            $row = $rs->fetch();
        }

        $rs->closeCursor();
        $db = null;
    }
    public function GetData()
    {
        include($_SERVER['DOCUMENT_ROOT'].'/dbcon.php');

        $db = new PDO($dns, $username, $password, $options);
        $rs=$db->prepare("select * from `video games/members junction table`");
        $rs->execute();
        $row=$rs->fetch();
        while ($row!=null)
        {
        	$Match = new CGamesMembersJunction($row['Video_Game_ID'], $row['Member_ID'], $row['Junction Comments']);

            $this->Add($Match);
            $row = $rs->fetch();
        }

        $rs->closeCursor();
        $db = null;
    }
}