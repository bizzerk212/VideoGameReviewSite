<?php

/**
 * CGenre short summary.
 *
 * CGenre description.
 *
 * @version 1.0
 * @author Daniel
 */
class CGenre
{
    private $Id;
    public function getId(){return $this->Id;}
    private function setId($_id){$this->Id = $_id;}
    private $Abbreviation;
    public function getAbbreviation(){return $this->Abbreviation;}
    public function setAbbreviation($_id){$this->Abbreviation = $_id;}
    private $Description;
    public function getDescription(){return $this->Description;}
    public function setDescription($_Description){$this->Description=$_Description;}

    function __construct($_Id, $_Abbreviation, $_Description)
    {
        $this->Id = $_Id;
        $this->Abbreviation = $_Abbreviation;
        $this->Description = $_Description;
    }

    public function GetData($_Id)
    {
        include($_SERVER['DOCUMENT_ROOT'].'/dbcon.php');

        $db = new PDO($dns, $username, $password, $options);
        $rs =  $db->prepare("select * from `genre` where ID = :Id;");
        $rs->bindValue(':Id', $_Id);
        $rs->execute();
        $row = $rs->fetch();

        $this->Id = $row['ID'];
        $this->Abbreviation = $row['Abbreviation'];
        $this->Description = $row['Description'];

        $rs->closeCursor();
        $db=null;
    }

    public function Insert()
    {
        include($_SERVER['DOCUMENT_ROOT'].'/dbcon.php');

        $db = new PDO($dns, $username, $password, $options);
        $rs = $db->prepare("insert into `genre` values (null, :Abbreviation, :Description);");
        $rs->bindValue(':Abbreviation', $this->Abbreviation);
        $rs->bindValue(':Description', $this->Description);
        $rs->execute();

        $db=null;
    }

    public function Update()
    {
        include($_SERVER['DOCUMENT_ROOT'].'/dbcon.php');

        $db = new PDO($dns, $username, $password, $options);
        $rs = $db->prepare("update `genre`
                            set Abbreviation = :Abbreviation, Description = :Description
                            where ID = :Id;");

        $rs->bindValue(':Id', $this->Id);
        $rs->bindValue(':Abbreviation', $this->Abbreviation);
        $rs->bindValue(':Description', $this->Description);
        $Check=$rs->execute();

        $db=null;
    }

    public function Delete()
    {
        include($_SERVER['DOCUMENT_ROOT'].'/dbcon.php');

        $db = new PDO($dns, $username, $password, $options);
        $rs = $db->prepare("delete from `genre` where ID = :Id;");

        $rs->bindValue(':Id', $this->Id);
        $rs->bindValue(':Abbreviation', $this->Abbreviation);
        $rs->execute();

        $db = null;
    }
}
class CGenreList
{
    var $Genres;

    public function Add(CGenre $genre)
    {
        $this->Genres[]= $genre;
    }

    public function Remove(CGenre $genre)
    {
        if (($key=array_search($genre, $this->Genres))!==false)
        {
        	$this->RemoveAt($key);
        }
    }

    public function RemoveAt($key)
    {
        array_splice($this->Genres, $key, 1);
    }

    public function GetData()
    {
        include($_SERVER['DOCUMENT_ROOT'].'/dbcon.php');

        $db = new PDO($dns, $username, $password, $options);
        $rs=$db->prepare("select * from `genre`");
        $rs->execute();
        $row = $rs->fetch();
        while($row != null)
        {
            $Genre = new CGenre($row['ID'], $row['Abbreviation'], $row['Description']);

            $this->Add($Genre);
            $row = $rs->fetch();
        }

        $rs->closeCursor();
        $db = null;
    }
}