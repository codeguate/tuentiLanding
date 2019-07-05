USE `heineken-form` ;

DELIMITER //
DROP PROCEDURE IF EXISTS sp_getCode //
CREATE PROCEDURE sp_getCode(IN p_code VARCHAR(10))

BEGIN
	 DECLARE l_count INT DEFAULT 0;
     DECLARE l_count2 INT DEFAULT 0;
     DECLARE l_code INT DEFAULT 0;
	 DECLARE error INT DEFAULT 0;
	 DECLARE EXIT HANDLER FOR SQLEXCEPTION BEGIN SET error = 1; ROLLBACK; END;
	 SELECT COUNT(*) FROM codigo WHERE codigo.codigo = p_code AND estado = '1' INTO l_count;
	IF l_count = 0 THEN
		SELECT COUNT(*) FROM codigo WHERE estado = '0' AND codigo.codigo = p_code INTO l_count2;
		IF l_count2 = 0 THEN
			SET error = 3;
		ELSE
			select idcodigo FROM codigo WHERE estado = '0' AND codigo.codigo = p_code INTO l_code;
        END IF;
	 ELSE
		SET error = 2;
	 END IF;
	SELECT error, l_code as idCode;
END //
DELIMITER ;