<?php
	$galderak= simplexml_load_file("galderak.xml");
	
	foreach($galderak->assessmentItems as $assessmentItem){
		//echo $assessmentItem->getName().":".$assessmentItem."<br/>";
		foreach($assessmentItem->children() as $child){
		
			foreach($child->children() as $child2){
				if($child2->getName()=='p'){
					//foreach($child2->children() as $child3){
						echo utf8_decode($child2->p."<br/>");
					//} 
				}
				
				if($child2->getName()=='value'){
					//foreach($child2->children() as $child4){
						echo utf8_decode($child2->value."<br/>");
					//}
				}
			}
		}
	}