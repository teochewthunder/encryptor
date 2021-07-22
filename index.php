<!DOCTYPE html>
<html>
	<head>
		<title>The Encryptor/Decryptor</title>
		<script>
			function decrypt()
			{
				var txtEnc = document.getElementById("txtMessageEncrypt");
				var txtDec = document.getElementById("txtMessageDecrypt");
				var txtKey = document.getElementById("txtKey");

				var words = txtEnc.value.split(" ");
				var decryptor = txtKey.value.split("");
				var encryptable = true;

				if (words.length == 0 || decryptor.length == 0)
				{
					encryptable = false;
				}
				else 
				{
					if (decryptor.length > words.length) encryptable = false;

					for (var i = 0; i < decryptor.length; i++) 
					{
						if (decryptor[i] == "0" || isNaN(decryptor[i])) encryptable = false;
					}
				}

				var decrypted = "";
				
				if (encryptable)
				{
					var ptr = -1;

					for (var i = 0; i < decryptor.length; i++) 
					{
						ptr += parseInt(decryptor[i]);
						decrypted += words[ptr] + " ";
					}

					txtDec.innerHTML = decrypted;
				}
			}
		</script>
	</head>

	<body>
		<?php
			$message = "";

			if (isset($_GET["message"])) 
			{
				$message = $_GET["message"];
			}

			if (isset($_POST["txtEmail"]))
			{
				$html = "You have received a message.\n";
				$html .= "Visit the link http://www.teochewthunder.com/demo/encryptor/index.php?message=". urlencode($_POST["txtMessageEncrypt"]) ." to decrypt it ";
				//$html .= "Visit the link http://localhost/encryptor/index.php?message=". urlencode($_POST["txtMessageEncrypt"]) ." to decrypt it ";
				$html .= "using your decryptor key.\n";

				$subject = "This is a Decryptor test";

				if (mail ($_POST["txtEmail"], $subject , $html))
				{
					echo "Mail sent";
				}
			}
		?>
		<div id="txtMessageDecrypt">

		</div>

		<form method="POST" action="index.php">
			<textarea id="txtMessageEncrypt" name="txtMessageEncrypt" rows="15" cols="100"><?php echo $message;?></textarea>

			<br /><br />

			Key:
			<input id="txtKey" name="txtKey" value="">

			<br /><br />

			<input type="button" onclick="decrypt();" value="Decrypt">

			<br /><br />

			<input id="txtEmail" name="txtEmail" value="">
			<input type="submit" value="Send Message">
		</form>
	</body>
</html>