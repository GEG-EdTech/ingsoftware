<?php 
$I = new AcceptanceTester($scenario);
$I->wantTo('login into ingsoftware site');
$I->amOnPage('http://localhost/ingsoftware/login.php');
$I->fillField('username', 'Daniela');
$I->fillField('password', 'scooby');
$I->click('submit');