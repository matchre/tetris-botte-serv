all :
	php -l index.php
	$(MAKE) -C .. www
	firefox http://www-sop.inria.fr/science-participative/tetrisbote?index=12

