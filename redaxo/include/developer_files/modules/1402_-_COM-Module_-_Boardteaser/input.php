<strong>Text</strong>
<br />[F&#x00b8;r Anzahl der Eintr&#x2030;ge bitte ###board-eintraege### verwenden]:
<br />[F&#x00b8;r Anzahl der Themen bitte ###board-themen### verwenden]:
<br />
<?php if(OOAddon::isAvailable('textile')) { ?>
<textarea name="VALUE[1]" cols="80" rows="10" class="inp100">REX_VALUE[1]</textarea>
<br />
<?php rex_a79_help_overview(); }else { echo rex_warning('Dieses Modul ben&#x02c6;tigt das "textile" Addon!'); } ?>
<br />Boardkey:
<input type="text" name="VALUE[2]" value="REX_VALUE[2]" size="20" />
<br /><br />