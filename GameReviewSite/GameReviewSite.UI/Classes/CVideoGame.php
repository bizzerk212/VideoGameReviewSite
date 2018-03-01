<?php

/**
 * CVideoGame short summary.
 *
 * CVideoGame description.
 *
 * @version 1.0
 * @author Daniel
 */
class CVideoGame
{
    private $Id;
    private function setId($_id) {   $this->Id = $_id;   }
    public function getId() {  return $this->Id; }
    private $Name;
    public function setName($_name) {   $this->Name = $_name;   }
    public function getName() {  return $this->Name; }
    private $Genre;
    public function setGenre($_genre) {   $this->Genre = $_genre;   }
    public function getGenre() {  return $this->Genre; }
    private $Price;
    public function setPrice($_price) {   $this->Price = $_price;   }
    public function getPrice() {  return $this->Price; }
    private $LetterRating;
    public function setLetterRating($_rating){ $this->LetterRating = $_rating; }
    public function getLetterRating() { return $this->LetterRating; }
    private $ImageFilepath;
    public function setImageFilepath($_imageFilepath) {   $this->ImageFilepath = $_imageFilepath;   }
    public function getImageFilepath() {  return $this->ImageFilepath; }
    private $ThumbnailFilepath;
    public function setThumbnailFilepath($_thumbnailFilepath) {   $this->ThumbnailFilepath = $_thumbnailFilepath;   }
    public function getThumbnailFilepath() {  return $this->ThumbnailFilepath; }
    private $ReleaseDate;
    public function setReleaseDate($_releaseDate) {   $this->ReleaseDate = $_releaseDate;   }
    public function getReleaseDate() {  return $this->ReleaseDate; }
    private $Comments;
    public function setComents($_comments) {   $this->Comments = $_comments;   }
    public function getComents() {  return $this->Comments; }

    //$_id, $_name, $_genre, $_filepath, $_imageFilepath, $_thumbnailFilepath, $_releaseDate, $_comments

    function __construct()
    {
        $numargs= func_num_args();

        if ($numargs==9)
        {
        $this->Id = func_get_arg(0);
        $this->Name = func_get_arg(1);
        $this->Genre = func_get_arg(2);
        $this->Price = func_get_arg(3);
        $this->LetterRating = func_get_arg(4);
        $this->ImageFilepath = func_get_arg(5);
        $this->ThumbnailFilepath = func_get_arg(6);
        $this->ReleaseDate = func_get_arg(7);
        $this->Comments = func_get_arg(8);
        }
        if ($numargs==1)
        {
        	 $this->Id = func_get_arg(0);
        }

    }


    public function GetData($_id)
    {
        include($_SERVER['DOCUMENT_ROOT'].'/dbcon.php');

        $db = new PDO($dns, $username, $password, $options);
        $rs = $db->prepare("select * from `video games` where Video_Game_ID = :ID;");
        $rs->bindValue(':ID', $_id);
        $rs->execute();
        $row = $rs->fetch();

        $this->Id = $row['Video_Game_ID'];
        $this->Name = $row['Video_Game_Name'];
        $this->Genre = $row['Video_Game_Genre'];
        $this->Price = $row['Price'];
        $this->LetterRating = $row['Rating'];
        $this->ImageFilepath = $row['Video_Game_Image_Filepath'];
        $this->ThumbnailFilepath = $row['Video_Game_Thumbnail_Filepath'];
        $this->ReleaseDate = $row['Video_Game_Release_Date'];
        $this->Comments = $row['Video_Game_Description/Comments'];

        $rs->closeCursor();
        $db = null;
    }

    public function Insert()
    {
        include($_SERVER['DOCUMENT_ROOT'].'/dbcon.php');

        $db = new PDO($dns, $username, $password, $options);
        $rs = $db->prepare("insert into `Video games` values (null, :Name, :Genre, :Price, :Rating, :ImageFilepath, :ThumbnailFilepath, :ReleaseDate, :Comments);");
        $rs->bindValue(':Name', $this->Name);
        $rs->bindValue(':Genre', $this->Genre);
        $rs->bindValue(':Price', $this->Price);
        $rs->bindValue(':Rating', $this->LetterRating);
        $rs->bindValue(':ImageFilepath', $this->ImageFilepath);
        $rs->bindValue(':ThumbnailFilepath', $this->ThumbnailFilepath);
        $rs->bindValue(':ReleaseDate', $this->ReleaseDate);
        $rs->bindValue(':Comments', $this->Comments);
        $rs->execute();

        $db = null;
    }

