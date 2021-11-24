all: caravan.csv wire.csv scroll.csv hindu print 

caravan.csv:
	php _scripts/caravan.php

scroll.csv:
	php _scripts/scroll.php

wire.csv:
	php _scripts/wire.php

theprint.csv:
	php _scripts/theprint.php