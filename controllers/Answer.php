<?php namespace Ips\Quiz\Controllers;

use BackendMenu;
use Backend\Classes\Controller;

/**
 * Answer Back-end Controller
 */
class Answer extends Controller
{
    public $implement = [
        'Backend.Behaviors.FormController',
        'Backend.Behaviors.ListController'
    ];

    public $formConfig = 'config_form.yaml';
    public $listConfig = 'config_list.yaml';

    public function __construct()
    {
        parent::__construct();

        BackendMenu::setContext('Ips.Quiz', 'quiz', 'answer');
    }

}