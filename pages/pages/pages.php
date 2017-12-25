<?php

define('MESSAGE_PER_PAGE', 10);

class Controller
{
    private $model;
    private $view;

    public function run()
    {
        $this->model = new Model();
        $this->model->run();
        if ($error = $this->model->getError())
        {
            var_dump($error);
        }
        else
        {
            $this->view = new View();
            $this->view->render($this->model->getData(), $this->model->getNumber(), $this->model->getPagesCount());
        }
    }
}


class Model
{
    private $data;
    private $number;
    private $pagesCount;
    private $error = '';

    public function run()
    {
        require "text.php";  //подключаем файл с текстом
        $this->data = explode(PHP_EOL, $text);  //делим текст на абзацы

        $this->number = empty($_GET['number']) ? 1 : intval($_GET['number']);
        $this->calculatePagesCount();

        if (!$this->checkNumber())
            $this->error = 'Страница не существует';
    }

    private function calculatePagesCount()
    {
        $this->pagesCount = ceil(count($this->data) / MESSAGE_PER_PAGE);
    }

    private function checkNumber()
    {
        return ($this->number > 0 && $this->number <= $this->pagesCount);
    }

    public function getData()
    {
        return array_slice($this->data, ($this->number - 1) * MESSAGE_PER_PAGE, MESSAGE_PER_PAGE);
    }

    /**
     * @return mixed
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * @return mixed
     */
    public function getPagesCount()
    {
        return $this->pagesCount;
    }

    /**
     * @return string
     */
    public function getError(): string
    {
        return $this->error;
    }


}

class View
{
    private $data;
    function render($data, $number, $pagesCount)
    {
        $this->data = $data;
        $this->viewHeader();
        $this->viewData();
        $this->viewPagination($number, $pagesCount);
        $this->viewFooter();
    }

    function viewHeader()
    {

    }

    function viewData()
    {
        echo '<div class="container">';
        foreach ($this->data as $item)
        {
            echo '<p>';
            $this->firstLetterBold($item);
            echo '</p>';
            $this->countWords($item);
            echo '<br>';
        }
        echo '</div>';
    }

    function viewPagination($number, $pagesCount)
    {
        echo '<div class="container col-lg-4">';
        for ($i = 1; $i <= $pagesCount; $i++) {
            if ($i != $number) {
                echo "<a href=\"index.php?number=$i\">$i</a> ";
            } else {
                echo $i . ' ';
            }
        }
        echo '</div>';
    }

    function viewFooter()
    {

    }
    function countWords($paragraph)
    {
        $abc = chr(168).chr(184);
        for ( $i = 192; $i < 256; $i++ )
        {
            $abc .= chr($i);
        }
        $char=iconv( 'cp1251', 'utf-8', $abc);
        echo '<span style="font-style: italic">';
        echo 'Количество символов в азбаце: '.mb_strlen(strip_tags($paragraph), 'utf-8').'; ';  // считаем и выводим количество символов в абзаце
        echo 'Количество слов в абзаце: '.str_word_count(strip_tags($paragraph),0,$char);  // считаем и выводим количество слов в абзаце
        echo '</span><br>';
    }
    function firstLetterBold ($paragraph)
    {
        $pattern = array('/HTML|PHP|ASP(.NET)?|JAVA/i', '/(^|[.!?]\s+)(<.*>)?([0-9,A-Z,a-z,А-Я,а-я,Ёё])/Uu');
        $replace = array('<span style="color:blue;">$0</span>','$1$2<b>$3</b>');
        echo $paragraph = preg_replace($pattern, $replace, $paragraph);
    }
}
$controller = new Controller();
$controller->run();
