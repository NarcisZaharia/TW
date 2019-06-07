<?php
// example of how to use basic selector to retrieve HTML contents
include('../simple_html_dom.php');
 
// get DOM from URL or file
$html = file_get_html('https://www.meetup.com/find/tech/');


// find all link
//foreach($html->find('div[id=outer]') as $e) 
    //echo $e->href . '<br>';
	
/*
// find all image
foreach($html->find('img') as $e)
    echo $e->src . '<br>';

// find all image with full tag
foreach($html->find('img') as $e)
    echo $e->outertext . '<br>';

// find all div tags with id=gbar
foreach($html->find('div#gbar') as $e)
    echo $e->innertext . '<br>';

// find all span tags with class=gb1
foreach($html->find('span.gb1') as $e)
    echo $e->outertext . '<br>';

// find all td tags with attribite align=center
foreach($html->find('td[align=center]') as $e)
    echo $e->innertext . '<br>';

  

// extract text from table
echo $html->find('td[align="center"]', 1)->plaintext.'<br><hr>';

// extract text from HTML
echo $html->plaintext;




$dom->find("table", 0); # first table
$dom->find("table table", 0); # second table
$dom->find("table table table", 0); # third table
 

foreach($html->find("table", 0) as $e) 
echo $e->href . '<br>';
*/

//scot din tabela . 0 e prima tabela, 1 a doua si tot asa.
//echo $html->find("div", 0)->plaintext;
//echo $html->find('.page')->plaintext;

//foreach($html->$ret = $html->find('div[class=input-group header-search m-b-sm text-header header-search-keyword]') as $e)
//{
//echo $e->innertext;

//}
/*
	echo "<table border = 1>";
foreach($ret = $html->find('div[class=panel-body]') as $e)
{

	//echo "<table border = '1'>";
	echo "<th>";
	echo $e->innertext;
	echo "</th>";
	//echo "</table>";

}
	echo "</table>";
*/
?>

<html>
<head>
<link rel="stylesheet" href="../rep/MainPage/TeaSkMain.css">
</head>
<body>
<div id="content">
    <?php
	
	echo "<table border = 1>";
foreach($ret = $html->find('a[class=display-none]') as $e)

{

	//echo "<table border = '1'>";
	echo "<th>";
	echo $e->innertext;
	echo "<br><br>";
	echo "<a>$e->href</a>";
	echo "</th>";
	//echo "</table>";

}
	echo "</table>";
	
	?>
  </div>
</body>


</html>

