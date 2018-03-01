
function checktxturl() {
    if (document.getElementById("txtURL").checked) {
        document.getElementById("txtURL").classname = "show";
    }
    else {
        document.getElementById("txtURL").classname = "hide";
    }
}

//function check() {
//    document.getElementById("doom").className = "hide";
//    document.getElementById("rocket-league").className = "hide";
//    document.getElementById("civ-vi").className = "hide";
//    document.getElementById("overwatch").className = "hide";
//    document.getElementById("cod-mwr").className = "hide";
//    document.getElementById("skyrim-se").className = "hide";
//    document.getElementById("gow4").className = "hide";
//    document.getElementById("titanfall2").className = "hide";
//    document.getElementById("nba-2k17").className = "hide";
//    document.getElementById("fifa17").className = "hide";

//    if (document.getElementById("fps").checked) {
//        document.getElementById("doom").className = "show";
//        document.getElementById("overwatch").className = "show";
//        document.getElementById("cod-mwr").className = "show";
//        document.getElementById("gow4").className = "show";
//        document.getElementById("titanfall2").className = "show";
//    }
//    if (document.getElementById("mmorpg").checked) {

//    }
//    if (document.getElementById("rpg").checked) {
//        document.getElementById("skyrim-se").className = "show";
//    }
//    if (document.getElementById("sports").checked) {
//        document.getElementById("rocket-league").className = "show";
//        document.getElementById("nba-2k17").className = "show";
//        document.getElementById("fifa17").className = "show";
//    }
//    if (document.getElementById("racing").checked) {

//    }
//    if (document.getElementById("fps").checked == false
//        && document.getElementById("mmorpg").checked == false
//        && document.getElementById("mmorpg").checked == false
//        && document.getElementById("rpg").checked == false
//        && document.getElementById("sports").checked == false
//        && document.getElementById("racing").checked == false) {

//        document.getElementById("doom").className = "show";
//        document.getElementById("rocket-league").className = "show";
//        document.getElementById("civ-vi").className = "show";
//        document.getElementById("overwatch").className = "show";
//        document.getElementById("cod-mwr").className = "show";
//        document.getElementById("skyrim-se").className = "show";
//        document.getElementById("gow4").className = "show";
//        document.getElementById("titanfall2").className = "show";
//        document.getElementById("nba-2k17").className = "show";
//        document.getElementById("fifa17").className = "show";
//    }
//}

function expand() {
    if (document.getElementById("genre-radio").checked == false) {
        document.getElementById("genre").className = "grow";
    }
}

function limit()
{
    var checkedBoxes = new Array();
    var allBoxes = document.getElementsByClassName("Genre");
    var search = document.getElementById("searchtext").value;

    //if (window.location.href != "https://teamnameteam4.azurewebsites.net/") {
    //    window.location.assign("https://teamnameteam4.azurewebsites.net/");
    //    document.getElementById("searchtext").value = search;
    //}

    for (var i = 0; i < allBoxes.length; i++) {
        if (allBoxes[i].checked) {
            checkedBoxes.push(allBoxes[i]);
        }
    }
    var url = "";

    if (search != "") {
        url = "?Search=" + search;
    }

    for (var i = 0; i < checkedBoxes.length ; i++) {
        if (search != "")
        {
            url += "&Id[]=" + checkedBoxes[i].id;
        }
        else
        {
            if (i == 0)
            {
                url = "?Id[]=" + checkedBoxes[i].id;
            }
            else
                url += "&Id[]=" + checkedBoxes[i].id;
        }
    }

    //do ajax stuff here

    $('#gameBoxContainer').load('gameList.php' + url);
}

/* This version of the script does not work and I do not know why.
   i replaced all of the document.getElementById(""); statements with variables,
   however when this is run the script breaks.
*/
/*
function check() {
    
    var doom = document.getElementById("doom");
    var rocketleague = document.getElementById("rocket-league");
    var civvi = document.getElementById("civ-vi");
    var overwatch = document.getElementById("overwatch");
    var codmwr = document.getElementById("cod-mwr");
    var skyrimse = document.getElementById("skyrim-se");
    var gow4 = document.getElementById("gow4");
    var titanfall2 = document.getElementById("titanfall2");
    var nba2k17 = document.getElementById("nba-2k17");
    var fifa17 = document.getElementById("fifa17");
    var fps = document.getElementById("fps");
    var mmorpg = document.getElementById("mmorpg");
    var rpg = document.getElementById("rpg");
    var sports = document.getElementById("sports");
    var racing = document.getElementById("racing");

    doom.className = "hide";
    rocketleague.className = "hide";
    civvi.className = "hide";
    overwatch.className = "hide";
    codmwr.className = "hide";
    skyrimse.className = "hide";
    gow4.className = "hide";
    titanfall2.className = "hide";
    nbk2k17.className = "hide";
    fifa17.className = "hide";

    if (fps.checked) {
        doom.className = "show";
        overwatch.className = "show";
        codmwr.className = "show";
        gow4.className = "show";
        titanfall2.className = "show";
    }
    if (mmorpg.checked) {

    }
    if (rpg.checked) {
        skyrimse.className = "show";
    }
    if (sports.checked) {
        rocketleague.className = "show";
        nbk2k17.className = "show";
        fifa17.className = "show";
    }
    if (racing.checked) {

    }
    if (fps.checked == false
        && mmorpg.checked == false
        && rpg.checked == false
        && sports.checked == false
        && racing.checked == false) {

        doom.className = "show";
        rocketleague.className = "show";
        civvi.className = "show";
        overwatch.className = "show";
        codmwr.className = "show";
        skyrimse.className = "show";
        gow4.className = "show";
        titanfall2.className = "show";
        nbk2k17.className = "show";
        fifa17.className = "show";
    }
}
*/