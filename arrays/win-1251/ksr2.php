<?php
header('Content-Type: text/html; charset=Windows-1251');

require 'text.php';

$text_paragraph = explode("\r\n", $text);  // ����� ����� �� ������ �� ����������� "������� ������"

echo '<h3 style="color:blue">2. ���������� ����� ����� � ���������� ���� ��� ������� ������.</h3>';

echo '<table border="1">';
foreach ($text_paragraph as $i=>$par)  // ������ ��������� ����� ��� �������� ���������� �������� � ���� � ������ ������
{
echo '<tr>';
echo "<td>���������� �������� � ������ $i:</td>".'<td>'.strlen($par).'</td>';  // ������� � ������� ���������� �������� � ������
echo "<td>���������� ���� � ������ $i:</td>".'<td>'.str_word_count($par).'</td>';  // ������� � ������� ���������� ���� � ������
echo '</tr>';
}
echo '</table>';

echo '<h3 style="color:blue">3. ������� ������ ����� ������� ����������� ������ �������.</h3>';

$text_sentence = explode ('. ', $text);  //����� ����� �� ���������� �� ����������� "�����-������"
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

echo '<h3 style="color:blue">4. �������� ������ ��� ����� HTML, PHP, ASP, ASP.NET, Java � ����� ��������� ��������.</h3>';

$search = array('HTML', 'PHP', 'ASP.NET', 'ASP', 'Java');
$replace = array('<span style="color:red">HTML</span>', '<span style="color:red">PHP</span>', '<span style="color:red">ASP.NET</span>', '<span style="color:red">ASP</span>', '<span style="color:red">Java</span>');
$red_text = str_ireplace($search, $replace, $text);
echo $red_text;

echo '<br>';