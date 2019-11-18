<?php
	// define('LBROOT',getcwd()); // LegoBox Root ... the server root
	function post_captcha($user_response) 
	{
	        $fields_string = '';
	        $fields = array(
	            'secret' => '6Ld8abMUAAAAAIBpVfbkokwouY9J7KMJHBD23d4z',
	            'response' => $user_response
	        );
	        foreach($fields as $key=>$value)
	        $fields_string .= $key . '=' . $value . '&';
	        $fields_string = rtrim($fields_string, '&');

	        $ch = curl_init();
	        curl_setopt($ch, CURLOPT_URL, 'https://www.google.com/recaptcha/api/siteverify');
	        curl_setopt($ch, CURLOPT_POST, count($fields));
	        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
	        curl_setopt($ch, CURLOPT_RETURNTRANSFER, True);

	        $result = curl_exec($ch);
	        curl_close($ch);

	        return json_decode($result, true);
    }

    // Agregarmos una variable CaptCha
    $res = post_captcha($_POST['g-recaptcha-response']);
    // Fin Agregarmos una variable CaptCha
    if (!$res['success']) 
    {
        print "<script>window.location='./';</script>";
    }
        
    else
    {
    	if(Session::getUID() == ""  ) 
		{
		    if(count($_POST)>0 && $_POST['user'] != "" && $_POST['password'] != "")
		    {
				$user = $_POST['user'];
				$user = str_replace(array('\'', '"','and','AND','or','OR',';',','), '', $user); 
				$pass = $_POST['password'];
				$pass = str_replace(array('\'', '"','and','AND','or','OR',';',','), '', $pass); 
				$base = new Database();
				$con = $base->connect();
				$sql = "select * from usuarios_sjl where  usuario= \"".$user."\" and estado=1";
				$query = $con->query($sql);
				$password = "";
				while($p = $query->fetch_array())
					{
						$password = $p['password'];
					}

				$sql = "select * from usuarios_sjl where  usuario= \"".$user."\" and estado=1";
						$query = $con->query($sql);
						$found = false;
						$userid = null;
					while($r = $query->fetch_array())
					{
						$found = true ;
						$useridcronoos = $r['id'];
					}

					if($found==true) 
					{
						$_SESSION['user_idcronoosaccess']=$useridcronoos ;
					//	setcookie('userid',$userid);
						print "Cargando Sistema ... espere un momento $user";
						print "<script>window.location='./?view=home';</script>";
					}
					else 
					{
						print "<script>window.location='./';</script>";
					}
							
				
				}
				else 
				{
					print "<script>window.location='./';</script>";
				}
		}
		else
		{
			print "<script>window.location='./?view=home';</script>";
			
		}
    }

	
?>