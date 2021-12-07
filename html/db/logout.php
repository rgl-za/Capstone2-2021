<?php
	session_start();
	session_destroy(); //세션 제거

	echo("
		<script>
            history.go(-1);
		</script>
	");
?>
