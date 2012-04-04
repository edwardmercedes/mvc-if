<?php 


/*					funciones almacenadas
***********************************************************************
*	
*
************************************************************************
*/
DELIMITER \\
	DROP PROCEDURE IF EXISTS todo.drop_node_relations \\
	CREATE PROCEDURE em.RESTAR(IN id int, IN cantidad int)
		BEGIN
			INSERT INTO resta ()
			DELETE FROM node WHERE id = nodeid;
		END\\
DELIMITER ;

CALL nodoeliminar(122)