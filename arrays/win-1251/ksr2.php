<?php
header('Content-Type: text/html; charset=Windows-1251');

require 'text.php';

$text_paragraph = explode("\r\n", $text);  // делим текст на абзацы по разделителю "перенос строки"

echo '<h3 style="color:blue">2. Определить общую длину и количество слов для каждого абзаца.</h3>';

echo '<table border="1">';
foreach ($text_paragraph as $i=>$par)  // задаем параметры цикла для подсчета количества символов и слов в каждом абзаце
{
echo '<tr>';
echo "<td>Количество символов в азбаце $i:</td>".'<td>'.strlen($par).'</td>';  // считаем и выводим количество символов в абзаце
echo "<td>Количество слов в абзаце $i:</td>".'<td>'.str_word_count($par).'</td>';  // считаем и выводим количество слов в абзаце
echo '</tr>';
}
echo '</table>';

echo '<h3 style="color:blue">3. Вывести первую букву каждого предложения жирным шрифтом.</h3>';

$text_sentence = explode ('. ', $text);  //делим текст на предожения по разделителю "точка-пробел"
foreach ($text_sentence as $i=>$sentence)
{
	if ($i>1)
		{
		$a = substr($sentence, 0, 1);
		echo "<span style='font-weight: bold'>$a</span>".substr($sentence, 1).'. ';
		}
	else
		echo $sentence;
}
echo '<br>';

echo '<h3 style="color:blue">4. Выделить цветом все слова HTML, PHP, ASP, ASP.NET, Java с любым регистром символов.</h3>';

$search = array('HTML', 'PHP', 'ASP.NET', 'ASP', 'Java');
$replace = array('<span style="color:red">HTML</span>', '<span style="color:red">PHP</span>', '<span style="color:red">ASP.NET</span>', '<span style="color:red">ASP</span>', '<span style="color:red">Java</span>');
$red_text = str_ireplace($search, $replace, $text);
echo $red_text;

echo '<br>';