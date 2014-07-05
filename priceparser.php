<?php
require_once("simple_html_dom.php");
$html = new simple_html_dom();
$drugName = $_POST["drugName"];
$html->load_file("http://www.healthkartplus.com/search/all?name=".$drugName);
$ul = $html->find('#srchRslt');
$li = $ul[0]->find('li');
$rows = array();
$length = count($li);
for ($i=1; $i < 7; $i++) { 
	if ($i > 0 && $i < $length) {
		$row = array();	
		$row["name"] = $li[$i]->first_child()->first_child()->first_child()->innertext;
		$row["quantity"] = $li[$i]->first_child()->first_child()->first_child()->next_sibling()->innertext;
		$row["price"] = $li[$i]->first_child()->first_child()->next_sibling()->next_sibling()->innertext;
		$rows[$i-1] = $row;
	}
}
echo json_encode($rows);
?>