    public function Update()
    {
        include($_SERVER['DOCUMENT_ROOT'].'/dbcon.php');

        $db = new PDO($dns, $username, $password, $options);
        $rs = $db->prepare("update `Video games`
                            set Video_Game_Name = :Name, Video_Game_Genre = :Genre, Price = :Price, Rating = :Rating, Video_Game_Image_Filepath = :ImageFilepath,
                            Video_Game_Thumbnail_Filepath = :ThumbnailFilepath, Video_Game_Release_Date = :ReleaseDate, `Video_Game_Description/Comments` = :Comments;
                            where Video_Game_ID = :ID");

        $rs->bindValue(':ID', $this->Id);
        $rs->bindValue(':Name', $this->Name);
        $rs->bindValue(':Genre', $this->Genre);
        $rs->bindValue(':Price', $this->Price);
        $rs->bindValue('Rating', $this->LetterRating);
        $rs->bindValue(':ImageFilepath', $this->ImageFilepath);
        $rs->bindValue(':ThumbnailFilepath', $this->ThumbnailFilepath);
        $rs->bindValue(':ReleaseDate', $this->ReleaseDate);
        $rs->bindValue(':Comments', $this->Comments);
        $rs->execute();

        $db = null;
    }

    public function Delete()
    {
        include($_SERVER['DOCUMENT_ROOT'].'/dbcon.php');

        $db = new PDO($dns, $username, $password, $options);
        $rs = $db->prepare("delete from `video games` where Video_Game_ID = :ID;");
        $rs->bindValue(':ID', $this->Id);
        $rs->execute();

        $db = null;
    }
}

class CVideoGameList
{
    var $videoGames;

    public function Add(CVideoGame $videoGame)
    {
        $this->videoGames[] = $videoGame;
    }

    public function Remove(CVideoGame $videoGame)
    {
        if(($key = array_search($videoGame, $this->videoGames)) !== false) {
            $this->RemoveAt($key);
        }
    }

    public function RemoveAt(int $key)
    {
        array_splice($this->videoGames, $key, 1);
    }

    public function GetData()
    {
        include($_SERVER['DOCUMENT_ROOT'].'/dbcon.php');

        $db = new PDO($dns, $username, $password, $options);
        $rs = $db->prepare("select * from `video games`;");
        $rs->execute();
        $row = $rs->fetch();
        while($row != null)
        {
            $videoGame = new CVideoGame($row['Video_Game_ID'], $row['Video_Game_Name'], $row['Video_Game_Genre'], $row['Price'], $row['Rating'], $row['Video_Game_Image_Filepath'],
                                        $row['Video_Game_Thumbnail_Filepath'], $row['Video_Game_Release_Date'], $row['Video_Game_Description/Comments']);

            $this->Add($videoGame);
            $row = $rs->fetch();
        }

        $rs->closeCursor();
        $db = null;
    }

    public function GetDataSearch($SearchTerm)
    {
        include($_SERVER['DOCUMENT_ROOT'].'/dbcon.php');
        $SearchTerm = $SearchTerm . "%";
        $Temp = "%" . $SearchTerm;

        $db = new PDO($dns, $username, $password, $options);
        $rs = $db->prepare("select * from `video games` where `Video_Game_Name` like :Term;");
        $rs->bindValue(':Term', $Temp);
        $rs->execute();
        $row = $rs->fetch();
        while($row != null)
        {
            $videoGame = new CVideoGame($row['Video_Game_ID'], $row['Video_Game_Name'], $row['Video_Game_Genre'], $row['Price'], $row['Rating'], $row['Video_Game_Image_Filepath'],
                                        $row['Video_Game_Thumbnail_Filepath'], $row['Video_Game_Release_Date'], $row['Video_Game_Description/Comments']);

            $this->Add($videoGame);
            $row = $rs->fetch();
        }

        $rs->closeCursor();
        $db = null;
    }
    public function FindDataBySearch(string $SearchTerm)
    {
        $tempArray;
        foreach($this->videoGames as $vg)
        {
            if(strpos($vg->getName(), $SearchTerm) !== false)
            {
                $tempArray[] = $vg;
            }
        }

        $this->videoGames = $tempArray;

    }

    public function FindDataByGenres($Ids)
    {
        $tempArray;
        foreach($this->videoGames as $vg)
        {
            foreach($Ids as $id)
            {
                if($vg->getGenre() == $id)
                {
                    $tempArray[] = $vg;
                }
            }
        }

        $this->videoGames = $tempArray;
    }
}