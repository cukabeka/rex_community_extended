
DELETE FROM `rex_xform_table` where `table_name`='rex_com_board';
DELETE FROM `rex_xform_field` where `table_name`='rex_com_board';
DELETE FROM `rex_xform_field` where `table_name`='rex_com_user' and `f1`='rex_com_board';

DELETE FROM `rex_62_params` where `name`='art_com_boardtype';
DELETE FROM `rex_62_params` where `name`='art_com_boards';
