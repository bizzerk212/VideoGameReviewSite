<?php

/**
 * CMember short summary.
 *
 * CMember description.
 *
 * @version 1.0
 * @author Lee
 */
class CMember
{
    private $MemberId;
    public function getId(){return $this->MemberId;}
    public function setId($_id){$this->MemberId = $_id;}
    private $MemberName;
    public function getName(){return $this->MemberName;}
    public function setName($_name){$this->MemberName=$_name;}
    private $MemberEMail;
    public function getEMail(){return $this->MemberEMail;}
    public function setEMail($_email){$this->MemberEMail=$_email;}
    private $MemberUsername;
    public function getUsername(){return $this->MemberUsername;}
    public function setUsername($_username){$this->MemberUsername=$_username;}
    private $MemberPassword;
    private function getPassword(){$this->MemberPassword = $this->HashPassword(); return $this->MemberPassword;}
    public function setHashedPassword($password){$this->MemberPassword=$password;}
    private $ClearPassword;
    public function setPassword($password){$this->ClearPassword=$password;}
    private function getClearPassword(){return $this->ClearPassword;}
    private $MemberSalt;
    public function setSalt($salt){$this->MemberSalt=$salt;}
    private function getSalt(){return $this->MemberSalt;}
    private $MemberConfirmCode;
    public function getConfirmCode(){return $this->MemberConfirmCode;}
    public function setConfirmCode($_code){$this->MemberConfirmCode=$_code;}
    private $MemberImagePathway;
    public function getImagePathway(){return $this->MemberImagePathway;}
    public function setImagePAthway($_imagepathway){$this->MemberImagePathway=$_imagepathway;}
    private $MemberComments;
    public function getMemberComments(){return $this->MemberComments;}
    public function setMemberComments($_membercomments){$this->MemberComments=$_membercomments;}

    //function __construct($_id, $_name, $_email, $_username, $_password, $_code, $_imagepathway, $_membercomments)
    //{
    //    $this->MemberId=$_id;
    //    $this->MemberName=$_name;
    //    $this->MemberEMail=$_email;
    //    $this->MemberUsername=$_username;
    //    $this->ClearPassword=$_password;
    //    $this->MemberConfirmCode=$_code;
    //    $this->MemberImagePathway=$_imagepathway;
    //    $this->MemberComments=$_membercomments;
    //}

    public function GetData($_id)
    {
        include($_SERVER['DOCUMENT_ROOT'].'/dbcon.php');

        $db = new PDO($dns, $username, $password, $options);
        $rs =  $db->prepare("select * from `members` where Member_Id = :ID;");
        $rs->bindValue(':ID', $_id);
        $rs->execute();
        $row = $rs->fetch();

        $this->MemberId=$row['Member_ID'];
        $this->MemberName=$row['name'];
        $this->MemberEMail=$row['email'];
        $this->MemberUsername=$row['username'];
        $this->MemberPassword=$row['password'];
        $this->MemberSalt=$row['salt'];
        $this->MemberConfirmCode=$row['confirmcode'];
        $this->MemberImagePathway=$row['Member_Image_Pathway'];
        $this->MemberComments=$row['Member_Comments'];

        $rs->closeCursor();
        $db=null;
    }

    public function Insert()
    {
        include($_SERVER['DOCUMENT_ROOT'].'/dbcon.php');

        $db = new PDO($dns, $username, $password, $options);
        $rs = $db->prepare("insert into `members` values (null, :Name, :EMail, :Username, :Password, :Salt, :ConfirmCode, :ImagePathway, :Comments);");
        $rs->bindValue(':Name', $this->MemberName);
        $rs->bindValue(':EMail', $this->MemberEMail);
        $rs->bindValue(':Username', $this->MemberUsername);
        $rs->bindValue(':Password', $this->getPassword());
        $rs->bindValue(':Salt', $this->MemberSalt);
        $rs->bindValue(':Name', $this->MemberName);
        $rs->bindValue(':ConfirmCode', $this->MemberConfirmCode);
        $rs->bindValue(':ImagePathway', $this->MemberImagePathway);
        $rs->bindValue(':Comments', $this->MemberComments);
        $rs->execute();

        $db=null;
    }

