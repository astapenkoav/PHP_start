<?php

define ('MESSAGES_PER_PAGE', 4); //количество отзывов на странице
define ('PAGINATION', 5); //количество ссылок на странице

class Controller
{
    private $model;
    private $view;
    private $pageNumber; //номер запрошенной страницы
    private $action; //метод работы "чтение" или "запись"
//конструктор определяет номер запрошенной страницы и метод работы с данными
    public function __construct() {
        $this->pageNumber = isset($_GET['number'])?intval($_GET['number']):1; //если номер не передан через строку браузера, устанавливаем по умолчанию = 1
        if (!empty($_POST))
            $this->action = 'write'; //если отправляем данные из формы, то назначаем метод "запись"
        else
            $this->action = 'read'; //если данные из формы не отправлялись, то назначаем метод "чтение"
    }

    public function run() {
        try {
            //создаем объект и передаем в качестве параметра метод работы с данными из конструктора
            $this->model = new Model($this->action);
            $this->model->setMessagesPerPage(MESSAGES_PER_PAGE); //передаем ей количество сообщений на странице
            $this->model->run($this->pageNumber); //запускаем, она записывает или читает нужные данные
            //создаем объект класса View для отображения данных на странице
            $this->view = new View($this->pageNumber, $this->model->getPagesAmount(), PAGINATION); //передаем в качестве параметров номер нужной страницы и кол-во отображаемых ссылок
            $this->view->view($this->model->getPageMessages(), $this->model->getdata(), $this->model->getError()); //выводим страницу
        }
        catch(Exception $err) {
            echo 'Ошибка!<br/>' . $err->getMessage(); //если возникла ошибка, выводим сообщение
            View::viewEReturn();
        }
    }

}

class Model
{
    private $messagesArray; //массив сообщений из файла
    private $messagesAmount; //общее количество сообщений
    private $messagesPerPage; //количество сообщений на одной странице
    private $pagesAmount; //количество страниц
    private $pageMessages; //массив сообщений для запрошенной страницы
    private $pageNumber; //номер запрошенной страницы
    private $action; //действие "чтение" или "запись"
    private $data; //данные
    private $error; //сообщение обшибки
//устанавливаем для всех свойств значения по умолчанию с помощью конструктора
    public function __construct($action) {
        $this->messagesArray = array();
        $this->messagesAmount = 0;
        $this->action = $action;
        $this->messagesPerPage = 1;
        $this->pagesAmount = 1;
        $this->pageMessages = array();
        $this->pageNumber = 1;
        $this->data['name'] = '';
        $this->data['message'] = '';
        $this->error = '';
    }
    public function getdata() {//получаем данные для формы
        return $this->data;
    }
    public function getPagesAmount() {//получаем количество страниц
        return $this->pagesAmount;
    }
    public function setMessagesPerPage($messagesPerPage) { //количество сообщений на странице
        $this->messagesPerPage = $messagesPerPage;
    }
    public function getPageMessages() {//получаем сообщения для запрошенной страницы
        return $this->pageMessages;
    }
    public function run($pageNumber = 1) { //по умолчанию номер страницы = 1
        $this->pageNumber = $pageNumber; //записываем полученный номер
        $this->{$this->action}(); //вызываем метод по имени, хранящемся в $this->action,т.е. "чтение" или "запись"
    }
    public function getError() {//получаем сообщение об ошибке
        return $this->error;
    }
//метод "чтение"
    private function read() {
        if (($this->messagesArray = file('messages.txt')) === false) {//читаем файл
            throw new Exception('Не удалось прочитать файл');
        }
        $this->messagesArray = array_reverse($this->messagesArray); //реверсиуем массив
        $this->messagesAmount = count($this->messagesArray); //определяем количество сообщений
        $this->pagesAmount = ceil($this->messagesAmount/$this->messagesPerPage); //определяем количество страниц
        if ($this->pageNumber<1 || $this->pageNumber>$this->pagesAmount) {
            throw new Exception('Запрошенная страница не существует'); //выводим ошибку, если введенного номера страницы не существует
        }
        $messageNumber = (($this->pageNumber-1) * $this->messagesPerPage); //номер первого сообщения на странице
        //извлекаем необходимое количество сообщений для страницы
        $this->pageMessages = array_slice($this->messagesArray, $messageNumber, $this->messagesPerPage);
    }
//метод "запись"
    private function write() {
        $this->cleanTags('name', 2, 20); //применяем к данным из формы функцию очистки и проверки введенных данных
        $this->cleanTags('message', 10, 460); //применяем к данным из формы функцию очистки и проверки введенных данных
        if ($this->error)
            return; //если были ошибки при проверке выходим без записи в файл
        $message = $this->data['name'] . "\t" . $this->data['message'] . "\t" . date("d-m-Y H:i:s") . "\n"; //записываем отзыв в файл
        if (file_put_contents('messages.txt', $message, FILE_APPEND | LOCK_EX) === false) {
            $this->error .= 'Не удалось сохранить сообщение<br/>'; //если не удалось произвести запись, то выводим ошибку
            return;
        }
        header('location: http://' . $_SERVER['SERVER_NAME'] . $_SERVER['SCRIPT_NAME']); //после записи данных отправляем заголовок для запроса главной страницы
        exit();
    }
//функция для очистки и проверки данных из формы
    private function cleanTags($value, $min, $max) {
        if (!empty($_POST[$value])&&($_POST['hidden']=="secret"))
            $this->data[$value] = $_POST[$value];
        $this->data[$value] = trim($this->data[$value]); //удаляем пробелы из начала и конца строки
        $this->data[$value] = stripslashes($this->data[$value]); //удаляем экранирование символов
        $length = mb_strlen($this->data[$value]);
        if ($length < $min | $length > $max)
            $this->error .= 'Количество символов в поле: ' . $value . ' должна быть от ' . $min . ' до ' . $max . '<br/>';
        $this->data[$value] = htmlspecialchars($this->data[$value], ENT_QUOTES, 'UTF-8');
        $this->data[$value] = str_replace("\t", ' ', $this->data[$value]); //заменяем символ табуляции на пробелы
        $this->data[$value] = str_replace(array("\r\n", "\n\r", "\r", "\n"), '<br>', $this->data[$value]); //заменяем переносы строк на <br>
    }
}

