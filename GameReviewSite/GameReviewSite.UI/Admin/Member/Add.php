<?php
include($_SERVER['DOCUMENT_ROOT'].'/Classes/CMember.php');
$member = new CMember();
$member->setName("TestUser");
$member->setEMail("Testuser@test.com");
$member->setUsername("IAmJustATest");
$member->setPassword("test");
$member->setConfirmCode("THIS IS A TEST");
$member->setImagePAthway("None");
$member->setMemberComments("None");
$member->Insert();

$members = new CMemberList();
$members->GetData();
$member = $members->Members[count($members->Members)-1];
$member->setUsername("IHopeThisWorks");
$member->Update();

$result = $member->Login("IHopeThisWorks", "test");
echo $result;

$member->Delete();
?>