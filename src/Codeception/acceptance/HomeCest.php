<?php


class HomeCest
{
    public function _before(AcceptanceTester $I)
    {
    }

    public function _after(AcceptanceTester $I)
    {
    }

    public function frontPageWorks(AcceptanceTester $I)
    {
        $I->amOnPage('/');
        $I->dontSee('Error');
        $I->dontSee('Exception');
    }

    public function cmsPageWorks(AcceptanceTester $I)
    {
        $I->amOnPage('/cms/');
        $I->dontSee('Error');
        $I->dontSee('Exception');
    }

    public function authorizationWorks(AcceptanceTester $I)
    {
        $I->amOnPage('/cms/');
        $I->see('Login to your account');
        $I->fillField('login', 'manager');
        $I->fillField('password', '');
        $I->click('Login');
        $I->dontSee('Login to your account');
        $I->amOnPage('/cms/?p=home&do=_default');
        $I->see('Dashboard');
    }
}
