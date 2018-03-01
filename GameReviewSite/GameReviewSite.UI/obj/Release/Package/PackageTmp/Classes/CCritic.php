<?php

/**
 * CCritic short summary.
 *
 * CCritic description.
 *
 * @version 1.0
 * @author Lee
 */
class CCritic
{
    private $CriticId;
    public function getId(){return $this->CriticId;}
    private function setId($criticid){$this->CriticId=$criticid;}
    private $CriticName;
    public function getName(){return $this->CriticName;}
    public function setName($criticname){$this->CriticName=$criticname;}
    private $CriticCurrentEmployer;
    public function getCriticCurrentEmployer(){return $this->CriticCurrentEmployer;}
    public function setCriticCurrentEmployer($cce){$this->CriticCurrentEmployer=$cce;}
    private $CriticComments;
    public function getCriticComments(){return $this->CriticComments;}
    public function setCriticsComments($comments){$this->CriticComments=$comments;}
    private $CriticRating;
    public function getCriticRatings(){return $this->CriticRating;}
    public function setCriticRating($rating){$this->CriticRating=$rating;}

    function __construct($_id, $_name, $_employer, $_comments, $_rating)
    {
        $this->CriticId=$_id;
        $this->CriticName=$_name;
        $this->CriticCurrentEmployer=$_employer;
        $this->CriticComments=$_comments;
        $this->CriticRating=$_rating;
    }

    public function GetData($_id)
    {
        include($_SERVER['DOCUMENT_ROOT'].'/dbcon.php');

        $db = new PDO($dns, $username, $password, $options);
        $rs = $db->prepare("select * from `critics` where Critics_ID = :ID;");
        $rs->bindValue(':ID', $_id);
        $rs->execute();
        $row=$rs->fetch();

        $this->CriticId=$row['Critics_ID'];
        $this->CriticName=$row['Critics_Name'];
        $this->CriticCurrentEmployer=$row['Critics_Current_Employer'];
        $this->CriticComments=$row['Critics_Comments'];
        $this->CriticRating=$row['Rating'];

        $rs->closeCursor();
        $db=null;
    }

    public function Insert()
    {
        include($_SERVER['DOCUMENT_ROOT'].'/dbcon.php');

        $db = new PDO($dns, $username, $password, $options);
        $rs = $db->prepare("insert into `critics` values (null, :Name, :Employer, :Comments, :Rating);");
        $rs->bindValue(':Name', $this->CriticName);
        $rs->bindValue(':Employer', $this->CriticCurrentEmployer);
        $rs->bindValue(':Comments', $this->CriticComments);
        $rs->bindValue(':Rating', $this->CriticRating);
        $rs->execute();

        $db=null;
    }

    public function Update()
    {
        include($_SERVER['DOCUMENT_ROOT'].'/dbcon.php');

        $db = new PDO($dns, $username, $password, $options);
        $rs=$db->prepare("update `critics`
                            set Critics_Name=:Name, Critics_Current_Employer=:Employer,
                            Critics_Comments=:Comments, Rating=:Rating
                            where Critics_ID=:ID;");

        $rs->bindValue(':Name', $this->CriticName);
        $rs->bindValue(':Employer', $this->CriticCurrentEmployer);
        $rs->bindValue(':Comments', $this->CriticComments);
        $rs->bindValue(':Rating', $this->CriticRating);
        $rs->bindValue(':ID', $this->CriticId);
        $rs->execute();

        $db=null;
    }

    public function Delete()
    {
        include($_SERVER['DOCUMENT_ROOT'].'/dbcon.php');

        $db = new PDO($dns, $usernme, $password, $options);
        $rs= $db->prepare("delete from `critics` where Critics_ID = :ID");
        $rs->bindValue(':ID', $this->CriticId);
        $rs->execute();

        $db=null;
    }

}

class CCriticList
{
    var $Critics;

    public function Add(CCritic $critic)
    {
        $this->Critics[] = $critic;
    }

    public function Remove(CCritic $critic)
    {
        if (($key=array_search($critic, $this->Critics))!==false)
        {
        	$this->RemoveAt($key);
        }
    }

    public function RemoveAt($key)
    {
        array_splice($this->Critics, $key, 1);
    }

    public function GetData()
    {
        include($_SERVER['DOCUMENT_ROOT'].'/dbcon.php');

        $db = new PDO($dns, $username, $password, $options);
        $rs=$db->prepare("select * from `critics`");
        $rs->execute();
        $row=$rs->fetch();
        while ($row!=null)
        {
        	$critic = new CCritic($row['Critics_ID'], $row['Critics_Name'], $row['Critics_Current_Employer'], $row['Critics_Comments'], $row['Rating']);

            $this->Add($critic);
            $row = $rs->fetch();
        }

        $rs->closeCursor();
        $db = null;
    }
}