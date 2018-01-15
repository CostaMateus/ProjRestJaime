
# ProjRestJaime

Agr tem... haha

O q tah online: v0.9 [http://lolzimhj.pe.hu/](http://lolzimhj.pe.hu/)



## O que tem pra fazer? 


- Atualizar todas as funções usadas, na index e no /admin.

Ex, no index. 
function(antiga): 
```php
	foreach($objFunc->qSelect4Destaques() as $result1) { 
		//cod html
	}
```	

function(nova):
```php
	foreach ($objFunc->getLastFourFeatured() as $r1) {
		//cod html
	}
```


- Atualizar link dos imports (css, imagens, scripts, links).

- Rever todas as constantes e os includes delas.

- Formulário de envio de e-mail, toda parte lógica.

- Substituir `<?php echo ALGUMA_CONST; ?>` por `<?=ALGUMA_CONST?>`.

- Retirar comentários desnecessários. kkkk 

- Criar as DAOs.

- Refatorar as funções para se adequarem as DAOs.

#### Com ctz estou esquecendo de algo. Dps acrescento... 
