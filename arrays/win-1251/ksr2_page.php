<?php
header('Content-Type: text/html; charset=Windows-1251');

require 'text.php';

$text_paragraph = explode("
", $text);  //����� ����� �� ������ �� ����������� "������� ������"

define ('DATA_PER_PAGE', 15); //������ ���������� ������, ��������� �� ���� ��������
$data_count = count($text_paragraph); //���������� ���������� ������

//���� ������ ���, ������� ��������� �� �� ����������
if (!$data_count) die("��������, ������ ��� ����������� �� ������ ������ �����������");
$pages_count = ceil($data_count/DATA_PER_PAGE); //���������� ������� � ����������� �� ������ � ������� �������

//����������� �������� page �������, ��������� ���������� ��������� � �������
$current_page = isset($_GET['page'])?$_GET['page']:1; //� ������ ������� � ���������� page �� ��������� � $current_page
                                                   //����� ���� �������� ����� ��� ����������, �� ����� $current_page=1
$current_page = intval($current_page);//����������� ���������� ������  � $current_page � ������ ����, � ������ � 0
//�������� ������������� ��������, ���� �� ���, ���� ��������� � �������������� ��������
if ($current_page<1 || $current_page>$pages_count) die("����������� ���� �������� �� �������");
  
//�������� ������ ��������
//���������� ����� ������� �������� ��� ������ �� ������� $x
$first_element = ($current_page-1)*DATA_PER_PAGE;
//��������� ������ ������ �������� �� ������� $x, ������� � ������������ $first_element � ���������� DATA_PER_PAGE
$page_data = array_slice($text_paragraph, $first_element, DATA_PER_PAGE);

//������ ������� ������ �� ��������
echo '<h3 style="color:blue">1. ���������� ����� ������ �� ��������� �� k ������� �� ������ ��������.</h3>';
foreach ($page_data as $element)
{
  echo '<div>';
  echo '<p>'.$element.'</p>';//� �������� ������ ��������, ����� �������  ���, ����, ����� ���������
  echo '</div>';
}

//��������� ������ ��� �������� �� ���������
$str = 3;//���������� ������� (+/- � �������) ��� ������
//��������� ��������� � �������� �������� ��� ������
$start=$current_page-$str;
if ($start<1)
	$start = 1;//���� ����� �������� �������� ������ 1 ����������� 1
$end = $current_page+$str;
if ($end>$pages_count)
	$end = $pages_count;//���� ����� �������� �������� ������ $pages_count, ����������� $pages_count
//��������� � ����� ������ ������� �� $start �� $end ����� ������� $current_page, ��� ������� ��������� ������ �� �����
for ($i = $start; $i<=$end; $i++)
{
  if ($i == $current_page)
    echo $i.'&nbsp;&nbsp;';
  else
    echo '<a href="ksr2_page.php?page='.$i.'">'.$i.'</a>&nbsp;&nbsp;';
}