    public function Update()
    {
        include($_SERVER['DOCUMENT_ROOT'].'/dbcon.php');

        $db = new PDO($dns, $username, $password, $options);
        $rs = $db->prepare("update `members`
                            set name = :Name, email = :EMail, username = :Username, password = :Password,
                            confirmcode = :ConfirmCode, Member_Image_Pathway = :ImagePathway, Member_Comments = :Comments
                            where Member_ID = :ID;");

        $rs->bindValue(':ID', $this->MemberId);
        $rs->bindValue(':Name', $this->MemberName);
        $rs->bindValue(':EMail', $this->MemberEMail);
        $rs->bindValue(':Username', $this->MemberUsername);
        $rs->bindValue(':Password', $this->MemberPassword);
        $rs->bindValue(':Name', $this->MemberName);
        $rs->bindValue(':ConfirmCode', $this->MemberConfirmCode);
        $rs->bindValue(':ImagePathway', $this->MemberImagePathway);
        $rs->bindValue(':Comments', $this->MemberComments);
        $rs->execute();

        $db=null;
    }

    public function Delete()
    {
        include($_SERVER['DOCUMENT_ROOT'].'/dbcon.php');

        $db = new PDO($dns, $username, $password, $options);
        $rs = $db->prepare("delete from `members` where Member_ID = :ID;");
        $rs->bindValue(':ID', $this->MemberId);
        $rs->execute();

        $db = null;
    }

    private function GenerateSalt()
    {
        $salt = uniqid(mt_rand(), true);
        $this->MemberSalt = $salt;
        return $salt;
    }

    private function HashPassword()
    {
        return hash("sha512", ($this->ClearPassword + $this->GenerateSalt()));
    }

    public function Login($userName, $password)
    {

        $oMemberList = new CMemberList();
        $oMemberList->GetData();
        $mbu[] = null;
        foreach($oMemberList->Members as $m)
        {
            if ($m->MemberUsername == $userName)
            {
                $mbu[]=$m;
            }
        }
        foreach($mbu as $m)
        {
            if ($m != null)
            {
                if ($m->getPassword() == hash("sha512", ($password + $m->getSalt())))
                {
                    return true;
                }
            }
        }
        return false;
    }
}

class CMemberList
{
    var $Members;

    public function Add(CMember $member)
    {
        if ($this->Members == null)
        {
            $this->Members[0]= $member;
        }
        else
        {
            $this->Members[]=$member;
        }
    }

    public function Remove(CMember $member)
    {
        if (($key=array_search($member, $this->pMembers))!==false)
        {
        	$this->RemoveAt($key);
        }
    }

    public function RemoveAt($key)
    {
        array_splice($this->Members, $key, 1);
    }

    public function GetData()
    {
        include($_SERVER['DOCUMENT_ROOT'].'/dbcon.php');

        $db = new PDO($dns, $username, $password, $options);
        $rs=$db->prepare("select * from `members`");
        $rs->execute();
        $row = $rs->fetch();
        while($row != null)
        {
            $member = new CMember();
            $member->setId($row['Member_ID']);
            $member->setName($row['name']);
            $member->setEMail($row['email']);
            $member->setUsername($row['username']);
            $member->setHashedPassword($row['password']);
            $member->setSalt($row['salt']);
            $member->setConfirmCode($row['confirmcode']);
            $member->setImagePAthway($row['Member_Image_Pathway']);
            $member->setMemberComments($row['Member_Comments']);

            $this->Add($member);
            $row = $rs->fetch();
        }

        $rs->closeCursor();
        $db = null;
    }
}