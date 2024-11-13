<?php

class TelegraphText
{
    public $title; // заголовок текста;
    public $text; // текст;
    public $author; // имя автора;
    public $published; // дата и время последнего изменения текста;
    public $slug;

    public function __construct($author, $slug)
    {
        $this->author = $author;
        $this->slug = $slug;
        $this->published = date('d.m.Y H:i');
    }


    function loadText()
    {
        if (filesize($this->slug) > 0) {
            $str = file_get_contents("{$this->slug}");

            return unserialize($str);
        }
    }

    function storeText(array $testText)
    {
        $str = serialize($testText);
        file_put_contents("{$this->slug}", $str);
    }

    function editText(array &$textStorage): bool
    {
        if (array_key_exists('title', $textStorage)) {
            $replacements1 = [
                'title' => $this->title,
                'text' => $this->text
            ];

            $textStorage = array_replace($textStorage, $replacements1);

            echo "Запись изменена" . PHP_EOL;
            return true;
        }
        echo "Записи нет" . PHP_EOL;
        return false;
    }
}

$telegraph1 = new TelegraphText('Ivan', 'test.txt');

$testText1 = [
    'title' => 'Privet1',
    'text' => 'Hello, World1!',
    'author' => $telegraph1->author,
    'published' => $telegraph1->published
];

$telegraph1->title = 'Privet2';
$telegraph1->text = 'Hi, World2';

$telegraph1->editText($testText1);

$telegraph1->storeText($testText1);

$testText2 = $telegraph1->loadText();
var_dump($testText2);