class View
{
    private $pageMessages; //массив сообщений для вывода
    private $pageNumber; //номер запрошенной страницы
    private $pagesAmount; //количество страниц
    private $pagination; //количество ссылок
    private $data; //данные для формы, чтобы отобразить повторно при некорректном вводе
    private $error; //сообщение обшибке при некорректных данных в форме

    public function __construct($pageNumber, $pagesAmount, $pagination) {//в аргументах конструктора передаются настройки пагинатора
        $this->pageMessages = array();
        $this->pageNumber = $pageNumber;
        $this->pagesAmount = $pagesAmount;
        $this->pagination = $pagination;
    }
//выводим всю страницу
    public function view($pageMessages, $data, $error) {
        $this->pageMessages = $pageMessages;
        $this->data = $data;
        $this->error = $error;
        $this->viewHeader();
        $this->viewMessages();
        $this->viewPagination();
        $this->viewForm();
        $this->viewFooter();
    }
//отображаем Header
    private function viewHeader() {
        echo '<!doctype html>
            <html>
            <head>
                <link rel="stylesheet" href="css/bootstrap.min.css">
                <meta charset="UTF-8">
                <title>Гостевая книга</title>
            </head>
            <body>
            <div class="container"><h1 class="text-center">Гостевая книга</h1>';
    }
//отображаем отзыв
    private function viewMessages() {
        foreach ($this->pageMessages as $message) {
            $item = explode("\t", $message); //разбиваем строку и записываем в массив
            if (isset($item[0])&&isset($item[1])) //если данных в файле ещё нет, то выводим сообщение об этом через else
            {
                echo '<div class="border border-primary rounded alert alert-secondary">';
                echo "<p><span class='font-weight-bold'>Пользователь: </span>" . $item[0] . "</p><hr>";
                echo "<p><span class='font-weight-bold'>Отзыв: </span>" . $item[1] . "</p><hr>";
                echo "<p><span class='font-weight-bold'>Дата и время: </span>" . $item[2] . "</p>";
                echo '</div><br>';
            } else {
                echo '<div class="border border-primary rounded alert alert-secondary">';
                echo '<p class="font-weight-bold text-center">Здесь пока пусто, напишете первый отзыв</p></div>';
            }
        }
    }
//отображаем паганицию
    private function viewPagination() {
        if ($this->pagesAmount < 2) //если страница всего одна, то не выводим пагинацию
            return;
        $start = ($this->pageNumber - $this->pagination);
        if ($start < 1)
            $start = 1;
        $end = ($this->pageNumber + $this->pagination);
        if ($end > $this->pagesAmount)
            $end = $this->pagesAmount;
        for ($i = $start; $i<=$end; $i++) {
            if ($i == $this->pageNumber)
                echo $i . '&nbsp;';
            else
                echo '<a href="' . basename($_SERVER['SCRIPT_FILENAME']) . '?number=' . $i . '">' . $i . '</a>&nbsp;';
        }
    }
//отображаем Footer
    private function viewFooter() {
        echo '</div>
              </body>
              </html>';
    }
//отображаем форму
    private function viewForm() {
        if ($this->error) //если были ошибки при вводе, отображаем сообщение об ошибке
        {
            echo '<div class="alert alert-danger">Была допущена ошибка:<br/>' . $this->error . '</div>';
            echo '<a href="' . basename($_SERVER['SCRIPT_FILENAME']) . '">Вернуться на Главную</a>';
        }
        echo
            '<div class="mx-auto form-group" style="width: 50%">
                <form action="index.php" method="post">
                    <input type="hidden" name="hidden" value="secret">
                    <br>
                    <input class="form-control" type="text" id="name" name="name" placeholder="Ваше имя" maxlength="20" autocomplete="off" required autofocus value="' . $this->data['name'] .'">
                    <label for="name" class="col-sm-9 control-label" style="font-size: small"> (От 2 до 20 символов, обязательное поле)</label>
                    <br>
                    <textarea class="form-control" id="message" name="message" cols="80" rows="12" placeholder="Напишите Ваш отзыв" maxlength="460">' . $this->data['message'] .'</textarea>
                    <label for="message" style="font-size: small"> (От 10 до 460 символов)</label>
                    <br>
                    <input type="reset" value="Сбросить" class="btn btn-secondary">
                    <input type="submit" value="Отправить" class="btn btn-success">
                </form>
         </div>';
    }
//отображаем ссылку для возврата на Главную страницу
    public static function viewEReturn()
    {
        echo '<br><a href="' . basename($_SERVER['SCRIPT_FILENAME']) . '">Вернуться на Главную</a>';
    }
}

$controller = new Controller();
$controller->run();