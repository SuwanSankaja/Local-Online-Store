<?php
#[AllowDynamicProperties]

class View {
    protected string $_head, $_body, $_outputBuffer;
    protected string $_layout = DEFAULT_LAYOUT, $_siteTitle = SITE_TITLE;
    public string|null $displayErrors = null;
    public array $itemsToDisplay = [];
    public function __construct() {

    }

    public function render($view): void
    {
        $viewAry = explode('/', $view);
        $viewString = implode(DS, $viewAry);
        if (file_exists(ROOT . DS . 'app' . DS . 'views' . DS . $viewString . '.php')) {
            include(ROOT . DS . 'app' . DS . 'views' . DS . $viewString . '.php');
            include(ROOT . DS . 'app' . DS . 'views' . DS . 'layouts' . DS . $this->_layout . '.php');
        } else {
            die('The view \"' . $view . '\" does not exist');
        }
    }

    public function content($type)
    {
        if ($type == 'head') {
            return $this->_head;
        } elseif ($type == 'body') {
            return $this->_body;
        }
        return false;
    }

    public function start($type): void
    {
        $this->_outputBuffer = $type;
        ob_start();
    }

    public function end(): void
    {
        if ($this->_outputBuffer == 'head') {
            $this->_head = ob_get_clean();
        } elseif ($this->_outputBuffer == 'body') {
            $this->_body = ob_get_clean();
        } else {
            die('You must first run the start method.');
        }
    }

    public function siteTitle(): string
    {
        return $this->_siteTitle;
    }

    public function setSiteTitle($title): void
    {
        $this->_siteTitle = $title;
    }

    public function setLayout($path): void
    {
        $this->_layout = $path;
    }
}