<?php
namespace App\Core;

interface RouterInterface
{
    public function determineController();
    public function determineAction();
    public function determineParams();
    public function getController();
    public function getAction();
    public function getParams();
    public function getRequest();
}