<strong>spezielle Headline f&#x00b8;r Darstellung als Box:</strong><br />
<input name="VALUE[2]" style="width: 30%" value="REX_VALUE[2]"> 
<input name="VALUE[3]" style="width: 30%" value="REX_VALUE[3]">
<br /><br />

<strong>Fliesstext:</strong><br />
<textarea name="VALUE[1]" cols="80" rows="30" class="inp100">REX_VALUE[1]</textarea>
<br /><br />
REX_LINK_BUTTON[1]
<strong>Artikelfoto</strong>:<br />
REX_MEDIA_BUTTON[1]
<?
if ("REX_FILE[1]" != "") {
	echo "<img src=".$REX['HTDOCS_PATH']."/files/REX_FILE[1]><br />";
}

?><br />
<br />


<strong>Ausrichtung des Artikelfotos:</strong><br />
<select name="VALUE[9]" style="width: 200px;">
	<option value="l" <? if ("REX_VALUE[9]" == 'l') echo 'selected="selected"'; ?>>links vom Text</option>
	<option value="r" <? if ("REX_VALUE[9]" == 'r') echo 'selected="selected"'; ?>>rechts vom Text</option>
	<option value="t" <? if ("REX_VALUE[9]" == 't') echo 'selected="selected"'; ?>>oberhalb vom Text</option>
	<option value="b" <? if ("REX_VALUE[9]" == 'b') echo 'selected="selected"'; ?>>unterhalb vom Text</option>
</select><br />
<br />

<strong>Darsellung als Box:</strong><br />
<select name="VALUE[8]" style="width: 200px;">
	<option value="0" <? if ("REX_VALUE[8]" == '0') echo 'selected="selected"'; ?>>nein</option>
	<option value="1" <? if ("REX_VALUE[8]" == '1') echo 'selected="selected"'; ?>>ja</option>
</select><br />
<br />

<strong>Anleitung / Hinweise</strong>:
<table class="warning" style="width:100%">
<tr>
	<th style="width:200px;"><strong>Beschreibung</strong></th>
	<th><strong>Eingabe</strong></th>
</tr>
<tr>
	<td><h1>&#x2039;berschrift 1</h1></td>
	<td>h1. &#x2039;berschrift (Leerzeile vor und nach der Eingabe)</td>
</tr>
<tr>
	<td><h2>&#x2039;berschrift 2</h2></td>
	<td>h2. &#x2039;berschrift (Leerzeile vor und nach der Eingabe)</td>
</tr>
<tr>
	<td><strong>fetter Text</strong></td>
	<td>*fetter Text*</td>
</tr>
<tr>
	<td><i>kursiver Text</i></td>
	<td>__kursiver Text__</td>
</tr>
<tr>
	<td><del>gestrichener Text</del></td>
	<td>-gestrichener Text-</td>
</tr>
<tr>
	<td>geordnete Liste mit Zahlen</td>
	<td># Listenpunkt</td>
</tr>
<tr>
	<td>ungeordnete Liste mit Zeichen</td>
	<td>* Listenpunkt</td>
</tr>
<tr>
	<td>Link (intern)</td>
	<td>"zum Impressum":redaxo://5</td>
</tr>
<tr>
	<td>Link (extern)</td>
	<td>"zu unserem Partner":http://yakamara.de</td>
</tr>
<tr>
	<td>Link mit Ankersprung (intern/extern)</td>
	<td>"zum Kontakt":http://domain.de#Kontakt<br />"zum Impressum":redaxo://5#Kontakt</td>
</tr>
<tr>
	<td>Anker definieren</td>
	<td>p(#Impressum). Hier steht das Impressum</td>
</tr>
</table>