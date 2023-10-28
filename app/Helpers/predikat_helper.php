<?php  
function predikat($score) {
	if ($score >= 93 ) {
   		return "A+";
   	}elseif ($score >= 90) {
   		return "A";
   	}elseif ($score >= 87) {
   		return "A-";
   	}elseif ($score >= 84) {
   		return "B+";
   	}elseif ($score >= 81) {
   		return "B";
   	}elseif ($score >= 78) {
   		return "B-";
   	}elseif ($score >= 70) {
   		return "C";
   	}elseif ($score < 70) {
   		return "D";
   	}
}

function predikat1($score) {
	if ($score >= 93 ) {
   		return "A+";
   	}elseif ($score >= 90) {
   		return "A";
   	}elseif ($score >= 87) {
   		return "A-";
   	}elseif ($score >= 84) {
   		return "B+";
   	}elseif ($score >= 81) {
   		return "B";
   	}elseif ($score >= 78) {
   		return "B-";
   	}elseif ($score >= 75) {
   		return "C";
   	}elseif ($score < 75) {
   		return "D";
   	}
}
?>