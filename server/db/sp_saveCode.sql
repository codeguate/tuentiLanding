USE `heineken-form` ;

DELIMITER //
DROP PROCEDURE IF EXISTS sp_saveCode //
CREATE PROCEDURE sp_saveCode(IN p_nombre VARCHAR(255),IN p_email VARCHAR(255),IN p_dpi VARCHAR(255),IN p_idCode INT)

BEGIN
	 DECLARE l_count INT DEFAULT 0;
	 DECLARE error INT DEFAULT 0;
	 DECLARE EXIT HANDLER FOR SQLEXCEPTION BEGIN SET error = 1; ROLLBACK; END;
	 SELECT COUNT(*) FROM usuario WHERE dpi = p_dpi INTO l_count;
	IF l_count = 0 THEN
		INSERT INTO usuario(`nombre`,`email`,`dpi`,`idCodigo`,`created_at`,`update_at`)VALUES
					(p_nombre,p_email ,p_dpi,p_idCode,now(),now());
                    
		UPDATE codigo SET estado = '1' WHERE idcodigo = p_idCode;
	 ELSE
		SET error = 2;
	 END IF;
	SELECT error;
END //
DELIMITER ;